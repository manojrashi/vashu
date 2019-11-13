<?php
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
 
 $p_id=$_REQUEST['p_id'];

 $Sql = $obj->query("select size from $tbl_vendor_productprice where status=1 and product_id ='$p_id' order by id asc",$debug=-1);
 while($Result = $obj->fetchNextObject($Sql)){
 	$var .= '<option value="'.$Result->size.'">'.$Result->size.'</otion>';
 }

 $VSql = $obj->query("select v_type from $tbl_vendor_product where id='$p_id'");
 $VResult = $obj->fetchNextObject($VSql);

 echo $var."##".$VResult->v_type;