<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_Model Extends CI_Model {

function __construct() {
        parent::__construct();        	    		
    }
	
public function getfeaturedpropertypayment($id=0)
{
	$this->db->select("feature_property_payment.*,property.title,user.name,user.photo,user.type");
	$this->db->join("property","feature_property_payment.pid=property.id","left");
	$this->db->join("user","feature_property_payment.uid=user.id","left");
	
	$name_english=$this->input->post("username");
	$created_dt=$this->input->post("sessiondate");
    $invoiceno=$this->input->post("invoiceno");
	$transactionid=$this->input->post("transactionid");
	$orderid=$this->input->post("orderid");
	
	if($created_dt!="")
    {
       $nameParts1 = explode('-',$created_dt); 
       $sfirst = $nameParts1[0];
       $sfirst=date("Y-m-d",strtotime($sfirst));
       if(empty($nameParts1[1]))
       {
          $this->db->where("DATE_FORMAT(feature_property_payment.created_dt,'%Y-%m-%d')",$sfirst);
       }
       else
       {
          $slast = array_pop($nameParts1);
          $slast=date("Y-m-d",strtotime($slast));
          $this->db->where("DATE_FORMAT(feature_property_payment.created_dt,'%Y-%m-%d') BETWEEN '".$sfirst."' AND '".$slast."'");
       }
	}
	
	if($name_english!='')
	$this->db->like("user.name",$name_english);

	if($invoiceno!='')
	$this->db->where("invoiceno",$invoiceno);
	
	if($transactionid!='')
	$this->db->where("transactionid",$transactionid);

    if($orderid!='')
	$this->db->where("orderid",$orderid);
	
	
	if($id!="")
	$this->db->where("feature_property_payment.id",$id);

	$this->db->order_by("feature_property_payment.id","desc");
	return $this->db->get("feature_property_payment")->result();   
}


public function getmembershippayment($id=0)
{
	$this->db->select("payment_membership.*,packagelist.title,user.name,user.photo,user.type,user.mdate,user.duration");
	$this->db->join("packagelist","payment_membership.pid=packagelist.id","left");
	$this->db->join("user","payment_membership.uid=user.id","left");
	
	$name_english=$this->input->post("username");
	$created_dt=$this->input->post("sessiondate");
    $title=$this->input->post("title");
	$transactionid=$this->input->post("transactionid");
	$orderid=$this->input->post("orderid");
	
	if($created_dt!="")
    {
       $nameParts1 = explode('-',$created_dt); 
       $sfirst = $nameParts1[0];
       $sfirst=date("Y-m-d",strtotime($sfirst));
       if(empty($nameParts1[1]))
       {
          $this->db->where("DATE_FORMAT(payment_membership.created_dt,'%Y-%m-%d')",$sfirst);
       }
       else
       {
          $slast = array_pop($nameParts1);
          $slast=date("Y-m-d",strtotime($slast));
          $this->db->where("DATE_FORMAT(payment_membership.created_dt,'%Y-%m-%d') BETWEEN '".$sfirst."' AND '".$slast."'");
       }
	}
	
	if($name_english!='')
	$this->db->like("user.name",$name_english);

	if($title!='')
	$this->db->where("packagelist.title",$title);
	
	if($transactionid!='')
	$this->db->where("transactionid",$transactionid);

    if($orderid!='')
	$this->db->where("orderid",$orderid);
	
	
	if($id!="")
	$this->db->where("payment_membership.id",$id);

	$this->db->order_by("payment_membership.id","desc");
	return $this->db->get("payment_membership")->result();   
}

}
?>