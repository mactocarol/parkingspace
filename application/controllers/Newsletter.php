<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Newsletter extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        //$this->checkSession();
		$this->load->model('Core_Model');
		$this->load->helper('core_helper');
        $this->uid=$this->session->userdata("uid");		
    }

	/*--- start featuredpayment --*/	
	public function index()
	{
		if($_POST){
			//print_r($_POST);die;
			$udata['email'] = $this->input->post('email');
			$check = $this->Core_Model->SelectRecord('newsletter','*',$udata);
						
			if(empty($check)){
				$this->Core_Model->InsertRecord('newsletter',$udata);
				$this->session->set_flashdata('resultmsg', 1);
				$this->session->set_flashdata('class', 'success');
				$this->session->set_flashdata('messsage', "Thank you for signing up. You will get latest updates via email !");
			}else{
				$this->session->set_flashdata('resultmsg', 1);
				$this->session->set_flashdata('class', 'danger');
				$this->session->set_flashdata('messsage', "This email is already registered with us !");						
			}
		}
		redirect($this->input->post('return_url'));
	}
		
}