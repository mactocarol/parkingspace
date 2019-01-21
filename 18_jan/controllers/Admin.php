<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Admin extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->load->model('Core_Model');
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
    
    public function Newsletter(){
        $data['control']="Newsletter";
		$data['controlname']="Newsletter";	
		$data['controlnamehead']="Newsletter";
		$data['controlnamemsg']="Newsletter";
        $data['results'] = $this->Core_Model->SelectRecord('newsletter',array(),array(),'id desc');
        $this->adminheader();	
        $this->load->view("admin/Newsletter",$data);	
        $this->adminfooter();
    }
    
    public function Testimonial(){
        $data['control']="Testimonial";
		$data['controlname']="Testimonial";	
		$data['controlnamehead']="Testimonial";
		$data['controlnamemsg']="Testimonial";
        $data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');
        $data['results'] = $this->Core_Model->SelectRecord('testimonial',array(),array(),'id desc');
        $this->adminheader();	
        $this->load->view("admin/Testimonial",$data);	
        $this->adminfooter();
    }
    
    public function addtestimonial()
{
$data['control']="Managetestimonial";
$data['controlnamemsg']="Add testimonial";
$data['controlname']="testimonial";
$data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');		
$this->adminheader();	
$this->load->view("admin/AddTestimonial",$data);	
$this->adminfooter(); 
}
    
    public function edittestimonial($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}
$data['control']="Managetestimonial";
$data['controlnamemsg']="Edit testimonial";
$data['controlname']="testimonial";
$data['category']=$this->Common_Model->getdata("testimonialcategory",$where="",$sort='name asc');	
$data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');	
$where=array("id"=>$id);
$data['testimonial']=$this->Common_Model->getdata("testimonial",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Edittestimonial",$data);	
$this->adminfooter();
}

public function createtestimonial()
{
        $this->form_validation->set_rules('title', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('location', 'Location', 'required');
		//$this->form_validation->set_rules('uid', 'User', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addtestimonial();
		}
		else
		{            
		 $photo=$this->savecropimage("photo","upload/blog/");		  
		  
		 //$ophoto=$this->imageUpload("ophoto","upload/testimonial/");
					
	     $datas=array("name"=>$this->input->post("title"),"address"=>$this->input->post("location"),"message"=>$this->input->post("description"),"image"=>$photo);
		 $updt=$this->Common_Model->insert("testimonial",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Testimonial added successfully");
		   redirect("Admin/testimonial");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Admin/testimonial");
	     }
		}		
}

public function updatetestimonial($id=0)
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('category[]', 'Category', 'required');
		$this->form_validation->set_rules('uid', 'User', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->edittestimonial($id);
		}
		else
		{	
	      if(!empty($_FILES['ophoto']['name']))
		  {
		  $this->unsetImage($id,'testimonial','ophoto','upload/testimonial/');		  		 
		  $ophoto=$this->imageUpload("ophoto","upload/testimonial/");		 	     
		  }
		  else{
		  $ophoto=$this->input->post('ophoto1');
          }
		  $category="";	
		  if($this->input->post('category'))
          $category=implode(",", $this->input->post('category'));		

          $where=array("id"=>$id);	

          if($this->input->post("photo"))
		  {
		  $this->unsetImage($id,'testimonial','photo','upload/testimonial/');		  		 
		  $photo=$this->savecropimage("photo","upload/testimonial/");		 	     
		  }
		  else{
		  $photo=$this->input->post('photo1');
          }			  
		
	      $datas=array("title"=>$this->input->post("title"),"description"=>$this->input->post("description"),"category"=>$category,"uid"=>$this->input->post("uid"),"photo"=>$photo,"ophoto"=>$ophoto,
		  "status"=>0,"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("testimonial",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Testimonial updated successfully");
		   redirect("Managetestimonial/testimonial");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Managetestimonial/edittestimonial/$id");
	     }
		}		
}

public function deleteTestimonial()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Testimonial delete successfully.");
			redirect("Admin/testimonial");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Admin/testimonial");
		}
		else{
			$id=$this->input->post('id');            
            $this->unsetImage($id,'testimonial','image','upload/testimonial/');			
		    $data=$this->Common_Model->deletedata('testimonial',array('id'=>$id));			
			echo $data;
		}			
	}
	
	
public function showtestimonial($id,$status)
	{
		$site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
        $testimonial_name=$this->getSingleValue($id,'testimonial','title');
		$uid=$this->getSingleValue($id,'testimonial','uid');
		$name=$this->getSingleValue($uid,'user','name');
		$email=$this->getSingleValue($uid,'user','email');
            $sts=0;
			$v="";
			if($status==1)
			{
				$sts=1;
				$v="Approved";
				$message="Your ".$testimonial_name." testimonial has been approved.";
				$subject="Testimonial approved at ".$site_title;
	        }
			if($status==2)
			{
				$sts=2;
				$v="Disapproved";
				$message="Your ".$testimonial_name." testimonial has been disapproved.";
				$subject="Testimonial disapproved at ".$site_title;
			}
			
			$datas['messages']=array($name,$message);
		    $this->email($email,$subject,$datas);
			
            $udata=array("status"=>$sts);
			$data=$this->Common_Model->update('testimonial',$udata,array('id'=>$id));			
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Testimonial ".$v." successfully.");
			redirect("Managetestimonial/testimonial");
	}
    
}