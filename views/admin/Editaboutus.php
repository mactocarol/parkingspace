
   <div id="content-container">
    
                <div id="page-head">
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow"><?php echo $controlnamemsg; ?></h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="#"><?php echo $control; ?></a></li>
					<li class="active"><?php echo $controlnamemsg; ?></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                  <?php 
	    if($this->session->flashdata('result')) { 
		?>
		<div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h4 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?></h4> 
		</div>
		<?php } ?>   
					
				
					<div class="row">
					    <div class="col-lg-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">
									<a href="<?php echo base_url().$control.'/'.$controlname; ?>" class="btn btn-warning pull-right">Back</a>
									</h3>
					            </div>
										<form action="<?php echo base_url().$control.'/update'.$controlname.'/'; ?><?php if(isset($aboutus[0]->id)) { echo $aboutus[0]->id; } ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">

								<div class="tab-base">
					
					            <!--Nav Tabs-->
					            <ul class="nav nav-tabs">
					                <li class="active">
					                    <a data-toggle="tab" href="#demo-lft-tab-1">Basic details</a>
					                </li>
					                <li>
					                    <a data-toggle="tab" href="#demo-lft-tab-2">Feature</a>
					                </li>
					                <li>
					                    <a data-toggle="tab" href="#demo-lft-tab-3">Contact</a>
					                </li>
									<li>
					                    <a data-toggle="tab" href="#demo-lft-tab-4">Services</a>
					                </li>
									
					            </ul>
					
					            <!--Tabs Content-->
					            <div class="tab-content">

				 <div id="demo-lft-tab-1" class="tab-pane fade active in">
<div class="panel-body"> 
					        <div class="form-group">
                            	<label class="col-md-3 control-label">Title*</label>
                            	<div class="col-md-8">
								<input name="title" id="title" type="text" placeholder="Title" value="<?php if(isset($aboutus[0]->title)) { echo $aboutus[0]->title; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('title'); ?></div>
							</div>
							</div>
							 <div class="form-group">
                            	<label class="col-md-3 control-label">Sub Title*</label>
                            	<div class="col-md-8">
								<input name="subtitle" id="subtitle" type="text" placeholder="Sub Title" value="<?php if(isset($aboutus[0]->subtitle)) { echo $aboutus[0]->subtitle; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('subtitle'); ?></div>
							</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Description*</label>
                            	<div class="col-md-8">
								<textarea name="description" id="description" placeholder="description" class="form-control"><?php if(isset($aboutus[0]->description)) { echo $aboutus[0]->description; } ?></textarea>
                                <div class="errors"><?php echo form_error('description'); ?></div>
							</div>
							</div>
							 <div class="form-group">
                            	<label class="col-md-3 control-label">Photo</label>
                            	<div class="col-md-6">
								<a href="#"  data-toggle="modal" data-target="#myModalphoto" class="btn btn-pink">Browse</a>
							    <input type="hidden" name="photo" id="photo">
								<input type="hidden" name="photo1" id="photo1" value="<?php if(isset($aboutus[0]->photo)) { echo $aboutus[0]->photo; } ?>">
							</div>
<div class="col-md-3" id="showphoto">
<?php
if(isset($aboutus[0]->photo))
{
if($aboutus[0]->photo!="")
{
?>
<a href="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->photo;  ?>" data-lightbox="example-set">
<img class="ephoto" src="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->photo; ?>">
</a>
<?php
}}
?>
</div>
							</div>
							<div class="form-group">
                            	<label class="col-md-3 control-label">Agent Title*</label>
                            	<div class="col-md-8">
								<input name="atitle" id="atitle" type="text" placeholder="Agent Title" value="<?php if(isset($aboutus[0]->atitle)) { echo $aboutus[0]->atitle; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('atitle'); ?></div>
							</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Agent Description*</label>
                            	<div class="col-md-8">
								<textarea name="adescription" id="adescription" placeholder="description" class="form-control"><?php if(isset($aboutus[0]->adescription)) { echo $aboutus[0]->adescription; } ?></textarea>
                                <div class="errors"><?php echo form_error('adescription'); ?></div>
							</div>
							</div>

						
					                    <div class="row">
					                        <div class="col-sm-6 col-sm-offset-5">
					                            <a  data-toggle="tab" href="#demo-lft-tab-2" class="btn btn-mint">Next</a>
					                        </div>
					                    </div>
					               
										  
					                </div>
									</div>
									
									
<div id="demo-lft-tab-2" class="tab-pane fade">
<div class="panel-body"> 
					        <div class="form-group">
                            	<label class="col-md-3 control-label">Feature title 1*</label>
                            	<div class="col-md-8">
								<input name="ftitle1" id="ftitle1" type="text" placeholder="Feature Title" value="<?php if(isset($aboutus[0]->ftitle1)) { echo $aboutus[0]->ftitle1; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ftitle1'); ?></div>
							</div>
							</div>
							 <div class="form-group">
                            	<label class="col-md-3 control-label">Feature icon 1*</label>
                            	<div class="col-md-8">
								<input name="ficon1" id="ficon1" type="text" placeholder="Feature icon" value="<?php if(isset($aboutus[0]->ficon1)) { echo $aboutus[0]->ficon1; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ficon1'); ?></div>
							</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Feature Description 1*</label>
                            	<div class="col-md-8">
								<textarea name="fdescription1" id="fdescription1" placeholder="description" class="form-control"><?php if(isset($aboutus[0]->fdescription1)) { echo $aboutus[0]->fdescription1; } ?></textarea>
                                <div class="errors"><?php echo form_error('fdescription1'); ?></div>
							</div>
							</div>
							
							<div class="form-group">
                            	<label class="col-md-3 control-label">Feature title 2*</label>
                            	<div class="col-md-8">
								<input name="ftitle2" id="ftitle2" type="text" placeholder="Feature Title" value="<?php if(isset($aboutus[0]->ftitle2)) { echo $aboutus[0]->ftitle2; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ftitle2'); ?></div>
							</div>
							</div>
							 <div class="form-group">
                            	<label class="col-md-3 control-label">Feature icon 2*</label>
                            	<div class="col-md-8">
								<input name="ficon2" id="ficon2" type="text" placeholder="Feature icon" value="<?php if(isset($aboutus[0]->ficon2)) { echo $aboutus[0]->ficon2; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ficon2'); ?></div>
							</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Feature Description 2*</label>
                            	<div class="col-md-8">
								<textarea name="fdescription2" id="fdescription2" placeholder="description" class="form-control"><?php if(isset($aboutus[0]->fdescription2)) { echo $aboutus[0]->fdescription2; } ?></textarea>
                                <div class="errors"><?php echo form_error('fdescription2'); ?></div>
							</div>
							</div>
							
							<div class="form-group">
                            	<label class="col-md-3 control-label">Feature title 3*</label>
                            	<div class="col-md-8">
								<input name="ftitle3" id="ftitle3" type="text" placeholder="Feature Title" value="<?php if(isset($aboutus[0]->ftitle3)) { echo $aboutus[0]->ftitle3; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ftitle3'); ?></div>
							</div>
							</div>
							 <div class="form-group">
                            	<label class="col-md-3 control-label">Feature icon 3*</label>
                            	<div class="col-md-8">
								<input name="ficon3" id="ficon3" type="text" placeholder="Feature icon" value="<?php if(isset($aboutus[0]->ficon3)) { echo $aboutus[0]->ficon3; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ficon3'); ?></div>
							</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Feature Description 3*</label>
                            	<div class="col-md-8">
								<textarea name="fdescription3" id="fdescription3" placeholder="description" class="form-control"><?php if(isset($aboutus[0]->fdescription3)) { echo $aboutus[0]->fdescription3; } ?></textarea>
                                <div class="errors"><?php echo form_error('fdescription3'); ?></div>
							</div>
							</div>
							
							
							<div class="form-group">
                            	<label class="col-md-3 control-label">Feature title 4*</label>
                            	<div class="col-md-8">
								<input name="ftitle4" id="ftitle4" type="text" placeholder="Feature Title" value="<?php if(isset($aboutus[0]->ftitle4)) { echo $aboutus[0]->ftitle4; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ftitle4'); ?></div>
							</div>
							</div>
							 <div class="form-group">
                            	<label class="col-md-3 control-label">Feature icon 4*</label>
                            	<div class="col-md-8">
								<input name="ficon4" id="ficon4" type="text" placeholder="Feature icon" value="<?php if(isset($aboutus[0]->ficon4)) { echo $aboutus[0]->ficon4; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ficon4'); ?></div>
							</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Feature Description 4*</label>
                            	<div class="col-md-8">
								<textarea name="fdescription4" id="fdescription4" placeholder="description" class="form-control"><?php if(isset($aboutus[0]->fdescription4)) { echo $aboutus[0]->fdescription4; } ?></textarea>
                                <div class="errors"><?php echo form_error('fdescription4'); ?></div>
							</div>
							</div>
							
					                    <div class="row">
					                        <div class="col-sm-6 col-sm-offset-5">
					                            <a  data-toggle="tab" href="#demo-lft-tab-1" class="btn btn-mint">Previous</a>
					                        	<a  data-toggle="tab" href="#demo-lft-tab-3" class="btn btn-mint">Next</a>

											</div>
					                    </div>
					               
										  
					                </div>
									</div>
									
									
												 <div id="demo-lft-tab-3" class="tab-pane fade">
<div class="panel-body"> 
<div class="form-group">
                            	<label class="col-md-3 control-label">Contact title*</label>
                            	<div class="col-md-8">
								<input name="ctitle" id="ctitle" type="text" placeholder="Contact Title" value="<?php if(isset($aboutus[0]->ctitle)) { echo $aboutus[0]->ctitle; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('ctitle'); ?></div>
							</div>
							</div>
							 <div class="form-group">
                            	<label class="col-md-3 control-label">Contact icon*</label>
                            	<div class="col-md-8">
								<input name="cicon" id="cicon" type="text" placeholder="Contact icon" value="<?php if(isset($aboutus[0]->cicon)) { echo $aboutus[0]->cicon; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('cicon'); ?></div>
							</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Contact Description*</label>
                            	<div class="col-md-8">
								<textarea name="cdescription" id="cdescription" placeholder="Contact description" class="form-control"><?php if(isset($aboutus[0]->cdescription)) { echo $aboutus[0]->cdescription; } ?></textarea>
                                <div class="errors"><?php echo form_error('cdescription'); ?></div>
							</div>
							</div>
							<div class="form-group">
                            	<label class="col-md-3 control-label">Contact No Heading*</label>
                            	<div class="col-md-8">
								<input name="cnoheading" id="cnoheading" type="text" placeholder="Contact no heading" value="<?php if(isset($aboutus[0]->cnoheading)) { echo $aboutus[0]->cnoheading; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('cnoheading'); ?></div>
							</div>
							</div>
							<div class="form-group">
                            	<label class="col-md-3 control-label">Contact No*</label>
                            	<div class="col-md-8">
								<input name="cno" id="cno" type="text" placeholder="Contact No" value="<?php if(isset($aboutus[0]->cno)) { echo $aboutus[0]->cno; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('cno'); ?></div>
							</div>
							</div>

						
					                    <div class="row">
					                        <div class="col-sm-6 col-sm-offset-5">
					                            <a  data-toggle="tab" href="#demo-lft-tab-2" class="btn btn-mint">Previous</a>

											    <a  data-toggle="tab" href="#demo-lft-tab-4" class="btn btn-mint">Next</a>
					                        </div>
					                    </div>
					               
										  
					                </div>
									</div>
									
									
												 <div id="demo-lft-tab-4" class="tab-pane fade">
<div class="panel-body"> 
					       <div class="form-group">
                            	<label class="col-md-3 control-label">Service title 1*</label>
                            	<div class="col-md-8">
								<input name="stitle1" id="stitle1" type="text" placeholder="Service Title" value="<?php if(isset($aboutus[0]->stitle1)) { echo $aboutus[0]->stitle1; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('stitle1'); ?></div>
							</div>
							</div>
							 <div class="form-group">
                            	<label class="col-md-3 control-label">Service icon 1</label>
                            	<div class="col-md-6">
								<a href="#"  data-toggle="modal" data-target="#myModalphoto2" class="btn btn-pink">Browse</a>
							    <input type="hidden" name="sicon1" id="sicon1">
								<input type="hidden" name="sicon11" id="sicon11" value="<?php if(isset($aboutus[0]->sicon1)) { echo $aboutus[0]->sicon1; } ?>">
							</div>
<div class="col-md-3" id="showsicon1">
<?php
if(isset($aboutus[0]->sicon1))
{
if($aboutus[0]->sicon1!="")
{
?>
<a href="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->sicon1;  ?>" data-lightbox="example-set">
<img class="ephoto" src="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->sicon1; ?>">
</a>
<?php
}}
?>
</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Service Description 1*</label>
                            	<div class="col-md-8">
								<textarea name="sdescription1" id="sdescription1" placeholder="Service description" class="form-control"><?php if(isset($aboutus[0]->sdescription1)) { echo $aboutus[0]->sdescription1; } ?></textarea>
                                <div class="errors"><?php echo form_error('fdescription1'); ?></div>
							</div>
							</div>
							
							<div class="form-group">
                            	<label class="col-md-3 control-label">Service title 2*</label>
                            	<div class="col-md-8">
								<input name="stitle2" id="stitle2" type="text" placeholder="Service Title" value="<?php if(isset($aboutus[0]->stitle2)) { echo $aboutus[0]->stitle2; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('stitle2'); ?></div>
							</div>
							</div>
							<div class="form-group">
                            	<label class="col-md-3 control-label">Service icon 2</label>
                            	<div class="col-md-6">
								<a href="#"  data-toggle="modal" data-target="#myModalphoto3" class="btn btn-pink">Browse</a>
							    <input type="hidden" name="sicon2" id="sicon2">
								<input type="hidden" name="sicon21" id="sicon21" value="<?php if(isset($aboutus[0]->sicon2)) { echo $aboutus[0]->sicon2; } ?>">
							</div>
<div class="col-md-3" id="showsicon2">
<?php
if(isset($aboutus[0]->sicon2))
{
if($aboutus[0]->sicon2!="")
{
?>
<a href="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->sicon2;  ?>" data-lightbox="example-set">
<img class="ephoto" src="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->sicon2; ?>">
</a>
<?php
}}
?>
</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Service Description 2*</label>
                            	<div class="col-md-8">
								<textarea name="sdescription2" id="sdescription2" placeholder="Service description" class="form-control"><?php if(isset($aboutus[0]->sdescription2)) { echo $aboutus[0]->sdescription2; } ?></textarea>
                                <div class="errors"><?php echo form_error('fdescription2'); ?></div>
							</div>
							</div>
							
							
							<div class="form-group">
                            	<label class="col-md-3 control-label">Service title 3*</label>
                            	<div class="col-md-8">
								<input name="stitle3" id="stitle3" type="text" placeholder="Service Title" value="<?php if(isset($aboutus[0]->stitle3)) { echo $aboutus[0]->stitle3; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('stitle3'); ?></div>
							</div>
							</div>
							<div class="form-group">
                            	<label class="col-md-3 control-label">Service icon 3</label>
                            	<div class="col-md-6">
								<a href="#"  data-toggle="modal" data-target="#myModalphoto4" class="btn btn-pink">Browse</a>
							    <input type="hidden" name="sicon3" id="sicon3">
								<input type="hidden" name="sicon31" id="sicon31" value="<?php if(isset($aboutus[0]->sicon3)) { echo $aboutus[0]->sicon3; } ?>">
							</div>
<div class="col-md-3" id="showsicon3">
<?php
if(isset($aboutus[0]->sicon3))
{
if($aboutus[0]->sicon3!="")
{
?>
<a href="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->sicon3;  ?>" data-lightbox="example-set">
<img class="ephoto" src="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->sicon3; ?>">
</a>
<?php
}}
?>
</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Service Description 3*</label>
                            	<div class="col-md-8">
								<textarea name="sdescription3" id="sdescription3" placeholder="Service description" class="form-control"><?php if(isset($aboutus[0]->sdescription3)) { echo $aboutus[0]->sdescription3; } ?></textarea>
                                <div class="errors"><?php echo form_error('fdescription3'); ?></div>
							</div>
							</div>
							
							
														
							<div class="form-group">
                            	<label class="col-md-3 control-label">Service title 4*</label>
                            	<div class="col-md-8">
								<input name="stitle4" id="stitle4" type="text" placeholder="Service Title" value="<?php if(isset($aboutus[0]->stitle4)) { echo $aboutus[0]->stitle4; } ?>" class="form-control">
                                <div class="errors"><?php echo form_error('stitle4'); ?></div>
							</div>
							</div>
							<div class="form-group">
                            	<label class="col-md-3 control-label">Service icon 4</label>
                            	<div class="col-md-6">
								<a href="#"  data-toggle="modal" data-target="#myModalphoto5" class="btn btn-pink">Browse</a>
							    <input type="hidden" name="sicon4" id="sicon4">
								<input type="hidden" name="sicon41" id="sicon41" value="<?php if(isset($aboutus[0]->sicon4)) { echo $aboutus[0]->sicon4; } ?>">
							</div>
<div class="col-md-3" id="showsicon4">
<?php
if(isset($aboutus[0]->sicon4))
{
if($aboutus[0]->sicon4!="")
{
?>
<a href="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->sicon4;  ?>" data-lightbox="example-set">
<img class="ephoto" src="<?php echo base_url(); ?>upload/aboutus/<?php echo $aboutus[0]->sicon4; ?>">
</a>
<?php
}}
?>
</div>
							</div>
                            <div class="form-group">
                            	<label class="col-md-3 control-label">Service Description 4*</label>
                            	<div class="col-md-8">
								<textarea name="sdescription4" id="sdescription4" placeholder="Service description" class="form-control"><?php if(isset($aboutus[0]->sdescription4)) { echo $aboutus[0]->sdescription4; } ?></textarea>
                                <div class="errors"><?php echo form_error('fdescription4'); ?></div>
							</div>
							</div>

						
					                    <div class="row">
					                        <div class="col-sm-6 col-sm-offset-5">
					                          					                            <a  data-toggle="tab" href="#demo-lft-tab-3" class="btn btn-mint">Previous</a>

											  <button type="submit"  class="btn btn-mint">Save</button>
					                        </div>
					                    </div>
					               
										  
					                </div>
									</div>
									
									
									
					            </div>
								
								</div>
					</form>
					
					        </div>
					    </div>
				
					</div>

                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->
			
			
<div id="myModalphoto" class="modal fade" role="dialog">
  <div class="modal-dialog cover_pic">

    <!-- Modal Cover Picture-->
    <div class="modal-content" style="width:160%;right:160px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
       
                   <div class="row">
                        <p id="img_success"></p>
                        <div class="col-md-8 text-center">
                            <div id="upload-demo1" ></div>
							<button data-dismiss="modal" type="button" class="btn btn-pink upload-result1">Save Photo</button>
                        </div>
                        <div class="col-md-4" >
                            <strong>Select Photo:</strong>
                            <br/>
                            <input type="file" id="upload1">
							
                            <br/>
                            <button type="button" class="btn btn-pink upload-result1">Upload Photo</button>
                        
						</div>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


			
<div id="myModalphoto2" class="modal fade" role="dialog">
  <div class="modal-dialog cover_pic">

    <!-- Modal Cover Picture-->
    <div class="modal-content" style="width:160%;right:160px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
       
                   <div class="row">
                        <p id="img_success"></p>
                        <div class="col-md-8 text-center">
                            <div id="upload-demo2" ></div>
							<button data-dismiss="modal" type="button" class="btn btn-pink upload-result2">Save Photo</button>
                        </div>
                        <div class="col-md-4" >
                            <strong>Select Photo:</strong>
                            <br/>
                            <input type="file" id="upload2">
							
                            <br/>
                            <button type="button" class="btn btn-pink upload-result2">Upload Photo</button>
                        
						</div>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


			
<div id="myModalphoto3" class="modal fade" role="dialog">
  <div class="modal-dialog cover_pic">

    <!-- Modal Cover Picture-->
    <div class="modal-content" style="width:160%;right:160px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
       
                   <div class="row">
                        <p id="img_success"></p>
                        <div class="col-md-8 text-center">
                            <div id="upload-demo3" ></div>
							<button data-dismiss="modal" type="button" class="btn btn-pink upload-result3">Save Photo</button>
                        </div>
                        <div class="col-md-4" >
                            <strong>Select Photo:</strong>
                            <br/>
                            <input type="file" id="upload3">
							
                            <br/>
                            <button type="button" class="btn btn-pink upload-result3">Upload Photo</button>
                        
						</div>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	


<div id="myModalphoto4" class="modal fade" role="dialog">
  <div class="modal-dialog cover_pic">

    <!-- Modal Cover Picture-->
    <div class="modal-content" style="width:160%;right:160px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
       
                   <div class="row">
                        <p id="img_success"></p>
                        <div class="col-md-8 text-center">
                            <div id="upload-demo4" ></div>
							<button data-dismiss="modal" type="button" class="btn btn-pink upload-result4">Save Photo</button>
                        </div>
                        <div class="col-md-4" >
                            <strong>Select Photo:</strong>
                            <br/>
                            <input type="file" id="upload4">
							
                            <br/>
                            <button type="button" class="btn btn-pink upload-result4">Upload Photo</button>
                        
						</div>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>			
		
<div id="myModalphoto5" class="modal fade" role="dialog">
  <div class="modal-dialog cover_pic">

    <!-- Modal Cover Picture-->
    <div class="modal-content" style="width:160%;right:160px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
       
                   <div class="row">
                        <p id="img_success"></p>
                        <div class="col-md-8 text-center">
                            <div id="upload-demo5" ></div>
							<button data-dismiss="modal" type="button" class="btn btn-pink upload-result5">Save Photo</button>
                        </div>
                        <div class="col-md-4" >
                            <strong>Select Photo:</strong>
                            <br/>
                            <input type="file" id="upload5">
							
                            <br/>
                            <button type="button" class="btn btn-pink upload-result5">Upload Photo</button>
                        
						</div>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>			
			
<script>


	jQuery.validator.addMethod("numbers", function (value, element) {
		return this.optional(element) || /^(\d+|\d+,\d{1,2})$/.test(value);
	}, "Only numbers allow");

	jQuery.validator.addMethod("space", function (value, element) {
		return this.optional(element) || /^[0-9a-zA-Z]+$/.test(value);
	}, "Username allow only characters & numbers not whitespace");


	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");

	var jvalidate = $("#valid-form").validate({
		ignore: [],
		rules: {                                                                 
			'title': {
				required: true,
				minlength: 2,
				maxlength: 300
			},
			'subtitle': {
				required: true,
				minlength: 2,
				maxlength: 300
			},
			'description': {
				required: true,
				minlength: 2,
				maxlength: 300
			},
			'ficon1': {
				required: true,
				minlength: 2,
				maxlength: 30
			},
			'ftitle1': {
				required: true,
				minlength: 2,
				maxlength: 300
			},
			'fdescription1': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			'ficon2': {
				required: true,
				minlength: 2,
				maxlength: 30
			},
			'ftitle2': {
				required: true,
				minlength: 2,
				maxlength: 300
			},
			'fdescription2': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			'ficon3': {
				required: true,
				minlength: 2,
				maxlength: 30
			},
			'ftitle3': {
				required: true,
				minlength: 2,
				maxlength: 300
			},
			'fdescription3': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			'ficon4': {
				required: true,
				minlength: 2,
				maxlength: 30
			},
			'ftitle4': {
				required: true,
				minlength: 2,
				maxlength: 300
			},
			'fdescription4': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			'ctitle': {
				required: true,
				minlength: 2,
				maxlength: 30
			},
			'cdescription': {
				required: true,
				minlength: 2,
				maxlength: 50
			},
			'cnoheading': {
				required: true,
				minlength: 2,
				maxlength: 30
			},
			'cno': {
				required: true,
				minlength: 2,
				maxlength: 20
			},
			'cicon': {
				required: true,
				minlength: 2,
				maxlength: 30
			},
			'stitle1': {
				required: true,
				minlength: 2,
				maxlength: 20
			},
			
			'sdescription1': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			'stitle2': {
				required: true,
				minlength: 2,
				maxlength: 20
			},
			
			'sdescription2': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			'stitle3': {
				required: true,
				minlength: 2,
				maxlength: 20
			},
			
			'sdescription3': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			
'stitle4': {
				required: true,
				minlength: 2,
				maxlength: 20
			},
			
			'sdescription4': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
'atitle': {
				required: true,
				minlength: 2,
				maxlength: 40
			},
'adescription': {
				required: true,
				minlength: 2,
				maxlength: 100
			}				
			
		},
		messages: {
			
		}					
	});  

</script>

<script type="text/javascript">
$uploadCrop1 = $('#upload-demo1').croppie({
    enableExif: true,
    viewport: {
        width: 540,
        height: 485,
        type: 'square'
    },
    boundary: {
        width: 600,
        height: 540
    }
});

$('#upload1').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $uploadCrop1.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result1').on('click', function (ev) {
 $uploadCrop1.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#photo").val(resp);
    $("#showphoto").html("<img class='ephoto' src="+resp+">"); 
 });
});

$uploadCrop2 = $('#upload-demo2').croppie({
    enableExif: true,
    viewport: {
        width: 128,
        height: 128,
        type: 'square'
    },
    boundary: {
        width: 160,
        height: 160
    }
});

$('#upload2').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $uploadCrop2.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result2').on('click', function (ev) {
 $uploadCrop2.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#sicon1").val(resp);
    $("#showsicon1").html("<img src="+resp+">"); 
 });
});



$uploadCrop3 = $('#upload-demo3').croppie({
    enableExif: true,
    viewport: {
        width: 128,
        height: 128,
        type: 'square'
    },
    boundary: {
        width: 160,
        height: 160
    }
});

$('#upload3').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $uploadCrop3.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result3').on('click', function (ev) {
 $uploadCrop3.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#sicon2").val(resp);
    $("#showsicon2").html("<img src="+resp+">"); 
 });
});



$uploadCrop4 = $('#upload-demo4').croppie({
    enableExif: true,
    viewport: {
        width: 128,
        height: 128,
        type: 'square'
    },
    boundary: {
        width: 160,
        height: 160
    }
});

$('#upload4').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $uploadCrop4.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result4').on('click', function (ev) {
 $uploadCrop4.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#sicon3").val(resp);
    $("#showsicon3").html("<img src="+resp+">"); 
 });
});


$uploadCrop5 = $('#upload-demo5').croppie({
    enableExif: true,
    viewport: {
        width: 128,
        height: 128,
        type: 'square'
    },
    boundary: {
        width: 160,
        height: 160
    }
});

$('#upload5').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $uploadCrop5.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result5').on('click', function (ev) {
 $uploadCrop5.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#sicon4").val(resp);
    $("#showsicon4").html("<img src="+resp+">"); 
 });
});
</script>