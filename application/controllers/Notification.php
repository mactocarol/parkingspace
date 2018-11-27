<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Notification extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->checkSessionAdmin();  				 
    }
	
	function getCount(){
		   $where=array("badge_status"=>1);
           $newuser=$this->Common_Model->gettotal("user",$where);
           echo $newuser;	   
    }
	
	public function updateBadgeStatus()
    {  
            $updateData['badge_status']=0;
            $this->db->update('user',$updateData);
            return true;
    }
	
	public function updateReadStatus()
    {
            $id = $this->input->post('id');		
            $updateData=array("read_status"=>0);
			$where=array("id"=>$id);
            $data=$this->Common_Model->update('user',$updateData,$where);
            return $data;
    }
	
	public function getData()
	{
	   $where=array("read_status"=>1);
       $sort="'id','desc'";		
   	   $data['user']=$this->Common_Model->getdata("user",$where,$sort);
       $uc=count($data['user']);		   
       if($uc==0)
	   {
		   echo 0;
	   }	
       else{	   
	   echo $dt=$this->load->view("admin/notification/List",$data,TRUE);
       }
	}

}