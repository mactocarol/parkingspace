<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Admin extends MY_Base_Controller{
	function __construct() {
        parent::__construct();         				 
    }
	
public function index()
{
    if($this->session->userdata("id"))
	{	
     redirect("Admin/dashboard");
	}
    else{
	$data['front']=$this->Common_Model->getdata("front_setting",$where='',$sort='');
	$cooki=$this->checkfirsttime();
    $data['cooki']=$cooki;	 
    $this->load->view("admin/Header",$data); 	
    $this->load->view("admin/Signin",$data);
    $this->load->view("admin/Footer"); 	
    }	
}

public function dashboard()
{
	$this->checkSessionAdmin();
		
	if($this->session->userdata('id'))
	{  
	$this->adminheader();	
    $this->load->view("admin/Dashboard");	
    $this->adminfooter(); 
	}
    else {	
	$this->session->set_flashdata('result', 1);
	$this->session->set_flashdata('class', 'danger');
	$this->session->set_flashdata('msg', "Invalid Email ID/Password");
	redirect("Admin");	
	}		
}


public function checklogin()
	{		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{	
	      $data=$this->Login_Model->admin_login();
		  if($data)
         {
if($this->input->cookie('pass'))
		{
     		 delete_cookie('pass'); 
		}		 	         
			redirect("Admin/dashboard");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Invalid Email/Password. Please try again");
		   $cookie= array(
           'name'   => 'pass',
           'value'  => 'pass',                            
           'expire' => '0'                 
        );
		$this->input->set_cookie($cookie);
           redirect("Admin"); 
	     }
		}		 
	}

public function profile()
{
    $this->checkSessionAdmin();

    $data['admin']=$this->Common_Model->getdata("admin_login",$where='',$sort='');
	$this->adminheader();	
    $this->load->view("admin/Adminprofile",$data);	
    $this->adminfooter();
}

public function updateadmin()
{
	    $this->checkSessionAdmin();
		$id=$this->input->post('id');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[100]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->profile($id);
		}
		else
		{	
	      if($this->input->post("photo"))
		  {
		  $this->unsetImage($id,'admin_login','photo','images/');		  		 
		  $photo=$this->savecropimage("photo","images/");		 	     
		  }
		  else{
			   $photo=$this->input->post('photo1');
          }	
          $where=array("id"=>$id);
	      $datas=array("photo"=>$photo,"name"=>$this->input->post("name"),"email"=>$this->input->post("email"));
		  $id=$this->Common_Model->update("admin_login",$datas,$where);		   
		 if($id)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Profile updated successfully");
		   redirect("Admin/profile");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to edit");
           redirect("Admin/profile");
	     }
		}		
}

public function change()
{	
          $this->checkSessionAdmin();
          $this->form_validation->set_rules('opassword', 'Current Password', 'required|min_length[5]|max_length[16]');
		  $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[16]');
		  $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|min_length[5]|max_length[16]|matches[password]');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->profile();
		}
		else
		{	
	      $id=$this->session->userdata('id');
	      $data=array('password'=>md5($this->input->post('password')));
		  $where=array("id"=>$id,"password"=>md5($this->input->post('opassword')));
		  if($this->session->userdata("type")=='Admin')
		  {
		  $tt=$this->Common_Model->update("admin_login",$data,$where);
		  }
		  else{
		  $tt=$this->Common_Model->update("user",$data,$where);  
		  }
	      
		  if($tt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Password changed successfully");
		   redirect("Admin/profile");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to change");
           redirect("Admin/profile");
	     }
		}		 	  
}

public function logout(){
	 session_start();
     session_destroy();
     $this->session->sess_destroy();
     redirect('Admin/');
	}

}