<?php 
include("wfcart.php");
include("include/config.php");
include("include/functions.php"); 

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();
if($_REQUEST['action']=='add_cart'){
	$qty=1;
	if($_REQUEST['qty']!='' && $_REQUEST['qty']!=0 &&  $_REQUEST['qty']!='undefined'){
	$qty=$_REQUEST['qty'];
	}

	$pid=$_REQUEST['product_price_id'];
	$ppriceArr=$obj->query("select size,sell_price from $tbl_productprice where id='".$pid."' ",$debug=-1);
	$rsPrice=$obj->fetchNextObject($ppriceArr);
	$price=floatval($rsPrice->sell_price);
	$product_name=getField('product_name','tbl_product',$_REQUEST['product_id']);
	$cart->add_item($pid,$qty,$price,$product_name);
	echo $cart->itemcount;
}

if($_REQUEST['action']=='edit_cart'){
	  $qty=$_REQUEST['qty'];
      $pid=$_REQUEST['product_price_id'];
      $cart->edit_item($pid,$qty);	
	  echo 1;

}

if($_REQUEST['action']=='del_cart'){
 $pid=$_REQUEST['product_price_id'];	
 $cart->del_item($pid);
 echo $cart->itemcount+count($_SESSION['myprecart'])." items(s)";
}

if($_REQUEST['action']=='empty_cart'){
 $cart->empty_cart();
}

?>