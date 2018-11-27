
<div id="content-container">                 
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">
					        <div class="panel-body">
					            <div class="pad-hor mar-top">
					                <h2 class="text-thin mar-no"><i class="text-info text-normal">User Details</i>
									<a href="<?php echo base_url(); ?>Manageuser/user" class="btn btn-warning pull-right">Back</a>
									</h2>					               
					            </div>
					
					            <hr>
					
					            <ul class="list-group bord-no">
								   <li class="list-group-item list-item-lg media">
					                    <div class="pull-right">
										<?php if(isset($user[0]->photo)) { if($user[0]->photo!="") { ?>
					                   <a href="<?php echo base_url(); ?>upload/user/<?php echo $user[0]->photo;  ?>" data-lightbox="example-set"> <img class="img-lg" alt="Image" src="<?php echo base_url(); ?>upload/user/<?php echo $user[0]->photo; ?>"></a>
										 <p class="text-center">Photo</p>
										<?php }} ?>
									   
										</div>
										
					                    <div class="media-body">
					                        <div class="media-heading mar-no">
					                             <span class="viewheading"> Owner Name:</span> <a class="btn-link text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($user[0]->name)) { echo $user[0]->name; } ?></a>
					                        </div><br>
                                        <p class="text-sm">Registration Date: <?php if(isset($user[0]->created_dt)) { echo $user[0]->created_dt; } ?></p>
                                        <p class="text-sm">Last Updated Date: <?php if(isset($user[0]->updated_dt)) { echo $user[0]->updated_dt; } ?></p>
										<div class="pad-btm">
					                        <small>Profile Status :</small>
											<?php if(isset($user[0]->status)) {
												if($user[0]->status==0)
												{ ?>
					                        <a class="label label-mint" href="#">Pending</a>
												<?php } 
												if($user[0]->status==2)
												{
												?>
					                        <a class="label label-danger" href="#">Suspend</a>
												<?php }
                                                 if($user[0]->status==1)
												{
												?>
					                        <a class="label label-success" href="#">Active</a>
											<?php }} ?>
					                    </div>
										<div class="pad-btm">
					                        <small>Email Status :</small>
											<?php if(isset($user[0]->email_status)) {
 
												if($user[0]->email_status==0)
												{
												?>
					                        <a class="label label-mint" href="#">Pending</a>
												<?php }
                                                 if($user[0]->email_status==1)
												{
												?>
					                        <a class="label label-success" href="#">Verified</a>
											<?php }} ?>
					                    </div>											
					                    </div>										
										
					                </li>
					                
					                <li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Email:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($user[0]->email)) { echo $user[0]->email; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Contact:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($user[0]->contact)) { echo $user[0]->contact; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Address:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($user[0]->address)) { echo $user[0]->address; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Zipcode :</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($user[0]->zipcode)) { echo $user[0]->zipcode; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Country:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($user[0]->countryName)) { echo $user[0]->countryName; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Description:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($user[0]->description)) { echo $user[0]->description; } ?></a>
					                   </div>
					                </li>
									
									<li class="list-group-item list-item-lg">
					                    <div class="media-heading mar-no">
					                        <a class="btn-link text-lg text-semibold" href="#">Social Media</a>
					                    </div>
					                   
					                    <div class="pad-lft mar-top">
					                        <div class="row">
					                            <div class="col-sm-4">
					                                <a class="btn-link text-semibold" href="#">Skype</a>
					                                <p><?php if(isset($user[0]->skype)) { echo $user[0]->skype; } ?></p>
					                            </div>
					                            <div class="col-sm-4">
					                                <a class="btn-link text-semibold" href="#">Facebook</a>
					                                <p><?php if(isset($user[0]->facebook)) { echo $user[0]->facebook; } ?></p>
					                            </div>
												<div class="col-sm-4">
					                                <a class="btn-link text-semibold" href="#">Twitter</a>
					                                <p><?php if(isset($user[0]->twitter)) { echo $user[0]->twitter; } ?></p>
					                            </div>
					                        </div>
					                        <div class="row">
					                            <div class="col-sm-4">
					                                <a class="btn-link text-semibold" href="#">Google plus</a>
					                                <p><?php if(isset($user[0]->google)) { echo $user[0]->google; } ?></p>
					                            </div>
					                            <div class="col-sm-4">
					                                <a class="btn-link text-semibold" href="#">Linkedin</a>
					                                <p><?php if(isset($user[0]->linkedin)) { echo $user[0]->linkedin; } ?></p>
					                            </div>
					                        </div>
					                    </div>
					                </li>
									
					           
					            </ul>					           
					        </div>
					    </div>  
                </div>
                <!--End page content-->
            </div>