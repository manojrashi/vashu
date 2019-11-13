<?php
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
$userid=$_REQUEST['userid'];

$var = "";
$RoleArr=$obj->query("select emp_mobile1 from $tbl_admin where status=1 and id='".$userid."'",$debug=-1); 
$RoleResult=$obj->fetchNextObject($RoleArr);
echo $RoleResult->emp_mobile1; 
?>