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
					            <form action="<?php echo base_url().$control.'/create'.$controlname; ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Name</label>
							<div class="col-md-8">
								<input type="text" placeholder="Name" class="form-control" id="name" name="name" value="<?php  if(isset($_REQUEST['name'])) { echo $_REQUEST['name']; } ?>">
								<div class="errors"><?php echo form_error('name'); ?></div>		
							</div>
						</div>

                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Email</label>
							<div class="col-md-8">
								<input type="text" placeholder="Email" class="form-control" id="email" name="email" value="<?php  if(isset($_REQUEST['email'])) { echo $_REQUEST['email']; } ?>">
								<div class="errors"><?php echo form_error('email'); ?></div>		
							</div>
						</div>
<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Password</label>
							<div class="col-md-8">
								<input type="password" placeholder="Password" class="form-control" id="password" name="password" value="<?php  if(isset($_REQUEST['password'])) { echo $_REQUEST['password']; } ?>">
								<div class="errors"><?php echo form_error('password'); ?></div>		
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Confirm Password</label>
							<div class="col-md-8">
								<input type="password" placeholder="Confirm Password" class="form-control" id="cpassword" name="cpassword" value="<?php  if(isset($_REQUEST['cpassword'])) { echo $_REQUEST['cpassword']; } ?>">
								<div class="errors"><?php echo form_error('cpassword'); ?></div>		
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Phone</label>
							<div class="col-md-8">
								<input type="text" placeholder="Phone" class="form-control" id="phone" name="phone" value="<?php  if(isset($_REQUEST['phone'])) { echo $_REQUEST['phone']; } ?>">
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
								<option value="<?php echo $c->countryID; ?>"><?php echo $c->countryName; ?></option>
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
								<textarea  placeholder="Address" class="form-control" id="address" name="address"><?php if(isset($_REQUEST['address'])) { echo $_REQUEST['address']; } ?></textarea>
								<div class="errors"><?php echo form_error('address'); ?></div>	
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Zipcode</label>
							<div class="col-md-8">
								<input type="text" placeholder="zipcode" class="form-control" id="zipcode" name="zipcode" value="<?php  if(isset($_REQUEST['zipcode'])) { echo $_REQUEST['zipcode']; } ?>">
								<div class="errors"><?php echo form_error('zipcode'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Skype</label>
							<div class="col-md-8">
								<input type="text" placeholder="skype" class="form-control" id="skype" name="skype" value="<?php  if(isset($_REQUEST['skype'])) { echo $_REQUEST['skype']; } ?>">
								<div class="errors"><?php echo form_error('skype'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Facebook</label>
							<div class="col-md-8">
								<input type="text" placeholder="facebook" class="form-control" id="facebook" name="facebook" value="<?php  if(isset($_REQUEST['facebook'])) { echo $_REQUEST['facebook']; } ?>">
								<div class="errors"><?php echo form_error('facebook'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Google</label>
							<div class="col-md-8">
								<input type="text" placeholder="google" class="form-control" id="google" name="google" value="<?php  if(isset($_REQUEST['google'])) { echo $_REQUEST['google']; } ?>">
								<div class="errors"><?php echo form_error('google'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Linkedin</label>
							<div class="col-md-8">
								<input type="text" placeholder="linkedin" class="form-control" id="linkedin" name="linkedin" value="<?php  if(isset($_REQUEST['linkedin'])) { echo $_REQUEST['linkedin']; } ?>">
								<div class="errors"><?php echo form_error('linkedin'); ?></div>		
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Twitter</label>
							<div class="col-md-8">
								<input type="text" placeholder="twitter" class="form-control" id="twitter" name="twitter" value="<?php  if(isset($_REQUEST['twitter'])) { echo $_REQUEST['twitter']; } ?>">
								<div class="errors"><?php echo form_error('twitter'); ?></div>		
							</div>
						</div>
 						
		
                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Description</label>
							<div class="col-md-8">
								<textarea  placeholder="Description" class="form-control" id="description" name="description"><?php if(isset($_REQUEST['description'])) { echo $_REQUEST['description']; } ?></textarea>
								<div class="errors"><?php echo form_error('description'); ?></div>	
							</div>
						</div>

	                    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Photo Upload</label>
							<div class="col-md-6" style="padding: 6px;">
							<a href="#"  data-toggle="modal" data-target="#myModalphoto" class="btn btn-pink">Browse</a>
							<input type="hidden" name="photo" id="photo">
							</div>
							<div class="col-md-3" id="showphoto">
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
                            <input type="file" name="ophoto" id="upload1">
							
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
	
	jQuery.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[a-z]/.test(value) // has a lowercase letter
	   && /[A-Z]/.test(value) // has a uppercase letter
       && /\d/.test(value) // has a digit
	   && /([!,%,&,@,#,$,^,*,?,_,~])/.test(value)
});

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
		        url: "<?php echo base_url(); ?>Home/checkMail",
                type: "post",
                data: {
                email: function() {			  
                   return $( "#email" ).val();
                }		
        }
      }
                    },
            'password': {
                required: true,
                minlength: 6,
                maxlength: 16,
				pwcheck:true
            },
			'cpassword': {
                required: true,
                minlength: 6,
                maxlength: 16,
				equalTo: "#password"
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
			},
            'password':
			{
				pwcheck:"Password contain atleast one symbol, uppercase letter, lowercase letter and digit between 6 to 16 character."
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
    $("#showphoto").html("<img class='ephoto'  src="+resp+">");		
 });
});

</script>