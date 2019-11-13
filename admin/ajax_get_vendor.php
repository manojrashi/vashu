<?php
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
$userid=$_REQUEST['userid'];

$var = "";

$RoleArr=$obj->query("select id,vender_name from $tbl_vender where status=1",$debug=-1); 
$var .='<option value="">Select Vendor</option>';
while($RoleResult=$obj->fetchNextObject($RoleArr)){
	$var .='<option value="'.$RoleResult->id.'">'.stripslashes($RoleResult->vender_name).'</option>';
}
echo $var; 
?>