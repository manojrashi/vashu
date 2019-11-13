<?php
session_start();
include("../../include/config.php");
include("../../include/functions.php"); 
validate_admin();
$keyword = $_POST["keyword"];
if(!empty($_POST["keyword"])) {
  $sql1=$obj->query("select a.* from tbl_product as a inner join tbl_maincategory as b on a.cat_id=b.id inner join tbl_brand as c on a.brand_id=c.id where 1=1 and a.short_description like '%".$keyword."%' and a.status=1 and a.gift_box!=1  order by a.product_name LIMIT 0,50",$debug=-1);
      if($obj->numRows($sql1) > 0){ ?>
          
        <?php $i=1; 
        $_SESSION['search_all']='';
        while ($line=$obj->fetchNextObject($sql1)) { 
          if($i==1){
                  $cat_id=$line->cat_id;
                  $parrent=getMainParent($cat_id);
                  $slug=getParent_slug($parrent);
                   $_SESSION['search_all'] =$slug; 
              }
             $pSql = $obj->query("SELECT pr.id,pr.product_id,pr.size,pr.mrp_price,pr.discount,pr.sell_price,pr.pphoto,u.name  FROM tbl_productprice pr join tbl_unit as u on pr.unit_id=u.id WHERE pr.product_id='".$line->id."' ",$debug=-1);
             $item=$obj->fetchNextObject($pSql);
             $bsql=$obj->query("SELECT brand from tbl_brand where id=$line->brand_id",$debug=-1); 
             $brand=$obj->fetchNextObject($bsql);                      
          ?>                
                 <ul class="search-data-list">
                            <li>
                                <div class="pro-img">
                                  <?php  if(is_file("../../upload_images/product/tiny/".$item->pphoto)){?>
                                   <img src="../upload_images/product/tiny/<?php echo $item->pphoto; ?>" alt="<?php $line->product_name; ?>" title="<?php echo $line->product_name?>" />
                                    <?php }else{?>
                                    <img src="../images/No_image_available.jpg" alt="<?php $line->product_name; ?>" />
                                    <?php }?>
                                </div>
                                <div class="pro-name brand-name">
                                    <p><small><b><?php echo $brand->brand;?></b></small></p>
                                    <p><?php echo getProductListingName($line->product_name);?></p>
                                </div>
                                
                                <div class="pro-unit">
                                    <p><?php echo $item->size." ".$item->name; ?></p>
                                </div>
                                <div class="pro-price" >
                                    <p><?php echo "Rs.".$item->sell_price ?></p>
                                </div>
                                <div class="pro-qty">
                                    <div class="input-group input-group-sm qty-btn"><span class="input-group-addon" id="basic-addon1">Qty</span>
                                      <input  class="form-control" min="1" type="number" id="qty_<?php echo $item->id;?>" value="1" style="padding:0px 0px 0px 4px;">
                                    </div>
                                </div>

                                <div class="pro-add">
                                    <span class="btn btn-default yellow-btn"><a href="JavaScript:Void(0);" onClick="return addToCart(<?php echo $line->id.",".$item->id;?>);" class="">Add <img alt="image" src="images/checkout-small-bucket-icon.png"></a></span>
                                    <input type="hidden" value="<?php echo $item->id?>" id="prodPriceID_<?php echo $line->id;?>" name="prodPriceID">
                                    <input type="hidden" value="<?php echo stripslashes($line->product_name)?>" id="prodname_<?php echo $item->id;?>" >
                                    <input type="hidden" value="<?php echo stripslashes($item->sell_price)?>" id="price_<?php echo $item->id;?>" >
                                </div>                                
                            </li>                                                  
                        </ul>
 
        <?php  $i++; }?>      
  <?php }
  else
  {
    echo " <ul class='search-data-list'><li><div class='error' style='margin:20px;'> Sorry !! Such types of products are not available.</div></li></ul>";
  }
} 
?>
