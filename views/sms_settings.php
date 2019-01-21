<div class="col-md-8">
  <div class="credit">
      <h4><span>SMS</span> Settings</h4>
      <div class="notify">
					<?php 
        if($this->session->flashdata('resultmsg')) { 
        ?>
        <div  class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
                       <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                       <h4 class="errormsgs"> <?php echo $this->session->flashdata('messsage'); ?></h4> 
        </div>
        <?php } ?>
					<form name="" method="post" action="<?php echo site_url('Dashboard/sms_settings');?>">
          <div class="chiller_cb">    
            <input id="myCheckbox" type="checkbox" name="newbooking" <?php echo (isset($settings->newbooking) && $settings->newbooking == '1') ? 'checked' : ''; ?>>
            <label for="myCheckbox">Opt-in to receive sms on new booking received.</label>
            <span></span>
          </div>
         <div class="chiller_cb">    
            <input id="myCheckbox1" type="checkbox" name="newmessage" <?php echo (isset($settings->newmessage) && $settings->newmessage == '1') ? 'checked' : ''; ?>>
            <label for="myCheckbox1">Opt-in to receive sms on new message received.</label>
            <span></span>
          </div>
          <div class="chiller_cb">
            <input id="myCheckbox2" type="checkbox" name="upcomingbooking" <?php echo (isset($settings->upcomingbooking) && $settings->upcomingbooking == '1') ? 'checked' : ''; ?>>
            <label for="myCheckbox2">Opt-in to receive free reminder texts for upcomingbooking</label>
            <span></span>
          </div>
          <div class="chiller_cb">
            <input id="myCheckbox3" type="checkbox" name="paymentconfirmation" <?php echo (isset($settings->paymentconfirmation) && $settings->paymentconfirmation == '1') ? 'checked' : ''; ?>>
            <label for="myCheckbox3">Opt-in to receive free Payment confirmation texts for pay by phone</label>
            <span></span>
          </div>
          <div class="dash_sbt">
            <button type="submit" class="verfy">Update</button>
          </div>
        </form>
						
      </div>
</div>
</div>
     