<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Payment extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
		$this->load->model("Payment_Model");
        $this->checkSessionAdmin();		
    }

	/*--- start featuredpayment --*/	
	public function featuredpayment()
{
$data['control']="Payment";
$data['controlname']="featuredpayment";	
$data['controlnamehead']="Featured property payment list";	
$data['featuredpayment']=$this->Payment_Model->getfeaturedpropertypayment();

$this->adminheader();	
$this->load->view("admin/Featuredpayment",$data);	
$this->adminfooter(); 
}

public function viewfeaturedpayment($id=0)
{

$data['featured']=$this->Payment_Model->getfeaturedpropertypayment($id);	
$this->adminheader();	
$this->load->view("admin/Viewfeaturedpayment",$data);	
$this->adminfooter(); 
}


public function deletefeaturedpayment()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Featured payment delete successfully.");
			redirect("Payment/featuredpayment");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Payment/featuredpayment");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('feature_property_payment',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end featuredpayment --*/
	
	
	/*--- start membershippayment --*/	
	public function membershippayment()
{
$data['control']="Payment";
$data['controlname']="membershippayment";	
$data['controlnamehead']="Membership payment list";	
$data['membershippayment']=$this->Payment_Model->getmembershippayment();

$this->adminheader();	
$this->load->view("admin/Membershippayment",$data);	
$this->adminfooter(); 
}

public function viewmembershippayment($id=0)
{

$data['featured']=$this->Payment_Model->getmembershippayment($id);	
$this->adminheader();	
$this->load->view("admin/Viewmembershippayment",$data);	
$this->adminfooter(); 
}


public function deletemembershippayment()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Membership payment delete successfully.");
			redirect("Payment/membershippayment");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Payment/membershippayment");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('payment_membership',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end membershippayment --*/
	
}