<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Dashboard extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->checkSession();
        $this->uid=$this->session->userdata("uid");		
    }

	/*--- start featuredpayment --*/	
public function index()
{
$this->frontheader();
$this->startdashboard();	
$this->load->view("Dashboard");
$this->enddashboard();	
$this->frontfooter(); 
}

public function myspace()
{
$data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->session->userdata('uid')),$sort='');	
$data['space']=$this->Common_Model->getdata("rentourspace",$where=array("uid"=>$this->session->userdata('uid')),$sort='id desc');
$this->frontheader();
$this->startdashboard();	
$this->load->view("Myspace",$data);
$this->enddashboard();	
$this->frontfooter(); 
}

public function availability($id)
{
$data['space_id'] =	$id;
$data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->session->userdata('uid')),$sort='');
$space=$this->Common_Model->getdata("rentourspace",$where=array("id"=>base64_decode($data['space_id'])),$sort='');
$data['space'] = ($space[0]->week);
$data['availability'] = ($space[0]->availability);
$data['noofspace'] = ($space[0]->noofspace);
$this->frontheader();
$this->startdashboard();	
$this->load->view("Availability",$data);
$this->enddashboard();	
$this->frontfooter(); 
}

public function rentourspace()
{
$data['country']=$this->Common_Model->getdata("countries",$where="",$sort='countryName asc');
$data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->session->userdata('uid')),$sort='');
$this->frontheader();	
$this->load->view("Rentourspace",$data);	
$this->frontfooter(); 
}

public function savefile()
	{
		
		if(!empty($_FILES['file']['name']))
		{			
		$photo=$this->imageUpload("file","upload/space/");
		$datas=array(
		"created_dt"=>date("Y-m-d H:i:s"),
		"updated_dt"=>date("Y-m-d H:i:s"),
		"photo"=>$photo,
		"uid"=>$this->uid,
		"sid"=>base64_decode($this->input->post("sid"))
		);
		$updt=$this->Common_Model->insert("spacephoto",$datas);
		}
		echo true;
	}
	
	public function deletephoto()
	{
		if($this->uri->segment(3)=='success')
		{
			$pid=$this->uri->segment(4);
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Photo delete successfully.");
			redirect("Dashboard/addphoto/$pid");
		}
		else if($this->uri->segment(3)=='error')
		{
			$pid=$this->uri->segment(4);
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Dashboard/addphoto/$pid");
		}
		else{
			$id=$this->input->post('id');
			$this->unsetImage($id,'spacephoto','photo','upload/space/');
			$data=$this->Common_Model->deletedata('spacephoto',array('id'=>$id));			
			echo $data;
		    }			
	}

public function addphoto($id=0)
{
$id=base64_decode($id);	
$data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->session->userdata('uid')),$sort='');
$data['photo']=$this->Common_Model->getdata("spacephoto",$where=array("sid"=>$id),$sort='');
$this->frontheader();	
$this->load->view("Addphoto",$data);	
$this->frontfooter(); 
}

	public function editmyspace($id=0)
	{
		$id=base64_decode($id);	
		$data['country']=$this->Common_Model->getdata("countries",$where="",$sort='countryName asc');
		$data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->session->userdata('uid')),$sort='');
		$data['com']=$this->Common_Model->getdata("commission",$where="",$sort='');
		$data['space']=$this->Common_Model->getdata("rentourspace",$where=array("uid"=>$this->session->userdata('uid'),"id"=>$id),$sort='');
		$this->frontheader();	
		$this->load->view("Editspace",$data);	
		$this->frontfooter(); 
	}

public function saverentourspace()
{
	    $this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules("lname","Last Name","required");
		$this->form_validation->set_rules("noofspace","No of space","required");
		$this->form_validation->set_rules("country","Country","required");
		$this->form_validation->set_rules("city","City","required");
		$this->form_validation->set_rules("address","Address","required");
		$this->form_validation->set_rules("zipcode","Zipcode","required");
		$this->form_validation->set_rules("state","State","required");
		$this->form_validation->set_rules("description","Description","required");
		$this->form_validation->set_rules("phone","Contact","required");
		$this->form_validation->set_rules("housename","Housename","required");
	

		if ($this->form_validation->run() == FALSE)
		{
			$this->rentourspace();
		}
		else
		{	
	      $accessmethod="";
	      if($this->input->post('accessmethod'))
          $accessmethod=implode(",", $this->input->post('accessmethod'));
	  
	       $driveway_feature="";
		  $garage_feature="";
		  $car_feature=="";
		  $driveway_width="";
		  $car_height="";
		  
		  if($this->input->post("typeofspace")=='Driveway')
		  {
		  $driveway_width=$this->input->post("driveway_width");
	      if($this->input->post('driveway_feature'))
          $driveway_feature=implode(",", $this->input->post('driveway_feature'));
		  }	  
	      
		  if($this->input->post("typeofspace")=='Garage')
		  {
	      if($this->input->post('garage_feature'))
          $garage_feature=implode(",", $this->input->post('garage_feature'));
		  }
	  	   
          if($this->input->post("typeofspace")=='Car park')
		  {
          $car_height=$this->input->post("car_height");			  
	      if($this->input->post('car_feature'))
          $car_feature=implode(",", $this->input->post('car_feature'));
	      }


	     $datas=array("accessmethod"=>$accessmethod,"fname"=>$this->input->post("fname"),"lname"=>$this->input->post("lname"),"driveway_feature"=>$driveway_feature,
		 "created_dt"=>date("Y-m-d H:i:s"),"noofspace"=>$this->input->post("noofspace"),
		 "country"=>$this->input->post("country"),"updated_dt"=>date("Y-m-d H:i:s"),
		 "state"=>$this->input->post("state"),"city"=>$this->input->post("city"),"address"=>$this->input->post("address"),"housename"=>$this->input->post("housename"),"description"=>$this->input->post("description"),"phone"=>$this->input->post("phone"),"accessdetail"=>$this->input->post("accessdetail"),"uid"=>$this->uid,
		 "driveway_owner"=>$this->input->post("driveway_owner"),"driveway_width"=>$driveway_width,"typeofspace"=>$this->input->post("typeofspace"),"car_height"=>$car_height,"code"=>$this->input->post("code"),"zipcode"=>$this->input->post("zipcode"),"car_feature"=>$car_feature,"garage_feature"=>$garage_feature
		 );
		 
		 $updt=$this->Common_Model->insert("rentourspace",$datas);
		 
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Rent space added successfully");
		   redirect("Dashboard/myspace");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Dashboard/rentourspace");
	     }
		}
}


public function updaterentourspace($id=0)
{
	    	
	    $this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules("lname","Last Name","required");
		$this->form_validation->set_rules("noofspace","No of space","required");
		$this->form_validation->set_rules("country","Country","required");
		$this->form_validation->set_rules("city","City","required");
		$this->form_validation->set_rules("address","Address","required");
		$this->form_validation->set_rules("zipcode","Zipcode","required");
		$this->form_validation->set_rules("state","State","required");
		$this->form_validation->set_rules("description","Description","required");
		$this->form_validation->set_rules("phone","Contact","required");
		$this->form_validation->set_rules("housename","Housename","required");
	

		if ($this->form_validation->run() == FALSE)
		{
			$this->editmyspace($id);
		}
		else
		{
          $id=base64_decode($id);	
		  
	      $accessmethod="";
	      if($this->input->post('accessmethod'))
          $accessmethod=implode(",", $this->input->post('accessmethod'));
	  
	      $driveway_feature="";
		  $garage_feature="";
		  $car_feature="";
		  $driveway_width="";
		  $car_height="";
		  
		  if($this->input->post("typeofspace")=='Driveway')
		  {
		  $driveway_width=$this->input->post("driveway_width");
	      if($this->input->post('driveway_feature'))
          $driveway_feature=implode(",", $this->input->post('driveway_feature'));
		  }	  
	      
		  if($this->input->post("typeofspace")=='Garage')
		  {
	      if($this->input->post('garage_feature'))
          $garage_feature=implode(",", $this->input->post('garage_feature'));
		  }
	  	   
          if($this->input->post("typeofspace")=='Car park')
		  {
          $car_height=$this->input->post("car_height");			  
	      if($this->input->post('car_feature'))
          $car_feature=implode(",", $this->input->post('car_feature'));
	      }
	     
         $where=array("id"=>$id);

	     $datas=array("accessmethod"=>$accessmethod,"fname"=>$this->input->post("fname"),"lname"=>$this->input->post("lname"),"driveway_feature"=>$driveway_feature,
		 "created_dt"=>date("Y-m-d H:i:s"),"noofspace"=>$this->input->post("noofspace"),
		 "country"=>$this->input->post("country"),"updated_dt"=>date("Y-m-d H:i:s"),
		 "state"=>$this->input->post("state"),"city"=>$this->input->post("city"),"address"=>$this->input->post("address"),"housename"=>$this->input->post("housename"),"description"=>$this->input->post("description"),"phone"=>$this->input->post("phone"),"accessdetail"=>$this->input->post("accessdetail"),
		 "driveway_owner"=>$this->input->post("driveway_owner"),"driveway_width"=>$driveway_width,"typeofspace"=>$this->input->post("typeofspace"),"car_height"=>$car_height,"code"=>$this->input->post("code"),"zipcode"=>$this->input->post("zipcode"),"car_feature"=>$car_feature,"garage_feature"=>$garage_feature,
		 "phour"=>$this->input->post("phour"),"pday"=>$this->input->post("pday"),"pweek"=>$this->input->post("pweek"),"pmonth"=>$this->input->post("pmonth")
		 );
		 
		 //echo "<pre>"; print_r($datas); die;
		 $updt=$this->Common_Model->update("rentourspace",$datas,$where);
		 
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "My space updated successfully");
		   redirect("Dashboard/myspace");
         }
         else	
         {  
	       $id=base64_encode($id);
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Dashboard/editmyspace/$id");
	     }
		}
}


public function editprofile()
{
$data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->session->userdata('uid')),$sort='');
$data['country']=$this->Common_Model->getdata("countries",$where="",$sort='countryName asc');
$data['pay']=$this->Common_Model->getdata("paymentoption",$where="",$sort='name asc');
$data['timezone']=$this->Common_Model->getdata("timezone",$where="",$sort='name asc');	
$data['occupation']=$this->Common_Model->getdata("occupation",$where="",$sort='name asc');			
$this->frontheader();
$this->startdashboard();	
$this->load->view("Editprofile",$data);
$this->enddashboard();	
$this->frontfooter(); 
}

public function saveprofile()
{
	    $this->form_validation->set_rules('first', 'First Name', 'required');
		$this->form_validation->set_rules("last","Last Name","required");
		$this->form_validation->set_rules("zipcode","Zipcode","required");
		$this->form_validation->set_rules("cname","Company Name","required");
		$this->form_validation->set_rules("birthdate","Birthdate","required");
		$this->form_validation->set_rules("contact","Contact","required");
		$this->form_validation->set_rules("state","State","required");
		$this->form_validation->set_rules("city","City","required");
		$this->form_validation->set_rules("housename","Housename","required");
		$this->form_validation->set_rules("address","Address","required");
		$this->form_validation->set_rules("pay","Payment option","required");
		$this->form_validation->set_rules("timezone","Timezone","required");
		$this->form_validation->set_rules("occupation","Occupation","required");
		$this->form_validation->set_rules("website","Website","required");
		$this->form_validation->set_rules("gender","Website","required");


		if ($this->form_validation->run() == FALSE)
		{
			$this->editprofile();
		}
		else
		{	
	   
	      $photo="";
		  if($this->input->post("photo"))
		  {
		  $this->unsetImage($this->uid,'user','photo','upload/user/');		  		 
		  $photo=$this->savecropimage("photo","upload/user/");		 	     
		  }
		  else{
		  $photo=$this->input->post('hphoto');
          }
		  
		  $ophoto="";
		  if(!empty($_FILES['ophoto']['name']))
		  {
		  $this->unsetImage($this->uid,'user','ophoto','upload/user/');		  		 
		  $ophoto=$this->imageUpload("ophoto","upload/user/");		 	     
		  }
		  else{
		  $ophoto=$this->input->post('hophoto');
          }
		  $name=$this->input->post("first").' '.$this->input->post("last");
          $vat=0;
		  if($this->input->post('vat'))
		  {
			$vat=1;  
		  }
		  
		  if($this->input->post('password'))
		  {
			  $pass=md5($this->input->post('password'));
			  $datass=array("password"=>$pass);
			  $where=array("id"=>$this->uid);
			  $this->Common_Model->update("user",$datass,$where);
		  }
          $where=array("id"=>$this->uid);
		  
	     $datas=array("photo"=>$photo,"contact"=>$this->input->post("contact"),"name"=>$name,"zipcode"=>$this->input->post("zipcode"),"ophoto"=>$ophoto,
		 "country"=>$this->input->post("country"),"updated_dt"=>date("Y-m-d H:i:s"),
		 "state"=>$this->input->post("state"),"city"=>$this->input->post("city"),"address"=>$this->input->post("address"),"housename"=>$this->input->post("housename"),"website"=>$this->input->post("website"),"gender"=>$this->input->post("gender"),
		 "vat"=>$vat,"companyname"=>$this->input->post("cname"),"pay"=>$this->input->post("pay"),"timezone"=>$this->input->post("timezone"),"occupation"=>$this->input->post("occupation"),"birthdate"=>$this->input->post("birthdate")
		 );
		 
		 $updt=$this->Common_Model->update("user",$datas,$where);
		 
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Profile updated successfully");
		   redirect("editprofile");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("editprofile");
	     }
		}		
}


public function deactive()
{
	        $ustatus=$this->getSingleValue($this->uid,'user','status');
			$stss=0;
			$sts='';
			
			if($ustatus==0 || $ustatus==1)
			{
				$stss=2;
				$sts='Deactivated';
			}
			else{
				$stss=1;
				$sts='Activated';
			}
	        $udata=array("status"=>$stss);
			$this->Common_Model->update('user',$udata,array('id'=>$this->uid));

	        $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
	        $message="Your account has been ".$sts." successfully at <a href=".base_url().">".$site_title."</a>";
	       
            $datas['messages']=array($name,$message);
           
            $this->email($email,"Account ".$sts."  at ".$site_title,$datas);
			
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Account has been ".$sts." successfully");
			redirect("editprofile");
}

	public function show_availability(){
		//echo "<pre>";
		//print_r($_POST);die;
		$data = [];
		if(isset($_POST['week']) && !empty($_POST['week'])){
			$data['week'] = $_POST['week'];			
		}
		$data['highlited'] = explode(';',$_POST['highlited']);
		$data['unhighlited'] = explode(';',$_POST['unhighlited']);
		//print_r(explode(';',$data['highlited'])[0]); die;
		$this->load->view('calendar_view',$data);
	}
	
	public function save_availability(){
		//echo "<pre>";	print_r($_POST);die;
		$week = '';
		$id = base64_decode($_POST['space_id']);
		if(isset($_POST['week']) && !empty($_POST['week'])){
			$week = implode(',',$_POST['week']);			
		}
		
		$updt=$this->Common_Model->update("rentourspace",array("week"=>($week),"availability"=>$_POST['changed_space']),array("id"=>$id));
		
		echo 1;		
	}
	
	public function change_space(){
		//echo "<pre>";
		//print_r($_POST);die;
		//$data[] = $_POST;
		if(!$this->session->userdata('change_space')){			
			$this->session->set_userdata('change_space',$_POST);
			$data[] = $this->session->userdata('change_space');
			
		}else{			
			$data[] = $this->session->userdata('change_space');			
			$this->session->set_userdata('change_space',$_POST);			
			$data[] = $this->session->userdata('change_space');
		}
		echo "<pre>"; print_r($data); die;
		?>		
			<table border="1">
				<thead>
					<tr>
						<td>Status</td>
						<td>From</td>
						<td>Until</td>
						<td>Change</td>
						<td>Available Spaces</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data as $row){ ?>
						<tr>
							<td><?=($row['slct'] == 1) ? 'Removed Availability' : 'Additional Availability'?></td>
							<td><?=date('d M Y h:i:s',strtotime($row['from_date']))?></td>
							<td><?=date('d M Y h:i:s',strtotime($row['to_date']))?></td>
							<td>1</td>
							<td><?=$row['quantity']?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		<?php 
		//print_r($_POST['week']); die;
		//$this->load->view('calendar_view',$data);
	}
	
	
	public function vehicle()
	{				
		
		if($_POST){
			
			if(($this->input->post('isHired'))){
				$isHired = 1;
			}else{
				$isHired = 0;
			}
			
			$datas['license'] = $this->input->post('license');
			$datas['vehicle_type'] = $this->input->post('vehicle_type');
			$datas['vehicle_make'] = $this->input->post('vehicle_make');
			$datas['vehicle_model'] = $this->input->post('vehicle_model');
			$datas['isHired'] = $isHired;
			$datas['hire_company'] = $this->input->post('hire_company');
			$datas['user_id'] = $this->session->userdata('uid');
				  				 
				//echo "<pre>"; print_r($datas); die; 
				 $lastid=$this->Common_Model->insert("vehicle",$datas);
				 
				 if($lastid)
				 { 	 
				   $this->session->set_flashdata('resultmsg', 1);
				   $this->session->set_flashdata('class', 'success');
				   $this->session->set_flashdata('messsage', "Vehicle added successfully");
				   redirect("vehicle");
				 }
				 else	
				 {  
				   $this->session->set_flashdata('resultmsg', 1);
				   $this->session->set_flashdata('class', 'danger');
				   $this->session->set_flashdata('messsage', "Error to update");
				   redirect("vehicle");
				 }
			
		}
		
		//$data['user']=$this->Common_Model->getdata("user",$where=array("id"=>$this->session->userdata('uid')),$sort='');
		//$data['country']=$this->Common_Model->getdata("countries",$where="",$sort='countryName asc');
		//$data['pay']=$this->Common_Model->getdata("paymentoption",$where="",$sort='name asc');
		//$data['timezone']=$this->Common_Model->getdata("timezone",$where="",$sort='name asc');	
		//$data['occupation']=$this->Common_Model->getdata("occupation",$where="",$sort='name asc');			
		$data['vehicles']=$this->Common_Model->getdata("vehicle",$where=array("user_id"=>$this->session->userdata('uid')),$sort='');		
		
		$this->frontheader();
		$this->startdashboard();	
		$this->load->view("Vehicle",$data);
		$this->enddashboard();	
		$this->frontfooter();
	}
	
	public function vehicleDelete($id){
		
		if(!$this->Common_Model->deletedata('vehicle',array('id'=>$id)))
			{ 	 
			  $this->session->set_flashdata('resultmsg', 1);
			  $this->session->set_flashdata('class', 'success');
			  $this->session->set_flashdata('messsage', "Vehicle deleted successfully");
			  redirect("vehicle");
			}
			else	
			{  
			  $this->session->set_flashdata('resultmsg', 1);
			  $this->session->set_flashdata('class', 'danger');
			  $this->session->set_flashdata('messsage', "Error to delete");
			  redirect("vehicle");
			}
		
	}
	
	public function creditcard($id=Null)
	{		
		if($id){
			$cards=$this->Common_Model->getdata("paymentcards",$where=array("user_id"=>$this->session->userdata('uid')),$sort='');		
			$card = $this->Common_Model->getdata("paymentcards",$where=array("id"=>$id,"user_id"=>$this->session->userdata('uid')),$sort='');
			foreach($cards as $row){
				if($row->id == $card[0]->id){
					$this->Common_Model->update("paymentcards",array("isPrimary"=>1),array("id"=>$card[0]->id));
				}else{
					$this->Common_Model->update("paymentcards",array("isPrimary"=>0),array("id"=>$row->id));
				}
			}
			$this->session->set_flashdata('resultmsg', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('messsage', "Card was set as primary successfully");
		}
		$data['cards']=$this->Common_Model->getdata("paymentcards",$where=array("user_id"=>$this->session->userdata('uid')),$sort='');		
		//print_r($data['cards']); die;
		$this->frontheader();
		$this->startdashboard();	
		$this->load->view("Creditcard",$data);
		$this->enddashboard();	
		$this->frontfooter();
	}
	
	public function add_card()
	{				
		
		if($_POST){
			//echo "<pre>"; print_r($_POST); die;			
			
			$datas['f_name'] = $this->input->post('f_name');
			$datas['l_name'] = $this->input->post('l_name');
			$datas['card_no'] = base64_encode(implode('',explode(' ',$this->input->post('card_no'))));
			$datas['card_exp'] = $this->input->post('card_exp');
			$datas['card_cvv'] = $this->input->post('card_cvv');
			$datas['country'] = $this->input->post('country');
			$datas['postal_code'] = $this->input->post('postal_code');
			$datas['user_id'] = $this->session->userdata('uid');
				  				 
				//echo "<pre>"; print_r($datas); die; 
				 $lastid=$this->Common_Model->insert("paymentcards",$datas);
				 
				 if($lastid)
				 { 	 
				   $this->session->set_flashdata('resultmsg', 1);
				   $this->session->set_flashdata('class', 'success');
				   $this->session->set_flashdata('messsage', "Card added successfully");
				   redirect("Dashboard/creditcard");
				 }
				 else	
				 {  
				   $this->session->set_flashdata('resultmsg', 1);
				   $this->session->set_flashdata('class', 'danger');
				   $this->session->set_flashdata('messsage', "Error to update");
				   redirect("Dashboard/creditcard");
				 }
			
		}			
		$data['cards']=$this->Common_Model->getdata("paymentcards",$where=array("user_id"=>$this->session->userdata('uid')),$sort='');		
		$this->frontheader();
		$this->startdashboard();	
		$this->load->view("addCreditcard",$data);
		$this->enddashboard();	
		$this->frontfooter();
	}
	
	public function cardDelete($id){
		
		if(!$this->Common_Model->deletedata('paymentcards',array('id'=>$id,"user_id"=>$this->session->userdata('uid'))))
			{ 	 
			  $this->session->set_flashdata('resultmsg', 1);
			  $this->session->set_flashdata('class', 'success');
			  $this->session->set_flashdata('messsage', "Card deleted successfully");
			  redirect("Dashboard/creditcard");
			}
			else	
			{  
			  $this->session->set_flashdata('resultmsg', 1);
			  $this->session->set_flashdata('class', 'danger');
			  $this->session->set_flashdata('messsage', "Error to delete");
			  redirect("Dashboard/creditcard");
			}
		
	}
	
	public function validatecard()
	{
	   global $type;
	   $number = implode('',explode(' ',$this->input->post('card_no')));
	   $cardtype = array(
		   "visa"       => "/^4[0-9]{12}(?:[0-9]{3})?$/",
		   "mastercard" => "/^5[1-5][0-9]{14}$/",
		   "amex"       => "/^3[47][0-9]{13}$/",
		   "discover"   => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
	   );
   
	   if (preg_match($cardtype['visa'],$number))
	   {
	   $datas['type'] = "visa";		   
	   
	   }
	   else if (preg_match($cardtype['mastercard'],$number))
	   {
	   $datas['type'] = "mastercard";		   
	   }
	   else if (preg_match($cardtype['amex'],$number))
	   {
	   $datas['type'] = "amex";		   
	   
	   }
	   else if (preg_match($cardtype['discover'],$number))
	   {
	   $datas['type'] = "discover";		   
	   }
	   else
	   {
		   $datas['type'] = false;		   
	   }
	   //print_r($datas); die;
	    $datas['cards']=$this->Common_Model->getdata("paymentcards",$where=array("user_id"=>$this->session->userdata('uid')),$sort='');		
		$this->frontheader();
		$this->startdashboard();	
		$this->load->view("addCreditcard",$datas);
		$this->enddashboard();	
		$this->frontfooter();
	}


}