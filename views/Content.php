  <section class="top_bnr">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="bnr_cnt text-center">
              <h1 class=" wow zoomIn"> <?php echo  ($main_heading) ? $main_heading->value : ''; ?></h1>
              <p><?php echo  ($main_subheading) ? $main_subheading->value : ''; ?></p>
              <a href="#" class="find_out"><?php echo  ($main_button) ? $main_button->value : ''; ?></a>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="tab  wow animated fadeInUpBig" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <!--<li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Airport</a></li>-->
                    <!--<li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Port</a></li>
                    <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Station</a></li>
                    <li role="presentation"><a href="#Section4" aria-controls="messages" role="tab" data-toggle="tab">City</a></li>-->
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">                    
                        </head>
                        <body>                                                                      
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="frm_head">
                            <p><?=$this->lang->line('Where_would_you_like_to_park');?>?</p>
                          </div>
                          </div>
                        </div>
                          <div class="row">
                            <div class="park_frm">
                            <form method="GET" name="airport_form" id="airport_form" action="<?php echo site_url('search');?>">
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date'>
                                <input type="text" class="form-control" placeholder="<?=$this->lang->line('place');?>" name="place" id="autocomplete1">
                                  <span class="input-group-addon">
                                      <i class="fa fa-plane" aria-hidden="true"></i>
                                  </span>
                              </div>
                             </div>
                            
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker01' >
                                <input type="text" class="form-control" placeholder="<?=$this->lang->line('pickup');?>" name="drop_off" autocomplete="off" value="<?php echo isset($_REQUEST['drop_off']) ? $_REQUEST['drop_off'] : '';?>">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                  </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker02'>
                                <input type="text" class="form-control" placeholder="<?=$this->lang->line('dropoff');?>" name="pickup" autocomplete="off">
                                <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                              <div class="col-md-3 col-sm-6">
                              <div class="input-group">
                              <div class="input-group-btn">
                                  <button class="btn btn-default sh_park" type="submit"><?=$this->lang->line('Show_parking_spaces');?></button>
                                </div>
                              </div>
                            </div>
                            </form>
                            </div>
                          
                          </div>
                        </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section2">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="frm_head">
                            <p>Where would you like to park?</p>
                          </div>
                          </div>
                          <div class="row">
                            <div class="park_frm">
                            <form method="GET" name="port_form" id="port_form" action="<?php echo site_url('search');?>">
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date'>
                                <input type="text" class="form-control" placeholder="Port" name="place" id="autocomplete2">
                                <span class="input-group-addon">
                                      <i class="fa fa-plane" aria-hidden="true"></i>
                                  </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker01'>
                                <input type="text" class="form-control" placeholder="Vehicle Drop Off Date & Time" name="drop_off" autocomplete="off">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                  </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker02'>
                                <input type="text" class="form-control" placeholder="Vehicle Pick Up Date & Time" name="pickup" autocomplete="off">
                                <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                              <div class="col-md-3 col-sm-6">
                              <div class="input-group">
                              <div class="input-group-btn">
                                  <button class="btn btn-default sh_park" type="submit">Show parking spaces</button>
                                </div>
                              </div>
                            </div>
                            </form>
                            </div>
                          
                          </div>
                          </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section3">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="frm_head">
                            <p>Where would you like to park?</p>
                          </div>
                          </div>
                          <div class="row">
                            <div class="park_frm">
                            <form method="GET" name="station_form" id="station_form" action="<?php echo site_url('search');?>">
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date'>
                                <input type="text" class="form-control" placeholder="Station" name="place" id="autocomplete3">
                                <span class="input-group-addon">
                                     <i class="fa fa-subway"></i>
                                  </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker5'>
                                <input type="text" class="form-control" placeholder="Vehicle Drop Off Date & Time" name="drop_off">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                  </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker6'>
                                <input type="text" class="form-control" placeholder="Vehicle Pick Up Date & Time" name="pickup">
                                <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                              <div class="col-md-3 col-sm-6">
                              <div class="input-group">
                              <div class="input-group-btn">
                                  <button class="btn btn-default sh_park" type="submit">Show parking spaces</button>
                                </div>
                              </div>
                            </div>
                            </form>
                            </div>
                          
                          </div>
                          </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section4">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="frm_head">
                            <p>Where would you like to park?</p>
                          </div>
                          </div>
                          <div class="row">
                            <div class="park_frm">
                            <form method="GET" name="city_form" id="city_form" action="<?php echo site_url('search');?>">
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date'>
                                <input type="text" class="form-control" placeholder="City" name="place" id="autocomplete4">
                                <span class="input-group-addon">
                                      <i class="fa fa-home" aria-hidden="true"></i>
                                  </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker7'>
                                <input type="text" class="form-control" placeholder="Vehicle Drop Off Date & Time" name="drop_off">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                  </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker8'>
                                <input type="text" class="form-control" placeholder="Vehicle Pick Up Date & Time" name="pickup">
                                <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                              </div>
                            </div>
                              <div class="col-md-3 col-sm-6">
                              <div class="input-group">
                              <div class="input-group-btn">
                                  <button class="btn btn-default sh_park" type="submit">Show parking spaces</button>
                                </div>
                              </div>
                            </div>
                            </form>
                            </div>
                          
                          </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--End of tab panel row -->
     </div>
     <div class="Prk_blocks">
      <div class="container">
        <div class="row">
            
          <div class="col-md-3 col-sm-6">
            <div class="booking">
              <div class="book_icon">
                <img src="<?php echo base_url(); ?>frontend/images/icon2.png" class="img-responsive">
              </div>
              <div class="book_txt">
               <div class="book_text_inr">
                <h4><?=count($total_space);?></h4>
                 <p>Bookable parking spaces</p>
               </div>
              </div>

            </div>
          </div>          
          <div class="col-md-3 col-sm-6">
            <div class="booking">
              <div class="book_icon">
                <img src="<?php echo base_url(); ?>frontend/images/icon1.png" class="img-responsive">
              </div>
              <div class="book_txt">
               <div class="book_text_inr">
                <h4><?=count($total_users);?></h4>
                 <p>Registered & happy users</p>
               </div>
              </div>

            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="booking">
              <div class="book_icon">
                <img src="<?php echo base_url(); ?>frontend/images/icon3.png" class="img-responsive">
              </div>
              <div class="book_txt">
               <div class="book_text_inr">
                <h4></h4>
                 <p>Latest Booking from <strong><?=($latest_booking)?$latest_booking->address:''?></strong></p>
               </div>
              </div>

            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="booking">
              <div class="book_icon">
                <img src="<?php echo base_url(); ?>frontend/images/icon4.png" class="img-responsive">
              </div>
              <div class="book_txt">
               <div class="book_text_inr">
                <h4>30</h4>
                 <p>Year experience</p>
               </div>
              </div>

            </div>
          </div>
         </div>
         </div>
      </div>
    </section>

    <section class="feat_park">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="Feat_head text-center wow fadeInDown">
              <h6>FEATURED Parking</h6>
              <h2>Parking <span>made easy</span></h2>
            </div>
          </div>
        </div>
        <div class="feat_blk">
          <div class="row">
            <div class="col-md-4">
              <div class="box wow flipInY">
                <div class="bx_img">
                  <!--<img src="<?php echo base_url(); ?>frontend/images/bx1.jpg" class="img-responsive">-->
                  <img src="<?php echo  ($featured_image1) ? base_url().'images/'.$featured_image1->value : ''; ?>" class="img-responsive">
                </div>
                <div class="box_cnt text-center">
                  <div class="plus"><img src="<?php echo base_url(); ?>frontend/images/plus.png"></div>
                  <div class="plus1"><img src="<?php echo base_url(); ?>frontend/images/plus1.png"></div>
                  <h4><?php echo  ($featured_heading1) ? $featured_heading1->value : ''; ?></h4>
                  <p><?php echo  ($featured_content1) ? $featured_content1->value : ''; ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box wow flipInY">
                <div class="bx_img">
                  <!--<img src="<?php echo base_url(); ?>frontend/images/bx2.jpg" class="img-responsive">-->
                  <img src="<?php echo  ($featured_image2) ? base_url().'images/'.$featured_image2->value : ''; ?>" class="img-responsive">
                </div>
                <div class="box_cnt text-center">
                  <div class="plus"><img src="<?php echo base_url(); ?>frontend/images/plus.png"></div>
                  <div class="plus1"><img src="<?php echo base_url(); ?>frontend/images/plus1.png"></div>
                  <h4><?php echo  ($featured_heading2) ? $featured_heading2->value : ''; ?></h4>
                  <p><?php echo  ($featured_content2) ? $featured_content2->value : ''; ?></p>
                </a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box wow flipInY">
                <div class="bx_img">
                  <!--<img src="<?php echo base_url(); ?>frontend/images/bx3.jpg" class="img-responsive">-->
                  <img src="<?php echo  ($featured_image3) ? base_url().'images/'.$featured_image3->value : ''; ?>" class="img-responsive">
                </div>
                <div class="box_cnt text-center">
                  <div class="plus"><img src="<?php echo base_url(); ?>frontend/images/plus.png"></div>
                  <div class="plus1"><img src="<?php echo base_url(); ?>frontend/images/plus1.png"></div>
                  <h4><?php echo  ($featured_heading3) ? $featured_heading3->value : ''; ?></h4>
                  <p><?php echo  ($featured_content3) ? $featured_content3->value : ''; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div><!--end of feat block -->
        <div class="Sales_ser">
          <div class="row">
            <div class="col-md-5">
              <div class="sal_img wow slideInLeft">
                <img src="<?php echo base_url(); ?>frontend/images/service.jpg" class="img-responsive">
              </div>
            </div>
            <div class="col-md-7 wow slideInRight">
              <div class="ser_cnt">
                <h4>We are trusted name in car sales & services</h4>
                <h2>Used by million of people every month!</h2>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.</p>
              </div>
              <div class="facult_lnk">
                <div class="row">
                  <div class="col-md-6">
                    <div class="lnks">
                      <p>Best Prices</p>
                      <p>Test drive services</p>
                      <p>Car Droop facility</p>
                      <p>Special Finance facility</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="lnks">
                      <p>National coverage</p>
                      <p>No Booking Fee</p>
                      <p>Frequent Inspection</p>
                      <p>Well Maintained vehicles</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="Prof_Ser">
      <div class="container">
        <div class="outer">
        <div class="row">
          <div class="col-md-12">
            <div class="Prof_inr text-center wow animated fadeInUpBig" data-wow-delay="0.2s">
              <h1>We Provide Professional Service</h1>
              <h4>We are one of the leading Parking area companies.</h4>
            </div>
          </div>
        </div>
      </div>
        </div>
       <div class="car_img wow animated slideInRight" data-wow-delay="0.5s">
              <img src="<?php echo base_url(); ?>frontend/images/car-copyright.png" class="img-responsive">
            </div>
    </section>
    <section class="park_manage">
      <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="manage_bx wow slideInLeft" data-wow-delay="0.2s" >
            <div class="num">
              <h2>01</h2>
            </div>
            <div class="manage_cnt">
              <h5>Rent out your parking space</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6">
        <div class="manage_bx wow slideInRight" data-wow-delay="0.2s">
            <div class="num">
              <h2>02</h2>
            </div>
            <div class="manage_cnt">
              <h5>Car park management</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
          </div>
      </div>
    </div>
    </section>
    <section class="app">
      <div class="container">
        <div class="col-container">
          <div class="col">
            <div class="mob wow slideInLeft">
              <img src="<?php echo base_url(); ?>frontend/images/get_app.jpg" class="img-responsive">
            </div>
          </div>
          <div class="col">
            <div class="search_park_inner">
              <div class="search_park_side">
            <div class="search_park wow slideInRight">
              <h6>search penwyparking app</h6>
              <h1>Get a Mobile Application</h1>
            </div>
            <div class="searching_blocks wow slideInRight" data-wow-delay="0.1s">
              <div class="icon_search">
                <img src="<?php echo base_url(); ?>frontend/images/search_icon1.png" class="img-responsive">
              </div>
              <div class="icon_search_text">
                <h3>Easy searching</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
            <div class="searching_blocks wow slideInRight">
              <div class="icon_search">
                <img src="<?php echo base_url(); ?>frontend/images/search_icon2.png" class="img-responsive">
              </div>
              <div class="icon_search_text">
                <h3>Quick pickups</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
            <div class="searching_blocks wow slideInRight">
              <div class="icon_search">
                <img src="<?php echo base_url(); ?>frontend/images/search_icon3.png" class="img-responsive">
              </div>
              <div class="icon_search_text">
                <h3>Inclusive rates</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
            </div>
          </div>
          <div class="google_pay_icon">
            <a href="#">
              <div class="tb">
                <div class="tb_cell">
            <img src="<?php echo base_url(); ?>frontend/images/googleplay.png" class="img-responsive">
          </div>
          <div class="tb_cell1">
            <img src="<?php echo base_url(); ?>frontend/images/google-play1.png" class="img-responsive">
          </div>

          <div class="tb_cell2">
            <h6>Download from</h6>
            <h4>Google Play</h4>
          </div>
          </div>
            </a>
          </div>
          </div>
          </div>
        </div>
      </div>
    </section>
    <section class="testimonials">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="testi_head text-center wow fadeInDown">
              <h6>Our testimonials</h6>
              <h2>What our <span>customers say</span></h2>
            </div>
          </div>
        </div>
        <div class="testimonial_slide_outer">
          <div class="owl-carousel owl-theme wow fadeInDownBig">
         
         <?php if(!empty($testimonials)) {
            foreach($testimonials as $row){?>
         <div class="item">
          <div class="testimonials_inner_item text-center">
           <div class="Quote_icon">
             <i class="fa fa-quote-left" aria-hidden="true"></i>
           </div>
           <div class="Quote">
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
             tempor incididunt ut labore et dolore magna aliqua.</p>
             <div class="name">
               <h6><?=$row['name']?></h6>
               <p><?=$row['address']?></p>
             </div>
           </div>
           </div>
           <div class="testi_image">
             <!--<img src="<?php echo base_url(); ?>frontend/images/testi_1.jpg" class="img-responsive">-->
            <?php if ($row['image'] ==''){ ?>
            <a href="<?php echo base_url(); ?>images/default.png" data-lightbox="example-set">
            <img src="<?php echo base_url(); ?>images/default.png" class="img-thumbnail"   >
            </a>
            <?php } else { ?>
            <a href="<?php echo base_url(); ?>upload/blog/<?php echo $row['image']; ?>" data-lightbox="example-set">
                <img src="<?php echo base_url(); ?>upload/blog/<?php echo $row['image']; ?>" class="img-thumbnail" >
            </a>
            <?php } ?>
           </div>
         </div>
         <?php } } ?>
         
         <!--<div class="item">
          <div class="testimonials_inner_item text-center">
           <div class="Quote_icon">
             <i class="fa fa-quote-left" aria-hidden="true"></i>
           </div>
           <div class="Quote">
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
             tempor incididunt ut labore et dolore magna aliqua.</p>
             <div class="name">
               <h6>Jason Lee</h6>
               <p>New Yorks</p>
             </div>
           </div>
           
         </div>
         <div class="testi_image">
             <img src="<?php echo base_url(); ?>frontend/images/testi_1.jpg" class="img-responsive">
           </div>
         </div>
         <div class="item">
          <div class="testimonials_inner_item text-center">
           <div class="Quote_icon">
             <i class="fa fa-quote-left" aria-hidden="true"></i>
           </div>
           <div class="Quote">
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
             tempor incididunt ut labore et dolore magna aliqua.</p>
             <div class="name">
               <h6>Jason Lee</h6>
               <p>New York</p>
             </div>
           </div>
           
         </div>
         <div class="testi_image">
             <img src="<?php echo base_url(); ?>frontend/images/testi_1.jpg" class="img-responsive">
           </div>
         </div>
         <div class="item">
          <div class="testimonials_inner_item text-center">
           <div class="Quote_icon">
             <i class="fa fa-quote-left" aria-hidden="true"></i>
           </div>
           <div class="Quote">
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
             tempor incididunt ut labore et dolore magna aliqua.</p>
             <div class="name">
               <h6>Jason Lee</h6>
               <p>New York</p>
             </div>
           </div>
           
         </div>
         <div class="testi_image">
             <img src="<?php echo base_url(); ?>frontend/images/testi_1.jpg" class="img-responsive">
           </div>
       </div>
         <div class="item">
          <div class="testimonials_inner_item text-center">
           <div class="Quote_icon">
             <i class="fa fa-quote-left" aria-hidden="true"></i>
           </div>
           <div class="Quote">
             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
             tempor incididunt ut labore et dolore magna aliqua.</p>
             <div class="name">
               <h6>Jason Lee</h6>
               <p>New York</p>
             </div>
           </div>
           
         </div>
         <div class="testi_image">
             <img src="<?php echo base_url(); ?>frontend/images/testi_1.jpg" class="img-responsive">
           </div>
         </div>-->
       </div>
        </div>
      </div>
    </section>
	
	 <script type="text/javascript">
      $(document).ready(function(){
   $('.owl-carousel').owlCarousel({
    loop:true,
    margin:30,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
});
    </script>
    <script>
      new WOW().init();
    </script>
	<script type="text/javascript">
			
	$(function () {
		$('#datetimepicker01 input').datetimepicker({		  
		  minDate: new Date(),
	     });
	 });
	 </script>
	  <script type="text/javascript">
		
		$(function () {
		    $('#datetimepicker02 input').datetimepicker({
			  useCurrent: false
		    });
		    $("#datetimepicker01 input").on("dp.change", function (e) {
			  $('#datetimepicker02 input').data("DateTimePicker").minDate(e.date);
		 
		    });		
		  });
	</script>
	
	 <script type="text/javascript">
            $(function () {
                $('#datetimepicker3 input').datetimepicker();
                $('#datetimepicker3').datetimepicker();
            });
        </script>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker4 input').datetimepicker();
                $('#datetimepicker4').datetimepicker();
            });
        </script>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker5 input').datetimepicker();
                $('#datetimepicker5').datetimepicker();
            });
        </script>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker6 input').datetimepicker();
                $('#datetimepicker6').datetimepicker();
            });
        </script>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker7 input').datetimepicker();
                $('#datetimepicker7').datetimepicker();
            });
        </script>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker8 input').datetimepicker();
                $('#datetimepicker8').datetimepicker();
            });
        </script>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker9 input').datetimepicker();
                $('#datetimepicker9').datetimepicker();
            });
        </script>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker11 input').datetimepicker();
                $('#datetimepicker11').datetimepicker();
            });
        </script>
        
        <script>
            var input = document.getElementById('autocomplete1');
            var autocomplete = new google.maps.places.Autocomplete(input);
        </script>
        <script>
            var input = document.getElementById('autocomplete2');
            var autocomplete = new google.maps.places.Autocomplete(input);
        </script>
        <script>
            var input = document.getElementById('autocomplete3');
            var autocomplete = new google.maps.places.Autocomplete(input);
        </script>
        <script>
            var input = document.getElementById('autocomplete4');
            var autocomplete = new google.maps.places.Autocomplete(input);
        </script>
        
        <script>
            var jvalidate = $("#airport_form").validate({
                ignore: [],
                rules: {                                                                 
                    'place': {
                        required: true,                        
                    },
                    'drop_off': {
                        required: true,                        
                    },
                    'pickup': {
                        required: true,                        
                    },
        
                },
                messages: {
                    
                }					
            });  
        </script>
        <script>
            var jvalidate = $("#port_form").validate({
                ignore: [],
                rules: {                                                                 
                    'place': {
                        required: true,                        
                    },
                    'drop_off': {
                        required: true,                        
                    },
                    'pickup': {
                        required: true,                        
                    },
        
                },
                messages: {
                    
                }					
            });  
        </script>
        <script>
            var jvalidate = $("#station_form").validate({
                ignore: [],
                rules: {                                                                 
                    'place': {
                        required: true,                        
                    },
                    'drop_off': {
                        required: true,                        
                    },
                    'pickup': {
                        required: true,                        
                    },
        
                },
                messages: {
                    
                }					
            });  
        </script>
        <script>
            var jvalidate = $("#city_form").validate({
                ignore: [],
                rules: {                                                                 
                    'place': {
                        required: true,                        
                    },
                    'drop_off': {
                        required: true,                        
                    },
                    'pickup': {
                        required: true,                        
                    },
        
                },
                messages: {
                    
                }					
            });  
        </script>