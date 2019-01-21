<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{		
        $data=new stdClass();
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                //print_r($data); die;
                $data->msg = 1;
            }
		$data->page_heading = "Home";
		$data->page_link = "Home";	
        $this->load->view('header',$data);            
		$this->load->view('welcome_message',$data);
        $this->load->view('footer',$data);
	}
    
    public function about_us()
	{
        $data=new stdClass();
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                //print_r($data); die;
                $data->msg = 1;
            }
		$data->page_heading = "About us";
		$data->page_link = "About-us";		
        $this->load->view('header',$data);            
		$this->load->view('about_us',$data);
        $this->load->view('footer',$data);
	}
	public function services()
	{
        $data=new stdClass();
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                //print_r($data); die;
                $data->msg = 1;
            }
		$data->page_heading = "Services";
		$data->page_link = "Services";		
        $this->load->view('header',$data);            
		$this->load->view('services',$data);
        $this->load->view('footer',$data);
	}
    
    public function contact_us()
	{
        $data=new stdClass();
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                //print_r($data); die;
                $data->msg = 1;
            }
		$data->page_heading = "Contact us";
		$data->page_link = "Contact-us";		
        $this->load->view('header',$data);            
		$this->load->view('contact_us',$data);
        $this->load->view('footer',$data);
	}
    
    public function faq()
	{
        $data=new stdClass();
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                //print_r($data); die;
                $data->msg = 1;
            }
        $this->load->view('header',$data);            
		$this->load->view('faq',$data);
        $this->load->view('footer',$data);
	}
    
    public function support()
	{
        $data=new stdClass();
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                //print_r($data); die;
                $data->msg = 1;
            }
		$data->page_heading = "Support";
		$data->page_link = "Support";		
        $this->load->view('header',$data);            
		$this->load->view('support',$data);
        $this->load->view('footer',$data);
	}
    
	public function find_car()
	{
        $data=new stdClass();
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                //print_r($data); die;
                $data->msg = 1;
            }
		$this->load->model('welcome_model');
		if($_POST){
			$transmission = ($_POST['transmission'] == 1) ? 1 : 0;
			$category = ($_POST['category']) ? $_POST['category'] : '';
			$fuel_type = ($_POST['fuel_type']) ? $_POST['fuel_type'] : '';			
			$cars = $this->welcome_model->SelectRecord('cars','*',array("transmission"=>$transmission,"fuel_type"=>$fuel_type,"category"=>$category,"is_deleted"=>'1'),'id desc');
		}else{
			$cars = $this->welcome_model->SelectRecord('cars','*',array("is_deleted"=>'1'),'id desc');	
		}
		
	    foreach($cars as $key=>$row){
		$photos = $this->welcome_model->SelectRecord('car_photos','image',array("car_id"=>$row['id']),'id desc');
		$carphoto = [];
		foreach($photos as $photo){
			$carphoto[] = $photo['image'];
		}
		$cars[$key]['image'] = $carphoto;
	    }
		
		$data->cars = $cars;		
		$data->page_heading = "Find a Car";
		$data->page_link = "Find-car";		
        $this->load->view('header',$data);            
		$this->load->view('find-car',$data);
        $this->load->view('footer',$data);
	}
	
	public function partner()
	{
		$data=new stdClass();
		if(!$this->session->userdata('user_id')){
			$data->error=1;
			$data->success=0;
			$data->message="You must login first to become a partner.";	   
			$this->session->set_flashdata('item',$data);
			redirect('Login');
		}
		
        
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                //print_r($data); die;
                $data->msg = 1;
            }
		
		if($this->session->userdata('user_id')){
			$this->load->model('welcome_model');
			$data->companyinfo = $this->welcome_model->SelectSingleRecord('partner','*',array("user_id"=>$this->session->userdata('user_id')),$orderby=array());
		}
		//print_r($data); die;
		$data->page_heading = "Become a Partner";
		$data->page_link = "Become-partner";		
        $this->load->view('header',$data);            
		$this->load->view('become-partner',$data);
        $this->load->view('footer',$data);
	}
    
    public function contact(){
           $this->load->model('welcome_model');
           $udata = array("id"=>4);                
            $result = $this->welcome_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
                        $to = $result->email;
                        $to = 'parvezkhan03@gmail.com';
                        $sub = "New Message from User";
                        $message  = "<p>Name - ".$this->input->post('name')."</p>";
                        $message .= "<p>Email - ".$this->input->post('email')."</p>";
                        $message .= "<p>Message - ".$this->input->post('message')."</p>";
                        
                        $this->load->helper('ht_helper');
                        phpmailer($to,$sub,$message);
               
                    $data->error=0;
                    $data->success=1;
                    $data->message="Thanks for contact, we will get in touch you soon.";
               
               $this->session->set_flashdata('item',$data);
               redirect('contact_page/'.$this->input->post('username'));
        }
        
        
    public function ipn(){
        $this->load->model('welcome_model');
        
        /*
        * Read POST data
        * reading posted data directly from $_POST causes serialization
        * issues with array data in POST.
        * Reading raw POST data from input stream instead.
        */        
       $raw_post_data = file_get_contents('php://input');
       $raw_post_array = explode('&', $raw_post_data);
       $myPost = array();
       foreach ($raw_post_array as $keyval) {
           $keyval = explode ('=', $keyval);
           if (count($keyval) == 2)
               $myPost[$keyval[0]] = urldecode($keyval[1]);
       }
       
       // Read the post from PayPal system and add 'cmd'
       $req = 'cmd=_notify-validate';
       if(function_exists('get_magic_quotes_gpc')) {
           $get_magic_quotes_exists = true;
       }
       foreach ($myPost as $key => $value) {
           if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
               $value = urlencode(stripslashes($value));
           } else {
               $value = urlencode($value);
           }
           $req .= "&$key=$value";
       }
       
       /*
        * Post IPN data back to PayPal to validate the IPN data is genuine
        * Without this step anyone can fake IPN data
        */
       $paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
       $ch = curl_init($paypalURL);
       if ($ch == FALSE) {
           return FALSE;
       }
       curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
       curl_setopt($ch, CURLOPT_SSLVERSION, 6);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
       curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
       
       // Set TCP timeout to 30 seconds
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
       $res = curl_exec($ch);
       
       /*
        * Inspect IPN validation result and act accordingly
        * Split response headers and payload, a better way for strcmp
        */ 
       $tokens = explode("\r\n\r\n", trim($res));
       $res = trim(end($tokens));
       if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {
           //Include DB configuration file
           include 'dbConfig.php';
           
           $unitPrice = 25;
           
           //Payment data
           $subscr_id = $_POST['subscr_id'];
           $payer_email = $_POST['payer_email'];
           $item_number = $_POST['item_number'];
           $txn_id = $_POST['txn_id'];
           $payment_gross = $_POST['mc_gross'];
           $currency_code = $_POST['mc_currency'];
           $payment_status = $_POST['payment_status'];
           $custom = $_POST['custom'];
           $subscr_month = ($payment_gross/$unitPrice);
           $subscr_days = ($subscr_month*30);
           $subscr_date_from = date("Y-m-d H:i:s");
           $subscr_date_to = date("Y-m-d H:i:s", strtotime($subscr_date_from. ' + '.$subscr_days.' days'));
           
           if(!empty($txn_id)){
               //Check if subscription data exists with the same TXN ID.
               $prevPayment = $this->welcome_model->SelectSingleRecord('user_subscriptions','*',array("txn_id"=>$txn_id),$orderby=array());
               //$prevPayment = $db->query("SELECT id FROM user_subscriptions WHERE txn_id = '".$txn_id."'");
               if(!empty($prevPayment)){
                   exit();
               }else{
                   //Insert tansaction data into the database
                   $udata['user_id'] = $custom;
                   $udata['validity'] = $subscr_month;
                   $udata['valid_from'] = $subscr_date_from;
                   $udata['valid_to'] = $subscr_date_to;
                   $udata['item_number'] = $item_number;
                   $udata['txn_id'] = $txn_id;
                   
                   $udata['payment_gross'] = $payment_gross;
                   $udata['currency_code'] = $currency_code;
                   $udata['subscr_id'] = $subscr_id;
                   $udata['payment_status'] = $payment_status;
                   $udata['payer_email'] = $payer_email;                   
                   
                   $insert = $this->welcome_model->InsertRecord('user_subscriptions',$udata);                   
                   
                   //Update subscription id in users table
                   if($insert){
                      $userdata['id'] = $udata['user_id'];
                       $this->welcome_model->UpdateRecord('users',array("account_type"=>"pro","subscription_id"=>$insert),$userdata);                                                                       
                   }
               }
           }
       }
       die;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */