<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Contactus extends MY_Base_Controller{
function __construct() {
        parent::__construct();	
    }

	public function index()
{
   $data['contactus']=$this->Common_Model->getdata("contactus",$where='',$sort="id desc");
   $this->frontheader();
   $this->load->view("Contact",$data);
   $this->frontfooter();  
}
	
	public function sendmail()
	{
            $name=$this->input->post('contactname');
			$email=$this->input->post('contactemail');
			$subject=$this->input->post('subject');
			$msg=$this->input->post('contactmessage');
			$phone=$this->input->post('contactphone');
			$admin_email=$this->getSingleValue(1,'admin_login','email');	   
            $admin_name=$this->getSingleValue(1,'admin_login','name');
            $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
	        $message="   	Name: ".$name."<br>
							Email: ".$email."<br>
							Phone: ".$phone."<br>
							Message: ".$msg."<br>";
	       
	       $message1="Thanks for Contact us at <a href=".base_url().">".$site_title."</a>.		   
		                    Name: ".$name."<br>
							Email: ".$email."<br>
							Phone: ".$phone."<br>
							Message: ".$msg."<br>
							We will contact you as soon as possible.
							.";
		   $datas['messages']=array($admin_name,$message);
	       $datas1['messages']=array($name,$message1);
          
			$this->email($admin_email,"Contact us detail at ".$site_title,$datas);
			$this->email($email,"Contact us detail at ".$site_title,$datas1);
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg',"Thank you for contact us. We will contact you as soon as possible");
			redirect("Contactus");
	
	}
	
}