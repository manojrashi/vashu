<?php 
session_start(); 
include( "../include/config.php"); 
include( "../include/functions.php"); 
validate_admin(); 

if($_REQUEST[ 'submitForm']=='yes' ){ 
	$status=$obj->escapestring($_REQUEST['status']);
	$cid=$obj->escapestring($_REQUEST['cid']);
	$remarks=$obj->escapestring($_REQUEST['remarks']); 
	
	$obj->query("insert into $tbl_complaint_comment set cid='$cid',comment='$remarks',posted_by='".$_SESSION['sess_admin_id']."'",$debug=-1); //die;
	$obj->query("update $tbl_feedback set posted_by='".$_SESSION['sess_admin_id']."',pdate=now(),status='$status' where id='$cid'");

$_SESSION['sess_msg']="Complaint status change successfully.!"; 
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>
<?php echo SITE_TITLE; ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle" class="headingbg bodr text14">
<em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>Complaint Query Status update
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td height="100" align="left" valign="top" bgcolor="#f7faf9" class="bodr">
<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="">
<input type="hidden" name="submitForm" value="yes" />
<input type="hidden" name="cid" value="<?php echo $_REQUEST['id']; ?>" />


<table width="100%" cellpadding="0" cellspacing="5">
<tr>
	<td align="center" colspan="2" style="color:#C00;">
		<?php echo $_SESSION[ 'sess_msg'];$_SESSION[ 'sess_msg']='' ; ?>
	</td>
</tr>

<tr>
	<td width="33%" align="right" class="paddBot11 paddRt14"><strong>Status</strong>
	</td>
	<td width="67%" align="left" class="paddBot11">
		<select name="status" class="required" style="margin: 0px; width: 280px; height: 25px;">
		    <option value="">Select</option>
		    <option value="2">Resolve</option>
		    <option value="1">Unresolve</option>
		</select>
	</td>
</tr>

<tr>
	<td width="33%" align="right" class="paddBot11 paddRt14"><strong>Remarks</strong>
	</td>
	<td width="67%" align="left" class="paddBot11">
		<textarea name="remarks" id="remarks" class="required" style="margin: 0px; width: 280px; height: 61px;"></textarea>
	</td>
</tr>
<tr>

	<td align="right" class="paddRt14 paddBot11">&nbsp;</td>

	<td align="left" class="paddBot11">&nbsp;</td>

</tr>

<tr>

	<td width="33%" align="right" class="paddRt14 paddBot11">&nbsp;</td>

	<td width="67%" align="left" class="paddBot11">

		<input type="submit" name="submit" value="Submit" class="submit" border="0" />&nbsp;&nbsp;&nbsp;&nbsp;</td>

	</tr>

</table>

</form>


</td>
</tr>
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f7faf9" class="bodr">
<?php 
$commentArr=$obj->query("select * from $tbl_complaint_comment where cid='".$_REQUEST['id']."' order by id desc",$debug=-1); 
if($obj->numRows($commentArr)>0){?>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="4" cellpadding="4" bgcolor="#f7faf9" class="bodr">
			<tr>
				<td width="21%"><strong>Date</strong></td>
				<td width="12%"><strong>Posted By</strong></td>
				<td width="12%"><strong>User Name</strong></td>
				<td width="44%"><strong>Comments</strong></td>
			</tr>
			<?php while($resultComment=$obj->fetchNextObject($commentArr)){?>
			<tr>
                <td>
                <?php echo date( 'd M Y H:i',strtotime($resultComment->posted_date)); ?></td>
                <td>
                <?php echo getField('emp_name',$tbl_admin,$resultComment->posted_by)." ".getField('emp_surname',$tbl_admin,$resultComment->posted_by); ?></td>
                <td>
                <?php echo getField('name',$tbl_user,$resultComment->cid)." ".getField('surname',$tbl_user,$resultComment->cid);?></td>
                <td><div style="width:100%; max-height:70px; overflow:auto">
                <?php echo stripslashes($resultComment->comment); ?></div></td>
                </tr>
                <?php } ?>
                </table>
                </td>
					</tr>
					<?php }else{ ?>
					<tr>
						<td align="center"><strong>No Record Found.</strong>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td align="center"></td>
					</tr>
				</table>
			</td>
		</tr>

	</table>
</body>
<style type="text/css">
	.error{color: red;}
</style>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#frm").validate();
	})
</script>
</html>
