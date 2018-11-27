<!DOCTYPE html>
<html>
<head>
        <?php
		if(isset($front[0]->favicon))
		{
        ?>
		<link rel="icon" href="<?php echo base_url(); ?>images/<?php echo $front[0]->favicon; ?>">
		<?php } ?>
        <title>
		<?php     
		$wtitle="wtitle_".$this->session->userdata("site_lang");
		if(isset($front[0]->$wtitle)) { echo $front[0]->$wtitle; }		
		?> 
		</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="<?php echo base_url(); ?>frontend/css/font-awesome.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>frontend/css/animate.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>frontend/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>frontend/css/bootsnav.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>frontend/css/style.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>frontend/css/owl.carousel.min.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>frontend/css/owl.theme.default.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>frontend/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>frontend/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>frontend/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>frontend/css/bootstrap-select.min.css">
  <link href="<?php echo base_url(); ?>frontend/css/master.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>frontend/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="<?php echo base_url(); ?>backend/css/croppie.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/css/lightbox.min.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/css/bootstrap-datepicker.css" media="screen" />

  
  <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/bootstrap.min.js"></script>

  <script type='text/javascript' src='<?php echo base_url(); ?>backend/plugins/jquery-validation/jquery.validate.js'></script>
<script src="<?php echo base_url(); ?>backend/js/croppie.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCCQzJ9DJLTRjrxLkRk6jaSrvcc5BfDtWM" type="text/javascript"></script>



	

	<style>
	.error{
		color:red;
	}
	.errors{
		color:red;
	}
	tfoot {
    display: table-header-group !important;
    }
	.ephoto{
	  width:200px;
      height:200px;	  
	}
	.back_btn{
		float:right;
		padding:6px;
	}
	</style>
  
</head>
<body>
      <nav class="navbar navbar-default navbar-fixed white no-background bootsnav">
        <div class="container">            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
		<?php
		if(isset($front[0]->ophoto))
		{
			$logotitle="title_".$this->session->userdata("site_lang");
			$logotitles="";
			if(isset($front[0]->$logotitle))
			{
				$logotitles=$front[0]->$logotitle;
			}
		?>		
				
				<img data-toggle="tooltip" title="<?php echo $logotitles; ?>" src="<?php echo base_url(); ?>images/<?php echo $front[0]->ophoto; ?>" class="logo" alt="">
		<?php } ?>
				</a>
                <!-- Start Atribute Navigation -->
        <div class="attr-nav">
            <ul>
			<?php
			if($this->session->userdata('uid'))			
			{
				?>
				 <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-home" aria-hidden="true"></i><p>Dashboard</p></a></li>
				  <li><a href="<?php echo base_url(); ?>Home/logout"><i class="fa fa-sign-out" aria-hidden="true"></i><p>Logout</p></a></li>
				  <?php
			}
			else {
		    ?>
                <li><a href="<?php echo base_url(); ?>Home/login"><i class="fa fa-lock" aria-hidden="true"></i><p>Login</p></a></li>
                <li><a href="<?php echo base_url(); ?>Home/login"><i class="fa fa-user-plus" aria-hidden="true"></i><p>Signup</p></a></li>
			<?php } ?>	
            </ul>
        </div>        
        <!-- End Atribute Navigation -->
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="active"><a href="#">About</a></li>
                    <li><a href="<?php echo base_url(); ?>Rentout">Rent out your driveway</a></li>
                    <li><a href="#">Car park management</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>   
    </nav>
    <div class="clearfix"></div>

	<?php 
	$stl="";
	if($this->uri->segment(1)=='' || $this->uri->segment(1)=='Home' && $this->uri->segment(2)=='' || $this->uri->segment(1)=='Home' && $this->uri->segment(2)=='index')
	{
		$stl="style='margin-top: 106px;'";
	}
	else { ?>
    <section class="topbg">
    </section>
	<?php } ?>
	
	 
			     <?php 
				 if($this->session->flashdata('result')) { 
			     ?>
				<div <?php echo $stl; ?> class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h4 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?></h4> 
                </div>
				 <?php } ?>