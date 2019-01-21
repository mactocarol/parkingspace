
<div id="content-container">                 
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">
					        <div class="panel-body">
					            <div class="pad-hor mar-top">
					                <h2 class="text-thin mar-no"><i class="text-info text-normal">Featured Property Payment Details</i>
									<a href="<?php echo base_url(); ?>Payment/featuredpayment" class="btn btn-warning pull-right">Back</a>
									</h2>					               
					            </div>
					
					            <hr>
					
					            <ul class="list-group bord-no">
								   <li class="list-group-item list-item-lg media">
					                    <div class="pull-right">
										<?php if(isset($featured[0]->photo)) { if($featured[0]->photo!="") { ?>
					                   <a href="<?php echo base_url(); ?>upload/user/<?php echo $featured[0]->photo;  ?>" data-lightbox="example-set"> <img class="img-lg" alt="Image" src="<?php echo base_url(); ?>upload/user/<?php echo $featured[0]->photo; ?>"></a>
										 <p class="text-center">Photo</p>
										<?php }} ?>
									   
										</div>
										
					                    <div class="media-body">
					                        <div class="media-heading mar-no">
					                             <span class="viewheading"> User Name:</span> <a class="btn-link text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($featured[0]->name)) { echo $featured[0]->name; } ?></a>
					                        </div><br>
                                        <p class="text-sm">Payment Date: <?php if(isset($featured[0]->created_dt)) { echo $featured[0]->created_dt; } ?></p>
                                        <p class="text-sm">Last Updated Date: <?php if(isset($featured[0]->updated_dt)) { echo $featured[0]->updated_dt; } ?></p>
										
										 <p class="text-sm">Expired date : <?php if(isset($featured[0]->created_dt)) { echo date("Y-m-d H:i:s",strtotime("+".$featured[0]->validity,strtotime($featured[0]->created_dt))); } ?></p>
																		
					                    </div>										
										
					                </li>
					                
					                <li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Property Title:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($featured[0]->title)) { echo $featured[0]->title; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Price:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($featured[0]->price)) { echo $featured[0]->price." ".$featured[0]->currency; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Validity:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($featured[0]->validity)) { echo $featured[0]->validity; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Order Id :</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($featured[0]->orderid)) { echo $featured[0]->orderid; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Invoice No:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($featured[0]->invoiceno)) { echo $featured[0]->invoiceno; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Transaction ID:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($featured[0]->transactionid)) { echo $featured[0]->transactionid; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Description:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($featured[0]->description)) { echo $featured[0]->description; } ?></a>
					                   </div>
					                </li>
									
									
									
					           
					            </ul>					           
					        </div>
					    </div>  
                </div>
                <!--End page content-->
            </div>