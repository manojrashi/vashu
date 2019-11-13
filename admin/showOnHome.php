<?php
	session_start(); 
	include("../include/config.php");
	include("../include/functions.php"); 
	validate_admin();
	//print_r($_REQUEST);
	if($_REQUEST['id']!=''){
		
	$obj->query("update $tbl_category set show_home=".$_REQUEST['chk']." where id='".$_REQUEST['id']."' ");	
		
	}
	if($_REQUEST[spcatid]!=''){
		
		$obj->query("update $tbl_specialcategory set show_home=".$_REQUEST['chk']." where id='".$_REQUEST['spcatid']."' ");	
	}
	if($_REQUEST['specialcatid']){
		$obj->query("update $tbl_specialcategory set home_limit=".$_REQUEST['limit_value']." where id='".$_REQUEST['specialcatid']."' ");	
	}
	if($_REQUEST['product_price_id']){
		$obj->query("update $tbl_productprice set display_order=".$_REQUEST['value']." where id='".$_REQUEST['product_price_id']."' ");	
	}
	echo 1;
	
?>