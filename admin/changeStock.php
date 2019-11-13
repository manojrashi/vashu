<?php 
include('../include/config.php');
include("../include/functions.php");
$row_id   = $_REQUEST['row_id'];
$box_val   = $_REQUEST['box_val'];

if(trim($box_val)=='true'){
	$box_val=1;
}else{
	$box_val=0;
}
$sql=$obj->query("update $tbl_productprice set in_stock='$box_val' where id='".$row_id."'",$debug=-1); 
echo "Selected Record Update Successfully";

?>

		

