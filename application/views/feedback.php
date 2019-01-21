
<div class="col-md-8">
  <div class="credit">
      <h4><span>Read & Reply</span> To Feedback</h4>
        <div class="card">
          <?php if(!empty($feedback)){?>
            <?php foreach($feedback as $k=>$row){?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 col-sm-2">
                        <div  class="ratio img-responsive img-circle" style="background-image: url(<?php echo base_url('upload/user/'.$row['userinfo']->photo)?>);"></div>
                    </div>
                    <div class="col-md-10 col-sm-10">
                        <p>
                            <a class="float-left" href="#"><strong><?=$row['userinfo']->name?>  <span><!--Burger House--></span></strong>
                             <span class="text-left"><?=date('d M Y h:i:s',strtotime($row['created_at']))?></span>
                            </a>
                            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                              <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
      
                       </p>
                       <div class="clearfix"></div>
                        <p><?=$row['message']?></p>
                        <a class="float-left btn btn-outline-primary ml-2 showeditor<?=$k?>"> <i class="fa fa-reply"></i> Reply to this review</a>
                    </div>
                    
                </div>
                <div class="row">
                  <form method="post" action="<?php echo site_url('Dashboard/feedback');?>">
                      <div class="col-md-10 col-md-offset-2">
                        <div id="edit<?=$k?>" class="editnone" style="display: none;">
                        <script src="//cdn.ckeditor.com/4.5.5/basic/ckeditor.js"></script> 

                        <textarea name="text" id="text<?=$k?>" placeholder="Message"></textarea><script> CKEDITOR.replace( 'text<?=$k?>' );</script>
                        
                        <div class="row">
                          <div class="col-md-12">
                            <div class="rew_btns">
                            <button type="submit" class="revew_sub">Submit</button>
                            <button type="button" class="revew_cncl<?=$k?>">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                   </form>
                </div>
            </div>
            <script type="text/javascript">
              $(document).ready(function(){
                $('.showeditor<?=$k?>').click(function(){
                  $('#edit<?=$k?>').show('slow');
                });
              });
            </script>
            <script type="text/javascript">
              $(document).ready(function(){
                $('.revew_cncl<?=$k?>').click(function(){
                  $('#edit<?=$k?>').hide('slow');
                });
              });
            </script>
            <!--<script src="<?php echo base_url('frontend');?>/js/ckeditor.js"></script>-->
            <!--<script type="text/javascript">
            CKEDITOR.replace( 'editor<?=$k?>' );
            //CKEDITOR.add            
            </script>-->
          <?php } } else { ?>
          <h6>No Feedback yet.</h6>
          <?php } ?>
      
        </div>
    </div>
 </div>
  




<!--<script type="text/javascript">
CKEDITOR.replace( 'editor1' );
//CKEDITOR.add            
</script>-->

