<?php 
include("../../include/config.php");
include("../../include/functions.php"); 

$product_id=$_POST['product_id'];
$product_price_id=$_POST['product_price_id'];
$qty=$_POST['qty'];
$order_id=$_POST['order_id'];
$product_name = $obj->escapestring(getField('product_name',$tbl_product,$product_id));
$status = getField('in_stock',$tbl_productprice,$product_price_id);
$price = getField('sell_price',$tbl_productprice,$product_price_id);
if($status==1){
    $status=1;
}else{
    $status=0;
}

$pTotAmt = $qty*$price;

$OSql = $obj->query("select order_id,amount,discount,other_discount,shipping_amount,total_amount,ship_type,user_id,payment_status,payment_method from $tbl_order where id = '$order_id'");
$OResult = $obj->fetchNextObject($OSql);
$OAmount = $OResult->amount;

$walletAmount=getTotalWallet($OResult->user_id);

if($price!=0 && $OResult->payment_method=="cod" ){
    $obj->query("insert into $tbl_order_itmes set order_id='$order_id',product_id='$product_id',price_id='$product_price_id',product_name='$product_name',price='$price',qty='$qty',status='$status'",$debug=-1); //die;
   
    $ASql = $obj->query("select sum(price*qty) as tamt from $tbl_order_itmes where order_id='$order_id'");
    $AResult = $obj->fetchNextObject($ASql);
    $amount = $AResult->tamt;
    
    $minimumAmount = getField('minimum_purchase',$tbl_setting,1);
    
    if($OResult->ship_type=='Normal'){
        if($amount > $minimumAmount){
         $shipping_amount = 0;
        }else{
         $shipping_amount = getField('delivery_charge',$tbl_setting,1);
        }
    }else{
    $shipping_amount = getField('express_delivery_charge',$tbl_setting,1);
    }
    
    $total_amount = $amount + $OResult->discount + $OResult->other_discount + $shipping_amount;
    
     $obj->query("update $tbl_order set amount='$amount',total_amount='$total_amount',shipping_amount='$shipping_amount' where id='$order_id'");
     echo "1";
}else{
   if($walletAmount > $price){ 
        $obj->query("insert into $tbl_order_itmes set order_id='$order_id',product_id='$product_id',price_id='$product_price_id',product_name='$product_name',price='$price',qty='$qty',status='$status'",$debug=-1); //die;
   
    $ASql = $obj->query("select sum(price*qty) as tamt from $tbl_order_itmes where order_id='$order_id'");
    $AResult = $obj->fetchNextObject($ASql);
    $amount = $AResult->tamt;
    
    $minimumAmount = getField('minimum_purchase',$tbl_setting,1);
    
    if($OResult->ship_type=='Normal'){
        if($amount > $minimumAmount){
         $shipping_amount = 0;
        }else{
         $shipping_amount = getField('delivery_charge',$tbl_setting,1);
        }
    }else{
     $shipping_amount = getField('express_delivery_charge',$tbl_setting,1);
    }
    
    $total_amount = $amount + $OResult->discount + $OResult->other_discount + $shipping_amount;
    
     $obj->query("update $tbl_order set amount='$amount',total_amount='$total_amount',shipping_amount='$shipping_amount' where id='$order_id'");
     $obj->query("insert into $tbl_credit set t_type='Order',transection_code='".$OResult->order_id."',user_id='".$OResult->user_id."',user_via='".$_SESSION['sess_admin_id']."',credit_amount='$pTotAmt',type='Dr',
            added_date=now()",$debug=-1); //die;
     echo "1";
    }else{
        echo "2";
    }
}



     









?>



