<?php
include("wfcart.php"); 
include('include/config.php');
include("include/functions.php");

session_start();
$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

$itmes=$cart->get_contents();
$no_of_itmes=count($itmes);

if($_POST['payment_method']=='cod'){

    if($no_of_itmes>0){
    
    $userid = $_SESSION["user_id"];
    $userAddId = $_POST["address_id"];
    $address=getField('address',$tbl_useraddress,$userAddId); 
    $cart_total_amount = $_POST["cart_total_amount"];
    $payment_type = $_POST["payment_method"];
    $discount=$_SESSION['couponDiscountAmount'];
    $couponCode=$_SESSION['couponCode'];
    $delivery_charge = getField('delivery_charge',$tbl_setting,1); 
    $payment_status='0';

    


        $lastOrderIdSql = $obj->query("select count(id) as id from $tbl_order where 1=1 and DATE(order_date) = DATE(CURDATE())");
        $lastOrderIdResult = $obj->fetchNextObject($lastOrderIdSql);
        $lastOrderId = $lastOrderIdResult->id;

        
        $OSql = "";
        $cdte = date('dmY');
        $orderno = "YE".$cdte.$lastOrderId;
        if($orderno!=''){
          $OSql .= "orderno='$orderno'";
        }
        if($userid!=''){
          $OSql .= ", user_id='$userid'";
        }
        if($cart->total!=''){
          $OSql .= ", amount='$cart->total'";
        }
        if($discount!=''){
          $OSql .= ", discount='$discount'";
        }
        if($delivery_charge!=''){
           
          $OSql .= ", shipping_amount='$delivery_charge'";
        }
        if($otherDiscount!=''){
          $OSql .= ", other_discount='0'";
        }
        if($payment_type!=''){
          $OSql .= ", payment_method='$payment_type'";
        }
        if($cart_total_amount!=''){
          $OSql .= ", total_amount='$cart_total_amount'";
        }
        if($couponCode!=''){
          $OSql .= ", coupon_code='$couponCode'";
        }
        if($address!=''){
          $OSql .= ", ship_address='$address'";
        }
        if($payment_status!=''){
          $OSql .= ", payment_status='$payment_status'";
        }
        if($ip!=''){
          $OSql .= ", ip='$ip'";
        }
        if($ship_type){
          $OSql .= ", ship_type='$ship_type'";
        }
        $order_date = date('Y-m-d H:i');
        $obj->query("insert into $tbl_order set $OSql,order_date='$order_date' ",$debug=-1); //die;


        $lastId=$obj->lastInsertedId();
        $orderStatus=1;
        $_SESSION['OrerID']=$lastId;

        foreach ($itmes as $key => $value) {

              $pSql = $obj->query("select * from $tbl_productprice where id='".$value['id']."' ",$debug=-1);
              $pResult = $obj->fetchNextObject($pSql);

              $pname= getField('product_name_en',$tbl_product,$pResult->product_id);
              $pid=$pResult->product_id;
              $id=$value['id'];
              $price=$value['price']; 
              $qty=$value['qty'];
              $status = getField('in_stock',$tbl_productprice,$id);
              if($status==1){
                $status=1;

              }else{
                $outStockProd=$outStockProd+1;
                $status=0;
              }
              

            $obj->query("insert into $tbl_order_itmes set 
                    order_id='$lastId',
                    product_id='$pid',
                    price_id='$id',
                    product_name='$pname',
                    price='$price',
                    qty='$qty',
                    status='$status'
                    ",$debud=-1);

        }
        $cart->empty_cart();
    }
}else{
}


if($_SESSION['OrerID']!=""){
    $oSql = $obj->query("select * from $tbl_order where id='".$_SESSION['OrerID']."'");
    $OResult = $obj->fetchNextObject($oSql);

    $ISql = $obj->query("select * from $tbl_order_itmes where order_id='".$_SESSION['OrerID']."'",$debug=-1);
    $IResult = $obj->numRows($ISql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php"); ?>
</head>
<body>
	<?php include("header.inc.php"); ?>

	<section class="thanks-page">
    <div class="container">
        <div class="row">
            <div class="thanks-inner">
                <div class="order-placed">
                    <img src="images/check-icon.png" alt="" />
                    <p>Your order has been placed</p>
                    <!-- <p><span>Total Saved Amount ₹<?php echo round($saving+$orderData->discount+$orderData->other_discount) ?> (<?php echo number_format((round($saving+$orderData->discount+$orderData->other_discount)*100)/$orderData->amount,1); ?>%)</span></p> -->
                    
                    <div class="thanx-pages">
                    	<!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 border-right-side">
                                                    <div class="new-thanx">
                                                        <p>Product Discount <br> ₹<?php echo round($saving) ?></p>
                                                    </div>
                                                </div> -->
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 border-right-side">
                        	<div class="new-thanx">
                            	<p>Coupon  Discount <br> ₹<?php echo number_format($OResult->discount,0) ?></p>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        	<div class="new-thanx">
                            	<p>Amount<br> ₹<?php echo number_format($OResult->total_amount,0) ?></p>
                            </div>
                        </div>
                    </div>
 
                    <div class="clr"></div> 
                </div>
                
                <div class="order-list">

                   <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-3">
                            <img src="images/map-icon.png" alt="" />
                        </div>
                        
                        <div class="col-md-10 col-sm-10 col-xs-9">
                            <p><h4>Free Delivery</h4></p>
                            <p>Address</p>
                            <p><?php echo $OResult->ship_address; ?></p>
                        </div>
                        <div class="clr"></div>                        
                    </div>

                    <div class="form-group">
                        <div class="col-md-2 col-sm-2 col-xs-3">
                            <img src="images/item-icon.png" alt="" />
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-9">
                            <span><?php echo $IResult." ".$Items; ?> (<?php echo $OrderId; ?> : <?php echo $OResult->orderno ?>)</span>
                            
                        </div>                        
                        <div class="clr"></div>
                    </div>
                    <div class="clr"></div> 
                </div>
                <!-- <div class="order-list">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a href="orderReciept">
                            <button class="btn btn-primary">View Order Reciept</button>
                        </a>
                    </div>      
                
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a href="my-order.php?order_id=<?php echo base64_encode(base64_encode($_SESSION['OrerID'])); ?>">
                            <button class="btn btn-primary">Check Order Status</button>
                        </a>    
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a href="index">
                            <button class="btn btn-primary">Continue Shopping</button>
                        </a>
                    </div>                    
                    <div class="clr"></div>
                </div> -->
                
                <div class="order-list text-center">
                    <div class="col-md-12">
         
                    </div>               
                    <div class="clr"></div>
                </div>
                
                <div class="clr"></div>
            </div>
        </div>
    </div>    
    <div class="clr"></div>
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

