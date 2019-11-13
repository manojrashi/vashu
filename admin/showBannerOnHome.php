<?php
	session_start(); 
	include("../include/config.php");
	include("../include/functions.php"); 
	validate_admin();
	
	if($_REQUEST['id']!=''){
		
	$obj->query("update $tbl_banner set show_on_home=".$_REQUEST['chk']." where id='".$_REQUEST['id']."' ");	
		
	}

	if($_REQUEST['cat_id']!=''){
		
	$obj->query("update $tbl_maincategory set show_on_home=".$_REQUEST['chk']." where id='".$_REQUEST['cat_id']."'",$debug=-1); //die;
		
	}

	if($_REQUEST['category_id']!=''){
		
	$obj->query("update $tbl_maincategory set display_order=".$_REQUEST['value']." where id='".$_REQUEST['category_id']."' ");	
		
	}
	
	
	if($_REQUEST['counpon_id']!=''){
		
	$obj->query("update $tbl_coupon set show_on_home=".$_REQUEST['chk']." where id='".$_REQUEST['counpon_id']."' ");	
		
	}

	echo 1;
?>