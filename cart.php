<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php"); ?>
</head>
<body>
<?php include("header.inc.php"); ?>
<?php
$itmes=$cart->get_contents();
?>
<section id="default" style="margin-top: 89px;">
<div class="container">
<div class="col-xs-12 col-sm-8 background">
<div class="col-xs-12 col-sm-12 border">
<div class="col-xs-12 col-sm-8">
<div class="chatcard">
<h3>My Cart (<?php echo count($itmes); ?>)</h3>
</div>
</div>
</div>
<?php
$no_of_itmes=count($itmes);
if($no_of_itmes>0){
foreach($itmes as $item){ 
$prArr=$obj->query("select a.id,a.product_name,a.slug,a.short_description_en,a.short_description_ar,b.pphoto from $tbl_product AS a INNER JOIN $tbl_productprice AS b ON a.id=b.product_id where b.id='".$item['id']."' ",$debug=-1);
$resultProduct=$obj->fetchNextObject($prArr);
?>
<div class="col-xs-12 col-sm-12 checks">
<div class="col-xs-12 col-sm-3">
<div class="img"> <?php
if(is_file("upload_images/product/thumb/".$resultProduct->pphoto)){?>
<img src="upload_images/product/thumb/<?php echo $resultProduct->pphoto; ?>">
<?php }else{?>

<?php }?></div>
<div class="plus-min">
	<span class="min button" onClick="return DescQty(<?php echo $item['id']; ?>);">-</span>
	<input type="text" name="qty" id="p_<?php echo $item['id']; ?>" value="<?php echo $item['qty']; ?>" maxlength="2" onBlur="return UpdateMyCart(<?php echo $item['id']; ?>);"/>
	<span class="plus button" onClick="return IncQty(<?php echo $item['id']; ?>);">+</span>
</div>
</div>
<div class="col-xs-12 col-sm-5">
<div class="pinchange">
	<ul>
		<li><a href="details/<?php echo $resultProduct->slug; ?>" style="text-decoration: none;">
			<?php 
			echo $resultProduct->product_name;
			?></a></li>
	</ul>
	<?php 
		echo substr($resultProduct->short_description,0,80)."..."; 
	?>

	<h2><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $item['qty']*$item['price']; ?><!-- <a href="#">2 Offers Available</a> --></h2>
	<ul class="secound">
	<?php if($_SESSION['user_id']){?>
	<li><a href="javascript:void(0);" style="text-decoration: none;" onclick="addWishlist(<?php echo $resultProduct->id; ?>)">Add to Wishlist</a></li>
	<?php }else{?>
	<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Add to Wishlist</a></li>
	<?php }?>

		<li><a href="javascript:void(0);" style="text-decoration: none;" onClick="return deleteCart(<?php echo $item['id']; ?>);">Remove</a></li>
	</ul>
	<p id="addedprod<?php echo $resultProduct->id; ?>" style="color: green; font-size: 14px;"></p>
</div>
</div>
<div class="col-xs-12 col-sm-4 right">
<h2><?php echo $Deliveryin; ?> 3-4 <?php echo $days; ?> | <i class="fa fa-inr" aria-hidden="true"></i><?php 
$delivery_charge = getField('delivery_charge',$tbl_setting,1); 
echo number_format($delivery_charge,2);
?></h2>
<p>10 days replacement policy</p>
</div>
</div>


<?php 
$subtotal = $subtotal + $item['subtotal'];
}?>
<?php } else { ?>
<div align="center" style="width:100%; padding: 78px; width: 100%; margin-bottom: 51px; font-size: 22px; color: red;">your cart is empty.</div>
<div class="enter-your-evoucher" style="margin-left: 35px;"> <a href="<?php echo SITE_URL; ?>">Continue Shopping</a> </div>
<?php } ?>


<div class="shopping">
<ul>
<li><a href="index.php">Continue Shopping</a></li>
</ul>
</div>
</div>

<div class="col-xs-12 col-sm-4">
<div class="background">     
<div class="CardSummary">
<div class="details">
<h2>Price Details</h2>
</div>
<div class="CardBlock1">
<h4>
Sub Total<span><i class="fa fa-rupee"></i> <span><?php echo number_format($subtotal,2); ?></span></span> </div>
<div class="CardBlock1">
	<h4>
		Discount<span><i class="fa fa-rupee"></i> <span><?php echo $discount = "0.00"; ?></span></span> </div>
		<div class="CardBlock">
			<h4>Shipping<span> <span><?php 
			$delivery_charge = getField('delivery_charge',$tbl_setting,1); 
			echo number_format($delivery_charge,2);
			?></span></span></h4>
			<input type="hidden" name="" id="total" value="469">
		</div>
		<div class="CardBlock1">
			<h4>Payble Amount<span><i class="fa fa-rupee"></i> <span><?php echo number_format($subtotal+$delivery_charge-$discount,2); ?></span></span></h4>
		</div>
	</div>
	<?php
	if($no_of_itmes>0){?>
		<button onclick="location.href='checkout.php'" style="width: 100%;">Checkout</button>
	<?php }?>
</div>

</div>
</div>
</section>

<?php include("footer.inc.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
jQuery(function(){
var j = jQuery; //Just a variable for using jQuery without conflicts
var addInput = '#qty'; //This is the id of the input you are changing
var n = 1; //n is equal to 1

//Set default value to n (n = 1)
j(addInput).val(n);

//On click add 1 to n
j('.plus').on('click', function(){
j(addInput).val(++n);
})

j('.min').on('click', function(){
//If n is bigger or equal to 1 subtract 1 from n
if (n >= 1) {
j(addInput).val(--n);
} else {
//Otherwise do nothing
}
});


});
</script>
<script>
</script>
</body>
</html>