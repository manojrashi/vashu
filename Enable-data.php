<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$propertyid=$_POST['propertyid'];
$propertylist=$obj->query("select * from tbl_useraddress where id='$propertyid'");
$fetchproperty=$obj->fetchNextObject($propertylist);
if($fetchproperty->status==1){
	$obj->query("update tbl_useraddress set status=0 where id='$propertyid'");
}
else{
	$obj->query("update tbl_useraddress set status=1 where id='$propertyid'");
}
?>

<?php 
$properid=$_POST['properid'];
$properlist=$obj->query("select * from tbl_useraddress where id='$properid'");
$fetchproper=$obj->fetchNextObject($properlist);
if ($fetchproper->status==1) {
	$obj->query("update tbl_useraddress set status=0 where id='$properid'");
}
else{
     $obj->query("update tbl_useraddress set status=1 where id='$properid'");
}

?>
