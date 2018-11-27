
<section class="login">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
                <div class="panel-body">
                  <?php 
                    if($this->session->flashdata('resultmsg')) { 
                    ?>
                    <div  class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
                                   <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                   <h6 class="errormsgs"> <?php echo $this->session->flashdata('messsage'); ?></h6> 
                    </div>
                    <?php } ?>	  
                  <div class="text-center">
                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <h2 class="text-center">Forgot Password?</h2>
                    <p>You can reset your password here.</p>
                    <div class="panel-body">
      
                      <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="<?php echo site_url('Forgot/forgotpassword'); ?>">
      
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                            <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                          </div>
                        </div>
                        <div class="form-group">
                          <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                        </div>
                        
                        <input type="hidden" class="hide" name="token" id="token" value=""> 
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    </section>