<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Manageblog extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        $this->checkSessionAdmin();	
        $this->load->model("Blog_Model");		
    }

/*--- start blogcategory --*/	
public function blogcategory()
{
$data['control']="Manageblog";
$data['controlname']="blogcategory";	
$data['controlnamehead']="Blog category";	
$data['blogcategory']=$this->Common_Model->getdata("blogcategory",$where='',$sort='');	
$this->adminheader();	
$this->load->view("admin/Blogcategory",$data);	
$this->adminfooter(); 
}

public function addblogcategory()
{
$data['control']="Manageblog";
$data['controlnamemsg']="Add blog category";
$data['controlname']="blogcategory";	
$this->adminheader();	
$this->load->view("admin/Addblogcategory",$data);	
$this->adminfooter(); 
}

public function editblogcategory($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}
$data['control']="Manageblog";
$data['controlnamemsg']="Edit blog category";
$data['controlname']="blogcategory";
	
$where=array("id"=>$id);
$data['blogcategory']=$this->Common_Model->getdata("blogcategory",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editblogcategory",$data);	
$this->adminfooter();
}

public function createblogcategory()
{
        $this->form_validation->set_rules('title', 'Name', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->addblogcategory();
		}
		else
		{
					
	     $datas=array("name"=>$this->input->post("title"),
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("blogcategory",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Blog category added successfully");
		   redirect("Manageblog/blogcategory");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Manageblog/addblogcategory");
	     }
		}		
}

public function updateblogcategory($id=0)
{
        $this->form_validation->set_rules('title', 'Name', 'required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editblogcategory($id);
		}
		else
		{	

         $where=array("id"=>$id);		 
		
	     $datas=array("name"=>$this->input->post("title"),
         "updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("blogcategory",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Blog category updated successfully");
		   redirect("Manageblog/blogcategory");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Manageblog/editblogcategory/$id");
	     }
		}		
}

public function deleteblogcategory()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Blog category delete successfully.");
			redirect("Manageblog/blogcategory");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Manageblog/blogcategory");
		}
		else{
			$id=$this->input->post('id');			
		    $data=$this->Common_Model->deletedata('blogcategory',array('id'=>$id));			
			echo $data;
		}			
	}
	
	
public function showblogcategory($id,$status)
	{
            $sts=0;
			$v="";
			if($status==1)
			{
				$sts=0;
				$v="hide";
	        }
			if($status==0)
			{
				$sts=1;
				$v="show";
			}
			
            $udata=array("status"=>$sts);
			$data=$this->Common_Model->update('blogcategory',$udata,array('id'=>$id));			
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Blog category ".$v." successfully.");
			redirect("Manageblog/blogcategory");
	}
/*--- end blogcategory --*/
	
	
/*--- start blog ---*/	
	
public function blog()
{
$data['category']=$this->Common_Model->getdata("blogcategory",$where="",$sort='name asc');
$data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');		
$data['control']="Manageblog";
$data['controlname']="blog";	
$data['controlnamehead']="Blog";	
$result=$this->Blog_Model->getallblog();
foreach($result as $key =>$value)
{
    $arrfeature= explode(",", $value->category);
	$this->db->where_in("id",$arrfeature);
	$result1=$this->db->get("blogcategory")->result();
	$c_name=array();
	foreach($result1 as $rs)
	{
		$c_name[]=$rs->name;		
	}
	$c_name=implode(",",$c_name);
	$result[$key]->cname=$c_name;	
}
$data['blog']=$result;	
$this->adminheader();	
$this->load->view("admin/Blog",$data);	
$this->adminfooter(); 
}

public function addblog()
{
$data['control']="Manageblog";
$data['controlnamemsg']="Add blog";
$data['controlname']="blog";
$data['category']=$this->Common_Model->getdata("blogcategory",$where="",$sort='name asc');
$data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');		
$this->adminheader();	
$this->load->view("admin/Addblog",$data);	
$this->adminfooter(); 
}

public function editblog($id=0)
{	
if($this->uri->segment(3))
{
$id=$this->uri->segment(3);
}
$data['control']="Manageblog";
$data['controlnamemsg']="Edit blog";
$data['controlname']="blog";
$data['category']=$this->Common_Model->getdata("blogcategory",$where="",$sort='name asc');	
$data['user']=$this->Common_Model->getdata("user",$where="",$sort='name asc');	
$where=array("id"=>$id);
$data['blog']=$this->Common_Model->getdata("blog",$where,$sort='');	
$this->adminheader();	
$this->load->view("admin/Editblog",$data);	
$this->adminfooter();
}

public function createblog()
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('category[]', 'Category', 'required');
		$this->form_validation->set_rules('uid', 'User', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->addblog();
		}
		else
		{
		 $photo=$this->savecropimage("photo","upload/blog/");
		  $category="";	
		  if($this->input->post('category'))
          $category=implode(",", $this->input->post('category'));	
		 $ophoto=$this->imageUpload("ophoto","upload/blog/");
					
	     $datas=array("title"=>$this->input->post("title"),"description"=>$this->input->post("description"),"category"=>$category,"uid"=>$this->input->post("uid"),"photo"=>$photo,"ophoto"=>$ophoto,
		 "created_dt"=>date("Y-m-d H:i:s"),"updated_dt"=>date("Y-m-d H:i:s"));
		 $updt=$this->Common_Model->insert("blog",$datas);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Blog added successfully");
		   redirect("Manageblog/blog");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Manageblog/addblog");
	     }
		}		
}

public function updateblog($id=0)
{
        $this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('category[]', 'Category', 'required');
		$this->form_validation->set_rules('uid', 'User', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->editblog($id);
		}
		else
		{	
	      if(!empty($_FILES['ophoto']['name']))
		  {
		  $this->unsetImage($id,'blog','ophoto','upload/blog/');		  		 
		  $ophoto=$this->imageUpload("ophoto","upload/blog/");		 	     
		  }
		  else{
		  $ophoto=$this->input->post('ophoto1');
          }
		  $category="";	
		  if($this->input->post('category'))
          $category=implode(",", $this->input->post('category'));		

          $where=array("id"=>$id);	

          if($this->input->post("photo"))
		  {
		  $this->unsetImage($id,'blog','photo','upload/blog/');		  		 
		  $photo=$this->savecropimage("photo","upload/blog/");		 	     
		  }
		  else{
		  $photo=$this->input->post('photo1');
          }			  
		
	      $datas=array("title"=>$this->input->post("title"),"description"=>$this->input->post("description"),"category"=>$category,"uid"=>$this->input->post("uid"),"photo"=>$photo,"ophoto"=>$ophoto,
		  "status"=>0,"updated_dt"=>date("Y-m-d H:i:s"));
		 
		 $updt=$this->Common_Model->update("blog",$datas,$where);		   
		 if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Blog updated successfully");
		   redirect("Manageblog/blog");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to update");
           redirect("Manageblog/editblog/$id");
	     }
		}		
}

public function deleteblog()
	{
		if($this->uri->segment(3)=='success')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Blog delete successfully.");
			redirect("Manageblog/blog");
		}
		else if($this->uri->segment(3)=='error')
		{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'error');
			$this->session->set_flashdata('msg', "Error to delete.");
			redirect("Manageblog/blog");
		}
		else{
			$id=$this->input->post('id');
            $this->unsetImage($id,'blog','ophoto','upload/blog/');
            $this->unsetImage($id,'blog','photo','upload/blog/');			
		    $data=$this->Common_Model->deletedata('blog',array('id'=>$id));			
			echo $data;
		}			
	}
	
	
public function showblog($id,$status)
	{
		$site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
        $blog_name=$this->getSingleValue($id,'blog','title');
		$uid=$this->getSingleValue($id,'blog','uid');
		$name=$this->getSingleValue($uid,'user','name');
		$email=$this->getSingleValue($uid,'user','email');
            $sts=0;
			$v="";
			if($status==1)
			{
				$sts=1;
				$v="Approved";
				$message="Your ".$blog_name." blog has been approved.";
				$subject="Blog approved at ".$site_title;
	        }
			if($status==2)
			{
				$sts=2;
				$v="Disapproved";
				$message="Your ".$blog_name." blog has been disapproved.";
				$subject="Blog disapproved at ".$site_title;
			}
			
			$datas['messages']=array($name,$message);
		    $this->email($email,$subject,$datas);
			
            $udata=array("status"=>$sts);
			$data=$this->Common_Model->update('blog',$udata,array('id'=>$id));			
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
			$this->session->set_flashdata('msg', "Blog ".$v." successfully.");
			redirect("Manageblog/blog");
	}
	/*--- end blog ---*/
	
}