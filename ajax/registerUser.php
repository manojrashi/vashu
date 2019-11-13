<?php 
include('../include/config.php');
include("../include/functions.php");

$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['pass'];

  $obj->query("insert into $tbl_user set name='$fname',surname='$lname',email='$email',pass='$pass'",$debug=-1); //die;
  $lastInserId=$obj->lastInsertedId();
  
  if ($lastInserId>0) {
  	$_SESSION['user_id']=$lastInserId;
    $_SESSION['user_name']=$fname." ".$lname;	
    $userName=$fname." ".$lname;	
    $response = array('success' =>1,'userEmail'=>$email,'userName'=>$userName);
  	echo json_encode($response);
  }else{
  	$response = array('success' =>0);
  	echo json_encode($response);
  }
  
?>
		

