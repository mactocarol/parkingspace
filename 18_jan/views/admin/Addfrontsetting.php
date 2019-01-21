
   <div id="content-container">
    
                <div id="page-head">
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow"><?php echo $controlnamemsg; ?></h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="#"><?php echo $control; ?></a></li>
					<li class="active"><?php echo $controlnamemsg; ?></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                  <?php 
	    if($this->session->flashdata('result')) { 
		?>
		<div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h4 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?></h4> 
		</div>
		<?php } ?>   
					
				
					<div class="row">
					    <div class="col-lg-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title"><?php echo $controlnamemsg; ?>
									<a href="<?php echo base_url().$control.'/'.$controlname; ?>" class="btn btn-warning pull-right">Back</a>
									</h3>
					            </div>
<?php
$title="title_".$this->session->userdata("site_lang");
$meta="meta_".$this->session->userdata("site_lang");
$copyright="copyright_".$this->session->userdata("site_lang");
?>
					
					            <!--Input Size-->
					            <!--===================================================-->
					            <form action="<?php echo base_url().$control.'/create'.$controlname; ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Name</label>
							<div class="col-md-8">
								<input type="text" placeholder="Name" class="form-control" id="title" name="title" value="<?php  if(isset($_REQUEST['title'])) { echo $_REQUEST['title']; } ?>">
								<div class="errors"><?php echo form_error('title'); ?></div>		
							</div>
						</div>                
					                   
                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Title</label>
							<div class="col-md-8">
								<input type="text" placeholder="Website Title" class="form-control" id="wtitle" name="wtitle" value="<?php  if(isset($_REQUEST['wtitle'])) { echo $_REQUEST['wtitle']; } ?>">
								<div class="errors"><?php echo form_error('wtitle'); ?></div>		
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Footer Copyright</label>
							<div class="col-md-8">
								<input type="text" placeholder="Footer" class="form-control" id="copyright" name="copyright" value="<?php if(isset($_REQUEST['copyright'])) { echo $_REQUEST['copyright']; } ?>">
								<div class="errors"><?php echo form_error('copyright'); ?></div>	
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Best Regard Message</label>
							<div class="col-md-8">
								<input  type="text" placeholder="Best Regard Message" class="form-control" id="best" name="best" value="<?php if(isset($_REQUEST['best'])) { echo $_REQUEST['best']; } ?>">
									
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Support Email</label>
							<div class="col-md-8">
								<input type="text" placeholder="Support Email" class="form-control" id="support" name="support" value="<?php if(isset($_REQUEST['support'])) { echo $_REQUEST['support']; } ?>">
									
							</div>
						</div>
						
						 <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Support Message</label>
							<div class="col-md-8">
								<textarea  placeholder="Support Message" class="form-control" id="supportmsg" name="supportmsg"><?php if(isset($_REQUEST['supportmsg'])) { echo $_REQUEST['supportmsg']; } ?></textarea>
								
							</div>
						</div>	

                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Footer Description</label>
							<div class="col-md-8">
								<textarea  placeholder="Footer Description" class="form-control" id="meta" name="meta"><?php if(isset($_REQUEST['meta'])) { echo $_REQUEST['meta']; } ?></textarea>
								<div class="errors"><?php echo form_error('meta'); ?></div>	
							</div>
						</div>

	                    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Logo Upload</label>
							<div class="col-md-5" style="padding: 6px;">
							<a href="#"  data-toggle="modal" data-target="#myModalphoto" class="btn btn-pink">Browse</a>
							<input type="hidden" name="logo" id="logo">
							</div>
							<div class="col-md-4" id="showphoto">
							</div>
						</div> 						

						

                       	<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault"> Favicon Upload</label>
							<div class="col-md-8" style="padding: 6px;">
							<a href="#"  data-toggle="modal" data-target="#myModalphoto2" class="btn btn-pink">Browse</a>
							<input type="hidden" name="favicon" id="favicon">
							</div>
						</div>	

<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Paypal Email</label>
							<div class="col-md-8">
								<input type="text" placeholder="Paypal Email" class="form-control" id="pemail" name="pemail" value="<?php if(isset($_REQUEST['pemail'])) { echo $_REQUEST['pemail']; } ?>">
									
							</div>
						</div>	

<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Paypal Url</label>
							<div class="col-md-8">
								<input type="text" placeholder="Paypal Url" class="form-control" id="purl" name="purl" value="<?php if(isset($_REQUEST['purl'])) { echo $_REQUEST['purl']; } ?>">
									
							</div>
						</div>							
										
										
					                </div>
					                <div class="panel-footer">
					                    <div class="row">
					                        <div class="col-sm-9 col-sm-offset-3">
					                            <button class="btn btn-mint" type="submit">Submit</button>
					                            <a class="btn btn-warning" href="<?php echo base_url().$control.'/'.$controlname; ?>">Cancel</a>
					                        </div>
					                    </div>
					                </div>
									
									
									
									<div id="myModalphoto" class="modal fade" role="dialog">
  <div class="modal-dialog cover_pic">

    <!-- Modal Cover Picture-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
       
                   <div class="row">
                        <p id="img_success"></p>
                        <div class="col-md-8 text-center">
                            <div id="upload-demo1" ></div>
							<button data-dismiss="modal" type="button" class="btn btn-pink upload-result1">Save Photo</button>
                        </div>
                        <div class="col-md-4" >
                            <strong>Select Photo:</strong>
                            <br/>
                            <input type="file" name="ophoto" id="upload1">
							
                            <br/>
                            <button type="button" class="btn btn-pink upload-result1">Upload Photo</button>
                        
						</div>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

			
<div id="myModalphoto2" class="modal fade" role="dialog">
  <div class="modal-dialog cover_pic">

    <!-- Modal Cover Picture-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
       
                   <div class="row">
                        <p id="img_success"></p>
                        <div class="col-md-8 text-center">
                            <div id="upload-demo2" ></div>
							<button data-dismiss="modal" type="button" class="btn btn-pink upload-result2">Save Photo</button>
                        </div>
                        <div class="col-md-4" >
                            <strong>Select Photo:</strong>
                            <br/>
                            <input type="file" id="upload2">
							
                            <br/>
                            <button type="button" class="btn btn-pink upload-result2">Upload Photo</button>
                        
						</div>
                    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>			
			
		
					            </form>
					            <!--===================================================-->
					            <!--End Input Size-->
					
					
					        </div>
					    </div>
				
					</div>

                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->
			
			
	
			
<script>


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
			'title': {
				required: true,
				minlength: 3,
				maxlength: 100
			},
			'wtitle': {
				required: true,
				minlength: 3,
				maxlength: 500
			},
			'pemail': {
				required: true,
				email:true,
				minlength: 3,
				maxlength: 300
			},
			'purl': {
				required: true,
				url:true
			},
			'meta': {
				required: true,
				minlength: 3,
				maxlength: 250
			},
			'copyright': {
				required: true,
				minlength: 3,
				maxlength: 250
			}	
			
		},
		messages: {
			
		}					
	});  

</script>
<script type="text/javascript">
$uploadCrop1 = $('#upload-demo1').croppie({
    enableExif: true,
    viewport: {
        width: 160,
        height: 80,
        type: 'square'
    },
    boundary: {
        width: 200,
        height: 120
    }
});

$('#upload1').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $uploadCrop1.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result1').on('click', function (ev) {
 $uploadCrop1.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#logo").val(resp);
$("#showphoto").html("<img class='ephoto' src="+resp+">"); 	
 });
});



$uploadCrop2 = $('#upload-demo2').croppie({
    enableExif: true,
    viewport: {
        width: 32,
        height: 32,
        type: 'square'
    },
    boundary: {
        width: 100,
        height: 100
    }
});

$('#upload2').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $uploadCrop2.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result2').on('click', function (ev) {
 $uploadCrop2.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#favicon").val(resp);
    	
 });
});
</script>