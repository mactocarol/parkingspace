 <?php
 if($this->session->userdata('uid'))
 { 
 }
 else {
 ?>
 <section class="news_latter">
    <form method="post" action="<?php echo site_url('Home/subscribenewsletter');?>">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-4 no-padding2">
            <div class="news_ltr">
              <h4>Sign up for <span>newsletter</span></h4>
            </div>
          </div>
          <div class="col-md-6 col-sm-4 no-padding">
            <input type="text" name="nemail" placeholder="Email Here.." class="news_txt">
          </div>
          <div class="col-md-2 col-sm-4">
            <input type="submit" name="" value="Subscribe" class="sub_btn">
          </div>
        </div>
      </div>
      </form>
    </section>
 <?php } ?>	
 
 
    <footer>
      <div class="container">
        <div class="ftr_inr">
        <div class="row">
          <div class="call_outer wow slideInRight">
          <div class="col-md-3 col-sm-3">
            <div class="ftr_logo">
		<?php
		if(isset($front[0]->ophoto))
		{ ?>
              <img src="<?php echo base_url(); ?>images/<?php echo $front[0]->ophoto; ?>">
		<?php } ?>
            </div>
            <div class="ftr_logo_txt">
              <p><?php
		$meta="meta_".$this->session->userdata('site_lang');	  
		if(isset($front[0]->$meta))
		{ 
	      echo $front[0]->$meta;
		}
	     ?>
	    </p>
            </div>
          </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="call_outer wow slideInRight">
            <div class="call_us">
              <h6>Call us on line 1</h6>
              <h3>100.1212.2000</h3>
            </div>
              <div class="useful_links">
                <h4>useful link</h4>
                <ul>
                  <li><a href="<?php echo site_url('privacy');?>">Privacy Policy</a></li>
                  <li><a href="<?php echo site_url('Rentout');?>">Rentout</a></li>
                  <li><a href="<?php echo site_url('');?>">Search Space</a></li>
                  <li><a href="<?php echo site_url('Home/login');?>">Register for new member</a></li>
                  <li><a href="<?php echo site_url('blogs');?>">Blog</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="call_outer wow slideInRight">
            <div class="call_us">
              <h6>Call us on line 1</h6>
              <h3>100.2424.2000</h3>
            </div>
            <div class="useful_links">
                <h4>Our info</h4>
                <ul>
                  <li><a href="<?php echo site_url('aboutus');?>">About pewny parking</a></li>
                  <!--<li><a href="#">Our mission & strategy</a></li>
                  <li><a href="#">Our vision</a></li>
                  <li><a href="#">Royal cars advantages</a></li>-->
                  <li><a href="<?php echo site_url('contactus');?>">Contact us</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="call_outer wow slideInRight">
            <div class="call_us">
              <a href="#"><i class="fa fa-map" aria-hidden="true"></i> <span>Pewny Parking on Map</span></a>
            </div>
            <div class="useful_links">
                <h4>Account information</h4>
                <ul>
                  <li><a href="<?php echo site_url('Home/login');?>">Login to my account</a></li>
                  <!--<li><a href="#">Press Releases</a></li>-->
                  <li><a href="<?php echo site_url('Dashboard');?>">User Dashboard</a></li>
                  <!--<li><a href="#">Email Address</a></li>
                  <li><a href="#">Lorem Ipsum dollar sit</a></li>-->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="btm_ftr">
        <div class="ftr_cnt">
        <div class="col-md-4">
          <div class="copy_Right">
            <p><?php
		$cp="copyright_".$this->session->userdata('site_lang');	  
		if(isset($front[0]->$cp))
		{ 
	      echo $front[0]->$cp;
		}
	     ?></p>
          </div>
        </div>
        <div class="col-md-8">
          <div class="ftr_social text-right">
            <ul>
              <li>
                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> <span>Facebook</span></a>
                 <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> <span>Twitter</span></a>
                  <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> <span>Instagram</span></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
   </div>
 </footer>
 
 	<script type="text/javascript" src="<?php echo base_url(); ?>dist/js/lightbox-plus-jquery.min.js"></script>
	 <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/bootsnav.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/wow.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/numscroller.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/script.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/moment.js"></script>
	 <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>frontend/js/bootstrap-select.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>dist/js/bootstrap-datepicker.js"></script>
 
 <script>
 
 
 
 $(document).ready(function() {
	 
	 var nowDate = new Date();
	 var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
		
	  $( ".birthdatepicker" ).datepicker({
		format: 'yyyy-mm-dd',
		endDate: today,
		startDate: new Date('01/01/1920'),
		autoclose: true		 
	  });
	 
   var table = $('#example').DataTable( {
        responsive: {
            details: {
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            }
        }
    } );
	
   $('#example tfoot th').each( function () {
        var title = $(this).text();
		if(title!='')
        $(this).html( '<input style="width:80px" class="form-control"  type="text" placeholder="Search" />' );
    } );
 
   
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

} );	
	
	
 </script>
 
    
    
   
  </body>
</html>