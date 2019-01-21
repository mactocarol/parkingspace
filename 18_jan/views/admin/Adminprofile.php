         <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">
                    
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
                    
					    <!-- Contact Panel -->
					    <!---------------------------------->
					    <div class="panel">
					        <div class="panel-body">
					
					            <h3>Admin Profile</h3>
					            <div class="row">
								
					                <div class="col-sm-6">
									
					            <p>Edit your profile</p>
					                    <form id="profile-form" class="form-horizontal" action="<?php echo base_url(); ?>Admin/updateadmin" method="post" enctype="multipart/form-data">
					                        	  <input type="hidden" id="id" name="id" value="<?php if(isset($admin[0]->id)){echo $admin[0]->id; }  ?>">	
												
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">Name</label>
													<div class="col-md-8">
														<input type="text" id="name" name="name" class="form-control" id="Name" value="<?php if(isset($admin[0]->name)){echo $admin[0]->name; } ?>">
													  <div class="errorval"><?php echo form_error('name'); ?></div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileLastName">Email</label>
													<div class="col-md-8">
														<input type="text" id="email" name="email" class="form-control" id="Email" value="<?php if(isset($admin[0]->email)){ echo $admin[0]->email; } ?>">
													    <div class="errorval"><?php echo form_error('email'); ?></div>
													</div>
												</div>
													<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Photo Upload</label>
							<div class="col-md-5" style="padding: 6px;">
							<a href="#" data-toggle="modal" data-target="#myModalphoto" class="btn btn-pink">Browse</a>
							<input type="hidden" name="photo" id="photo">
							<input value="<?php if(isset($admin[0]->photo)) { echo $admin[0]->photo; } ?>" type="hidden" id="photo1" name="photo1"/>

							</div>
							<div class="col-md-4">
							<?php if(isset($admin[0]->photo)) {
								if($admin[0]->photo!="")
								{ ?>
							<a href="<?php echo base_url(); ?>images/<?php echo $admin[0]->photo; ?>" data-lightbox="example-set"><img src="<?php echo base_url(); ?>images/<?php echo $admin[0]->photo;  ?>"><a/>
							<?php } } ?>
							</div>
						</div>
					                        
					                        <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
					                    </form>
					                </div>
					                <div class="col-sm-6">
									 <p>Change your password</p>
					                  <form id="change_formc" role="form" class="form-horizontal" action="<?php echo base_url(); ?>Admin/change" method="post">
					                       <div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPassword">Current Password</label>
													<div class="col-md-8">
														<input type="password" placeholder="Enter Current Password" class="form-control" id="opassword" name="opassword" value="<?php
							if(isset($_REQUEST['opassword']))
							{
								echo $_REQUEST['opassword'];
							}
							?>" />
							<div class="errorval"><?php echo form_error('opassword'); ?></div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat">Password</label>
													<div class="col-md-8">
														<input type="password"  placeholder="Enter New Password" class="form-control" id="password" name="password" value="<?php
							if(isset($_REQUEST['password']))
							{
								echo $_REQUEST['password'];
							}
							?>">
							 
											<div class="errorval"><?php echo form_error('password'); ?></div>
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat">Confirm password</label>
													<div class="col-md-8">
														<input type="password" placeholder="Enter Confirm Password" class="form-control" name="cpassword" id="cpassword" value="<?php
							if(isset($_REQUEST['cpassword']))
							{
								echo $_REQUEST['cpassword'];
							}
							?>">
														
										<div class="errorval"><?php echo form_error('cpassword'); ?>	
													</div>
												</div>
												</div>
					                        
					                        <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
					                   </form>
					                </div>
					            </div>
					        </div>
					    </div>
					    <!---------------------------------->
					
					
					    
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

jQuery.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[a-z]/.test(value) // has a lowercase letter
	   && /[A-Z]/.test(value) // has a uppercase letter
       && /\d/.test(value) // has a digit
	   && /([!,%,&,@,#,$,^,*,?,_,~])/.test(value)
}); 
	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");

	var jvalidate = $("#profile-form").validate({
		ignore: [],
		rules: {                                                                 
			            'name': {
                                required: true,
                                minlength: 3,
                                maxlength: 100
								//lettersonly: true
                        },
						 'email': {
                                required: true,
                                minlength: 6,
                                maxlength: 200,
								email: true,
	                    }
	
		},
		messages: {

		}					
	});
	
	
	            var jvalidate = $("#change_formc").validate({
                ignore: [],
                rules: {                                                                 
                        'opassword': {
                                required: true,
                                minlength: 5,
                                maxlength: 16
                        },
						 'password': {
                                required: true,
                                minlength: 5,
                                maxlength: 16,
								pwcheck:true
                        },
                        'cpassword': {
                                required: true,
                                minlength: 5,
                                maxlength: 16,
                                equalTo: "#password"
                        }
                    },
           messages: {
                        'opassword': 
						{
							required:"Please enter current password.",							
						},
						'password':  
						{
							required:"Please enter new password.",							
							pwcheck:"Password contain atleast one symbol, uppercase letter, lowercase letter and digit between 5 to 16 character."
						},
						'cpassword': 
						{
						    required:"Please enter confirm password.",
                            equalTo:"New & confirm password should be equal." 							
						}
                     }					
                });  
</script>
			 
<script type="text/javascript">
$uploadCrop1 = $('#upload-demo1').croppie({
    enableExif: true,
    viewport: {
        width: 70,
        height: 70,
        type: 'square'
    },
    boundary: {
        width: 120,
        height: 120
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