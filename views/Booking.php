<section class="cumber_lne">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="cumber_head park_lne text-center">
              <h2>Complete payment</h2>
            </div>
          </div>
        </div>
        <div class="payment_tb">
        	<div class="row">
        		<div class="col-md-12">
        			<table class="table table-bordered">
					    <tbody>
					      <tr>
					        <td>Listing</td>
					        <td><a href="<?php echo site_url('search/detail/'.base64_encode($space->id));?>"><?php echo ($space->typeofspace) ? $space->typeofspace : ''; ?> on <?php echo ($space->address) ? $space->address : ''; ?></a></td>
					      </tr>
					      <tr>
					        <td>Arriving on</td>
					        <td><?php echo ($fdate) ? date('d M Y h:i:s',strtotime($fdate)): ''; ?></td>
					      </tr>
					      <tr>
					        <td>Departing on</td>
					        <td><?php echo ($ldate) ? date('d M Y h:i:s',strtotime($ldate)): ''; ?></td>
					      </tr>
					      <tr>
					        <th>Vehicle</th>
					        <td><?=($vehicle->isHired) ? "Car" : $vehicle->vehicle_type?>, <?=($vehicle->isHired) ? "Hired Vehicle" : $vehicle->vehicle_make ?> <?=($vehicle->vehicle_model) ? $vehicle->vehicle_model : '' ?> <?=($vehicle->license) ? $vehicle->license : '' ?></td>
					      </tr>
					      <tr>
					        <th>Total</th>
					        <td>$<?=($charge) ? $charge : 'Free'?></td>
					      </tr>
					    </tbody>
					  </table>
        		</div>
        	</div>
            <div class="col-md-12">
                <div class="">
                                
                        <h5>Choose Payment Method</h5>
                                                            
        
                                 <form action="<?php echo base_url().'Booking/buy'; ?>" method="post">
                                    
                                    <input type="hidden" name="currency_code" value="USD">
                                    
                                    <input type="hidden" name="fdate" value="<?=$fdate?>">
                                    <input type="hidden" name="ldate" value="<?=$ldate?>">
                                    <input type="hidden" name="spaceid" value="<?=$space->id?>">
                                    <input type="hidden" name="vehicle_id" value="<?=$vehicle->id?>">
                                    
                                    <input type="hidden" name="amount" id="amount" value="<?=$charge?>">                                
                                    
                                
                                    <div class="">
                                    <br>                                    
                                    <!--Paypal <input type="radio" name="payment_method" value="paypal" checked><br>-->
						PayU <input type="radio" name="payment_method" value="payu" ><br>
                                    <br>
                                    <input type="submit" id="onetime" class="btn btn-primary" name="Update_profile" value="Pay">                                
                                    <br>
                                    </div>
                                </form>
					
                     
                    </div>
            </div>
        </div>
      </div>
    </section>