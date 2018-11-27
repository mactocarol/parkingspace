
<div class="clearfix"></div>

    <section class="login">
      <div class="container">

	  
        <div class="row">
          <div class="login-wrapper">
          <div class="col-md-5">
            <div class="sign_in_frm">
              
            <div class="Feat_head wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">
              <h2><span><?php echo $this->lang->line('login'); ?> </span>
			  <?php echo $this->lang->line('now'); ?></h2>
              <h6><?php echo $this->lang->line('logintoourwebsite'); ?></h6>
            </div>
            <div class="fb_login">
              <div class="fb_icon"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></div>
              <div class="fb_txt"><a href="<?php echo site_url('login-with.php?provider=Facebook');?>"><?php echo $this->lang->line('loginwithfacebook'); ?></a></div>
            </div>
            <div class="Sign_in text-center">
              <span><?php echo $this->lang->line('orsignin'); ?></span>
            </div>
						<form id="loginformid" method="post" action="<?php echo base_url(); ?>Home/checklogin">
            <div class="frm_Fields">
              <div class="form-group">
                <input type="text" class="form-control" id="email" placeholder="<?php echo $this->lang->line('email'); ?>" name="email" value="<?php
							if(isset($_REQUEST['email']))
							{
								echo $_REQUEST['email'];
							}
							else{
							if(get_cookie('uname'))
					{
						echo get_cookie('uname');
					}
							}					
							?>">
				<div class="errors"><?php echo form_error('email'); ?></div>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" placeholder="<?php echo $this->lang->line('password'); ?>" name="password" value="<?php
							if(isset($_REQUEST['password']))
							{
								echo $_REQUEST['password'];
							}
							else{
							if(get_cookie('upassword'))
					{
						echo get_cookie('upassword');
					}
							}
							?>">
              </div>
               <button type="submit" class="btn btn-default"><?php echo $this->lang->line('loginnow'); ?></button>
            </div>
            <div class="Required text-center">
              <p>*Denotes mandatory field.</p>
              <p>**At least one telephone number is required.</p>
            </div>
          </form>
					<a href="<?php echo site_url('Forgot');?>">Forget Password</a>
          </div>
          </div>
          <div class="col-md-2 bdr-pos">
            <div class="bdr">
              <span><?php echo $this->lang->line('or'); ?></span>
            </div>
          </div>
          <div class="col-md-5">
          <div class="sign_in_frm_rgt">
              <form id="regformid" method="post" action="<?php echo base_url(); ?>Home/signup">
            <div class="Feat_head wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">
              <h2><span>Register </span>Now</h2>
              <h6>Required information for account creation</h6>
            </div>
            <div class="frm_Fields">
              <div class="form-group">
                <input type="text" class="form-control" id="username" placeholder="User Name" name="username"  value="<?php if(isset($_REQUEST['username'])) { echo $_REQUEST['username']; } ?>">
				<div class="errors"><?php echo form_error('username'); ?></div>	
              </div>
			  <div class="form-group">
                <input type="text" class="form-control" id="remail" placeholder="Email Address" name="remail"  value="<?php if(isset($_REQUEST['remail'])) { echo $_REQUEST['remail']; } ?>">
				<div class="errors"><?php echo form_error('remail'); ?></div>	
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="rpassword" placeholder="Password" name="rpassword"  value="<?php if(isset($_REQUEST['password'])) { echo $_REQUEST['password']; } ?>">
				<div class="errors"><?php echo form_error('rpassword'); ?></div>	
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword"  value="<?php if(isset($_REQUEST['cpassword'])) { echo $_REQUEST['cpassword']; } ?>">
				<div class="errors"><?php echo form_error('cpassword'); ?></div>	
              </div>
            
               <button type="submit" class="btn btn-default">Sign up Now</button>
            </div>
          </form>
        </div>
        </div>
      </div>
      </div>
    </div>
    </section>
	
	<script>
	
jQuery.validator.addMethod("lettersonly", function(value, element) {
   return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");

jQuery.validator.addMethod("numbers", function (value, element) {
   return this.optional(element) || /^(\d+|\d+,\d{1,2})$/.test(value);
}, "Only numbers allow");
	
	 var jvalidate = $("#loginformid").validate({
                ignore: [],
                rules: {                                                                 
                        'email': {
                                required: true,
								email: true,
                                minlength: 6,
                                maxlength: 300
                        },
						'password': {
                                required: true,
                                minlength: 5,
                                maxlength: 16
                        }
                    },
           messages: {
                        'email': 
						{
							required:"Please enter email."							
						},
						'password': 
						{
							required:"Please enter password."							
						}						
                     }					
                });
		
var jvalidate = $("#regformid").validate({
	
                ignore: [],
                rules: {                                                                 
                        'remail': {
                                required: true,
								email: true,
                                minlength: 6,
                                maxlength: 300,
							    remote: {
		url: "<?php echo base_url(); ?>Home/checkMail",
        type: "post",
        data: {
          email: function() {			  
            return $( "#remail" ).val();
          }
		
        }
      }
                        },
						
						
						'username': {
                                required: true,
                                minlength: 3,
                                maxlength: 50
							   /* remote: {
		url: "<?php echo base_url(); ?>Home/checkUsername",
        type: "post",
        data: {
          username: function() {			  
            return $( "#username" ).val();
          }		
        }
      }*/
                        },
						
						'rpassword': {
                                required: true,
                                minlength: 5,
                                maxlength: 16                              
                        },
						 'cpassword': {
                                required: true,
                                minlength: 5,
                                maxlength: 16,
								equalTo: "#rpassword"                              
                        }
                    },
           messages: {
                        'remail': 
						{
							required:"Please enter email.",
                            email:"Please enter valid email",
							remote:"Account is already registered with this email id"							
						}						
                     }					
                });		

	</script>