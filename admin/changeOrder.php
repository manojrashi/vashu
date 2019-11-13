<?php 
include('../include/config.php');
include("../include/functions.php");
$val   = $_REQUEST['val'];
$id   = $_REQUEST['id'];
$main   = $_REQUEST['main'];
if($main==1){
	$sql=$obj->query("update $tbl_product set display_order='$val' where id='".$id."'",$debug=-1); 
}else{
	$sql=$obj->query("update $tbl_product set display_order1='$val' where id='".$id."'",$debug=-1); 
}

?>

		

