<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Faq extends MY_Base_Controller{
	function __construct() {
        parent::__construct();   	
    }

public function index()
{
   $data['faq']=$this->Common_Model->getdata("faq",$where='',$sort="id desc"); 	  
   $this->frontheader();
   $this->load->view("Faq",$data);
   $this->frontfooter();  
}
	
}