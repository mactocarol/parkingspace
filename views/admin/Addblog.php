
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
				
					            <!--Input Size-->
					            <!--===================================================-->
					            <form action="<?php echo base_url().$control.'/create'.$controlname; ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					    <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Title</label>
							<div class="col-md-8">
								<input type="text" placeholder="Name" class="form-control" id="title" name="title" value="<?php  if(isset($_REQUEST['title'])) { echo $_REQUEST['title']; } ?>">
								<div class="errors"><?php echo form_error('title'); ?></div>		
							</div>
						</div>  

                        <div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Description</label>
							<div class="col-md-8">
								<textarea  placeholder="Description" class="form-control" id="description" name="description"><?php  if(isset($_REQUEST['description'])) { echo $_REQUEST['description']; } ?></textarea>
			
							</div>
						</div>

 <!--<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">User</label>
							<div class="col-md-8">
							<div class="advanced_search_row">
						<select data-size="7" data-live-search="true" class="selectpicker  fill_selectbtn_in own_selectbox" data-title="Select user"  name="uid" id="uid" data-width="100%">
                        <?php
						if(isset($user))
						{
                        foreach($user as $u)
						{						
					    ?>
                        <option value="<?php echo $u->id; ?>" <?php if(isset($_REQUEST['uid'])) { if($_REQUEST['uid']==$u->id) { echo "selected"; } } ?>><?php echo $u->name; ?></option>
						<?php } } ?>
						</select>
						
                        </div>
										
							</div>
						</div> -->				                      

                       

<!--<div class="form-group">
							<label class="col-md-3 control-label" for="inputDefault">Category</label>
							<div class="col-md-8">
							<div class="advanced_search_row">
						<select data-size="7" data-live-search="true" class="selectpicker  fill_selectbtn_in own_selectbox" data-title="Select category" multiple name="category[]" id="category" data-width="100%">
                        <?php
						if(isset($category))
						{
                        foreach($category as $f)
						{						
					    ?>
                        <option value="<?php echo $f->id; ?>" <?php if(isset($_REQUEST['category'])) { if(in_array($f->id,explode( ",",$_REQUEST['category']))) { echo "selected"; } } ?>><?php echo $f->name; ?></option>
						<?php } } ?>
						</select>
						
                        </div>
										
							</div>
						</div>-->

                        <div class="form-group">
						<label class="col-md-3 control-label" for="inputDefault">Photo</label>
							<div class="col-md-6" style="padding: 6px;">
							<a href="#"  data-toggle="modal" data-target="#myModalphoto" class="btn btn-primary">Browse</a>
							<input type="hidden" name="photo" id="photo">
							</div>
							<div class="col-md-3" id="showphoto">
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
    <div class="modal-content" style="    right: 126px;
    width: 146%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Photo</h4>
      </div>
      <div class="modal-body">
       
                   <div class="row">
                        <p id="img_success"></p>
                       
                        <div class="col-md-12" >
                            <strong>Select Photo:</strong>
                            <br/>
                            <input type="file" name="ophoto" id="upload1">
							
                            <br/>
                            <button type="button" class="btn btn-pink upload-result1">Upload Photo</button>
                        
						</div>
						 <div class="col-md-12 text-center">
                            <div id="upload-demo1" ></div>
							<button data-dismiss="modal" type="button" class="btn btn-pink upload-result1">Save Photo</button>
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
				minlength: 2,
				maxlength: 50
			},
//			'category[]': {
//                required: true,
//				minlength:1
//            },			
//			'uid': {
//				required: true
//			}
			
		},
		messages: {
			
		}					
	});  
CKEDITOR.replace( 'description' );
</script>

<script type="text/javascript">

$uploadCrop1 = $('#upload-demo1').croppie({
    enableExif: true,
    viewport: {
        width: 730,
        height: 310,
        type: 'square'
    },
    boundary: {
        width: 790,
        height: 370
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
$("#photo").val(resp);
$("#showphoto").html("<img class='ephoto' src="+resp+">");  	
 });
});
</script>