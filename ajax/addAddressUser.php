<?php 
include('../include/config.php');
include("../include/functions.php");

$address = $_REQUEST['address'];


 if (!empty($_SESSION['user_id'])) {
    

  $obj->query("insert into $tbl_useraddress set user_id='".$_SESSION['user_id']."',address='$address'",$debug=-1); //die;
  $lastInserId=$obj->lastInsertedId();
  

}
  
?>
		

