<?php
$this->db->where("st",22);
$data=$this->db->get("front_setting")->result();
$logo="";
$best="";
$supportmsg="";
$support="";
$title="";
if(isset($data[0]->title_english))
{
	$title=$data[0]->title_english;
}
if(isset($data[0]->ophoto))
{
	$logo=$data[0]->ophoto;
}
if(isset($data[0]->best))
{
	$best=$data[0]->best;
}
if(isset($data[0]->support))
{
	$support=$data[0]->support;
}
if(isset($data[0]->supportmsg))
{
	$supportmsg=$data[0]->supportmsg;
}

?>

<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f2f2f2">
  <tbody>
  <tr>
    <td bgcolor="">
<table width="650" border="0" bgcolor="#ffffff" cellspacing="0" cellpadding="0" align="center">
  
  <tbody><tr>
    <td height="1" bgcolor="#d6d6d6" style="font-size:1px;line-height:1px"></td>
  </tr>
  <tr>
    <td><table width="650" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td width="1" bgcolor="#d6d6d6"></td>
          <td><table width="648" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td height="28"><img src="" height="26" width="1" class="CToWUd"></td>
              </tr>
              <tr>
               
                <td><table width="648" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td width="20"></td>
                      <td><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/<?php echo $logo; ?>" alt="" border="0" class="CToWUd" style="width:100%;"></a></td>

					  <td width="126"></td>
                      <td width="20"></td>
                    </tr>
                  </tbody></table></td>
              </tr>
              
              <tr>
              	<td>
                	<table border="0" cellspacing="0" cellpadding="0" width="648">
                    	<tbody>
						<tr>
                            <td height="24" colspan="2"><img src="" height="24" width="1" class="CToWUd"></td>
                          </tr>
                          <tr>
                          	<td width="20"></td>
                            <td style="color:#666666;font-size:14px;line-height:34px;font-family:Arial,Helvetica,sans-serif">
							
							Hello <?php if(isset($messages[0])) { echo $messages[0]; } ?>,<br>
							<?php if(isset($messages[1])) { echo $messages[1]; } ?>
							</td>
                          </tr>

                           <tr>
                          	 <td height="30" colspan="2"><img src="#" height="30" width="1" class="CToWUd"></td>
                          </tr>
                      
                          <tr>
                          	 <td height="50" colspan="2"><img src="" height="50" width="1" class="CToWUd"></td>
                          </tr>
                    </tbody></table>
                </td>
              </tr>     
              
              <tr>
                <td><table width="648" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td width="22"></td>
                      <td width="605"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          
                          <tbody><tr>
                            <td height="24"><img src="" height="24" width="1" class="CToWUd"></td>
                          </tr>

                          <tr>
                            <td style="color:#000;font-size:14px;line-height:24px;font-family:Arial,Helvetica,sans-serif">
							<strong>Best Regards,</strong><br>
                              <?php echo $best; ?><br></td>
                          </tr>
                          <tr>
                            <td height="5"><img src="" height="5" width="1" class="CToWUd"></td>
                          </tr>
                          
                          <tr>
                            <td height="21"><img src="" height="21" width="1" class="CToWUd"></td>
                          </tr>
                        </tbody></table></td>
                      <td width="21"></td>
                    </tr>
                  </tbody></table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#d6d6d6" style="font-size:1px;line-height:1px"></td>
              </tr>
              <tr>
                <td bgcolor="" height="50" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
					<tr>
                      <td width="25"></td>
                      <td width="505" style="color:#696868;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
					  <?php echo $supportmsg; ?>
					  <a href="mailto:<?php echo $support; ?>" style="color:#d95b23;text-decoration:none" target="_blank"><?php echo $support; ?></a></td>
                      <td width="118"><a href="#" alt="" border="0" class="CToWUd"></a></td>
                    </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table></td>
          <td width="1" bgcolor="#d6d6d6"></td>
        </tr>
        <tr> 
		</tr>
      </tbody>
	  </table>
	  </td>
  </tr>
  <tr>
    <td height="1" bgcolor="#d6d6d6" style="font-size:1px;line-height:1px"></td>
  </tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>