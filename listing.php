<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

$sql=$obj->query("select product_id from $tbl_wishlist where user_id='".$_SESSION['user_id']."'",$debug=-1);
while($rows=$obj->fetchNextObject($sql)){
$result[]=$rows->product_id;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php"); ?>
</head>
<body>
<?php include("header.inc.php"); ?>
<section id="listing">
<div class="container">
<?php include("listing-left.php"); ?>
<!-- <div class="col-xs-12 col-sm-10">
<img src="images/banner.png" class="img-responsive">
</div> -->
<div class="col-xs-12 col-sm-9" id="click-page">
<div class="fade-page">
<div class="fade-main-page">
<div class="loading"><img src="images/loading_brown.gif" />
<p> <?php echo $Loading; ?>...</p>
</div>
</div>  
<div class="col-xs-12 col-sm-12">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
<?php 
if(!empty($_GET['cat_id']) && empty($_GET['subcat_id'])){
$cat_id=$_GET['cat_id'];  //die;
$subcat=$obj->query("select * from $tbl_category where id='$cat_id'",-1);
$categoryResult=$obj->fetchNextObject($subcat);
$imageUrl=$categoryResult->cimage;
}else if(!empty($_GET['subcat_id'])) {
$subcat_id=$_GET['subcat_id'];
$category=$obj->query("select * from $tbl_subcategory where status=1 and id='$subcat_id'",-1);
$subcategoryResult=$obj->fetchNextObject($category); 
$imageUrl=$subcategoryResult->cimage;
}else{
$subcat_id=$_GET['subcat_id'];
$category=$obj->query("select * from $tbl_subcategory where status=1 and id='$subcat_id'",-1);
$subcategoryResult=$obj->fetchNextObject($category); 
$imageUrl=$subcategoryResult->cimage;
}


?>    


<img src="upload_images/category/<?php echo $imageUrl; ?>" style ="width: 100%; height: 300px;">

</div>
</div>
</div> 
<div class="col-xs-12 col-sm-10" id="click-page">
<ul class="teg-links">
<?php
$id=$_GET['cat_id'];
$subcat_id=$_GET['subcat_id']; 
$brand=$obj->query("select * from tbl_brand where cat_id='$id' and subcat_id='$subcat_id'",-1);
while ($brandresult=$obj->fetchNextObject($brand)){?>
<li><a href="listing.php?cat_id=<?php echo $id;?>&subcat_id=<?php echo $subcat_id;?>&brand_id=<?php echo $brandresult->id?>"><?php echo $brandresult->brand;?></a></li>
<?php } ?>
</ul>

</div>

<div id="listing_search_result">

<div class="col-xs-12 col-sm-12">
<div class="row">
<?php
$rowss=$obj->numRows($prodsearchArr);
if($rowss>0){
while($resultProduct=$obj->fetchNextObject($prodsearchArr)){
?> 

<div class="col-xs-12 col-sm-3">
<div class="item">

<div class="similiar-product" style="min-height: 340px;">

<?php
if($resultProduct->pphoto==''){

	?>
	<img src="images/noimage.jpeg">

	<?php } else {?>
	<figure><img src="upload_images/product/thumb/<?php echo $resultProduct->pphoto; ?>" class="img-responsive" style="width: 174px; height: 154"></figure>
	<h3><a href="details/<?php echo $resultProduct->slug; ?>" style="text-decoration: none;">
		<?php } ?>
		<?php 
			echo $resultProduct->product_name;
		?>
	</a></h3>
	<i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> 02
	<p><?php echo $website_currency_symbol; ?> <?php echo $resultProduct->sell_price; ?></p>
	<div class="hovermain">
		<ul>
			<a href="javascript:void(0)" data-one="<?php echo $resultProduct->pid; ?>" data-two="<?php echo $resultProduct->prid; ?>" class="procart-btn add-to-cart">
				<img src="images/bag.jpg">
			</a>
			<a href="details/<?php echo $resultProduct->slug; ?>">
				<img src="images/eye.jpg"></a> 

				<?php if($_SESSION['user_id']){  ?>
				<a title="Add to Wishlist" onclick="addWishlist(<?php echo $resultProduct->pid; ?>)"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
				<?php } else { ?>
				<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
				<?php } ?>
			</ul>

		</div>
		<p id="addedprod<?php echo $resultProduct->pid; ?>" style="color: green; font-size: 14px;"></p>
	</div>
</div>
</div>
<?php }}else{?>	
<p class="not-found">No Product Available...</p>

<?php } ?>  
<?php if($rowss>0){ ?>
<div class="col-xs-12 col-sm-12" id="click-page">
<div class="col-xs-12 col-sm-12">
	<?php if($total_pages>0){ ?>
	<div class="list">
		<p><?php echo $Showing; ?> <?php echo $start+1; ?> -
			<?php if($limit>$total_pages){ echo $total_pages;}else{ echo ($start+1)*$limit; }?>
			of <?php echo $total_pages; ?> <?php echo $products; ?>
			<?php echo $pagination; ?>
			</p>	
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<?php include("footer.inc.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
$(".loading").hide();
$(".dropdown").hover(            
function() {
$('.dropdown-menu', this).stop( true, true ).slideDown("fast");
$(this).toggleClass('open');        
},
function() {
$('.dropdown-menu', this).stop( true, true ).slideUp("fast");
$(this).toggleClass('open');       
}
);
});
</script> 
<script>
$(document).ready(function() {
var owl = $('.owl-carousel');
owl.owlCarousel({
margin: 20,
nav: true,
navText: ["", ""],
loop: true,
responsive: {
0: {
items: 2
},
600: {
items:5
},
1000: {
items:5
}
}
})

})
</script> 
<script src="js/jquery.bxslider.js"></script>

</body>
</html>
