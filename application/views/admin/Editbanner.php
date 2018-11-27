
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
					            <form action="<?php echo base_url().$control.'/update'.$controlname.'/'; ?><?php if(isset($banner[0]->id)) { echo $banner[0]->id; } ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Title</label>
							<div class="col-md-8">
								<input type="text" placeholder="Title" class="form-control" id="title" name="title" value="<?php  if(isset($banner[0]->title)) { echo $banner[0]->title; } ?>">
								<div class="errors"><?php echo form_error('title'); ?></div>		
							</div>
						</div> 

<div class="form-group">
                            	<label class="col-md-3 control-label">Photo</label>
                            	<div class="col-md-6">								
							    <input onchange="readURL(this);" class="form-control" type="file" name="photo" id="photo">
								<input type="hidden" name="photo1" id="photo1" value="<?php echo $banner[0]->photo; ?>">
							    </div>
                                <div class="col-md-3" >
								<img alt="Upload photo" id="image_upload_preview" src="<?php echo base_url(); ?>upload/slider/<?php echo$banner[0]->photo; ?>" class="ephoto">
                                </div>
						</div>  						

                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Description</label>
							<div class="col-md-8">
								<textarea rows=8 cols=10  placeholder="Description" class="form-control" id="description" name="description"><?php  if(isset($banner[0]->description)) { echo $banner[0]->description; } ?></textarea>
			
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
				maxlength: 50
			}
            
		},
		messages: {
			
		}					
	});  
	
	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }	

</script>