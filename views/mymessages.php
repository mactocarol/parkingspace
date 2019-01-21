<div class="col-md-8 col-sm-6">
  <div class="credit">
      <h4><span>Messages</span></h4>
  </div>
  <div class="dash_sbt">
    <!--<button type="button" class="verfy"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo site_url('Messages/index'); ?>">Bookings Made</a></button>
    <button type="button" class="cnsl"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo site_url('Dashboard/BookingReceived'); ?>">Bookings Received</a></button>-->
  </div>
<div class="park_panel">
  <div class="panel_heading">
    <h4>Messages</h4>
  </div>
  <div class="Dta_table">
  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
                                <tr>
                                  <th>Sr. No.</th>                                                                                                        
                                  <th>From</th>
								  <th>Date</th>
                                  <th>Action</th>   
                                </tr>
                                </thead>
                                <tbody>
                                      <?php if(isset($messages) && !empty($messages)) {
                                            $count = 0;                              
                                            foreach($messages as $row){ ?>
                                        <tr <?php echo ($row['status'] == '0') ? 'style="background-color:#b2cfe8"' : '' ; ?>>
                                            <td><?= ++$count; ?></td>                                            
                                            <td>                                    
                                               <?php echo ($row['message_from']) ? get_user($row['message_from'])->name : ''; ?>                                    
                                            </td>                                            
                                            <td>
                                                <?php echo isset($row['created_at']) ? date('d M Y h:i:s',strtotime($row['created_at'])) : ''; ?>
                                            </td>
                                            <td>
												<?php
												$arr = [$row['message_to'],$row['message_from']];
												foreach($arr as $ar){
													if($ar != $result->id){
														$other = $ar;
													}
												}
												?>
                                                <?php echo isset($row['chat_id']) ? '<a href="'.site_url('Messages/chat/'.$other.'/'.$row['chat_id'].'').'">View Message</a>' : ''; ?>                                    
                                            </td>
                                        </tr>                          
                                <?php  } }?>                      
                                                                   
                                </tfoot>
    </table>
  </div>
</div>
</div>



<!---->


