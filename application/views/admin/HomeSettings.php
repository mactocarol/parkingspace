
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
<a href="<?php echo base_url().'/Admin'; ?>" class="btn btn-warning pull-right">Back</a>
</h3>
</div>
<?php
$title="title_".$this->session->userdata("site_lang");
$wtitle="wtitle_".$this->session->userdata("site_lang");
$meta="meta_".$this->session->userdata("site_lang");
$copyright="copyright_".$this->session->userdata("site_lang");
?>

<!--Input Size-->
<!--===================================================-->
<form action="<?php echo site_url('Setting/HomeSetting'); ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
<div class="panel-body">

<hr><center><strong>Main Section</strong></center><hr>
<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Heading</label>
<div class="col-md-8">
<input type="text" placeholder="Main Heading" class="form-control" id="main_heading" name="main_heading_<?=$this->session->userdata("site_lang")?>" value="<?php echo  ($main_heading) ? $main_heading->value : ''; ?>">
<div class="errors"><?php echo form_error('main_heading'); ?></div>		
</div>
</div>


<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Sub-Heading</label>
<div class="col-md-8">
<textarea  placeholder="Main Sub-Heading" class="form-control" id="supportmsg" name="main_subheading_<?=$this->session->userdata("site_lang")?>"><?php echo  ($main_subheading) ? $main_subheading->value : ''; ?></textarea>
</div>
</div>	


<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Image Upload</label>
<div class="col-md-5" style="padding: 6px;">
<a href="#" data-toggle="modal" data-target="#myModalphoto1" class="btn btn-primary">Browse</a>
<input type="hidden" name="main_image" id="main_image">

</div>
<div class="col-md-4">
<img src="<?php echo  ($main_image) ? base_url().'images/'.$main_image->value : ''; ?>">
</div>
</div>


<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Button Name</label>
<div class="col-md-8">
<input type="text" placeholder="Button Name" class="form-control" id="main_button" name="main_button_<?=$this->session->userdata("site_lang")?>" value="<?php echo  ($main_button) ? $main_button->value : ''; ?>">
<div class="errors"><?php echo form_error('main_button'); ?></div>		
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Button URL</label>
<div class="col-md-8">
<input type="text" placeholder="Button URL" class="form-control" id="main_button_url" name="main_button_url_<?=$this->session->userdata("site_lang")?>" value="<?php echo  ($main_button_url) ? $main_button_url->value : ''; ?>">
<div class="errors"><?php echo form_error('main_button_url'); ?></div>		
</div>
</div>


<hr><center><strong>Featured Section</strong></center><hr>
<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Featured Image 1</label>
<div class="col-md-5" style="padding: 6px;">
<a href="#" data-toggle="modal" data-target="#myModalfeatured1" class="btn btn-primary">Browse</a>
<input type="hidden" name="featured_image1" id="featured_image1">

</div>
<div class="col-md-4">
<img src="<?php echo  ($featured_image1) ? base_url().'images/'.$featured_image1->value : ''; ?>">
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Heading 1</label>
<div class="col-md-8">
<input type="text" placeholder="Featured Heading 1" class="form-control" id="featured_heading1" name="featured_heading1_<?=$this->session->userdata("site_lang")?>" value="<?php echo  ($featured_heading1) ? $featured_heading1->value : ''; ?>">
<div class="errors"><?php echo form_error('featured_heading1'); ?></div>		
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Content 1</label>
<div class="col-md-8">
<textarea  placeholder="Featured Content 1" class="form-control" id="featured_content1" name="featured_content1_<?=$this->session->userdata("site_lang")?>"><?php echo  ($featured_content1) ? $featured_content1->value : ''; ?></textarea>
</div>
</div>


<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Featured Image 2</label>
<div class="col-md-5" style="padding: 6px;">
<a href="#" data-toggle="modal" data-target="#myModalfeatured2" class="btn btn-primary">Browse</a>
<input type="hidden" name="featured_image2" id="featured_image2">

</div>
<div class="col-md-4">
<img src="<?php echo  ($featured_image2) ? base_url().'images/'.$featured_image2->value : ''; ?>">
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Heading 2</label>
<div class="col-md-8">
<input type="text" placeholder="Featured Heading 2" class="form-control" id="featured_heading2" name="featured_heading2_<?=$this->session->userdata("site_lang")?>" value="<?php echo  ($featured_heading2) ? $featured_heading2->value : ''; ?>">
<div class="errors"><?php echo form_error('featured_heading2'); ?></div>		
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Content 2</label>
<div class="col-md-8">
<textarea  placeholder="Featured Content 2" class="form-control" id="featured_content2" name="featured_content2_<?=$this->session->userdata("site_lang")?>"><?php echo  ($featured_content2) ? $featured_content2->value : ''; ?></textarea>
</div>
</div>


<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Featured Image 3</label>
<div class="col-md-5" style="padding: 6px;">
<a href="#" data-toggle="modal" data-target="#myModalfeatured3" class="btn btn-primary">Browse</a>
<input type="hidden" name="featured_image3" id="featured_image3">

</div>
<div class="col-md-4">
<img src="<?php echo  ($featured_image3) ? base_url().'images/'.$featured_image3->value : ''; ?>">
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Heading 3</label>
<div class="col-md-8">
<input type="text" placeholder="Featured Heading 3" class="form-control" id="featured_heading3" name="featured_heading3_<?=$this->session->userdata("site_lang")?>" value="<?php echo  ($featured_heading3) ? $featured_heading3->value : ''; ?>">
<div class="errors"><?php echo form_error('featured_heading3'); ?></div>		
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="inputDefault">Content 3</label>
<div class="col-md-8">
<textarea  placeholder="Featured Content 3" class="form-control" id="featured_content3" name="featured_content3_<?=$this->session->userdata("site_lang")?>"><?php echo  ($featured_content3) ? $featured_content3->value : ''; ?></textarea>
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


<div id="myModalphoto1" class="modal fade" role="dialog">
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
<input type="file" id="upload1">

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


<!-- Modal Featured  Image1-->
<div id="myModalfeatured1" class="modal fade" role="dialog">
<div class="modal-dialog cover_pic">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Upload Photo</h4>
</div>
<div class="modal-body">

<div class="row">
<p id="img_success"></p>
<div class="col-md-8 text-center">
<div id="featured1-demo" ></div>
<button data-dismiss="modal" type="button" class="btn btn-pink featured1-result">Save Photo</button>
</div>
<div class="col-md-4" >
<strong>Select Photo:</strong>
<br/>
<input type="file" id="featured1">

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



<!-- Modal Featured  Image2-->
<div id="myModalfeatured2" class="modal fade" role="dialog">
<div class="modal-dialog cover_pic">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Upload Photo</h4>
</div>
<div class="modal-body">

<div class="row">
<p id="img_success"></p>
<div class="col-md-8 text-center">
<div id="featured2-demo" ></div>
<button data-dismiss="modal" type="button" class="btn btn-pink featured2-result">Save Photo</button>
</div>
<div class="col-md-4" >
<strong>Select Photo:</strong>
<br/>
<input type="file" id="featured2">

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



<!-- Modal Featured  Image3-->
<div id="myModalfeatured3" class="modal fade" role="dialog">
<div class="modal-dialog cover_pic">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Upload Photo</h4>
</div>
<div class="modal-body">

<div class="row">
<p id="img_success"></p>
<div class="col-md-8 text-center">
<div id="featured3-demo" ></div>
<button data-dismiss="modal" type="button" class="btn btn-pink featured3-result">Save Photo</button>
</div>
<div class="col-md-4" >
<strong>Select Photo:</strong>
<br/>
<input type="file" id="featured3">

<br/>
<button type="button" class="btn btn-pink upload-result3">Upload Photo</button>

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
'meta': {
required: true,
minlength: 3,
maxlength: 250
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
    $("#main_image").val(resp); 
	$("#showphoto").html("<img class='ephoto' src="+resp+">");
 });
});
</script>

<script>
$featuredCrop1 = $('#featured1-demo').croppie({
    enableExif: true,
    viewport: {
        width: 350,
        height: 216,
        type: 'square'
    },
    boundary: {
        width: 355,
        height: 221
    }
});

$('#featured1').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $featuredCrop1.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.featured1-result').on('click', function (ev) {
 $featuredCrop1.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#featured_image1").val(resp); 
	$("#showphoto").html("<img class='ephoto' src="+resp+">");
 });
});
</script>

<script>
$featuredCrop2 = $('#featured2-demo').croppie({
    enableExif: true,
    viewport: {
        width: 350,
        height: 216,
        type: 'square'
    },
    boundary: {
        width: 355,
        height: 221
    }
});

$('#featured2').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $featuredCrop2.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.featured2-result').on('click', function (ev) {
 $featuredCrop2.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#featured_image2").val(resp); 
	$("#showphoto").html("<img class='ephoto' src="+resp+">");
 });
});
</script>


<script>
$featuredCrop3 = $('#featured3-demo').croppie({
    enableExif: true,
    viewport: {
        width: 350,
        height: 216,
        type: 'square'
    },
    boundary: {
        width: 355,
        height: 221
    }
});

$('#featured3').on('change', function () { 
 var reader = new FileReader();
    reader.onload = function (e) {
     $featuredCrop3.croppie('bind', {
      url: e.target.result
     }).then(function(){
      console.log('jQuery bind complete');
     });
     
    }
    reader.readAsDataURL(this.files[0]);
});

$('.featured3-result').on('click', function (ev) {
 $featuredCrop3.croppie('result', {
  type: 'canvas',
  size: 'viewport'
 }).then(function (resp) {
    $("#featured_image3").val(resp); 
	$("#showphoto").html("<img class='ephoto' src="+resp+">");
 });
});
</script>