<?php session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
if($_REQUEST['id']!=''){
$obj->query("update $tbl_admin set password='18bazaar@123' where id='".$_REQUEST['id']."'",$debug=-1);
	$_SESSION['sess_msg']="Password reset successfully.! New password is 18bazaar@123";
}
header("location:".$_SERVER['HTTP_REFERER']);
exit();
?>