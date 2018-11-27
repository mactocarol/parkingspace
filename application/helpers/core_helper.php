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

