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