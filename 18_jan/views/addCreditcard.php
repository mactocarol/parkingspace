<div class="col-md-8 col-sm-6">
                     <div class="credit">
                        <h4><span>Add a Credit/Debit card</span></h4>
                        <div class="card_paymnt">
                           <div class="lock_icon">
                              <img src="<?php echo base_url();?>/frontend/images/lock.png">
                           </div>
                           <div class="payment_text">
                              <h5>Secure credit card payment</h5>
                              <p>This is a secure 128-bit SSL encrypted payment</p>
                           </div>
                        </div>
                     </div>
                     <div class="payment-info">
                        <form name="card-form" id="card-form" method="post" action="<?php echo (isset($type) && $type != false) ? site_url('Dashboard/add_card') : site_url('Dashboard/validatecard');?>">
                           <div class="payment_head">
                              <h4>Payment Information</h4>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Full Name on Card</label>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="f_name" placeholder="First Name" name="f_name"  value="<?php if(isset($_REQUEST['f_name'])) { echo $_REQUEST['f_name']; } ?>">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="l_name" placeholder="Last Name" name="l_name"  value="<?php if(isset($_REQUEST['l_name'])) { echo $_REQUEST['l_name']; } ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <label for="email">Card Number</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="card_no" placeholder="4113 2252 5255 4833" name="card_no"  value="<?php if(isset($_REQUEST['card_no'])) { echo $_REQUEST['card_no']; } ?>">
                                    <?php if(isset($type)) {?>
                                    <?php echo (isset($type) && $type != false) ? '<font color="green">'.ucwords($type).' detected. card number is valid</font>' : '<font color="red">This card number is invalid</font>';?>
                                    <?php } ?>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label for="email">Expiration Date</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="card_exp" placeholder="05 / 2018" name="card_exp"  value="<?php if(isset($_REQUEST['card_exp'])) { echo $_REQUEST['card_exp']; } ?>">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label for="email">CVV</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="card_cvv" placeholder="CVV" name="card_cvv"  value="<?php if(isset($_REQUEST['card_cvv'])) { echo $_REQUEST['card_cvv']; } ?>">
                                 </div>
                              </div>
                           </div>
                           <div class="payment_head bill">
                              <h4>Billing Address</h4>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label for="email">Country</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="country" placeholder="Enter Country Name" name="country" value="<?php if(isset($_REQUEST['country'])) { echo $_REQUEST['country']; } ?>">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label for="email">Postal Code</label>
                                 <div class="form-group">
                                    <input type="text" class="form-control" id="postal_code" placeholder="Enter Postal Code" name="postal_code" value="<?php if(isset($_REQUEST['postal_code'])) { echo $_REQUEST['postal_code']; } ?>">
                                 </div>
                              </div>
                           </div>
                           <!--<p>This card will be your primary payment source.</p>-->
                           <?php if(count($cards) == 0){ ?>
                           <div class="alert_bx">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="alert alert-info" role="alert">
                                       <div class="row vertical-align">
                                          <div class="col-xs-1 text-center">
                                             <img src="<?php echo base_url();?>/frontend/images/info.png" class="img-responsive">
                                          </div>
                                          <div class="col-xs-11">
                                             <p>You have no payment method associated with your account</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php } ?>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="dash_sbt sec">
                                    
                                    <?php echo (isset($type) && $type != false) ? '<button type="submit" class="verfy">Save</button>' : '<button type="submit" class="verfy">Verify Payment Details</button>';?>
                                    <a href="<?php echo site_url('Dashboard/creditcard');?>"><button type="button" class="cnsl">Cancel</button></a>
                                 </div>
                              </div>
                           </div>
                        </form>
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

	var jvalidate = $("#card-form").validate({
		ignore: [],
		rules: {                                                                 
			'f_name': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
            'l_name': {
				required: true,
				minlength: 2,
				maxlength: 100
			},				
			'card_no': {
				required: true,                
			},
            'card_exp': {
				required: true,                               
			},
            'card_cvv': {
				required: true,                
			},
			'country': {
				required: true
			},			
			'postal_code': {
				required: true,				
				numbers:true
			}			

		},
		messages: {
			
		}					
	}); 
</script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $('#card_no').inputmask({"mask": "9999 9999 9999 9999"});
    $('#card_exp').inputmask({"mask": "99 / 9999"});
    $('#card_cvv').inputmask({"mask": "999"});
</script>