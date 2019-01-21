<div class="col-md-8 col-sm-6">  
    <div class="credit">
        <h4><span>New Notification</span></h4>
    </div>
<!--    <div class="dash_sbt">
        <button type="button" class="verfy"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo site_url('Dashboard/BookingMade'); ?>">Bookings Made</a></button>
        <button type="button" class="cnsl"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo site_url('Dashboard/BookingReceived'); ?>">Bookings Received</a></button>
    </div>-->
    <div class="park_panel">
        <div class="panel_heading">
            <h4>New Notification</h4>
        </div>
        <div class="Dta_table">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Message</th>
                      <!--   <th>Sender</th>                
                        <th>Receiver</th>-->
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($notify)) {
                        //print_r($booking);
                        foreach ($notify as $value) {
                            //if(!empty($book['dates'])) { 
                            ?>
                            <tr>
                               <td><?php echo ($value->masage) ? ($value->masage):'';?></td>											
                                <!-- <td><?php// echo ($loggedData->name) ? ($loggedData->name): ''; ?></td>-->
                                 <!--<td><?php //echo ($value->name) ? ($value->name):'';?></td>-->
                                <td><?php echo ($value->status==0) ? ('Unread Notification'):'Read Notification';?></td>
                               
                            </tr>
    <?php }
} ?>	            
                </tbody>
            </table>
        </div>
    </div>
</div>

