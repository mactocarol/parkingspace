    <nav id="mainnav-container">
                <div id="mainnav">
                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <!--Profile Widget-->
                                <!--================================-->
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap text-center">
                                        <div class="pad-btm">
										<?php if(isset($admin[0]->photo)) {  if($admin[0]->photo!="") {?>
                                            <img class="img-circle img-md" src="<?php echo base_url(); ?>images/<?php echo $admin[0]->photo; ?>" alt="Profile Picture">
                                        <?php } } ?>
										</div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                          
                                            <p class="mnp-name"><?php if(isset($admin[0]->name)) { echo $admin[0]->name; }  ?></p>
 
                                        </a>
                                    </div>
                                   
                                </div>

                                <ul id="mainnav-menu" class="list-group">
						
						            <!--Category name
						            <li class="list-header">Navigation</li>-->
						
						            <!--Menu list item-->
						            <li class="<?php if($this->uri->segment(2)=='dashboard') { echo "active-sub"; } ?>">
						                <a href="<?php echo base_url(); ?>Admin">
						                    <i class="demo-pli-home"></i>
						                    <span class="menu-title">Dashboard</span>
											
						                </a>
						            </li>
						
						            <!--<li class="list-divider"></li>

						            Category name
						            <li class="list-header">Management</li>-->
					
						            <!--Menu list item-->
									
									<li class="<?php if($this->uri->segment(1)=='Menusetting') { echo "active-sub active"; } ?>">
						                <a href="#">
						                    <i class="fa fa-wrench"></i>
						                    <span class="menu-title">Menu Setting</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <!-- <li class="<?php if($this->uri->segment(2)=='addbanner' || $this->uri->segment(2)=='editbanner' || $this->uri->segment(2)=='banner') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Menusetting/banner">Banner</a></li>
											-->
											<li class="<?php if($this->uri->segment(2)=='addfaq' || $this->uri->segment(2)=='editfaq' || $this->uri->segment(2)=='faq') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Menusetting/faq">Faq</a></li>										
                                            <li class="<?php if($this->uri->segment(2)=='addcontactus' || $this->uri->segment(2)=='editcontactus' || $this->uri->segment(2)=='contactus') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Menusetting/contactus">Contactus</a></li>										
                                            <li class="<?php if($this->uri->segment(2)=='addprivacy' || $this->uri->segment(2)=='editprivacy' || $this->uri->segment(2)=='privacy') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Menusetting/privacy">Privacy</a></li>										
                                           <!-- <li class="<?php if($this->uri->segment(2)=='addaboutus' || $this->uri->segment(2)=='editaboutus' || $this->uri->segment(2)=='aboutus') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Menusetting/aboutus">About us</a></li>-->										

										</ul>
						            </li>
									
									 <li class="<?php if($this->uri->segment(1)=='Setting') { echo "active-sub active"; } ?>">
						                <a href="#">
						                    <i class="fa fa-wrench"></i>
						                    <span class="menu-title">Setting</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li class="<?php if($this->uri->segment(2)=='viewfrontsetting' || $this->uri->segment(2)=='addfrontsetting' || $this->uri->segment(2)=='editfrontsetting' || $this->uri->segment(2)=='frontsetting') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Setting/frontsetting">Front Setting</a></li>
<li class="<?php if($this->uri->segment(2)=='HomeSetting') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Setting/HomeSetting">Home Setting</a></li>
 <li class="<?php if($this->uri->segment(2)=='addcommission' || $this->uri->segment(2)=='editcommission' || $this->uri->segment(2)=='commission') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Setting/commission">Commission</a></li>											
						               
										</ul>
						            </li>
									
									<!--<li class="<?php if($this->uri->segment(1)=='Manageuser') { echo "active-sub active"; } ?>">
						                <a href="#">
						                    <i class="fa fa-users"></i>
						                    <span class="menu-title">User</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu--
						                <ul class="collapse">
						                    <li class="<?php if($this->uri->segment(2)=='viewuser' || $this->uri->segment(2)=='adduser' || $this->uri->segment(2)=='edituser' || $this->uri->segment(2)=='user') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Manageuser/user">User List</a></li>										
						                </ul>
										
										<ul class="collapse">
						                    <li class="<?php if($this->uri->segment(2)=='addoccupation' || $this->uri->segment(2)=='editoccupation' || $this->uri->segment(2)=='occupation') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Manageuser/occupation">Occupation</a></li>										
						                </ul>
										
										<ul class="collapse">
						                    <li class="<?php if($this->uri->segment(2)=='addtimezone' || $this->uri->segment(2)=='edittimezone' || $this->uri->segment(2)=='timezone') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Manageuser/timezone">Timezone</a></li>										
						                </ul>
										
										<ul class="collapse">
						                    <li class="<?php if($this->uri->segment(2)=='addpaymentoption' || $this->uri->segment(2)=='editpaymentoption' || $this->uri->segment(2)=='paymentoption') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Manageuser/paymentoption">Payment option</a></li>										
						                </ul>
						            </li>-->
									
									
									<!--<li class="<?php if($this->uri->segment(1)=='Manageparkingowner') { echo "active-sub active"; } ?>">
						                <a href="#">
						                    <i class="fa fa-users"></i>
						                    <span class="menu-title">Parking Owner</span>
											<i class="arrow"></i>
						                </a>
						
						               
						                <ul class="collapse">
						                    <li class="<?php if($this->uri->segment(2)=='viewuser' || $this->uri->segment(2)=='adduser' || $this->uri->segment(2)=='edituser' || $this->uri->segment(2)=='user') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Manageparkingowner/user">Parking owner List</a></li>										
						                </ul>
						            </li>-->
									
									
									
								
									
									
									<!--<li class="<?php if($this->uri->segment(1)=='Package') { echo "active-sub active"; } ?>">
						                <a href="#">
						                    <i class="fa fa-gift"></i>
						                    <span class="menu-title">Package</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu--
						                <ul class="collapse">
						                  <li class="<?php if($this->uri->segment(2)=='addfeature' || $this->uri->segment(2)=='editfeature' || $this->uri->segment(2)=='feature') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Package/feature">Feature</a></li>										 
										  <li class="<?php if($this->uri->segment(2)=='addpackagelist' || $this->uri->segment(2)=='editpackagelist' || $this->uri->segment(2)=='packagelist') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Package/packagelist">Package list</a></li>										 
																				
						                </ul>
						            </li>-->
									
									
									<!--<li class="<?php if($this->uri->segment(1)=='Managecoupon') { echo "active-sub active"; } ?>">
						                <a href="#">
						                    <i class="fa fa-gift"></i>
						                    <span class="menu-title">Coupon</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu--
						                <ul class="collapse">
										 
										 <li class="<?php if($this->uri->segment(2)=='addcoupon' || $this->uri->segment(2)=='editcoupon' || $this->uri->segment(2)=='coupon') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Managecoupon/coupon">Coupon list</a></li>
						                 
																				
						                </ul>
						            </li>-->
									<li class="<?php if($this->uri->segment(2)=='Bookings') { echo "active-sub"; } ?>">
						                <a href="<?php echo base_url(); ?>Admin/Bookings">
						                    <i class="fa fa-money"></i>
						                    <span class="menu-title">Bookings</span>
											
						                </a>
						            </li>
                                    <li class="<?php if($this->uri->segment(2)=='Transactions') { echo "active-sub"; } ?>">
						                <a href="<?php echo base_url(); ?>Admin/Transactions">
						                    <i class="fa fa-money"></i>
						                    <span class="menu-title">Transactions</span>
											
						                </a>
						            </li>
									<li class="<?php if($this->uri->segment(1)=='Manageblog') { echo "active-sub active"; } ?>">
						                <a href="#">
						                    <i class="fa fa-comments"></i>
						                    <span class="menu-title">Blog</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
										 
										 <!--<li class="<?php if($this->uri->segment(2)=='addblogcategory' || $this->uri->segment(2)=='editblogcategory' || $this->uri->segment(2)=='blogcategory') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Manageblog/blogcategory">Blog Category list</a></li>-->
						                 
										 <li class="<?php if($this->uri->segment(2)=='addblog' || $this->uri->segment(2)=='editblog' || $this->uri->segment(2)=='viewblog' || $this->uri->segment(2)=='blog') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Manageblog/blog">   Blog list</a></li>										
						                </ul>
						            </li>
									
									<!--<li class="<?php if($this->uri->segment(1)=='Payment') { echo "active-sub active"; } ?>">
						                <a href="#">
						                    <i class="fa fa-money"></i>
						                    <span class="menu-title">Payment</span>
											<i class="arrow"></i>
						                </a>
						
						        
						                <ul class="collapse">
						                    
											
 <li class="<?php if($this->uri->segment(2)=='addmembershippayment' || $this->uri->segment(2)=='editmembershippayment' || $this->uri->segment(2)=='membershippayment') { echo "active-link"; } ?>"><a href="<?php echo base_url(); ?>Payment/membershippayment">Membership Payment</a></li>											
						                </ul>
						            </li>-->
						           
                                    <li class="<?php if($this->uri->segment(1)=='Newsletter') { echo "active-sub active"; } ?>">
						                <a href="<?php echo site_url('Admin/Newsletter');?>">
						                    <i class="fa fa-comments"></i>
						                    <span class="menu-title">Newsletter</span>											
						                </a>												                
						            </li>
                                    
                                    <li class="<?php if($this->uri->segment(1)=='Testimonial') { echo "active-sub active"; } ?>">
						                <a href="<?php echo site_url('Admin/Testimonial');?>">
						                    <i class="fa fa-comments"></i>
						                    <span class="menu-title">Testimonial</span>											
						                </a>												                
						            </li>
                                    
									
									<!--  Main -->
                                </ul>

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->
			</div>