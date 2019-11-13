<?php
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
 
 $p_id=$_REQUEST['p_id'];
 $prod_id = $_REQUEST['prod_id'];

$Sql = $obj->query("select * from $tbl_vendor_productprice where product_id ='$prod_id' and size='$p_id'",$debug=-1);
$Result = $obj->fetchNextObject($Sql);

$SqlA = $obj->query("select last_price from $tbl_order_prodcut where product_id ='$prod_id' and size='$p_id' order by id desc limit 0,1",$debug=-1);
$ResultA = $obj->fetchNextObject($SqlA);


if($ResultA->last_price!=''){
    $last_price = $ResultA->last_price;
}else{
    $last_price = $Result->actual_price;
}


echo getField('name',$tbl_unit,$Result->unit_id)."##".$Result->mrp_price."##".$Result->actual_price."##".$Result->unit_id."##".$Result->id."##".$last_price;