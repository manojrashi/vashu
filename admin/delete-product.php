<?php 
session_start(); 
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();

$user_id=$_SESSION['sess_admin_id'];

$product_id=$_POST['proid'];

echo"delete from tbl_preorder_product where product_id='".$product_id."' and user_id='".$user_id."'";
$obj->query("delete from tbl_preorder_product where product_id='".$product_id."' and user_id='".$user_id."'");

?>