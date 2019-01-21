<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_Model Extends CI_Model {

function __construct() {
        parent::__construct();        	    		
    }
	
public function getallblog($id=0)
{
	
	$this->db->select("blog.*,user.name");
	$this->db->join("user","blog.uid=user.id","left");
	
	$name_english=$this->input->post("username");
	$created_dt=$this->input->post("sessiondate");
    $category=$this->input->post("category");
	$title=$this->input->post("title");
	
	if($created_dt!="")
    {
       $nameParts1 = explode('-',$created_dt); 
       $sfirst = $nameParts1[0];
       $sfirst=date("Y-m-d",strtotime($sfirst));
       if(empty($nameParts1[1]))
       {
          $this->db->where("DATE_FORMAT(blog.created_dt,'%Y-%m-%d')",$sfirst);
       }
       else
       {
          $slast = array_pop($nameParts1);
          $slast=date("Y-m-d",strtotime($slast));
          $this->db->where("DATE_FORMAT(blog.created_dt,'%Y-%m-%d') BETWEEN '".$sfirst."' AND '".$slast."'");
       }
	}
	
	if($name_english!='')
	$this->db->like("user.name",$name_english);

	if($category!='')
	$this->db->where("FIND_IN_SET('$category',blog.category) !=", 0);
	
	if($title!='')
	$this->db->like("title",$title);
		
	if($id!=0)
	$this->db->where("blog.id",$id);


    $this->db->order_by("blog.id","desc");
	return $this->db->get("blog")->result();   
}

public function getpopularcategory()
{
	$this->db->order_by("blogcategory.id","rand");
	$this->db->limit(10);
	$result = $this->db->get("blogcategory")->result();
	foreach($result as $key => $value)
	{
		$cid=$value->id;
		$this->db->select("count(blog.id) as no");
		$this->db->where("FIND_IN_SET('$cid',blog.category) !=", 0);
		$rs=$this->db->get("blog")->result();
		$result[$key]->no=$rs[0]->no;
	}
	return $result;
}

/*
For comma separated value join
SELECT  a.title,
        GROUP_CONCAT(b.name ORDER BY b.id) DepartmentName
FROM    blog a
        INNER JOIN blogcategory b
            ON FIND_IN_SET(b.id, a.category) > 0
GROUP   BY a.id
*/

}
?>