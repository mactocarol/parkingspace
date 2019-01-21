<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>dist/dropzone.css" />

<script type="text/javascript" src="<?php echo base_url(); ?>dist/dropzone.js"></script>

<section class="contact_us_bg">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="sucess-msg text-center">
            	<!--<img src="<?php echo base_url(); ?>frontend/images/camera.png" width="100px">-->
                <h3>Add photos to get more bookings</h3>
                <p>We've found that drivers are twice as likely to book if they can see a snap of it first!</p>
            </div>
         </div>
      </div>
   </div>
</section>
<div class="clearfix"></div>
<section class="info dash">
   <div class="container">
   <div class="col-md-12">
     <h4><span class="back_btn"><a href="<?php echo base_url(); ?>Dashboard/myspace" class="btn btn-primary">Back</a></span></h4>
	 </div>
      <div class="bx_shdo">
	  
        <div class="next-step-outer">
		
        	 <div  class="file_upload">

		<form enctype="multipart/form-data" action="<?php echo base_url(); ?>Dashboard/savefile" class="dropzone" method="post">

			<input type="hidden" value="<?php if($this->uri->segment(2)) { echo $this->uri->segment(2); } ?>" name="sid" id="sid">

			<div  class="dz-message needsclick" data-toggle="tooltip" title="Drag & drop file here">

			    <i class="fa fa-cloud-upload faicons"></i><br>

				<strong>Drop files here or click to upload.</strong>

			</div>
			
				
			<?php 
			if(isset($photo))
			{
				foreach($photo as $g)
				{ ?>
			
			<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">  
			 <div class="dz-image">
			 
			 <a data-toggle="modal" data-target=".myModal" onClick="setID(<?php echo $g->id; ?>);" data-tooltip="tooltip" title="Delete Photo"  style="float: right;color: red;font-size:24px" href="#"><i class="fa fa-close"></i></a>
			 
			<a href="<?php echo base_url(); ?>upload/space/<?php echo $g->photo; ?>" data-lightbox="example-set">		
			<img  data-dz-thumbnail="" class="img-lg" alt="Image" src="<?php echo base_url(); ?>upload/space/<?php echo $g->photo; ?>">
			</a>
		     </div>
            </div>					
			<?php }} ?>
						

		</form>	

	</div>	
	
	<!-- <div class="next-step-btn"><a href="<?php echo base_url(); ?>Dashboard/myspace" class="next-btn">Skip</a></div>-->
  </div>
                  
               </div>
            </div>
</section>

<div id="myModal" class="modal fade myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Remove <strong>photo</strong> ?</h4>
            </div>
            <div class="modal-body">
                       <p>Are you sure want to delete this photo</p>                    
                       <p>Press yes if sure</p>						
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button onclick="deleterow()"  class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
   $(document).ready(function(){
     $("button.multi").click(function(){
         $(this).toggleClass("mains");
     });
   });
</script>

<input type="hidden" id="id">
<script>
 function setID(id)
	  {
		  document.getElementById('id').value=id;
	  }
	  
 function deleterow()
	  {
		  var id=document.getElementById('id').value;
		  var pid='<?php echo $this->uri->segment(2); ?>';
		  jQuery.ajax({
				url: '<?php echo base_url();?>Dashboard/deletephoto',
				type: 'post',
				data: {id:id,pid:pid},
			    success: function (result)
				{					
				   if(result==1)
				   {
					   window.location="<?php echo base_url(); ?>Dashboard/deletephoto/success/"+pid;
				   }
				   else{
					   window.location="<?php echo base_url(); ?>Dashboard/deletephoto/error/"+pid; 
				   }
				}
			});	
	  }	  
</script>