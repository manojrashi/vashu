<?php
/* Database connection start */
include("../include/config.php");
include("../include/functions.php"); 

$salary=100;
for ($i=1; $i <=10000 ; $i++) { 

$salary=$salary+100;	
$sql = "insert into tbl_product (product_name, product_code,cat_id) VALUES('arun',$salary,'1')";

$obj->query($sql);

}
?>
