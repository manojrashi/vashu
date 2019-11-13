<?php
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
 
 $cat_id=$_REQUEST['cat_id'];
 $brand_id=$_REQUEST['brand_id'];
 $var = "";
 $Sql = $obj->query("select id,product_name,vender_id,v_type from $tbl_vendor_product where cat_id='$cat_id' and brand_id='$brand_id' and status=1 and id not in (select product_id from $tbl_product where cat_id='$cat_id' and brand_id='$brand_id' and status=1)",$debug=-1);
 while($Result = $obj->fetchNextObject($Sql)){
 	if($Result->v_type==1){
 		$v_name = getField('vender_name',$tbl_vender,$Result->vender_id);
 	}else{
 		$v_name = getField('store_name',$tbl_store,$Result->vender_id);
 	}
 	$var .= '<option value="'.$Result->id.'">'.$Result->product_name.' - '.$v_name.'</otion>';
 }

 echo $var;