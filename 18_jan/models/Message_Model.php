<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_Model Extends CI_Model {

function __construct() {
        parent::__construct();        	    		
    }
	
	public function getproperty($id=0)
	{
		$uid=$this->session->userdata("uid");
		$this->db->select("enquiry.pid,property.photo,property.title,property.ophoto,property.price");
		$this->db->join("property","enquiry.pid=property.id","left");
		$this->db->where("(aid=$uid and enquiry.uid=$id) OR (aid=$id and enquiry.uid=$uid)");
		return $this->db->get("enquiry")->result();		
	}
	
public function getuserlist($id=0)
	{
		$this->db->select("DISTINCT(user.name),user.type,user.id,user.photo,user.onlinedate,user.online");
		$this->db->join("enquiry a","user.id=a.uid","left");
		$this->db->join("enquiry b","user.id=b.aid","left");
		$this->db->where("user.id !=$id AND (a.uid=$id OR b.aid=$id OR a.aid=$id OR b.uid=$id)");
		$this->db->order_by("a.created_dt","desc");
		$result=$this->db->get("user")->result();
        foreach($result as $key=>$row)
	{
		
		if($row->onlinedate!="1899-11-30 00:00:00" && $row->onlinedate!="0000-00-00 00:00:00")				
				{
	    $result[$key]->ago=$this->getago($row->onlinedate);	
				}
	$sid =$row->id;	
	$this->db->select("count(status) as no");
	$this->db->where("status" ,0);
	$this->db->where("sid",$sid);
	$this->db->where("rid",$id);	
    $da =  $this->db->get("chat")->result();
    $no = $da[0]->no;
    $result[$key]->no = $no;	
	}		
		return $result;
	}
	
	public function getridinfo($rid)
	{
		$this->db->select("user.id,user.name,user.photo,user.onlinedate,user.online");
		$this->db->where("id",$rid);
		$result=$this->db->get("user")->result();
        foreach($result as $key =>$value)
        {
			    if($value->onlinedate!="1899-11-30 00:00:00" && $value->onlinedate!="0000-00-00 00:00:00")				
				{
	    $result[$key]->ago=$this->getago($value->onlinedate);	
				}
        }		
		return $result;
	}
    
    	public function getmessagelist($id,$rid)
	{
		$this->db->select("chat.*,a.name as snm,b.name as rnm,a.photo as sphoto,b.photo as rphoto,b.onlinedate,b.online");
		$this->db->join("user a","chat.sid=a.id","left");
		$this->db->join("user b","chat.rid=b.id","left");
		$this->db->where("chat.sid=$id AND chat.rid=$rid OR chat.sid=$rid AND chat.rid=$id");		
		$this->db->order_by("chat.create_dt","asc");	
		$result=$this->db->get("chat")->result();
foreach($result as $key => $value)
{
	 if($value->create_dt!="1899-11-30 00:00:00" && $value->create_dt!="0000-00-00 00:00:00")				
				{
	    $result[$key]->ago=$this->getago($value->create_dt);	
				}
}		
		return $result;
	}
	
	

function getago($ftime)
	{
					 $ftime=date("Y-m-d H:i:s",strtotime($ftime));
					 $cdt = date("Y-m-d H:i:s"); 
                     $cdt =  strtotime($cdt); 
					 $ftime = strtotime($ftime);
					 $datediff = ($cdt - $ftime); 
					
					$hrs= round($datediff / 3600);
                    $day= round($datediff / 86400);
                    $min= round($datediff / 60);
                    $month= round($datediff / 60 / 60 / 24 / 30);
					$ago=0;
					if($min==0)
					{
						$ago="Just Now";
					}
					else if($min<60)
					{
						$ago=$min.' Min ago';
					}
					else if($min>=60&&$min<1440)
					{
						$ago=$hrs.' Hrs ago';
					}
					else if($min>=1440&&$min<43200)
					{
						$ago=$day.' Days ago';
					}
					else
					{
						$ago=$month.' Months ago';
					}
					return $ago;
	}	


}
?>