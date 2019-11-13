<?php 
include("wfcart.php");
include("include/config.php");
include("include/functions.php"); 

 $_SESSION['user_name']="";
 $_SESSION['user_id']="";
 $_SESSION['value_user_email']="";
 session_destroy(); 
 
 // $recentlyQuery = $obj->query("delete from $tbl_recently_view where user_id='".$_SESSION['recently_view']."' ");
 
 // $_SESSION['recently_view']='';
 // unset($_SESSION['recently_view']);
 header("location:index.php");
 exit();
?>