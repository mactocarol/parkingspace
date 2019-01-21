
 <div id="content-container">
  
                <div id="page-head">
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow"><?php echo $controlnamehead; ?></h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="#"><?php echo $control; ?></a></li>
					<li class="active"><?php echo $controlnamehead; ?></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">	
				
	
		<!-- Row selection and deletion (multiple rows) -->
					<!--===================================================---->
					<div class="panel">
					 <?php 
	    if($this->session->flashdata('result')) { 
		?>
		<div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h4 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?></h4> 
		</div>
		<?php } ?>
					    <div class="panel-heading">
						    <?php
							if(count($aboutus)==0)
							{
							?>
					        <a href="<?php echo base_url().$control.'/add'.$controlname; ?>" class="btn btn-info"><i class="fa fa-plus"></i> Add</a>
					        <?php } if(count($aboutus)>=1) { ?>
							<a href="<?php echo base_url().$control.'/edit'.$controlname.'/'.$aboutus[0]->id; ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="#"  class="btn btn btn-primary" data-toggle="modal" data-target=".myModal"   onClick="setID(<?php echo $aboutus[0]->id; ?>);"  title="Delete" class="btn btn btn-danger"><i  class="fa fa-trash-o"></i></a>
                            <?php } ?>
						</div>
					   
					    <div class="panel-body">
					

<?php
							if(isset($aboutus))
							{
								if(count($aboutus)==0)
								{
									echo "<h3 class='text-center'>No Data found</h3>";
								}
								else {
								foreach($aboutus as $a)
								{
								?>

<div class="about_panel">
	<div class="">
    	<div class="row">
        	<div class="col-lg-6 col-md-12 col-sm-12">
            	<div class="title-bar left-bg">
                	<h2 class="text-uppercase" data-aos="fade-up"
     data-aos-duration="3000"><?php echo $a->title; ?></span></h2>
                    <p class="text-capitalize" data-aos="fade-up"
     data-aos-duration="3000"><?php echo $a->subtitle; ?></p>
                </div>
                <p data-aos="fade-up" data-aos-duration="3000"><?php echo $a->description; ?></p>
                <div class="row">
                	<div class=" col-sm-6 col-xs-12 "data-aos="fade-right"
     data-aos-duration="3000">
                        <div class="w-single-services">
                            <div class="services-img">
                                <i class="<?php echo $a->ficon1; ?>"></i>
                            </div>
                            <div class="services-desc">
                                <h6 class="text-capitalize"><?php echo $a->ftitle1; ?></h6>
                                <p><?php echo $a->fdescription1; ?></p>
                            </div>
                        </div>
                    </div>
                	<div class="col-md-6 col-sm-6 col-xs-12 " data-aos="fade-left"
     data-aos-duration="3000">
                        <div class="w-single-services">
                            <div class="services-img">
                                <i class="<?php echo $a->ficon2; ?>"></i>
                            </div>
                            <div class="services-desc">
                                <h6 class="text-capitalize"><?php echo $a->ftitle2; ?></h6>
                                <p><?php echo $a->fdescription2; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 " data-aos="fade-right"
     data-aos-duration="3000">
                        <div class="w-single-services">
                            <div class="services-img">
                                <i class="<?php echo $a->ficon3; ?>"></i>
                            </div>
                            <div class="services-desc">
                                <h6 class="text-capitalize"><?php echo $a->ftitle3; ?></h6>
                                <p><?php echo $a->fdescription3; ?></p>
                            </div>
                        </div>
                    </div>
                	<div class="col-md-6 col-sm-6 col-xs-12 " data-aos="fade-left"
     data-aos-duration="3000">
                        <div class="w-single-services">
                            <div class="services-img">
                                <i class="<?php echo $a->ficon4; ?>"></i>
                            </div>
                            <div class="services-desc">
                                <h6 class="text-capitalize"><?php echo $a->ftitle4; ?></h6>
                                <p><?php echo $a->fdescription4; ?></p>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>
        	<div class="col-lg-6 col-md-12 col-sm-12">            	
            	<div class="img-animation-outer">
				<div class="img-animation-inner">
				<img style="width:100%" src="<?php echo base_url(); ?>upload/aboutus/<?php echo $a->photo; ?>" class="img-fluid" data-aos="zoom-in" data-aos-duration="3000">
				</div>
				</div>
            </div>

        </div>
    </div>
</div>

<div class="ads-service-outer" data-aos="fade-up"
     data-aos-duration="3000" style="padding: 30px">
	<div class="parallax-overlay"></div>
    <div class="parallax-content">
	<div class="">
    	<div class="row">
        	<div class="col-md-6 col-sm-6">
            	<h3 class="text-uppercase"data-aos="fade-up"
     data-aos-duration="3000"><?php echo $a->ctitle; ?></h3>
                <span class="sub-title" data-aos="fade-up"
     data-aos-duration="3000"><?php echo $a->cdescription; ?></span>
            </div>
            <div class="col-md-6 col-sm-6">
            	<div class="ads-phone pull-right">
                <i class="<?php echo $a->cicon; ?>"></i>
                
                <div class="iq-waves">
							<div class="waves wave-1"></div>
							<div class="waves wave-2"></div>
							<div class="waves wave-3"></div>
						</div>
                
                <div class="noo-ads-desc" data-aos="fade-up"
     data-aos-duration="3000">
                <?php echo $a->cnoheading; ?><br>
                <a href="tel:<?php echo $a->cno; ?>" data-aos="fade-up"
     data-aos-duration="3000"><?php echo $a->cno; ?></a>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="feature-outer text-center">
	<div class="">
    	<div class="row">
        	<div class="col-lg-3 col-md-6 col-sm-6">
            	<div class="feature-inner" data-aos="flip-left" data-aos-duration="3000">
                    <div class="feature-icon"><img src="<?php echo base_url(); ?>upload/aboutus/<?php echo $a->sicon1; ?>"></div>
                    <h3 class="text-uppercase"><?php echo $a->ftitle1; ?></h3>
                    <p><?php echo $a->fdescription1; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6" data-aos="flip-left" data-aos-duration="3000"><div class="feature-inner">
            	<div class="feature-icon"><img src="<?php echo base_url(); ?>upload/aboutus/<?php echo $a->sicon2; ?>"></div>
                <h3 class="text-uppercase"><?php echo $a->ftitle2; ?></h3>
                <p><?php echo $a->fdescription2; ?></p>
            </div></div>
            <div class="col-lg-3 col-md-6 col-sm-6" data-aos="flip-left" data-aos-duration="3000"><div class="feature-inner">
            	<div class="feature-icon"><img src="<?php echo base_url(); ?>upload/aboutus/<?php echo $a->sicon3; ?>"></div>
                <h3 class="text-uppercase"><?php echo $a->ftitle3; ?></h3>
                <p><?php echo $a->fdescription3; ?></p>
            </div></div>
            <div class="col-lg-3 col-md-6 col-sm-6" data-aos="flip-left" data-aos-duration="3000"><div class="feature-inner">
            	<div class="feature-icon"><img src="<?php echo base_url(); ?>upload/aboutus/<?php echo $a->sicon4; ?>"></div>
                <h3 class="text-uppercase"><?php echo $a->ftitle4; ?></h3>
                <p><?php echo $a->fdescription4; ?></p>
            </div></div>
        </div>
    </div>
</div>
							<?php }}} ?>

					    </div>
					</div>
				
					<!-- End Row selection and deletion (multiple rows) -->
										
					</div>
					
                </div>
                <!--===================================================-->
				
<div id="myModal" class="modal fade myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Remove <strong>Data</strong> ?</h4>
            </div>
            <div class="modal-body">
                       <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
						
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button onclick="deleterow()"  class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="id">
<script>
 function setID(id)
	  {
		  document.getElementById('id').value=id;
	  }
	  
 function deleterow()
	  {
		  var id=document.getElementById('id').value;
		  jQuery.ajax({
				url: '<?php echo base_url().$control.'/delete'.$controlname; ?>',
				type: 'post',
				data: {id:id},
			    success: function (result)
				{					
				   if(result==1)
				   {
					   window.location="<?php echo base_url().$control.'/delete'.$controlname; ?>/success";
				   }
				   else{
					   window.location="<?php echo base_url().$control.'/delete'.$controlname; ?>/error"; 
				   }
				}
			});
	
	  }	  
</script>