
<section class="contact_us_bg">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breedcrumb text-center">
               <ul>
                  <li><a href="#">Pewnyparking</a></li>
                  <li><a href="#">Rent out your space</a></li>
               </ul>
               <h2>Edit Rent out your space</h2>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="clearfix"></div>
 <form action="<?php echo base_url(); ?>Dashboard/updaterentourspace/<?php echo $this->uri->segment(2); ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
<section class="info dash">
   <div class="container">
      <div class="bx_shdo">
        <div class="dash_dtl_frm">
       
               <div class="credit">
                <div class="row bs-example-popover">
                  <div class="col-md-4">
                    <div class="popover left">
                            <div class="arrow"></div>
                            <div class="popover-content">
                              <p>Your full address will only be shown to drivers that book your space.</p>
                            </div>
                          </div>
                     </div>
                    <div class="col-md-8">
                  <h4><span>WHERE IS YOUR</span> PARKING SPACE?
				  <span class="back_btn"><a href="<?php echo base_url(); ?>Dashboard/myspace" class="btn btn-primary">Back</a></span>
				  </h4>
                  <div class="dtl-Sec">
                  <div class="row">
				  
				  <div class="col-md-12">
				  <?php
				  if(isset($space[0]->address))
				  {
					$address=str_replace(" ", "+",$space[0]->address.$space[0]->city);
					?>
                 	<iframe style="width:100%;" frameborder="0" id="cusmap" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed"></iframe>
					
				  <?php } ?>
				  </div>
				  
                           <div class="col-md-12">
                              <label for="email">Country</label>
                              <div class="form-group">
                                 <div class="select">
                                    <select  name="country" id="country" class="selectpicker" data-style="btn-info custom"  data-max-options="3" data-live-search="true">
                                      <option value="">Select Country</option>
                                     <?php
									 if(isset($country))
									 {
										 foreach($country as $c)
										 {
											?>
											<option value="<?php echo $c->countryID; ?>" <?php if(isset($space[0]->country)) { if($space[0]->country==$c->countryID) { echo "selected"; } } ?> ><?php echo $c->countryName; ?></option>
                                            <?php											
										 }
									 }
									 ?>
                                    </select>
									<div class="errors"><?php echo form_error('country'); ?></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <label for="email">House Name/No.</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" id="housename" placeholder="House Name/No." name="housename" value="<?php if(isset($space[0]->housename)) { echo $space[0]->housename; } ?>">
								 <div class="errors"><?php echo form_error('housename'); ?></div>
                              </div>
                           </div>
                           <div class="col-md-8">
                              <label for="email">Street Address</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" id="address" placeholder="Street Address" name="address" value="<?php if(isset($space[0]->address)) { echo $space[0]->address; } ?>">
								 <div class="errors"><?php echo form_error('address'); ?></div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <label for="email">City</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php if(isset($space[0]->city)) { echo $space[0]->city; } ?>">
								 <div class="errors"><?php echo form_error('city'); ?></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <label for="email">Country/State</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" id="state" placeholder="Country/State" name="state" value="<?php if(isset($space[0]->state)) { echo $space[0]->state; } ?>">
								 <div class="errors"><?php echo form_error('state'); ?></div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <label for="email">Postal Code</label>
                              <div class="form-group">
                                 <input type="text" class="form-control" id="zipcode" placeholder="Postal Code" name="zipcode" value="<?php if(isset($space[0]->zipcode)) { echo $space[0]->zipcode; } ?>">
								 <div class="errors"><?php echo form_error('zipcode'); ?></div>
                              </div>
                           </div>
                        </div>
                      </div>
                     <!-- End of dtl sec -->
                </div>
              </div>

               </div>
                        
                     <div class="dtl-Sec section_tab">
                      <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="credit">
                                 <h4><span>ABOUT</span> YOUR SPACE</h4>
                              </div>
                           </div>
                        </div>
						<script>
						function setval(val)
						{
							$("#typeofspace").val(val);
						}
						</script>
                        <div class="row">
                           <div class="col-md-9">
                              <p>Type of Space</p>
							  <input type="hidden" name="typeofspace" id="typeofspace" value="<?php if(isset($space[0]->typeofspace)) { echo $space[0]->typeofspace; } else { echo "Driveway"; }  ?>">
                              <div class="tab" role="tabpanel">
                                 <!-- Nav tabs -->
								 <?php
								 $cls_act1="";
								 $m_act1="";
								 $cls_act2="";
								 $m_act2="";
								 $cls_act3="";
								 $m_act3="";
								 if(isset($space[0]->typeofspace))
								 {
									 if($space[0]->typeofspace=='Driveway')
									 {
										$cls_act1="class='active'";
                                        $m_act1="in active";										
									 }
									 if($space[0]->typeofspace=='Garage')
									 {
										$cls_act2="class='active'";
                                        $m_act2="in active";										
									 }
									 if($space[0]->typeofspace=='Car park')
									 {
										$cls_act3="class='active'";
                                        $m_act3="in active";										
									 }
								 }
								 ?>
								 
                                 <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" <?php echo $cls_act1; ?>><a onclick="setval('Driveway');" href="#Section1" aria-controls="home" role="tab" data-toggle="tab">
                                      <img src="<?php echo base_url(); ?>frontend/images/drive1.png" class="way"><img src="<?php echo base_url(); ?>frontend/images/drive.png" class="way1">Driveway</a></li>
                                    <li role="presentation" <?php echo $cls_act2; ?>><a onclick="setval('Garage');" href="#Section2" aria-controls="profile" role="tab" data-toggle="tab"><img src="<?php echo base_url(); ?>frontend/images/car_garage1.png" class="way"><img src="<?php echo base_url(); ?>frontend/images/car_garage.png" class="way1">Garage</a></li>
                                    <li role="presentation" <?php echo $cls_act3; ?>><a onclick="setval('Car park');" href="#Section3" aria-controls="settings" role="tab" data-toggle="tab"><img src="<?php echo base_url(); ?>frontend/images/car_park1.png" class="way"><img src="<?php echo base_url(); ?>frontend/images/car_park.png" class="way1">Car park</a></li>
                                 </ul>
                                 <!-- Tab panes -->
								 
								     <p>I am a..</p>
                                       <div class="dash_sbt onr">
                                            
                                             <div class="btn-group" data-toggle="buttons">
                                              <label  class="btn btn-primary <?php if(isset($space[0]->driveway_owner)) { if($space[0]->driveway_owner=='Individual Owner') { echo "active";} }  ?>">
                                                <input <?php if(isset($space[0]->driveway_owner)) { if($space[0]->driveway_owner=='Individual Owner') { echo "checked";} }  ?> type="radio" name="driveway_owner" id="option2" value="Individual Owner" autocomplete="off"> Individual Owner
                                              </label>
                                              <label class="btn btn-primary <?php if(isset($space[0]->driveway_owner)) { if($space[0]->driveway_owner=='Business/Organisation') { echo "active";} }  ?>">
                                                <input <?php if(isset($space[0]->driveway_owner)) { if($space[0]->driveway_owner=='Business/Organisation') { echo "checked";} }  ?> type="radio" name="driveway_owner" id="option3" value="Business/Organisation" autocomplete="off"> Business/Organisation
                                              </label>
                                            </div>
                                       
                                        </div>
                            
							            <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade <?php echo$m_act1; ?>" id="Section1">
                                   
                                       <div class="space_dv">
                                          <p>Width of space</p>
                                          <div class="dash_sbt onr">
                                      <div class="btn-group" data-toggle="buttons">
                                              <label class="btn btn-primary <?php if(isset($space[0]->driveway_width)) { if($space[0]->driveway_width=='Normal') { echo "active";} }  ?>">
                                                <input <?php if(isset($space[0]->driveway_width)) { if($space[0]->driveway_width=='Normal') { echo "checked";} }  ?> type="radio" name="driveway_width" id="option2" value="Normal" autocomplete="off"> Normal
                                              </label>
                                              <label class="btn btn-primary <?php if(isset($space[0]->driveway_width)) { if($space[0]->driveway_width=='Narrow') { echo "active";} }  ?>">
                                                <input <?php if(isset($space[0]->driveway_width)) { if($space[0]->driveway_width=='Narrow') { echo "checked";} }  ?> type="radio" name="driveway_width" id="option3" value="Narrow" autocomplete="off"> Narrow
                                              </label>
                                            </div>
                                          </div>
                                       </div>
                                       <div class="space_dv">
                                          <p>Features (Select Multiple)</p>
                                          <div class="dash_sbt onr">
                                             <div class="row">
                                              <div class="form-group">
                                                  <div class="searchable-container">
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->driveway_feature)) { if(in_array("Electric Charging",explode( ",", $space[0]->driveway_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->driveway_feature)) { if(in_array("Electric Charging",explode( ",", $space[0]->driveway_feature))) { echo "checked"; } } ?> type="checkbox" name="driveway_feature[]" autocomplete="off" value="Electric Charging">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>Electric Charging</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->driveway_feature)) { if(in_array("CCTV",explode( ",", $space[0]->driveway_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->driveway_feature)) { if(in_array("CCTV",explode( ",", $space[0]->driveway_feature))) { echo "checked"; } } ?> type="checkbox" name="driveway_feature[]" autocomplete="off" value="CCTV">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>CCTV</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade <?php echo$m_act2; ?>" id="Section2">
                                 
                                       <div class="space_dv">
                                          <p>Features (Select Multiple)</p>
                                          <div class="dash_sbt onr">
                                             <div class="row">
                                              <div class="form-group">
                                                  <div class="searchable-container">
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->garage_feature)) { if(in_array("Electric Charging",explode( ",", $space[0]->garage_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input  <?php if(isset($space[0]->garage_feature)) { if(in_array("Electric Charging",explode( ",", $space[0]->garage_feature))) { echo "checked"; } } ?> type="checkbox" name="garage_feature[]" autocomplete="off" value="Electric Charging">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>Electric Charging</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->garage_feature)) { if(in_array("CCTV",explode( ",", $space[0]->garage_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->garage_feature)) { if(in_array("CCTV",explode( ",", $space[0]->garage_feature))) { echo "checked"; } } ?> type="checkbox" name="garage_feature[]" autocomplete="off" value="CCTV">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>CCTV</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade <?php echo$m_act3; ?>" id="Section3">
                                 
                                       <div class="space_dv wdhnum">
                                          <p>Height Restriction (m)</p>
                              <input type="number" name="car_height" id="car_height" class="incre" min=1 value="<?php if(isset($space[0]->car_height)) { echo $space[0]->car_height; } ?>">
                                       </div>
                                       <div class="space_dv">
                                          <p>Features (Select Multiple)</p>
                                          <div class="dash_sbt onr">
                                            <div class="row">
                                              <div class="form-group">
                                                  <div class="searchable-container">
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->car_feature)) { if(in_array("Covered",explode( ",", $space[0]->car_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->car_feature)) { if(in_array("Covered",explode( ",", $space[0]->car_feature))) { echo "checked"; } } ?> type="checkbox" name="car_feature[]" autocomplete="off" value="Covered">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>Covered</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->car_feature)) { if(in_array("CCTV",explode( ",", $space[0]->car_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->car_feature)) { if(in_array("CCTV",explode( ",", $space[0]->car_feature))) { echo "checked"; } } ?> type="checkbox" name="car_feature[]" autocomplete="off" value="CCTV">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>CCTV</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                            
                                            <div class="row">
                                              <div class="form-group">
                                                  <div class="searchable-container">
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->car_feature)) { if(in_array("Onsite staff",explode( ",", $space[0]->car_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->car_feature)) { if(in_array("Onsite staff",explode( ",", $space[0]->car_feature))) { echo "checked"; } } ?> type="checkbox" name="car_feature[]" autocomplete="off" value="Onsite staff">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>Onsite staff</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->car_feature)) { if(in_array("Electric Charging",explode( ",", $space[0]->car_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->car_feature)) { if(in_array("Electric Charging",explode( ",", $space[0]->car_feature))) { echo "checked"; } } ?> type="checkbox" name="car_feature[]" autocomplete="off" value="Electric Charging">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>Electric Charging</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="row">
                                              <div class="form-group">
                                                  <div class="searchable-container">
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->car_feature)) { if(in_array("Disabled access",explode( ",", $space[0]->car_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->car_feature)) { if(in_array("Disabled access",explode( ",", $space[0]->car_feature))) { echo "checked"; } } ?> type="checkbox" name="car_feature[]" autocomplete="off" value="Disabled access">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>Disabled access</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->car_feature)) { if(in_array("Multiple entry/exit",explode( ",", $space[0]->car_feature))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->car_feature)) { if(in_array("Multiple entry/exit",explode( ",", $space[0]->car_feature))) { echo "checked"; } } ?> type="checkbox" name="car_feature[]" autocomplete="off" value="Multiple entry/exit">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>Multiple entry/exit</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- End of col-md-9 -->
							
							
                           <div class="col-md-3">
                            <p>Number of spaces</p>
                              <input type="number" name="noofspace" id="noofspace"  class="incre" min=1 value="<?php if(isset($space[0]->noofspace)) { echo $space[0]->noofspace; } ?>">
							  <div class="errors"><?php echo form_error('noofspace'); ?></div>
                           </div>
                        </div>
                     </div>
                   </div>
                   </div>
                     <!-- End of dtl sec -->
                   
                   <div class="dtl-Sec wdh">
                        <div class="row bs-example-popover">
                          <div class="col-md-4">
                          <div class="popover left">
                            <div class="arrow"></div>
                            <div class="popover-content">
                              <p>Any other selling points? e.g. local knowledge, transport links...</p>
                            </div>
                          </div>
                        </div>
                           <div class="col-md-8">
                              <div class="credit">
                                 <h4><span>DESCRIPTION</span></h4>
                              </div>
                              <textarea name="description" id="description" rows="4" placeholder="This is the discription that will be shown on your parking page.For your own security,do not include your email or phone number." class="rnt_area"><?php if(isset($space[0]->description)) { echo $space[0]->description; } ?></textarea>
							  <div class="errors"><?php echo form_error('description'); ?></div>
                           </div>
                        </div>
                      </div>
                      <div class="dtl-Sec wdh">
                        <div class="row bs-example-popover">
                          <div class="col-md-4">
                          <div class="popover left">
                            <div class="arrow"></div>
                            <div class="popover-content">
                              <p>These details are only sent to drivers after they have booked your space.</p>
                            </div>
                          </div>
                        </div>
                           <div class="col-md-8">
                              <div class="credit">
                                 <h4><span>ACCESS INSTRUCTIONS </span>(optional)</h4>
                              </div>
                              <textarea name="accessdetail" id="accessdetail" rows="4" placeholder="How would a driver find your space and access it(if it's locked)? Is there a particular space number the driver should use?" class="rnt_area"><?php if(isset($space[0]->accessdetail)) { echo $space[0]->accessdetail; } ?></textarea>
                           </div>
                        </div>
                      </div>
                      <div class="dtl-Sec wdh">
                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="col-md-8">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="credit">
                                 <h4><span>ACCESS Method</span></h4>
                              </div>
                              <div class="row">
                                <div class="col-md-8">
								 <div class="form-group">
                                                  <div class="searchable-container">
                             <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->accessmethod)) { if(in_array("key/Fob",explode( ",", $space[0]->accessmethod))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->accessmethod)) { if(in_array("key/Fob",explode( ",", $space[0]->accessmethod))) { echo "checked"; } } ?> type="checkbox" name="accessmethod[]" autocomplete="off" value="key/Fob">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>key/Fob</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
													  
													  <div class="items col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                                          <div class="info-block block-info clearfix">
                                                              <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                                  <label class="btn btn-default <?php if(isset($space[0]->accessmethod)) { if(in_array("Permit",explode( ",", $space[0]->accessmethod))) { echo "active"; } } ?>">
                                                                      <div class="bizcontent">
                                                                          <input <?php if(isset($space[0]->accessmethod)) { if(in_array("Permit",explode( ",", $space[0]->accessmethod))) { echo "checked"; } } ?> type="checkbox" name="accessmethod[]" autocomplete="off" value="Permit">
                                                                          <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                          <h5>Permit</h5>
                                                                      </div>
                                                                  </label>
                                                              </div>
                                                          </div>
                                                      </div>
													  </div>
													  </div>
                           </div>
                           <div class="col-md-4">
                             <p>Security code</p>
                             <input type="text" name="code" id="code" placeholder="e.g.1234" class="eg" value="<?php if(isset($space[0]->code)) { echo $space[0]->code; } ?>">
                           </div>
                           </div>
                           </div>
                        </div>
                      </div>
                    </div>
                      </div>
                      <div class="dtl-Sec wdh">
                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="col-md-8">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="credit">
                                 <h4><span>PRICING</span></h4>
								 
                                 <div class="col-md-3">
								    <label>Per hour</label>
                                   <input onchange="checkhour(this.value,'hour');" onblur="checkhour(this.value,'hour');" onclick="checkhour(this.value,'hour');"  type="number" name="phour" id="phour"  class="incre" min=1 value="<?php if(isset($space[0]->phour)) { echo $space[0]->phour; } ?>">								  
								   <span id="hmsg"></span>
                                 </div>
								 
								  <div class="col-md-3">
								   <label>Per day</label>
                                   <input onchange="checkhour(this.value,'day');" onblur="checkhour(this.value,'day');" onclick="checkhour(this.value,'day');" type="number" name="pday" id="pday"  class="incre" min=1 value="<?php if(isset($space[0]->pday)) { echo $space[0]->pday; } ?>">
								   <span id="dmsg"></span>
                                 </div>
								 
								  <div class="col-md-3">
								  <label>Per week</label>
                                   <input onchange="checkhour(this.value,'week');" onblur="checkhour(this.value,'week');" onclick="checkhour(this.value,'week');" type="number" name="pweek" id="pweek"  class="incre" min=1 value="<?php if(isset($space[0]->pweek)) { echo $space[0]->pweek; } ?>">
								    <span id="wmsg"></span>
                                 </div>
								 
								 <div class="col-md-3">
								  <label>Per month</label>
                                   <input onchange="checkhour(this.value,'month');" onblur="checkhour(this.value,'month');" onclick="checkhour(this.value,'month');" type="number" name="pmonth" id="pmonth"  class="incre" min=1 value="<?php if(isset($space[0]->pmonth)) { echo $space[0]->pmonth; } ?>">
								   <span id="mmsg"></span>
                                 </div>
							   
                              </div>
                           </div>
                        </div>
                      </div>
                    </div>
                      </div>
                       <div class="dtl-Sec wdh">
                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="col-md-8">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="credit">
                                 <h4><span>About</span> You</h4>
                               </div>
                              </div>
                              </div>
							 
                              <div class="row">
                                <div class="col-md-4">
                                  <label for="name">First Name</label>
                                 <div class="form-group">
                                    <input  type="text" class="form-control" id="fname" placeholder="First Name" name="fname" value="<?php if(isset($space[0]->fname)) { echo $space[0]->fname; } ?>">
									<div class="errors"><?php echo form_error('fname'); ?></div>
                                 </div>
                                </div>
                                <div class="col-md-4"><label for="name">Last Name</label>
                                 <div class="form-group">
                                    <input  type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" value="<?php if(isset($space[0]->lname)) { echo $space[0]->lname; } ?>">
									<div class="errors"><?php echo form_error('lname'); ?></div>
                                 </div>
								 </div>
                                <div class="col-md-4">
                                  <label for="name">Phone Number</label>
                                 <div class="form-group">
                                    <input  type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone" value="<?php if(isset($space[0]->phone)) { echo $space[0]->phone; } ?>">
									<div class="errors"><?php echo form_error('phone'); ?></div>
                                 </div>
                                </div>
                                </div>
                           
                         </div>
                       </div>
                        </div>
                       
                      </div>
                  
               </div>
            </div>
</section>
<section class="ADD_Spce">
  <div class="container">
    <div class="row bs-example-popover">
                          <div class="col-md-3">
                          <div class="popover left">
                            <div class="arrow"></div>
                            <div class="popover-content">
                              <p>You can always edit or remove this space later in your Dashboard.</p>
                            </div>
                          </div>
                        </div>
      <div class="col-md-9 text-center">
        <div class="dash_sbt sec">
    <button type="submit" class="verfy">Update your space</button>
  </div>
  <p class="terms_Cond">By proceeding to add your space, you agree that this parking space listing is advertised in accordance with <a href="#">pewnypark's Terms & Conditions,</a> you have the legal right to list this parking location for rent, and that you agree with the pewnypark <a href="#">Privacy Policy.</a></p>
      </div>
      
        
      </div>
    </div>
  </div>
</section>
 </form>
<?php
$type="";
$price=0;
if(isset($com[0]->type))
{
	$price=$com[0]->price;
	$type=$com[0]->type;
}
?>
<script type="text/javascript">

function checkhour(val,chk)
{
	var type='<?php echo $type; ?>';
	var price=<?php echo $price; ?>;
	var total;
	if(type=="Percentage")
	{
		var per=parseFloat((price/100)*val);
		console.log("per "+per+" val "+val);
		total=parseFloat(per)+parseFloat(val);		
	}
	else{
		total=parseFloat(price)+parseFloat(val);
	}
	
	if(chk=='hour')
	{
	$("#hmsg").html("Driver pay $"+total);
	}
	if(chk=='day')
	{
	$("#dmsg").html("Driver pay $"+total);
	}
	if(chk=='week')
	{
	$("#wmsg").html("Driver pay $"+total);
	}
	if(chk=='month')
	{
	$("#mmsg").html("Driver pay $"+total);
	}
	
}




   $(document).ready(function(){
     $("button.multi").click(function(){
         $(this).toggleClass("mains");
     });
   });
   
   
   jQuery.validator.addMethod("numbers", function (value, element) {
		return this.optional(element) || /^(\d+|\d+,\d{1,2})$/.test(value);
	}, "Only numbers allow");

	jQuery.validator.addMethod("space", function (value, element) {
		return this.optional(element) || /^[0-9a-zA-Z]+$/.test(value);
	}, "Username allow only characters & numbers not whitespace");


	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");

	var jvalidate = $("#valid-form").validate({
		ignore: [],
		rules: {                                                                 
			'fname': {
				required: true,
				minlength: 2,
				maxlength: 100
			},
            'lname': {
				required: true,
				minlength: 2,
				maxlength: 100
			},				
			'noofspace': {
				required: true
			},
			'country': {
				required: true
			},
			'city': {
               required: true,
               minlength: 2,
               maxlength: 300
            },
			'address': {
               required: true,
               minlength: 2,
               maxlength: 400
            },
			'zipcode': {
               required: true,
               minlength: 2,
               maxlength: 15
            },
			'state': {
               required: true,
               minlength: 2,
               maxlength: 300
            },
			'description': {
               required: true,
               minlength: 2,
               maxlength: 1000
            },
			'phone': {
				required: true,
				minlength: 2,
				maxlength: 15,
				numbers:true
			},	
			'housename': {
               required: true,
               minlength: 2,
               maxlength: 300
            }

		},
		messages: {
			
		}					
	});  
</script>

<script type="text/javascript">
  $('.btn').on('click', function () {
  $(input, this).removeAttr('checked');
  $(this).removeClass('active');
});
</script>
