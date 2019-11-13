<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

if($_REQUEST['submitForm']=='yes'){

  $fname = $obj->escapestring($_REQUEST['fname']);
  $lname = $obj->escapestring($_REQUEST['lname']);
  $email = $obj->escapestring($_REQUEST['email']);
  $pass = $obj->escapestring($_REQUEST['pass']);

  $obj->query("insert into $tbl_user set name='$fname',surname='$lname',email='$email',pass='$pass'",$debug=-1); //die;
  $lastInserId=$obj->lastInsertedId();
  
  $_SESSION['user_id']=$lastInserId;

  header("location:index.php");
  exit;

}
?>