
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
					    <div class="panel-heading">
						  
					        <a href="<?php echo base_url().$control.'/add'.$controlname; ?>" class="btn btn-info"><i class="fa fa-plus"></i> Add</a>

						</div>
					   
					    <div class="panel-body">
						<div class="table-responsive">
					        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					            <thead>
					                     <tr>
											<th>S.No.</th>
											<th>photo</th>
                                            <th>Title</th>
											<th>User name</th>
											<th>Category</th>
											<th>Status</th>
											<th>Date</th>
											<th>Action</th>											
										</tr>
					            </thead>
								<tfoot>
					                     <tr>
											<th></th>
											<th></th>
                                            <th>Title</th>
											<th>User name</th>
											<th>Category</th>
											<th>Status</th>
											<th></th>
											<th></th>							
										</tr>
					            </tfoot>
					            	<tbody>
									<?php 
										$i=1;
									
										if(isset($blog))
										{
											foreach($blog as $list)
											{
										$photo=$list->photo;
										?>
										<tr class="gradeX">
											<td><?php echo $i; ?></td>
											
				                             <td >
											<?php if ($photo ==''){ ?>
											<a href="<?php echo base_url(); ?>images/default.png" data-lightbox="example-set">
											<img src="<?php echo base_url(); ?>images/default.png" class="img-thumbnail"   >
											</a>
											<?php } else { ?>
											<a href="<?php echo base_url(); ?>upload/blog/<?php echo $list->ophoto; ?>" data-lightbox="example-set">
												<img src="<?php echo base_url(); ?>upload/blog/<?php echo $photo; ?>" class="img-thumbnail" >
											</a>
											<?php } ?>
											</td>
											<td><?php echo $list->title; ?></td>
											<td><?php echo $list->name; ?></td>
											<td><?php echo $list->cname; ?></td>
											<td>
											<?php 
											if($list->status==1)
											{
											  echo "<a class='label label-table label-success' title='Click to Disapproved' href='".base_url().$control."/show".$controlname."/".$list->id."/2'>Approved</a>";	
											}
											else if($list->status==2)
											{
											  echo "<a class='label label-table label-danger' title='Click to Approved' href='".base_url().$control."/show".$controlname."/".$list->id."/1'>Disapproved</a>";	
											}
                                            else{
	                                          echo "<a class='label label-table label-warning' title='Click to approved' href='".base_url().$control."/show".$controlname."/".$list->id."/1'>Pending</a>";
                                            }											
											?>
											</td>
											<td><?php echo $list->created_dt; ?></td>
											<td>
											<a href="<?php echo base_url().$control.'/edit'.$controlname.'/'.$list->id; ?>" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
											
											<a href="<?php echo base_url().$control.'/view'.$controlname.'/'.$list->id; ?>" title="View" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
	
                                            <a href="#"  class="btn btn-xs btn-primary" data-toggle="modal" data-target=".myModal"   onClick="setID(<?php echo $list->id; ?>);"  title="Delete" class="btn btn-xs btn-danger"><i  class="fa fa-trash-o"></i></a>
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

<input type="hidden" id="id">
<script>
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
</script>