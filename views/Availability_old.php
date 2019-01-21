<style type="text/css">
.allbtn.chiller_cb label{background: #36ba45;padding: 10px 12px;color: #fff;border-radius: 4px;margin-top: 15px;}
</style>
<div class="col-md-8">
<div class="credit">
<h4><span>Availability</span></h4>
</div>
<?php 
if($this->session->flashdata('resultmsg')) { 
?>
<div  class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
<h4 class="errormsgs"> <?php echo $this->session->flashdata('messsage'); ?></h4> 
</div>
<?php } ?>	
<div class="park_panel">
<div class="panel_heading size">
<h4>When is your parking space available?</h4>
</div>
<div class="Dta_table">
<div class="row">
<div class="col-md-4">
<p>On the following days</p>
</div>
<div class="col-md-8">
<div class="row">
<form id="availability_form" method="POST">
<?php
$week=array("Sunday","Monday","Tuesday","Wednesday","Thrusday","Friday","Saturday");

for($i=0;$i<count($week);$i++)
{
?>
<div class="col-md-4">
<div class="notify days">
<div class="chiller_cb weekdays">
<input id="myCheckbox<?php echo $i; ?>" type="checkbox" value="<?php echo $i; ?>" name="week[]" <?php if(isset($space)) { if(in_array($i,explode( ",", $space))) { echo "checked"; } } ?> onChange="show_availability();">
<label for="myCheckbox<?php echo $i; ?>"><?php echo $week[$i]; ?></label>
<span></span>
</div>
</div>
</div>
<?php } ?>

<input type="hidden" name="space_id" value="<?=$space_id?>">
<?php  $availabilitys = explode(';',$availability);
												$rslt = ''; $rslt1 = '';
												foreach($availabilitys as $key => $row){
													if($key > 0) {
														
														if((explode(',',$row)[3] == 2)) { 
														
														
														$starts = strtotime((explode(',',$row)[0]));
														$stop = strtotime((explode(',',$row)[1]));
														for ($seconds=$starts; $seconds<=$stop; $seconds+=86400)
														{
															$rslt .= date("d-m-Y", $seconds).';';																						
														}
														
													}else{
													
														$starts = strtotime((explode(',',$row)[0]));
														$stop = strtotime((explode(',',$row)[1]));
														for ($seconds=$starts; $seconds<=$stop; $seconds+=86400)
														{
															$rslt1 .= date("d-m-Y", $seconds).';';																						
														}
													} } }
									?>
									
<input type="hidden" id="highlited" name="highlited" value="<?php echo $rslt;?>">
<input type="hidden" id="unhighlited" name="unhighlited" value="<?php echo $rslt1;?>">
<input type="hidden" id="changed_space" name="changed_space" value="<?=$availability?>">

</form>
</div>


</div>
</div>
<div class="alert_bx">
<div class="row">
<div class="col-sm-4">
<div class="chiller_cb allbtn">
<input id="checkAll" type="checkbox">
<label for="checkAll" class="redclr <?php echo (count(explode( ",", $space)) == 7) ? 'redcolr' : '';?>"><?php echo (count(explode( ",", $space)) == 7) ? 'Uncheck All' : 'Check All';?></label>
<span></span>
</div>
</div>
<div class="col-sm-8">
<div class="alert alert-info" role="alert">
<div class="row vertical-align">
<div class="col-xs-2 text-center">
<img src="<?php echo base_url(); ?>frontend/images/info.png" class="img-responsive">
</div>
<div class="col-xs-10">
<p>You can also add/remove availability using the form below</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div><!--End of panel -->

<div class="park_panel">
<div class="panel_heading size">
<h4>Increase or decrease the number of parking spaces available over a select period</h4>
</div>
<div class="Dta_table">
<p>By using the form below you will be adding or removing spaces from your current <strong>1 parking space</strong> you have listed for rent on JustPark. For example: If you choose to make 4 additional spaces available, you will have <strong>5 parking spaces</strong> available during this period.</p>
<div class="time_tble">
<form id="change_space_form" method="post">
<div class="row">
<div class="col-md-4 text-right">
<label>From</label>
</div>
<div class="col-md-8">
		<div class="calender calender_srch avl">
	 <div class="form-group">
			<div class='input-group date' id='datetimepicker25'>
					<input type='text' id="from_date" name="from_date" class="form-control"  placeholder="Vehicle Drop-Off Date & Time" required/>
					<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
					</span>
			</div>
	</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4 text-right">
<label>Until</label>
</div>
<div class="col-md-8">
		<div class="calender calender_srch avl">
	 <div class="form-group">
			<div class='input-group date' id='datetimepicker26'>
					<input type='text' id="to_date" name="to_date" class="form-control"  placeholder="Vehicle Drop-Off Date & Time" required/>
					<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
					</span>
			</div>
	</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4 text-right">
	<label>Number of spaces</label>
</div>
<div class="col-md-8">
		<input type="number" id="quantity" name="quantity" min="1" required>
</div>
</div>
<div class="row xtra">
<div class="col-md-4 text-right">
	 <label for="email">Status</label>
 </div>
	 <div class="col-md-8">
	 <div class="form-group">
<div class="select">
	<select name="slct" id="slct" required>
		<option value="">Please Select</option>
		<option value="1">Remove parking spaces for rent during this period</option>
		<option value="2">Add extra parking space during this period</option>
	</select>
</div>
</div>
</div>
</div>
<span id="change_space_message" class="alert-success" style="display:none;">We have updated your parking space's availability. Please check the calendar below that your availability is now up to date.</span>
<div class="row">
<div class="col-md-12">
<div class="dash_sbt sec Dash_brd_sbt text-center">
<button type="button" class="verfy hlf" onclick="change_space();"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add</button>
</div>
</div>
</div>
</form>					
</div>
</div>
</div>

<div class="park_panel">
<div class="panel_heading size">
<h4>Increase or decrease the number of parking spaces available over a select period</h4>
</div>
<div class="Dta_table">
<div class="row">
<div class="col-md-12">
<div class="tab" role="tabpanel">
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">List View</a></li>
<li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab" onclick="show_availability();">Calendar View</a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane fade in active" id="Section1">
<p>You currently have a total of <strong><?=$noofspace?> parking space advertised</strong> at this location.</p>
					<div id="saved_space">
						<div class="table-responsive">
                            <table class="table table-bordered  table-striped">
							<thead>
								<tr>
									<td>Status</td>
									<td>From</td>
									<td>Until</td>
									<td>Change</td>
									<td>Available Spaces</td>
									<td>Action</td>
								</tr>
							</thead>
							<tbody>
								<div id="saved_space_view">
								<?php  $availability = explode(';',$availability);
												//print_r($availability); die;
												if(count($availability)>1){
												foreach($availability as $key => $row){
													if($key > 0) { ?>
													<tr class="box">
														<td><?=(explode(',',$row)[3] == 2) ? 'Additional Availability' : 'Removed Availability'?></td>
														<td><?=explode(',',$row)[0]?></td>
														<td><?=explode(',',$row)[1]?></td>
														<td><?=(explode(',',$row)[3] == 2) ? '+'.explode(',',$row)[2] : '-'.explode(',',$row)[2]?></td>
														<td><?=(explode(',',$row)[3] == 2) ? $noofspace+explode(',',$row)[2] : $noofspace-explode(',',$row)[2]?> spaces</td>
														<td><a class="button-remove" data-id="<?=explode(',',$row)[4]?>"  onClick="remove_space();"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
													</tr>			
												<?php } } }else{
													 echo '<tr><td colspan="6">No data available</td></tr>';
												}
								?>
								</div>
							</tbody>
						</table>
					</div>
					</div>
					
					<div id="change_space_view"></div>
					<input id="count" type="hidden" value="1">
					<div id="append_space" style="display:none;">
							
					</div>												
</div>

<div role="tabpanel" class="tab-pane fade" id="Section2" >
<div class="member">
<!--<div id="my-calendar"></div>-->
						
						<link rel="stylesheet" href="<?php echo base_url(); ?>frontend/calendar/css/calendar.css" media="screen">																										
								<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
								<script src="<?php echo base_url(); ?>frontend/calendar/js/jquery-ui-datepicker.min.js"></script>
						<div id="calendar_view">
								<div id="calendar"></div>
								
								<script>
									$('#calendar').datepicker({
										inline: true,
										firstDay: 1,
										showOtherMonths: true,
										dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
										beforeShowDay: function(date) {
														var day = date.getDay();
														if (day == 2 || day == 4) {
																return [true, "Highlighted", date];
														}
														return [true, '', ''];
												}
									});
								</script>
					</div>			
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="dash_sbt sec Dash_brd_sbt text-left">
		
		
<button type="button" class="verfy hlf" onclick="save_availability();">I'm Done</button>
		
</div>
</div>
</div>
</div>
</div>
</div>



<script>
function show_availability(){
url = '<?php echo site_url('dashboard/show_availability');?>';
$.ajax({
type: "POST",
url: url,
data: $("#availability_form").serialize(), // serializes the form's elements.
beforeSend: function() {
$("#preloader").show();
$(".pace").show();
},
success: function(data)
{
console.log(data); // show response from the php script.
$("#preloader").hide();
$(".pace").hide();													
$('#calendar_view').html(data);													
}											 
});

//e.preventDefault();
}

$(document).ready(function() {
show_availability();																		
});

function save_availability(){
url = '<?php echo site_url('dashboard/save_availability');?>';
$.ajax({
type: "POST",
url: url,
data: $("#availability_form").serialize(), // serializes the form's elements.
beforeSend: function() {
$("#preloader").show();
$(".pace").show();
},
success: function(data)
{
console.log(data); // show response from the php script.
$("#preloader").hide();
$(".pace").hide();
						<?php
						$this->session->set_flashdata('resultmsg', 1);
						$this->session->set_flashdata('class', 'success');
						$this->session->set_flashdata('messsage', "Updated successfully.");
						?>
						alert('Updated Successfully');											
location.reload();												
}											 
});            
//e.preventDefault();
}
																																
function change_space(){
if($('#from_date').val() == ''){
alert('select start date');
return false;
}
if($('#to_date').val() == ''){
alert('select end date');
return false;
}
if($('#quantity').val() == ''){
alert('select no. of space');
return false;
}
if($('#slct').val() == ''){
alert('select status');
return false;
}																			

var f_date = $('#from_date').val();
var e_date = $('#to_date').val();
var space = $('#quantity').val();
var status = $('#slct').val();


var x = $('#changed_space').val();
x.split(';').length;
var spacecontent = new Array();
spacecontent.push(f_date,e_date,space,status,x.split(';').length);					

$('#changed_space').val(x +';'+ spacecontent);


	if(status == 1)	{
		status = "Removed Availability";
		var noofspace = '<?=$noofspace?>';
		change = '-'+parseInt(space);
		space = parseInt(noofspace)- parseInt(space);
		
	}else{
status =	"Additional Availability";
		var noofspace = '<?=$noofspace?>';
		change = '+'+parseInt(space);
		space = parseInt(noofspace)+parseInt(space);									
	}

var ex = '';
<?php  	
			foreach($availability as $key => $row){
				if($key > 0) { ?>
				ex += '<tr class="box"><td><?=(explode(',',$row)[3] == 2) ? 'Additional Availability' : 'Removed Availability'?></td><td><?=explode(',',$row)[0]?></td><td><?=explode(',',$row)[1]?></td><td><?=(explode(',',$row)[3] == 2) ? '+'.explode(',',$row)[2] : '-'.explode(',',$row)[2]?></td><td><?=(explode(',',$row)[3] == 2) ? $noofspace+explode(',',$row)[2] : $noofspace-explode(',',$row)[2]?> spaces</td><td><a class="button-remove" data-id="<?=explode(',',$row)[4]?>"  onClick="remove_space();"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
			 <?php } }
?>
if($('#count').val() == 1)	{
$('#append_space').append(ex);
$('#count').val(2);
}

var append_space = '<tr class="box"><td>'+status+'</td><td>'+f_date+'</td><td>'+e_date+'</td><td>'+change+'</td><td>'+space+' spaces</td><td><a class="button-remove" data-id="'+x.split(';').length+'"  onClick="remove_space();"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';
$('#append_space').append(append_space);

console.log($('#append_space').html());			

var tbl =	'<div class="table-responsive"><table class="table table-bordered  table-striped"><thead><tr><td>Status</td><td>From</td><td>Until</td><td>Change</td><td>Available Spaces</td><td>Action</td></tr></thead><tbody>';
tbl += $('#append_space').html();
tbl += '</tbody></table></div>';




var start = new Date(f_date),
end = new Date(e_date),
year = start.getFullYear(),
month = start.getMonth()
day = start.getDate(),
dates = [start];

while(dates[dates.length-1] < end) {
var datee = new Date(year, month, ++day);							
dates.push(datee);							
}

var datestr = '';
if(dates.length == 1) { var length = dates.length; }else { var length = (dates.length-1); }
for(var i=0; i<(length); i++){
   datestr += dates[i].getDate()+'-'+(dates[i].getMonth()+1)+'-'+dates[i].getFullYear()+';';;
}

console.log('date  '+datestr);

if($('#slct').val() == 1){
var a = $('#unhighlited').val();
$('#unhighlited').val(a + datestr);
}else{
var b = $('#highlited').val();
$('#highlited').val(b + datestr);
}									

$('#saved_space').css('display','none');		
$('#change_space_view').html(tbl);
$('#change_space_message').show();
show_availability();							
//alert();


}


function remove_space(){						
$(document).on("click", ".button-remove", function() {
		var id = $(this).attr("data-id");
		
		var all_space = $('#changed_space').val();
		var all_space_arr = all_space.split(';');
		
		var newspacecontent = new Array();
		for (var i = 0; i < all_space_arr.length; i++) {
				if(all_space_arr[i]){
					//Do something
						var p = all_space_arr[i].split(',');
						if(p[4] != id){
								//alert(all_space_arr[i]);															
								newspacecontent.push(';'+all_space_arr[i]);															
						}else{
							//console.log(p);
								var start = new Date(p[0]),
								end = new Date(p[1]),
								year = start.getFullYear(),
								month = start.getMonth()
								day = start.getDate(),
								dates = [start];
								
								while(dates[dates.length-1] < end) {
									var datee = new Date(year, month, ++day);							
									dates.push(datee);							
								}
								var datestr = '';
								var newdatecontent = new Array();
								if(dates.length == 1) { var length = dates.length; }else { var length = (dates.length-1); }
								for(var j=0; j<(length); j++){
										 datestr = dates[j].getDate()+'-'+(dates[j].getMonth()+1)+'-'+dates[j].getFullYear();
										 newdatecontent.push(datestr);
								}
								
								//console.log('date  '+newdatecontent);
						}
				}											
		}
		$('#changed_space').val(newspacecontent);
		
		//console.log('date  '+newdatecontent);
		//update unhighlited
		var all_unhighlited = $('#unhighlited').val();
		var all_unhighlited_arr = all_unhighlited.split(';');
											
		var newunhighlitedcontent = '';
		
		for (var i = 0; i < all_unhighlited_arr.length; i++) {
				if(all_unhighlited_arr[i]){												
					//Do something																										
						if(jQuery.inArray(all_unhighlited_arr[i], newdatecontent) === -1)	{																																							
								newunhighlitedcontent += all_unhighlited_arr[i]+';'
						}
				}											
		}																		
		$('#unhighlited').val(newunhighlitedcontent);
		
		
		//update highlited
		var all_highlited = $('#highlited').val();
		var all_highlited_arr = all_highlited.split(';');
											
		var newhighlitedcontent = '';
		
		for (var i = 0; i < all_highlited_arr.length; i++) {
				if(all_highlited_arr[i]){												
					//Do something																										
						if(jQuery.inArray(all_highlited_arr[i], newdatecontent) === -1)	{																																							
								newhighlitedcontent += all_highlited_arr[i]+';'
						}
				}											
		}																		
		$('#highlited').val(newhighlitedcontent);
		
		
		$(this).closest(".box").remove();																		
});
}
</script>
<script type="text/javascript">
$(function () {
$('#datetimepicker25 input').datetimepicker();
$('#datetimepicker25').datetimepicker();
});
</script>
<script type="text/javascript">
$(function () {
$('#datetimepicker26').datetimepicker();
$('#datetimepicker26 input').datetimepicker();
});
</script>

<!-- <script type="text/javascript">
    $(function () {
        $('#datetimepicker26').datetimepicker({
            useCurrent: false
        });
        $("#datetimepicker25").on("dp.change", function (e) {
            $('#datetimepicker26').data("DateTimePicker").minDate(e.date);

        });
        $("#datetimepicker26").on("dp.change", function (e) {
            $('#datetimepicker25').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
<script type="text/javascript">
            
        $(function () {
      $('#datetimepicker25').datetimepicker({  
        minDate:new Date()
     });
 });</script> -->
<script type="text/javascript">
    $("#checkAll").change(function () {

      $("#checkAll").html('uncheck all');
      
    
    var check = $('.weekdays').find('input[type=checkbox]:checked').length;
    //alert(check);
    if(check >= 7){
     $('input:checkbox').removeAttr('checked');  	
    }/*else{       
        $("input:checkbox").prop('checked', true);
    }*/
    $("input:checkbox").prop('checked', $(this).prop("checked"));
    show_availability();
});
 </script>
<script type="text/javascript">
  $(".redclr").click(function(){
    $(".redclr").toggleClass("redcolr");
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".redclr").click(function(){
            $(this).text($(this).text() == 'Check All' ? 'Uncheck All' : 'Check All');
        });
    });
</script>