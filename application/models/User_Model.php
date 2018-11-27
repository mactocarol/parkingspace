<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model Extends CI_Model {

function __construct() {
        parent::__construct();        	    		
    }
	
public function getuserlist($id=0,$type='')
{
	$name_english=$this->input->post("username");
	$created_dt=$this->input->post("sessiondate");
    $country=$this->input->post("country");
	$birthdate=$this->input->post("birthdate");
	
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
	
	if($name_english!='')
	$this->db->like("name_english",$name_english);

	if($country!='')
	$this->db->where("country",$country);
	
	if($birthdate!='')
	$this->db->where("birthdate",$birthdate);
		
	if($id!=0)
	$this->db->where("id",$id);

    if($type!='')
	{		
	$this->db->where("type",$type);
	}

    $this->db->order_by("id","desc");
	return $this->db->get("user")->result();   
}



}
?>