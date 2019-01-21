<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php
		if(isset($front[0]->favicon))
		{
			?>
			<link rel="icon" href="<?php echo base_url(); ?>images/<?php echo $front[0]->favicon; ?>">
			<?php
		} ?>
        <title>
		<?php
        $wtitle="wtitle_".$this->session->userdata("site_lang");		
		if(isset($front[0]->$wtitle)) { echo $front[0]->$wtitle; } 
		?> 
		</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url(); ?>backend/css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url(); ?>backend/css/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="<?php echo base_url(); ?>backend/css/demo/nifty-demo-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/css/croppie.css">

    <!--=================================================-->

    <link href="<?php echo base_url(); ?>backend/css/style.css" rel="stylesheet">

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="<?php echo base_url(); ?>backend/plugins/pace/pace.min.css" rel="stylesheet">
  
    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?php echo base_url(); ?>backend/css/demo/nifty-demo.min.css" rel="stylesheet">
	
	    <!--Switchery [ OPTIONAL ]-->
    <link href="<?php echo base_url(); ?>backend/plugins/switchery/switchery.min.css" rel="stylesheet">


    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="<?php echo base_url(); ?>backend/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="<?php echo base_url(); ?>backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">


    <!--Chosen [ OPTIONAL ]-->
    <link href="<?php echo base_url(); ?>backend/plugins/chosen/chosen.min.css" rel="stylesheet">

    <!--DataTables [ OPTIONAL ]-->
   	

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="<?php echo base_url(); ?>backend/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!--DataTables [ OPTIONAL ]-->
    
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
	

	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>dist/css/lightbox.min.css" media="screen" />

	 <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url(); ?>backend/js/jquery.min.js"></script>
	
    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url(); ?>backend/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/js/croppie.js"></script>

    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url(); ?>backend/js/nifty.min.js"></script>
	<script type='text/javascript' src='<?php echo base_url(); ?>backend/plugins/jquery-validation/jquery.validate.js'></script>
    <script src="<?php echo base_url(); ?>backend/plugins/pace/pace.min.js"></script>
    
	    <!--Summernote [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>dist/ckeditor/ckeditor.js"></script>

	
	<link rel="stylesheet" href="<?php echo base_url(); ?>dist/js/daterangepicker.css">
	<style>
	tfoot {
    display: table-header-group !important;
    }
	.searchform{
		padding:25px;
	}
	</style>

</head>

<script>
	$(document).ready(function(){
        $( ".datepicker" ).datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
	});

/*$(".optional_outer").on("click", function(){
	$('#myModaltt').modal('show');
});*/

var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    			
	$( ".evtdatepicker" ).datepicker({
		format: 'yyyy-mm-dd',
		//endDate: today,
		startDate: today,
		autoclose: true		 
	});
	
	 $( ".birthdatepicker" ).datepicker({
		format: 'yyyy-mm-dd',
		minDate: new Date(1920, 01, 01),
        maxDate: new Date(<?php echo date("Y, m, d"); ?>),
		autoclose: true		 
	});
         });
		 
		  $(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
	}
	
	
  $('input[name="sessiondate"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
  });	

  $('input[name="sessiondate"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
   	

   
    $('.sessiondate').daterangepicker({
		 autoUpdateInput: false,
		locale: {
      format: 'YYYY/MM/DD'
    },
         // startDate: start,
        //endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);
   

    
});

		</script>

<body>
    