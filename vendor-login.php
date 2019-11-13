<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();


if($_REQUEST['submitForm']=='yes'){
	$vendoremail=$obj->escapestring($_POST['vendoremail']);
	$vendorpass=$obj->escapestring($_POST['vendorpass']);

	$sql = $obj->query("select id from $tbl_vender where email='$vendoremail' and pass='$vendorpass'",$debug=-1);
	$num = $obj->numRows($sql);
	if($num>0){
		$VResult = $obj->fetchNextObject($sql);
		$_SESSION['v_user_id']=$VResult->id;
		header("location:vendor-dashboard.php");
		exit;
	}else{
		$_SESSION['errMsg']="Email & password are wrong. Please try again!";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("header.inc.php"); ?>
	<section id="default" style="margin-top: 89px;">
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3 background">
				<div class="col-xs-12 col-sm-12 border">
					<div class="col-xs-12 col-sm-12">
						<div class="chatcard">
							<h3>Vendor Login</h3>
							<?php if($_SESSION['errMsg']){?><p style="color: red;"><?php echo $_SESSION['errMsg']; $_SESSION['errMsg']=""; ?></p> <?php }?>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12">
						<div class="chatcard">
							<form name="vendorLoginfrm" id="vendorLoginfrm" method="post" action="">
								<input type="hidden" name="submitForm" value="yes"/>
								<div>
									<input name="vendoremail" id="vendoremail" type="text" placeholder="Username" class="required email">
								</div>
								<div>
									<input name="vendorpass" id="vendorpass" type="password" placeholder="Password" class="required">
								</div>
								<input type="submit" name="" value="Login" class="form-submit">
							</form>
						</div>
					</div>

				</div>

			</div>

		</div>
	</section>

	<section id="free-delivery">
		<div class="container">
			<div class="col-sm-3 left-icon">
				<div class="back">
					<ul>
						<li> <img src="images/img1.jpg" class="img-responsive"></li>
					</ul>
					<h1>Free Delivery</h1>
					<p>For all other over $99</p>
				</div>
			</div>
			<div class="col-sm-3 left-icon">
				<div class="back1">
					<ul>
						<li> <img src="images/img2.jpg" class="img-responsive"></li>
					</ul>
					<h1>90 Days Return</h1>
					<p>If goods have problems</p>
				</div>
			</div>
			<div class="col-sm-3 left-icon">
				<div class="back1">
					<ul>
						<li> <img src="images/img3.jpg" class="img-responsive"></li>
					</ul>
					<h1>Secure payment</h1>
					<p>100% Secure payment</p>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="back2">
					<ul>
						<li> <img src="images/img4.jpg" class="img-responsive"></li>
					</ul>
					<h1>24/7 Support</h1>
					<p>Dedicated support</p>
				</div>
			</div>
		</div>
	</section>
	<?php include("footer.inc.php"); ?>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#vendorLoginfrm").validate();
  })
</script>

</body>
</html>