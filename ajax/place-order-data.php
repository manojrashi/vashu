<?php
include("../wfcart.php");
include('../include/config.php');
include("../include/functions.php");

include("../FCM-User.php");
$fcmuser = new FCMUSER ();

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

$itmes=$cart->get_contents();
$no_of_itmes=count($itmes);

$userid = $_POST["userid"];
$userAddId = $_POST["userAddId"];
$payment_type = $_POST["payment_type"];


$sql=$obj->query("select * from $tbl_user where id='".$userid."'",$debug=-1);
$userData=$obj->fetchNextObject($sql);

$sql1=$obj->query("select address from $tbl_useraddress where id='".$userAddId."' and user_id='".$userid."'",$debug=-1); //die;
$userAddressData=$obj->fetchNextObject($sql1);

$cSql = $obj->query("select sum(qty*price) as totalAmount from $tbl_cart where cart_type='".$userBasketType."' and user_id='".$userid."' ",$debug=-1);
$cData=$obj->fetchNextObject($cSql);


$otherDiscount=$_SESSION['discount_amount'];
$discount=$_SESSION['couponDiscountAmount'];
$couponCode=$_SESSION['couponCode'];


$amount=(($cart->total-$discount)-$otherDiscount)+$deliveryCharges;
$ip=$_SERVER['REMOTE_ADDR'];

if($payment_type=="payumoney") {
      $payment_status="0";   
}
else if($payment_type=="cod") {
     $payment_status="0";          
}else if($payment_type=="paypal") {
     $payment_status="0"; 
}     

$OSql = "";

if($userid!=''){
  $OSql .= ", user_id='$userid'";
}
if($cart->total!=''){
  $OSql .= ", amount='$cart->total'";
}
if($discount!=''){
  $OSql .= ", discount='$discount'";
}
if($deliveryCharges!=''){
  $OSql .= ", shipping_amount='$deliveryCharges'";
}
if($otherDiscount!=''){
  $OSql .= ", other_discount='$otherDiscount'";
}
if($payment_type!=''){
  $OSql .= ", payment_method='$payment_type'";
}
if($amount!=''){
  $OSql .= ", total_amount='$amount'";
}
if($couponCode!=''){
  $OSql .= ", coupon_code='$couponCode'";
}
if($userData->name!=''){
  $OSql .= ", ship_address='$userAddressData->address'";
}
if($payment_status!=''){
  $OSql .= ", payment_status='$payment_status'";
}
if($ip!=''){
  $OSql .= ", ip='$ip'";
}
$order_date = date('Y-m-d H:i');
$obj->query("insert into $tbl_order set $OSql,order_date='$order_date' ",$debug=-1); //die;


$lastId=$obj->lastInsertedId();

$_SESSION['OrerID']=$lastId;



$mSql = $obj->query("select c.*,a.product_name,b.pphoto,b.size,u.name from tbl_cart as c JOIN tbl_product as a ON c.product_id=a.id join tbl_productprice as b on c.size_id=b.id join tbl_unit as u on b.unit_id=u.id where c.cart_type='".$userBasketType."' and c.user_id='".$userid."'",$debug=-1);

$outStockProd=0;
foreach ($itmes as $key => $value) {

      $pSql = $obj->query("select * from $tbl_productprice where product_id='".$value['prodId']."' ",$debug=-1);
      $pResult = $obj->fetchNextObject($pSql);


      //$pname= $value['info'];
      $pname= getField('product_name',$tbl_product,$value['prodId']);
      $pid=$value['prodId'];
      $id=$value['id'];
      $price=$value['price']; 
      $qty=$value['qty'];
      


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
 

$_SESSION['mythanks']=1;
unset($_SESSION['couponDiscountAmount']);
unset($_SESSION['couponstatus']);
unset($_SESSION['couponDiscountMsg']);
unset($_SESSION['couponCode']);
unset($_SESSION['discount_amount']);

$cart->empty_cart();

?>