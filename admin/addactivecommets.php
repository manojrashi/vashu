<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();

if($_REQUEST['submitForm']=='yes'){

	$comments=mysql_real_escape_string($_REQUEST['comments']);
	$order_status=mysql_real_escape_string($_REQUEST['order_status']);
    $order_id=mysql_real_escape_string($_REQUEST['order_id']);
	
	$obj->query("insert into $tbl_order_comments set comments='$comments',order_status='$order_status',order_id='$order_id',posted_date=now(),posted_by='".$_SESSION['sess_admin_id']."'");

	$obj->query("update $tbl_order set order_status='$order_status' where id='$order_id' ");	
	$_SESSION['sess_msg']="Assign successfully.!";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SITE_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="left" valign="middle" class="headingbg bodr text14">
							<em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>Admin: Assign Order ID : <?php echo $_REQUEST['order_id']; ?></td>
						</tr>
						<tr>
						<td height="100" align="left" valign="top" bgcolor="#f7faf9" class="bodr">
						<form name="frm" method="POST" enctype="multipart/form-data" action="" onSubmit="return validate(this)">
                        <input type="hidden" name="submitForm" value="yes" />
						<input type="hidden" name="order_id" value="<?php echo $_REQUEST['order_id'];?>" />
							<table width="100%" cellpadding="0" cellspacing="0">
									<tr><td align="center" colspan="2" style="color:#C00;"><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']=''; ?></td></tr>

                                   <tr>

										<td width="33%" align="right" class="paddBot11 paddRt14"><strong>Current Status</strong></td>

										<td width="67%" align="left" class="paddBot11">
										<select name="order_status" class="form-control" style="width: 250px;">

                                      <option value="">Select  Status</option>

									  <?php $statusArr=$obj->query("select * from $tbl_order_status where status=1 and id in(2,3,7) ");

									  $current_status=getField('order_status',$tbl_order,$_REQUEST['order_id']);

									   while($resultStatus=$obj->fetchNextObject($statusArr)){ ?>

                                       <option value="<?php echo $resultStatus->id; ?>" <?php if($resultStatus->id==$current_status){ ?>selected<?php } ?>><?php echo stripslashes($resultStatus->order_status); ?></option>

                                      <?php } ?>

                                      </select></td>

									</tr>

									<tr>

										<td width="33%" align="right" class="paddBot11 paddRt14"><strong>Comment</strong></td>

										<td width="67%" align="left" class="paddBot11"><textarea name="comments" rows="5" cols="40"></textarea></td>

									</tr>

									<tr>

									  <td align="right" class="paddRt14 paddBot11">&nbsp;</td>

									  <td align="left" class="paddBot11">&nbsp;</td>

							  </tr>

									<tr>

										<td width="33%" align="right" class="paddRt14 paddBot11">&nbsp;</td>

										<td width="67%" align="left" class="paddBot11">

											 	  	<input type="submit" name="submit" value="Submit"  class="submit" border="0" />&nbsp;&nbsp;&nbsp;&nbsp;</td>

									</tr>

								</table>

								</form>

							</td>

						</tr>

						<tr><td align="center"> 	    </td></tr>

         

                       

</table>

</td></tr>

                      

					</table>

</body>

</html>

