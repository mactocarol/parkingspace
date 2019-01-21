<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Package extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        		
    }

	public function index()
{
$result=$this->Common_Model->getdata("packagelist",$where='',$sort='');	
foreach($result as $key =>$value)
{
    $arr1= explode(",", $value->feature);
	$this->db->where_in("id",$arr1);
	$feature=$this->db->get("feature")->result();
	$result[$key]->feature=$feature;	
}
   $data['packagelist']=$result;   
   $this->frontheader();
   $this->load->view("Package",$data);
   $this->frontfooter();  
}


/*--- start feature --*/	
	public function feature()
{
$this->checkSessionAdmin();	
$data['control']="Package";
$data['controlname']="feature";	
$data['controlnamehead']="Feature";	
$data['feature']=$this->Common_Model->getdata("feature",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Feature",$data);	
$this->adminfooter(); 
}

public function addfeature()
{
$this->checkSessionAdmin();	
$data['control']="Package";
$data['controlnamemsg']="Add feature";
$data['controlname']="feature";	
$this->adminheader();	
$this->load->view("admin/Addfeature",$data);	
$this->adminfooter(); 
}

public function editfeature($id=0)
{
$this->checkSessionAdmin();	

$data['control']="Package";
$data['controlnamemsg']="Edit feature";
$data['controlname']="feature";
	
$where=array("id"=>$id);
$data['feature']=$this->Common_Model->getdata("feature",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editfeature",$data);	
$this->adminfooter();
}

public function createfeature()
{
	    $this->checkSessionAdmin();
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('no', 'No', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addfeature();
		}
		else
		{
					
	     $datas=array("title"=>$this->input->post("title"),"name"=>$this->input->post("name"),
         "no"=>$this->input->post("no"),"created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("feature",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Feature added successfully");
		   redirect("Package/feature");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Package/addfeature");
	     }
		}		
}

public function updatefeature($id=0)
{
	    $this->checkSessionAdmin();
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('no', 'No', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editfeature($id);
		}
		else
		{	

         $where=array("id"=>$id);		 
		
	     $datas=array("title"=>$this->input->post("title"),"name"=>$this->input->post("name"),
         "no"=>$this->input->post("no"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("feature",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Feature updated successfully");
		   redirect("Package/feature");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Package/editfeature/$id");
	     }
		}		
}

public function deletefeature()
	{
		$this->checkSessionAdmin();
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Feature delete successfully.");
			redirect("Package/feature");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Package/feature");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('feature',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end feature --*/



	
/*--- start packagelist --*/	
	public function packagelist()
{
$this->checkSessionAdmin();	
$data['control']="Package";
$data['controlname']="packagelist";	
$data['controlnamehead']="Package list";	
$result=$this->Common_Model->getdata("packagelist",$where='',$sort='');	
foreach($result as $key =>$value)
{
    $arr1= explode(",", $value->feature);
	$this->db->where_in("id",$arr1);
	$result1=$this->db->get("feature")->result();
	$feature=array();
	foreach($result1 as $rs1)
	{
		$feature[]=$rs1->name;		
	}
	$feature=implode(",",$feature);
	$result[$key]->feature=$feature;	
}
$data['packagelist']=$result;
$this->adminheader();	
$this->load->view("admin/Packagelist",$data);	
$this->adminfooter(); 
}

public function addpackagelist()
{
$this->checkSessionAdmin();	
$data['control']="Package";
$data['controlnamemsg']="Add Package list";
$data['controlname']="packagelist";
$data['feature']=$this->Common_Model->getdata("feature",$where='',$sort='title asc');	
	
$this->adminheader();	
$this->load->view("admin/Addpackagelist",$data);	
$this->adminfooter(); 
}

public function editpackagelist($id=0)
{
$this->checkSessionAdmin();	

$data['control']="Package";
$data['controlnamemsg']="Edit Package list";
$data['controlname']="packagelist";
$data['feature']=$this->Common_Model->getdata("feature",$where='',$sort='title asc');	
	
$where=array("id"=>$id);
$data['packagelist']=$this->Common_Model->getdata("packagelist",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editpackagelist",$data);	
$this->adminfooter();
}

public function createpackagelist()
{
	    $this->checkSessionAdmin();
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('validity', 'Validity', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addpackagelist();
		}
		else
		{
		 $feature="";
         if($this->input->post("feature"))		 
         $feature=implode(",", $this->input->post('feature'));
	 
	     $datas=array("feature"=>$feature,"title"=>$this->input->post("title"),"description"=>$this->input->post("description"),
         "validity"=>$this->input->post("validity"),"price"=>$this->input->post("price"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("packagelist",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Package list added successfully");
		   redirect("Package/packagelist");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Package/addpackagelist");
	     }
		}		
}

public function updatepackagelist($id=0)
{
	    $this->checkSessionAdmin();
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('validity', 'Validity', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editpackagelist($id);
		}
		else
		{	

         $where=array("id"=>$id);
         $feature="";
         if($this->input->post("feature"))		 
         $feature=implode(",", $this->input->post('feature'));		
		
	    $datas=array("feature"=>$feature,"title"=>$this->input->post("title"),"description"=>$this->input->post("description"),
        "validity"=>$this->input->post("validity"),"price"=>$this->input->post("price"),
		"created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("packagelist",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Package list updated successfully");
		   redirect("Package/packagelist");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Package/editpackagelist/$id");
	     }
		}		
}

public function deletepackagelist()
	{
		$this->checkSessionAdmin();
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Package list delete successfully.");
			redirect("Package/packagelist");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Package/packagelist");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('packagelist',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end packagelist --*/



	/*--- start feature_package --*/	
	public function feature_package()
{
$this->checkSessionAdmin();	
$data['control']="Package";
$data['controlname']="feature_package";	
$data['controlnamehead']="Featured property package";	
$data['feature_package']=$this->Common_Model->getdata("feature_package",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Feature_package",$data);	
$this->adminfooter(); 
}

public function addfeature_package()
{
$this->checkSessionAdmin();	
$data['control']="Package";
$data['controlnamemsg']="Add featured property package";
$data['controlname']="feature_package";	
$this->adminheader();	
$this->load->view("admin/Addfeature_package",$data);	
$this->adminfooter(); 
}

public function editfeature_package($id=0)
{
$this->checkSessionAdmin();	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}
$data['control']="Package";
$data['controlnamemsg']="Edit featured property package";
$data['controlname']="feature_package";
	
$where=array("id"=>$id);
$data['feature_package']=$this->Common_Model->getdata("feature_package",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editfeature_package",$data);	
$this->adminfooter();
}

public function createfeature_package()
{
	    $this->checkSessionAdmin();
        $this->form_validation->set_rules('days', 'Validity', 'required');
		$this->form_validation->set_rules('price', 'Price', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addfeature_package();
		}
		else
		{
					
	     $datas=array("days"=>$this->input->post("days"),"price"=>$this->input->post("price"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("feature_package",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Feature package added successfully");
		   redirect("Package/feature_package");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Package/addfeature_package");
	     }
		}		
}

public function updatefeature_package($id=0)
{
	    $this->checkSessionAdmin();
        $this->form_validation->set_rules('days', 'Validity', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editfeature_package($id);
		}
		else
		{	

         $where=array("id"=>$id);		 
		
	     $datas=array("days"=>$this->input->post("days"),"price"=>$this->input->post("price"),
         "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("feature_package",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Feature package updated successfully");
		   redirect("Package/feature_package");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Package/editfeature_package/$id");
	     }
		}		
}

public function deletefeature_package()
	{
		$this->checkSessionAdmin();
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Feature package delete successfully.");
			redirect("Package/feature_package");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Package/feature_package");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('feature_package',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end package feature --*/
	
	
	public function cancelplan()
{
$this->checkSession();	
$this->session->set_flashdata('result', 1);
$this->session->set_flashdata('class', 'success');
$this->session->set_flashdata('msg', "Plan has been cancelled successfully");
redirect("Package");
}

public function bookplan()
{
 $this->checkSession();	
 $uid  = $this->session->userdata('uid');
 $pid = $this->input->post('item_number'); // product ID
 $today = date("Ymd");
 $rand = strtoupper(substr(uniqid(sha1(time())),0,4));
 $orderid = $today . $rand;
 $descr="";
 if($this->input->post('item_name'))
 {
	$descr= $this->input->post('item_name'); 
 }
 $product_transaction = $this->input->post('txn_id'); // PayPal transaction ID
 $product_price= $this->input->post('mc_gross'); // PayPal received amount
 $product_currency = $this->input->post('mc_currency'); 

$cdt=date("Y-m-d H:i:s");
$datas=array("created_dt"=>$cdt,"updated_dt"=>$cdt,'uid'=>$uid,'pid'=>$pid,'price'=>$product_price,"orderid"=>$orderid,'paypal'=>$descr,
'transactionid'=>$product_transaction,'currency'=>$product_currency);	
$ids=$this->Common_Model->insert("payment_membership",$datas);
if($ids)
{
  $lid=$ids;
  $val=$this->getSingleValue($pid,'packagelist','validity');
  $ftr=$this->getSingleValue($pid,'packagelist','feature');
 
 
  $pdata=array("mid"=>$pid,"mdate"=>$cdt,"planemail"=>0,
  "planprice"=>$product_price,"duration"=>$val,"speciality"=>$ftr,"companyname"=>$orderid);
  $this->db->where("id",$uid);
  $this->db->update("user",$pdata);
  
  $pdatae=array("pc"=>1);
  $this->db->where("uid",$uid);
  $this->db->update("property",$pdatae);
  
 $email=$this->getSingleValue($uid,'user','email');
 $name=$this->getSingleValue($uid,'user','name');
 $admin_email=$this->getSingleValue(1,'admin_login','email');
 $admin_name=$this->getSingleValue(1,'admin_login','name');
 
 $pname=$this->getSingleValue($pid,'packagelist','title');
 $descr=$this->getSingleValue($pid,'packagelist','description');
 $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
 
 $subject=$pname." Package booked at ".$site_title;
 $message=$pname." Package has been booked of price $ ".$product_price." and plan validate upto ".$val." and plan description ".$descr." <br>Transaction ID: ".$product_transaction." <br> Order ID: ".$orderid;    
 $datas['messages']=array($name,$message);
 $this->email($email,$subject,$datas);
 
 $asubject=$name." booked a ".$pname." Package at ".$site_title;
 $amessage=$name." has been booked a ".$pname." Package of price $ ".$product_price." and plan validate upto ".$val." and plan description ".$descr." <br>Transaction ID: ".$product_transaction."<br> Order ID: ".$orderid;     
 $datasa['messages']=array($admin_name,$amessage);
 $this->email($admin_email,$asubject,$datasa);
$lid=base64_encode($lid);
$this->session->set_flashdata('result', 1);
$this->session->set_flashdata('class', 'success');
$this->session->set_flashdata('msg', "Thank you for booking a ".$pname." plan.");
redirect("plan_invoice/$lid");
}
else{
$this->session->set_flashdata('result', 1);
$this->session->set_flashdata('class', 'danger');
$this->session->set_flashdata('msg', "Error to book a plan");
redirect("Package");	
}
}

public function planinvoice($id=0)
{
   $this->checkSession();
   $id=base64_decode($id);
   $pid=$this->getSingleValue($id,'payment_membership','pid');   
   $data['invoice']=$this->Common_Model->getdata("payment_membership",$where=array("id"=>$id),$sort=""); 	  
   $data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->session->userdata('uid'),"type"=>'Agent'),$sort=""); 	  
   $data['property']=$this->Common_Model->getdata("packagelist",$where=array("id"=>$pid),$sort=""); 	  
   $countryid=$this->getSingleValue($this->session->userdata('uid'),'user','country');
   $country=$this->getdataSingleValue($countryid,'countries','countryName','countryID');
   $data['country']=$country;
   $data['front']=$this->Common_Model->getdata("front_setting",$where='',$sort='');

   $this->load->view("Planinvoice",$data);
}


public function bookfreeplan()
{
 $this->checkSession();	
 $uid  = $this->session->userdata('uid');
 $pid = $this->input->post('item_number'); // product ID
 
 $cdt=date("Y-m-d H:i:s");
 $val=$this->getSingleValue($pid,'packagelist','validity');
 $ftr=$this->getSingleValue($pid,'packagelist','feature');
 
  $pdata=array("mid"=>$pid,"mdate"=>$cdt,"planemail"=>0,
  "planprice"=>0,"duration"=>$val,"trial"=>1,"speciality"=>$ftr);
  $this->db->where("id",$uid);
  $this->db->update("user",$pdata);
  
 $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
 $email=$this->getSingleValue($uid,'user','email');
 $name=$this->getSingleValue($uid,'user','name');
 $admin_email=$this->getSingleValue(1,'admin_login','email');
 $admin_name=$this->getSingleValue(1,'admin_login','name');
 
 $pname=$this->getSingleValue($pid,'packagelist','title');
 $descr=$this->getSingleValue($pid,'packagelist','description');
 
 
 $subject=$pname." Package booked at ".$site_title;
 $message=$pname." Package has been booked of price $ ".$product_price." and plan validate upto ".$val." and plan description ".$descr."";    
 $datas['messages']=array($name,$message);
 $this->email($email,$subject,$datas);
 
 $asubject=$name." booked a ".$pname." Package at ".$site_title;
 $amessage=$name." has been booked a ".$pname." Package of price $ ".$product_price." and plan validate upto ".$val." and plan description ".$descr."";     
 $datasa['messages']=array($admin_name,$amessage);
 $this->email($admin_email,$asubject,$datasa);

$this->session->set_flashdata('result', 1);
$this->session->set_flashdata('class', 'success');
$this->session->set_flashdata('msg', "Thank you for booking a ".$pname." plan.");
redirect("agent_dashboard");
}
	
}