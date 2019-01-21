<div id="calendar1"></div>
<link rel="stylesheet" href="<?php echo base_url(); ?>frontend/calendar/css/calendar.css" media="screen">																										
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>frontend/calendar/js/jquery-ui-datepicker.min.js"></script>



<script type="text/javascript" language="javascript">
    var pausecontent = new Array();
    <?php if(isset($week) && !empty($week)) { foreach($week as $key => $val){ ?>
        pausecontent.push(<?php echo $val; ?>);
    <?php } } ?>
    console.log(pausecontent);
    
    var highlitedcontent = new Array();    
    <?php if(isset($highlited) && !empty($highlited)) { foreach($highlited as $key => $val){ ?>
        highlitedcontent.push('<?php echo $val; ?>');
    <?php } } ?>
    console.log(highlitedcontent);
    
    var unhighlitedcontent = new Array();
    <?php if(isset($unhighlited) && !empty($unhighlited)) { foreach($unhighlited as $key => $val){ ?>
        unhighlitedcontent.push('<?php echo $val; ?>');
    <?php } } ?>
    console.log('unhighlited '+unhighlitedcontent);
</script>

<script>
    var highlight_dates = highlitedcontent;//['22-11-2018','11-1-2018','18-1-2018','28-1-2018'];
    var unhighlight_dates = unhighlitedcontent; //['21-11-2018','23-11-2018'];
    $('#calendar1').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        beforeShowDay: function(date) {
                
                        var month = ('0' + date.getMonth()+1).slice(-2);
                        var year = date.getFullYear();
                        var days = ('0' + date.getDate()).slice(-2);
                      
                        // Change format of date
                        var newdate = days+"-"+month+'-'+year;
                        console.log('newdate '+newdate);
                        var day = date.getDay();
                        //if (day == 2 || day == 3 || day == 4) {
                        if($.inArray(day, pausecontent) != -1) {
                            if($.inArray(newdate, unhighlight_dates) === -1){
                                return [true, "Highlighted", date];
                            }
                        }
                        if($.inArray(newdate, highlight_dates) != -1){
                                return [true, "Highlighted", date];
                        }
                        if($.inArray(newdate, unhighlight_dates) != -1){
                                return [true, "UnHighlighted", date];
                        }
                        
                        return [true, "UnHighlighted", date];
                }
    });
</script>