<?php
if(isset($user))
{
foreach($user as $p)
{
?>
<li class="clickhidetotal">
<a href="<?php echo base_url(); ?>Usermanagement/index/<?php echo $p->id; ?>" class="clearfix" onclick="updateReadStatus(<?php echo $p->id; ?>)">
<figure class="image">
<?php
if($p->photo=="")
{
?>
<img class="img-circle" style="width: 35px;height: 35px;" src="<?php echo base_url(); ?>images/default.png" alt="" >
<?php
}
else{
?>
<img class="img-circle" style="width: 35px;height: 35px;" src="<?php echo base_url(); ?>upload/user/thumb/<?php echo $p->photo; ?>" alt="" >
<?php	
}
?>
</figure>
<span class="title"><?php echo $p->name_english; ?></span>
<span class="message"> has been registered. Please approve this profile. </span>
</a>
</li>
<?php } } ?>
