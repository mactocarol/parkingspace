<?php die; ?>
 <div id="content-container">
  
                <div id="page-head">
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow"><?php echo $controlnamehead; ?></h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="#"><?php echo $control; ?></a></li>
					<li class="active"><?php echo $controlnamehead; ?></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">	
				
	
		<!-- Row selection and deletion (multiple rows) -->
					<!--===================================================---->
					<div class="panel">
					 <?php 
	    if($this->session->flashdata('result')) { 
		?>
		<div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h4 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?></h4> 
		</div>
		<?php } ?>
					    <div class="panel-heading">
						  
					        <a href="<?php echo base_url().$control.'/add'.$controlname; ?>" class="btn btn-info"><i class="fa fa-plus"></i> Add</a>

						</div>
					   
					    <div class="panel-body">
						<div class="table-responsive">
					        <div class="Dta_table">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                      <thead>
                                          <tr>
                                              <th>Booking Detail</th>                
                                              <th>Space</th>
                                          <th>User</th> 
                                                              <th>Amount</th>
                                                              <th>Status</th>
                                              <th>Booking Id</th>
                                                              <th>Vehicle</th>
                                                              <th>Date</th>
                                                              <th>Email</th>
                                                              <th>Contact</th>
                                                              <th>Message to user</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      <?php if(!empty($booking)) {
                                              foreach($booking as $book){
                                                              //if(!empty($book['dates'])) { ?>
                                                                  <tr>
                                                                          <td>Detail</td>
                                                                          <td><?php echo ($book['typeofspace']) ? $book['typeofspace'] : '';?></td>
                                                                          <td><?php echo ($book['user']) ? $book['user'] : '';?></td>
                                                                          <td><?php echo ($book['amount']) ? '$'.$book['amount'] : '';?></td>
                                                                          <td><?php echo ($book['payment_status'] == '2') ? '<button type="button" class="btn btn-success">Paid</button>' : '<button type="button" class="btn btn-warning">Pending</button>';?></td>
                                                                          <td><?php echo ($book['order_no']) ? $book['order_no'] : '';?></td>
                                                                          <td><?php echo ($book['vehicle_id']) ? $book['vehicle_id'] : '';?></td>
                                                                          <td><?php echo ($book['booking_from']) ? '<b>From</b> '.date('m/d/Y h:i:s a',($book['booking_from'])).' <b>to</b> '.date('m/d/Y h:i:s a',($book['booking_to'])) : '';?></td>
                                                                          <td><?php echo ($book['email']) ? $book['email'] : '';?></td>
                                                                          <td><?php echo ($book['contact']) ? $book['contact'] : '';?></td>
                                                                          <td>
                                                                              <?php $chk = checkChatIdUser($this->session->userdata('uid'),$book['sid']);
                                                                              if($chk){ $chatid = $chk->chat_id; }else{ $chatid = getChatId(); }
                                                                              
                                                                              ?>
                                                                              <a href="<?php echo site_url('Messages/chat/'.$book['sid'].'/'.$chatid);?>"><button type="button" class="btn btn-success">Message</button></a>
                                                                          </td>
                                                                  </tr>
                                          <?php  } }?>	            
                                      </tbody>
                                  </table>
                                </div>
							</div>
					    </div>
					</div>
				
					<!-- End Row selection and deletion (multiple rows) -->
										
					</div>
					
                </div>
                <!--===================================================-->
				
<div id="myModal" class="modal fade myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Remove <strong>Data</strong> ?</h4>
            </div>
            <div class="modal-body">
                       <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
						
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button onclick="deleterow()"  class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="id">
<script>
 function setID(id)
	  {
		  document.getElementById('id').value=id;
	  }
	  
 function deleterow()
	  {
		  var id=document.getElementById('id').value;
		  jQuery.ajax({
				url: '<?php echo base_url().$control.'/delete'.$controlname; ?>',
				type: 'post',
				data: {id:id},
			    success: function (result)
				{					
				   if(result==1)
				   {
					   window.location="<?php echo base_url().$control.'/delete'.$controlname; ?>/success";
				   }
				   else{
					   window.location="<?php echo base_url().$control.'/delete'.$controlname; ?>/error"; 
				   }
				}
			});
	
	  }	  
</script>