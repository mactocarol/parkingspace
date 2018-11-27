<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Manageparkingowner extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->id=$this->session->userdata("id");
        $this->type=$this->session->userdata("type");
        $this->checkSessionAdmin();		
    }

public function user()
{
	$name=$this->input->post("username");
	$created_dt=$this->input->post("sessiondate");
    $country=$this->input->post("country");
	$emailv=$this->input->post("emailv");
	$statusv=$this->input->post("statusv");

	
	   $this->db->select("user.*,countries.countryName");
	   $this->db->join("countries","user.country=countries.countryID","left");
	   $this->db->where("user.type","Owner");
	   
	if($created_dt!="")
    {
       $nameParts1 = explode('-',$created_dt); 
       $sfirst = $nameParts1[0];
       $sfirst=date("Y-m-d",strtotime($sfirst));
       if(empty($nameParts1[1]))
       {
          $this->db->where("DATE_FORMAT(user.created_dt,'%Y-%m-%d')",$sfirst);
       }
       else
       {
          $slast = array_pop($nameParts1);
          $slast=date("Y-m-d",strtotime($slast));
          $this->db->where("DATE_FORMAT(user.created_dt,'%Y-%m-%d') BETWEEN '".$sfirst."' AND '".$slast."'");
       }
	}
	
	if($name!='')
	$this->db->like("name",$name);

    if($emailv!='')
	{
	if($emailv==2)
	$this->db->where("email_status",0);
    else
	$this->db->where("email_status",$emailv);
	}

    if($statusv!='')
	{
	if($statusv==3)
	$this->db->where("status",0);
    else
	$this->db->where("status",$statusv);
	}

	if($country!='')
	$this->db->where("country",$country);
	  
	   $this->db->order_by("user.id","desc");
       $result = $this->db->get('user')->result();
       foreach($result as $key=>$value)
{
	
}
   $data['user']=$result; 

	
   $data['control']="Manageparkingowner";
   $data['controlname']="user";
   $data['controlnamehead']="Parking owner";
   $data['country']=$this->Common_Model->getdata("countries",$where='',$sort='countryName asc');      
   $this->adminheader();
   $this->load->view("admin/Parkingowner",$data);
   $this->adminfooter();  
}

public function viewuser($id=0)
{
	   $this->db->select("user.*,countries.countryName");
	   $this->db->join("countries","user.country=countries.countryID","left");
	   $this->db->where("user.id",$id);
	   $this->db->where("user.type","Owner");
	   $this->db->order_by("user.id","desc");
       $result = $this->db->get('user')->result();
       foreach($result as $key=>$value)
{
}
   $data['user']=$result;  
   $this->adminheader();
   $this->load->view("admin/Viewparkingowner",$data);
   $this->adminfooter();  
}

public function adduser()
{
   $data['control']="Manageparkingowner";
   $data['controlnamemsg']="Add parking owner";
   $data['controlname']="user";
   $data['country']=$this->Common_Model->getdata("countries",$where='',$sort='countryName asc');    
   $this->adminheader();
   $this->load->view("admin/Addparkingowner",$data);
   $this->adminfooter();  
}

public function edituser($id=0)
{
   $data['control']="Manageparkingowner";
   $data['controlnamemsg']="Edit parking owner";
   $data['controlname']="user";	
   $data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$id,"type"=>'Owner'),$sort="");
   $data['country']=$this->Common_Model->getdata("countries",$where='',$sort='countryName asc');    
   $this->adminheader();
   $this->load->view("admin/Editparkingowner",$data);
   $this->adminfooter();  
}

public function createuser()
{
        $this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules("phone","Phone","required");
		$this->form_validation->set_rules("country","Country","required");
		$this->form_validation->set_rules("address","Address","required");
		$this->form_validation->set_rules("zipcode","Zipcode","required");
		$this->form_validation->set_rules("description","Description","required");
		$this->form_validation->set_rules("facebook","Facebook","required");
		$this->form_validation->set_rules("google","Google","required");
		$this->form_validation->set_rules("linkedin","Linkedin","required");
		$this->form_validation->set_rules("skype","Skype","required");
		$this->form_validation->set_rules("twitter","Twitter","required");

		if ($this->form_validation->run() == FALSE)
		{
			$this->adduser();
		}
		else
		{	
         $photo=$this->savecropimage("photo","upload/user/");
        
         $email=$this->input->post("email"); 
         $password=$this->input->post("password");		 
         $ophoto=$this->imageUpload("ophoto","upload/user/");
	     $datas=array("photo"=>$photo,"email"=>$this->input->post("email"),"contact"=>$this->input->post("phone"),"name"=>$this->input->post("name"),"zipcode"=>$this->input->post("zipcode"),"password"=>md5($password),"address"=>$this->input->post("address"), "country"=>$this->input->post("country"),"created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"),"skype"=>$this->input->post("skype"),"google"=>$this->input->post("google"),"facebook"=>$this->input->post("facebook"),"linkedin"=>$this->input->post("linkedin"),"twitter"=>$this->input->post("twitter"),"description"=>$this->input->post("description"),"type"=>"Owner","ophoto"=>$ophoto
		 );
		 
		 $updt=$this->Common_Model->insert("user",$datas);
		 
		 if($updt)
         { 

         $ids=base64_encode($updt);
		 $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
		 $name=$this->getSingleValue($updt,'user','name');
         $message="Thanks for creating account with us at <a href=".base_url().">".$site_title."</a>. <br>
         Please click below link account verify <br> <a href='".base_url()."Verify/account/".$ids."'>Verify Email</a><br>
         To get started, please confirm your email address so that we know your details are correct. 
		 <br>Your login details are:<br>
		 Login id: ".$email."<br>
		 Password: ".$password."<br>
		 To get started, please confirm your email address so that we know your details are correct.";
	     $datas['messages']=array($name,$message);
		 $this->email($email,"Registration at ".$site_title,$datas);
		  
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "User created successfully");
		   redirect("Manageparkingowner/user");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to create");
           redirect("Manageparkingowner/adduser");
	     }
		}		
}

public function updateuser($id=0)
{
        $this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
		$this->form_validation->set_rules("phone","Phone","required");
		$this->form_validation->set_rules("country","Country","required");
		$this->form_validation->set_rules("address","Address","required");
		$this->form_validation->set_rules("zipcode","Zipcode","required");
		$this->form_validation->set_rules("description","Description","required");
		$this->form_validation->set_rules("facebook","Facebook","required");
		$this->form_validation->set_rules("google","Google","required");
		$this->form_validation->set_rules("linkedin","Linkedin","required");
		$this->form_validation->set_rules("skype","Skype","required");
		$this->form_validation->set_rules("twitter","Twitter","required");

		if ($this->form_validation->run() == FALSE)
		{
			$this->edituser($id);
		}
		else
		{	
	   
		  if($this->input->post("photo"))
		  {
		  $this->unsetImage($id,'user','photo','upload/user/');		  		 
		  $photo=$this->savecropimage("photo","upload/user/");		 	     
		  }
		  else{
		  $photo=$this->input->post('photo1');
          }
		  
		  
		   if(!empty($_FILES['ophoto']['name']))
		  {
		  $this->unsetImage($id,'user','ophoto','upload/user/');		  		 
		  $ophoto=$this->imageUpload("ophoto","upload/user/");		 	     
		  }
		  else{
		  $ophoto=$this->input->post('ophoto1');
          }

         $where=array("id"=>$id);

	     $datas=array("photo"=>$photo,"email"=>$this->input->post("email"),"contact"=>$this->input->post("phone"),"name"=>$this->input->post("name"),"zipcode"=>$this->input->post("zipcode"),"address"=>$this->input->post("address"),"ophoto"=>$ophoto,
		 "country"=>$this->input->post("country"),"updated_dt"=>date("Y-m-d H:i:s"),
		 "skype"=>$this->input->post("skype"),"google"=>$this->input->post("google"),"facebook"=>$this->input->post("facebook"),"linkedin"=>$this->input->post("linkedin"),"twitter"=>$this->input->post("twitter"),"description"=>$this->input->post("description")
		 );
		 
		 $updt=$this->Common_Model->update("user",$datas,$where);
		 
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Profile updated successfully");
		   redirect("Manageparkingowner/user");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Manageparkingowner/edituser");
	     }
		}		
}

public function email_check($str)
	{
	 $email = $this->input->post('email1');
  
     $this->db->where('email !=', $email);
	 $this->db->where('email', $str);
     $query = $this->db->get('user');

    if ($query->num_rows() > 0) {
        $this->form_validation->set_message('email_check', 'Email ID already exists');
	    return FALSE;
    } else {
        return true;
    }
    }

public function deleteuser()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "User delete successfully.");
			redirect("Manageparkingowner/user");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Manageparkingowner/user");
		}
		else{
			$id=$this->input->post('id');
            $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
            $name=$this->getSingleValue($id,'user','name');
			$email=$this->getSingleValue($id,'user','email');
            $message="Your account has been deleted due to invoilence activity.";
	        $datas['messages']=array($name,$message);
		    $this->email($email,"Account delete at ".$site_title,$datas);

			$this->unsetImage($id,'user','photo','upload/user/');
			$data=$this->Common_Model->deletedata('user',array('id'=>$id));			
			echo $data;
		    }			
	}


public function activeprofile()
	{
		if($this->uri->segment(3)=='active')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "profile active successfully.");
			redirect("Manageparkingowner/user");
		}
		else if($this->uri->segment(3)=='suspend')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', " profile suspend successfully.");
			redirect("Manageparkingowner/user");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to active/suspend.");
			redirect("Manageparkingowner/user");
		}
		else{
			
			$id=$this->input->post('id');
			$site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
            $name=$this->getSingleValue($id,'user','name');
			$email=$this->getSingleValue($id,'user','email');
			$status=$this->getSingleValue($id,'user','status');
			$sts=0;
			if($status==1)
			{
				$sts=2;
				$message="Your account has been suspended due to invoilence activity.";
				$subject="Account Suspended at ".$site_title;
			}
			if($status==0)
			{
				$sts=1;
				$message="Your account has been active.";
				$subject="Account Active at ".$site_title;
			}
			if($status==2)
			{
				$sts=1;
				$message="Your account has been reactive.";
				$subject="Account Rective at ".$site_title;
			}
            
	        $datas['messages']=array($name,$message);
		    $this->email($email,$subject,$datas);
			
            $udata=array("status"=>$sts);
			$data=$this->Common_Model->update('user',$udata,array('id'=>$id));			
			echo $sts;
		    }
	}


public function changepassword()
	{
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->user();
		}
		else
		{
            $id=$this->input->post("id");

			$password=$this->input->post("password");
            $datas=array("password"=>md5($password));
			$udata=$this->Common_Model->update('user',$datas,array('id'=>$id));			
			if($udata)
			{
$site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');				
            $name=$this->getSingleValue($id,'user','name');
			$email=$this->getSingleValue($id,'user','email');			
			$message="Your password has been updated by admin. <br>Now your password: ".$password;

	        $datas['messages']=array($name,$message);
		    $this->email($email,"Password Update at ".$site_title,$datas);
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', " password changed successfully.");
			}
			else{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'danger');
			$this->session->set_flashdata('msg', "Error to change.");			
			}
            redirect("Manageparkingowner/user");
		}			
	}	

	
}