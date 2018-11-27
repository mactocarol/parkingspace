<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Homesetting extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->checkSessionAdmin();		
    }

/* Start Slider */
	
public function slider()
{
$data['slider']=$this->Common_Model->getdata("slider",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Slider",$data);	
$this->adminfooter(); 
}

public function addslider()
{
$data['frontsetting']=$this->Common_Model->getdata("slider",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Addslider",$data);	
$this->adminfooter(); 
}

public function editslider($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['slider']=$this->Common_Model->getdata("slider",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editslider",$data);	
$this->adminfooter();
}

public function createslider()
{
		$this->form_validation->set_rules('url', 'Slider Url', 'required');
		$photo=$this->imageuploadresize("photo","./upload/slider/","./upload/slider/thumb/",1200,500,800,'kb','jpg|png|jpeg');		 

		if ($this->form_validation->run() == FALSE)
		{
			$this->addslider();
		}
		else
		{		
	     $datas=array("photo"=>$photo,'url'=>$this->input->post("url"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("slider",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Slider added successfully");
		   redirect("Homesetting/slider");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addslider");
	     }
		}		
}

public function updateslider($id=0)
{
        $this->form_validation->set_rules('url', 'Slider Url', 'required');
		if(!empty($_FILES['photo']['name']))
		{
		$photo=$this->imageuploadresize("photo","./upload/slider/","./upload/slider/thumb/",1200,500,900,'kb','jpg|png|jpeg');		 
		}		
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->editslider($id);
		}
		else
		{	
	     if(empty($_FILES['photo']['name']))
		{
	      $photo=$this->input->post('photo1');
		}
		else
		{
          $this->unsetImage($id,'slider','photo','upload/slider/thumb/','upload/slider/');		  
		}
        
         $where=array("id"=>$id);
		 		
	     $datas=array("photo"=>$photo,'url'=>$this->input->post("url"),
		 "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("slider",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Slider updated successfully");
		   redirect("Homesetting/slider");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editslider/$id");
	     }
		}		
}

public function deleteslider()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Slider delete successfully.");
			redirect("Homesetting/slider");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/slider");
		}
		else{
			$id=$this->input->post('id');			
			$this->unsetImage($id,'slider','photo','upload/slider/thumb/','upload/slider/');
			$data=$this->Common_Model->deletedata('slider',array('id'=>$id));			
			echo $data;
		}			
	}

public function showslider($id=0)
	{
        if($this->uri->segment(3))
        {
           $id=$this->uri->segment(3);
        }
        $status=$this->getSingleValue($id,'slider','status');
        $sts=0;
        if($status==0)
        {
          $sts=1;
        }
        if($status==1)
        {
          $sts=0;
        }
        $where=array("id"=>$id);
        $datas=array("status"=>$sts);
        $data=$this->Common_Model->update("slider",$datas,$where);
		if($sts==1)
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Slider show successfully.");
			
		}
		else
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Slider hide successfully.");			
		}
        redirect("Homesetting/slider");			
	}

/* End Slider */

/* Start aboutus  */

public function aboutus()
{
$data['aboutus']=$this->Common_Model->getdata("aboutus",$where='',$sort='id desc');	
$this->adminheader();	
$this->load->view("admin/Aboutus",$data);	
$this->adminfooter(); 
}

public function addaboutus()
{	
$this->adminheader();	
$this->load->view("admin/Addaboutus");	
$this->adminfooter(); 
}

public function editaboutus($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['aboutus']=$this->Common_Model->getdata("aboutus",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editaboutus",$data);	
$this->adminfooter();
}

public function createaboutus()
{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$photo=$this->imageuploadresize("photo","./upload/aboutus/","./upload/aboutus/thumb/",300,369,900,'kb','png|jpg');		 

		if ($this->form_validation->run() == FALSE)
		{
			$this->addaboutus();
		}
		else
		{	 
	     $datas=array("photo"=>$photo,"title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("aboutus",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "About us added successfully");
		   redirect("Homesetting/aboutus");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addaboutus");
	     }
		}		
}

public function updateaboutus($id=0)
{
      	$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if(!empty($_FILES['photo']['name']))
		{
		$photo=$this->imageuploadresize("photo","./upload/aboutus/","./upload/aboutus/thumb/",300,369,900,'kb','png|jpg');		 
		}		
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->editaboutus($id);
		}
		else
		{	
	     if(empty($_FILES['photo']['name']))
		{
	      $photo=$this->input->post('photo1');
		}
		else
		{
          $this->unsetImage($id,'aboutus','photo','upload/aboutus/thumb/','upload/aboutus/');		  
		}
        
         $where=array("id"=>$id);
		 
	     $datas=array("photo"=>$photo,"title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("aboutus",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "About us updated successfully");
		   redirect("Homesetting/aboutus");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editaboutus/$id");
	     }
		}		
}

public function deleteaboutus()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "About us delete successfully.");
			redirect("Homesetting/aboutus");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/aboutus");
		}
		else{
			$id=$this->input->post('id');			
			$this->unsetImage($id,'aboutus','photo','upload/aboutus/thumb/','upload/aboutus/');
			$data=$this->Common_Model->deletedata('aboutus',array('id'=>$id));			
			echo $data;
		}			
	}

/* End aboutus  */


/* Start aboutus box  */

public function aboutusbox()
{
$data['aboutus']=$this->Common_Model->getdata("aboutusbox",$where='',$sort='id desc');	
$this->adminheader();	
$this->load->view("admin/Aboutusbox",$data);	
$this->adminfooter(); 
}

public function addaboutusbox()
{	
$this->adminheader();	
$this->load->view("admin/Addaboutusbox");	
$this->adminfooter(); 
}

public function editaboutusbox($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['aboutus']=$this->Common_Model->getdata("aboutusbox",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editaboutusbox",$data);	
$this->adminfooter();
}

public function createaboutusbox()
{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addaboutusbox();
		}
		else
		{	 
	     $datas=array("icon"=>$this->input->post("icon"),"title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("aboutusbox",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "About us box added successfully");
		   redirect("Homesetting/aboutusbox");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addaboutusbox");
	     }
		}		
}

public function updateaboutusbox($id=0)
{
      	$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editaboutusbox($id);
		}
		else
		{	

         $where=array("id"=>$id);
		 
	     $datas=array("icon"=>$this->input->post("icon"),"title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("aboutusbox",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "About us box updated successfully");
		   redirect("Homesetting/aboutusbox");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editaboutusbox/$id");
	     }
		}		
}

public function deleteaboutusbox()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "About us box delete successfully.");
			redirect("Homesetting/aboutusbox");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/aboutusbox");
		}
		else{
			$id=$this->input->post('id');			
			$data=$this->Common_Model->deletedata('aboutusbox',array('id'=>$id));			
			echo $data;
		}			
	}

/* End aboutus box */



/* Start servicebox  */

public function servicebox()
{
$data['servicebox']=$this->Common_Model->getdata("servicebox",$where='',$sort='id desc');	
$this->adminheader();	
$this->load->view("admin/Servicebox",$data);	
$this->adminfooter(); 
}

public function addservicebox()
{	
$this->adminheader();	
$this->load->view("admin/Addservicebox");	
$this->adminfooter(); 
}

public function editservicebox($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['servicebox']=$this->Common_Model->getdata("servicebox",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editservicebox",$data);	
$this->adminfooter();
}

public function createservicebox()
{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addservicebox();
		}
		else
		{	 
	     $datas=array("icon"=>$this->input->post("icon"),"title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("servicebox",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Service box added successfully");
		   redirect("Homesetting/servicebox");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addservicebox");
	     }
		}		
}

public function updateservicebox($id=0)
{
      	$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editservicebox($id);
		}
		else
		{	

         $where=array("id"=>$id);
		 
	     $datas=array("icon"=>$this->input->post("icon"),"title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("servicebox",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Service box updated successfully");
		   redirect("Homesetting/servicebox");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editservicebox/$id");
	     }
		}		
}

public function deleteservicebox()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Service box delete successfully.");
			redirect("Homesetting/servicebox");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/servicebox");
		}
		else{
			$id=$this->input->post('id');			
			$data=$this->Common_Model->deletedata('servicebox',array('id'=>$id));			
			echo $data;
		}			
	}

/* End service box */


/* Start socialicon  */

public function socialicon()
{
$data['socialicon']=$this->Common_Model->getdata("socialicon",$where='',$sort='id desc');	
$this->adminheader();	
$this->load->view("admin/Socialicon",$data);	
$this->adminfooter(); 
}

public function addsocialicon()
{	
$this->adminheader();	
$this->load->view("admin/Addsocialicon");	
$this->adminfooter(); 
}

public function editsocialicon($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['socialicon']=$this->Common_Model->getdata("socialicon",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editsocialicon",$data);	
$this->adminfooter();
}

public function createsocialicon()
{
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addsocialicon();
		}
		else
		{	 
	     $datas=array("icon"=>$this->input->post("icon"),"url"=>$this->input->post("url"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("socialicon",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "socialicon added successfully");
		   redirect("Homesetting/socialicon");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addsocialicon");
	     }
		}		
}

public function updatesocialicon($id=0)
{
      	$this->form_validation->set_rules('icon', 'Icon', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->editsocialicon($id);
		}
		else
		{	

         $where=array("id"=>$id);
		 
	     $datas=array("icon"=>$this->input->post("icon"),"url"=>$this->input->post("url"),
		 "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("socialicon",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "socialicon updated successfully");
		   redirect("Homesetting/socialicon");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editsocialicon/$id");
	     }
		}		
}

public function deletesocialicon()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "socialicon delete successfully.");
			redirect("Homesetting/socialicon");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/socialicon");
		}
		else{
			$id=$this->input->post('id');			
			$data=$this->Common_Model->deletedata('socialicon',array('id'=>$id));			
			echo $data;
		}			
	}

/* End socialicon */

/* Start news  */

public function news()
{
$data['news']=$this->Common_Model->getdata("news",$where='',$sort='id desc');	
$this->adminheader();	
$this->load->view("admin/News",$data);	
$this->adminfooter(); 
}

public function addnews()
{	
$this->adminheader();	
$this->load->view("admin/Addnews");	
$this->adminfooter(); 
}

public function editnews($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['news']=$this->Common_Model->getdata("news",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editnews",$data);	
$this->adminfooter();
}

public function createnews()
{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('newsdate', 'Date', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addnews();
		}
		else
		{	 
	     $datas=array("newsdate"=>$this->input->post("newsdate"),"title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("news",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "News added successfully");
		   redirect("Homesetting/news");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addnews");
	     }
		}		
}

public function updatenews($id=0)
{
      	$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('newsdate', 'Date', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editnews($id);
		}
		else
		{	

         $where=array("id"=>$id);
		 
	     $datas=array("newsdate"=>$this->input->post("newsdate"),"title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("news",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "News updated successfully");
		   redirect("Homesetting/news");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editnews/$id");
	     }
		}		
}

public function deletenews()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "News delete successfully.");
			redirect("Homesetting/news");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/news");
		}
		else{
			$id=$this->input->post('id');			
			$data=$this->Common_Model->deletedata('news',array('id'=>$id));			
			echo $data;
		}			
	}

/* End news */

/* Start faq  */

public function faq()
{
$data['faq']=$this->Common_Model->getdata("faq",$where='',$sort='id desc');	
$this->adminheader();	
$this->load->view("admin/Faq",$data);	
$this->adminfooter(); 
}

public function addfaq()
{	
$this->adminheader();	
$this->load->view("admin/Addfaq");	
$this->adminfooter(); 
}

public function editfaq($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['faq']=$this->Common_Model->getdata("faq",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editfaq",$data);	
$this->adminfooter();
}

public function createfaq()
{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addfaq();
		}
		else
		{	 
	     $datas=array("title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("faq",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Faq added successfully");
		   redirect("Homesetting/faq");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addfaq");
	     }
		}		
}

public function updatefaq($id=0)
{
      	$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editfaq($id);
		}
		else
		{	

         $where=array("id"=>$id);
		 
	     $datas=array("title"=>$this->input->post("title"),
		 "description"=>$this->input->post("description"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("faq",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Faq updated successfully");
		   redirect("Homesetting/faq");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editfaq/$id");
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
			redirect("Homesetting/faq");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/faq");
		}
		else{
			$id=$this->input->post('id');			
			$data=$this->Common_Model->deletedata('faq',array('id'=>$id));			
			echo $data;
		}			
	}

/* End faq */


/* Start contactus  */

public function contactus()
{
$data['contactus']=$this->Common_Model->getdata("contactus",$where='',$sort='id desc');	
$this->adminheader();	
$this->load->view("admin/Contactus",$data);	
$this->adminfooter(); 
}

public function addcontactus()
{	
$this->adminheader();	
$this->load->view("admin/Addcontactus");	
$this->adminfooter(); 
}

public function editcontactus($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['contactus']=$this->Common_Model->getdata("contactus",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editcontactus",$data);	
$this->adminfooter();
}

public function createcontactus()
{
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addcontactus();
		}
		else
		{	 
	     $datas=array("address"=>$this->input->post("address"),"email"=>$this->input->post("email"),
		 "phone"=>$this->input->post("phone"),"created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("contactus",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Contactus added successfully");
		   redirect("Homesetting/contactus");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addcontactus");
	     }
		}		
}

public function updatecontactus($id=0)
{
      	$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editcontactus($id);
		}
		else
		{	

         $where=array("id"=>$id);
		 
	     $datas=array("address"=>$this->input->post("address"),"email"=>$this->input->post("email"),
		 "phone"=>$this->input->post("phone"),"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("contactus",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Contactus updated successfully");
		   redirect("Homesetting/contactus");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editcontactus/$id");
	     }
		}		
}

public function deletecontactus()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Contactus delete successfully.");
			redirect("Homesetting/contactus");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/contactus");
		}
		else{
			$id=$this->input->post('id');			
			$data=$this->Common_Model->deletedata('contactus',array('id'=>$id));			
			echo $data;
		}			
	}

/* End contactus */



/* Start newsletter  */

public function newsletter()
{
$data['newsletter']=$this->Common_Model->getdata("newsletter",$where='',$sort='id desc');	
$this->adminheader();	
$this->load->view("admin/Newsletter",$data);	
$this->adminfooter(); 
}

public function addnewsletter()
{	
$this->adminheader();	
$this->load->view("admin/Addnewsletter");	
$this->adminfooter(); 
}

public function editnewsletter($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}	
$where=array("id"=>$id);
$data['newsletter']=$this->Common_Model->getdata("newsletter",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editnewsletter",$data);	
$this->adminfooter();
}

public function createnewsletter()
{
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addnewsletter();
		}
		else
		{	 
	     $datas=array("email"=>$this->input->post("email"),
		"created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("newsletter",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Newsletter added successfully");
		   redirect("Homesetting/newsletter");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Homesetting/addnewsletter");
	     }
		}		
}

public function updatenewsletter($id=0)
{
		$this->form_validation->set_rules('email', 'Email', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editnewsletter($id);
		}
		else
		{	

         $where=array("id"=>$id);
		 
	     $datas=array("email"=>$this->input->post("email"),
		 "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("newsletter",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Newsletter updated successfully");
		   redirect("Homesetting/newsletter");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Homesetting/editnewsletter/$id");
	     }
		}		
}

public function deletenewsletter()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "newsletter delete successfully.");
			redirect("Homesetting/newsletter");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Homesetting/newsletter");
		}
		else{
			$id=$this->input->post('id');			
			$data=$this->Common_Model->deletedata('newsletter',array('id'=>$id));			
			echo $data;
		}			
	}

/* End newsletter */



}