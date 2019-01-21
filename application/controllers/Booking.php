<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
ob_start();

class Booking extends MY_Base_Controller {

    function __construct() {
        parent::__construct();
        //$this->checkSession();		
        $this->load->helper('core_helper');
        $this->load->model('Core_Model');
        $this->load->model('Common_Model');
        $this->load->library('paypal_lib');
        $this->uid = $this->session->userdata("uid");
    }

    public function buy() {
        $data = new stdClass();

        $order_no = $this->create_order_no(); //"ORDER_".uniqid();
        $amt = $this->input->post('amount');
        $fdate = $this->input->post('fdate');
        $ldate = $this->input->post('ldate');
        $spaceid = $this->input->post('spaceid');
        $vehicle_id = $this->input->post('vehicle_id');
        $amt = $amt;

        $space = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $spaceid), $orderby = array());

        $result = $this->Core_Model->SelectSingleRecord('user', '*', array("id" => $this->session->userdata('uid')), $orderby = array());

        $udata['order_no'] = $order_no;
        $udata['amount'] = $amt;
        $udata['payment_type'] = $this->input->post('payment_method');
        $udata['user_id'] = $this->session->userdata('uid');
        $udata['seller_id'] = $space->uid;

        if ($this->input->post('payment_method') == 'paypal') {
            if ($lastid = $this->Core_Model->InsertRecord('order', $udata)) {

                $odata['order_id'] = $order_no;
                $odata['product_id'] = $spaceid;
                $odata['amount'] = $amt;
                $odata['qty'] = 1;

                $this->Core_Model->InsertRecord('order_detail', $odata);

                $date_from = strtotime($fdate); // Convert date to a UNIX timestamp  		  		 		
                $date_to = strtotime($ldate); // Convert date to a UNIX timestamp  							  							
                //for ($i=$date_from; $i<=$date_to; $i+=86400) {
                $bdata['user_id'] = $this->session->userdata('uid');
                $bdata['spaceid'] = $spaceid;
                $bdata['vehicle_id'] = $vehicle_id;
                //$bdata['bookdate'] = date("d-m-y", $i);
                $bdata['booking_from'] = $date_from;
                $bdata['booking_to'] = $date_to;
                $bdata['status'] = 1;
                $bdata['order_id'] = $order_no;
                $this->Core_Model->InsertRecord('booking', $bdata);
                //}
            }
            $this->session->set_userdata('receverId', $space->uid);
            $this->session->set_userdata('spaceId', $spaceid);

            //Set variables for paypal form
            $returnURL = base_url() . 'Booking/success'; //payment success url
            $cancelURL = base_url() . 'Booking/cancel'; //payment cancel url
            $notifyURL = base_url() . 'Booking/ipn'; //ipn url
            //get particular product data
            //$product = $this->product->getRows($id);

            $userID = $this->session->userdata('uid'); //current user id
            $logo = base_url() . 'assets/images/codexworld-logo.png';

            $this->paypal_lib->add_field('return', $returnURL);
            $this->paypal_lib->add_field('cancel_return', $cancelURL);
            $this->paypal_lib->add_field('notify_url', $notifyURL);
            $this->paypal_lib->add_field('item_name', 'Parking Space');
            $this->paypal_lib->add_field('custom', $order_no);
            $this->paypal_lib->add_field('item_number', $userID);
            $this->paypal_lib->add_field('amount', $amt);
            $this->paypal_lib->image($logo);

            $this->paypal_lib->paypal_auto_form();
        } else if ($this->input->post('payment_method') == 'payu') {
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
                $bdata['user_id'] = $this->session->userdata('uid');
                $bdata['spaceid'] = $spaceid;
                $bdata['vehicle_id'] = $vehicle_id;
                //$bdata['bookdate'] = date("d-m-y", $i);
                $bdata['booking_from'] = $date_from;
                $bdata['booking_to'] = $date_to;
                $bdata['status'] = 1;
                $bdata['order_id'] = $order_no;
                $this->Core_Model->InsertRecord('booking', $bdata);
                //}
            }

            require_once realpath(dirname(__FILE__)) . '/../../payu/lib/openpayu.php';
            require_once realpath(dirname(__FILE__)) . '/../../payu/config.php';

            $order = array();

            $this->session->set_userdata('receverId', $space->uid);
            $this->session->set_userdata('spaceId', $spaceid);

            $order['notifyUrl'] = base_url() . 'Booking/OrderNotify'; //'http://localhost'.dirname($_SERVER['REQUEST_URI']).'/OrderNotify.php';
            $order['continueUrl'] = base_url() . 'Booking/success1'; //'http://localhost'.dirname($_SERVER['REQUEST_URI']).'/../../layout/success.php';

            $order['customerIp'] = '127.0.0.1';
            $order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
            $order['description'] = 'Parking Space';
            $order['currencyCode'] = 'PLN';
            $order['totalAmount'] = $amt * 100;
            $order['extOrderId'] = $order_no;

            $order['products'][0]['name'] = 'Parking Space';
            $order['products'][0]['unitPrice'] = $amt * 100;
            $order['products'][0]['quantity'] = 1;

            $order['buyer']['email'] = $result->email;
            $order['buyer']['phone'] = $result->contact;
            $order['buyer']['firstName'] = $result->name;
            //$order['buyer']['lastName'] = $result->l_name;
            $order['buyer']['language'] = 'en';


            try {
                $response = OpenPayU_Order::create($order);


                $status_desc = OpenPayU_Util::statusDesc($response->getStatus());
                if ($response->getStatus() == 'SUCCESS') {
                    $orderid = $response->getResponse()->orderId;
                    $this->session->set_userdata('payu', $orderid);
                    $redirecturi = $response->getResponse()->redirectUri;
                    redirect($redirecturi);
                } else {
                    //echo '<div class="alert alert-warning">' . $response->getStatus() . ': ' . $status_desc;
                    //echo '</div>';
                }
            } catch (OpenPayU_Exception $e) {
                //echo '<pre>';
                //var_dump((string)$e);
                //echo '</pre>';
                redirect('dashboard');
            }
            die;
            //$datas['rsp'] = OpenPayU_Order::hostedOrderForm($order);

            $this->frontheader();
            $this->load->view("payu", $datas);
            $this->frontfooter();
        }
    }

    public function OrderNotify() {
        require_once realpath(dirname(__FILE__)) . '/../../payu/lib/openpayu.php';
        require_once realpath(dirname(__FILE__)) . '/../../payu/config.php';

        if ($this->session->userdata('spaceId') && $this->session->userdata('receverId')) {
            $this->session->unset_userdata('spaceId');
            $this->session->unset_userdata('receverId');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $body = file_get_contents('php://input');
            $data = trim($body);

            try {
                if (!empty($data)) {
                    $result = OpenPayU_Order::consumeNotification($data);
                }

                if ($result->getResponse()->order->orderId) {

                    /* Check if OrderId exists in Merchant Service, update Order data by OrderRetrieveRequest */
                    $order = OpenPayU_Order::retrieve($result->getResponse()->order->orderId);
                    //echo "<pre>"; print_r($order); die;
                    if ($order->getStatus() == 'SUCCESS') {
                        //the response should be status 200
                        header("HTTP/1.1 200 OK");
                        //$this->Core_Model->UpdateRecord('order',array("transaction_id"=>2222,"payment_status"=>"2"),array("order_no"=>'ORDER_5c1ccbd56dea1'));
                    }
                }
            } catch (OpenPayU_Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function success1() {
        require_once realpath(dirname(__FILE__)) . '/../../payu/lib/openpayu.php';
        require_once realpath(dirname(__FILE__)) . '/../../payu/config.php';
        $data = new stdClass();
        $resp = $this->session->userdata('payu');
        //echo $orderid = $response->getResponse()->orderId;
        //echo "<pre>"; print_r($response);


        if ($this->session->userdata('spaceId') && $this->session->userdata('receverId') && $this->session->userdata('uid')) {
            $space = $this->session->userdata('spaceId');
            $recever = $this->session->userdata('receverId');
            $sender = $this->session->userdata('uid');

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

                $sender_email = $this->getSingleValue($this->session->userdata('uid'), 'user', 'email');
                $sender_name = $this->getSingleValue($this->session->userdata('uid'), 'user', 'name');

                $reciever_email = $this->getSingleValue($this->session->userdata('receverId'), 'user', 'email');
                $reciever_name = $this->getSingleValue($this->session->userdata('receverId'), 'user', 'name');

                $site_title = $this->getdataSingleValue(22, 'front_setting', 'title_english', 'st');
                $message = "Successfull Book Parking Place<br>";

                $message1 = "Thanks For Book Parking Place<a href=" . base_url() . ">" . $site_title . "</a>.";
                $datas['messages'] = array($sender_name, $message1);
                $datas1['messages'] = array($reciever_name, $message);

                $this->email($sender_email, "New Booking" . $site_title, $datas);
                $this->email($reciever_email, "Success Full Parking" . $site_title, $datas1);

                $this->session->unset_userdata('spaceId');
                $this->session->unset_userdata('receverId');
            } else {
                $this->session->unset_userdata('spaceId');
                $this->session->unset_userdata('receverId');
            }
        }



        $response = OpenPayU_Order::retrieve(stripslashes($resp));
        $this->session->unset_userdata('payu');
        //echo "<pre>"; print_r($response);
        if ($response->getStatus() == 'SUCCESS') {
            //if(empty($is_txn)){
            $udata['user_id'] = $this->session->userdata('uid');
            $udata['txn_id'] = $response->getResponse()->properties[0]->value;
            $udata['order_id'] = $response->getResponse()->orders[0]->extOrderId;
            $udata['payment_amt'] = ($response->getResponse()->orders[0]->totalAmount) / 100;
            $udata['currency_code'] = $response->getResponse()->orders[0]->currencyCode;
            $udata['status'] = $response->getResponse()->orders[0]->status;
            $udata['payment_type'] = '2';
            $udata['payment_mode'] = 'PayU';
            if ($this->Core_Model->InsertRecord('transactions', $udata)) {
                $this->Core_Model->UpdateRecord('order', array("transaction_id" => $response->getResponse()->properties[0]->value, "payment_status" => "2"), array("order_no" => $response->getResponse()->orders[0]->extOrderId));

                $data->error = 0;
                $data->success = 1;
                $data->message = "Your Order has been placed successfully";
                $this->session->set_flashdata('item', $data);
                redirect('Booking/thankyou');
            }
            // }
        } else {
            $data->error = 1;
            $data->success = 0;
            $data->message = "Payment Failed";
            $this->session->set_flashdata('item', $data);
            redirect('Booking/thankyou');
        }
    }

    public function success() {

        if ($this->session->userdata('spaceId') && $this->session->userdata('receverId') && $this->session->userdata('uid')) {

            $space = $this->session->userdata('spaceId');
            $recever = $this->session->userdata('receverId');
            $sender = $this->session->userdata('uid');

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

                $sender_email = $this->getSingleValue($this->session->userdata('uid'), 'user', 'email');
                $sender_name = $this->getSingleValue($this->session->userdata('uid'), 'user', 'name');

                $reciever_email = $this->getSingleValue($this->session->userdata('receverId'), 'user', 'email');
                $reciever_name = $this->getSingleValue($this->session->userdata('receverId'), 'user', 'name');

                $site_title = $this->getdataSingleValue(22, 'front_setting', 'title_english', 'st');
                $message = "Successfull Book Parking Place<br>";

                $message1 = "Thanks For Book Parking Place<a href=" . base_url() . ">" . $site_title . "</a>.";
                $datas['messages'] = array($sender_name, $message1);
                $datas1['messages'] = array($reciever_name, $message);

                $this->email($sender_email, "New Booking" . $site_title, $datas);
                $this->email($reciever_email, "Success Full Parking" . $site_title, $datas1);

                $this->session->unset_userdata('spaceId');
                $this->session->unset_userdata('receverId');
            } else {
                $this->session->unset_userdata('spaceId');
                $this->session->unset_userdata('receverId');
            }
        }
        $data = new stdClass();
        $paypalInfo = $this->input->get();
        //print_r($paypalInfo); die;
        $data->user_id = $paypalInfo['item_number'];
        $data->plan_id = $paypalInfo['item_name'];
        $data->txn_id = $paypalInfo["tx"];
        $data->payment_amt = $paypalInfo["amt"];
        $data->currency_code = $paypalInfo["cc"];
        $data->order_id = $paypalInfo["cm"];
        $data->status = $paypalInfo["st"];

        $amt = $data->payment_amt;

        $is_txn = $this->Core_Model->SelectSingleRecord('transactions', '*', array('txn_id' => $data->txn_id), 'id desc');
        if (empty($is_txn)) {
            $udata['user_id'] = $data->user_id;
            $udata['txn_id'] = $data->txn_id;
            $udata['order_id'] = $data->order_id;
            $udata['payment_amt'] = $data->payment_amt;
            $udata['currency_code'] = $data->currency_code;
            $udata['status'] = $data->status;
            $udata['payment_type'] = '2';
            $udata['payment_mode'] = 'Paypal';
            if ($this->Core_Model->InsertRecord('transactions', $udata)) {
                $this->Core_Model->UpdateRecord('order', array("transaction_id" => $data->txn_id, "payment_status" => "2"), array("order_no" => $data->order_id));
                $orders = $this->Core_Model->SelectRecord('order_detail', '*', array("order_id" => $data->order_id), 'id desc');
                foreach ($orders as $row) {

                    $product = $this->Core_Model->SelectSingleRecord('rentourspace', '*', array("id" => $row['product_id']), 'id desc');

                    //
                    //$price = $product->price - ($product->price * ($charge/100));
                    //added_wallet($product->user_id,$price);
                }
                $data->error = 0;
                $data->success = 1;
                $data->message = "Your Order has been placed successfully";
                $this->session->set_flashdata('item', $data);
                redirect('Booking/thankyou');
            }
        }
    }

    public function cancel() {

        if ($this->session->userdata('spaceId') && $this->session->userdata('receverId')) {

            $this->session->unset_userdata('spaceId');
            $this->session->unset_userdata('receverId');
        }

        $data = new stdClass();

        $data->error = 1;
        $data->success = 0;
        $data->message = "Payment Failed , Plese Try Again.";
        $this->session->set_flashdata('item', $data);
        redirect('Booking/cart_view');
    }

    public function create_order_no() {
        $order = "ORDER_" . uniqid();
        if ($this->Core_Model->SelectRecord('order', '*', array("order_no" => $order), $orderby = array())) {
            $this->create_order_no();
        }
        return $order;
    }

    public function thankyou() {
        $datas = [];
        $this->frontheader();
        $this->load->view("Thankyou", $datas);
        $this->frontfooter();
    }

}
