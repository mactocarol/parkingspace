<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagenotfound extends MY_Base_Controller
{ 
    public function index() {
            $this->frontheader();        
			$this->load->view("Pagenotfound");
			$this->frontfooter();
    }
}
?>