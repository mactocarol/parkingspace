
            <div class="col-md-8">
			<?php 
			if(isset($user[0]->email_status))
			{
				if($user[0]->email_status!=1)
				{
			?>
              <div class="attentionerror">
                <div class="row">
                   <div class="col-lg-12">
                      <div class="alert alert-info" role="alert">
                         <div class="row vertical-align">
                            <div class="col-xs-1 text-center">
                               <img src="<?php echo base_url(); ?>frontend/images/attention_1251029.png" class="img-responsive">
                            </div>
                            <div class="col-xs-11">
                               <p>Your parking spaces are not currently shown in our search results. Please <a href="<?php echo base_url(); ?>Home/resendmail">verify your email address</a> to activate your parking space listings.</p>
                            </div>
                         </div>
                      </div>
                      <div class="dash_sbt sec text-right">
                        <a href="<?php echo base_url(); ?>Dashboard/rentourspace" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add another space</a>
                     </div>
                   </div>
                </div>
              </div>
				<?php }} ?>
			  
               <div class="credit">
                  <h4><span>Parking spaces</span></h4>
                  <p>Below is a list of all your parking space listings. Under the title of each listing are a number of actions that you are able to make including editing the parking space details, photos, availability and showing or hiding your listing in our search engine.</p>
               </div>
               
               <div class="myspace_list_outer">
			   
			   <?php
			   if(isset($space))
			   {
				   foreach($space as $s)
				   {
				   ?>
               	
                 <div class="myspace_list_inner row">
                 	<div class="col-md-9">
                    	<h3><?php echo $s->typeofspace; ?> on <?php echo $s->address.', '.$s->city; ?>, <?php echo $s->zipcode; ?> <span class="price_space pull-right">$<?php echo $s->pday; ?>.00 per day</span></h3>
                        <div class="row">
                        <div class="col-md-9">
                        	<h6>Not yet reviewed</h6>
                            <p>Private <?php echo $s->typeofspace; ?> - (<?php echo $s->noofspace; ?> spaces)</p>
                             <div class="btn-group">
                              <a href="#" class="btn btn-primary">Activate</a>
                              <a href="<?php echo base_url(); ?>editspace/<?php echo base64_encode($s->id); ?>" class="btn btn-primary active">Edit</a>
                              <a href="<?php echo base_url(); ?>availability/<?php echo base64_encode($s->id); ?>" class="btn btn-primary active">Availability</a>
                              <a href="<?php echo base_url(); ?>addphoto/<?php echo base64_encode($s->id); ?>" class="btn btn-primary active">Photos</a>
                            </div>
                        </div>
                        <div class="col-md-3"><a class="pull-right">Instant Bookings</a>
						</div>
                        </div>
                    </div>
					<?php
					$address=str_replace(" ", "+",$s->address.$s->city);
					?>
                 	<div class="col-md-3"><iframe style="width:100%;" frameborder="0" id="cusmap" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $address; ?>&output=embed"></iframe>
					</div>
                 </div>
			   <?php }} ?>
 	
               </div>
            </div>
        
<section class="modl">
   <div class="container">
   <div class="modal fade" id="myModal">
      <div class="modal-dialog">
         <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
               <h4 class="modal-title">Add a vehicle</h4>
               <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-4 text-right">Licence Plate</div>
                  <div class="col-md-8">
                     <input type="text" name="" class="mdl_txt">
                     <button type="button" class="btn btn-info grn frmshow">Lookup</button>
                     <p>Some parking spaces use license plate verification and therefore can't accept bookings where this information is not known.</p>
                  </div>
               </div>
               <div class="notify mdls togle">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="chiller_cb hired_V">
                           <input id="myCheckbox" type="checkbox" >
                           <label for="myCheckbox">This is a hired vehicle</label>
                           <span></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="togle">
                  <div class="row">
                     <div class="col-md-4 text-right">Vehicle Type</div>
                     <div class="col-md-8">
                        <div class="form-group">
                           <div class="select">
                              <select class="selectpicker" data-style="btn-info custom"  data-max-options="3" data-live-search="true">
                                 <optgroup label="Web">
                                    <option>Please Select</option>
                                    <option>car</option>
                                    <option>4x4</option>
                                    <option>minibus</option>
                                    <option>coach</option>
                                    <option>motorcycle</option>
                                    <option>bicycle</option>
                                 </optgroup>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 text-right">Make</div>
                     <div class="col-md-8">
                        <div class="form-group">
                           <div class="select">
                              <select class="selectpicker" data-style="btn-info custom"  data-max-options="3" data-live-search="true">
                                 <optgroup label="Web">
                                    <option value="AC" data-shortval="AC" data-longval="AC">AC</option>
                                    <option value="Acura" data-shortval="Acura" data-longval="Acura">Acura</option>
                                    <option value="Aixam" data-shortval="Aixam" data-longval="Aixam">Aixam</option>
                                    <option value="Alfa Romeo" data-shortval="Alfa Romeo" data-longval="Alfa Romeo">Alfa Romeo</option>
                                    <option value="AMC" data-shortval="AMC" data-longval="AMC">AMC</option>
                                    <option value="ARO" data-shortval="ARO" data-longval="ARO">ARO</option>
                                    <option value="ASIA" data-shortval="ASIA" data-longval="ASIA">ASIA</option>
                                    <option value="Aston Martin" data-shortval="Aston Martin" data-longval="Aston Martin">Aston Martin</option>
                                    <option value="Audi" data-shortval="Audi" data-longval="Audi">Audi</option>
                                    <option value="Austin" data-shortval="Austin" data-longval="Austin">Austin</option>
                                    <option value="Bedford" data-shortval="Bedford" data-longval="Bedford">Bedford</option>
                                    <option value="Bentley" data-shortval="Bentley" data-longval="Bentley">Bentley</option>
                                    <option value="Bitter" data-shortval="Bitter" data-longval="Bitter">Bitter</option>
                                    <option value="Bugatti" data-shortval="Bugatti" data-longval="Bugatti">Bugatti</option>
                                    <option value="BL" data-shortval="BL" data-longval="BL">BL</option>
                                    <option value="BMW" data-shortval="BMW" data-longval="BMW">BMW</option>
                                    <option value="BOND" data-shortval="BOND" data-longval="BOND">BOND</option>
                                    <option value="Bristol" data-shortval="Bristol" data-longval="Bristol">Bristol</option>
                                    <option value="Buick" data-shortval="Buick" data-longval="Buick">Buick</option>
                                    <option value="Cadillac" data-shortval="Cadillac" data-longval="Cadillac">Cadillac</option>
                                    <option value="Caterham" data-shortval="Caterham" data-longval="Caterham">Caterham</option>
                                    <option value="Chevrolet" data-shortval="Chevrolet" data-longval="Chevrolet">Chevrolet</option>
                                    <option value="Chrysler" data-shortval="Chrysler" data-longval="Chrysler">Chrysler</option>
                                    <option value="Citroen" data-shortval="Citroen" data-longval="Citroen">Citroen</option>
                                    <option value="COLT" data-shortval="COLT" data-longval="COLT">COLT</option>
                                    <option value="Commer" data-shortval="Commer" data-longval="Commer">Commer</option>
                                    <option value="Dacia" data-shortval="Dacia" data-longval="Dacia">Dacia</option>
                                    <option value="Daewoo" data-shortval="Daewoo" data-longval="Daewoo">Daewoo</option>
                                    <option value="DAF" data-shortval="DAF" data-longval="DAF">DAF</option>
                                    <option value="Daihatsu" data-shortval="Daihatsu" data-longval="Daihatsu">Daihatsu</option>
                                    <option value="Daimler" data-shortval="Daimler" data-longval="Daimler">Daimler</option>
                                    <option value="Dallas" data-shortval="Dallas" data-longval="Dallas">Dallas</option>
                                    <option value="Datsun" data-shortval="Datsun" data-longval="Datsun">Datsun</option>
                                    <option value="De Tomaso" data-shortval="De Tomaso" data-longval="De Tomaso">De Tomaso</option>
                                    <option value="Delorean" data-shortval="Delorean" data-longval="Delorean">Delorean</option>
                                    <option value="Dodge" data-shortval="Dodge" data-longval="Dodge">Dodge</option>
                                    <option value="Ducati" data-shortval="Ducati" data-longval="Ducati">Ducati</option>
                                    <option value="EBRO" data-shortval="EBRO" data-longval="EBRO">EBRO</option>
                                    <option value="FBS" data-shortval="FBS" data-longval="FBS">FBS</option>
                                    <option value="Ferrari" data-shortval="Ferrari" data-longval="Ferrari">Ferrari</option>
                                    <option value="Fiat" data-shortval="Fiat" data-longval="Fiat">Fiat</option>
                                    <option value="Ford" data-shortval="Ford" data-longval="Ford">Ford</option>
                                    <option value="Freight Rover" data-shortval="Freight Rover" data-longval="Freight Rover">Freight Rover</option>
                                    <option value="FSO" data-shortval="FSO" data-longval="FSO">FSO</option>
                                    <option value="GEM" data-shortval="GEM" data-longval="GEM">GEM</option>
                                    <option value="Gilbern" data-shortval="Gilbern" data-longval="Gilbern">Gilbern</option>
                                    <option value="Ginetta" data-shortval="Ginetta" data-longval="Ginetta">Ginetta</option>
                                    <option value="Harley Davidson" data-shortval="Harley Davidson" data-longval="Harley Davidson">Harley Davidson</option>
                                    <option value="Hillman" data-shortval="Hillman" data-longval="Hillman">Hillman</option>
                                    <option value="Holden" data-shortval="Holden" data-longval="Holden">Holden</option>
                                    <option value="Honda" data-shortval="Honda" data-longval="Honda">Honda</option>
                                    <option value="Hyundai" data-shortval="Hyundai" data-longval="Hyundai">Hyundai</option>
                                    <option value="Isuzu" data-shortval="Isuzu" data-longval="Isuzu">Isuzu</option>
                                    <option value="Iveco" data-shortval="Iveco" data-longval="Iveco">Iveco</option>
                                    <option value="Jaguar" data-shortval="Jaguar" data-longval="Jaguar">Jaguar</option>
                                    <option value="Jeep" data-shortval="Jeep" data-longval="Jeep">Jeep</option>
                                    <option value="Jensen" data-shortval="Jensen" data-longval="Jensen">Jensen</option>
                                    <option value="Kawasaki" data-shortval="Kawasaki" data-longval="Kawasaki">Kawasaki</option>
                                    <option value="Khaleej" data-shortval="Khaleej" data-longval="Khaleej">Khaleej</option>
                                    <option value="KIA" data-shortval="KIA" data-longval="KIA">KIA</option>
                                    <option value="LADA" data-shortval="LADA" data-longval="LADA">LADA</option>
                                    <option value="Lamborghini" data-shortval="Lamborghini" data-longval="Lamborghini">Lamborghini</option>
                                    <option value="Lancia" data-shortval="Lancia" data-longval="Lancia">Lancia</option>
                                    <option value="Land Rover" data-shortval="Land Rover" data-longval="Land Rover">Land Rover</option>
                                    <option value="LDV" data-shortval="LDV" data-longval="LDV">LDV</option>
                                    <option value="Lexus" data-shortval="Lexus" data-longval="Lexus">Lexus</option>
                                    <option value="Leyland-Daf" data-shortval="Leyland-Daf" data-longval="Leyland-Daf">Leyland-Daf</option>
                                    <option value="Ligier" data-shortval="Ligier" data-longval="Ligier">Ligier</option>
                                    <option value="Lincoln" data-shortval="Lincoln" data-longval="Lincoln">Lincoln</option>
                                    <option value="Lonsdale" data-shortval="Lonsdale" data-longval="Lonsdale">Lonsdale</option>
                                    <option value="Lotus" data-shortval="Lotus" data-longval="Lotus">Lotus</option>
                                    <option value="Mahindra" data-shortval="Mahindra" data-longval="Mahindra">Mahindra</option>
                                    <option value="Marcos" data-shortval="Marcos" data-longval="Marcos">Marcos</option>
                                    <option value="Marlin" data-shortval="Marlin" data-longval="Marlin">Marlin</option>
                                    <option value="Maserati" data-shortval="Maserati" data-longval="Maserati">Maserati</option>
                                    <option value="Maybach" data-shortval="Maybach" data-longval="Maybach">Maybach</option>
                                    <option value="Mazda" data-shortval="Mazda" data-longval="Mazda">Mazda</option>
                                    <option value="MCC" data-shortval="MCC" data-longval="MCC">MCC</option>
                                    <option value="Mercedes" data-shortval="Mercedes" data-longval="Mercedes">Mercedes</option>
                                    <option value="Mercury" data-shortval="Mercury" data-longval="Mercury">Mercury</option>
                                    <option value="MG" data-shortval="MG" data-longval="MG">MG</option>
                                    <option value="Microcar" data-shortval="Microcar" data-longval="Microcar">Microcar</option>
                                    <option value="Mini" data-shortval="Mini" data-longval="Mini">Mini</option>
                                    <option value="Mitsubishi" data-shortval="Mitsubishi" data-longval="Mitsubishi">Mitsubishi</option>
                                    <option value="Morgan" data-shortval="Morgan" data-longval="Morgan">Morgan</option>
                                    <option value="Morris" data-shortval="Morris" data-longval="Morris">Morris</option>
                                    <option value="Nissan" data-shortval="Nissan" data-longval="Nissan">Nissan</option>
                                    <option value="Noble" data-shortval="Noble" data-longval="Noble">Noble</option>
                                    <option value="NSU" data-shortval="NSU" data-longval="NSU">NSU</option>
                                    <option value="OKA" data-shortval="OKA" data-longval="OKA">OKA</option>
                                    <option value="OPEL" data-shortval="OPEL" data-longval="OPEL">OPEL</option>
                                    <option value="Panther" data-shortval="Panther" data-longval="Panther">Panther</option>
                                    <option value="Perodua" data-shortval="Perodua" data-longval="Perodua">Perodua</option>
                                    <option value="Peugeot" data-shortval="Peugeot" data-longval="Peugeot">Peugeot</option>
                                    <option value="Piaggio" data-shortval="Piaggio" data-longval="Piaggio">Piaggio</option>
                                    <option value="Porsche" data-shortval="Porsche" data-longval="Porsche">Porsche</option>
                                    <option value="Portaro" data-shortval="Portaro" data-longval="Portaro">Portaro</option>
                                    <option value="Proton" data-shortval="Proton" data-longval="Proton">Proton</option>
                                    <option value="Range Rover" data-shortval="Range Rover" data-longval="Range Rover">Range Rover</option>
                                    <option value="Reliant" data-shortval="Reliant" data-longval="Reliant">Reliant</option>
                                    <option value="Renault" data-shortval="Renault" data-longval="Renault">Renault</option>
                                    <option value="REVA" data-shortval="REVA" data-longval="REVA">REVA</option>
                                    <option value="Rolls Royce" data-shortval="Rolls Royce" data-longval="Rolls Royce">Rolls Royce</option>
                                    <option value="Rover" data-shortval="Rover" data-longval="Rover">Rover</option>
                                    <option value="SAAB" data-shortval="SAAB" data-longval="SAAB">SAAB</option>
                                    <option value="SAN" data-shortval="SAN" data-longval="SAN">SAN</option>
                                    <option value="Santana" data-shortval="Santana" data-longval="Santana">Santana</option>
                                    <option value="SAO" data-shortval="SAO" data-longval="SAO">SAO</option>
                                    <option value="SEAT" data-shortval="SEAT" data-longval="SEAT">SEAT</option>
                                    <option value="Secma" data-shortval="Secma" data-longval="Secma">Secma</option>
                                    <option value="Simca" data-shortval="Simca" data-longval="Simca">Simca</option>
                                    <option value="Skoda" data-shortval="Skoda" data-longval="Skoda">Skoda</option>
                                    <option value="Smart" data-shortval="Smart" data-longval="Smart">Smart</option>
                                    <option value="Ssangyong" data-shortval="Ssangyong" data-longval="Ssangyong">Ssangyong</option>
                                    <option value="Subaru" data-shortval="Subaru" data-longval="Subaru">Subaru</option>
                                    <option value="Suzuki" data-shortval="Suzuki" data-longval="Suzuki">Suzuki</option>
                                    <option value="Talbot" data-shortval="Talbot" data-longval="Talbot">Talbot</option>
                                    <option value="TATA" data-shortval="TATA" data-longval="TATA">TATA</option>
                                    <option value="Toyota" data-shortval="Toyota" data-longval="Toyota">Toyota</option>
                                    <option value="Triumph" data-shortval="Triumph" data-longval="Triumph">Triumph</option>
                                    <option value="TVR" data-shortval="TVR" data-longval="TVR">TVR</option>
                                    <option value="Vanden Plas" data-shortval="Vanden Plas" data-longval="Vanden Plas">Vanden Plas</option>
                                    <option value="Vauxhall" data-shortval="Vauxhall" data-longval="Vauxhall">Vauxhall</option>
                                    <option value="Venturi" data-shortval="Venturi" data-longval="Venturi">Venturi</option>
                                    <option value="Vexel" data-shortval="Vexel" data-longval="Vexel">Vexel</option>
                                    <option value="Volkswagen" data-shortval="Volkswagen" data-longval="Volkswagen">Volkswagen</option>
                                    <option value="Volvo" data-shortval="Volvo" data-longval="Volvo">Volvo</option>
                                    <option value="Yamaha" data-shortval="Yamaha" data-longval="Yamaha">Yamaha</option>
                                    <option value="Yugo" data-shortval="Yugo" data-longval="Yugo">Yugo</option>
                                    <option value="Other" data-shortval="Other" data-longval="Other">Other</option>
                                 </optgroup>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--End of Row -->
                  <div class="row">
                     <div class="col-md-4 text-right">Model</div>
                     <div class="col-md-8">
                        <input type="text" name="" class="mdl_txt">
                     </div>
                  </div>
               </div>
               <div id="togle2">
                 <div class="row">
                     <div class="col-md-4 text-right">Hire company</div>
                     <div class="col-md-8">
                        <div class="form-group">
                           <div class="select">
                              <select class="selectpicker" data-style="btn-info custom"  data-max-options="3" data-live-search="true">
                                 <optgroup label="Web">
                                    <option>Please Select</option>
                                    <option value="Alamo" data-shortval="Alamo" data-longval="Alamo">Alamo</option>
                                    <option value="Avis" data-shortval="Avis" data-longval="Avis">Avis</option>
                                    <option value="BMW DriveNow" data-shortval="BMW DriveNow" data-longval="BMW DriveNow">BMW DriveNow</option>
                                    <option value="Car2Go" data-shortval="Car2Go" data-longval="Car2Go">Car2Go</option>
                                    <option value="City Car Club" data-shortval="City Car Club" data-longval="City Car Club">City Car Club</option>
                                    <option value="Enterprise" data-shortval="Enterprise" data-longval="Enterprise">Enterprise</option>
                                    <option value="Europcar" data-shortval="Europcar" data-longval="Europcar">Europcar</option>
                                    <option value="GetAround" data-shortval="GetAround" data-longval="GetAround">GetAround</option>
                                    <option value="Hertz" data-shortval="Hertz" data-longval="Hertz">Hertz</option>
                                    <option value="RelayRides" data-shortval="RelayRides" data-longval="RelayRides">RelayRides</option>
                                    <option value="Sixt" data-shortval="Sixt" data-longval="Sixt">Sixt</option>
                                    <option value="Thrifty" data-shortval="Thrifty" data-longval="Thrifty">Thrifty</option>
                                    <option value="Zipcar" data-shortval="Zipcar" data-longval="Zipcar">Zipcar</option>
                                    <option value="Other" data-shortval="(Other)" data-longval="(Other)">(Other)</option>
                                 </optgroup>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
               <button type="submit" class="btn btn-large btn-primary grn frmshow">Add vehicle</button>
               <button type="button" class="btn btn-large" data-dismiss="modal" rel="close">Cancel</button>
            </div>
         </div>
      </div>
   </div>
</section>

<script type="text/javascript">
   $(".driver_img").click(function(){
   $(".tbshow").show()
   });
</script>
<script type="text/javascript">
   $(".frmshow").click(function(){
   $(".togle").show()
   });
</script>
<script type="text/javascript">
   $(".hired_V").click(function(){
   $("#togle2").show()
   $(".togle").hide()
   });
</script>