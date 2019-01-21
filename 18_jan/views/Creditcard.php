
<!--end of col -->
<div class="col-md-8 col-sm-6">       
    <div class="credit">
        <h4><span>Credit/Debit Cards</span></h4>
        <div class="notify">
            <div class="dash_sbt">
                <p>Below a list of all the credit/debit cards you have registered with pweny park
                    <a href="<?php echo site_url('Dashboard/add_card');?>" ><button type="button" class="verfy"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</button></a>
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
     <?php 
        if($this->session->flashdata('resultmsg')) { 
        ?>
        <div  class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
                       <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                       <h4 class="errormsgs"> <?php echo $this->session->flashdata('messsage'); ?></h4> 
        </div>
        <?php } ?>
    <div class="park_panel">
        <div class="panel_heading">
          <h4>Credit/Debit Cards</h4>
        </div>
        <div class="Dta_table">
			<?php if(!empty($cards)) { ?>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name on Card</th>
                        <th>Card No.</th>
                        <th>Country</th>
                        <th>Postal Code</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($cards)) {
                    foreach($cards as $row){
                    ?>
                    <tr>
                        <td><?=($row->f_name) ? $row->f_name.' '.$row->l_name : '' ?></td>
                        <td><?=($row->card_no) ? 'xxxxxxxx'.substr (base64_decode($row->card_no), -4) : '' ?></td>
                        <td><?=($row->country) ? $row->country : '' ?></td>
                        <td><?=($row->postal_code) ? $row->postal_code : '' ?></td>
                        <td>
							<?=($row->isPrimary) ? '<button class="btn btn-success">Primary</button>' : '<a href="'.site_url('Dashboard/creditcard/'.$row->id).'"><u>Set as Primary</u></a>' ?>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="<?php echo base_url(); ?>Dashboard/cardDelete/<?php echo $row->id;?>" onclick=" var c = confirm('Are you sure want to delete?'); if(!c) return false;"><i class="fa fa-trash-o" aria-hidden="true"></i></i></a>
						</td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
			<?php } else { ?>
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
        </div>
    </div>
                    
</div>



      
        
