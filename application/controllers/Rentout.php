<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Rentout extends MY_Base_Controller{
	function __construct() {
        parent::__construct();		
    }
	
public function index()
{
$this->frontheader();	
$this->load->view("Rentout");	
$this->frontfooter(); 
}


}