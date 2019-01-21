<div class="col-md-8">
  <div class="credit">
      <h4><span>Chat Room</span></h4>
  </div>
  <div class="dash_sbt">
    <!--<button type="button" class="verfy"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo site_url('Messages/index'); ?>">Bookings Made</a></button>
    <button type="button" class="cnsl"><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo site_url('Dashboard/BookingReceived'); ?>">Bookings Received</a></button>-->
  </div>
<div class="park_panel">
  <!--<div class="panel_heading">
    <h4>Messages</h4>
  </div>-->
  <div class="chatting_bx">
<div class="row">  	
    	<div class="col-md-12">
            <div id="send_comments_message"></div>
        	<div class="chat-window-panel">
            	<div class="chat-window-title">
                    <div class="char-rm_txt"> <strong>Chat Room</strong> - <?php echo 'Room'.$chat_id; ?></div>
                    <div class="cht_window">
                	<img src="<?php echo base_url('upload/user/'.$other->photo);?>" class="img-thumbnail"> 
                </div>
                   </div>
                   <hr>
                <div class="chat-window-box">
                    <?php if(!empty($comments)){?>
                	<ul>
                        <?php foreach($comments as $comment) { 
                            if($comment['message_from'] == $result->id){ ?>
                                <li>
                                    <div class="chat-user-left">
                                        <div class="chat-user-box">
                                            <img src="<?php echo base_url('upload/user/'.$result->photo);?>" class="img-circle">
                                            <span><?php echo $result->username; ?></span>
                                        </div>
                                        <div class="chat-user-message">                                	
                                           <div class="chat-line"> <span><?=$comment['message']?></span></div>
                                           <?php if(($comment['file'])) {?>
                                                <div class="chat-line"> Sent you a file <a href="<?php echo site_url('offer/download/'.$comment['file']);?>" target="_blank"><u><?=($comment['file'])?></u></a></div>
                                            <?php } ?>
                                            <div class="meta-info"><span class="date"><?=date('d M Y',strtotime($comment['created_at']))?></span> <span class="time"><?=date('h:i:s a',strtotime($comment['created_at']))?></span> </div>
                                        </div>
                                    </div>                                                                    
                                </li>
                            <?php } else { ?>
                                <li>                                    
                                    <div class="chat-user-right">
                                        <div class="chat-user-box">
                                            <img src="<?php echo base_url('upload/user/'.$other->photo);?>" class="img-circle">
                                            <span><?php echo $result->username; ?></span>
                                        </div>
                                        <div class="chat-user-message">
                                            <div class="chat-line"><span><?=$comment['message']?></span></div>
                                            <?php if(($comment['file'])) {?>
                                                <div class="chat-line"> Sent you a file <a href="<?php echo site_url('offer/download/'.$comment['file']);?>" target="_blank"><u><?=($comment['file'])?></u></a></div>
                                            <?php } ?>
                                            <div class="meta-info"><span class="date"><?=date('d M Y',strtotime($comment['created_at']))?></span> <span class="time"><?=date('h:i:s a',strtotime($comment['created_at']))?></span> </div>
                                        </div>
                                    </div>                                                                    
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                    <?php } else { ?>
                    No Conversation Yet.
                    <?php }?>
                </div>
                
                <div class="clearfix"></div>
                <div class="chat-sender-box">                    
                    <form method="post" id="comment_form" action="#" enctype="multipart/form-data">
                        <textarea class="form-control" name="message" id="message" placeholder="write a message" required="required"></textarea>
                        
                        
                            <input type="hidden" name="message_to" value="<?=$other->id?>">
                        
                        
                        
                            <input type="hidden" name="message_from" value="<?=$result->id?>">
                        
                        <input type="hidden" name="chat_id" value="<?=$chat_id?>">
                        
                        <button type="submit" class="btn btn-primary" id="send_comments">send</button>
                        <!--<a>
                            <i class="fa fa-paperclip" onclick="document.getElementById('attachment').click();"></i>                        
                        </a>-->
                        <div id="attachment_div"></div>
                        
                        <input type="file" id="attachment" name="attachment" onchange="document.getElementById('attachment_div').innerHTML = this.files.item(0).name; " style="display:none" >
                        <h4 id='loading' style="display:none">Sending...<img src="<?php echo base_url('upload/comments/straight-loader.gif');?>" height="150px"></h4>
                    </form>
                </div>
            </div>
        </div>
 </div>
</div>
</div>
</div>



<!---->


<script>
           
    $(document).ready(function (e) {
        $("#comment_form").on('submit',(function(e) {            
        e.preventDefault();
        $('#loading').show();
        var url = '<?php echo site_url('Messages/send_comments'); ?>';
        $.ajax({
        url: url, // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
            console.log(data.substring(0, 5));
            if((data.substring(0, 5)) === 'Error'){
                
                    //$('#send_comments_message').html(data);
                    alert(data);
                    $('#message').val('');
                    $('#attachment').val('');
                    $('#attachment_div').html('');
                    //$('.chat-window-box').html(data); 
                
            } else{
                $('#message').val('');
                $('#attachment').val('');
                $('#attachment_div').html('');
                $('.chat-window-box').html(data); 
            }
            $('#loading').hide();
        }
        });
        }));
    });
    
    
                
    setInterval(function(){
        var url = '<?php echo site_url('Messages/show_comments'); ?>'; // the script where you handle the form input.
                
                $.ajax({
                       type: "POST",
                       url: url,
                       data: { chat_id : <?=$chat_id?>,msg_to : <?=$other->id?>}, // serializes the form's elements.                       
                       success: function(data)
                       {
                          console.log(data);                                                    
                          $('.chat-window-box').html(data);                          
                       }
                     });
    }, 1000);
</script>