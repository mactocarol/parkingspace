
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
					            <form action="<?php echo base_url().$control.'/update'.$controlname.'/'; ?><?php if(isset($user[0]->id)) { echo $user[0]->id; } ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Name</label>
							<div class="col-md-8">
								<input type="text" placeholder="Name" class="form-control" id="name" name="name" value="<?php  if(isset($user[0]->name)) { echo $user[0]->name; } ?>">
								<div class="errors"><?php echo form_error('name'); ?></div>		
							</div>
						</div>

                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Email</label>
							<div class="col-md-8">
								<input type="text" placeholder="Email" class="form-control" id="email" name="email" value="<?php  if(isset($user[0]->email)) { echo $user[0]->email; } ?>">
								<input type="hidden" name="email1" id="email1" value="<?php if(isset($user[0]->email)) { echo $user[0]->email; } ?>">
								<div class="errors"><?php echo form_error('email'); ?></div>		
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Phone</label>
							<div class="col-md-8">
								<input type="text" placeholder="Phone" class="form-control" id="phone" name="phone" value="<?php  if(isset($user[0]->contact)) { echo $user[0]->contact; } ?>">
								<div class="errors"><?php echo form_error('phone'); ?></div>		
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Country</label>
							<div class="col-md-8">
							<select data-placeholder="Choose a Country..." id="demo-chosen-select" tabindex="2" class="form-control"  name="country">
								 <?php 
						  if(isset($country))
						  {
							  foreach($country as $c)
							  {
								?>
								<option value="<?php echo $c->countryID; ?>" <?php if(isset($user[0]->country)) { if($user[0]->country==$c->countryID) { echo "selected"; } } ?>><?php echo $c->countryName; ?></option>
<?php								
							  }
						  }
						  ?>
						  </select>
								<div class="errors"><?php echo form_error('country'); ?></div>		
							</div>
						</div>
						 <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Address</label>
							<div class="col-md-8">
								<textarea  placeholder="Address" class="form-control" id="address" name="address"><?php if(isset($user[0]->address)) { echo $user[0]->address; } ?></textarea>
								<div class="errors"><?php echo form_error('address'); ?></div>	
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Zipcode</label>
							<div class="col-md-8">
								<input type="text" placeholder="zipcode" class="form-control" id="zipcode" name="zipcode" value="<?php  if(isset($user[0]->zipcode)) { echo $user[0]->zipcode; } ?>">
								<div class="errors"><?php echo form_error('zipcode'); ?></div>		
							</div>
						</div>
						
						
						<div class="form-group">
                            	<label class="col-md-3 control-label" for="inputDefault">Company Name</label>
								<div class="col-md-8">
                            	<input type="text" name="companyname" id="companyname" placeholder="Enter companyname" value="<?php if(isset($user[0]->companyname)) { echo $user[0]->companyname; } ?>" class="form-control">
								</div>
                            </div>
							
							<div class="form-group">
                           <label class="col-md-3 control-label" for="inputDefault">Property type expertise</label>
						   <div class="col-md-8">
                          <select multiple data-live-search="true" class="selectpicker  fill_selectbtn_in own_selectbox" name="speciality[]" id="speciality" data-width="100%">
						  <?php 
						  if(isset($propertytype))
						  {
							  foreach($propertytype as $c)
							  {
								?>
								<option value="<?php echo $c->id; ?>" <?php if(isset($user[0]->speciality)) { if(in_array($c->id,explode( ",",$user[0]->speciality))) { echo "selected"; } }  ?>><?php echo $c->name; ?></option>
<?php								
							  }
						  }
						  ?>
						  </select>
                          </div>
                        </div>
						
						<div class="form-group">
                           <label class="col-md-3 control-label" for="inputDefault">Broker type</label>
                          <div class="col-md-8">
						  <select data-live-search="true" class="selectpicker  fill_selectbtn_in own_selectbox" name="brokertype" id="brokertype" data-width="100%">
						  <?php 
						  if(isset($brokertype))
						  {
							  foreach($brokertype as $c)
							  {
								?>
								<option value="<?php echo $c->id; ?>" <?php if(isset($user[0]->brokertype)) { if($c->id==$user[0]->brokertype) { echo "selected"; } }  ?>><?php echo $c->name; ?></option>
<?php								
							  }
						  }
						  ?>
						  </select>
</div>
                        </div>
						
						
						<div class="form-group">
                           <label class="col-md-3 control-label" for="inputDefault">Language spoken</label>
						   <div class="col-md-8">
                          <select multiple data-live-search="true" class="selectpicker  fill_selectbtn_in own_selectbox" name="languagespoken[]" id="languagespoken" data-width="100%">
						  <?php 
						  if(isset($languagespoken))
						  {
							  foreach($languagespoken as $c)
							  {
								?>
								<option value="<?php echo $c->id; ?>" <?php if(isset($user[0]->languagespoken)) { if(in_array($c->id,explode( ",",$user[0]->languagespoken))) { echo "selected"; } }  ?>><?php echo $c->name; ?></option>
<?php								
							  }
						  }
						  ?>
						  </select>
</div>
                        </div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Skype</label>
							<div class="col-md-8">
								<input type="text" placeholder="skype" class="form-control" id="skype" name="skype" value="<?php  if(isset($user[0]->skype)) { echo $user[0]->skype; } ?>">
								<div class="errors"><?php echo form_error('skype'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Facebook</label>
							<div class="col-md-8">
								<input type="text" placeholder="facebook" class="form-control" id="facebook" name="facebook" value="<?php  if(isset($user[0]->facebook)) { echo $user[0]->facebook; } ?>">
								<div class="errors"><?php echo form_error('facebook'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Google</label>
							<div class="col-md-8">
								<input type="text" placeholder="google" class="form-control" id="google" name="google" value="<?php  if(isset($user[0]->google)) { echo $user[0]->google; } ?>">
								<div class="errors"><?php echo form_error('google'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Linkedin</label>
							<div class="col-md-8">
								<input type="text" placeholder="linkedin" class="form-control" id="linkedin" name="linkedin" value="<?php  if(isset($user[0]->linkedin)) { echo $user[0]->linkedin; } ?>">
								<div class="errors"><?php echo form_error('linkedin'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Twitter</label>
							<div class="col-md-8">
								<input type="text" placeholder="twitter" class="form-control" id="twitter" name="twitter" value="<?php  if(isset($user[0]->twitter)) { echo $user[0]->twitter; } ?>">
								<div class="errors"><?php echo form_error('twitter'); ?></div>		
							</div>
						</div>
 						
		
                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Description</label>
							<div class="col-md-8">
								<textarea  placeholder="Description" class="form-control" id="description" name="description"><?php if(isset($user[0]->description)) { echo $user[0]->description; } ?></textarea>
								<div class="errors"><?php echo form_error('description'); ?></div>	
							</div>
						</div>

	                    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Photo Upload</label>
							<div class="col-md-6" style="padding: 6px;">
							<a href="#"  data-toggle="modal" data-target="#myModalphoto" class="btn btn-pink">Browse</a>
							<input type="hidden" name="photo" id="photo">
							<input type="hidden" name="photo1" id="photo1" value="<?php if(isset($user[0]->photo)) { echo $user[0]->photo; } ?>">
							</div>
							<div class="col-md-3">
							<?php if(isset($user[0]->photo)) {
								if($user[0]->photo!="")
								{ ?>
							<a href="<?php echo base_url(); ?>upload/user/<?php echo $user[0]->photo;  ?>" data-lightbox="example-set"><img class="ephoto" src="<?php echo base_url(); ?>upload/user/<?php echo $user[0]->photo;  ?>"></a>
							<?php } } ?>
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
			
			
<div id="myModalphoto" class="modal fade" role="dialog">
  <div class="modal-dialog cover_pic">

    <!-- Modal Cover Picture-->
    <div class="modal-content">
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
var eml=$("#email1").val();
	var jvalidate = $("#valid-form").validate({
		ignore: [],
		rules: {                                                                 
			'name': {
				required: true,
				minlength: 3,
				maxlength: 100
			},
			'email': {
                required: true,
                minlength: 6,
                maxlength: 300,
				email: true,
				remote: {
					
		        url: "<?php echo base_url(); ?>Home/checkMail/"+eml,
                type: "post",
                data: {
                email: function() {			  
                   return $( "#email" ).val();
                }		
        }
      }
                    },
            		
			'phone': {
               required: true,
               minlength: 5,
               maxlength: 15,
			   numbers: true
            },
			'description': {
               required: true,
               minlength: 2,
               maxlength: 500                                                 
            },
			'country': {
                required: true
            },
            'address': {
                required: true
            },			
			'zipcode': {
                required: true
            },
			'skype': {
                required: true
            },
			'facebook': {
                required: true,
				url:true
            },
			'google': {
                required: true,
				url:true
            },
			'companyname': {
                required: true
            },
			'brokertype': {
                required: true
            },
			'speciality[]': {
                required: true,
				minlength:1
            },
			'languagespoken[]': {
                required: true,
				minlength:1
            },
			'twitter': {
                required: true,
				url:true
            },
			'linkedin': {
                required: true,
				url:true
            }
			
		},
		messages: {
			'email':{
				remote: 'Email ID already exists'
			}
		}					
	});  

</script>
<script type="text/javascript">
$uploadCrop1 = $('#upload-demo1').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 250,
        height: 250
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
 });
});

</script>