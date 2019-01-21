<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Forgot extends MY_Base_Controller{
	function __construct() {
        parent::__construct();         
    }
	
public function index()
{	
        $this->frontheader();		
		$this->load->view("Forgotpassword");
		$this->frontfooter();
}


 public function forgotpassword(){
	 
	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[6]|max_length[300]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{	
	      $email=$this->input->post('email');
		  $code=rand(100000,999999);
	      $data=$this->Common_Model->forgotpassword($email,$code);		  
	        if($data==1)
			{
				$emails=base64_encode($email);
				$site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
				$name=$this->getSingleValue($email,'user','name');
				
				$msgs="<b>Your reset code is ".$code."</b><br>
							Please click on Reset Button to reset your password.<br>
							<a href='".base_url()."Forgot/resetpage/".$emails."'>Reset Password</a>";
				 $datas['messages']=array($name,$msgs);
                 $this->email($email,"Reset Password link at ".$site_title,$datas);
 
				 $this->session->set_flashdata('resultmsg', 1);
		         $this->session->set_flashdata('class', 'success');
		         $this->session->set_flashdata('messsage', "Password reset link send successfully to your email id.");
                 redirect("Home");
			}
			if($data==3){
				
				 $this->session->set_flashdata('resultmsg', 1);
		         $this->session->set_flashdata('class', 'warning');
		         $this->session->set_flashdata('messsage', "Error to reset password");
                 redirect("Forgot"); 
			}
         
           if($data==2){ 
	
           $this->session->set_flashdata('resultmsg', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('messsage', "This email id not exists.");
           redirect("Forgot"); 
	     }
		}		
}		
		
public function resetpage()
{	
        $this->frontheader();
		$this->load->view("Resetpage");
		$this->frontfooter();
}

public function resetpassword($id=0){
	$id = $this->input->post('id');
	$this->form_validation->set_rules('code', 'Code', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[16]');
	$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|min_length[6]|max_length[16]|matches[password]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('resultmsg', 1);
			$this->session->set_flashdata('class', 'danger');
			$this->session->set_flashdata('messsage', validation_errors());
			redirect("Forgot/resetpage/$id");
		}
		else
		{
        $email=base64_decode($this->input->post('id'));			
	    $code=$this->input->post('code');
	    $password=md5($this->input->post('password'));
        $this->db->where("code",$code);
		$this->db->where("email",$email);
		$query=$this->db->get("user");
		
		if($query->num_rows()>0)
		{	
		$data=array('password'=>$password,"code"=>0);
		$this->db->where('email',$email);
		$this->db->where('code',$code);
	    $this->db->update('user',$data);
        if($this->db->affected_rows()>0){
			     $name=$this->getSingleValue($email,'user','name');
				 $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
                 $message="Your password has been successfully reset. Please click here to login at <a href='".base_url('Home/login')."'>".$site_title."</a>";
	             $datas['messages']=array($name,$message);
		         $this->email($email,"Password Reset at ".$site_title,$datas);
		   
				 $this->session->set_flashdata('resultmsg', 1);
		         $this->session->set_flashdata('class', 'success');
		         $this->session->set_flashdata('messsage', "Password reset successfully");
                 redirect("Home/login");
		}
		else{
		   $this->session->set_flashdata('resultmsg', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('messsage', "Error to reset");
           redirect("Forgot/resetpage/$id"); 
		}}
		else{
		   $this->session->set_flashdata('resultmsg', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('messsage', "Invalid code please try again");
           redirect("Forgot/resetpage/$id"); 
		}
		}	  	
}


}