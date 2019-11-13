<?php 
include('../include/config.php');
include("../include/functions.php");
$val   = $_REQUEST['val'];
$id   = $_REQUEST['id'];
$sql=$obj->query("update $tbl_productprice set display_order='$val' where id='".$id."'",$debug=-1); 


echo "Selected Record Update Successfully";

?>

		

