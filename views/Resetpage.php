
<div class="clearfix"></div>
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
                    <h3><i class="fa fa-unlock-alt fa-4x"></i></h3>
                    <h2 class="text-center">Reset Password</h2>
                    <p>You can reset your password here.</p>
                    <div class="panel-body">
      
                      <form id="register-form" role="form" autocomplete="off" class="form" method="post" action="<?php echo site_url('Forgot/resetpassword');?>">
      
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-code-fork ret" aria-hidden="true"></i></span>
                            <input id="code" name="code" placeholder="Enter Code" class="form-control"  type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key ret" aria-hidden="true"></i></span>
                            <input id="pass" name="password" placeholder="Enter Password" class="form-control"  type="password">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key ret" aria-hidden="true"></i></span>
                            <input id="pass" name="cpassword" placeholder="Enter Confirm Password" class="form-control"  type="password">
                          </div>
                        </div>
                        <div class="form-group">
                          <a href="resetpassword"><input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Submit" type="submit">
                        </a></div>
                        
                        <input type="hidden" class="hide" name="id" id="token" value="<?php echo $this->uri->segment('3'); ?>"> 
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    </section>
