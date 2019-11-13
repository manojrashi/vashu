<?php 
include("../../include/config.php");
include("../../include/functions.php"); 
$id = $_POST['id'];
$order_id = $_POST['order_id'];

$pArr = $obj->query("select (price*qty) as pTotAmt from $tbl_order_itmes where id='$id'");
$pResult = $obj->fetchNextObject($pArr);
$pTotAmt = $pResult->pTotAmt;


//Insert Record to another table start

$bArr = $obj->query("select * from $tbl_order_itmes where id='$id'");
$bResult = $obj->fetchNextObject($bArr);

$obj->query("insert into $tbl_del_order_itmes set order_id='".$bResult->order_id."',product_id='".$bResult->product_id."',price_id='".$bResult->price_id."',product_name='".$bResult->product_name."',price='".$bResult->price."',qty='".$bResult->qty."',pdate='".$bResult->cdate."',status='".$bResult->status."',sale_id='".$_SESSION['sess_admin_id']."'");
//Insert Record to another table end

$obj->query("delete from $tbl_order_itmes where id='$id'");

$OSql = $obj->query("select order_id,amount,discount,other_discount,shipping_amount,total_amount,ship_type,user_id,payment_method,payment_status from $tbl_order where id = '$order_id'");
$OResult = $obj->fetchNextObject($OSql);
$OAmount = $OResult->amount;

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

 if($amount!=0 && $OResult->payment_status==1 && ($OResult->payment_method=="wallet" || $OResult->payment_method=="payumoney" || $OResult->payment_method=="paytm")){
     $obj->query("insert into $tbl_credit set
        t_type='Order',
        transection_code='".$OResult->order_id."',
        user_id='".$OResult->user_id."',
        user_via='".$_SESSION['sess_admin_id']."',
        credit_amount='$pTotAmt',
        type='Cr',
        added_date=now()
        ",$debug=-1); //die;
}




?>

