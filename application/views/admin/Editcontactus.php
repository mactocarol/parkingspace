
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
					                <h3 class="panel-title"><?php echo $controlnamemsg; ?>
									<a href="<?php echo base_url().$control.'/'.$controlname; ?>" class="btn btn-warning pull-right">Back</a>
									</h3>
					            </div>
				
					            <!--Input Size-->
					            <!--===================================================-->
					            <form action="<?php echo base_url().$control.'/update'.$controlname.'/'; ?><?php if(isset($contactus[0]->id)) { echo $contactus[0]->id; } ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Title</label>
							<div class="col-md-8">
								<input type="text" placeholder="Name" class="form-control" id="title" name="title" value="<?php  if(isset($contactus[0]->title)) { echo $contactus[0]->title; } ?>">
								<div class="errors"><?php echo form_error('title'); ?></div>		
							</div>
						</div>  

                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Description</label>
							<div class="col-md-8">
								<textarea  placeholder="Description" class="form-control" id="description" name="description"><?php  if(isset($contactus[0]->description)) { echo $contactus[0]->description; } ?></textarea>
											<div class="errors"><?php echo form_error('description'); ?></div>		

							</div>
						</div> 

 <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Email</label>
							<div class="col-md-8">
								<input type="text" placeholder="Email" class="form-control" id="email" name="email" value="<?php  if(isset($contactus[0]->email)) { echo $contactus[0]->email; } ?>">
								<div class="errors"><?php echo form_error('email'); ?></div>		
							</div>
						</div>  

 <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Phone</label>
							<div class="col-md-8">
								<input type="text" placeholder="Phone" class="form-control" id="phone" name="phone" value="<?php  if(isset($contactus[0]->phone)) { echo $contactus[0]->phone; } ?>">
								<div class="errors"><?php echo form_error('phone'); ?></div>		
							</div>
						</div> 

<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Address</label>
							<div class="col-md-8">
								<textarea  placeholder="Address" class="form-control" id="address" name="address"><?php  if(isset($contactus[0]->address)) { echo $contactus[0]->address; } ?></textarea>
											<div class="errors"><?php echo form_error('address'); ?></div>		

							</div>
						</div> 

<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Google Map</label>
							<div class="col-md-8">
								<textarea  placeholder="Map" class="form-control" id="map" name="map"><?php  if(isset($contactus[0]->map)) { echo $contactus[0]->map; } ?></textarea>
											<div class="errors"><?php echo form_error('map'); ?></div>		

							</div>
						</div> 						
					                   
                       
					                </div>
					                <div class="panel-footer">
					                    <div class="row">
					                        <div class="col-sm-9 col-sm-offset-3">
					                            <button class="btn btn-mint" type="submit">Submit</button>
					                            <a class="btn btn-warning" href="<?php echo base_url().$control.'/'.$controlname; ?>">Cancel</a>
					                        </div>
					                    </div>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Input Size-->
					
					
					        </div>
					    </div>
				
					</div>

                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->
			

			
			
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
				maxlength: 200
			},
			'description': {
				required: true
			},
			'map': {
				required: true
			},
			'address': {
				required: true
			},
			'email': {
				required: true
			},
			'phone': {
				required: true
			}
			
		},
		messages: {
			
		}					
	});  

</script>