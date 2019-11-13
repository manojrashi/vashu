<?php
ob_start();
session_start(); 
include('include/config.php');
include("include/functions.php");
$id = $_REQUEST['id'];
$user_id = $_REQUEST['user_id'];
if($id!=''){
	$obj->query("update $tbl_useraddress set main_id=0 where user_id='$user_id'",-1);
	$obj->query("update $tbl_useraddress set main_id=1 where id='$id'",-1);
}

?>