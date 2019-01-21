<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class News extends MY_Base_Controller{
	function __construct() {
        parent::__construct();   	
    }

public function index()
{
   $data['news']=$this->Common_Model->getdata("news",$where='',$sort="id desc"); 	  
   $this->frontheader();
   $this->load->view("News",$data);
   $this->front_footer();  
}
	
}