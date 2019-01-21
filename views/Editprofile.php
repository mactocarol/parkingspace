
                  <div class="col-md-8 col-sm-6">
                     <div class="credit">
                        <h4><span>Profile</span> Setting</h4>
                     </div>
					  <form action="<?php echo base_url(); ?>Dashboard/saveprofile" id="valid-form" class="" method="post" enctype="multipart/form-data">
                     <div class="img_upload">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="small-12 medium-2 large-2 columns">
                                 <div class="circle">
                                    <!-- User Profile Image -->
									<span id="showphoto">
									
<?php
if(isset($user[0]->photo))
{
if($user[0]->photo!="")
{
?>
 <a href="<?php echo base_url(); ?>upload/user/<?php echo $user[0]->ophoto; ?>" data-lightbox="example-set"><img class="profile-pic" src="<?php echo base_url(); ?>upload/user/<?php echo $user[0]->photo; ?>" class="img-responsive"></a>
<?php 
}
else{
	?>
	<a href="<?php echo base_url(); ?>frontend/images/doe.png" data-lightbox="example-set"><img class="profile-pic" src="<?php echo base_url(); ?>frontend/images/doe.png" class="img-responsive"></a>
	<?php
}
}
?>
									
                                    
									</span>
									
                                    <div class="p-image">
                                      <input type="hidden" name="photo" id="photo">
									  <input type="hidden" name="hphoto" id="hphoto" value="<?php if(isset($user[0]->photo)) { echo $user[0]->photo; } ?>">
                                      <button type="button" href="#"  data-toggle="modal" data-target="#myModalphoto1" class="verfy upload-button">Change Photo</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="dash_dtl_frm">
                       <?php
					   $fname="";
					   $lname="";
					   if(isset($user[0]->name))
					   {
						   if($user[0]->name!="")
						   {
							   $fname = explode(" ", $user[0]->name);
							   $lname = array_pop($fname);
							   if(isset($fname[0]))
							   $fname=$fname[0];
						       else
							   $fname=$user[0]->name;
						   }
					   }
					   ?>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Your Full Name</label>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <input type="text" class="form-control"  placeholder="First Name" name="first" id="first" value="<?php echo $fname; ?>">
									<div class="errors"><?php echo form_error('first'); ?></div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Last Name" name="last" id="last" value="<?php echo $lname; ?>">
									<div class="errors"><?php echo form_error('last'); ?></div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Company Name</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="cname" placeholder="Enter Company Name" name="cname" value="<?php if(isset($user[0]->companyname)) { echo $user[0]->companyname; } ?>">
									<div class="errors"><?php echo form_error('cname'); ?></div>
                                 </div>
                                 <p>If applicable and you are representing an organization</p>
                                 <div class="notify">
                                    <div class="chiller_cb">
                                       <input id="myCheckbox" type="checkbox" name="vat" id="vat" <?php if(isset($user[0]->vat)) { if($user[0]->vat==1) { echo "checked"; } } ?> >
                                       <label for="myCheckbox">
                                          Are you VAT registered<!--  -->
                                       </label>
                                       <span></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Password</label>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="password" placeholder="Enter Password" name="password">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="cpassword" placeholder="Re Enter Password" name="cpassword">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <p>Please Enter a new password in both fields if you wish to change your Password.</p>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Date Of Birth</label>
                                 <div class="form-group">
                                    <input type="text" class="birthdatepicker form-control" id="birthdate" placeholder="Enter Date of Birth" name="birthdate" value="<?php if(isset($user[0]->birthdate)) { echo $user[0]->birthdate; } ?>">
									<div class="errors"><?php echo form_error('birthdate'); ?></div>
                                 </div>
                              </div>
                           </div>
                           <div class="dtl-Sec">
                             <div class="credit">
                                <h4><span>Contact</span> Details (Private)</h4>
                             </div>
                             <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Personal Website</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="website" placeholder="Enter Personal Website" name="website" value="<?php if(isset($user[0]->website)) { echo $user[0]->website; } ?>">
									<div class="errors"><?php echo form_error('website'); ?></div>
                                 </div>
                              </div>
                              </div>
                              <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Your Email</label>
                                 <div class="form-group">
                                    <input readonly type="text" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php if(isset($user[0]->email)) { echo $user[0]->email; } ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Phone</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="contact" placeholder="Enter Phone" name="contact" value="<?php if(isset($user[0]->contact)) { echo $user[0]->contact; } ?>">
									<div class="errors"><?php echo form_error('contact'); ?></div>
                                 </div>
                              </div>
                           </div>
                         </div>
                         <div class="dtl-Sec">
                             <div class="credit">
                                <h4><span>Home</span> Address (Private)</h4>
                             </div>
                             <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Country</label>
                                 <div class="form-group">
                               <div class="select">
                                <select class="selectpicker" data-style="btn-info custom"  data-max-options="3" data-live-search="true" name="country" id="country">
                                 
                                      <option>Select Country</option>
                                     <?php
									 if(isset($country))
									 {
										 foreach($country as $c)
										 {
											?>
											<option value="<?php echo $c->countryID; ?>" <?php if(isset($user[0]->country)) { if($user[0]->country==$c->countryID) { echo "selected"; } } ?> ><?php echo $c->countryName; ?></option>
                                            <?php											
										 }
									 }
									 ?>
                                 
                                </select>
								<div class="errors"><?php echo form_error('country'); ?></div>
                              </div>
                            </div>
                              </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4">
                                  <label for="email">House Name/No.</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="housename" placeholder="House Name/No." name="housename" value="<?php if(isset($user[0]->housename)) { echo $user[0]->housename; }  ?>">
									<div class="errors"><?php echo form_error('housename'); ?></div>
                                 </div>
                                </div>
                                <div class="col-md-8">
                                  <label for="email">Street Address</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="address" placeholder="Street Address" name="address" value="<?php if(isset($user[0]->address)) { echo $user[0]->address; }  ?>">
									<div class="errors"><?php echo form_error('address'); ?></div>
                                 </div>
                                </div>
                                 </div>
                                 <div class="row">
                                <div class="col-md-4">
                                  <label for="email">City</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php if(isset($user[0]->city)) { echo $user[0]->city; }  ?>">
									<div class="errors"><?php echo form_error('city'); ?></div>
                                 </div>
                                </div>
                                <div class="col-md-4">
                                  <label for="email">State</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php if(isset($user[0]->state)) { echo $user[0]->state; }  ?>">
									<div class="errors"><?php echo form_error('state'); ?></div>
                                 </div>
                                </div>
                                <div class="col-md-4">
                                  <label for="email">Postal Code</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="zipcode" placeholder="Postal Code" name="zipcode" value="<?php if(isset($user[0]->zipcode)) { echo $user[0]->zipcode; }  ?>">
									<div class="errors"><?php echo form_error('zipcode'); ?></div>
                                 </div>
                                </div>
                                 </div>
                             </div>
                              <div class="dtl-Sec">
                             <div class="credit">
                                <h4><span>Payment</span> Options (Private)</h4>
                             </div>
                             <div class="row">
                              <div class="col-md-12">
                                 <label for="email">payment</label>
                                 <div class="form-group">
                             <div class="select">
                                <select name="pay" id="pay">
                                  <option>Please Select</option>
                                <?php
								if(isset($pay))
								{
									foreach($pay as $p)
									{
										?>
										<option  value="<?php echo $p->id; ?>" <?php if(isset($user[0]->pay)) { if($user[0]->pay==$p->id) { echo "selected"; } } ?>><?php echo $p->name; ?></option>
										<?php
									}
								}
								?>
                                </select>
								<div class="errors"><?php echo form_error('pay'); ?></div>
                              </div>
                            </div>
                              </div>
                              <div class="col-md-12">
                                 <p>How often we pay out your Earnings for renting out your parking space.</p>
                              </div>
                              </div>
                             </div>
                             <div class="dtl-Sec">
                             <div class="credit">
                                <h4><span>Additional</span> Information (Private)</h4>
                             </div>
                             <div class="row">
                              <div class="col-md-4">
                                 <label for="email">Time Zone</label>
                                 <div class="form-group">
                             <div class="select">
                                <select name="timezone" id="timezone" class="selectpicker" data-style="btn-info custom"  data-max-options="3" data-live-search="true">
                                  <option>Select Time-Zone</option>
                                  <?php
								if(isset($timezone))
								{
									foreach($timezone as $t)
									{
										?>
										<option  value="<?php echo $t->id; ?>" <?php if(isset($user[0]->timezone)) { if($user[0]->timezone==$t->id) { echo "selected"; } } ?>><?php echo $t->name; ?></option>
										<?php
									}
								}
								?>
                                </select>
								<div class="errors"><?php echo form_error('timezone'); ?></div>
                              </div>
                            </div>
                              </div>
                              <div class="col-md-4">
                                 <label for="email">Select Gender</label>
                                 <div class="form-group">
                             <div class="select">
                                <select name="gender" id="gender">
                                  <option>Select Gender</option>
                                  <option value="male" <?php if(isset($user[0]->gender)) { if($user[0]->gender=='male') { echo "selected"; } } ?>>Male</option>
                                  <option value="female" <?php if(isset($user[0]->gender)) { if($user[0]->gender=='female') { echo "selected"; } } ?>>Female</option>
                                  <option value="both" <?php if(isset($user[0]->gender)) { if($user[0]->gender=='both') { echo "selected"; } } ?>>Both</option>
                                </select>
								<div class="errors"><?php echo form_error('gender'); ?></div>
                              </div>
                            </div>
                              </div>
                              <div class="col-md-4">
                                 <label for="email">Occupation</label>
                                 <div class="form-group">
                             <div class="select">
                                <select name="occupation" id="occupation" class="selectpicker" data-style="btn-info custom"  data-max-options="3" data-live-search="true">
                                  <option>Select Occupation</option>
                                    <?php
								if(isset($occupation))
								{
									foreach($occupation as $o)
									{
										?>
										<option  value="<?php echo $o->id; ?>" <?php if(isset($user[0]->occupation)) { if($user[0]->occupation==$o->id) { echo "selected"; } } ?>><?php echo $o->name; ?></option>
										<?php
									}
								}
								?>
                                </select>
								<div class="errors"><?php echo form_error('occupation'); ?></div>
                              </div>
                            </div>
                              </div>
                              </div>
                             </div>
                             <div class="dtl-Sec">
                             <div class="credit">
                                <h4><span>Social Media</span> Connections (Private)</h4>
                             </div>
                             <div class="dash_sbt">
							 <?php if(isset($user[0]->fb))
							 {
								 if($user[0]->fb!=1)
								 { ?>
                                <button type="button" class="verfy Fb"><i class="fa fa-facebook-official" aria-hidden="true"></i> Connect with facebook</button>
							 <?php }
							 else {
								?>
                                <button type="button" class="verfy"><i class="fa fa-check" aria-hidden="true"></i> You are connected with facebook</button>
							 <?php 
							 }
							 } ?>
                              </div>
                             </div>
                             <div class="row">
                              <div class="col-md-12">
                                 <div class="dash_sbt sec Dash_brd_sbt">
                                    <button type="submit" class="btn btn-success">Update</button>
									
									<?php if($user[0]->status==0 || $user[0]->status==1)
									{ ?>
                                    <a href="<?php echo base_url(); ?>Dashboard/deactive" class="btn btn-danger">Deactivate Your Account</a>
									<?php }  else { ?>
									<a href="<?php echo base_url(); ?>Dashboard/deactive" class="btn btn-primary">Activate Your Account</a>
									<?php } ?>
                                 </div>
                              </div>
                           </div>
						   
	<div id="myModalphoto1" class="modal fade" role="dialog">
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
						<div class="col-md-12" >						
						<div class="col-md-3">
                                 <label style="margin-top: 12px;" for="email">Select Photo</label>
                        </div>
						<div class="col-md-5">
                            <input type="file" class="form-control" name="ophoto" id="upload1">
							<input type="hidden" id="hophoto" name="hophoto" value="<?php if(isset($user[0]->ophoto)) { echo $user[0]->ophoto; } ?>">
						</div>
                        <div class="col-md-4">						
                            <button type="button" class="verfy upload-result1">Upload Photo</button>
                        </div>
						</div>
                        <div class="col-md-12">
                            <div id="upload-demo1" ></div>
							<div class="col-md-4 col-md-offset-5">
							<button data-dismiss="modal" type="button" class="verfy upload-result1">Save Photo</button>
							</div>
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
                     </div>
                  </div>
				  
				  

				  

<script type="text/javascript">
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
			'fname': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			'lname': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
			//'cname': {
			//	required: true,
			//	minlength: 2,
			//	maxlength: 400
			//},
			'birthdate': {
				required: true
			},
			'cpassword': {
			required: function(element){
            return $("#password").val()!="";
        },
		minlength: 5,
        maxlength: 15,
		equalTo: "#password"
        		
			},
			'contact': {
               required: true,
               minlength: 5,
               maxlength: 15,
			   numbers: true
            },
			'state': {
               required: true,
               minlength: 2,
               maxlength: 300
            },
			'housename': {
               required: true,
               minlength: 2,
               maxlength: 300
            },
			'address': {
               required: true,
               minlength: 2,
               maxlength: 400
            },
			'city': {
               required: true,
               minlength: 2,
               maxlength: 300
            },
			'zipcode': {
               required: true,
               minlength: 2,
               maxlength: 12
            },
			'country': {
               required: true
            },
			'pay': {
               required: true
            },
			'timezone': {
               required: true
            },
			'occupation': {
               required: true
            },
			'gender': {
               required: true
            },
			'website': {
				required:true,
				url:true
			}
			
		},
		messages: {
			
		}					
	});  

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
    $("#showphoto").html("<img class='ephoto' src="+resp+">"); 
 });
});

</script>
            