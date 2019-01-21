<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Aboutus extends MY_Base_Controller{
	function __construct() {
        parent::__construct();   	
    }

public function index()
{
    $data['aboutus']=$this->Common_Model->getdata("aboutus",$where='',$sort="id desc"); 

   $this->frontheader();
   $this->load->view("Aboutus",$data);
   $this->frontfooter();  
}
	
}