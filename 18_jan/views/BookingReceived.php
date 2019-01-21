<div class="col-md-8 col-sm-6">
  <div class="credit">
      <h4><span>Booking Received</span></h4>
  </div>
  <div class="dash_sbt">
    <button type="button" class="verfy"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo site_url('Dashboard/BookingMade'); ?>">Bookings Made</a></button>
    <button type="button" class="cnsl"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo site_url('Dashboard/BookingReceived'); ?>">Bookings Received</a></button>
  </div>
<div class="park_panel">
  <div class="panel_heading">
    <h4>Booking Received</h4>
  </div>
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

