<?php 
include("../include/config.php");
include("../include/functions.php"); 

if($_REQUEST['action']=='add_cart'){
	$qty=1;
	if($_REQUEST['qty']!='' && $_REQUEST['qty']!=0 &&  $_REQUEST['qty']!='undefined'){
	$qty=$_REQUEST['qty'];
	}
	
	$pid=$_REQUEST['product_price_id'];
	$ppriceArr=$obj->query("select size,sell_price from $tbl_productprice where id='".$pid."' ",$debug=-1);
	$rsPrice=$obj->fetchNextObject($ppriceArr);
	$price=floatval($rsPrice->sell_price);
	$product_name=getField('product_name','tbl_product',$_REQUEST['product_id'])." ".$rsPrice->size;
	
?><div class="prod_<?php echo $pid; ?>">
<input type="hidden" name="ppid[]" value="<?php echo $pid; ?>" />
<div  align="left"><?php echo $product_name;?><a href="javascript:void(0)" onclick="$('.prod_<?php echo $pid; ?>').html('')"><img src="images/del.png" /></a></div>
</div>
<?php 
	
}
?>