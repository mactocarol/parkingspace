<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Setting extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->checkSessionAdmin();
		$this->load->model('Core_Model');
    }
	
public function frontsetting()
{
$data['control']="Setting";
$data['controlname']="frontsetting";
$data['controlnamehead']="Frontsetting";	
$data['frontsetting']=$this->Common_Model->getdata("front_setting",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Frontsetting",$data);	
$this->adminfooter(); 
}

public function viewfrontsetting($id=0)
{	
$where=array("id"=>$id);
$data['frontsetting']=$this->Common_Model->getdata("front_setting",$where,$sort='');
$where=array("pid"=>$id);
$data['paypal']=$this->Common_Model->getdata("paypal",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Viewfrontsetting",$data);	
$this->adminfooter(); 
}

public function addfrontsetting()
{
$data['control']="Setting";
$data['controlnamemsg']="Add frontsetting";
$data['controlname']="frontsetting";	
$this->adminheader();	
$this->load->view("admin/Addfrontsetting",$data);	
$this->adminfooter(); 
}

public function editfrontsetting($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}
$data['control']="Setting";
$data['controlnamemsg']="Edit frontsetting";
$data['controlname']="frontsetting";	
$where=array("id"=>$id);
$data['frontsetting']=$this->Common_Model->getdata("front_setting",$where,$sort='');
$where=array("pid"=>$id);
$data['paypal']=$this->Common_Model->getdata("paypal",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editfrontsetting",$data);	
$this->adminfooter();
}

public function createfrontsetting()
{
        $this->form_validation->set_rules('title', 'Website Name', 'required');
		$this->form_validation->set_rules('wtitle', 'Website Title', 'required');
		$this->form_validation->set_rules('copyright', 'Footer Copyright', 'required');
		$this->form_validation->set_rules('meta', 'Meta description', 'required');
		 

		if ($this->form_validation->run() == FALSE)
		{
			$this->addfrontsetting();
		}
		else
		{
		 $logo=$this->savecropimage("logo","images/");
		 $favicon=$this->savecropimage("favicon","images/");
         $title="title_".$this->session->userdata("site_lang");
		 $wtitle="wtitle_".$this->session->userdata("site_lang");
         $meta="meta_".$this->session->userdata("site_lang");
         $copyright="copyright_".$this->session->userdata("site_lang");
         $ophoto=$this->imageUpload("ophoto","images/");		 
	     $datas=array("ophoto"=>$ophoto,"favicon"=>$favicon,"logo"=>$logo,$meta=>$this->input->post("meta"),$wtitle=>$this->input->post("wtitle"),
		 $copyright=>$this->input->post("copyright"),$title=>$this->input->post("title"),
		 "best"=>$this->input->post("best"),"supportmsg"=>$this->input->post("supportmsg"),"support"=>$this->input->post("support"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("front_setting",$datas);		   
		 if($updt)
         { 	 
	 
	       $pdata=array("created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"),"url"=>$this->input->post("purl"),"email"=>$this->input->post("pemail"),"pid"=>$updt);
		   $this->Common_Model->insert("paypal",$pdata);	
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Front setting added successfully");
		   redirect("Setting/frontsetting");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Setting/addfrontsetting");
	     }
		}		
}

public function updatefrontsetting($id=0)
{
	//echo "<pre>"; print_r($_POST); die;
        $this->form_validation->set_rules('title', 'Website Name', 'required');
		$this->form_validation->set_rules('wtitle', 'Website Title', 'required');
		$this->form_validation->set_rules('copyright', 'Footer Copyright', 'required');
		$this->form_validation->set_rules('meta', 'Meta description', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editfrontsetting($id);
		}
		else
		{	
	   
		
		  if($this->input->post("logo"))
		  {
		  $this->unsetImage($id,'front_setting','logo','images/');		  		 
		  $logo=$this->savecropimage("logo","images/");		 	     
		  }
		  else{
			   $logo=$this->input->post('logo1');
          }
		  
		  if($this->input->post("favicon"))
		  {
		  $this->unsetImage($id,'front_setting','favicon','images/');		  		 
		  $favicon=$this->savecropimage("favicon","images/");		 	     
		  }
		  else{
			   $favicon=$this->input->post('favicon1');
          }	
		
         $where=array("id"=>$id);
		 
		 $title="title_".$this->session->userdata("site_lang");
		 $wtitle="wtitle_".$this->session->userdata("site_lang");
         $meta="meta_".$this->session->userdata("site_lang");
         $copyright="copyright_".$this->session->userdata("site_lang");
		 
		  if(!empty($_FILES['ophoto']['name']))
		  {
		  $this->unsetImage($id,'front_setting','ophoto','images/');		  		 
		  $ophoto=$this->imageUpload("ophoto","images/");		 	     
		  }
		  else{
		  $ophoto=$this->input->post('ophoto1');
          }
	
	     $datas=array("favicon"=>$favicon,"logo"=>$logo,$meta=>$this->input->post("meta"),$wtitle=>$this->input->post("wtitle"),"ophoto"=>$ophoto,
		 $copyright=>$this->input->post("copyright"),$title=>$this->input->post("title"),
		 "best"=>$this->input->post("best"),"supportmsg"=>$this->input->post("supportmsg"),"support"=>$this->input->post("support"),
         "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("front_setting",$datas,$where);		   
		 if($updt)
         {
           $pdata=array("created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"),"url"=>$this->input->post("purl"),"email"=>$this->input->post("pemail"));
		   $where=array("pid"=>$id);
		   $this->Common_Model->update("paypal",$pdata,$where);			 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Front setting updated successfully");
		   redirect("Setting/frontsetting");
         }
         else	
         { 
           $pdata=array("created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"),"url"=>$this->input->post("purl"),"email"=>$this->input->post("pemail"));
		   $where=array("pid"=>$id);
           $this->Common_Model->update("paypal",$pdata,$where);			   
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Setting/editfrontsetting/$id");
	     }
		}		
}

public function deletefrontsetting()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Front setting delete successfully.");
			redirect("Setting/frontsetting");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Setting/frontsetting");
		}
		else{
			$id=$this->input->post('id');			
			$this->unsetImage($id,'front_setting','favicon','images/thumb/','images/');
			$this->unsetImage($id,'front_setting','logo','images/thumb/','images/');
			$data1=$this->Common_Model->deletedata('paypal',array('pid'=>$id));			
			$data=$this->Common_Model->deletedata('front_setting',array('id'=>$id));			
			echo $data;
		}			
	}
	
	/*--- start commission --*/	
	public function commission()
{
$data['control']="Setting";
$data['controlname']="commission";	
$data['controlnamehead']="commission";	
$data['commission']=$this->Common_Model->getdata("commission",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Commission",$data);	
$this->adminfooter(); 
}

public function addpropertyfeature()
{
$data['control']="Setting";
$data['controlnamemsg']="Add commission";
$data['controlname']="commission";	
$this->adminheader();	
$this->load->view("admin/Addcommission",$data);	
$this->adminfooter(); 
}

public function editcommission($id=0)
{	
$data['control']="Setting";
$data['controlnamemsg']="Edit commission";
$data['controlname']="commission";
	
$where=array("id"=>$id);
$data['commission']=$this->Common_Model->getdata("commission",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editcommission",$data);	
$this->adminfooter();
}

public function createcommission()
{
        $this->form_validation->set_rules('title', 'Price', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
 
		if ($this->form_validation->run() == FALSE)
		{
			$this->addcommission();
		}
		else
		{
					
	     $datas=array("price"=>$this->input->post("title"),"type"=>$this->input->post("type"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("commission",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "commission added successfully");
		   redirect("Setting/commission");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Setting/addcommission");
	     }
		}		
}

public function updatecommission($id=0)
{
        $this->form_validation->set_rules('title', 'Price', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
 
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editcommission($id);
		}
		else
		{	

         $where=array("id"=>$id);		 
		
	     $datas=array("price"=>$this->input->post("title"),"type"=>$this->input->post("type"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("commission",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "commission updated successfully");
		   redirect("Setting/commission");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Setting/editcommission/$id");
	     }
		}		
}

public function deletecommission()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "commission delete successfully.");
			redirect("Setting/commission");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Setting/commission");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('commission',array('id'=>$id));			
			echo $data;
		}			
	}
	
	
	/*--- end commission --*/
	
	

		
	public function HomeSetting(){
		$data['control']="Setting";
		$data['controlname']="HomeSetting";	
		$data['controlnamehead']="Home Setting";
		$data['controlnamemsg']="Home Setting";
		if($_POST){			
			foreach($_POST as $key => $val){								
				//echo "<pre>"; print_r($_POST); die;
				if(($key == 'main_image'))
				{
					if($this->input->post($key) != ''){
						$img = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>$key),array());					
						@unlink('images/'.$img->value);
						$favicon=$this->savecropimage("main_image","images/");
						$key = "main_image_".$this->session->userdata("site_lang");
						$val = $favicon;	
					}else{
						$key = '';
					}
				}
				
				if(($key == 'featured_image1'))
				{
					if($this->input->post($key) != ''){
						$img = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>$key),array());					
						@unlink('images/'.$img->value);
						$favicon=$this->savecropimage("featured_image1","images/");
						$key = "featured_image1_".$this->session->userdata("site_lang");
						$val = $favicon;	
					}else{
						$key = '';
					}
				}
				
				if(($key == 'featured_image2'))
				{
					if($this->input->post($key) != ''){
						$img = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>$key),array());					
						@unlink('images/'.$img->value);
						$favicon=$this->savecropimage("featured_image2","images/");
						$key = "featured_image2_".$this->session->userdata("site_lang");
						$val = $favicon;	
					}else{
						$key = '';
					}
				}
				
				if(($key == 'featured_image3'))
				{
					if($this->input->post($key) != ''){
						$img = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>$key),array());					
						@unlink('images/'.$img->value);
						$favicon=$this->savecropimage("featured_image3","images/");
						$key = "featured_image3_".$this->session->userdata("site_lang");
						$val = $favicon;	
					}else{
						$key = '';
					}
				}
				
				$is_key_exists = $this->Core_Model->SelectRecord("settings",'*',array('key'=>$key),array());
				
				if(!empty($is_key_exists)){					
					$this->Core_Model->UpdateRecord('settings',array('value'=>$val), array('key'=>$key));
				}else{
					if($key != ''){
						$this->Core_Model->InsertRecord('settings',array('key'=>$key , 'value'=>$val));	
					}					
				}
			}
			
			$data['settings'] = $this->Core_Model->SelectRecord("settings",'*',array(),array());
			
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Home Settings Updated successfully");
			redirect("Setting/HomeSetting");			
		}
		$data['main_heading'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'main_heading_'.$this->session->userdata("site_lang")),array());
		$data['main_subheading'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'main_subheading_'.$this->session->userdata("site_lang")),array());
		$data['main_image'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'main_image_'.$this->session->userdata("site_lang")),array());
		$data['main_button'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'main_button_'.$this->session->userdata("site_lang")),array());
		$data['main_button_url'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'main_button_url_'.$this->session->userdata("site_lang")),array());
		
		$data['featured_image1'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_image1_'.$this->session->userdata("site_lang")),array());
		$data['featured_heading1'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_heading1_'.$this->session->userdata("site_lang")),array());
		$data['featured_content1'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_content1_'.$this->session->userdata("site_lang")),array());
		$data['featured_image2'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_image2_'.$this->session->userdata("site_lang")),array());
		$data['featured_heading2'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_heading2_'.$this->session->userdata("site_lang")),array());
		$data['featured_content2'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_content2_'.$this->session->userdata("site_lang")),array());
		$data['featured_image3'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_image3_'.$this->session->userdata("site_lang")),array());
		$data['featured_heading3'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_heading3_'.$this->session->userdata("site_lang")),array());
		$data['featured_content3'] = $this->Core_Model->SelectSingleRecord("settings",'*',array('key'=>'featured_content3_'.$this->session->userdata("site_lang")),array());
		
		//echo "<pre>" ; print_r($data['main_heading']); die;
		$this->adminheader();	
		$this->load->view("admin/HomeSettings",$data);	
		$this->adminfooter(); 	
		
	}	
	
}