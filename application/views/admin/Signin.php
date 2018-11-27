<!-- Recaptha api -->
<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
         var onSuccess = function(response) {
			  $('#hiddenRecaptcha').valid();		              
         };
</script>

    <div id="container" class="cls-container">
        <?php 
	    if($this->session->flashdata('result')) { 
		?>
		<div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h4 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?></h4> 
		</div>
		<?php } ?>
		<div id="bg-overlay"></div>
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		
		    <div class="cls-content-sm panel">
			
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3"><?php 
						$title="title_".$this->session->userdata("site_lang");
						if(isset($front[0]->$title)) { echo $front[0]->$title; } 
		?></h1>
		                <p>Sign In to your account</p>
		            </div>
		            <form id="login-form" action="<?php echo base_url(); ?>Admin/checklogin" method="post">
		                
						<div class="form-group">
		                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" autofocus>
							<div class="errors"><?php echo form_error('email'); ?></div>

		                </div>
		                <div class="form-group">
		                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
							<div class="errors"><?php echo form_error('password'); ?></div>

		                </div>
						
						<?php
			
						if($cooki==2 || $this->input->cookie('pass'))
						{ ?>
						<input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
						<!--
						6Le-wvkSAAAAAPBMRTvw0Q4Muexq9bi0DJwx_mJ- 
						server:  6Ld6PWgUAAAAAP1r9M0r7YOcphKhtKI7Vg-O22wn
						-->
						<div id="recaptcha-demo" class="g-recaptcha" data-sitekey="6Ld6PWgUAAAAAP1r9M0r7YOcphKhtKI7Vg-O22wn" data-callback="onSuccess"></div>
						<?php } ?>
						

		                <div class="checkbox pad-btm text-left">
		                    <input id="demo-form-checkbox" name="checkbox" class="magic-checkbox" type="checkbox">
		                    <label for="demo-form-checkbox">Remember me</label>
		                </div>
		                <button  class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
		            </form>
		        </div>
		
		      
		    </div>
		</div>

    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
	
	<script>

	var jvalidate = $("#login-form").validate({
		ignore: [],
		rules: {                                                                 
			'email': {
				required: true,
				minlength: 3,
				maxlength: 400
			},
			'password': {
				required: true,
				minlength: 5,
				maxlength: 16
			},
			'hiddenRecaptcha': {
                required: function () {
                    if (grecaptcha.getResponse() == '') {
						$("#hiddenRecaptcha-error").html('');
                        return true;
                    } else {
                        return false;
                    }
                }
            }
	
		},
		messages: {
                 'hiddenRecaptcha': {
					 required: 'Captcha is required'
				 }
		}					
	});
</script>
