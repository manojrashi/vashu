<?php 
include('../include/config.php');
include("../include/functions.php");
       

	$code=$_POST['couponCode'];
	$cartAmount=$_POST['cartAmount'];

	$sql1=$obj->query("SELECT * from tbl_coupon WHERE coupon_code='".$code."'",$debug=-1);
	$couponData=$obj->fetchNextObject($sql1);

	$sql2=$obj->query("SELECT * from tbl_user WHERE id='".$_SESSION['user_id']."'",$debug=-1);
	$userData=$obj->fetchNextObject($sql2);

	if (!empty($couponData)) { 		// Check coupon is valid or not
		
		// Get coupon code expire time
		$today = strtotime(date("Y-m-d H:i:s"));
		$end_date =  strtotime($couponData->expire_date);
		$expireTime =floor(($end_date-$today)/60);

		if ($expireTime>0) {	// Check coupon is Not Expire or Valid time	
			
			if ($couponData->valid_for=="All") { 	// Check coupan valid for All or Particular
				
				if ($couponData->discount_type=="Percent") {	// Check coupon code discount type
					
					if ($cartAmount>=$couponData->minimum_purchase) {	//Check cart amount greater than minimum purchase 
						$discountAmount=($cartAmount*$couponData->discount)/100;
						$_SESSION['couponDiscountAmount']=$discountAmount;
						$_SESSION['couponstatus']="1";
						$_SESSION['couponDiscountMsg']="Coupon success apply";
						$_SESSION['couponCode']=$code;
					} else {
						$_SESSION['couponDiscountMsg']="Please shop minimum Rs.".$couponData->minimum_purchase." to get discount";
						$_SESSION['couponstatus']="0";
					}
				} else {
					
					if ($cartAmount>=$couponData->minimum_purchase) {	//Check cart amount greater than minimum purchase 
						$discountAmount=$couponData->discount;
						$_SESSION['couponDiscountAmount ']=$discountAmount;
						$_SESSION['couponstatus']="1";
						$_SESSION['couponDiscountMsg']="Coupon success apply";
						$_SESSION['couponCode']=$code;
					} else {
						$_SESSION['couponDiscountMsg']="Please shop minimum Rs.".$couponData->minimum_purchase." to get discount";
						$_SESSION['couponstatus']="0";
					}

				}
						
			} else {
				
				if ($couponData->discount_type=="Percent") {	// Check coupon code discount type
					
					if ($cartAmount>=$couponData->minimum_purchase) {	//Check cart amount greater than minimum purchase 
						
						if ($couponData->user_group==$userData->user_group) { 		// Check user group is valid 
							$discountAmount=($cartAmount*$couponData->discount)/100;
							$_SESSION['couponDiscountAmount']=$discountAmount;
							$_SESSION['couponstatus']="1";
							$_SESSION['couponDiscountMsg']="Coupon success apply";
							$_SESSION['couponCode']=$code;
						} else {
							$_SESSION['couponDiscountMsg']="Coupon is not valid for you";
							$_SESSION['couponstatus']="0";
						}
						
					} else {
						$_SESSION['couponDiscountMsg']="Please Shop minimum Rs.".$couponData->minimum_purchase." to get discount";
						$_SESSION['couponstatus']="0";
					}

				} else {
					
					if ($cartAmount>=$couponData->minimum_purchase) {	//Check cart amount greater than minimum purchase 
					
						if ($couponData->user_group==$userData->user_group) { 		// Check user group is valid 
							$discountAmount=$couponData->discount;
							$_SESSION['couponDiscountAmount']=$discountAmount;
							$_SESSION['couponstatus']="1";
							$_SESSION['couponDiscountMsg']="Coupon success apply";
							$_SESSION['couponCode']=$code;


						} else {
							$_SESSION['couponDiscountMsg']= "Coupon is not valid for you";
							$_SESSION['couponstatus']="0";
						}
					} else {
						$_SESSION['couponDiscountMsg']= "Please Shop minimum Rs.".$couponData->minimum_purchase." to get discount";
						$_SESSION['couponstatus']="0";
					}

				}
			}
		
		} else {
			$_SESSION['couponDiscountMsg']= "Coupon code is expire";
			$_SESSION['couponstatus']="0";
		}

	} else {
		$_SESSION['couponDiscountMsg']= "Coupon code is invalid";
		$_SESSION['couponstatus']="0";
	}
	
	print_r($_SESSION);
        
?>
		

