<?php
$title="title_".$this->session->userdata("site_lang");
$meta="meta_".$this->session->userdata("site_lang");
$copyright="copyright_".$this->session->userdata("site_lang");
?>

<div id="content-container">                 
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">
					        <div class="panel-body">
					            <div class="pad-hor mar-top">
					                <h2 class="text-thin mar-no"><i class="text-info text-normal">Frontsetting Details</i>
									<a href="<?php echo base_url(); ?>Setting/frontsetting" class="btn btn-warning pull-right">Back</a>
									</h2>					               
					            </div>
					
					            <hr>
					
					            <ul class="list-group bord-no">
								   <li class="list-group-item list-item-lg media">
					                    <div class="pull-right">
										<?php if(isset($frontsetting[0]->logo)) { if($frontsetting[0]->logo!="") { ?>
					                    <a href="<?php echo base_url(); ?>images/<?php echo $frontsetting[0]->logo;  ?>" data-lightbox="example-set"><img class="img-lg" alt="Image" src="<?php echo base_url(); ?>images/<?php echo $frontsetting[0]->logo; ?>"></a>
										<?php }} ?>
									    <p class="text-center">Front Logo</p>
										</div>
										<div class="pull-right">
					                    <?php if(isset($frontsetting[0]->favicon)) { if($frontsetting[0]->favicon!="") { ?>
										<a href="<?php echo base_url(); ?>images/<?php echo $frontsetting[0]->favicon;  ?>" data-lightbox="example-set"><img class="img-lg" alt="Image" src="<?php echo base_url(); ?>images/<?php echo $frontsetting[0]->favicon; ?>"></a>
					                    <?php }} ?>
										<p class="text-center">Favicon Icon</p>
										</div>
					                    <div class="media-body">
					                        <div class="media-heading mar-no">
					                             <span class="viewheading"> Website Name:</span> <a class="btn-link text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($frontsetting[0]->$title)) { echo $frontsetting[0]->$title; } ?></a>
					                        </div><br>
                                        <p class="text-sm">Created Date: <?php if(isset($frontsetting[0]->created_dt)) { echo $frontsetting[0]->created_dt; } ?></p>
                                        <p class="text-sm">Updated Date: <?php if(isset($frontsetting[0]->updated_dt)) { echo $frontsetting[0]->updated_dt; } ?></p>											
					                    </div>										
										
					                </li>
					                
					                <li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Website Title:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($frontsetting[0]->wtitle)) { echo $frontsetting[0]->wtitle; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Footer Description:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($frontsetting[0]->$meta)) { echo $frontsetting[0]->$meta; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Footer Copyright:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($frontsetting[0]->$copyright)) { echo $frontsetting[0]->$copyright; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Email Best Regard :</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($frontsetting[0]->best)) { echo $frontsetting[0]->best; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Support Email:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($frontsetting[0]->support)) { echo $frontsetting[0]->support; } ?></a>
					                   </div>
					                </li>
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Support Message:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($frontsetting[0]->supportmsg)) { echo $frontsetting[0]->supportmsg; } ?></a>
					                   </div>
					                </li>
									
									<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Paypal Email:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($paypal[0]->email)) { echo $paypal[0]->email; } ?></a>
					                   </div>
					                </li>
									
										<li class="list-group-item list-item-lg">
					                   <div class="media-heading">
					                        <span class="viewheading"> Paypal Url:</span> <a class=" text-lg text-semibold" href="#" data-toggle="modal"><?php if(isset($paypal[0]->url)) { echo $paypal[0]->url; } ?></a>
					                   </div>
					                </li>
									
					           
					            </ul>					           
					        </div>
					    </div>  
                </div>
                <!--End page content-->
            </div>