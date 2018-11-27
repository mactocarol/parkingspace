<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();

class Message extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->uid=$this->session->userdata("uid");
        $this->type=$this->session->userdata("type");
        $this->load->model("Message_Model");
    }

public function index()
{
   $this->checkSession();	
   $data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->uid),$sort="id desc"); 	  
   $this->frontheader();
   $this->load->view("Dashboard",$data);
   $this->load->view("Message",$data);
   $this->frontfooter();  
}


public function sendmessage()
{
$this->checkSession();
$final_image="";
if(!empty($_FILES['image']['name']))
{	
$final_image=$this->imageUpload("image","upload/chat/");
}	  
          $cdt=date("Y-m-d H:i:s");
	      $datas=array("photo"=>$final_image,"create_dt"=>$cdt,"rid"=>$this->input->post("rid"),"message"=>$this->input->post("chatmsg"),"sid"=>$this->session->userdata('uid'));		
		  $id=$this->Common_Model->insert("chat",$datas);
		  echo $id;	
}

public function getuserlist()
{
	   $this->checkSession();
	   $id=$this->session->userdata("uid");   
   	   $data['userlist']=$this->Message_Model->getuserlist($id);	
	   $errors = array_filter($data['userlist']);

		if (!empty($errors)){
			echo $dt=$this->load->view("Ajaxmessage/Userlist",$data,TRUE);
		}
		else{
			echo 1;
		}
    		
}

public function getmessagelist()
{
	   $this->checkSession();
	   $id=$this->session->userdata("uid");
       $rid=$this->input->post("rid");
       $datas=array("status"=>1);
       $this->db->where("sid",$rid);
       $this->db->where("rid",$id);
       $this->db->update("chat",$datas); 	   
 
   	   $data['msg']=$this->Message_Model->getmessagelist($id,$rid);
   	   $data['ridinfo']=$this->Message_Model->getridinfo($rid);	
       echo $dt=$this->load->view("Ajaxmessage/Messagelist",$data,TRUE);

}

public function getajaxmessagelist()
{
    	$this->checkSession();
		
	   $id=$this->session->userdata("uid");
       $rid=$this->input->post("rid");	   

   	   $data['msg']=$this->Message_Model->getmessagelist($id,$rid);	
       echo $dt=$this->load->view("Ajaxmessage/Messageajaxlist",$data,TRUE);
}

}