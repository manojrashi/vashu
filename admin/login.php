<?php
include("../include/config.php");
include("../include/functions.php");

$username=$obj->escapestring($_POST['username']);
$password=$obj->escapestring($_POST['password']);
if($_POST['logged'] == "yes"){
	$sql =$obj->query("select * from $tbl_admin where username='$username' and password='$password' and status=1",$debug=-1); //die;
	$row=$obj->numRows($sql);
	if($row>0){
		$line=$obj->fetchNextObject($sql);
		$_SESSION['sess_admin_id']=$line->id;
		$_SESSION['sess_admin_username']=$line->username;
		$_SESSION['user_type']=$line->user_type;
		if($_REQUEST['back']==''){
			header("location: welcome.php");
		}else{
			header("location:".$_REQUEST['back']);	
		}   	
	} else{
	
	$_SESSION['sess_msg'] = 'Invalid Username/Password';
	header("Location: index.php");
  }
}
?>