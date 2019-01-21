<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Managecoupon extends MY_Base_Controller {
	
	public function __construct(){
		parent::__construct();
		
	}
	
	public function coupon()
	{
        $data['control']="Managecoupon";
        $data['controlname']="coupon";
        $data['controlnamehead']="Coupon code";	
        $data['coupon']=$this->Common_Model->getdata("coupon",$where='',$sort='id desc');	
        $this->adminheader();		
		$this->load->view('admin/Coupon',$data);
		$this->adminfooter();
	}
	
	public function addcoupon()
	{
$data['control']="Managecoupon";
$data['controlnamemsg']="Add Coupon";
$data['controlname']="coupon";	
$this->adminheader();	
$this->load->view("admin/Addcoupon",$data);	
$this->adminfooter(); 
	}
	
	public function editcoupon($id=0)
	{		
$data['control']="Managecoupon";
$data['controlnamemsg']="Edit Coupon";
$data['controlname']="coupon";
$data['coupon']=$this->Common_Model->getdata("coupon",$where=array("id"=>$id),$sort='');	
$this->adminheader();	
$this->load->view("admin/Editcoupon",$data);	
$this->adminfooter(); 
	}
	
	public function createcoupon()
	{
		 $this->form_validation->set_rules('name', 'Name', 'required');
		 $this->form_validation->set_rules('type', 'Price type', 'required');
		 $this->form_validation->set_rules('price', 'Price', 'required');
				
		if ($this->form_validation->run() == FALSE)
		{			
			$this->addcoupon();
		}
		else {
			$data=array(
			"created_dt"=>date("Y-m-d H:i:s"),
			"updated_dt"=>date("Y-m-d H:i:s"),
			"price"=>$this->input->post("price"),
			"name"=>$this->input->post("name"),
			"type"=>$this->input->post("type")
			);
			$this->db->insert("coupon",$data);
			$this->session->set_flashdata('result', 1);
            $this->session->set_flashdata('class', 'success');
            $this->session->set_flashdata('msg', "Coupon inserted successfully." );
            redirect("Managecoupon/coupon");
		}
	}
	
	public function updatecoupon($id=0)
	{
		 $this->form_validation->set_rules('name', 'Name', 'required');
		 $this->form_validation->set_rules('type', 'Price type', 'required');
		 $this->form_validation->set_rules('price', 'Price', 'required');
				
		if ($this->form_validation->run() == FALSE)
		{			
			$this->editcoupon($id);
		}
		else {
			$data=array(
			"updated_dt"=>date("Y-m-d H:i:s"),
			"price"=>$this->input->post("price"),
			"name"=>$this->input->post("name"),
			"type"=>$this->input->post("type")
			);
			$this->db->where("id",$id);
			$this->db->update("coupon",$data);
			$this->session->set_flashdata('result', 1);
            $this->session->set_flashdata('class', 'success');
            $this->session->set_flashdata('msg', "Coupon updated successfully." );
            redirect("Managecoupon/coupon");
		}
	}
	
	
	

public function deletecoupon()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Coupon delete successfully.");
			redirect("Managecoupon/coupon");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Managecoupon/coupon");
		}
		else{
			$id=$this->input->post('id');			

			$data=$this->Common_Model->deletedata('coupon',array('id'=>$id));			
			echo $data;
		}			
	}
	
	public function expirecoupon()
	{
		$id=$this->input->post("id");
		$data=array("status"=>2);
		$this->db->where("id",$id);
		$this->db->update("coupon",$data);
		echo true;
	}
	
		public function activecoupon()
	{
		$id=$this->input->post("id");		
		$data=array("status"=>1);
		$this->db->where("id",$id);
		$this->db->update("coupon",$data);
		echo true;        
	}
	
	public function getajaxcoupondata()
	{
		$control=$this->input->post("control");
		$controlname=$this->input->post("controlname");
		$this->db->select("id,name,price,type,status,created_dt");
		$this->db->order_by("id","desc");
		$result=$this->db->get("coupon")->result();
		$sno=1;
		foreach($result as $key => $list)
		{
	        $sts="";
			$st="";
			if($list->status==1)
			{
			$st="Active";	
			$sts='<a onclick="expirecoupon('.$list->id.');" title="Expire coupon" class="btn-xs btn-danger" href="#"><i class="fa  fa-thumbs-down"></i></a>';
			}
			if($list->status==0 || $list->status==2)
			{
			$st="Expired";	
			$sts='<a onclick="activecoupon('.$list->id.');" title="Active coupon" class="btn-xs btn-success" href="#"><i class="fa fa-thumbs-up"></i></a>';		
			}							 
			$res='<a href="'.base_url().$control.'/edit'.$controlname.'/'.$list->id.'" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
			'.$sts.'
            <a href="#"  class="btn btn-xs btn-primary" data-toggle="modal" data-target=".myModal"   onClick="setID('.$list->id.');"  title="Delete" class="btn btn-xs btn-danger"><i  class="fa fa-trash-o"></i></a>';
			 $result[$key]->sts =$st;
			 $result[$key]->sno =$sno;
			 $result[$key]->action =$res;	
			 $sno++;
		}
		 echo json_encode($result);
	}
	

	
}