<?php
include('include/config.php');
include("include/functions.php");
session_start();

if($_REQUEST['submitFrm']=='yes'){
  $email =  $obj->escapestring($_REQUEST['subs_email']);
  $sql = $obj->query("insert into $tbl_newsletter set email='$email'",$debug=-1); //die;
}
$_SESSION['msg'] = "Thanking your subscribers with a thank you email";
header("location:thanks.php")
?>

