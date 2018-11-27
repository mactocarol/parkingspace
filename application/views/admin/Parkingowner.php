
 <div id="content-container">
  
                <div id="page-head">
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow"><?php echo $controlnamehead; ?></h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="#"><?php echo $control; ?></a></li>
					<li class="active"><?php echo $controlnamehead; ?></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">	
				
	
		<!-- Row selection and deletion (multiple rows) -->
					<!--===================================================---->
					<div class="panel">
					 <?php 
	    if($this->session->flashdata('result')) { 
		?>
		<div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h4 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?></h4> 
		</div>
		<?php } ?>
		
					<div class="row">
		
<div class="col-md-12 searchform">
		<form action="<?php echo base_url().$control.'/'.$controlname; ?>" method="post">								
		<div class="col-md-4 form-group">
		<label>Registration Date</label>
		<input class="form-control sessiondate" type="text" id="sessiondate" name="sessiondate" value="<?php if(isset($_REQUEST['sessiondate'])) { echo $_REQUEST['sessiondate']; }  ?>" placeholder="Registration Date" />      		  
		</div>
		
		<div class="col-md-4 form-group">
		<label>User Name</label>
		<input class="form-control" type="text" id="username" name="username" value="<?php if(isset($_REQUEST['username'])) { echo $_REQUEST['username']; }  ?>" placeholder="User Name" />      		  
		</div>
		
		<div class="col-md-4 form-group">
		 <label>Email Status</label>
	     <select id="emailv" name="emailv" class="form-control">
         <option value="">Please Select status</option>
<option value="1" <?php if(isset($_REQUEST['emailv'])) { if($_REQUEST['emailv']==1) { echo "selected"; } } ?>>Verified</option>
<option value="2" <?php if(isset($_REQUEST['emailv'])) { if($_REQUEST['emailv']==2) { echo "selected"; } } ?>>Pending</option>		 
         </select>		
		</div>
		
		<div class="col-md-4 form-group">
		 <label>Status</label>
	     <select id="statusv" name="statusv" class="form-control">
         <option value="">Please Select status</option>
<option value="1" <?php if(isset($_REQUEST['statusv'])) { if($_REQUEST['statusv']==1) { echo "selected"; } } ?>>Active</option>
<option value="2" <?php if(isset($_REQUEST['statusv'])) { if($_REQUEST['statusv']==2) { echo "selected"; } } ?>>Suspend</option>
<option value="3" <?php if(isset($_REQUEST['statusv'])) { if($_REQUEST['statusv']==3) { echo "selected"; } } ?>>Pending</option>		 
         </select>		
		</div>

		<div class="col-md-4 form-group">
		<label>Country</label>
		<select id="country" name="country" class="form-control">
        <option value="">Please Select country</option>
<?php
if(isset($country))
{
	foreach($country as $c)
	{
		?>
		<option value="<?php echo $c->countryID; ?>" <?php if(isset($_REQUEST['country'])) { if($_REQUEST['country']==$c->countryID) { echo "selected"; } } ?>><?php echo $c->countryName; ?></option>
		<?php
	}
}
?>		 
        </select>		
		</div>

		<div class="col-md-12 form-group text-right">
		<button type="submit" class="btn btn-primary">Search</button>
		<button onclick="searchreset();" type="button" class="btn btn-default">Reset</button>
		</div>
		</form>
</div>

<script>
function searchreset()
{
	$("#sessiondate").val("");
	$("#username").val("");
	$("#country").val("");
$("#emailv").val("");
$("#statusv").val("");
}
</script>

										</div>
	
		
					    <div class="panel-heading">
						  
					        <a href="<?php echo base_url().$control.'/add'.$controlname; ?>" class="btn btn-info"><i class="fa fa-plus"></i> Add</a>
					    	
							
						</div>
					   
					    <div class="panel-body">
						<div class="table-responsive">
					        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					            <thead>
					                     <tr>
											<th>S.No.</th>
											<th>Photo</th>
											<th>User name</th>
											<th>Email</th>
											<th>Status</th>
											<th>Action</th>
                                         </tr>
					            </thead>
								<tfoot>
					                     <tr>
											<th></th>
											<th></th>
											<th>User name</th>
											<th>Email</th>
											<th>Status</th>
											<th></th>
                                         </tr>
					            </tfoot>
					            	<tbody>
									<?php 
										$i=1;
									
										if(isset($user))
										{
											foreach($user as $list)
											{
											$photo =$list->photo;
											$ophoto =$list->ophoto;
											
										?>
										<tr class="gradeX">
											<td><?php echo $i; ?></td>
											<td >
											<?php if ($photo ==''){ ?>
											<a href="<?php echo base_url(); ?>images/default.png" data-lightbox="example-set">
											<img src="<?php echo base_url(); ?>images/default.png" class="img-thumbnail"   >
											</a>
											<?php } else { ?>
											<a href="<?php echo base_url(); ?>upload/user/<?php echo $ophoto; ?>" data-lightbox="example-set">
												<img src="<?php echo base_url(); ?>upload/user/<?php echo $photo; ?>" class="img-thumbnail" >
											</a>
											<?php } ?>
											</td>
											
											<td><a class="btn-link text-semibold" href="<?php echo base_url().$control.'/view'.$controlname.'/'.$list->id; ?>"><?php echo $list->name; ?></a></td>
										
											<td><?php echo $list->email; ?></td>
											<td><?php 
											if($list->status==1)
											{
												echo '<div class="label label-table label-success">Active</div>';
											}
											else if($list->status==3)
											{
												echo '<div class="label label-table label-warning">Suspend</div>';
											}
                                            else{
	                                            echo '<div class="label label-table label-danger">Pending</div>';
                                            }											
											?>
											</td>
											<td>
										
											  <div class="dropdown">
					                            <button class="dropdown-toggle btn btn-primary btn-active-primary" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical"></i></button>
					                            <ul class="dropdown-menu dropdown-menu-right">
					                                <li><a href="<?php echo base_url().$control.'/view'.$controlname.'/'.$list->id; ?>">View Details</a></li>
					                                <li><a href="<?php echo base_url().$control.'/edit'.$controlname.'/'.$list->id; ?>">Edit</a></li>
					                                <li><a href="#" data-toggle="modal" data-target=".myModal"   onClick="setID(<?php echo $list->id; ?>);">Delete</a></li>
					                                <li><a href="#" data-toggle="modal" data-target=".passwordmodal" onClick="setID(<?php echo $list->id; ?>);">Change Password</a></li>
													<?php
											if($list->status==0 || $list->status==2)
	                                        { ?>
											<li><a href="#" data-toggle="modal" data-target=".myModalactive" onClick="setID(<?php echo $list->id; ?>);">Active Profile</a></li>
											<?php }
											if($list->status==1)
											{ ?>
											<li><a href="#" data-toggle="modal" data-target=".myModalsuspend" onClick="setID(<?php echo $list->id; ?>);">Suspend Profile</a></li>
											<?php }
											?>
	
					                            </ul>
					                        </div>
											</td>
											
											</tr>					
										<?php  $i++; }} ?>
									</tbody>
					        </table>
					    </div>
					  </div>
					</div>
				
					<!-- End Row selection and deletion (multiple rows) -->
										
					</div>
					
                </div>
                <!--===================================================-->
				
<div id="myModal" class="modal fade myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Remove <strong>Data</strong> ?</h4>
            </div>
            <div class="modal-body">
                       <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
						
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button onclick="deleterow()"  class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>


<div id="myModalactive" class="modal fade myModalactive">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Active <strong>Profile</strong> ?</h4>
            </div>
            <div class="modal-body">
                       <p>Are you sure you want to active this profile?</p>                    
                        <p>Press Yes if you sure.</p>
						
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button onclick="activeprofile()"  class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>

<div id="myModalsuspend" class="modal fade myModalsuspend">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Suspend <strong>Profile</strong> ?</h4>
            </div>
            <div class="modal-body">
                       <p>Are you sure you want to suspend this profile?</p>                    
                        <p>Press Yes if you sure.</p>
						
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button onclick="activeprofile()"  class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>


<div id="passwordmodal" class="modal fade passwordmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Change <strong>Password</strong></h4>
            </div>
            <div class="modal-body">
				<form id="passwordeditform" action="<?php echo base_url().$control; ?>/changepassword" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
			
											<div class="panel-body">
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Password</label>
														<div class="col-sm-9">
															<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password"/>
														</div>
													</div>
												<input type="hidden" id="id" name="id">
											</div>
		   </div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button type="submit" class="btn btn-primary">Submit</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
													</div>
												</div>
											</footer>
											</form>
			
									
        </div>
    </div>
</div>

<script>

jQuery.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[a-z]/.test(value) // has a lowercase letter
	   && /[A-Z]/.test(value) // has a uppercase letter
       && /\d/.test(value) // has a digit
	   && /([!,%,&,@,#,$,^,*,?,_,~])/.test(value)
}); 

 function setID(id)
	  {
		  document.getElementById('id').value=id;
	  }
	  
 function deleterow()
	  {
		  var id=document.getElementById('id').value;
		  jQuery.ajax({
				url: '<?php echo base_url().$control.'/delete'.$controlname; ?>',
				type: 'post',
				data: {id:id},
			    success: function (result)
				{					
				   if(result==1)
				   {
					   window.location="<?php echo base_url().$control.'/delete'.$controlname; ?>/success";
				   }
				   else{
					   window.location="<?php echo base_url().$control.'/delete'.$controlname; ?>/error"; 
				   }
				}
			});
	
	  }	 

function activeprofile()
	  {
		  var id=document.getElementById('id').value;
		  jQuery.ajax({
				url: '<?php echo base_url().$control; ?>/activeprofile',
				type: 'post',
				data: {id:id},
			    success: function (result)
				{					
				   if(result==1)
				   {
					   window.location="<?php echo base_url().$control; ?>/activeprofile/active/"+id;
				   }
				   else if(result==2)
				   {
					   window.location="<?php echo base_url().$control; ?>/activeprofile/suspend/"+id;
				   }
				   else{
					   window.location="<?php echo base_url().$control; ?>/activeprofile/error/"+id; 
				   }
				}
			});	
	  }	  
	  
	  var jvalidate = $("#passwordeditform").validate({
		ignore: [],
		rules: {                                                                 
			'password': {
				required: true,
				minlength: 6,
				maxlength: 16,
				pwcheck:true
				
			}
		},
		messages: {
                        'password':
						{
							pwcheck:"Password contain atleast one symbol, uppercase letter, lowercase letter and digit between 6 to 16 character."
						}	
		}					
	});  	  
</script>

