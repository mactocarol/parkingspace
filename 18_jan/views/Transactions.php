<div class="col-md-8 col-sm-6">
  <div class="credit">
      <h4><span>Transactions</span></h4>
  </div>
  
<div class="park_panel">
  <div class="panel_heading">
    <h4>Transactions</h4>
  </div>
  <div class="Dta_table">
  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Detail</th>
                <th>Order Id</th>                
								<th>Transaction Id</th>
								<th>Amount</th>
                <th>Currency</th>
								<th>Payment Type</th>
								<th>Status</th>
								<th>Date</th>
								<th>Payment For</th>								
            </tr>
        </thead>
        <tbody>
		<?php if(!empty($transactions)) {
				//print_r($rowing);
				foreach($transactions as $row){
								//if(!empty($row['dates'])) { ?>
									<tr>
											<td>Detail</td>
											<td><?php echo ($row['order_id']) ? $row['order_id'] : '';?></td>											
											<td><?php echo ($row['txn_id']) ? $row['txn_id'] : '';?></td>
											<td><?php echo ($row['payment_amt']) ? $row['payment_amt'] : '';?></td>
											<td><?php echo ($row['currency_code']) ? $row['currency_code'] : '';?></td>
											<td><?php echo ($row['payment_mode']) ? $row['payment_mode'] : '';?></td>
											<td><?php echo ($row['status']) ? $row['status'] : '';?></td>
											<td><?php echo ($row['created_at']) ? date('d M Y h:i:s',strtotime($row['created_at'])) : '';?></td>
											<td><?php echo ($row['typeofspace']) ? $row['typeofspace'] : '';?></td>																						
									</tr>
			<?php  } }?>	            
        </tbody>
    </table>
  </div>
</div>
</div>

