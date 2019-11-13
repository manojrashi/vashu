<?php 
include("../include/config.php");
include("../include/functions.php"); 

$q=mysql_real_escape_string($_REQUEST['q']);
?>

<link href="css/style.css" rel="stylesheet" type="text/css">
 <?php 
 $prodArr=$obj->query("select $tbl_product.*,$tbl_brand.brand,sell_price,product_id,size,pphoto,$tbl_productprice.id as ppid from  $tbl_product  left join  $tbl_brand on $tbl_brand.id= $tbl_product.brand_id join $tbl_productprice on  $tbl_productprice.product_id= $tbl_product.id where $tbl_product.status=1  and $tbl_productprice.status=1 and (product_name like '%".$q."%' or  brand like '%".$q."%' or size like '%".$q."%'  )  order by id desc  limit 0,20",$debug=-1);

 $number_of_rec=$obj->numRows($prodArr);
  
?>
<div id="serach_product">
<div class="search">
<div class="product-search">
<h4>
<?php if( $number_of_rec==0){?>
No Results found for "<?php echo $q; ?>\". 
<?php }else{ echo  $number_of_rec." records found for '".$q."' " ;}?>
</h4>
   <div class="scrollbar1" id="style-1">
      <div class="force-overflow">
<div class="product-list">
<ul>
<?php while($resultProduct=$obj->fetchNextObject($prodArr)){?>

<li>
                    
                    <a class="uiv2-img-product-search" href="<?php echo SITE_URL;?>pd/<?php echo $resultProduct->product_id; ?>/<?php echo buildURL($resultProduct->product_name); ?>" target="_blank"><?php if(is_file("../upload_images/product/thumb/".$resultProduct->pphoto)){ ?><img width="30" height="30" alt="" id="imgsearch_<?php echo $resultProduct->ppid; ?>" src="../upload_images/product/thumb/<?php echo $resultProduct->pphoto; ?>"><?php }else{ ?>
                    <img id="imgsearch_<?php echo $resultProduct->ppid; ?>" src="images/no-image.jpg" width="30" height="30" alt="">
                    <?php } ?>
                    </a>
                    
                    <a class="uiv2-img-product-name" href="<?php echo SITE_URL;?>pd/<?php echo $resultProduct->product_id; ?>/<?php echo buildURL($resultProduct->product_name); ?>"><?php echo getProductListingName($resultProduct->product_name); ?></a>
                    <div class="uiv2-product-weight"><span><?php echo stripslashes($resultProduct->size); ?></span></div><div class="uiv2-product-cost"><span><span class="WebRupee">Rs.</span> <?php echo number_format($resultProduct->sell_price,2); ?></span></div><div class="uiv2-rate-count-btn uiv2-search-qty-widget"><span class="uiv2-qty-label">Qty</span>
                    <input type="text" maxlength="" id="qtysearch_<?php echo $resultProduct->ppid;?>" readonly="readonly" value="1" /></div><div class="uiv2-product-add-btn">
                        <input type="hidden" maxlength="" id="searchprodname_<?php echo $resultProduct->ppid;?>" value="<?php echo $resultProduct->product_name; ?> <?php echo stripslashes($resultProduct->size); ?>" /></div><div class="uiv2-product-add-btn">
                        <input type="button" id="" onClick="return addToCartSearch(<?php echo $resultProduct->product_id;?>,<?php echo $resultProduct->ppid;?>);" value="ADD" class="uiv2-a2c-autosearch">
                        
                    </div></li>
                    <?php } ?>

                    
</ul>

</div>
</div>
</div>
</div>
</div>
</div>