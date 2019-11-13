<?php 
include("wfcart.php");
include("include/config.php");
include("include/functions.php"); 

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

if($_REQUEST['action']=='add_cart'){
	$qty=1;
	$pid=$_REQUEST['pid'];
	$price=number_format(getField('actual_price','tbl_product',$pid),2);
	$product_name=getField('product_name','tbl_product',$pid);
	$cart->add_item($pid,$qty,$price,$product_name);
	$_SESSION['sess_msg']="$product_name has been added to your shopping cart";
    header("location:cart.php");exit();
	
}
if($_REQUEST['action']=='edit_cart'){
	
	  $qty=$_REQUEST['qty'];
      $pid=$_REQUEST['pid'];
       $cart->edit_item($pid,$qty);	

//$_SESSION['sess_msg']="Your shopping cart has been updated";
 header("location:cart.php");exit();
}
if($_REQUEST['action']=='del_cart'){
 $pid=$_REQUEST['pid'];	
 $cart->del_item($pid);
 //$_SESSION['sess_msg']="Product has been  removed from your shopping cart";
 header("location:cart.php");exit();
}
if($_REQUEST['action']=='empty_cart'){
 $cart->empty_cart();
 $_SESSION['sess_msg']="All Product has been  removed from your shopping cart";
 header("location:cart.php");exit();
}

?>