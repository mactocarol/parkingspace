<section class="search_dtl list">
      <div class="container">
        <div class="row">
	    <div class="col-md-12">		
                        <div class="">
                            <p><?=$this->lang->line('Where_would_you_like_to_park');?>?</p>
                          </div>
                          
                          <div class="row">
                            <div class="park_frm">
                            <form method="GET" name="airport_form" id="airport_form" action="<?php echo site_url('search');?>">
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date'>
                                <input type="text" class="form-control" placeholder="<?=$this->lang->line('place');?>" name="place" id="autocomplete1" value="<?php echo isset($_GET['place']) ? $_GET['place'] : ''; ?>">
                                  <span class="input-group-addon">
                                      <i class="fa fa-plane" aria-hidden="true"></i>
                                  </span>
                              </div>
                             </div>
                            
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker01' >
                                <input type="text" class="form-control" placeholder="<?=$this->lang->line('pickup');?>" name="drop_off" autocomplete="off" value="<?php echo isset($_GET['drop_off']) ? $_GET['drop_off'] : '';?>">
                                  <span class="input-group-addon">
                                      <i class="fa fa-calendar" aria-hidden="true"></i>
                                  </span>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6">
                              <div class='input-group date' id='datetimepicker02'>
                                <input type="text" class="form-control" placeholder="<?=$this->lang->line('dropoff');?>" name="pickup" autocomplete="off" value="<?php echo isset($_GET['pickup']) ? $_GET['pickup'] : '';?>">
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
	    </div>
	    <div class="clearfix">&nbsp;</div>
          <div class="col-md-8">
            <div id="map" style="width:100%; height:500px;"></div>
            <!--<div class="srch_map">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.192543441934!2d76.93144331476617!3d11.024175992153703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba858c4cf44a299%3A0x53c903b9bd224e3!2sTibsolutions!5e0!3m2!1sen!2sin!4v1540204349337" width="100%" height="680" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>-->
          </div>
          <div class="col-md-4 col-sm-6">
          <div class="pp_parent">
            <div class="member_hover_wrpr">
                
                <?php if(!empty($spaces)) {
                        foreach($spaces as $k => $row) {
                            // if($k < 3) { ?>
                            <div class="member hover flip">
                            	<div class="member_inner" data-type="right">
                                  <div class="row">
                                    <div class="col-md-5">
                                      <?php
                                        $address=str_replace(" ", "+",$row['address'].$row['city']);
                                      ?>  
                                      <div class="member_img">
                                        <!--<img src="images/member.png" class="img-responsive">-->
                                        <iframe style="width:100%;" frameborder="0" id="cusmap" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed"></iframe>
                                      </div>
                                    </div>
                                    <div class="col-md-7 padding-left">
                                      <div class="member_info">
                                        <p>
                                           <a href="#" onclick="return false;"> <span class="way"><?php echo ($row['typeofspace']) ? $row['typeofspace'] : '';?></span> on <strong><?php echo ($row['address']) ? $row['address'] : '';?></strong></a>
                                        </p>
                                        
                                        <p><i class="fa fa-user" aria-hidden="true"></i> <span><?php echo ($row['fname']) ? $row['fname'] : '';?> <?php echo ($row['lname']) ? $row['lname'] : '';?></span></p>
                                        <div class="rtng_rev">
                                          <ul>
                                            <li>Reservable</li>
                                          </ul>
                                        <ul>
                                             <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                             <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                             <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                             <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                             <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                           </ul>
                                         </div>
                                         <div class="dist">
                                           <div class="row">
                                             <div class="col-md-6">
                                               <p><img src="<?php echo base_url('frontend');?>/images/pedestrian-walking.png"> <span><?php echo ($row['distance']) ? round($row['distance'],2).' kms' : '';?> </span></p>
                                             </div>
                                             <div class="col-md-6">
                                              <div class="how_much">
                                               <a href="#">$<?php echo ($row['charge']) ? $row['charge'] : '';?></a>
                                             </div>
                                             </div>
                                           </div>
                                         </div>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="pop_up_bx panel">
                                    <div class="cross_btn">
                                      <button><img src="images/cancel.png"></button>
                                    </div>
                                    <div class="pop_up_top">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="cir_icon">
                                          <span class="close-btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="del_pop_up text-right">
                                          <a href="<?php echo site_url('search/detail/'.base64_encode($row['id']).'/'.base64_encode($pickup).'/'.base64_encode($dropoff));?>" class=""><?=$this->lang->line('detail');?></a>
                                          
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="member_info">
                                      <div class="row">
                                        <div class="slide-popup">
                                        <div class="col-md-12">
                                          <p><span class="way"><?php echo ($row['typeofspace']) ? $row['typeofspace'] : '';?></span> on <strong><?php echo ($row['address']) ? $row['address'] : '';?></strong></p>
                                          <p><i class="fa fa-user" aria-hidden="true"></i> <span><?php echo ($row['fname']) ? $row['fname'] : '';?> <?php echo ($row['lname']) ? $row['lname'] : '';?></span></p>
                                          <div class="para">
                                          <p><?php echo ($row['description']) ? $row['description'] : '';?></p>
                                          <p>No of space - <?php echo ($row['noofspace']) ? $row['noofspace'] : '';?></p>
                                        </div>
                                          <div class="rtng_rev">
                                            <ul>
                                              <li>Reservable</li>
                                            </ul>
                                          <ul>
                                               <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                               <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                               <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                               <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                               <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                             </ul>
                                             <ul>
                                               <li><p><img src="<?php echo base_url('frontend');?>/images/pedestrian-walking.png"> <span><?php echo ($row['distance']) ? round($row['distance'],2).' kms' : '';?> </span></p></li>
                                             </ul>
                                           </div>
                                           <div class="dist">
                                             <div class="row">
                                               <div class="col-md-12">
                                                <div class="how_much wdth">
                                                 <a href="<?php echo site_url('search/detail/'.base64_encode($row['id']).'/'.base64_encode($pickup).'/'.base64_encode($dropoff));?>">$<?php echo ($row['charge']) ? $row['charge'] : '';?></a>
                                               </div>
                                               </div>
                                             </div>
                                           </div>
                                           <div class="gallery">
                                             <h5><?=$this->lang->line('gallery');?></h5>
                                             <?php $photos = getSpacePhoto($row['id']);
                                             
                                             if(!empty($photos)){ ?>
                                                <img src="<?php echo base_url(); ?>upload/space/<?php echo $photos[0]->photo; ?>" class="img-responsive">
                                             <?php }
                                             ?>
                                             
                                           </div>
                                        </div>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                            </div><!--end of member-sec-->
				<?php  } } ?>
                <?php if(!empty($unavailable_space)) {
                        foreach($unavailable_space as $k => $row) {
                            // if($k < 3) { ?>
                            <div class="member hover flip">
                            	<div class="member_inner" data-type="right">
                                  <div class="row">
                                    <div class="col-md-5">
                                      <?php
                                        $address=str_replace(" ", "+",$row['address'].$row['city']);
                                      ?>  
                                      <div class="member_img">
                                        <!--<img src="images/member.png" class="img-responsive">-->
                                        <iframe style="width:100%;" frameborder="0" id="cusmap" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed"></iframe>
                                      </div>
                                    </div>
                                    <div class="col-md-7 padding-left">
                                      <div class="member_info">
                                        <p>
                                           <a href="#" onclick="return false;"> <span class="way"><?php echo ($row['typeofspace']) ? $row['typeofspace'] : '';?></span> on <strong><?php echo ($row['address']) ? $row['address'] : '';?></strong></a>
                                        </p>
                                        
                                        <p><i class="fa fa-user" aria-hidden="true"></i> <span><?php echo ($row['fname']) ? $row['fname'] : '';?> <?php echo ($row['lname']) ? $row['lname'] : '';?></span></p>
                                        <div class="rtng_rev">
                                          <ul>
                                            <li>UnAvailable</li>
                                          </ul>
                                        <ul>
                                             <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                             <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                             <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                             <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                             <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                           </ul>
                                         </div>
                                         <div class="dist">
                                           <div class="row">
                                             <div class="col-md-6">
                                               <p><img src="<?php echo base_url('frontend');?>/images/pedestrian-walking.png"> <span><?php echo ($row['distance']) ? round($row['distance'],2).' kms' : '';?> </span></p>
                                             </div>
                                             <div class="col-md-6">
                                              <div class="how_much">
                                               <a href="#">$<?php echo ($row['charge']) ? $row['charge'] : '';?></a>
                                             </div>
                                             </div>
                                           </div>
                                         </div>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="pop_up_bx panel">
                                    <div class="cross_btn">
                                      <button><img src="images/cancel.png"></button>
                                    </div>
                                    <div class="pop_up_top">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="cir_icon">
                                          <span class="close-btn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="del_pop_up text-right">
                                          <a href="<?php echo site_url('search/detail/'.base64_encode($row['id']).'/'.base64_encode($pickup).'/'.base64_encode($dropoff));?>" class=""><?=$this->lang->line('detail');?></a>
                                          
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="member_info">
                                      <div class="row">
                                        <div class="slide-popup">
                                        <div class="col-md-12">
                                          <p><span class="way"><?php echo ($row['typeofspace']) ? $row['typeofspace'] : '';?></span> on <strong><?php echo ($row['address']) ? $row['address'] : '';?></strong></p>
                                          <p><i class="fa fa-user" aria-hidden="true"></i> <span><?php echo ($row['fname']) ? $row['fname'] : '';?> <?php echo ($row['lname']) ? $row['lname'] : '';?></span></p>
                                          <div class="para">
                                          <p><?php echo ($row['description']) ? $row['description'] : '';?></p>
                                          <p>No of space - <?php echo ($row['noofspace']) ? $row['noofspace'] : '';?></p>
                                        </div>
                                          <div class="rtng_rev">
                                            <ul>
                                              <li>UnAvailable</li>
                                            </ul>
                                          <ul>
                                               <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                               <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                               <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                               <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                               <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                             </ul>
                                             <ul>
                                               <li><p><img src="<?php echo base_url('frontend');?>/images/pedestrian-walking.png"> <span><?php echo ($row['distance']) ? round($row['distance'],2).' kms' : '';?> </span></p></li>
                                             </ul>
                                           </div>
                                           <div class="dist">
                                             <div class="row">
                                               <div class="col-md-12">
                                                <div class="how_much wdth">
                                                 <a href="<?php echo site_url('search/detail/'.base64_encode($row['id']).'/'.base64_encode($pickup).'/'.base64_encode($dropoff));?>">$<?php echo ($row['charge']) ? $row['charge'] : '';?></a>
                                               </div>
                                               </div>
                                             </div>
                                           </div>
                                           <div class="gallery">
                                             <h5><?=$this->lang->line('gallery');?></h5>
                                             <?php $photos = getSpacePhoto($row['id']);
                                             
                                             if(!empty($photos)){ ?>
                                                <img src="<?php echo base_url(); ?>upload/space/<?php echo $photos[0]->photo; ?>" class="img-responsive">
                                             <?php }
                                             ?>
                                             
                                           </div>
                                        </div>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                            </div><!--end of member-sec-->
				<?php  } } ?>
                <?php if(empty($spaces) && empty($unavailable_space)) { ?>
                <div class="member hover flip">
                  <div class="row">
                    <div class="col-md-12">
                        <h5><?=$this->lang->line('no_space');?>!</h5>
                    </div>
                  </div>
                </div><!--end of member-sec-->
                <?php } ?>
             
            
          </div> 
            
          </div><!--End of col-md-4 -->
        </div>
        </div>
      </div>
    </section>
    <?php if(!empty($spaces)) {
                        $str = '';
                        foreach($spaces as $k => $row) { 
                            if($k < 3){						
                            $str .=  '["'.$row['typeofspace'].' on '.$row['address'].'<br> price - $'.$row['charge'].'/day ","'.$row['lat'].'","'.$row['lng'].'",'.$row['id'].'],';
							}
                        }
                        
    }else{
        $str = '["","","",""],';
    }
    ?>
    <?php if(!empty($unavailable_space)) {
                        $str1 = '';
                        foreach($unavailable_space as $k => $row) { 
                            if($k < 3){						
                            $str1 .=  '["'.$row['typeofspace'].' on '.$row['address'].'<br> price - $'.$row['charge'].'/day ","'.$row['lat'].'","'.$row['lng'].'",'.$row['id'].'],';
							}
                        }
                        
    }else{
        $str1 = '["","","",""],';
    }
    ?>
       <script> 
$(document).ready(function(){
$('.pop_up_bx').hide()
$('.member_inner').click(function () {
	$('.pop_up_bx').hide();
    $(this).next('.pop_up_bx').animate({left: '-100%'}).show();
});
$('.close-btn').click(function () {
     $(this).closest('.pop_up_bx').animate({left: '0'}).fadeOut(100);
});



});
</script>
<script type="text/javascript">
function initialize() {
    var latlng = new google.maps.LatLng(<?php  echo $lat; ?>,<?php  echo $long; ?>);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 10,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
	
	var locations = <?='['.$str.']'?>;
    console.log(locations);

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    var iconBase = '<?php echo base_url();?>/images/map.png';	
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
	  icon : iconBase
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        };
      })(marker, i));
    }
    
    var locations1 = <?='['.$str1.']'?>;
    console.log(locations1);

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    var iconBase = '<?php echo base_url();?>/images/map-grey.png';	
    for (i = 0; i < locations1.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations1[i][1], locations1[i][2]),
        map: map,
	  icon : iconBase
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations1[i][0]);
          infowindow.open(map, marker);
        };
      })(marker, i));
    }
	  
}
google.maps.event.addDomListener(window, 'load', initialize);
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
	  
	<script>
            var input = document.getElementById('autocomplete1');
            var autocomplete = new google.maps.places.Autocomplete(input);
        </script>  