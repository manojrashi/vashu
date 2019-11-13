<?php 
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
$arr =$_POST['ids'];
//print_r($_REQUEST);die;

$Submit =$_POST['what'];

if(count($arr)>0){
	$str_rest_refs =implode(",",$arr);
	if($Submit=='Delete')
	{	  
	   
	   $sql="delete from $tbl_user where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Enable')
	{	
		$sql="update $tbl_user set status=1 where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) activated successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Disable')
	{		
		 $sql="update $tbl_user set status=2 where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) deactivated successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Blocked')
	{		
		 $sql="update $tbl_user set status=3 where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) deactivated successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	
	elseif($Submit=='Assign')
	{	
		$emp_id =$_POST['emp_id'];
		$assign_date =$_POST['assign_date'];
		$str_rest_refsArr = explode(',',$str_rest_refs);
		$cdate = date('Y-m-d h:i:s');
		foreach($str_rest_refsArr as $val){
			$sql=$obj->query("insert into $tbl_user_assign set emp_id='$emp_id',user_id='$val',assign_date='$assign_date',cdate='$cdate'",$debug=-1); //die;
		}
		$sess_msg='Selected record(s) assigned successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	
	
}
	
else{
	$sess_msg="Please select check box";
	$_SESSION['sess_msg']=$sess_msg;
	header("location: ".$_SERVER['HTTP_REFERER']);
	exit();
	}
	header("location: ".$_SERVER['HTTP_REFERER']);
	exit();
	
?>
