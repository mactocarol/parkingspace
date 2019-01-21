
    <section class="contact_us_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breedcrumb text-center">
                        <ul>
                            <li><a href="#">Pewnyparking</a></li>
                            <li><a href="#">Withdrawal</a></li>
                        </ul>
                        <h2>Withdrawal methods</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="clearfix"></div>

<section class="info dash">
<div class="container">
    <div class="bx_shdo">
        <div class="dash_sbt text-center">
            <button type="button" class="verfy skip back" style="display: none;">Back</button>
        </div>
        
        <div class="mainbox">
            <div class="row">
               
                <div class="col-md-12">
                    <div class="credit">
                        <h4><span>Withdrawal methods</span></h4>
                    </div>
                    <div class="wthdrw_sec text-center">
                        <img src="<?php echo base_url('frontend');?>/images/withdraw.png">
                        <div class="wthdrw_txt">
                            <h4>How do we pay you</h4>
                            <p>Are you preffered withdrawal method below</p>
                        </div>
                        <div class="dash_sbt text-center">
                            <button type="button" class="verfy vrfyshow"><img src="<?php echo base_url('frontend');?>/images/iconmonstr-briefcase-9-32.png"> Add Bank Account</button>
                            <button type="button" class="verfy paypalshow"><img src="<?php echo base_url('frontend');?>/images/iconmonstr-paypal-1-32.png"> Add Paypal Account</button>
                        </div>
                    </div>
                    <div class="note">
                        <div class="note_icon">
                            <img src="<?php echo base_url('frontend');?>/images/note.png">
                        </div>
                        <div class="note_txt">
                            <h4>Please note that Paypal charge 3.2%on all withdrawals</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmotempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <!--<div class="dash_sbt text-center">
                        <button type="button" class="verfy skip">Skip</button>
                    </div>-->
                </div>
            </div>
            <!-- End of row main -->
        </div>
        <!--end of div main -->

<div class="dash_dtl_frm mainbxshow">
<form name="valid-form" id="valid-form" method="post" action="<?php echo site_url('Dashboard/withdraw');?>">
    <div class="credit">
        <div class="row bs-example-popover">
            <div class="col-md-4">
                <div class="popover left">
                    <div class="arrow"></div>
                    <div class="popover-content">
                        <p>Your bank account information.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h4><span>Bank account</span> information</h4>
                <div class="dtl-Sec">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="email">Bank Name</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="bankname" placeholder="Bank Name" name="bank_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="email">IFSC Code</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="ifsc" placeholder="Example: 400311" name="ifsc">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="email">Bank Account Number</label>
                            <div class="form-group">
                                <input type="text" class="form-control" id="acc_no" placeholder="Example: 01234567" name="acc_no">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of dtl sec -->
            </div>
        </div>

    </div>
    <!-- End of dtl sec -->

<div class="dtl-Sec wdh">
    <div class="row bs-example-popover">
        <div class="col-md-4">
            <div class="popover left">
                <div class="arrow"></div>
                <div class="popover-content">
                    <p>Address the account is registered to.</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="credit">
                <h4><span>Account holder details</span></h4>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="email">First Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="acc_fname" placeholder="Enter First Name" name="acc_fname">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email">Last Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="acc_lname" placeholder="Enter Last Name" name="acc_lname">
                    </div>
                </div>
            </div>
            <div class="find_add_hide">
                <div class="row">
                    <div class="col-md-6">
                        <label for="address">Select an address</label>
                        <div class="form-group">
                            <div class="select">
                                <select name="preaddress" id="preaddress">
                                    <option value="">Please Select</option>
                                    <option >123456, RR 1, Avery</option>
                                    <option >sweethome, lonawaka`, indore</option>
                                    <option >12345, The Tri Centre, New Bridge Square, Swindon</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="addrs">
                            <i class="fa fa-plus-circle adr addnw" aria-hidden="true"></i><span class="addnw">Add new address</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="find_adr_show">
                <div class="row">
                    <div class="col-md-6">
                        <label for="address">Select an address</label>
                        <div class="form-group">
                            <input type="text" name="address" id="address" placeholder="e.g. SE167EF" class="fnd">
                            <!--<button type="button" class="find_adr">Find Address</button>-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="address">Country</label>
                        <div class="form-group">
                            <div class="select">
                                <select class="selectpicker" name="country" data-style="btn-info custom" data-max-options="3" data-live-search="true">
                                        <option value="">Select</option>
                                        <option>Polland</option>
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>Australia</option>
                                        <option>New Zealand</option>
                                        <option>Ireland</option>
                                        <option>Netherlands</option>
                                        <option>France</option>
                                        <option>Spain</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="dash_sbt text-left">
                        <button type="button" class="verfy adsbt" data-toggle="modal" data-target="#myModalbig" onclick="precheck();">Submit</button>
                    </div>
                </div>
            </div>
             <!-- Modal -->
  <div class="modal fade" id="myModalbig" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-center">
            <img src="<?php echo base_url('frontend');?>/images/iconmonstr-lock-31-72.png" class="img-responsive">
          <h4 class="modal-title">Bank account verification</h4>
        </div>
        <div class="modal-body modalcnt">
          <div class="attention_img">
              <img src="<?php echo base_url('frontend');?>/images/if_attention_2639770.png" class="img-responsive">
          </div>
          <p>To verify the account details you have entered are correct, please ensure that the details below are correct for your bank.</p>
          <h4>Bank Name: <span id="bank_name"></span></h4>
          <p><strong>Account number: <span id="accno"></span></strong></p>
          <p><strong>IFSC Code: <span id="ifsccode"></span></strong></p>
          <p><strong>Account Holder: <span id="accname"></span></strong></p>
          <div class="bordr"></div>
          <div class="row vertical-align">
                    <div class="col-xs-1 text-center">
                       <img src="<?php echo base_url('frontend');?>/images/info.png" class="img-responsive">
                    </div>
                    <div class="col-xs-11">
                       <p>Please ensure that your details are correct, this is essential to be able to make withdrawals from your account.</p>
                    </div>
                 </div>
        </div>
        <div class="modal-footer">
        <div class="dash_sbt sec text-center">
          <button type="submit" class="verfy crct">My details are correct</button>
          <button type="button" class="verfy" data-dismiss="modal">I need to go back</button>
      </div>
        </div>
      </div>
    </div>
  </div>
        </div>
    </div>
</div>
</form>
</div>
<!--end of mainbx show -->

<div class="paypalbx">
    <div class="credit">
        <h4><span>Verify your Paypal email address</span></h4>
    </div>
    <div class="verify_note">
        <p>Please <strong>verify your Paypal email address</strong> so we can confirm your identity and make it easy to withdraw on JustPark in the future.</p>
        <p>You will <strong>not</strong> be charged anything by JustPark or PayPal for this.</p>
    </div>
    <div class="dash_sbt text-left">
        <button type="button" class="verfy continue">Continue</button>
    </div>
</div>
</div>
        </div>
    </section>
   
    <script type="text/javascript">
        $(".vrfyshow").click(function() {
            $(".back").show("slow")
            $(".mainbox").hide("slow")
            $(".mainbxshow").show("slow")
        });
    </script>
    <script type="text/javascript">
        $(".addnw").click(function() {
            $(".back").show("slow")
            $(".find_add_hide").hide("slow")
            $(".find_adr_show").show("slow")
        });
    </script>
    <script type="text/javascript">
        $(".paypalshow").click(function() {
            $(".back").show("slow")
            $(".mainbox").hide("slow")
            $(".mainbxshow").hide("slow")
            $(".paypalbx").show("slow")
        });
    </script>
    
    <script type="text/javascript">
        $(".back").click(function() {
            $(".back").hide("slow")
            $(".mainbox").show("slow")
            $(".mainbxshow").hide("slow")
            $(".paypalbx").hide("slow")
        });
    </script>
    <script>
        function precheck(){
            //alert($('#bankname').val());
            $('#bank_name').html($('#bankname').val());
            $('#ifsccode').html($('#ifsc').val());
            $('#accno').html($('#acc_no').val());
            var address = ($('#preaddress').val()) ? $('#preaddress').val() : $('#address').val();
            $('#accname').html($('#acc_fname').val()+' '+$('#acc_fname').val()+', '+address);
        }
    </script>
    
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
			'bank_name': {
				required: true,
				minlength: 2				
			},
            'ifsc': {
				required: true,
				minlength: 2				
			},
            'acc_no': {
				required: true,
				minlength: 2				
			},
            'acc_fname': {
				required: true,
				minlength: 2				
			},
            'acc_lname': {
				required: true,
				minlength: 2				
			}
            
		},
		messages: {
			
		}					
	});  



</script>
    