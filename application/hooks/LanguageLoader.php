<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
		
		 if(!$ci->session->userdata('site_lang')){
             $ci->session->set_userdata('site_lang', 'english');
         }
		
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('message',$siteLang);
        } else {
            $ci->lang->load('message','english');
        }
		
		$data=array("online"=>1,"onlinedate"=>date("Y-m-d H:i:s"));
        $ci->db->where("id",$ci->session->userdata('uid'));
        $ci->db->update("user",$data);
    }
}
?>