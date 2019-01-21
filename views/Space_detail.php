<section class="search_dtl">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="srch_map">
		   <?php
			$address=str_replace(" ", "+",$space->address.$space->city);
		    ?>
		   <!--<iframe style="width:100%;" height="450" frameborder="0" id="cusmap" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed"></iframe> -->
               <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.192543441934!2d76.93144331476617!3d11.024175992153703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba858c4cf44a299%3A0x53c903b9bd224e3!2sTibsolutions!5e0!3m2!1sen!2sin!4v1540204349337" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
		   <div id="map" style="width:100%; height:450px;"></div>
		   <div class="clearfix"><br></div>
		   <div id="pano" style="width:100%; height:250px;"></div>
               <div class="map_dtl">
                 <div class="row">
                   <div class="col-md-6">
                     <div class="map_desc">
                       <h4><?php echo ($space->typeofspace) ? $space->typeofspace : ''; ?> on <?php echo ($space->address) ? $space->address : ''; ?></h4>
                       <p><?php echo ($space->housename) ? $space->housename : ''; ?> <?php echo ($space->address) ? $space->address : ''; ?>, <?php echo ($space->city) ? $space->city : ''; ?>,<?php echo ($space->state) ? $space->state : ''; ?> <?php echo ($space->zipcode) ? $space->zipcode : ''; ?></p>
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="rtng text-right">
                       <p>Reservable</p>
                       <ul>
                         <li><i class="fa fa-star" aria-hidden="true"></i></li>
                         <li><i class="fa fa-star" aria-hidden="true"></i></li>
                         <li><i class="fa fa-star" aria-hidden="true"></i></li>
                         <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                         <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                       </ul>
                     </div>
                   </div>
                 </div>
               </div>
            </div>
            <div class="near_by">
		<?php if(!empty($space->nearby) && ($space->nearby != 'null')) { ?>	
            <div class="row">
              <div class="col-md-12">
                <div class="near_by_head">
                  <h4><?=$this->lang->line('near_by');?></h4>
                </div>
              </div>
            </div>
            <div class="near_by_tb">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><?=$this->lang->line('list_name');?></th>
                      <th><?=$this->lang->line('distance');?></th>
                    </tr>
                  </thead>
                  <tbody>
			
				<?php foreach(json_decode($space->nearby) as $key=>$val) {?>	
				<tr>
				  <td><?=$val?></td>
				  <td><?php echo (json_decode($space->nearbydistance)) ? json_decode($space->nearbydistance)[$key] : '';?> <?=$this->lang->line('kms_away');?></td>
				</tr>
				<?php }  ?>                    
                  </tbody>
                </table>
            </div>
		<?php } ?>
          </div>
          <div class="near_by_desc">
            <div class="row">
              <div class="col-md-12">
                <div class="near_by_head">
                  <h4><?=$this->lang->line('description');?></h4>
                </div>
              </div>
            </div>
            <div class="block">
          <div class="row">
            <div class="col-md-12">
           <div class="span4">
		<p><?php echo ($space->description) ? $space->description : ''; ?></p>
		<?php $photos = getSpacePhoto($space->id);
                                             
		if(!empty($photos)){
			foreach($photos as $photo) { ?>
			<img class="img-left" src="<?php echo base_url(); ?>upload/space/<?php echo $photo->photo; ?>" class="img-responsive">
		<?php } }
		?>
		<br><br>          
          
          </div>
         </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                <div class="near_by_head">
                  <h4><?=$this->lang->line('facilities');?></h4>
                </div>
                <div class="facility">
                <ul>
			<?php if($space->driveway_feature != '') {
				foreach(explode(',',$space->driveway_feature) as $row) {?>
					<li><span class="chk"><input type="checkbox" name="chk" checked></span><span><?=$row?></span></li>
			<?php } } else if($space->garage_feature != ''){ 
				foreach(explode(',',$space->garage_feature) as $row) {?>
					<li><span class="chk"><input type="checkbox" name="chk" checked></span><span><?=$row?></span></li>
			<?php } } else if($space->car_feature != ''){
				foreach(explode(',',$space->car_feature) as $row) {?>
					<li><span class="chk"><input type="checkbox" name="chk" checked></span><span><?=$row?></span></li>
			<?php } } ?> 
                  
                </ul>
              </div>
              </div>
            </div>
	   
			<?php if($space->driveway_feature != '') { ?>
				
					<div class="row">
						<div class="col-md-12">
							<div class="near_by_head">
								<h4><?=$this->lang->line('other');?></h4>
			       		      </div>
							<div class="facility">
								<p><?=$this->lang->line('Width_of_Space');?> - <?=$space->driveway_width?></p>
							</div>
						</div>
					</div>					
			<?php  } else if($space->garage_feature != ''){ 
				 } else if($space->car_feature != ''){ ?>
					<div class="row">
						<div class="col-md-12">
							<div class="near_by_head">
								<h4><?=$this->lang->line('other');?></h4>
			       		      </div>
							<div class="facility">
								<p><?=$this->lang->line('Height_Restriction');?> - <?=$space->car_height?> mtr.</p>
							</div>
						</div>
					</div>				
			<?php  } ?> 
                
          </div>
          </div>
          </div>
	    <?php 
        if($this->session->flashdata('resultmsg')) { 
        ?>
        <div  class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
                       <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                       <h6 class="errormsgs"> <?php echo $this->session->flashdata('messsage'); ?></h6> 
        </div>
        <?php } ?>
          <div class="col-md-4">
		<form method="post" name="book-form" id="book-form" action="<?php echo site_url('search/prebooking');?>">
            <div class="ttl_price">
              <div class="row">
              <div class="col-md-12">
                <div class="near_by_head">
                  <h4><?=$this->lang->line('Total_Price');?></h4>
			<input type="hidden" name="spaceid" value="<?=$space->id?>">
                </div>
              </div>
            </div>
		
            <div class="calender calender_srch">
             <div class="form-group">
                <div class='input-group date' id='datetimepicker01'>
                    <input type='text' class="form-control"  name="fdate" placeholder="<?=$this->lang->line('pickup');?>" autocomplete="off" value="<?php echo isset($pickup) ? $pickup : '';?>"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div>
          <div class="calender calender_srch">
             <div class="form-group">
                <div class='input-group date' id='datetimepicker02'>
                    <input type='text' class="form-control" name="ldate"  placeholder="<?=$this->lang->line('dropoff');?>" autocomplete="off" value="<?php echo isset($dropoff) ? $dropoff : '';?>"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div>
          <div class="total_fare">
            <h1><?=$this->lang->line('total');?> $<?php echo ($space->charge) ? $space->charge : ''; ?>  <?//=$this->lang->line('day');?></h1>
          </div>
          <div class="call_us">
              <button type="submit"><a><span><?=$this->lang->line('Book_This_Space');?></span></a></button>
            </div>
	    
            </div><!--end of ttl price -->
		</form>
		<?php
		$user = getUser($space->uid);                                             			
		?>
            <div class="member">
              <div class="row">
                <div class="col-md-5">
                  <div class="member_img">
			  <?php if($user->photo){ ?>	
                    <img src="<?php echo base_url('upload/user/'.$user->photo); ?>" class="img-responsive">
			  <?php } else { ?>
			  <img src="<?php echo base_url('frontend/images/doe.png'); ?>" class="img-responsive">
			  <?php } ?>
                  </div>
                </div>
                <div class="col-md-7 padding-left">
			
                  <div class="member_info">
                    <h6><?php echo ($space->fname) ? $space->fname : ''; ?> <?php echo ($space->lname) ? $space->lname : ''; ?></h6>
                    <p><?php echo ($space->driveway_owner) ? $space->driveway_owner : ''; ?></p>
                    <ul>
                         <li><i class="fa fa-star" aria-hidden="true"></i></li>
                         <li><i class="fa fa-star" aria-hidden="true"></i></li>
                         <li><i class="fa fa-star" aria-hidden="true"></i></li>
                         <li><i class="fa fa-star" aria-hidden="true"></i></li>
                         <li><i class="fa fa-star" aria-hidden="true"></i></li>
                       </ul>
                        <p><span><?php echo ($space->accessmethod) ? $space->accessmethod : ''; ?></span></p>
                        <p><i class="fa fa-envelope" aria-hidden="true"></i> <span><?=$user->email?></span></p>
                        <p><i class="fa fa-home" aria-hidden="true"></i> <span><?=$user->address?></span></p>
                  </div>
                </div>
              </div>
              <div class="call_us">
			
			<?php $chk = checkChatIdUser($this->session->userdata('uid'),$space->uid);
				if($chk){ $chatid = $chk->chat_id; }else{ $chatid = getChatId(); }
				
				?>
		<?php if($this->session->userdata('uid') != $space->uid) { ?>	
                <a href="<?php echo site_url('Messages/chat/'.$space->uid.'/'.$chatid); ?>"><span><?=$this->lang->line('ask_question');?> <?php echo ($space->fname) ? $space->fname : ''; ?></span></a>
		<?php }else{ ?>
			<a href="#"><span><?=$this->lang->line('ask_question');?> <?php echo ($space->fname) ? $space->fname : ''; ?></span></a>
		<?php } ?>
              </div>
              <h5><?=$this->lang->line('member_since');?> <?=date('d M Y',strtotime($user->created_dt))?></h5>
            </div>
            <div class="member">
            <!--<div id="my-calendar"></div>-->
		<?php $this->load->view('calendar_view'); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
<!--<script type="text/javascript">
            $(function () {
              $('#datetimepicker01 input').datetimepicker();
                $('#datetimepicker01').datetimepicker();
            });
        </script>
        <script type="text/javascript">
            $(function () {
              $('#datetimepicker02 input').datetimepicker();
                $('#datetimepicker02').datetimepicker();
            });
        </script>-->
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
function initialize() {
    var latlng = new google.maps.LatLng(<?php  echo $space->lat; ?>,<?php  echo $space->lng; ?>);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
	
	 var locations = [["<?=$space->typeofspace?>, <?=$space->address?>", "<?=$space->lat?>", "<?=$space->lng?>", 5]];
    console.log(locations);
    
    var panorama = new google.maps.StreetViewPanorama(
		document.getElementById('pano'), {
		  position: latlng,
		  pov: {
			heading: 34,
			pitch: 10
		  }
		});
	map.setStreetView(panorama);

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
	  
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script>
	var jvalidate = $("#book-form").validate({
		ignore: [],
		rules: {                                                                 
		'fdate': {
			required: true			
			},
            'ldate': {
			required: true				
			},							
		},
		messages: {
			
		}					
	});  
</script>


<div id="calendar1"></div>
<link rel="stylesheet" href="<?php echo base_url(); ?>frontend/calendar/css/calendar.css" media="screen">																										
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>frontend/calendar/js/jquery-ui-datepicker.min.js"></script>



<script type="text/javascript" language="javascript">
    var pausecontent = new Array();
    <?php if(isset($week) && !empty($week)) { foreach($week as $key => $val){ ?>
        pausecontent.push(<?php echo $val; ?>);
    <?php } } ?>
    console.log(pausecontent);
    
    var highlitedcontent = new Array();    
    <?php if(isset($highlited) && !empty($highlited)) { foreach($highlited as $key => $val){ ?>
        highlitedcontent.push('<?php echo $val; ?>');
    <?php } } ?>
    console.log('highlitedcontent '+highlitedcontent);
    
    var unhighlitedcontent = new Array();
    <?php if(isset($unhighlited) && !empty($unhighlited)) { foreach($unhighlited as $key => $val){ ?>
        unhighlitedcontent.push('<?php echo $val; ?>');
    <?php } } ?>
    console.log('unhighlitedcontent '+unhighlitedcontent);
</script>

<script>
    var highlight_dates = highlitedcontent;//['22-11-2018','11-1-2018','18-1-2018','28-1-2018'];
    var unhighlight_dates = unhighlitedcontent; //['21-11-2018','23-11-2018'];
    $('#calendar1').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        beforeShowDay: function(date) {
                
                        var month = ('0' + date.getMonth()+1).slice(-2);
                        var year = date.getFullYear();
                        var days = ('0' + date.getDate()).slice(-2);
                      
                        // Change format of date
                        var newdate = days+"-"+month+'-'+year;
                        console.log('newdate '+newdate);
                        var day = date.getDay();
                        //if (day == 2 || day == 3 || day == 4) {
                        if($.inArray(day, pausecontent) != -1) {
                            if($.inArray(newdate, unhighlight_dates) === -1){
                                return [true, "Highlighted", date];
                            }
                        }
                        if($.inArray(newdate, highlight_dates) != -1){
                                return [true, "Highlighted", date];
                        }
                        if($.inArray(newdate, unhighlight_dates) != -1){
                                return [true, "UnHighlighted", date];
                        }
                        
                        return [true, "UnHighlighted", date];
                }
    });
</script>