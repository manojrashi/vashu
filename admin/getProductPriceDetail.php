<?php
include("../include/config.php");
include("../include/functions.php"); 

 $p_id=$_REQUEST['p_id'];
 $prod_id = $_REQUEST['prod_id'];

$Sql = $obj->query("select * from $tbl_vendor_productprice where product_id ='$prod_id' and size='$p_id'",$debug=-1); //die;


$var ="";
while($Result = $obj->fetchNextObject($Sql)){
$var .= "<option value='".$Result->unit_id."'>".getField('name',$tbl_unit,$Result->unit_id)."</option>";
}


$Sql1 = $obj->query("select * from $tbl_vendor_productprice where product_id ='$prod_id' and size='$p_id'",$debug=-1); //die;
$Result1 = $obj->fetchNextObject($Sql1);

echo $var."##".$Result1->mrp_price."##".$Result1->actual_price."##".$Result1->id;

?>