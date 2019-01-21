<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_user_details')){
   function get_user_details($user_id){
  
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
       //get data from database
	   $ci->db->select("user.*,countries.countryname");
	   $ci->db->join("countries","user.country=countries.countryID","left");
	   //$ci->db->join("cities","user.city=cities.cityID","left");
	   if($user_id!='')
	   {
		   $ci->db->where("user.id",$user_id);
	   }
	   $ci->db->order_by("user.id","desc");
       $query = $ci->db->get('user');
       $result = $query->result();
       
           
		   foreach($result as $key=>$value)
{
	$result[$key]->dob=date("M/d/Y",strtotime($value->birthdate));
}
           return $result;
       
   }
	
	
	
}

if ( ! function_exists('getSpacePhoto')){
	function getSpacePhoto($space_id){
		$ci =& get_instance();       
       //load databse library
       $ci->load->database();
		$ci->db->select('*');
		$ci->db->where('sid',$space_id);
		$query = $ci->db->get('spacephoto');
      $result = $query->result();
		return $result;
	}
}

if ( ! function_exists('getUser')){
	function getUser($uid){
		$ci =& get_instance();       
       //load databse library
       $ci->load->database();
		$ci->db->select('*');
		$ci->db->where('id',$uid);
		$query = $ci->db->get('user');
      $result = $query->row();
		return $result;
	}
}


if ( ! function_exists('getChatId')){
	function getChatId(){
		
		$id = rand(100000,999999);		
		if($res = checkChatId($id)){			
			return getChatId();
		}else{
			return $id;	
		}		
	}
}


if ( ! function_exists('checkChatId')){
	function checkChatId($id){		
		$ci =& get_instance();       
       //load databse library
       $ci->load->database();
		$ci->db->select('*');
		$ci->db->where('chat_id',$id);
		$query = $ci->db->get('comments');
      $result = $query->row();
		//print_r($result); die;
		return $result;
	}
}

function get_user($userid){
        
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('id'=>$userid));
            $query = $CI->db->get('user');            
            $reslt = $query->row();
            //print_r($userid); die;
            return $reslt;
    }

	 
if ( ! function_exists('checkChatIdUser')){
	function checkChatIdUser($from,$to){
		//return $from; $to; 
		$ci =& get_instance();       
       //load databse library
       $ci->load->database();
		$ci->db->select('*');		
		$ci->db->where('message_to',$to);
		$ci->db->where('message_from',$from);
		$query = $ci->db->get('comments');
      $result = $query->row();
		//print_r($result); die;
		
		$ci->db->select('*');		
		$ci->db->where('message_to',$from);
		$ci->db->where('message_from',$to);
		$query1 = $ci->db->get('comments');
      $result1 = $query1->row();
		
		if(!empty($result)){
		return $result;
		}else{
		return $result1;
		}
		//return array($result,$result1);
	}
}

if ( ! function_exists('getCommission')){
	function getCommission(){
		
		$ci =& get_instance();       
       //load databse library
        $ci->load->database();
		$ci->db->select('*');		
		$ci->db->where('id',1);		
		$query = $ci->db->get('commission');
        $result = $query->row();
        return $result->price;
	}
}