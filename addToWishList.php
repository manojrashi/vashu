<?php 
include("wfcart.php");
include("include/config.php");
include("include/functions.php"); 
if($_REQUEST['pid']!=''){
	$pid=$obj->escapestring($_REQUEST['pid']);
	$recArr=$obj->query("select id from $tbl_wishlist where user_id='".$_SESSION['user_id']."' and product_id='".$pid."' ",$debug=-1);
	if($obj->numRows($recArr)>0){
		$rs=$obj->fetchNextObject($recArr);
		$obj->query("update $tbl_wishlist set added_date=now() where id='".$rs->id."'");	
	}else{
		$obj->query("insert into $tbl_wishlist set user_id='".$_SESSION['user_id']."',product_id='".$pid."',added_date=now() ");
	}
	echo ucfirst(getField('product_name_en',$tbl_product,$pid))." has been added to your wishlist.";	
	
	
	
}

?>