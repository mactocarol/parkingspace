<section class="contact_us_bg">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="breedcrumb text-center">
                     <ul>
                        <li><a href="#">Pewnyparking</a></li>
                        <li><a href="#">Dashboard</a></li>
                     </ul>
                     <h2>Dashboard</h2>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="clearfix"></div>
      <section class="info dash">
         <div class="container">
            <div class="bx_shdo">
               <div class="row">
                  <div class="col-md-4 col-sm-6">
                           <div class="nav-side-menu">
    <div class="brand">
      <div class="center_img">
	  
	  
	  <?php
if(isset($user[0]->photo))
{
if($user[0]->photo!="")
{
?>
 <a title="Click here to edit profile"  href="<?php echo base_url(); ?>editprofile"><img class="img-circle" src="<?php echo base_url(); ?>upload/user/<?php echo $user[0]->photo; ?>" class="img-responsive"></a>
<?php 
}
else{
	?>
	<a title="click here to edit profile" href="<?php echo base_url(); ?>editprofile"><img class="img-circle" src="<?php echo base_url(); ?>frontend/images/doe.png" class="img-responsive"></a>
	<?php
}
}
?>

      </div>
      <div class="side-nav-txt">
      <h3><?php if(isset($user[0]->name)) { echo $user[0]->name; } ?></h3>
      <p><?php if(isset($user[0]->email)) { echo $user[0]->email; } ?></p>
    </div>
    </div>
<ul class="accordion-menu">
  <li>
    <div class="dropdownlink"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></div>
  </li>
  <li>
      <div class="dropdownlink"><a href="<?php echo site_url('Dashboard/BookingReceived'); ?>">Bookings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo ($allnewNotification) ?('<span class="badge">'.$allnewNotification.' </span>'):(''); ?></a>
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="<?php echo site_url('Dashboard/BookingMade'); ?>">Bookings Made </a></li>
      <li><a href="<?php echo site_url('Dashboard/BookingReceived'); ?>">Bookings Received</a></li> 
      <!--<li><a href="<?php // echo site_url('Dashboard/viewNotifications'); ?>">Notification</a></li>--> 
    </ul>  
  </li>
  <li>  
      <div class="dropdownlink"><a href="<?php echo site_url('Messages');?>">Messages &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo ($allnewmsg) ?('<span class="badge">'.$allnewmsg.' </span>'):(''); ?></a> 
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="<?php echo site_url('Messages'); ?>">Message</a></li>
    </ul>
  </li>
  <li>
    <div class="dropdownlink">Invite friends New</div>
  </li>
  <li>
    <div class="dropdownlink">Parking Spaces
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="<?php echo base_url(); ?>Dashboard/rentourspace">Add a Space</a></li>
      <li><a href="<?php echo base_url(); ?>Dashboard/myspace">My Space</a></li>
    </ul>
  </li>
  <li>
    <div class="dropdownlink">Profile
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="<?php echo base_url(); ?>editprofile">Profile Settings</a></li>
      <li><a href="<?php echo base_url(); ?>Dashboard/sms_settings">SMS Settings</a></li>
      <li><a href="<?php echo base_url(); ?>Dashboard/data_preferences">Data Preferences</a></li>
      <li><a href="<?php echo base_url(); ?>Dashboard/feedback">Read and Reply to Feedback</a></li>
      <li><a href="<?php echo base_url(); ?>Dashboard/vehicle">Vehicles</a></li>
    </ul>
  </li>
  <li>
    <div class="dropdownlink">Billing
      <i class="fa fa-chevron-down" aria-hidden="true"></i>
    </div>
    <ul class="submenuItems">
      <li><a href="<?php echo site_url('Dashboard/Transactions'); ?>">Transactions</a></li>
      <li><a href="<?php echo base_url(); ?>Dashboard/creditcard"">Payment Sources</a></li>
      <li><a href="<?php echo site_url('Dashboard/withdraw'); ?>">Withdrawal Methods</a></li>
    </ul>
  </li>
</ul>


</div><!--end of dashboard profile  -->
  <div class="pro_Cmplte">
    <div class="park_panel">
  <div class="panel_heading">
    <h4>Profile Completeness<span class="que"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span></h4>
    </div>
    <div class="Dta_table">
      <div class="progress">
          <div class="progress-bar progress-bar-danger" style="width: 45%;">
              <div class="progress-value">45%</div>
          </div>
      </div>
      <div class="dash_sbt sec">
        <a href="<?php echo base_url(); ?>editprofile" class="btn btn-primary">Update Your Profile</a>
      </div>
    </div>
       
</div>
  </div><!--End of Profile -->

  <div class="pro_Cmplte">
    <div class="park_panel">
  <div class="panel_heading">
    <h4>Trust Centre<span class="que"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span></h4>
    </div>
<?php
$email_icon="unchecked";
$email_img="error.png";
if(isset($user[0]->email_status))
{
	if($user[0]->email_status==1)
	{
		$email_icon="checked";
		$email_img="check.png";
	}
}

$photo_icon="unchecked";
$photo_img="error.png";
if(isset($user[0]->photo))
{
	if($user[0]->photo!=1)
	{
		$photo_icon="checked";
		$photo_img="check.png";
	}
}

$fb_icon="unchecked";
$fb_img="error.png";
if(isset($user[0]->fb))
{
	if($user[0]->fb==1)
	{
		$fb_icon="checked";
		$fb_img="check.png";
	}
}

$cno_icon="unchecked";
$cno_img="error.png";
if(isset($user[0]->contact_status))
{
	if($user[0]->contact_status==1)
	{
		$cno_icon="checked";
		$cno_img="check.png";
	}
}
?>	
	
	
    <div class="trst_wrapper">
      <div class="trst_bdr">
      <div class="trst">
        <div class="trst_icn">
          <img src="<?php echo base_url(); ?>frontend/images/<?php echo $email_img; ?>">
        </div>
        <div class="trst_icn_txt <?php echo $email_icon; ?>"><p>Email Address</p></div>
      </div>
      <div class="bdr_btm"></div>
    </div>
    <div class="trst_bdr">
      <div class="trst">
        <div class="trst_icn">
          <img src="<?php echo base_url(); ?>frontend/images/<?php echo $fb_img; ?>">
        </div>
        <div class="trst_icn_txt <?php echo $fb_icon; ?>"><p>Facebook Connected</p></div>
      </div>
      <div class="bdr_btm"></div>
    </div>
    <div class="trst_bdr">
      <div class="trst">
        <div class="trst_icn">
          <img src="<?php echo base_url(); ?>frontend/images/<?php echo $photo_img; ?>">
        </div>
        <div class="trst_icn_txt <?php echo $photo_icon; ?>"><p>Profile Photo</p></div>
      </div>
      <div class="bdr_btm"></div>
    </div>
    <div class="trst_bdr">
      <div class="trst">
        <div class="trst_icn">
          <img src="<?php echo base_url(); ?>frontend/images/<?php echo $cno_img; ?>">
        </div>
        <div class="trst_icn_txt <?php echo $cno_icon; ?>"><p>Phone Number</p></div>
      </div>
      <div class="bdr_btm"></div>
    </div>
    </div>
</div>
  </div>  
                  </div>