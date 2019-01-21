
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
		<span id="wmsg"></span>
					    <div class="panel-heading">
						  
					        <a href="<?php echo base_url().$control.'/add'.$controlname; ?>" class="btn btn-info"><i class="fa fa-plus"></i> Add</a>

						</div>
					   
					    <div class="panel-body">
						<div class="table-responsive">
					        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					            <thead>
					                     <tr>
										 <th>S.NO</th>
											  <th>Coupon code name</th>
                      <th>Price</th>
                      <th>Type</th>
                      <!--<th>Validity</th>-->
		              <th>Status</th>
                      <th>Created Date</th>
											<th>Action</th>											
										</tr>
					            </thead>
								<tfoot>
					                     <tr>
											<th></th>
											 <th>Coupon code name</th>
                      <th>Price</th>
                      <th>Type</th>
                      <!--<th>Validity</th>-->
		              <th>Status</th>											
											<th></th>
											<th></th>											
										</tr>
					            </tfoot>
					            	<tbody>
					
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
                <button onclick="deleterow()" data-dismiss="modal"  class="btn btn-primary">Yes</button>
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
	  
var table;

$(document).ready( function () {
    // Setup - add a text input to each footer cell
    $('#demo-dt-basic tfoot th').each( function () {
        var title = $(this).text();
		if(title!='')
        $(this).html( '<input style="width:80px" class="form-control"  type="text" placeholder="Search" />' );
    } );
 
    // DataTable
     table = $('#demo-dt-basic').DataTable({
		 "bDestroy": true,
        "ajax": {
            "url": "<?php echo base_url(); ?>Managecoupon/getajaxcoupondata",
			"type": 'POST',
		"data": {
        "controlname": '<?php echo $controlname; ?>',
		"control": '<?php echo $control; ?>'
        },
            "dataSrc": ""
        },
		

		
        "columns": [
            { "data": "sno" },
            { "data": "name" },
			{ "data": "price" },
			{ "data": "type" },
			{ "data": "sts" },
			{ "data": "created_dt" },
			{ "data": "action" }

        ]
    });
 
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

 function deleterow()
	  {
		  var id=document.getElementById('id').value;
		  jQuery.ajax({
				url: '<?php echo base_url().$control.'/delete'.$controlname; ?>',
				type: 'post',
				data: {id:id},
				
			    success: function (result)
				{
					table.ajax.reload( null, false );

                   if(result==1)
				   {
			$("#wmsg").html('<div class="alert alert-success" role="alert">'+
			'<button type="button" class="close" data-dismiss="alert">'+
			'<span aria-hidden="true">×</span><span class="sr-only">Close</span></button>'+
			'<h4 class="errormsgs">Coupon deleted successfully</h4></div>');
				   }
				   else{
			$("#wmsg").html('<div class="alert alert-danger" role="alert">'+
			'<button type="button" class="close" data-dismiss="alert">'+
			'<span aria-hidden="true">×</span><span class="sr-only">Close</span></button>'+
			'<h4 class="errormsgs">Error to delete</h4></div>');
				   }
				}
			});	
	  }	  
	  
	  
	  function activecoupon(id)
	  {

		  jQuery.ajax({
				url: '<?php echo base_url().$control.'/active'.$controlname; ?>',
				type: 'post',
				data: {id:id},				
			    success: function (result)
				{
					table.ajax.reload( null, false );
   
			$("#wmsg").html('<div class="alert alert-success" role="alert">'+
			'<button type="button" class="close" data-dismiss="alert">'+
			'<span aria-hidden="true">×</span><span class="sr-only">Close</span></button>'+
			'<h4 class="errormsgs">Coupon active successfully</h4></div>');
				   
				}
			});	
	  }	  
	  
	  function expirecoupon(id)
	  {
		  jQuery.ajax({
				url: '<?php echo base_url().$control.'/expire'.$controlname; ?>',
				type: 'post',
				data: {id:id},
				
			    success: function (result)
				{
					table.ajax.reload( null, false );

                  
			$("#wmsg").html('<div class="alert alert-warning" role="alert">'+
			'<button type="button" class="close" data-dismiss="alert">'+
			'<span aria-hidden="true">×</span><span class="sr-only">Close</span></button>'+
			'<h4 class="errormsgs">Coupon expired successfully</h4></div>');
				   
				}
			});	
	  }	  
</script>