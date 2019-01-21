<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends MY_Base_Controller {

    var $no_auth_request = array(
        'user/signup',
        'user/signin',
        'user/changepass',
        'user/forgotpass',
        'user/manageprofile'
    );
    var $req;
    var $res;

    function __construct() {
        parent::__construct();
        $this->load->model('Core_Model');
        $this->load->model('Search_Model');
        $this->res = new stdClass();
    }

    public function transactionSuccess() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {

            $data = new stdClass();
            $resp = $request->payu;
            $transaction = $request->getStatus_transaction;
            

            
            if ($request->spaceId && $request->receverId && $request->uid) {
                $space = $request->spaceId;
                $recever = $request->receverId;
                $sender = $request->uid;

                $array = array(
                    'spaceId' => $space,
                    'senderId' => $sender,
                    'recieverId' => $recever,
                    'masage' => 'You Recieved New Booking',
                    'type' => 1,
                    'status' => 0,
                );

                $inserNotification = $this->Common_Model->insertNotification($array);
                if ($inserNotification) {

                    $sender_email = $this->getSingleValue($request->uid, 'user', 'email');
                    $sender_name = $this->getSingleValue($request->uid, 'user', 'name');

                    $reciever_email = $this->getSingleValue($request->receverId, 'user', 'email');
                    $reciever_name = $this->getSingleValue($request->receverId, 'user', 'name');

                    $site_title = $this->getdataSingleValue(22, 'front_setting', 'title_english', 'st');
                    $message = "Successfull Book Parking Place<br>";

                    $message1 = "Thanks For Book Parking Place<a href=" . base_url() . ">" . $site_title . "</a>.";
                    $datas['messages'] = array($sender_name, $message1);
                    $datas1['messages'] = array($reciever_name, $message);

                    $this->email($sender_email, "New Booking" . $site_title, $datas);
                    $this->email($reciever_email, "Success Full Parking" . $site_title, $datas1);
                } 
            }

//            $response = OpenPayU_Order::retrieve(stripslashes($resp));
//            print_r($response); die;
            if ($request->getStatus_transaction == 'SUCCESS') {

                $udata['user_id'] = $request->uid;
                $udata['txn_id'] = $request->properties_value;
                $udata['order_id'] = $request->orders_extOrderId;
                $udata['payment_amt'] = ($request->orders_totalAmount) / 100;
                $udata['currency_code'] = $request->orders_currencyCode;
                $udata['status'] = $request->orders_status;
                $udata['payment_type'] = '2';
                $udata['payment_mode'] = 'PayU';
                if ($this->Core_Model->InsertRecord('transactions', $udata)) {
                    $this->Core_Model->UpdateRecord('order', array("transaction_id" => $request->properties_value, "payment_status" => "2"), array("order_no" => $request->orders_extOrderId));

                    $this->res->status = "Your Order has been placed successfully";
                    $this->res->data = $data;
                }
            } else { 
                $this->res->status = "Payment Failed";
                $this->res->data = $data;
            }

            $this->_output();
            die();
        }
    }

    public function generateOrderNumber() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {

            $data = new stdClass();

            $order_no = $this->create_order_no(); //"ORDER_".uniqid();

            $amt = $request->amount;
            $fdate = $request->fdate;
            $ldate = $request->ldate;
            $spaceid = $request->spaceid;
            $vehicle_id = $request->vehicle_id;
            $amt = $amt;
            $uid = $request->uid;

            $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $spaceid), $orderby = array());

            $result = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $request->uid), $orderby = array());

            $udata['order_no'] = $order_no;
            $udata['amount'] = $amt;
            $udata['payment_type'] = $request->payment_method;
            $udata['user_id'] = $request->uid;
            $udata['seller_id'] = $space->uid;

            if ($request->payment_method == 'payu') {
                //print_r($udata); die;
                if ($lastid = $this->Core_Model->InsertRecord('order', $udata)) {

                    $odata['order_id'] = $order_no;
                    $odata['product_id'] = $spaceid;
                    $odata['amount'] = $amt;
                    $odata['qty'] = 1;

                    $this->Core_Model->InsertRecord('order_detail', $odata);

                    $date_from = strtotime($fdate); // Convert date to a UNIX timestamp  		  		 		
                    $date_to = strtotime($ldate); // Convert date to a UNIX timestamp  							  							
                    //for ($i = $date_from; $i <= $date_to; $i += 86400) {
                    $bdata['user_id'] = $request->uid;
                    $bdata['spaceid'] = $spaceid;
                    $bdata['vehicle_id'] = $vehicle_id;
                    //$bdata['bookdate'] = date("d-m-y", $i);
                    $bdata['booking_from'] = $date_from;
                    $bdata['booking_to'] = $date_to;
                    $bdata['status'] = 1;
                    $bdata['order_id'] = $order_no;
                    $last_insetedBookId = $this->Core_Model->InsertRecord('booking', $bdata);

                    if ($last_insetedBookId) {
                        $user = $this->Common_Model->getdata("booking", $where = array("id" => $last_insetedBookId), $sort = '');
                        if ($user) {

                            $this->res->status = 'success';
                            $this->res->bookingDetails = $user;
                            $this->res->orderid = $order_no;
                        } else {
                            
                        }
                    } else {
                        $this->res->status = 'Booking Failed';
                    }
                }
            }
            $this->_output();
            die();
        }
    }

    /*     * **************Start Order No.********************* */

    public function create_order_no() {
        $order = "ORDER_" . uniqid();
        if ($this->Core_Model->SelectRecord('order', '*', array("order_no" => $order), $orderby = array())) {
            $this->create_order_no();
        }
        return $order;
    }

    /*     * **************End Order No.********************* */

    public function addRentSpace() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {


            if ($request->accessmethod) {
                $accessmethod = implode(",", $request->accessmethod);
            }

            $driveway_feature = "";
            $garage_feature = "";
            $car_feature = "";
            $driveway_width = "";
            $car_height = "";

            if ($request->typeofspace == 'Driveway') {
                $driveway_width = $request->driveway_width;
                if ($request->driveway_feature) {
                    $driveway_feature = implode(",", $request->driveway_feature);
                }
            }

            if ($request->typeofspace == 'Garage') {
                if ($request->garage_feature) {
                    $garage_feature = implode(",", $request->garage_feature);
                }
            }

            if ($request->typeofspace == 'Car park') {
                $car_height = $request->car_height;
                if ($request->car_feature) {
                    $car_feature = implode(",", $request->car_feature);
                }
            }

            $latLong = $this->getLatLong($request->housename . ', ' . $request->address . ' ' . $request->city);
            //echo "<pre>"; print_r($latLong); die;
            $latitude = $latLong['latitude'] ? $latLong['latitude'] : '';
            $longitude = $latLong['longitude'] ? $latLong['longitude'] : '';

            $datas = array(
                "accessmethod" => $accessmethod,
                "fname" => $request->fname,
                "lname" => $request->lname,
                "driveway_feature" => $driveway_feature,
                "created_dt" => date("Y-m-d H:i:s"),
                "noofspace" => $request->noofspace,
                "country" => $request->country,
                "updated_dt" => date("Y-m-d H:i:s"),
                "state" => $request->state,
                "city" => $request->city,
                "address" => $request->address,
                "housename" => $request->housename,
                "description" => $request->description,
                "phone" => $request->phone,
                "accessdetail" => $request->accessdetail,
                "uid" => $request->uid,
                "driveway_owner" => $request->driveway_owner,
                "driveway_width" => $driveway_width,
                "typeofspace" => $request->typeofspace,
                "car_height" => $car_height,
                "code" => $request->code,
                "zipcode" => $request->zipcode,
                "car_feature" => $car_feature,
                "garage_feature" => $garage_feature,
                "lat" => $latitude,
                "lng" => $longitude,
                "nearby" => json_encode($request->nearby),
                "nearbydistance" => json_encode($request->nearbydistance)
            );

            $updt = $this->Common_Model->insert("rentourspace", $datas);

            if ($updt) {
                $this->res->status = "Rent space added successfully";
            } else {
                $this->res->status = "Error to add";
            }
            $this->_output();
            die();
        }
    }

    public function getCountry() {
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {


            $country = $this->Common_Model->getdata("countries", $where = "", $sort = 'countryName asc');
//            $data['user'] = $this->Common_Model->getdata("user", $where = array("id" => $this->session->userdata('uid')), $sort = '');
            if ($country) {
                $this->res->status = 'success';
                $this->res->data = $country;
            } else {
                $this->res->status = 'No Country Found';
                $this->res->data = 0;
            }

            $this->_output();
            die();
        }
    }

    public function bookingMadeDetails_post() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {

            $order = $this->Core_Model->joindataResult('o.order_no', 'od.order_id', array('o.user_id' => $request->user_id), 'o.*,od.product_id', 'order as o', 'order_detail as od', 'o.id desc');

            foreach ($order as $key => $row) {
                $booking = $this->Common_Model->getdata("booking", $where = array("order_id" => $row['order_no']), $sort = '');
                $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $row['product_id']), $orderby = array());
                $datee = [];
                foreach ($booking as $val) {
                    $datee[] = $val->bookdate;
                    $booking_from = $val->booking_from;
                    $booking_to = $val->booking_to;
                    $vehicle = $val->vehicle_id;
                }
                $order[$key]['booking_from'] = $booking_from;
                $order[$key]['booking_to'] = $booking_to;
                $vehicles = $this->Core_Model->SelectSingleRecord('vehicle', '*', array("id" => $vehicle), $orderby = array());

                $order[$key]['vehicle_id'] = ($vehicles->isHired) ? "Car" . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license : $vehicles->vehicle_type . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license;
                $order[$key]['typeofspace'] = $space->typeofspace . ' on ' . $space->address;

                $user = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $row['seller_id']), $orderby = array());
                if ($user) {
                    $order[$key]['sid'] = $user->id;
                    $order[$key]['user'] = $user->name;
                    $order[$key]['email'] = $user->email;
                    $order[$key]['contact'] = $user->contact;
                }
            }
            $bookingmade = $order;
            if ($bookingmade) {
                $this->res->status = 'success';
                $this->res->data = $bookingmade;
            } else {
                $this->res->status = 'No Booking Made';
                $this->res->data = 0;
            }



            $this->_output();
            die();
        }
    }

    public function recievedBookingDetails_post() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {

            $order = $this->Core_Model->joindataResult('o.order_no', 'od.order_id', array('o.seller_id' => $request->user_id), 'o.*,od.product_id', 'order as o', 'order_detail as od', 'o.id desc');

            foreach ($order as $key => $row) {
                $booking = $this->Common_Model->getdata("booking", $where = array("order_id" => $row['order_no']), $sort = '');
                $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $row['product_id']), $orderby = array());
                $datee = [];
                foreach ($booking as $val) {
                    $datee[] = $val->bookdate;
                    $booking_from = $val->booking_from;
                    $booking_to = $val->booking_to;
                    $vehicle = $val->vehicle_id;
                }
                $order[$key]['booking_from'] = $booking_from;
                $order[$key]['booking_to'] = $booking_to;
                $vehicles = $this->Core_Model->SelectSingleRecord('vehicle', '*', array("id" => $vehicle), $orderby = array());
                $user = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $row['user_id']), $orderby = array());
                $order[$key]['vehicle_id'] = ($vehicles->isHired) ? "Car" . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license : $vehicles->vehicle_type . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license;
                $order[$key]['typeofspace'] = $space->typeofspace . ' on ' . $space->address;
                $order[$key]['sid'] = $user->id;
                $order[$key]['user'] = $user->name;
                $order[$key]['email'] = $user->email;
                $order[$key]['contact'] = $user->contact;
            }

            $recievedBookingCount = $order;

            if ($recievedBookingCount) {
                $this->res->status = 'success';
                $this->res->data = $recievedBookingCount;
            } else {
                $this->res->status = 'No Booking Recieved';
                $this->res->data = 0;
            }


            $this->_output();
            die();
        }
    }

    public function bookingMadeRecieveSpaceCount() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {
            //Booking Made
            $order = $this->Core_Model->joindataResult('o.order_no', 'od.order_id', array('o.user_id' => $request->user_id), 'o.*,od.product_id', 'order as o', 'order_detail as od', 'o.id desc');

            foreach ($order as $key => $row) {
                $booking = $this->Common_Model->getdata("booking", $where = array("order_id" => $row['order_no']), $sort = '');
                $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $row['product_id']), $orderby = array());
                $datee = [];
                foreach ($booking as $val) {
                    $datee[] = $val->bookdate;
                    $booking_from = $val->booking_from;
                    $booking_to = $val->booking_to;
                    $vehicle = $val->vehicle_id;
                }
                $order[$key]['booking_from'] = $booking_from;
                $order[$key]['booking_to'] = $booking_to;
                $vehicles = $this->Core_Model->SelectSingleRecord('vehicle', '*', array("id" => $vehicle), $orderby = array());

                $order[$key]['vehicle_id'] = ($vehicles->isHired) ? "Car" . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license : $vehicles->vehicle_type . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license;
                $order[$key]['typeofspace'] = $space->typeofspace . ' on ' . $space->address;

                $user = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $row['seller_id']), $orderby = array());
                if ($user) {
                    $order[$key]['sid'] = $user->id;
                    $order[$key]['user'] = $user->name;
                    $order[$key]['email'] = $user->email;
                    $order[$key]['contact'] = $user->contact;
                }
            }

//echo "<pre>"; print_r($order); die;
            $bookingmade = $order;

            $count = 0;
            if (!empty($bookingmade)) {
                foreach ($bookingmade as $book) {
                    if (!empty($book['dates'])) {
                        $count++;
                    }
                }
            }
            $bookingCount = count($bookingmade);

            //End Booking Made
            //Booking Recieve
            $order = $this->Core_Model->joindataResult('o.order_no', 'od.order_id', array('o.seller_id' => $request->user_id), 'o.*,od.product_id', 'order as o', 'order_detail as od', 'o.id desc');

            foreach ($order as $key => $row) {
                $booking = $this->Common_Model->getdata("booking", $where = array("order_id" => $row['order_no']), $sort = '');
                $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $row['product_id']), $orderby = array());
                $datee = [];
                foreach ($booking as $val) {
                    $datee[] = $val->bookdate;
                    $booking_from = $val->booking_from;
                    $booking_to = $val->booking_to;
                    $vehicle = $val->vehicle_id;
                }
                $order[$key]['booking_from'] = $booking_from;
                $order[$key]['booking_to'] = $booking_to;
                $vehicles = $this->Core_Model->SelectSingleRecord('vehicle', '*', array("id" => $vehicle), $orderby = array());
                $user = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $row['user_id']), $orderby = array());
                $order[$key]['vehicle_id'] = ($vehicles->isHired) ? "Car" . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license : $vehicles->vehicle_type . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license;
                $order[$key]['typeofspace'] = $space->typeofspace . ' on ' . $space->address;
                $order[$key]['sid'] = $user->id;
                $order[$key]['user'] = $user->name;
                $order[$key]['email'] = $user->email;
                $order[$key]['contact'] = $user->contact;
            }

            $recievedBookingCount = count($order);

            //End Booking Recieve
            //Space Count
            $space = $this->Common_Model->getdata("rentourspace", $where = array("uid" => $request->user_id), $sort = '');
            $spacecount = count($space);
            //End Space Count


            if ($spacecount || $recievedBookingCount || $bookingCount) {
                $this->res->status = 'success';
                $this->res->spaceCount = ($spacecount) ? ($spacecount) : (0);
                $this->res->bookingRecieve = ($recievedBookingCount) ? ($recievedBookingCount) : (0);
                $this->res->bookingMade = ($bookingCount) ? ($bookingCount) : (0);
            } else {
                $this->res->status = 'No Space Available';
            }


            $this->_output();
            die();
        }
    }

    public function numberOfSpace_post() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {
            $space = $this->Common_Model->getdata("rentourspace", $where = array("uid" => $request->user_id), $sort = '');
            $spacecount = count($space);

            if ($spacecount) {
                $this->res->status = 'success';
                $this->res->data = $spacecount;
            } else {
                $this->res->status = 'No Space Available';
                $this->res->data = 0;
            }


            $this->_output();
            die();
        }
    }

    public function recievedBooking_post() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {

            $order = $this->Core_Model->joindataResult('o.order_no', 'od.order_id', array('o.seller_id' => $request->user_id), 'o.*,od.product_id', 'order as o', 'order_detail as od', 'o.id desc');

            foreach ($order as $key => $row) {
                $booking = $this->Common_Model->getdata("booking", $where = array("order_id" => $row['order_no']), $sort = '');
                $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $row['product_id']), $orderby = array());
                $datee = [];
                foreach ($booking as $val) {
                    $datee[] = $val->bookdate;
                    $booking_from = $val->booking_from;
                    $booking_to = $val->booking_to;
                    $vehicle = $val->vehicle_id;
                }
                $order[$key]['booking_from'] = $booking_from;
                $order[$key]['booking_to'] = $booking_to;
                $vehicles = $this->Core_Model->SelectSingleRecord('vehicle', '*', array("id" => $vehicle), $orderby = array());
                $user = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $row['user_id']), $orderby = array());
                $order[$key]['vehicle_id'] = ($vehicles->isHired) ? "Car" . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license : $vehicles->vehicle_type . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license;
                $order[$key]['typeofspace'] = $space->typeofspace . ' on ' . $space->address;
                $order[$key]['sid'] = $user->id;
                $order[$key]['user'] = $user->name;
                $order[$key]['email'] = $user->email;
                $order[$key]['contact'] = $user->contact;
            }

            $recievedBookingCount = count($order);

            if ($recievedBookingCount) {
                $this->res->status = 'success';
                $this->res->data = $recievedBookingCount;
            } else {
                $this->res->status = 'No Booking Recieved';
                $this->res->data = 0;
            }


            $this->_output();
            die();
        }
    }

    public function bookingMade_post() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {

            $order = $this->Core_Model->joindataResult('o.order_no', 'od.order_id', array('o.user_id' => $request->user_id), 'o.*,od.product_id', 'order as o', 'order_detail as od', 'o.id desc');

            foreach ($order as $key => $row) {
                $booking = $this->Common_Model->getdata("booking", $where = array("order_id" => $row['order_no']), $sort = '');
                $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $row['product_id']), $orderby = array());
                $datee = [];
                foreach ($booking as $val) {
                    $datee[] = $val->bookdate;
                    $booking_from = $val->booking_from;
                    $booking_to = $val->booking_to;
                    $vehicle = $val->vehicle_id;
                }
                $order[$key]['booking_from'] = $booking_from;
                $order[$key]['booking_to'] = $booking_to;
                $vehicles = $this->Core_Model->SelectSingleRecord('vehicle', '*', array("id" => $vehicle), $orderby = array());

                $order[$key]['vehicle_id'] = ($vehicles->isHired) ? "Car" . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license : $vehicles->vehicle_type . ' ' . $vehicles->vehicle_model . ' ' . $vehicles->license;
                $order[$key]['typeofspace'] = $space->typeofspace . ' on ' . $space->address;

                $user = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $row['seller_id']), $orderby = array());
                if ($user) {
                    $order[$key]['sid'] = $user->id;
                    $order[$key]['user'] = $user->name;
                    $order[$key]['email'] = $user->email;
                    $order[$key]['contact'] = $user->contact;
                }
            }

//echo "<pre>"; print_r($order); die;
            $bookingmade = $order;

            $count = 0;
            if (!empty($bookingmade)) {
                foreach ($bookingmade as $book) {
                    if (!empty($book['dates'])) {
                        $count++;
                    }
                }
            }
            $bookingCount = count($bookingmade);
            if ($bookingCount) {
                $this->res->status = 'success';
                $this->res->data = $bookingCount;
            } else {
                $this->res->status = 'No Booking Made';
                $this->res->data = 0;
            }



            $this->_output();
            die();
        }
    }

    public function getVehicleBasedOnUseID_post() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
        if ($request) {
            $vehicles = $this->Common_Model->getdata("vehicle", $where = array("user_id" => $request->user_id), $sort = '');
            if ($vehicles) {
                $this->res->status = 'success';
                $this->res->data = $vehicles;
            } else {
                $this->res->status = 'Sorry! Vehicle Not Available';
            }
        }
        $this->_output();
        die();
    }

    public function addVehicle_post() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

        if ($request) {

            if ($request->isHired) {
                $isHired = 1;
            } else {
                $isHired = 0;
            }

            $datas['license'] = $request->license;
            $datas['vehicle_type'] = $request->vehicle_type;
            $datas['vehicle_make'] = $request->vehicle_make;
            $datas['vehicle_model'] = $request->vehicle_model;
            $datas['isHired'] = $isHired;
            $datas['hire_company'] = $request->hire_company;
            $datas['user_id'] = $request->user_id;
            $datas['created_at'] = date('Y-m-d H:i:s');


            $lastid = $this->Common_Model->insert("vehicle", $datas);

            if ($lastid) {
                $this->res->status = "Vehicle added successfully";
            } else {
                $this->res->status = "Error to update";
            }
        }
        $this->_output();
        die();
    }

    public function updateProfile_post() {

        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

        if (!empty($request)) {

            $WhereData = array('id' => $request->id);
            if ($request->id) {
                $array_data = array(
                    'email' => $request->email,
                    'name' => $request->name,
                    'password' => $request->password,
                    'updated_dt' => date('Y-m-d H:i:s'),
                );

                $aray_login = $this->Core_Model->UpdateRecord('user', $array_data, $WhereData);
                if ($aray_login) {
                    $this->res->status = 'Profile Successfully Updated!';
                } else {
                    $this->res->status = 'Sorry! For nterruption';
                }
                $this->_output();
                die();
            }
        }
    }

    public function loginWithFaceBook_post() {
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

        if (!empty($request)) {
            $array_data = array(
                'email' => $request->email,
                'name' => $request->name,
                'photo' => $request->photo,
                'ophoto' => $request->ophoto,
                'facebook' => $request->facebook,
                'google' => $request->google,
                'online' => 0,
                'created_dt' => date('Y-m-d H:i:s'),
                'email_status' => 1,
                'type' => 'user',
                'fb' => 1
            );

            $last_insertedId = $this->Core_Model->InsertRecord('user', $request);

            $WhereData = array(
                'id' => $last_insertedId,
            );

            $aray_login = $this->Core_Model->SelectSingleRecord('user', 'id,email,photo,facebook,google,online,created_dt', $WhereData, '');
            if ($aray_login) {
                $this->res->status = 'success';
                $this->res->data = $aray_login;
            } else {
                $this->res->status = 'Sorry! For interruption';
            }
            $this->_output();
            die();
        }
    }

    public function checkSpaceVailibility_post() {
//print "CONTENT_TYPE: " . $_SERVER['CONTENT_TYPE']; die;
        $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
//echo "hhhhlll"; die;

        $dropoff = $request->fdate;
        $pickup = $request->ldate;
        $id = $request->spaceid;
        $user = '';
        if ($id != '' && $dropoff != '' && $pickup != '') {
            $date_from = strtotime($dropoff); // Convert date to a UNIX timestamp  

            $date_to = strtotime($pickup); // Convert date to a UNIX timestamp  
// Loop from the start date to end date and output all dates inbetween
            $days = [];
            $dates = [];
            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $days[] = date("N", $i);
                $dates[] = date("d-m-y", $i);
            }

            $spaces = $this->Common_Model->getdata("rentourspace", $where = array("id" => $id), $sort = '');

            $weekdays = [];
            $available_space = [];
            if (!empty($spaces)) {
                foreach ($spaces as $spc) {
                    $count = 0;
                    $countt = 0;
                    $counttt = 0;
                    if ($spc->week) {
                        $weekdays = explode(',', $spc->week);
                        foreach ($days as $row) {
                            if (in_array($row, $weekdays)) {
                                $count++;
                            }
                        }
                    }

                    $dayss = [];
                    $daysss = [];
                    $totalspace = $spc->noofspace;
                    $user = $this->Common_Model->getdata("user", $where = array("id" => $spc->uid), $sort = '');

                    if ($spc->availability) {
                        $avail = explode(';', $spc->availability);

                        $flag = 0;
                        $flag1 = 0;
                        foreach ($avail as $avl) {
                            if ($avl) {
                                $av = explode(',', $avl);
                                if ($av[3] == 1) {

                                    if (($date_from < strtotime($av[0])) && ($date_to > strtotime($av[0]))) {
                                        $flag += 1;
                                        if (($spc->noofspace - $av[2]) == 0) {
                                            $totalspace = 0;
                                        }
                                    }
                                    if (($date_from > strtotime($av[0])) && ($date_to < strtotime($av[1]))) {
                                        $flag += 1;
                                        if (($spc->noofspace - $av[2]) == 0) {
                                            $totalspace = 0;
                                        }
                                    }
                                    if (($date_from > strtotime($av[0])) && ($date_from < strtotime($av[1])) && ($date_to > strtotime($av[1]))) {
                                        $flag += 1;
                                        if (($spc->noofspace - $av[2]) == 0) {
                                            $totalspace = 0;
                                        }
                                    }
                                    if ($date_to < strtotime($av[0])) {
                                        $flag += 0;
                                    }
                                    if ($date_from > strtotime($av[1])) {
                                        $flag += 0;
                                    }

//if( ($spc->noofspace - $av[2]) == 0){
//	$totalspace = 0;
//}								
                                }
                                if ($av[3] == 2) {
                                    if (($date_from > strtotime($av[0])) && ($date_to < strtotime($av[1]))) {
                                        $flag1 += 1;
                                        $totalspace = $av[2];
                                    }
                                }
                            }
                        }

                        if ($flag == 0 || $totalspace > 0) {
                            if ($count == count($days) || $flag1 >= 1) {
                                $total_booking = 0;
                                $res = $this->Common_Model->getdata("booking", $where = array("spaceid" => $spc->id, "booking_from <=" => $date_from, "booking_to >=" => $date_from, "status" => 1), $sort = '');
                                $res1 = $this->Common_Model->getdata("booking", $where = array("spaceid" => $spc->id, "booking_from <=" => $date_to, "booking_to >=" => $date_to, "status" => 1), $sort = '');

                                $total_booking = count($res);
                                $total_booking1 = count($res1);

                                $total = ($total_booking > $total_booking1) ? $total_booking : $total_booking1;

//echo $totalspace;
                                if (($totalspace - $total) > 0) {
                                    $available_space[] = $spc;
                                }
                            }
                        }
                    }
                }
            }


            if (count($available_space)) {
                $this->res->status = 'Space Available';
                $this->res->data = $user;
            } else {
                $this->res->status = 'Space Not Available';
            }
        } else {
            $this->res->status = 'Please Select Date';
        }

        $this->_output();
        die();
    }

    public function User($request) {
        switch ($request) {

            case 'facebooksignup':
//print "CONTENT_TYPE: " . $_SERVER['CONTENT_TYPE']; die;
                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
//echo "hhhhlll"; die;
//$fname = $request->firstname;
//$lname = $request->lastname;
//var_dump($request); die;
                $email = $request->email;

                if (!$email) {
                    $this->_error('Form error', 'Email is not specified.');
                }

                if ($this->email_check($email)) {
                    $where_login = array('email' => $email);
                    $aray_login = $this->Core_Model->getsingle('les_user', $where_login, '*');
                    $this->res->status = 'success';
                    $this->res->data = $aray_login;
                } else {
                    $insert_array = array(
                        'email' => $email,
                        'regis_date' => date('Y-m-d H:i:s')
                    );

                    $signup_insert = $this->Core_Model->InsertRecord('les_user', $insert_array);
                    $this->res->status = 'success';
                    $where_login = array('email' => $email);
                    $aray_login = $this->Core_Model->getsingle('les_user', $where_login, '*');
                    $this->res->data = $aray_login;
                }
                $this->_output();
                die();
                break;




            case 'signup':
                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $name = $request->username;
                $email = $request->email;
                $password = $request->password;


                if (!$name) {
                    $this->_error('Form error', 'User name is not specified.');
                }

                if (!$email) {
                    $this->_error('Form error', 'Email is not specified.');
                }

                if (!$password) {
                    $this->_error('Form error', 'Password is not specified.');
                }

                if ($this->email_check($email)) {
                    $this->_error('Form error', 'Email already exists.');
                } else {
                    $insert_array = array(
                        'username' => $name,
                        'email' => $email,
                        'password' => md5($password),
                        'created_dt' => date('Y-m-d H:i:s'),
                        'updated_dt' => date('Y-m-d H:i:s'),
                        'type' => "User",
                        'email_status' => '1'
                    );

                    $id = $this->Core_Model->InsertRecord('user', $insert_array);

                    if ($id) {
//$ids=base64_encode($id);
//$site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
//$message="Thanks for creating account with us at <a href=".base_url().">".$site_title."</a>. <br>
//<a href='".base_url()."Verify/account/".$ids."'>Verify Email</a><br>
//To get started, please confirm your email address so that we know your details are correct.";
//
                        //$datas['messages']=array($name,$message);
//
                        //$this->email($email,"Registration at ".$site_title,$datas);
                        $this->res->status = 'success';
                    } else {
                        $this->_error('Form error', 'Error in registration.');
                    }
                }
                $this->_output();
                die();
                break;
// Log in...
            case 'signin':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $email_id = $request->email;
                $pass = $request->password;

                if (!$email_id) {
                    $this->_error('Form error', 'Email-Id is not specified.');
                }

                if (!$pass) {
                    $this->_error('Form error', 'Password is not specified.');
                }

                $where_login = array('email' => $email_id, 'password' => md5($pass), 'email_status' => '1');
                $aray_login = $this->Core_Model->selectsinglerecord('user', '*', $where_login);

                if (empty($aray_login)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Incorrect Email Id & Password.');
                } else {
                    $this->res->status = 'Success';
                    $this->res->data = $aray_login;
                }
                $this->_output();
                die();
                break;
// for change password...
            case 'changepass':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $email = $request->email;
                $old_pass = $request->old_pass;
                $cnfrm_pass = $request->confrm_pass;

                if (!$email) {
                    $this->_error('Form error', 'Email-Id is not specified.');
                }

                if (!$old_pass) {
                    $this->_error('Form error', 'Old Password is not specified.');
                }

                if (!$cnfrm_pass) {
                    $this->_error('Form error', 'Confirm Password is not specified.');
                }

                $where_pass = array('email' => $email);
                $field_pass = array('email', 'password');

                $change_pass = $this->Core_Model->getsingle('les_user', $where_pass, $field_pass);

                $fetch_pass = $change_pass->password;

                if ($fetch_pass == $old_pass) {
                    $where_change = array('email' => $email);
                    $field_change = array(
                        'password' => $cnfrm_pass
                    );
                    $this->Core_Model->updateFields('les_user', $field_change, $where_change);
                    $this->res->status = 'Success';
                } else {
                    $this->res->status = 'Failed';
                }
                break;
// forgot password...
            case 'forgotpass':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $email_id = $request->email;

                if (!$email_id) {
                    $this->_error('Form error', 'Email-Id is not specified.');
                }
                $where_forgot = array('email' => $email_id);
                $field_forgot = array('email');

                $forgot_password = $this->Core_Model->getsingle('les_user', $where_forgot, $field_forgot);

                if ($forgot_password != 'no record found') {
                    $genrt_pass = rand(1000, 9999);
                    $where = array('email' => $email_id);
                    $field = array(
                        'password' => $genrt_pass
                    );
                    $this->Core_Model->updateFields('les_user', $field, $where);
                    $this->res->status = 'Success';
                } else {
                    $this->res->status = 'Fail';
                }
                break;
            /*             * **********In dashboard************** */
// manage_profile
            case 'manageprofile':
                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

                $email = $request->email;

                if (!$email) {
                    $this->_error('Form error', 'Email-Id is not specified.');
                }

                $where_profile = array('email' => $email);
                $field_profile = array('*');
                $get_record = $this->Core_Model->getsingle('les_user', $where_profile, $field_profile);

                if ($get_record != '$get_record') {

                    $this->res->status = 'Success';
                    $this->res->data = $get_record;
                } else {
                    $this->res->status = 'Fail';
                }
                break;

            case 'updateprofile':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $name = $request->fname;
                $email = $request->email;
                $cntnumber = $request->cuntactnum;

                if (!$name) {
                    $this->_error('Form error', 'Name  is not specified.');
                }

                if (!$email) {
                    $this->_error('Form error', 'Email-Id is not specified.');
                }

                if (!$cntnumber) {
                    $this->_error('Form error', 'Contact Number is not specified.');
                }

                $where_profile = array('email' => $email);
                $field_profile = array('first_name', 'email', 'phone');
                $get_record = $this->Core_Model->getsingle('les_user', $where_profile, $field_profile);

//update
                if ($get_record != 'no record found') {
                    $where_update = array('email' => $email);
                    $field_update = array(
                        'first_name' => $name,
                        'email' => $email,
                        'phone' => $cntnumber
                    );

                    $this->Core_Model->updateFields('les_user', $field_update, $where_update);
                    $this->res->status = 'Success';
//  $this->res->data = $get_record;
                } else {
                    $this->res->status = 'Error';
                }
                break;

            case 'login_by_media':
                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

                $parent_category = $request->parent_category;


                $this->_output();
                die();
                break;

            default:
                $this->_error('Invalid request', 'User request is invalid');
                break;
        }
        $this->_output();
    }

    public function Search($request) {
        switch ($request) {

            case 'get_parking_spaces':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $address = $request->address;
                $checkin = $request->checkin;
                $checkout = $request->checkout;

                if (!$address) {
                    $this->_error('Form error', 'Address  is not specified.');
                }
                if (!$checkin) {
                    $this->_error('Form error', 'Pickup Date is not specified.');
                }
                if (!$checkout) {
                    $this->_error('Form error', 'Dropoff Date is not specified.');
                }



                $datas['checkin'] = $checkin;
                $datas['checkout'] = $checkout;

                $date_from = strtotime($checkin); // Convert date to a UNIX timestamp  

                $date_to = strtotime($checkout); // Convert date to a UNIX timestamp  
//echo date('Y-m-d h:i:s',$date_from); 
// Loop from the start date to end date and output all dates inbetween
                $days = [];
                $dates = [];
                for ($i = $date_from; $i <= $date_to; $i += 86400) {
                    $days[] = date("N", $i);
                    $dates[] = date("d-m-y", $i);
                }
//print_r($days); die;		
                $latLong = $this->getLatLong($address);
//echo "<pre>"; print_r($latLong); die;
                $latitude = $latLong['latitude'] ? $latLong['latitude'] : '-';
                $longitude = $latLong['longitude'] ? $latLong['longitude'] : '-';
//$spaces = $this->Common_Model->getdata("rentourspace",$where=array(),$sort='');
                if ($latitude != '-' && $longitude != '') {
                    $spaces = $this->Search_Model->getNearbySpaces($latitude, $longitude);
                } else {
                    $spaces = [];
                }

//echo "<pre>"; print_r($spaces); die;
                $weekdays = [];
                $available_space = [];
                if (!empty($spaces)) {
                    foreach ($spaces as $spc) {
                        $count = 0;
                        $countt = 0;
                        $counttt = 0;
                        if ($spc['week']) {
                            $weekdays = explode(',', $spc['week']);
                            foreach ($days as $row) {
                                if (in_array($row, $weekdays)) {
                                    $count++;
                                }
                            }
                        }
//echo $count; die;
                        $dayss = [];
                        $daysss = [];
                        $totalspace = $spc['noofspace'];
                        //if ($spc['availability']) {
                            $avail = explode(';', $spc['availability']);
//print_r($avail);
                            $flag = 0;
                            $flag1 = 0;
                            foreach ($avail as $avl) {
                                if ($avl) {
                                    $av = explode(',', $avl);
                                    if ($av[3] == 1) {

                                        if (($date_from < strtotime($av[0])) && ($date_to > strtotime($av[0]))) {
                                            $flag += 1;
                                        }
                                        if (($date_from > strtotime($av[0])) && ($date_to < strtotime($av[1]))) {
                                            $flag += 1;
                                        }
                                        if (($date_from > strtotime($av[0])) && ($date_from < strtotime($av[1])) && ($date_to > strtotime($av[1]))) {
                                            $flag += 1;
                                        }
                                        if ($date_to < strtotime($av[0])) {
                                            $flag += 0;
                                        }
                                        if ($date_from > strtotime($av[1])) {
                                            $flag += 0;
                                        }

                                        if (($spc['noofspace'] - $av[2]) == 0) {
                                            $totalspace = 0;
                                        }
                                    }
                                    if ($av[3] == 2) {
                                        if (($date_from > strtotime($av[0])) && ($date_to < strtotime($av[1]))) {
                                            $flag1 += 1;
                                            $totalspace = $av[2];
                                        }
                                    }
                                }
                            }
//echo $flag;
//echo $totalspace;
//echo $count;
//echo count($days);
                            if ($flag == 0 || $totalspace > 0) {
                                if ($count == count($days) || $flag1 >= 1) {
                                    $total_booking = 0;
                                    $res = $this->Common_Model->getdata("booking", $where = array("spaceid" => $spc['id'], "booking_from <=" => $date_from, "booking_to >=" => $date_from, "status" => 1), $sort = '');
                                    $res1 = $this->Common_Model->getdata("booking", $where = array("spaceid" => $spc['id'], "booking_from <=" => $date_to, "booking_to >=" => $date_to, "status" => 1), $sort = '');

                                    $total_booking = count($res);
                                    $total_booking1 = count($res1);

                                    $total = ($total_booking > $total_booking1) ? $total_booking : $total_booking1;

//echo $totalspace;
                                    if (($totalspace - $total) > 0) {
                                        $available_space[] = $spc;
                                    }
                                }
                            }
                        //}
                    }
                }
                
                $unavailable = [];
                foreach($spaces as $s){
                    if(!in_array($s,$available_space)){
                        $unavailable[] = $s;
                    }
                }
                //echo "<pre>"; print_r($available_space); die;
                $datas['unavailable_space'] = $unavailable;
//echo "<pre>"; print_r($available_space); die;
                $datas['spaces'] = $available_space;
                $datas['lat'] = $latitude;
                $datas['long'] = $longitude;
//echo "<pre>"; print_r($datas); die;

                if (isset($available_space)) {
                    $this->res->status = 'success';
                    $this->res->data = $datas;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            case 'get_child_category_from_parent':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $parent_id = $request->parent_id;
                $get_child_category = $this->Core_Model->getAllwherenew('les_category', array('cat_parent_id' => $parent_id), '*');
                if ($get_child_category != 'no') {

                    foreach ($get_child_category as $child) {
                        $x = 'http://kabayanzone.ae/category_images/original/' . $child->cat_picture;
                        $child->image_url = $x;
                        $repd[] = $child;
                    }
                    $req_data = json_encode($repd);
                    $req_data = json_decode($req_data);

                    $this->res->status = 'success';
                    $this->res->data = $req_data;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->res->status = 'success';
                $this->res->data = $get_child_category;
                $this->_output();
                die();
                break;

            case 'get_special_dishes_category':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $special_cat_id = $request->special_cat_id;
                $get_parent_category = $this->Core_Model->getAllwherenew('les_category', array('cat_parent_id =' => $special_cat_id), '*');
                if ($get_parent_category != 'no') {

                    foreach ($get_parent_category as $special) {
                        $x = 'http://kabayanzone.ae/category_images/original/' . $special->cat_picture;
                        $special->image_url = $x;
                        $repd[] = $special;
                    }
                    $req_data = json_encode($repd);
                    $req_data = json_decode($req_data);

                    $this->res->status = 'success';
                    $this->res->data = $req_data;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            default:
                $this->_error('Invalid request', 'User request is invalid');
                break;
        }
        $this->_output();
    }

    public function getLatLong($address) {
        if (!empty($address)) {
//Formatted address
            $formattedAddr = str_replace(' ', '+', $address);
//Send request and receive json data by address
            $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddr . '&sensor=false&key=AIzaSyCCQzJ9DJLTRjrxLkRk6jaSrvcc5BfDtWM');
            $output = json_decode($geocodeFromAddr);
//echo "<pre>"; print_r($output); die;
//Get latitude and longitute from json data
            if (isset($output->results) && !empty($output->results)) {
                $data['latitude'] = $output->results[0]->geometry->location->lat;
                $data['longitude'] = $output->results[0]->geometry->location->lng;
            }
//Return latitude and longitude of the given address
            if (!empty($data)) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function Category($request) {
        switch ($request) {

            case 'get_parent_category':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $cat_parent_id = $request->cat_parent_id;
                $get_parent_category = $this->Core_Model->getAllwherenew('les_category', array('cat_parent_id =' => $cat_parent_id), '*');
                if ($get_parent_category != 'no') {

                    foreach ($get_parent_category as $get_parent) {
                        $x = 'http://kabayanzone.ae/category_images/original/' . $get_parent->cat_picture;
                        $get_parent->image_url = $x;
                        $repd[] = $get_parent;
                    }
                    $req_data = json_encode($repd);
                    $req_data = json_decode($req_data);
                    $this->res->status = 'success';
                    $this->res->data = $req_data;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            case 'get_child_category_from_parent':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $parent_id = $request->parent_id;
                $get_child_category = $this->Core_Model->getAllwherenew('les_category', array('cat_parent_id' => $parent_id), '*');
                if ($get_child_category != 'no') {

                    foreach ($get_child_category as $child) {
                        $x = 'http://kabayanzone.ae/category_images/original/' . $child->cat_picture;
                        $child->image_url = $x;
                        $repd[] = $child;
                    }
                    $req_data = json_encode($repd);
                    $req_data = json_decode($req_data);

                    $this->res->status = 'success';
                    $this->res->data = $req_data;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->res->status = 'success';
                $this->res->data = $get_child_category;
                $this->_output();
                die();
                break;

            case 'get_special_dishes_category':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $special_cat_id = $request->special_cat_id;
                $get_parent_category = $this->Core_Model->getAllwherenew('les_category', array('cat_parent_id =' => $special_cat_id), '*');
                if ($get_parent_category != 'no') {

                    foreach ($get_parent_category as $special) {
                        $x = 'http://kabayanzone.ae/category_images/original/' . $special->cat_picture;
                        $special->image_url = $x;
                        $repd[] = $special;
                    }
                    $req_data = json_encode($repd);
                    $req_data = json_decode($req_data);

                    $this->res->status = 'success';
                    $this->res->data = $req_data;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            default:
                $this->_error('Invalid request', 'User request is invalid');
                break;
        }
        $this->_output();
    }

    public function Product($request) {
        switch ($request) {

            case 'get_product_from_category':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $category_id = $request->category_id;
                $get_product_from_category = $this->Core_Model->getAllwherenew('les_products', array('cat_id' => $category_id), '*');
//print_r($get_product_from_category); die;
                if ($get_product_from_category != 'no') {

                    foreach ($get_product_from_category as $get_product) {
                        $x = 'http://kabayanzone.ae/product_images/original/' . blog_single_image($get_product->product_image);
                        $get_product->image_url = $x;
                        $repd[] = $get_product;
                    }
                    $req_data = json_encode($repd);
                    $req_data = json_decode($req_data);

                    $this->res->status = 'success';
                    $this->res->data = $get_product_from_category;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            case 'get_product_from_special_category':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $special_category_id = $request->special_category_id;
                $get_product_from_category = $this->Core_Model->getAllwherenew('les_products', array('cat_id' => $special_category_id, 'is_new' => 4), '*');
                if ($get_product_from_category != 'no') {

                    foreach ($get_product_from_category as $get_product) {
                        $x = 'http://kabayanzone.ae/product_images/original/' . blog_single_image($get_product->product_image);
                        $get_product->image_url = $x;
                        $repd[] = $get_product;
                    }
                    $req_data = json_encode($repd);
                    $req_data = json_decode($req_data);

                    $this->res->status = 'success';
                    $this->res->data = $get_product_from_category;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            case 'add_products_on_user_cart':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $user_id = $request->user_id;
//$comment = $request->comment;

                $user_cart = $request->user_cart;
                $current_date = date('Y-m-d H:i:s');
//print_r($user_cart);
// exit;
                if (empty($user_id) || empty($user_cart)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide all information.');
                }

//$array = array('billing_address' => $comment);
//$this->common_model->update_entry('les_shipping_details', $array, array('user_id' => $user_id));
                $cart_data = $this->common_model->get_entry_by_data('cart', true, array('user_id' => $user_id));
//print_r($cart_data);exit;
                if ($cart_data) {

                    $cart_key = $cart_data['cart_key'];

                    if (!empty($user_cart) && count($user_cart) > 0) {
                        foreach ($user_cart as $c_value) {
                            $product_id = $c_value->product_id;

                            $full_price = (!empty($c_value->full_price)) ? $c_value->full_price : '';
                            $half_price = (!empty($c_value->half_price)) ? $c_value->half_price : '';
                            $full_quntity = (!empty($c_value->full_quntity)) ? $c_value->full_quntity : '0';
                            $half_quntity = (!empty($c_value->half_quntity)) ? $c_value->half_quntity : '0';
                            $comment = (!empty($c_value->comment)) ? $c_value->comment : '';

                            $if_exists = $this->common_model->get_entry_by_data('cart', true, array('user_id' => $user_id, 'product_id' => $product_id));
//print_r($if_exists);exit;
                            if ($if_exists) {
                                $new_quantity_full = $if_exists['full_quntity'] + $full_quntity;
                                $new_quantity_half = $if_exists['half_quntity'] + $half_quntity;

                                $new_total_amount_full = $new_quantity_full * $full_price;
                                $new_total_amount_half = $new_quantity_half * $half_price;
                                if (!empty($full_price) && !empty($full_quntity)) {
                                    $cart_upd_array = array(
                                        'full_price' => $full_price,
                                        'full_quntity' => $new_quantity_full,
                                        'total_amount' => $new_total_amount_full,
                                        'date_added' => $current_date,
                                        'comment' => $comment
                                    );
                                } elseif (!empty($half_price) && !empty($half_quntity)) {
                                    $cart_upd_array = array(
                                        'half_price' => $half_price,
                                        'half_quntity' => $new_quantity_half,
                                        'total_amount' => $new_total_amount_half,
                                        'date_added' => $current_date,
                                        'comment' => $comment
                                    );
                                }

                                $this->common_model->update_entry('cart', $cart_upd_array, array('user_id' => $user_id, 'product_id' => $product_id));
                            } else {

                                if (!empty($full_price) && !empty($full_quntity)) {
                                    $db_cart_array = array(
                                        'user_id' => $user_id,
                                        'cart_key' => $cart_key,
                                        'item_key' => md5(random_string('alnum', 10)),
                                        'product_id' => $c_value->product_id,
                                        'product_name' => $c_value->product_name,
                                        'full_price' => $full_price,
                                        'full_quntity' => $full_quntity,
                                        'total_amount' => $full_quntity * $full_price,
                                        'date_added' => $current_date,
                                        'comment' => $comment
                                    );
                                } elseif (!empty($half_price) && !empty($half_quntity)) {
                                    $db_cart_array = array(
                                        'user_id' => $user_id,
                                        'cart_key' => $cart_key,
                                        'item_key' => md5(random_string('alnum', 10)),
                                        'product_id' => $c_value->product_id,
                                        'product_name' => $c_value->product_name,
                                        'half_price' => $half_price,
                                        'half_quntity' => $half_quntity,
                                        'total_amount' => $half_quntity * $half_price,
                                        'date_added' => $current_date,
                                        'comment' => $comment
                                    );
                                }
                                $this->common_model->insert_entry('cart', $db_cart_array);
                            }
                        }//foreach end.
                    }//inner if end.
                } else {

                    if (!empty($user_cart) && count($user_cart) > 0) {
                        $cart_key = md5(random_string('alnum', 10));
                        foreach ($user_cart as $c_value) {
                            if (!empty($c_value->full_price) && !empty($c_value->full_quntity)) {
                                $db_cart_array = array(
                                    'user_id' => $user_id,
                                    'cart_key' => $cart_key,
                                    'item_key' => md5(random_string('alnum', 10)),
                                    'product_id' => $c_value->product_id,
                                    'product_name' => $c_value->product_name,
                                    'full_price' => $c_value->full_price,
                                    'full_quntity' => $c_value->full_quntity,
                                    'total_amount' => $c_value->full_quntity * $c_value->full_price,
                                    'date_added' => $current_date,
                                    'comment' => $c_value->comment
                                );
//print_r($db_cart_array);exit;
//$this->common_model->insert_entry('cart', $db_cart_array1);
                            } elseif (!empty($c_value->half_price) && !empty($c_value->half_quntity)) {
                                $db_cart_array = array(
                                    'user_id' => $user_id,
                                    'cart_key' => $cart_key,
                                    'item_key' => md5(random_string('alnum', 10)),
                                    'product_id' => $c_value->product_id,
                                    'product_name' => $c_value->product_name,
                                    'half_price' => $c_value->half_price,
                                    'half_quntity' => $c_value->half_quntity,
                                    'total_amount' => $c_value->half_quntity * $c_value->half_price,
                                    'date_added' => $current_date,
                                    'comment' => $c_value->comment
                                );
                            }
                            $this->common_model->insert_entry('cart', $db_cart_array);
                        }//end foreach.
                    }//inner if end.
                }//main else called
                $get_product_data = $this->get_user_cart_from_db($user_id);

                $this->res->status = 'success';
                $this->res->data = $get_product_data;
                $this->res->total_cart = $this->Core_Model->multisum($user_id);
                $this->res->total_amout = $this->Core_Model->singlesum($user_id);
                $this->_output();
                die();
                break;

            case 'get_order_history':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $user_id = $request->user_id;

                if (empty($user_id)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide all information.');
                }
                $datas = $this->common_model->getorderhistory($user_id);
                if (!empty($datas)) {
                    $this->res->status = 'success';



                    $this->res->data = $datas;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            case 'get_user_cart_data':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $user_id = $request->user_id;

                if (empty($user_id)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide all information.');
                }
                $get_product_data = $this->get_user_cart_from_db($user_id);
                if (!empty($get_product_data)) {
                    $this->res->status = 'success';
                    $this->res->data = $get_product_data;
                    $this->res->total_cart = $this->Core_Model->multisum($user_id);
                    $this->res->total_amout = $this->Core_Model->singlesum($user_id);
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            case 'update_user_cart':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $user_id = $request->user_id;
                $user_cart_temp = $request->user_cart;
                $current_date = date('Y-m-d H:i:s');

                if (!empty($user_cart_temp[0]->product_id) && !empty($user_cart_temp[0]->full_quntity)) {
                    $user_cart = $user_cart_temp[0];
                } else {
                    $user_cart = array();
                }

                if (empty($user_id) || empty($user_cart)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide all information.');
                }

                if (!empty($user_cart->product_id) && !empty($user_cart->full_quntity)) {
                    $upd_array = array(
                        'full_quntity' => $user_cart->full_quntity,
                        'full_price' => $user_cart->full_price,
                        'total_amount' => $user_cart->full_quntity * $user_cart->full_price
                    );
                    $this->common_model->update_entry('cart', $upd_array, array('user_id' => $user_id, 'product_id' => $user_cart->product_id));
                }

                $this->res->status = 'success';

                $this->_output();
                die();
                break;

            case 'delete_products_from_cart':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $user_id = $request->user_id;
                $product_id = $request->product_id;

                if (empty($user_id) || empty($product_id)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide all information.');
                }
                $this->common_model->DeleteRecordWhere('cart', array('user_id' => $user_id, 'product_id' => $product_id));
                $this->res->status = 'success';

                $this->_output();
                die();
                break;

            default:
                $this->_error('Invalid request', 'User request is invalid');
                break;
        }
        $this->_output();
    }

    public function Checkout($request) {
        switch ($request) {

            case 'check_zip':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $zip_code = $request->cod_zip;
                if (empty($zip_code)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide pin code');
                }
                $select_feilds = 'cod_zip,cod_city';
                $chk_zip_db = $get_cart_data = $this->common_model->get_entry_by_data("les_cod_zip", true, array('cod_zip' => $zip_code), $select_feilds);
                if ($chk_zip_db) {
                    $this->res->status = 'success';
                    $this->res->data = $chk_zip_db;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Shipping is not available for your zip code.' . $zip_code);
                }
                $this->_output();
                die();
                break;

            case 'get_all_areacode_with_price':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

                $get_area_code = $this->Core_Model->getAllrecord('les_cod_zip');

                if ($get_area_code != '') {
                    $this->res->status = 'success';
                    $this->res->data = $get_area_code;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }
                $this->_output();
                die();
                break;

            case 'add_shipping_address':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $user_id = $request->user_id;
                if (empty($user_id)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide user id');
                }

                $shipping_name = $request->shipping_name;
                $shipping_email = $request->shipping_email;
                $shipping_state = $request->shipping_state;
                $shipping_address = $request->shipping_address;
                $shipping_city = $request->shipping_city;
                $shipping_phone = $request->shipping_phone;
                $shipping_pin = $request->shipping_zipcode;
                $shipping_country = $request->shipping_country;

                if (!$shipping_name) {
                    $this->_error('Form error', 'Shipping Name is not specified.');
                }

                if (!$shipping_email) {
                    $this->_error('Form error', 'Shipping Email is not specified.');
                }

                if (!$shipping_address) {
                    $this->_error('Form error', 'Shipping Address is not specified.');
                }

                if (!$shipping_city) {
                    $this->_error('Form error', 'Shipping City is not specified.');
                }

                if (!$shipping_phone) {
                    $this->_error('Form error', 'Shipping Phone is not specified.');
                }

                $insert_shipping_detail = array(
                    'shipping_name' => $shipping_name,
                    'shipping_email' => $shipping_email,
                    'shipping_state' => $shipping_state,
                    'shipping_address' => $shipping_address,
                    'shipping_city' => $shipping_city,
                    'shipping_phone' => $shipping_phone,
                    'shipping_zipcode' => $shipping_pin,
                    'shipping_country' => $shipping_country,
                );
                $insert_shipping_detail['create_date'] = date("Y-m-d H:i:s");
                $shipping_exists = $this->common_model->get_entry_by_data("user_shipp_info", true, array('user_id' => $user_id));
                if ($shipping_exists) { //update info
                    $this->common_model->update_entry('user_shipp_info', $insert_shipping_detail, array('user_id' => $user_id));
                    $this->res->status = 'success';
                    $this->res->message = 'Shipping Information has been update successfully.';
//$this->_response(array('error'=>"",'messsage'=>'Shipping Information has been saved successfully.','data'=>''));
                } else { //insert info
                    $insert_shipping_detail['user_id'] = $user_id;
                    $shipp_id = $this->common_model->insert_entry('user_shipp_info', $insert_shipping_detail);
                    $this->res->status = 'success';
                    $this->res->message = 'Shipping Information has been added successfully.';
//$this->_response(array('error'=>"",'messsage'=>'Shipping Information has been updated successfully.','data'=>''));
                }
                $this->_output();
                die();
                break;

            case 'get_shipping_address':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $user_id = $request->user_id;
                if (empty($user_id)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide user id');
                }
                $select = 'shipping_name,shipping_email,shipping_state,shipping_address,shipping_city,shipping_phone,shipping_zipcode,shipping_country';
                $user_shipp_info = $this->common_model->get_entry_by_data('user_shipp_info', true, array('user_id' => $user_id), $select);
                if ($user_shipp_info) {
                    $this->res->status = 'success';
                    $this->res->data = $user_shipp_info;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'shipping address not found');
                }
                $this->_output();
                die();
                break;

            case 'order' :

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $user_id = $request->user_id;
                if (empty($user_id)) {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'Please provide user id');
                }

                $select = 'product_id,product_name,full_price,half_price,full_quntity,half_quntity,product_image,total_amount';
                $order = $this->Core_Model->getAllwherenew('les_cart', array('user_id =' => $user_id), $select);
//echo $this->db->last_query();
//print_r($order);exit;
                if ($order) {
                    $this->res->status = 'success';
                    $this->res->data = $order;
                    $this->res->total_amout = $this->Core_Model->singlesum($user_id);
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found');
                }

                $this->_output();
                die();
                break;


            case 'pay_order':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

                $user_id = $request->user_id;
                $les_user_email = $request->email;
                $deliverydate = $request->deliverydate;
//$comment = $request->comment;
                $payment_method = $request->payment_method; //cod
                $prefer_time = $request->prefer_time; //cod
                $cart_total_amount = $request->order_total_amount;
                $les_order_shipping_info_temp = $request->user_shipping_info;

                if (!empty($les_order_shipping_info_temp[0])) {
                    $les_order_shipping_info = $les_order_shipping_info_temp[0];
                } else {
                    $les_order_shipping_info = '';
                }

                $db_cart_data = $request->user_cart_data;
//print_r($db_cart_data);exit;
//check mendetory information for place a order is exists or not
                if (empty($cart_total_amount) || empty($db_cart_data) || empty($payment_method) ||
                        empty($les_order_shipping_info) || (empty($user_id))
                ) {
                    $this->_error('error', 'Please provide all information');
                }
//place an order and insert basic order information to order tables.

                $order_code = GenerateOrderCode(); //defined in payment helper
                $current_date = date('Y-m-d H:i:s');
                $order_array = array(
                    'user_id' => $user_id,
                    'order_code' => $order_code,
                    'order_create_date' => $current_date,
                    'order_status' => 1, //in progress or pending
                    'order_amount' => $cart_total_amount,
                    'payment_date' => $current_date,
                    'payment_method' => $payment_method,
                    'prefertime' => $prefer_time,
                    'payment_status' => 1,
                    'total_amount' => $cart_total_amount,
                    'order_update_date' => $current_date,
                    'order_through' => 2, //order from app
                );

//insert initial order info to db and generate order id
                $order_id = $this->common_model->insert_entry('orders', $order_array);
                if (empty($order_id)) {
                    $this->_error('error', 'Order not placed! Please try again');
                }

///////////////////// insert entry in payment details table //////////////////////////////
                $payment_details_array = array(
                    'payment_status' => 0,
                    'payment_option' => $payment_method,
                    'payment_method' => $payment_method,
                    'order_id' => $order_id,
                    'amount' => $cart_total_amount,
                    'discount_id' => 0,
                    'total_amount' => $cart_total_amount,
                    'create_date' => $current_date,
                );
                $payment_id = $this->common_model->insert_entry('payment_details', $payment_details_array);

//////////////////////////////////////////////////////////////////////////////////////////
//now store cart's data into order detail table
                if (!empty($db_cart_data) && count($db_cart_data) > 0) {

                    foreach ($db_cart_data as $cart_value) {
                        $product_data = $this->common_model->get_entry_by_data('products', true, array('product_id' => $cart_value->product_id), 'product_quantity,product_name,product_image');
//print_r($product_data);exit;
                        if (!empty($product_data)) {
                            $cart_value->product_name = $product_data['product_name'];
//$db_cart_data[$cart_key]['product_image'] = product_single_image($product_data['product_image']);
                            $order_detail_array = array(
                                'order_id' => $order_id,
                                'deliverydate' => $deliverydate,
                                'product_id' => $cart_value->product_id,
                                'product_price' => $cart_value->full_price,
                                'product_quantity' => $cart_value->full_quntity,
                                'discount_id' => '',
                                'user_id' => $user_id,
                                'email' => $les_user_email,
                                'user_type' => '',
                                'status' => 1,
                                'create_date' => $current_date,
                                'update_date' => $current_date,
                                'amount' => $cart_value->total_amount,
                                'discount_value' => '',
                                'total_amount' => $cart_value->total_amount,
                                'halfprice' => $cart_value->halfprice,
                                'halfquantity' => $cart_value->halfquantity,
                                'comment' => $cart_value->comment,
                            );
                            $order_dt_id = $this->common_model->insert_entry('order_details', $order_detail_array);
                            $this->common_model->DeleteRecordWhere('les_cart', array('product_id' => $cart_value->product_id, 'user_id' => $user_id));
                        }
                    }
                } else {
                    $this->_error('error', 'Order not placed! Please try again');
                }
//set initial variables for billing and shipping information
                $shipping_name = $les_order_shipping_info->shipping_name;
                $shipping_address = $les_order_shipping_info->shipping_address;
//$shipping_landmark = $les_order_shipping_info['shipping_landmark'];
                $shipping_city = $les_order_shipping_info->shipping_city;
                $shipping_state = $les_order_shipping_info->shipping_state;
                $shipping_country = $les_order_shipping_info->shipping_country;
                $shipping_zipcode = $les_order_shipping_info->shipping_zipcode;
                $shipping_phone = $les_order_shipping_info->shipping_phone;
                $shipping_email = $les_order_shipping_info->shipping_email;

//                $bill_name = $shipping_name;
//                $bill_address = $shipping_address;
//                $bill_city = $shipping_city;
//                $bill_state = $shipping_state;
//                $bill_country = $shipping_country;
//                $bill_zipcode = $shipping_zipcode;
//                $bill_phone = $shipping_phone;
//insert shipping details to db
                if (!empty($les_order_shipping_info)) {
                    $shipping_ins_array = array(
                        'order_id' => $order_id,
                        'user_id' => $user_id,
                        'user_type' => '',
                        'billing_address' => '',
                        'shipping_name' => $shipping_name,
                        'shipping_address' => $shipping_address,
                        //'shipping_landmark' => $les_order_shipping_info['shipping_landmark'],
                        'shipping_city' => $shipping_city,
                        'shipping_state' => $shipping_state,
                        'shipping_country' => $shipping_country,
                        'shipping_zipcode' => $shipping_zipcode,
                        'shipping_phone' => $shipping_phone,
                        'shipping_email' => $shipping_email,
                        'shipping_status' => 1,
                        'create_date' => $current_date,
                    );

                    $order_shipp_id = $this->common_model->insert_entry('shipping_details', $shipping_ins_array);
                }
//if ($payment_method === 'cod') {
                $this->res->status = 'success';
                $this->res->message = 'Your Order Recived..';
//$this->cod_confirm_order($order_id, $order_code);
//exit;
// $this->send_order_confirmation_mail($order_id);
// }
                $resp_array = array(
                    'order_id' => $order_id,
                    'order_code' => $order_code,
                    'payment_id' => $payment_id
                );
                $this->_output();
                die();
                break;

            case 'order_details':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

                $les_order_id = $request->order_id;
                $user_id = $request->user_id;

                if (empty($les_order_id) || empty($user_id)) {
                    $this->res->status = 'failed';
                    $this->_error('error', 'Please provide all information');
                }

                $field = array('first_name', 'last_name');
                $full_user_data = $this->Core_Model->getsinglefield('les_user', array('user_id' => $user_id), $field);
//print_r($full_user_data);

                $field_ship = array('order_id', 'billing_address', 'shipping_name', 'shipping_address', 'shipping_landmark', 'shipping_city', 'shipping_state', 'shipping_country', 'shipping_zipcode', 'shipping_phone', 'shipping_email');
                $ship_data = $this->Core_Model->getsinglefield('les_shipping_details', array('user_id' => $user_id, 'order_id' => $les_order_id), $field_ship);
//print_r($data['ship_data']);exit;

                $order_info = $this->common_model->get_entry_by_data('orders', true, array('order_id' => $les_order_id), 'total_amount,order_code as transaction_id,order_create_date,order_amount,payment_date,payment_method,total_amount,');
//print_r($order_info);exit;
                $where2 = array(
                    'order_details.order_id' => $les_order_id
                );
                $product_select_column = 'order_details.product_id,order_details.product_price,order_details.product_quantity,order_details.total_amount,products.product_image,products.product_name,products.product_sku';
                $order_items_detail = $this->common_model->get_data_by_join('order_details', 'products', $where2, 'product_id', 'product_id', '', '', '', $product_select_column, false);
//                echo $this->db->last_query(); die;
//print_r($order_items_detail);exit;
//                foreach ($order_items_detail as $order_details) {
//                    $order_details->order = $order_info;
//                        $repd[] = $order_details;
//                    }
//                    $req_data = json_encode($repd);
//                    $req_data = json_decode($req_data);
// $this->res->status = 'success';
//$this->res->data = $order_items_detail;


                $datas = $this->common_model->getorderhistory1($user_id, $les_order_id);
//print_r($datas);exit;
                if (!empty($datas)) {
                    $this->res->status = 'success';



                    $this->res->data = $datas;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }





                $this->_output();


                die();
                break;

            case 'get_order_total_price':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));

                $les_order_id = $request->order_id;
                $user_id = $request->user_id;

                if (empty($les_order_id) || empty($user_id)) {
                    $this->res->status = 'failed';
                    $this->_error('error', 'Please provide all information');
                }

                $field = array('first_name', 'last_name');
                $full_user_data = $this->Core_Model->getsinglefield('les_user', array('user_id' => $user_id), $field);
//print_r($full_user_data);

                $field_ship = array('order_id', 'billing_address', 'shipping_name', 'shipping_address', 'shipping_landmark', 'shipping_city', 'shipping_state', 'shipping_country', 'shipping_zipcode', 'shipping_phone', 'shipping_email');
                $ship_data = $this->Core_Model->getsinglefield('les_shipping_details', array('user_id' => $user_id, 'order_id' => $les_order_id), $field_ship);
//print_r($data['ship_data']);exit;

                $order_info = $this->common_model->get_entry_by_data('orders', true, array('order_id' => $les_order_id), 'total_amount,order_code as transaction_id,order_create_date,order_amount,payment_date,payment_method,total_amount,');
//print_r($order_info);exit;
                $where2 = array(
                    'order_details.order_id' => $les_order_id
                );
                $product_select_column = 'order_details.product_id,order_details.product_price,order_details.product_quantity,order_details.total_amount,products.product_image,products.product_name,products.product_sku';
                $order_items_detail = $this->common_model->get_data_by_join('order_details', 'products', $where2, 'product_id', 'product_id', '', '', '', $product_select_column, false);

                $datas = $this->common_model->getorderhistory2($user_id);
//print_r($datas);exit;
                if (!empty($datas)) {
                    $this->res->status = 'success';



                    $this->res->data = $datas;
                } else {
                    $this->res->status = 'Failed';
                    $this->_error('error', 'No Record Found.');
                }





                $this->_output();


                die();
                break;

            default:
                $this->_error('Invalid request', 'User request is invalid');
                break;
        }
        $this->_output();
    }

    public function Offer($request) {
        switch ($request) {

            case 'offer_product':

                $request = json_decode(rtrim(file_get_contents('php://input'), "\0"));
                $current_date = $request->current_date;

                $where = "('$current_date' between combo_start_date and combo_end_date) and combo_status = '1'";
                $sele_prd_clm = 'combo_image,combo_free_prd,combo_free_with,combo_start_date,combo_end_date,combo_status';
                $get_offer = $this->common_model->get_entry_by_data('les_combo', false, $where, $sele_prd_clm, 'asc', 'combo_id');
                if ($get_offer != '') {
                    foreach ($get_offer as $offer) {
                        $x = 'http://kabayanzone.ae/combo/' . $offer['combo_image'];
                        $offer['image_url'] = $x;
                        $repd[] = $offer;
                    }
                    $req_data = json_encode($repd);
                    $req_data = json_decode($req_data);
                    $this->res->status = 'success';
                    $this->res->data = $req_data;
                } else {
                    $this->res->status = 'failed';
                    $this->_error('error', 'Offer not avilable');
                }


                $this->_output();
                die();
                break;

            default:
                $this->_error('Invalid request', 'User request is invalid');
                break;
        }
        $this->_output();
    }

    public function cod_confirm_order($order_id = '', $order_code = '') {

        $payment_id = $order_id;
        $payment_status = 'pending';
        $txn_id = '';
        $current_date = date("Y-m-d H:i:s");

        if (empty($order_id) || empty($order_code) || empty($payment_id) || empty($payment_status)) {
            $this->_response(array('error' => 'Something went wrong! Please try again.', 'data' => '', 'message' => ''));
        }
        $payment_status = strtolower($payment_status);
//fetch main order information
        $order_info = $this->common_model->get_entry_by_data('orders', true, array('order_id' => $order_id, 'order_code' => $order_code));
        if ($order_info) {
            if ($payment_status == 'paid') {
                $payment_tbl_status = '1';
                $order_tbl_order_status = '1';
                $order_tbl_payment_status = '1';
            }
            $payment_tbl_status = '0';
            $order_tbl_order_status = '1';
            $order_tbl_payment_status = '1';
//////////////// update main order table //////////////////////////
            $order_update_array = array(
                'order_status' => $order_tbl_order_status,
                'payment_date' => $current_date,
                'payment_status' => $order_tbl_payment_status,
                'order_update_date' => $current_date
            );
            $this->common_model->update_entry('orders', $order_update_array, array('order_id' => $order_id, 'order_code' => $order_code));
/////////////////////////////////////////////////////////////////////////////////////
            /*             * ****** Update lotus money ************* */
            $lotus_money_where = array(
                'user_id' => $order_info['user_id'],
                'used_type' => 'dr',
                'lotus_money_order' => $order_id
            );
            $lotus_money_ceck = $this->common_model->get_entry_by_data('les_lotus_money', true, $lotus_money_where);
            if (!empty($lotus_money_ceck) && $lotus_money_ceck > 0) {
                $money_update_data = array(
                    'status_money' => 1
                );
                $this->common_model->update_entry('les_lotus_money', $money_update_data, $lotus_money_where);
            }
/////////// update payment table ///////////////////////////////////////////////////////
            $payment_update_array = array(
                'payment_status' => $payment_tbl_status,
                'payment_date' => $current_date,
                'transaction_id' => $txn_id,
                'update_date' => $current_date
            );
            $this->common_model->update_entry('payment_details', $payment_update_array, array('order_id' => $order_id, 'payment_id' => $payment_id));
/////////////////// check if coupon code used for this order than diduct coupon code limit ///////////////

            if ($order_info['is_coupon_used'] == 1 && !empty($order_info['coupon_code_id'])) {
                $coupon_data = $this->common_model->get_entry_by_data('discount_coupon', true, array('dis_coupon_id' => $order_info['coupon_code_id']));
                if ($coupon_data) {
                    $old_coupon_limit = $coupon_data['coupon_limit'];
                    if ($old_coupon_limit > 0) {
                        $updated_coupon_limit = $old_coupon_limit - 1;
                        $this->common_model->update_entry('discount_coupon', array('coupon_limit' => $updated_coupon_limit), array('dis_coupon_id' => $order_info['coupon_code_id']));
                    }
                }
            }

///////////// check egift used or not ///////////////////////////////////////
            if ($order_info['is_gift_voucher_used'] == 1 && !empty($order_info['gift_voucher_amount']) && !empty($order_info['gift_voucher_id'])) {
                $egift_info = $this->common_model->get_entry_by_data('egift_order', true, array('egift_id' => $order_info['gift_voucher_id']), 'egift_voucher_value,egift_voucher_qty,egift_id');
                if ($egift_info) {
                    $egift_update_array = array(
                        'egift_voucher_value' => $egift_info['egift_voucher_value'] - $order_info['gift_voucher_amount'],
                        'egift_voucher_qty' => $egift_info['egift_voucher_qty'] - 1,
                        'is_used' => 1
                    );
                    $this->common_model->update_entry('egift_order', $egift_update_array, array('egift_id' => $egift_info['egift_id']));
                }
            }
////////////////////////////////////////////////////////////////////////////
            $this->send_order_confirmation_mail($order_id);

            /*             * ***************************************  App launch offer code start ************************************************************* */
            $get_user_info = $this->common_model->get_entry_by_data('orders', true, array('order_id' => $order_id));
            if (!empty($get_user_info)) {
                $les_user_id = $get_user_info['user_id'];
                $check_register_user = $this->common_model->get_entry_by_data('user', true, array('user_id' => $les_user_id));
                if (!empty($check_register_user)) {
                    $where = "('$current_date' between start_date and end_date) and dis_coupon_on = 'App launch' and is_active = 1";
                    $app_launch_data = $this->common_model->get_entry_by_data('discount_coupon', true, $where);
                    if ($app_launch_data && ($app_launch_data['device_type'] == 'all' || $app_launch_data['device_type'] == 'app')) {

                        $disc_min_purchase = $app_launch_data['min_purchase'];
                        $min_quantity = $app_launch_data['min_quantity'];
                        $discount_type = $app_launch_data['dis_coupon_type'];
                        $discount_value = $app_launch_data['discount_value'];
                        $discount_id = $app_launch_data['dis_coupon_id'];
                        $discountable_cart_amount = 0;
                        $device_token = $order_info['device_token'];

                        $order_through = '2';
                        $payment_status = '2';
                        $where_token = "(order_through='$order_through') && (device_token='$device_token' || user_id='$les_user_id') && order_id!='$order_id' && (payment_status='$payment_status')";
                        $sel_sum = "SUM(product_quantity) as prd_quantity";
                        $get_order = $this->common_model->get_entry_by_data('order_details', false, array('order_id' => $order_id), $sel_sum);
                        $check_token = $this->common_model->get_entry_by_data('orders', true, $where_token, 'user_id,device_token');
                        if (empty($check_token)) {
                            $discountable_cart_amount = true;
                        }//inner if end
                        if ($discountable_cart_amount && $order_info['total_amount'] >= $disc_min_purchase && $get_order[0]['prd_quantity'] >= $min_quantity) {
                            $total_discount = $this->calculate_total_discount($order_info['total_amount'], $discount_type, $discount_value);
                            if ($total_discount <= $order_info['total_amount']) {
                                $data_lotus = array(
                                    'lotus_money_order' => $order_id . '/cash',
                                    'lotus_amount' => $total_discount,
                                    'lotus_money_email' => $check_register_user['email'],
                                    'user_id' => $les_user_id,
                                    'status_money' => 1,
                                    'used_type' => 'cr',
                                    'date' => date("Y-m-d"),
                                    'app_mail' => 1
                                );
                                $this->common_model->save_entry('les_lotus_money', $data_lotus, 'id');
                            }
                        }
                    }
                }
            }
            /*             * ********************************** End app launch code end   ***************************************** */
            $this->_response(array("status" => 1, "msg" => "Success"));
        } else {
            $this->_response(array("status" => 0, "msg" => "Error!"));
        }
    }

    public function get_user_cart_from_db($user_id) {
        $user_cart_data = array();
//$cart_data = $this->common_model->get_entry_by_data('cart',false,array('user_id'=>$user_id),'','asc','cart_id');
        $cart_data = $this->common_model->get_data_by_join('cart', 'products', array('cart.user_id' => $user_id), 'product_id', 'product_id', '', 'cart.cart_id', 'asc', 'cart.*,products.product_image', false);
        if ($cart_data) {
            foreach ($cart_data as $key => $value) {
                $product_image = product_single_image($value['product_image']);
                $cart_data[$key]['product_image'] = base_url() . $product_image;
            }

            return $cart_data;
        } else {
            return array();
        }
    }

    function email_check($email) {
        $where = array('email' => $email);
        $field = array('email');
        $get_email = $this->Core_Model->selectsinglerecord('user', $field, $where);
//print_r($get_email);die;
        if (!empty($get_email)) {
            return true;
        }
        return false;
    }

    function _parse_request() {
        if ($request == json_decode(file_get_contents('php://input'))) {
            $this->req = json_encode(rtrim(file_get_contents('php://input'), "\0"));
            return true;
        } else {
            $this->req = json_encode(rtrim(file_get_contents('php://input'), "\0"));
//$request = json_encode(rtrim(file_get_contents('php://input'), "\0"));
            return true;
        }
    }

    function _exec_request() {
        $api_request = $this->req->request;
        list($module, $function) = explode('/', $api_request);

        if (method_exists($this, $module)) {
            $this->{$module}($function);
        } else {
            $this->_error("No method?");
        }
    }

    function _require_auth() {
        if (in_array($this->req->request, $this->no_auth_request))
            return false;
        return true;
    }

    function _check_auth() {
        if (!isset($this->req->authkey)) {
            return false;
        }
        list($email, $key) = explode('#', $this->req->authkey);
        $query = $this->db->query("SELECT * FROM `users` WHERE `email` = ? AND `key` = ?", array($email, $key));
        if (!$query->num_rows()) {
            return false;
        }
        $this->userdata = $query->row();
        return true;
    }

    function _output() {
        header('Content-Type: application/json');
//$this->res->request = $this->req->request;
        $this->res->datetime = date('Y-m-d\TH:i:sP');
        echo json_encode($this->res);
    }

    function _error($error, $reason, $code = null) {
        header('Content-Type: application/json');
        $this->res->status = 'error';
        if (isset($this->req->request)) {
            $this->res->request = $this->req->request;
        }
        $this->res->error = $error;
        $this->res->message = $reason;
        $this->res->datetime = date('Y-m-d\TH:i:sP');
        echo json_encode($this->res);
        die();
    }

    function _throw($code, $header, $msg) {
        switch ($code) {
            case "403":
                header("HTTP/1.0 403 Forbidden");
                echo "<h1>{$header}</h1>";
                echo "<p>{$msg}</p>";
                echo "<hr />";
                echo date('Y-m-d\TH:i:sP');
                break;
        }
        die();
    }

}
