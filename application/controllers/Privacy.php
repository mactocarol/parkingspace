<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Privacy extends MY_Base_Controller{
	function __construct() {
        parent::__construct();   	
    }

public function index()
{
   $data['privacy']=$this->Common_Model->getdata("privacy",$where='',$sort=""); 	  
   $this->frontheader();
   $this->load->view("Privacy",$data);
   $this->frontfooter();  
}
	
}