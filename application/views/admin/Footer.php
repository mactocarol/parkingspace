  <!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">

            <!-- Visible when footer positions are fixed -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
           
            <div class="hide-fixed pull-right pad-rgt">
            </div>


        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    <!--Demo script [ DEMONSTRATION ]-->
	
   <script src="<?php echo base_url(); ?>backend/js/demo/nifty-demo.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>dist/js/lightbox-plus-jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/plugins/flot-charts/jquery.flot.min.js"></script>
	<script src="<?php echo base_url(); ?>backend/plugins/flot-charts/jquery.flot.resize.min.js"></script>
	<script src="<?php echo base_url(); ?>backend/plugins/flot-charts/jquery.flot.tooltip.min.js"></script>

    <!--Sparkline [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>backend/plugins/sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

	 <script src="<?php echo base_url(); ?>backend/plugins/switchery/switchery.min.js"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>backend/plugins/bootstrap-select/bootstrap-select.min.js"></script>


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>dist/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>dist/js/moment.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>dist/js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>dist/js/daterangepicker.js"></script>

    <!--Chosen [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>backend/plugins/chosen/chosen.jquery.min.js"></script>
	
	 <!--Select2 [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>backend/plugins/select2/js/select2.min.js"></script>
    <script src="<?php echo base_url(); ?>backend/js/demo/form-component.js"></script>

    <!--Specify page [ SAMPLE ]-->
    <script src="<?php echo base_url(); ?>backend/js/demo/dashboard.js"></script>
	<script>
$(document).ready( function () {
    // Setup - add a text input to each footer cell
    $('#demo-dt-basic tfoot th').each( function () {
        var title = $(this).text();
		if(title!='')
        $(this).html( '<input style="width:80px" class="form-control"  type="text" placeholder="Search" />' );
    } );
 
    // DataTable
    var table = $('#demo-dt-basic').DataTable();
 
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