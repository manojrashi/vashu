<?php session_start();
include("include/config.php");
include("include/functions.php"); 
validate_user();
$arr =$_POST['ids'];
//print_r($_REQUEST);
$Submit =$_POST['what'];
if(count($arr)>0){
	$str_rest_refs=implode(",",$arr);


	if($Submit=='Delete')
	{	

			
		$imageArr=$obj->query("select pphoto,product_id from $tbl_productprice where product_id in ($str_rest_refs) ",$debug=-1);  
		while($resultImage=$obj->fetchNextObject($imageArr)){
		@unlink("upload_images/product/".$resultImage->pphoto); 
		@unlink("upload_images/product/tiny/".$resultImage->pphoto);
		@unlink("upload_images/product/thumb/".$resultImage->pphoto);
		@unlink("upload_images/product/big/".$resultImage->pphoto);
		}
		
		/*$imageArr=$obj->query("select product_id from $tbl_product where id in ($str_rest_refs) ",$debug=-1); //die;
		while($resultImage=$obj->fetchNextObject($imageArr)){
	        $obj->query("delete from $tbl_stock where product_id = '".$resultImage->product_id."'",$debug=-1); //die;
		}
		*/
	    
		$sql="delete from $tbl_productprice where product_id in ($str_rest_refs)"; 
		$obj->query($sql);
		
		$obj->query("delete from $tbl_cart where product_id in ($str_rest_refs)");
	    $sql="delete from $tbl_product where id in ($str_rest_refs)"; 
		$obj->query($sql);

		$sess_msg='Selected record(s) deleted successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Make Latest')
	{	
		$sql="update $tbl_product set latest=1 where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) activated successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Remove Latest')
	{	
		$sql="update $tbl_product set latest=0 where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) activated successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Enable')
	{	
		$sql="update $tbl_product set status=1 where id in ($str_rest_refs)";
		$obj->query($sql);
		$sess_msg='Selected record(s) activated successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Disable')
	{		
		 $sql="update $tbl_product set status=0 where id in ($str_rest_refs)";
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
	header("location:manage-product.php");
	exit();
	
?>
