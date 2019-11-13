<?php
include("include/config.php");
include("include/functions.php");

$prop_id=$obj->escapestring($_POST['prop_id']);
$user_id=$_SESSION['user_id'];


$sql=$obj->query("select * from $tbl_wishlist where user_id='$user_id' and product_id='$prop_id'",$debug=-1);
$rows=$obj->numRows($sql);

if($rows>0){
 echo "2";	
}else{
	$obj->query("insert into $tbl_wishlist set user_id='$user_id',product_id='$prop_id'",$debug=-1);
echo "1";
}

