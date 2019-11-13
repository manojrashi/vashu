<?php
	session_start(); 
	include("../include/config.php");
	include("../include/functions.php"); 
	validate_admin();
	//print_r($_REQUEST);
	if($_REQUEST['id']!='' && $_REQUEST['action']=='phome'){
		$obj->query("update $tbl_product set home=".$_REQUEST['chk']." where id='".$_REQUEST['id']."'",$debug=-1); //die;
		echo 1;
	}
	if($_REQUEST['id']!='' && $_REQUEST['action']=='bseller'){
		$obj->query("update $tbl_product set best_seller=".$_REQUEST['chk']." where id='".$_REQUEST['id']."'",$debug=-1); //die;
		echo 1;
	}
	
	
	
?>