<?php session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
$arr =$_POST['ids'];
//print_r($_REQUEST);
$Submit =$_POST['what'];

if(count($arr)>0){
	$str_rest_refs=implode(",",$arr);
	if($Submit=='Delete')
	{  
        $sql = $obj->query("delete from $tbl_order_itmes where order_id in ($str_rest_refs)");
	    $sql="delete from $tbl_order where id in ($str_rest_refs)"; 
		$obj->query($sql);
		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	
	}
	
else{
	$sess_msg="Please select check box";
	$_SESSION['sess_msg']=$sess_msg;
	header("location: ".$_SERVER['HTTP_REFERER']);
	exit();
	}
	header("location: order-all-list.php");
	exit();
	
?>
