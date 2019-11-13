<?php 
include("../include/config.php");
include("../include/functions.php"); 
$q=mysql_real_escape_string($_REQUEST['q']);
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";
*/?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
 $searchingWhere='';

 if($_REQUEST['q']!=''){
	 $searchingWhere.=" and ( brand like '".$_REQUEST['q']."%' or product_name like  '".$_REQUEST['q']."%' or size like  '".$_REQUEST['q']."%'  ) "; 
 }
 $order_by=" $tbl_product.id ";
 $order_by2=" desc ";
 
 
 $prodsearchAllArr=$obj->query("select $tbl_product.*,product_id,size,brand from $tbl_product left join $tbl_brand on $tbl_brand.id=$tbl_product.brand_id left join $tbl_productprice on $tbl_productprice.product_id=$tbl_product.id where 1=1 $searchingWhere  and $tbl_product.status=1 group by product_id order by $order_by $order_by2 ",$debug=-1);
 $total_pages=$obj->numRows($prodsearchAllArr);
 $start=0;
 $limit=40;

$prodsearchArr=$obj->query("select $tbl_product.*,product_id,size,brand from $tbl_product left join $tbl_brand on $tbl_brand.id=$tbl_product.brand_id left join $tbl_productprice on $tbl_productprice.product_id=$tbl_product.id where 1=1 $searchingWhere  and $tbl_product.status=1 group by product_id order by $order_by $order_by2  limit  $start,$limit",$debug=-1);
  $number_of_rec=$obj->numRows($prodArr);
  ?>
<div>
  <?php  $i=1;
  while($resultProduct=$obj->fetchNextObject($prodsearchArr)){
	    $already=0;  
	  $prodArr=$obj->query("select id from $tbl_specialcatproduct where spcat_id='".$_REQUEST['spcat_id']."' and prod_id='".$resultProduct->id."' ");
	  if($obj->numRows($prodArr)>0){
		$already=1;  
		}
	  ?>
  
  
  <div class="innerlist-products" style="width:20% ; height:260px; float:left;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php if(is_file("../upload_images/product/thumb/".$resultProduct->photo)){ ?><img src="../upload_images/product/thumb/<?php echo $resultProduct->photo; ?>" id="img_<?php echo $resultProduct->id; ?>" alt=""><?php }else{ ?><img src="../images/no-img.jpg" id="img_<?php echo $resultProduct->id; ?>" alt=""><?php } ?></td>
  </tr>
  <tr>
    <td height="40"> <h3><span><?php echo stripslashes($resultProduct->brand); ?></span><br/><?php echo getProductListingName($resultProduct->product_name); ?></h3></td>
  </tr>
  <tr>
    <td> <input type="checkbox" name="prod[]"  value="<?php echo $resultProduct->product_id; ?>"  <?php if($already==1){?>checked<?php } ?> onclick="return addProduct(<?php echo $resultProduct->product_id; ?>,<?php echo $_REQUEST['spcat_id']; ?>,this.checked);"/></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
</table> 
  </div>
  <?php if($i%4==0){ ?>
   <div style="clear:both;"><hr /></div>
  <?php } $i++; } ?>  
  </div>