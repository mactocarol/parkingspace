<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Menusetting extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->checkSessionAdmin();		
    }

	/*--- start faq --*/	
	public function faq()
{
$data['control']="Menusetting";
$data['controlname']="faq";	
$data['controlnamehead']="Faq";	
$data['faq']=$this->Common_Model->getdata("faq",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Faq",$data);	
$this->adminfooter(); 
}

public function addfaq()
{
$data['control']="Menusetting";
$data['controlnamemsg']="Add faq";
$data['controlname']="faq";	
$this->adminheader();	
$this->load->view("admin/Addfaq",$data);	
$this->adminfooter(); 
}

public function editfaq($id=0)
{	
$data['control']="Menusetting";
$data['controlnamemsg']="Edit faq";
$data['controlname']="faq";
	
$where=array("id"=>$id);
$data['faq']=$this->Common_Model->getdata("faq",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editfaq",$data);	
$this->adminfooter();
}

public function createfaq()
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->addfaq();
		}
		else
		{
					
	     $datas=array("title"=>$this->input->post("title"),"description"=>$this->input->post("description"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("faq",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Faq added successfully");
		   redirect("Menusetting/faq");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Menusetting/addfaq");
	     }
		}		
}

public function updatefaq($id=0)
{
        $this->form_validation->set_rules('title', 'Title', 'required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editfaq($id);
		}
		else
		{	

         $where=array("id"=>$id);		 
		
	     $datas=array("title"=>$this->input->post("title"),"description"=>$this->input->post("description"),
         "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("faq",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Faq updated successfully");
		   redirect("Menusetting/faq");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Menusetting/editfaq/$id");
	     }
		}		
}

public function deletefaq()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Faq delete successfully.");
			redirect("Menusetting/faq");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Menusetting/faq");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('faq',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end faq --*/	
	
		/*--- start contactus --*/	
	public function contactus()
{
$data['control']="Menusetting";
$data['controlname']="contactus";	
$data['controlnamehead']="Contactus";	
$data['contactus']=$this->Common_Model->getdata("contactus",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Contactus",$data);	
$this->adminfooter(); 
}

public function addcontactus()
{
$data['control']="Menusetting";
$data['controlnamemsg']="Add contactus";
$data['controlname']="contactus";	
$this->adminheader();	
$this->load->view("admin/Addcontactus",$data);	
$this->adminfooter(); 
}

public function editcontactus($id=0)
{	
$data['control']="Menusetting";
$data['controlnamemsg']="Edit contactus";
$data['controlname']="contactus";
	
$where=array("id"=>$id);
$data['contactus']=$this->Common_Model->getdata("contactus",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editcontactus",$data);	
$this->adminfooter();
}

public function createcontactus()
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('address', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Title', 'required');
		$this->form_validation->set_rules('email', 'Title', 'required');
		$this->form_validation->set_rules('phone', 'Title', 'required');
		$this->form_validation->set_rules('map', 'Google Map', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->addcontactus();
		}
		else
		{
					
	     $datas=array("address"=>$this->input->post("address"),"phone"=>$this->input->post("phone"),
		 "description"=>$this->input->post("description"),"email"=>$this->input->post("email"),
		 "title"=>$this->input->post("title"),"phone"=>$this->input->post("phone"),"map"=>$this->input->post("map"),
         "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("contactus",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "contactus added successfully");
		   redirect("Menusetting/contactus");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Menusetting/addcontactus");
	     }
		}		
}

public function updatecontactus($id=0)
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('address', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Title', 'required');
		$this->form_validation->set_rules('email', 'Title', 'required');
		$this->form_validation->set_rules('phone', 'Title', 'required');
		$this->form_validation->set_rules('map', 'Google Map', 'required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editcontactus($id);
		}
		else
		{	

         $where=array("id"=>$id);		 
		
	     $datas=array("address"=>$this->input->post("address"),"phone"=>$this->input->post("phone"),
		 "description"=>$this->input->post("description"),"email"=>$this->input->post("email"),
		 "title"=>$this->input->post("title"),"phone"=>$this->input->post("phone"),"map"=>$this->input->post("map"),
         "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("contactus",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "contactus updated successfully");
		   redirect("Menusetting/contactus");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Menusetting/editcontactus/$id");
	     }
		}		
}

public function deletecontactus()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "contactus delete successfully.");
			redirect("Menusetting/contactus");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Menusetting/contactus");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('contactus',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end contactus --*/


/*--- start privacy --*/	
	public function privacy()
{
$data['control']="Menusetting";
$data['controlname']="privacy";	
$data['controlnamehead']="Privacy";	
$data['privacy']=$this->Common_Model->getdata("privacy",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Privacy",$data);	
$this->adminfooter(); 
}

public function addprivacy()
{
$data['control']="Menusetting";
$data['controlnamemsg']="Add privacy";
$data['controlname']="privacy";	
$this->adminheader();	
$this->load->view("admin/Addprivacy",$data);	
$this->adminfooter(); 
}

public function editprivacy($id=0)
{	
$data['control']="Menusetting";
$data['controlnamemsg']="Edit privacy";
$data['controlname']="privacy";
	
$where=array("id"=>$id);
$data['privacy']=$this->Common_Model->getdata("privacy",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editprivacy",$data);	
$this->adminfooter();
}

public function createprivacy()
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('subtitle', 'Sub Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->addprivacy();
		}
		else
		{
					
	     $datas=array("title"=>$this->input->post("title"),"subtitle"=>$this->input->post("subtitle"),"description"=>$this->input->post("description"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("privacy",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Privacy added successfully");
		   redirect("Menusetting/privacy");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Menusetting/addprivacy");
	     }
		}		
}

public function updateprivacy($id=0)
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('subtitle', 'Sub Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->editprivacy($id);
		}
		else
		{	

         $where=array("id"=>$id);		 
		
	     $datas=array("title"=>$this->input->post("title"),"subtitle"=>$this->input->post("subtitle"),"description"=>$this->input->post("description"),
		 "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("privacy",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Privacy updated successfully");
		   redirect("Menusetting/privacy");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Menusetting/editprivacy/$id");
	     }
		}		
}

public function deleteprivacy()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Privacy delete successfully.");
			redirect("Menusetting/privacy");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Menusetting/privacy");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('privacy',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end privacy --*/		
	
	
	/*--- start aboutus --*/	
	public function aboutus()
{
$data['control']="Menusetting";
$data['controlname']="aboutus";	
$data['controlnamehead']="aboutus";	
$data['aboutus']=$this->Common_Model->getdata("aboutus",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Aboutus",$data);	
$this->adminfooter(); 
}

public function addaboutus()
{
$data['control']="Menusetting";
$data['controlnamemsg']="Add aboutus";
$data['controlname']="aboutus";	
$this->adminheader();	
$this->load->view("admin/Addaboutus",$data);	
$this->adminfooter(); 
}

public function editaboutus($id=0)
{	
$data['control']="Menusetting";
$data['controlnamemsg']="Edit aboutus";
$data['controlname']="aboutus";
	
$where=array("id"=>$id);
$data['aboutus']=$this->Common_Model->getdata("aboutus",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editaboutus",$data);	
$this->adminfooter();
}

public function createaboutus()
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('subtitle', 'Sub Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->addaboutus();
		}
		else
		{
         $photo=$this->savecropimage("photo","upload/aboutus/");

$sicon1=$this->savecropimage("sicon1","upload/aboutus/");
$sicon2=$this->savecropimage("sicon2","upload/aboutus/");
$sicon3=$this->savecropimage("sicon3","upload/aboutus/");
$sicon4=$this->savecropimage("sicon4","upload/aboutus/");
		
	     $datas=array("photo"=>$photo,"title"=>$this->input->post("title"),"subtitle"=>$this->input->post("subtitle"),"description"=>$this->input->post("description"),
		 "ficon1"=>$this->input->post("ficon1"),"ftitle1"=>$this->input->post("ftitle1"),"fdescription1"=>$this->input->post("fdescription1"),
		 "ficon2"=>$this->input->post("ficon2"),"ftitle2"=>$this->input->post("ftitle2"),"fdescription2"=>$this->input->post("fdescription2"),
		 "ficon3"=>$this->input->post("ficon3"),"ftitle3"=>$this->input->post("ftitle3"),"fdescription3"=>$this->input->post("fdescription3"),
		 "ficon4"=>$this->input->post("ficon4"),"ftitle4"=>$this->input->post("ftitle4"),"fdescription4"=>$this->input->post("fdescription4"),
		 "sicon1"=>$sicon1,"stitle1"=>$this->input->post("stitle1"),"sdescription1"=>$this->input->post("sdescription1"),
		 "sicon2"=>$sicon2,"stitle2"=>$this->input->post("stitle2"),"sdescription2"=>$this->input->post("sdescription2"),
		 "sicon3"=>$sicon3,"stitle3"=>$this->input->post("stitle3"),"sdescription3"=>$this->input->post("sdescription3"),
		 "sicon4"=>$sicon4,"stitle4"=>$this->input->post("stitle4"),"sdescription4"=>$this->input->post("sdescription4"),
		 "ctitle"=>$this->input->post("ctitle"),"atitle"=>$this->input->post("atitle"),"adescription"=>$this->input->post("adescription"),
		 "cnoheading"=>$this->input->post("cnoheading"),"cno"=>$this->input->post("cno"),"cicon"=>$this->input->post("cicon"),"cdescription"=>$this->input->post("cdescription"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("aboutus",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Aboutus added successfully");
		   redirect("Menusetting/aboutus");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Menusetting/addaboutus");
	     }
		}		
}

public function updateaboutus($id=0)
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('subtitle', 'Sub Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->editaboutus($id);
		}
		else
		{	

         $where=array("id"=>$id);		 
		
	     
          if($this->input->post("photo"))
		  {
		  $this->unsetImage($id,'aboutus','photo','upload/aboutus/');		  		 
		  $photo=$this->savecropimage("photo","upload/aboutus/");		 	     
		  }
		  else{
			   $photo=$this->input->post('photo1');
          }

          if($this->input->post("sicon1"))
		  {
		  $this->unsetImage($id,'aboutus','sicon1','upload/aboutus/');		  		 
		  $sicon1=$this->savecropimage("sicon1","upload/aboutus/");		 	     
		  }
		  else{
			   $sicon1=$this->input->post('sicon11');
          }          
          if($this->input->post("sicon2"))
		  {
		  $this->unsetImage($id,'aboutus','sicon2','upload/aboutus/');		  		 
		  $sicon2=$this->savecropimage("sicon2","upload/aboutus/");		 	     
		  }
		  else{
			   $sicon2=$this->input->post('sicon21');
          }
          if($this->input->post("sicon3"))
		  {
		  $this->unsetImage($id,'aboutus','sicon3','upload/aboutus/');		  		 
		  $sicon3=$this->savecropimage("sicon3","upload/aboutus/");		 	     
		  }
		  else{
			   $sicon3=$this->input->post('sicon31');
          }				
          if($this->input->post("sicon4"))
		  {
		  $this->unsetImage($id,'aboutus','sicon4','upload/aboutus/');		  		 
		  $sicon4=$this->savecropimage("sicon4","upload/aboutus/");		 	     
		  }
		  else{
			   $sicon4=$this->input->post('sicon41');
          }					 
	     $datas=array("photo"=>$photo,"title"=>$this->input->post("title"),"subtitle"=>$this->input->post("subtitle"),"description"=>$this->input->post("description"),
		 "ficon1"=>$this->input->post("ficon1"),"ftitle1"=>$this->input->post("ftitle1"),"fdescription1"=>$this->input->post("fdescription1"),
		 "ficon2"=>$this->input->post("ficon2"),"ftitle2"=>$this->input->post("ftitle2"),"fdescription2"=>$this->input->post("fdescription2"),
		 "ficon3"=>$this->input->post("ficon3"),"ftitle3"=>$this->input->post("ftitle3"),"fdescription3"=>$this->input->post("fdescription3"),
		 "ficon4"=>$this->input->post("ficon4"),"ftitle4"=>$this->input->post("ftitle4"),"fdescription4"=>$this->input->post("fdescription4"),
		 "sicon1"=>$sicon1,"stitle1"=>$this->input->post("stitle1"),"sdescription1"=>$this->input->post("sdescription1"),
		 "sicon2"=>$sicon2,"stitle2"=>$this->input->post("stitle2"),"sdescription2"=>$this->input->post("sdescription2"),
		 "sicon3"=>$sicon3,"stitle3"=>$this->input->post("stitle3"),"sdescription3"=>$this->input->post("sdescription3"),
		 "sicon4"=>$sicon4,"stitle4"=>$this->input->post("stitle4"),"sdescription4"=>$this->input->post("sdescription4"),
		 "ctitle"=>$this->input->post("ctitle"),"atitle"=>$this->input->post("atitle"),"adescription"=>$this->input->post("adescription"),
		 "cnoheading"=>$this->input->post("cnoheading"),"cno"=>$this->input->post("cno"),"cicon"=>$this->input->post("cicon"),"cdescription"=>$this->input->post("cdescription"),
		 "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 
		 $updt=$this->Common_Model->update("aboutus",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Aboutus updated successfully");
		   redirect("Menusetting/aboutus");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Menusetting/editaboutus/$id");
	     }
		}		
}

public function deleteaboutus()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Aboutus delete successfully.");
			redirect("Menusetting/aboutus");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Menusetting/aboutus");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('aboutus',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end aboutus --*/		
	
	
	
	/*--- start banner --*/	
	public function banner()
{
$data['control']="Menusetting";
$data['controlname']="banner";	
$data['controlnamehead']="Banner";	
$data['banner']=$this->Common_Model->getdata("banner",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Banner",$data);	
$this->adminfooter(); 
}

public function addbanner()
{
$data['control']="Menusetting";
$data['controlnamemsg']="Add banner";
$data['controlname']="banner";	
$this->adminheader();	
$this->load->view("admin/Addbanner",$data);	
$this->adminfooter(); 
}

public function editbanner($id=0)
{	
$data['control']="Menusetting";
$data['controlnamemsg']="Edit banner";
$data['controlname']="banner";
	
$where=array("id"=>$id);
$data['banner']=$this->Common_Model->getdata("banner",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editbanner",$data);	
$this->adminfooter();
}

public function createbanner()
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addbanner();
		}
		else
		{
		$photo=$this->imageUpload("photo","upload/slider/");
		///$photo=$this->savecropimage("photo","upload/slider/");
		
	     $datas=array("title"=>$this->input->post("title"),"photo"=>$photo,"description"=>$this->input->post("description"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("banner",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Banner added successfully");
		   redirect("Menusetting/banner");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Menusetting/addbanner");
	     }
		}		
}

public function updatebanner($id=0)
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		//$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->editbanner($id);
		}
		else
		{	

         $where=array("id"=>$id);


          if(!empty($_FILES['photo']['name']))
		  {
		  $this->unsetImage($id,'banner','photo','upload/slider/');		  		 
		  $photo=$this->imageUpload("photo","upload/slider/");		 	     
		  }
		  else{
		  $photo=$this->input->post('photo1');
          }					 
		
	     $datas=array("title"=>$this->input->post("title"),"photo"=>$photo,"description"=>$this->input->post("description"),
		 "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("banner",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Banner updated successfully");
		   redirect("Menusetting/banner");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Menusetting/editbanner/$id");
	     }
		}		
}

public function deletebanner()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Banner delete successfully.");
			redirect("Menusetting/banner");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Menusetting/banner");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('banner',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- end banner --*/	
}