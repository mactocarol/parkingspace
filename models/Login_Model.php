<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Login_Model Extends CI_Model {

    public function admin_login(){

        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', md5($this->input->post('password')));
        $result=$this->db->get('admin_login')->result();
        if(is_array($result) && count($result)==1)
        {
            if($this->input->post("remember"))
            {
                set_cookie('uname',$this->input->post('email'),'3600');
                set_cookie('upassword',$this->input->post('password'),'3600');
            }		
            $this->set_session($result[0]);
            return $result;	
        }
        else{       
            return false;
        }
    }

    function set_session($userinfo) {

        $this->session->set_userdata( array(
            'id'=> $userinfo->id,
            'type'=> 'Admin',			  
            'isLoggedIn'=>true
        )
    );
    }
	
	 public function user_login(){

        $this->db->where('email', $this->input->post('email'));
        $this->db->where('password', md5($this->input->post('password')));
        $result=$this->db->get('user')->result();
        if(is_array($result) && count($result)==1)
        {
                $type=$result[0]->type;
				if($this->input->post("remember"))
            {
                set_cookie('uname',$this->input->post('email'),'3600');
                set_cookie('upassword',$this->input->post('password'),'3600');
            }
                if($type=="Owner")
				{					
                $this->set_user_session($result[0]);
                return 1;
				}
                if($type=="User")
				{					
                $this->set_user_session($result[0]);
                return 2;
				}					
        }
		else{
                return false;
        }
    }
	
	function set_user_session($userinfo) {
        $this->session->set_userdata( array(              
            'uid'=> $userinfo->id,
            'type'=> $userinfo->type,		  
            'isLoggedInUser'=>true
        )
    );
    }
	

    public function checkuser($id)
    {
        $query=$this->db->select("*")->where("id",$id)->get("user");
        $user = $query->row();
		//print_r($user); die;
        $this->set_user_session($user);	    	 
        return true;
    }
   
}
?>