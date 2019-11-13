<?php
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
$userid=$_REQUEST['userid'];

$var = "";

$RoleArr=$obj->query("select id,emp_name,emp_surname,emp_mobile1 from $tbl_admin where status=1 and find_in_set($userid,designation)",$debug=-1); 
$var .='<option value="">Select Employee</option>';
while($RoleResult=$obj->fetchNextObject($RoleArr)){
	$var .='<option value="'.$RoleResult->id.'">'.stripslashes($RoleResult->emp_name).' '.stripslashes($RoleResult->emp_surname).'</option>';
}
echo $var; 
?>