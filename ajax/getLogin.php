<?php 
include('../include/config.php');
include("../include/functions.php");

$email = $_REQUEST['email'];
$pass = $_REQUEST['pass'];

$sql = $obj->query("select id,name,surname,user_type from $tbl_user where email='$email' and pass='$pass'",-1);
$num = $obj->numRows($sql);
if($num>0){
	$lResult = $obj->fetchNextObject($sql);

	$_SESSION['user_id']=$lResult->id;
	$_SESSION['user_type']=$lResult->user_type;
	$_SESSION['user_name']=$lResult->name." ".$lResult->surname;
	$userName=$lResult->name." ".$lResult->surname;	
	$response = array('success' =>1,'userName'=>$userName);
  	echo json_encode($response);
}else{
	$response = array('success' =>0);
  	echo json_encode($response);
}
?>
		

