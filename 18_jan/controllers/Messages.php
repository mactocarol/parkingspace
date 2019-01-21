<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages extends MY_Base_Controller {

    //private $connection;
    public function __construct() {
        parent::__construct();
        $this->load->model('Core_Model');
        //$this->load->helper('ht_helper');	    
        if (!$this->session->userdata('uid')) {
            redirect('user');
        }
    }

    public function index() {
        $data = new stdClass();
        if ($this->session->flashdata('item')) {
            $items = $this->session->flashdata('item');
            if ($items->success) {
                $data->error = 0;
                $data->success = 1;
                $data->message = $items->message;
            } else {
                $data->error = 1;
                $data->success = 0;
                $data->message = $items->message;
            }
        }
        $udata = array("id" => $this->session->userdata('uid'));
        $data->result = $this->Core_Model->SelectSingleRecord('user', '*', $udata, $orderby = array());


        //$data->messages = $this->Core_Model->SelectRecord('comments','*',array("message_to"=>$this->session->userdata('uid')),'id desc');
        //$this->Core_Model->UpdateRecord('comments',array("status"=>'1'),array("message_to"=>$this->session->userdata('user_id')));
        $data->messages = $this->getMessages($this->session->userdata('uid'));
        //print_r($data->messages); die;

        $userid = $this->Core_Model->updateMessageNotification($this->session->userdata('uid'));

        $this->frontheader();
        $this->startdashboard();
        $this->load->view("mymessages", $data);
        $this->enddashboard();
        $this->frontfooter();
    }

    public function chat($id, $chatid) {

        $data = new stdClass();
        if ($this->session->flashdata('item')) {
            $items = $this->session->flashdata('item');
            if ($items->success) {
                $data->error = 0;
                $data->success = 1;
                $data->message = $items->message;
            } else {
                $data->error = 1;
                $data->success = 0;
                $data->message = $items->message;
            }
        }

        $udata = array("id" => $this->session->userdata('uid'));
        $data->result = $this->Core_Model->SelectSingleRecord('user', '*', $udata, $orderby = array());

        $udata = array("id" => $id);

        $data->other = $this->Core_Model->SelectSingleRecord('user', '*', $udata, $orderby = array());
        $data->chat_id = $chatid;
        $data->comments = $this->Core_Model->SelectRecord('comments', '*', ['chat_id' => $chatid], 'id asc');


        //echo "<pre>"; print_r($data); die;
        $this->frontheader();
        $this->startdashboard();
        $this->load->view("message", $data);
        $this->enddashboard();
        $this->frontfooter();
    }

    public function send_comments() {
        $data = new stdClass();
        //echo "<pre>"; print_r($_POST); die;                        
        if ($_POST) {
            $data->error = 0;
            $attachment = '';
            if (($_FILES['attachment']['name']) != '') {
                $filename = $_FILES["attachment"]["name"];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

                $config['upload_path'] = './upload/comments/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|txt|doc|docx|pdf';
                $config['max_size'] = 4000;
                $config['file_name'] = uniqid() . time() . '.' . $file_ext;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('attachment')) {
                    $data->error = 1;
                    $data->success = 0;
                    $data->message = $this->upload->display_errors();
                } else {
                    $updata = array('upload_data' => $this->upload->data());
                    $attachment = $config['file_name']; //$this->upload->data()['file_name'];                            
                }
            }

            if ($this->input->post('message') != '' && ($data->error != 1)) {
                $odata['message_to'] = $this->input->post('message_to');
                $odata['message_from'] = $this->input->post('message_from');
                $odata['message'] = $this->input->post('message');
                $odata['file'] = $attachment;
                $odata['chat_id'] = $this->input->post('chat_id');


                if ($this->Core_Model->InsertRecord('comments', $odata)) {
                    $data->error = 0;
                    $data->success = 1;
                    $data->message = "Message has been submitted Successfully";
                    $massageNotification = array(
                        'senderId' => $this->session->userdata('uid'),
                        'recieverId' => $this->input->post('message_to'),
                        'masage' => 'You received new massage',
                        'type' => 2,
                        'status' => 0,
                        'created_date' => date('Y-m-d H:i:s'),
                    );

                    $insertMassageNOtification = $this->Core_Model->InsertRecord('notification', $massageNotification);
                } else {
                    $data->error = 1;
                    $data->success = 0;
                    $data->message = "Network Error";
                }
            }
        }
        $udata = array("id" => $this->session->userdata('uid'));
        $data->result = $this->Core_Model->SelectSingleRecord('user', '*', $udata, $orderby = array());

        $udata = array("id" => $this->input->post('message_to'));
        $data->other = $this->Core_Model->SelectSingleRecord('user', '*', $udata, $orderby = array());

        $data->comments = $this->Core_Model->SelectRecord('comments', '*', ['chat_id' => $this->input->post('chat_id')], 'id asc');

        if ($data->error == 1) {
            echo 'Error: ' . $data->message;
        } else {
            $this->load->view('comments_view', $data);
        }
        //print_r(json_encode($data)); die;
    }

    public function show_comments() {
        $data = new stdClass();

        $udata = array("id" => $this->session->userdata('uid'));
        $data->result = $this->Core_Model->SelectSingleRecord('user', '*', $udata, $orderby = array());
        $data->comments = $this->Core_Model->SelectRecord('comments', '*', ['chat_id' => $this->input->post('chat_id')], 'id asc');

        //if(!empty($data->comments)){
        $udata = array("id" => $this->input->post('msg_to'));
        //}

        $data->other = $this->Core_Model->SelectSingleRecord('user', '*', $udata, $orderby = array());

        //echo "<pre>"; print_r($data); die;
        $this->load->view('comments_view', $data);
        //print_r(json_encode($data)); die;
    }

}

?>