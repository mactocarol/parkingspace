
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
					            <form action="<?php echo base_url().$control.'/update'.$controlname.'/'; ?><?php if(isset($coupon[0]->id)) { echo $coupon[0]->id; } ?>" id="valid-form" class="form-horizontal" method="post" enctype="multipart/form-data">
					                <div class="panel-body">
					  

<div class="form-group">
							<label class="control-label col-md-3">Coupon Code Name</label>
							<div class="col-md-9">
							  <input class="form-control" name="name" id="name" type="text" placeholder="Enter coupon name" value="<?php  if(isset($coupon[0]->name)) { echo $coupon[0]->name; } ?>" >
							<div class="errors"><?php echo form_error('name'); ?></div>
							</div>
						  </div>
						  
						    <div class="form-group">
							<label class="control-label col-md-3">Price type</label>
							<div class="col-md-9">
							  <select class="form-control col-md-8" name="type" id="type" >
							  <option value="1" <?php  if(isset($coupon[0]->type)) { if($coupon[0]->type==1) { echo "selected"; } } ?>>Percentage</option>
							  <option value="2" <?php  if(isset($coupon[0]->type)) { if($coupon[0]->type==2) { echo "selected"; } } ?>>Fixed</option>
							  </select>
							  <div class="errors"><?php echo form_error('type'); ?></div>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label class="control-label col-md-3">Price</label>
							<div class="col-md-9">
							  <input class="form-control" name="price" id="price" type="text" placeholder="Enter coupon price" value="<?php  if(isset($coupon[0]->price)) { echo $coupon[0]->price; } ?>" >
							<div class="errors"><?php echo form_error('price'); ?></div>
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
	}, "Coupon name allow only characters & numbers not whitespace");


	jQuery.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Only alphabetical characters");

	var jvalidate = $("#valid-form").validate({
		ignore: [],
		rules: {                                                                 
			'name': {
				required: true,
				minlength: 2,
				space:true,
				maxlength: 200
			},
			'type': {
				required: true
			},
			'price': {
				required: true,
                numbers:true
			}
		},
		messages: {
			
		}					
	});  

</script>