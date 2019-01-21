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

						</div>
					   
					    <div class="panel-body">
						<div class="table-responsive">					        
                                <table id="demo-dt-basic" class="table table-striped table-bordered" style="width:100%">
                                      <thead>
                                <tr>
                                  <th>Sr. No.</th>                        
                                  <th>Order Id</th>
                                  <th>Transaction Id</th>
                                  <th>Amount</th>
                                                    
                                  <th>Status</th>
                                  <th>Payment Mode</th>
                                  <th>Payment From</th>
                                  <th>Order Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                      <?php if(isset($transactions)) {
                                            $count = 0;                              
                                            foreach($transactions as $row){ ?>
                                        <tr>
                                            <td align="center"><?= ++$count; ?></td>
                                            <td>
                                                <?php echo isset($row['order_id']) ? $row['order_id'] : ''; ?>                                    
                                              </td>
                                            <td>                                    
                                               <?php echo ($row['txn_id']) ? ($row['txn_id']) : 'N/A'; ?>                                    
                                            </td>
                                            <td>
                                                <?php echo isset($row['payment_amt']) ? $row['payment_amt'].' '.$row['currency_code'] : ''; ?>                                                
                                            </td>
                                          
                                            <td align="center">
                                                <?php echo ($row['status'] == 'completed') ? '<i class="fa fa-check"></i>' : '<i class="fa fa-clock-o"></i>
'; ?>
                                            </td>
                                            <td>
                                                <?php echo isset($row['payment_mode']) ? ($row['payment_mode']) : ''; ?>
                                            </td>                                            
                                            <td>
                                                <?php                                                
                                                    echo isset($row['user_id']) ? getUser($row['user_id'])->name."<br>".getUser($row['user_id'])->email."<br>".getUser($row['user_id'])->contact : ''; 
                                                 ?>
                                            </td>
                                            <td>
                                                <?php echo isset($row['created_at']) ? date('d M Y h:i:s',strtotime($row['created_at'])) : ''; ?>
                                            </td>
                                        </tr>                          
                                <?php  } }?>                      
                                                                   
                                </tbody>
                                  </table>                                
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