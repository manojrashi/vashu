<?php session_start();

include("include/config.php");
include("include/functions.php"); 

validate_user();

$arr =$_POST['ids'];
//print_r($arr); die;
$Submit =$_POST['what'];

if(count($arr)>0){
	$str_rest_refs=implode(",",$arr);
	if($Submit=='Delete')
	{
	   $sql="delete from $tbl_useraddress where id in ($str_rest_refs)"; 
		
// die;
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }

	elseif($Submit=='Enable')
	{	
		$sql="update $tbl_useraddress set status=1 where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) activated successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}

	elseif($Submit=='Disable')
	{		
		 $sql="update $tbl_useraddress set status=0 where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) deactivated successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	}
else{
	$sess_msg="Please select check box";
	$_SESSION['sess_msg']=$sess_msg;
	header("location: ".$_SERVER['HTTP_REFERER']);
	exit();
	}
	header("location: address.php");
	exit();
?>
