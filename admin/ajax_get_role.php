<?php
include("../include/config.php");
include("../include/functions.php"); 
 validate_admin();
 $userid=$_REQUEST['userid'];
 ?>
<option value="">Select Designation</option>
<?php
$RoleArr=$obj->query("select * from $tbl_rolesubcategory where status=1 and role_id='".$userid."'",$debug=-1); 
while($RoleResult=$obj->fetchNextObject($RoleArr)){
?>
<option value="<?php echo $RoleResult->id; ?>"><?php echo stripslashes($RoleResult->role); ?></option>
<?php } ?>