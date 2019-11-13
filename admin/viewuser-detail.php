<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
  
     
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_user where id=".$_REQUEST['id']);
$result=$obj->fetchNextObject($sql);
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SITE_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />


</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="middle" class="headingbg bodr text14">
					<em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>Admin: User Details
					</td>
						</tr>
						
						<tr>
							<td height="100" align="left" valign="top"  bgcolor="#f7faf9" class="bodr">
							<table width="100%" cellpadding="0" cellspacing="0">
									<tr>
										<td width="33%" align="right" class="paddBot11 paddRt14">&nbsp;</td>
										<td width="10%" align="center" class="paddBot11 paddRt14">&nbsp;</td>
										<td width="57%" align="left" class="paddBot11"></td>
									</tr>
                                    
									<tr>
									  <td align="left" class="paddBot11 paddRt14"><strong> Name</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo stripslashes($result->name)." ".stripslashes($result->surname); ?></td>
							 		 </tr>
									 <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>True Color Name/Mobile</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo stripslashes($result->truecolorname)." / ".stripslashes($result->mobile3); ?></td>
							 		 </tr>
								 
									<tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Email</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11"><?php echo stripslashes($result->email);?></td>
							  </tr>
							  
                              	<tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Contact No.</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11"><?php echo stripslashes($result->mobile)." / ".stripslashes($result->mobile2);?></td>
							  </tr>
							   
                                 	<tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Date of Birth</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11"><?php echo stripslashes($result->dob);?></td>
							  </tr>
							  
							  <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Date of Anniversary</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11"><?php echo stripslashes($result->doa);?></td>
							  </tr>
                                

							
                              <tr>
                                      <td align="left" class="paddBot11 paddRt14"><strong>Religion</strong></td>
                                      <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11"><?php echo stripslashes($result->religion);?></td>
							  </tr>
								
							  <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>User Group</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11"><?php echo getField('groupname',$tbl_usergroup,$result->user_group);?></td>
							  </tr>
							  
									<tr>
										<td width="33%" align="left" class="paddRt14 paddBot11">&nbsp;</td>
										<td width="10%" align="center" class="paddBot11 paddRt14">&nbsp;</td>
										<td width="57%" align="left" class="paddBot11">&nbsp;</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td align="center">&nbsp;</td></tr>
						<tr>
							<td height="100" align="left" valign="top"  bgcolor="#f7faf9" class="bodr">
							<?php
							$Sno=1;
							$AddressSql = $obj->query("select * from $tbl_useraddress where user_id='".$_REQUEST['id']."' and status=1",$debug=-1);
							while($AddressResult = $obj->fetchNextObject($AddressSql)){?>
							<h3>Address<?php echo $Sno; ?> <?php if($AddressResult->main==1){?>( Main )<?php } ?></h3>
							<table width="100%" cellpadding="0" cellspacing="0">
									                            
									<tr>
									  <td align="left" class="paddBot11 paddRt14"><strong> Plot/Flat/Door/Suite No </strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo stripslashes($AddressResult->flat); ?></td>
							 		 </tr>
							  
							 		 <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Floor No </strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo stripslashes($AddressResult->flor); ?></td>
							 		 </tr>
							 		 
							 		  <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Tower Name/No. </strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo stripslashes($AddressResult->tower); ?></td>
							 		 </tr>
							 		 <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Street Name/Number </strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo stripslashes($AddressResult->street_no); ?></td>
							 		 </tr>
							 		 
							 		 <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Block</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo stripslashes($AddressResult->block); ?></td>
							 		 </tr>
							 		 
							 		 <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Land Mark</strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo stripslashes($AddressResult->landmark); ?></td>
							 		 </tr>
							 		 
							 		 <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong> Society </strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php  echo getField('society',$tbl_society,$AddressResult->society); ?></td>
							 		 </tr>
							 		 
							 		  <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong> Sector </strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php  echo getField('area',$tbl_area,$AddressResult->area); ?></td>
							 		 </tr>
							 		 
							 		 <tr>
									  <td align="left" class="paddBot11 paddRt14"><strong>Town/City/District </strong></td>
									  <td width="10%" align="center" class="paddBot11 paddRt14">:</td>
									  <td align="left" class="paddBot11">
									  <?php echo getField('city',$tbl_city,$AddressResult->city); ?></td>
							 		 </tr>
							 		
							 		
							 		  
							 		  
									
									<tr>
										<td width="33%" align="left" class="paddRt14 paddBot11">&nbsp;</td>
										<td width="10%" align="center" class="paddBot11 paddRt14">&nbsp;</td>
										<td width="57%" align="left" class="paddBot11">&nbsp;</td>
									</tr>
								</table>
								<?php $Sno++; } ?>
							</td>
						</tr>
					</table>
</body>
</html>
