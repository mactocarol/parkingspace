<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_Model Extends CI_Model {

	function __construct() {
	       parent::__construct();        	    		
	   }
	
	public function getNearbySpaces($lat,$long)
	{
		$query = $this->db->query("SELECT *, ( 3959 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($long) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance FROM rentourspace HAVING distance < 50 ORDER BY distance LIMIT 0 , 50 ");
		return $query->result_array();
	}



}
?>