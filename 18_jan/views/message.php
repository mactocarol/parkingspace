
          
<div class="col-md-8 col-sm-6">
  <div class="credit">
      <h4><span><strong>Chat Room</strong> - <?php echo 'Room'.$chat_id; ?></span></h4>
</div>
<div id="frame">
  
  <div class="content">
    <div class="contact-profile">
      <img src="Images/testi_3.jpg" alt="" />
      <p><?php echo $other->name; ?></p>
    </div>
    <div class="messages chat-window-box">
      <?php if(!empty($comments)){?>
            <ul>
                <?php foreach($comments as $comment) { ?>
                
                <?php if($comment['message_from'] == $result->id){ ?>
                    <li class="sent">
                      <img src="<?php echo base_url('upload/user/'.$result->photo);?>" alt="" />
                      <p><?=$comment['message']?></p>                      
                      <div class="chat_time"><?=date('d M Y h:i:s',strtotime($comment['created_at']))?></div>
                    </li>
                <?php } else {?>
                <li class="replies">
                  <img src="<?php echo base_url('upload/user/'.$other->photo);?>" alt="" />
                  <p><?=$comment['message']?></p>
                  <div class="chat_time"><?=date('d M Y h:i:s',strtotime($comment['created_at']))?></div>
                </li>
                <?php } ?>
            <?php } ?>
            </ul>
            <?php } else { ?>
            No Conversation Yet.
            <?php }?>
    </div>
    
  </div>
  <div class="clearfix"></div>
  <div class="message-input">
      <div class="wrap">
      <!--<input type="text" placeholder="Write your message..." />
      <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
      <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>-->
      <form method="post" id="comment_form" action="#" enctype="multipart/form-data">
            <!--<textarea class="form-control" name="message" id="message" placeholder="write a message" required="required"></textarea>-->
            <div class="form-group">
            <input type="text" placeholder="Write your message..." name="message" id="message" autocomplete="off" required/>

            <!--<i class="fa fa-paperclip attachment" aria-hidden="true"></i>      -->
                <input type="hidden" name="message_to" value="<?=$other->id?>">
            
            
            
                <input type="hidden" name="message_from" value="<?=$result->id?>">
            
            <input type="hidden" name="chat_id" value="<?=$chat_id?>">
            </div>
            <div class="text-right">
            <button type="submit" class="btn btn-primary submit" id="send_comments"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
          </div>
            <!--<a>
                <i class="fa fa-paperclip" onclick="document.getElementById('attachment').click();"></i>                        
            </a>-->
            <div id="attachment_div"></div>
            
            <input type="file" id="attachment" name="attachment" onchange="document.getElementById('attachment_div').innerHTML = this.files.item(0).name; " style="display:none" >
            <!--<h4 id='loading' style="display:none">Sending...<img src="<?php echo base_url('upload/comments/straight-loader.gif');?>" height="150px"></h4>-->
        </form>
      </div>
    </div>
</div>
      </div>
  
<!--<script type="text/javascript">
    $(function() {
    var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;
    
    var dropdownlink = this.el.find('.dropdownlink');
    dropdownlink.on('click',
    { el: this.el, multiple: this.multiple },
    this.dropdown);
  };
  
  Accordion.prototype.dropdown = function(e) {
    var $el = e.data.el,
        $this = $(this),
        $next = $this.next();
    
    $next.slideToggle();
    $this.parent().toggleClass('open');
    
    if(!e.data.multiple) {
      $el.find('.submenuItems').not($next).slideUp().parent().removeClass('open');
    }
  }
  
  var accordion = new Accordion($('.accordion-menu'), false);
})
    </script>-->


<script>
$(".messages").animate({ scrollTop: 300000 }, "fast");
console.log($(document).height());
//
//$("#profile-img").click(function() {
//  $("#status-options").toggleClass("active");
//});
//
//$(".expand-button").click(function() {
//  $("#profile").toggleClass("expanded");
//  $("#contacts").toggleClass("expanded");
//});
//
//$("#status-options ul li").click(function() {
//  $("#profile-img").removeClass();
//  $("#status-online").removeClass("active");
//  $("#status-away").removeClass("active");
//  $("#status-busy").removeClass("active");
//  $("#status-offline").removeClass("active");
//  $(this).addClass("active");
//  
//  if($("#status-online").hasClass("active")) {
//    $("#profile-img").addClass("online");
//  } else if ($("#status-away").hasClass("active")) {
//    $("#profile-img").addClass("away");
//  } else if ($("#status-busy").hasClass("active")) {
//    $("#profile-img").addClass("busy");
//  } else if ($("#status-offline").hasClass("active")) {
//    $("#profile-img").addClass("offline");
//  } else {
//    $("#profile-img").removeClass();
//  };
//  
//  $("#status-options").removeClass("active");
//});

//function newMessage() {
//  message = $(".message-input input").val();
//  if($.trim(message) == '') {
//    return false;
//  }
//  $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
//  $('.message-input input').val(null);
//  $('.contact.active .preview').html('<span>You: </span>' + message);
//  $(".messages").animate({ scrollTop: $(document).height() }, "fast");
//};

//$('.submit').click(function() {
//  newMessage();
//});
//
//$(window).on('keydown', function(e) {
//  if (e.which == 13) {
//    newMessage();
//    return false;
//  }
//});
</script>

<script>
       $('.button').keypress(function (e) {
            alert();
            if (e.which == 13) {
              $('form#comment_form').submit();
              return false;    //<---- Add this line
            }
          });  
           
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
                console.log($(document).height());
                $(".messages").animate({ scrollTop: 300000 }, "fast");
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
                          //$(".messages").animate({ scrollTop: 300000 }, "fast");
                       }
                     });
    }, 1000);
    
    setInterval(function(){
        $(".messages").animate({ scrollTop: 300000 }, "fast");
    }, 100000);
</script>
