<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Search extends MY_Base_Controller{
	function __construct() {
        parent::__construct();
        //$this->checkSession();
		$this->load->model('Search_Model');
		$this->load->helper('core_helper');
        $this->uid=$this->session->userdata("uid");		
    }

	/*--- start featuredpayment --*/	
	public function index()
	{
		$dropoff = $this->input->get('drop_off');
		$pickup = $this->input->get('pickup');
				
		$datas['pickup'] = $dropoff;
		$datas['dropoff'] = $pickup;
				
		$date_from = strtotime($dropoff); // Convert date to a UNIX timestamp  
		  		 		
		$date_to = strtotime($pickup); // Convert date to a UNIX timestamp  
		  
		// Loop from the start date to end date and output all dates inbetween
		$days = []; $dates = [];
		for ($i=$date_from; $i<=$date_to; $i+=86400) {  
			$days[] = date("N", $i);
			$dates[] = date("d-m-y", $i);  
		}
		
		foreach($days as $d){
			$days1[] = ($d - 1);
		}
		$days = $days1;
		//print_r($days); die;		
		$latLong = $this->getLatLong($this->input->get('place'));
		//echo "<pre>"; print_r($latLong); die;
		$latitude = $latLong['latitude']?$latLong['latitude']:'-';
		$longitude = $latLong['longitude']?$latLong['longitude']:'-';
		//$spaces = $this->Common_Model->getdata("rentourspace",$where=array(),$sort='');
		if($latitude != '-' && $longitude != ''){			
			$spaces = $this->Search_Model->getNearbySpaces($latitude,$longitude);			
		}else{
			$spaces = [];
		}
        
        
        //calculate price        
        $date1 = new DateTime($this->input->get('drop_off'));
        $date2 = $date1->diff(new DateTime($this->input->get('pickup')));
              
        $months = $date2->m;
        $pdays = $date2->d;
        $weeks = floor($pdays/7);
        $pdays = $pdays - ($weeks * 7);
        $hours = $date2->h;
        
        
		$commission = getCommission();
		//echo "<pre>"; print_r($spaces); die;
		$weekdays = [];
		$available_space = [];
        $available_space_ids = [];
		if(!empty($spaces)){
			foreach($spaces as $spc){
				$count = 0;
				$countt = 0;
				$counttt = 0;
				if($spc['week']){
					$weekdays = explode(',',$spc['week']);											
					foreach($days as $row){				 				 				 					 				
							if(in_array($row,$weekdays)){					   
							   $count++;
							}					
					}
				}
                
                //----create charge-------------//
                $charge_month = 0;
                if($months){
                    $charge_month = ($months * $spc['pmonth']);
                }
                
                $charge_week = 0;
                if($weeks){
                    $charge_week = ($weeks * $spc['pweek']);
                }
                
                $charge_day = 0;
                if($pdays){
                    $charge_day = ($pdays * $spc['pday']);
                    if($pdays > 5){
                        $charge_day = (1 * $spc['pweek']);
                    }
                }
                
                $charge_hour = 0;
                if($hours){
                    $charge_hour = ($hours * $spc['phour']);
                    if($hours > 6){
                        $charge_hour = (1 * $spc['pday']);
                    }
                }
                
                $charge = $charge_month + $charge_week + $charge_day + $charge_hour ;
                $charge = $charge + ($charge * ($commission / 100));
                $spc['charge'] = $charge;
                //-----------end charge ---------//
                
    			//echo $count; die;
				$dayss = []; $daysss = [];
				$totalspace = $spc['noofspace'];
				//if($spc['availability']){
					$avail = explode(';',$spc['availability']);
					//print_r($avail); die;
					$flag = 0;$flag1 = 0;
					foreach($avail as $avl){
						//print_r($avl); die;
						if($avl){
							$av = explode(',',$avl);							
							if($av[3] == 1){							
								
								if(($date_from < strtotime($av[0])) &&  ($date_to > strtotime($av[0]))){									
									$flag += 1;
									if( ($spc['noofspace'] - $av[2]) == 0){
										$totalspace = 0;
									}	
								}
								if(($date_from > strtotime($av[0])) &&  ($date_to < strtotime($av[1]))){									
									$flag += 1;
									if( ($spc['noofspace'] - $av[2]) == 0){
										$totalspace = 0;
									}
								}
								if(($date_from > strtotime($av[0])) && ($date_from < strtotime($av[1])) &&  ($date_to > strtotime($av[1]))){									
									$flag += 1;
									if( ($spc['noofspace'] - $av[2]) == 0){
										$totalspace = 0;
									}
								}
								if($date_to < strtotime($av[0])){									
									$flag += 0;
								}
								if($date_from > strtotime($av[1])){									
									$flag += 0;
								}
								
															
								
							}
							if($av[3] == 2){															
								if(($date_from > strtotime($av[0])) &&  ($date_to < strtotime($av[1]))){									
									$flag1 += 1;
									$totalspace = $av[2];
								}
								
							}
							
						}					
					}
					//echo $flag;
					//echo $totalspace; die;
					if($flag == 0 || $totalspace > 0){								
						if($count == count($days) || $flag1 >= 1){								
							$total_booking = 0;							
								$res = $this->Common_Model->getdata("booking",$where=array("spaceid"=>$spc['id'],"booking_from <="=>$date_from,"booking_to >="=>$date_from,"status"=>1),$sort='');
								$res1 = $this->Common_Model->getdata("booking",$where=array("spaceid"=>$spc['id'],"booking_from <="=>$date_to,"booking_to >="=>$date_to,"status"=>1),$sort='');
								
								$total_booking = count($res);
								$total_booking1 = count($res1);
								
								$total = ($total_booking > $total_booking1) ? $total_booking : $total_booking1;
								//echo $spc['id']; die;							
							//echo $totalspace;
							if(($totalspace - $total) > 0){
								
								$available_space[] = $spc;
                                $available_space_ids[] = $spc['id'];
							}
						}
					}
							
				//}				
				
			}
		}
        $unavailable = [];
        foreach($spaces as $kk=>$s){            
            if(!in_array($s['id'],$available_space_ids)){
                $unavailable[] = $s;
            }
        }
        
        foreach($unavailable as $keyyy => $unspc){								                
                //----create charge-------------//
                $charge_month1 = 0;
                if($months){
                    $charge_month1 = ($months * $unspc['pmonth']);
                }
                
                $charge_week1 = 0;
                if($weeks){
                    $charge_week1 = ($weeks * $unspc['pweek']);
                }
                
                $charge_day1 = 0;
                if($pdays){
                    $charge_day1 = ($pdays * $unspc['pday']);
                    if($pdays > 5){
                        $charge_day1 = (1 * $unspc['pweek']);
                    }
                }
                
                $charge_hour1 = 0;
                //echo $hours;
                if($hours){
                    $charge_hour1 = ($hours * $unspc['phour']);
                    if($hours > 6){
                        $charge_hour1 = (1 * $unspc['pday']);
                    }
                }
                
                $charge1 = $charge_month1 + $charge_week1 + $charge_day1 + $charge_hour1 ;
                $charge1 = $charge1 + ($charge1 * ($commission / 100));
                $unavailable[$keyyy]['charge'] = $charge1;
        }
		//echo "<pre>"; print_r($unavailable); die;
        $datas['unavailable_space'] = $unavailable;
		$datas['spaces'] = $available_space;
		$datas['lat'] = $latitude;
		$datas['long'] = $longitude;
		
		//echo "<pre>"; print_r($datas); die;
		$this->frontheader();
		//$this->startdashboard();	
		$this->load->view("Search",$datas);
		//$this->enddashboard();	
		$this->frontfooter(); 
	}
	
	public function detail($id,$pickup=Null,$dropoff=Null){
		$id = base64_decode($id);
		if($pickup){
			$pickup = base64_decode($pickup);
			$datas['pickup'] = $pickup;
		}
		if($dropoff){
			$dropoff = base64_decode($dropoff);
			$datas['dropoff'] = $dropoff;
		}
		
		$space = $this->Common_Model->getdata("rentourspace",$where=array("id"=>$id),$sort='');
		$space = $space[0];
                
        //calculate charge
        $date1 = new DateTime($pickup);
        $date2 = $date1->diff(new DateTime($dropoff));
              
        $months = $date2->m;
        $days = $date2->d;
        $weeks = floor($days/7);
        $days = $days - ($weeks * 7);
        $hours = $date2->h;
        
        $charge_month = 0;
        if($months){
            $charge_month = ($months * $space->pmonth);
        }
        
        $charge_week = 0;
        if($weeks){
            $charge_week = ($weeks * $space->pweek);
        }
        
        $charge_day = 0;
        if($days){
            $charge_day = ($days * $space->pday);
            if($days > 5){
                $charge_day = (1 * $space->pweek);
            }
        }
        
        $charge_hour = 0;
        if($hours){
            $charge_hour = ($hours * $space->phour);
            if($hours > 6){
                $charge_hour = (1 * $space->pday);
            }
        }
        $commission = getCommission(); 
        $charge = $charge_month + $charge_week + $charge_day + $charge_hour ;        
		$space->charge = $charge + ($charge * ($commission / 100));
        
		$data = [];
		if(isset($space->week) && !empty($space->week)){
			$data['week'] = $space->week;			
		}
		
		
		$avail = explode(';',$space->availability);
		$dayss = []; $daysss = [];
		foreach($avail as $avl){
				if($avl){
					$av = explode(',',$avl);
					if($av[3] == 1){							
						// Loop from the start date to end date and output all dates inbetween							
						for ($j=strtotime($av[0]); $j<=strtotime($av[1]); $j+=86400) {  
							$dayss[] = date("d-m-y", $j);  
						}							
					}
					if($av[3] == 2){							
						// Loop from the start date to end date and output all dates inbetween							
						for ($j=strtotime($av[0]); $j<=strtotime($av[1]); $j+=86400) {  
							$daysss[] = date("d-m-y", $j);  
						}							
					}
					
					
				}					
			}				
		
		$datas['week'] = explode(',',$space->week);
		$datas['highlited'] = $daysss;
		$datas['unhighlited'] = $dayss;
		//print_r(explode(';',$data['highlited'])[0]); die;		
		//echo "<pre>"; print_r($datas); die;
		//echo "<pre>"; print_r($space); die;
		$datas['space'] = $space;
		$this->frontheader();		
		$this->load->view("Space_detail",$datas);		
		$this->frontfooter(); 
	}
	
	public function prebooking(){
		//echo "<pre>"; print_r($_POST); die;
		if(!$this->session->userdata('isLoggedInUser')){
			$this->session->set_userdata('prebooking',$_POST);
			redirect('Home/login');
		}
		
		if($this->session->userdata('prebooking'))
		{
			$_POST = $this->session->userdata('prebooking');
			$this->session->unset_userdata('prebooking');
		}
		
		$id = $this->input->post('spaceid');
		$datas['fdate'] = $this->input->post('fdate');
		$datas['ldate'] = $this->input->post('ldate');
		$space = $this->Common_Model->getdata("rentourspace",$where=array("id"=>$id),$sort='');
		$space = $space[0];
		
		$uid = $this->session->userdata('uid');
		$user = $this->Common_Model->getdata("user",$where=array("id"=>$uid),$sort='');
		$user = $user[0];
		
		$vehicle = $this->Common_Model->getdata("vehicle",$where=array("user_id"=>$uid),$sort='');
		
		if($space->uid == $user->id){
			$this->session->set_flashdata('resultmsg', 1);
			$this->session->set_flashdata('class', 'danger');
			$this->session->set_flashdata('messsage', "You cannot make booking to yourself parking!");            
			redirect('search/detail/'.base64_encode($id).'/'.base64_encode($this->input->post('fdate')).'/'.base64_encode($this->input->post('ldate')));
		}		
		$datas['space'] = $space;
		$datas['user'] = $user;
		$datas['vehicle'] = $vehicle;
		//echo "<pre>"; print_r($datas); die;
		$this->frontheader();		
		$this->load->view("Prebooking",$datas);		
		$this->frontfooter(); 
	}
	
	public function getLatLong($address){
		if(!empty($address)){
			//Formatted address
			$formattedAddr = str_replace(' ','+',$address);
			//Send request and receive json data by address
			$geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key=AIzaSyCCQzJ9DJLTRjrxLkRk6jaSrvcc5BfDtWM'); 
			$output = json_decode($geocodeFromAddr);
			//echo "<pre>"; print_r($output); die;
			//Get latitude and longitute from json data 
                        
//                        print_r($output); die;
			if(isset($output->results) && !empty($output->results)){
			$data['latitude']  = $output->results[0]->geometry->location->lat; 
			$data['longitude'] = $output->results[0]->geometry->location->lng;
			}
			//Return latitude and longitude of the given address
			if(!empty($data)){
				return $data;
			}else{
				return false;
			}
		}else{
			return false;   
		}
	}
	
	public function booking(){
		//echo "<pre>"; print_r($_POST); die;
		$id = $this->input->post('spaceid');
		$datas['fdate'] = $this->input->post('fdate');
		$datas['ldate'] = $this->input->post('ldate');
		$vehicle_id = $this->input->post('vehicle');				
		
		$space = $this->Common_Model->getdata("rentourspace",$where=array("id"=>$id),$sort='');
		$space = $space[0];
		
		$vehicle = $this->Common_Model->getdata("vehicle",$where=array("id"=>$vehicle_id),$sort='');
		$vehicle = $vehicle[0];
		
		$date_from = strtotime($datas['fdate']); // Convert date to a UNIX timestamp  		  		 		
		$date_to = strtotime($datas['ldate']); // Convert date to a UNIX timestamp  		  
		// Loop from the start date to end date and output all dates inbetween
		$charge = 0;
		for ($i=$date_from; $i<=$date_to; $i+=86400) {  
			//$charge += $space->pday;			
		}
        
        //calculate price
        $date1 = new DateTime($this->input->post('fdate'));
        $date2 = $date1->diff(new DateTime($this->input->post('ldate')));
              
        $months = $date2->m;
        $days = $date2->d;
        $weeks = floor($days/7);
        $days = $days - ($weeks * 7);
        $hours = $date2->h;
        
        $charge_month = 0;
        if($months){
            $charge_month = ($months * $space->pmonth);
        }
        
        $charge_week = 0;
        if($weeks){
            $charge_week = ($weeks * $space->pweek);
        }
        
        $charge_day = 0;
        if($days){
            $charge_day = ($days * $space->pday);
            if($days > 5){
                $charge_day = (1 * $space->pweek);
            }
        }
        
        $charge_hour = 0;
        if($hours){
            $charge_hour = ($hours * $space->phour);
            if($hours > 6){
                $charge_hour = (1 * $space->pday);
            }
        }
        $commission = getCommission();
        $charge = $charge_month + $charge_week + $charge_day + $charge_hour ;
        $charge = $charge + ($charge * ($commission / 100));
		//echo "<pre>"; print_r($space); die;
		$datas['space'] = $space;
		$datas['charge'] = $charge;
		$datas['vehicle'] = $vehicle;
		$this->frontheader();		
		$this->load->view("Booking",$datas);		
		$this->frontfooter(); 
	}
	
	public function isAvailable()
	{
		$id = $this->input->post('spaceid');
		$dropoff = $this->input->post('fdate');
		$pickup = $this->input->post('ldate');
				
		$date_from = strtotime($dropoff); // Convert date to a UNIX timestamp  
		  		 		
		$date_to = strtotime($pickup); // Convert date to a UNIX timestamp  
		  
		// Loop from the start date to end date and output all dates inbetween
		$days = []; $dates = [];
		for ($i=$date_from; $i<=$date_to; $i+=86400) {  
			$days[] = date("N", $i);
			$dates[] = date("d-m-y", $i);  
		}
		//print_r($days); die;		
		$spaces = $this->Common_Model->getdata("rentourspace",$where=array("id"=>$id),$sort='');
		
		//echo "<pre>"; print_r($spaces); die;
		$weekdays = [];
		$available_space = [];
		if(!empty($spaces)){
			foreach($spaces as $spc){
				$count = 0;
				$countt = 0;
				$counttt = 0;
				if($spc->week){
					$weekdays = explode(',',$spc->week);											
					foreach($days as $row){				 				 				 					 				
							if(in_array($row,$weekdays)){					   
							   $count++;
							}					
					}
				}
				//echo $count; die;
				$dayss = []; $daysss = [];
				$totalspace = $spc->noofspace;
				//if($spc->availability){
					$avail = explode(';',$spc->availability);
					//print_r($avail);
					$flag = 0;$flag1 = 0;
					foreach($avail as $avl){						
						if($avl){
							$av = explode(',',$avl);							
							if($av[3] == 1){							
								
								if(($date_from < strtotime($av[0])) &&  ($date_to > strtotime($av[0]))){									
									$flag += 1;
									if( ($spc->noofspace - $av[2]) == 0){
										$totalspace = 0;
									}
								}
								if(($date_from > strtotime($av[0])) &&  ($date_to < strtotime($av[1]))){									
									$flag += 1;
									if( ($spc->noofspace - $av[2]) == 0){
										$totalspace = 0;
									}
								}
								if(($date_from > strtotime($av[0])) && ($date_from < strtotime($av[1])) &&  ($date_to > strtotime($av[1]))){									
									$flag += 1;
									if( ($spc->noofspace - $av[2]) == 0){
										$totalspace = 0;
									}
								}
								if($date_to < strtotime($av[0])){									
									$flag += 0;
								}
								if($date_from > strtotime($av[1])){									
									$flag += 0;
								}
								
								//if( ($spc->noofspace - $av[2]) == 0){
								//	$totalspace = 0;
								//}								
								
							}
							if($av[3] == 2){															
								if(($date_from > strtotime($av[0])) &&  ($date_to < strtotime($av[1]))){									
									$flag1 += 1;
									$totalspace = $av[2];
								}
								
							}
							
						}					
					}
					//echo $flag; die;
					//echo $totalspace;
					if($flag == 0 || $totalspace > 0){								
						if($count == count($days) || $flag1 >= 1){								
							$total_booking = 0;							
								$res = $this->Common_Model->getdata("booking",$where=array("spaceid"=>$spc->id,"booking_from <="=>$date_from,"booking_to >="=>$date_from,"status"=>1),$sort='');
								$res1 = $this->Common_Model->getdata("booking",$where=array("spaceid"=>$spc->id,"booking_from <="=>$date_to,"booking_to >="=>$date_to,"status"=>1),$sort='');
								
								$total_booking = count($res);
								$total_booking1 = count($res1);
								
								$total = ($total_booking > $total_booking1) ? $total_booking : $total_booking1;
															
							//echo $totalspace;
							if(($totalspace - $total) > 0){
								$available_space[] = $spc;	
							}
						}
					}
							
				//}				
				
			}
		}
		
		if(count($available_space)){
			echo 1;
		}else{
			echo 0;
		}
		
	}
	
	//public function isAvailable()
	//{
	//	$id = $this->input->post('spaceid');
	//	$dropoff = $this->input->post('fdate');
	//	$pickup = $this->input->post('ldate');
	//			
	//	$date_from = strtotime($dropoff); // Convert date to a UNIX timestamp  
	//	  		 		
	//	$date_to = strtotime($pickup); // Convert date to a UNIX timestamp  
	//	  
	//	// Loop from the start date to end date and output all dates inbetween  
	//	for ($i=$date_from; $i<=$date_to; $i+=86400) {  
	//		$days[] = date("N", $i);
	//		$dates[] = date("d-m-y", $i);
	//	}
	//					
	//	$spaces = $this->Common_Model->getdata("rentourspace",$where=array("id"=>$id),$sort='');
	//	
	//	//echo "<pre>"; print_r($spaces); die;
	//	$weekdays = [];
	//	$available_space = [];
	//	if(!empty($spaces)){
	//		foreach($spaces as $spc){
	//			$count = 0;
	//			$countt = 0;
	//			$counttt = 0;
	//			if($spc->week){
	//				$weekdays = explode(',',$spc->week);											
	//				foreach($days as $row){				 				 				 					 				
	//						if(in_array($row,$weekdays)){					   
	//						   $count++;
	//						}					
	//				}
	//			}
	//			//print_r($days); 
	//			$dayss = []; $daysss = [];
	//			if($spc->availability){
	//				$avail = explode(';',$spc->availability);
	//				//print_r($avail);
	//				foreach($avail as $avl){
	//					if($avl){
	//						$av = explode(',',$avl);
	//						//echo "<pre>"; print_r($av); 
	//						if($av[3] == 1){								
	//							// Loop from the start date to end date and output all dates inbetween							
	//							for ($j=strtotime($av[0]); $j<=strtotime($av[1]); $j+=86400) {  
	//								$dayss[] = date("d-m-y", $j);  
	//							}							
	//						}
	//						if($av[3] == 2){							
	//							// Loop from the start date to end date and output all dates inbetween							
	//							for ($j=strtotime($av[0]); $j<=strtotime($av[1]); $j+=86400) {  
	//								$daysss[] = date("d-m-y", $j);  
	//							}							
	//						}
	//						
	//						
	//					}					
	//				}
	//				//print_r($dayss);
	//				foreach($dayss as $row){				 				 				 					 				
	//						if(in_array($row,$dates)){					   
	//						   $countt++;
	//						}					
	//				}
	//				foreach($daysss as $row){				 				 				 					 				
	//						if(in_array($row,$dates)){					   
	//						   $counttt++;
	//						}					
	//				}				
	//			}			
	//			//echo ($countt); die;
	//			if( ($count == count($days) && ($countt==0)) || ($counttt > 0 && (count($counttt) == count($days)) )  ){					
	//				$total_booking = 0;
	//				foreach($dates as $d){
	//					$res = $this->Common_Model->getdata("booking",$where=array("spaceid"=>$spc->id,"bookdate"=>$d,"status"=>1),$sort='');
	//					$total_booking += count($res);
	//				}
	//				if(($spc->noofspace - $total_booking) > 0){
	//					$available_space[] = $spc;	
	//				}					
	//			}
	//			
	//		}
	//	}
	//	
	//	if(count($available_space)){
	//		echo 1;
	//	}else{
	//		echo 0;
	//	}
	//	
	//}
}