<form name="leftsearchfrm"  id="leftsearchfrm" method="post" action="">
  <input type="hidden" name="pname" value="<?php echo $_REQUEST['pname']; ?>" />
  <input type="hidden" name="cat_id" value="<?php echo $_REQUEST['cat_id']; ?>" />
  <input type="hidden" name="subcat_id" value="<?php echo $_REQUEST['subcat_id']; ?>" />
  <input type="hidden" name="brand_id" value="<?php echo $_REQUEST['brand_id']; ?>" />
  <input type="hidden" name="page" id="mypage" value="1" />
  <input type="hidden" name="dosorting" id="dosorting" value="1" />

  <?php
  $searchingWhere="";
  if($_REQUEST['pname']!=''){
      $searchingWhere.=" and a.product_name like '%".$_REQUEST['pname']."%'"; 
  }
  if($_REQUEST['cat_id']!=''){
      $searchingWhere.=" and a.cat_id  = '".$_REQUEST['cat_id']."'"; 
  }
  if($_REQUEST['subcat_id']!=''){
      $searchingWhere.=" and a.subcat_id = '".$_REQUEST['subcat_id']."'"; 
  }
  if($_REQUEST['brand_id']!=''){
      $searchingWhere.=" and a.brand_id = '".$_REQUEST['brand_id']."'"; 
  }

  $prodsearchAllArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id  where 1=1 $searchingWhere and a.status=1 group by a.id order by b.id asc",$debug=-1);

  $total_pages=$obj->numRows($prodsearchAllArr);
  $start=0;
  $limit=12;
  include("listing-pagination.php");

  $prodsearchArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id where 1=1 $searchingWhere and a.status=1 group by a.id order by b.id asc limit  $start,$limit",$debug=-1);
  ?>

  <div class="col-xs-12 col-sm-3">
    <div class="quantity-main">
      <p style=" margin-bottom:10px; "><?php echo $AdvanceSearch; ?></p>
      <h2><?php echo $Category; ?></h2>
  <?php
  $cat_id=$_REQUEST['cat_id'];
  $subcat_id=$_REQUEST['subcat_id']; //die;
  $brand_id=$_REQUEST['brand_id'];
  $sql=$obj->query("select * from tbl_subcategory where cat_id='$cat_id'",-1);
 while ($catresult=$obj->fetchNextObject($sql)) {  
  ?>
  <p> <a href="listing.php?cat_id=<?php echo $catresult->cat_id;?>&subcat_id=<?php echo $catresult->id;?>">
    <?php 
    echo $catresult->subcategory;
    ?></a></p>
  <?php } ?>

<?php ############################################# Price Counter ##########################
$pricerec='';

$twentyArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id where 1=1 $searchingWhere and (b.sell_price between 0 and 20) and a.status=1 ",$debug=-1);


$twrec = $obj->numRows($twentyArr);
if($twrec>0){

  $pricerec=$pricerec+$twrec; 

}

$fiftyArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id where 1=1 $searchingWhere and (b.sell_price between 21 and 50) and a.status=1 ",$debug=-1);

$fiftyrec=$obj->numRows($fiftyArr);
if($obj->numRows($fiftyArr)>0){

  $pricerec=$pricerec+$fiftyrec;  

}

$hunArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id where 1=1 $searchingWhere and (b.sell_price between 51 and 100) and a.status=1  ",$debug=-1);

$hunrec=$obj->numRows($hunArr);
if($hunrec>0){

  $pricerec=$pricerec+$hunrec;  

}

$twhunArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id where 1=1 $searchingWhere and (b.sell_price between 101 and 200) and a.status=1 ",$debug=-1);

$twhunrec = $obj->numRows($twhunArr);
if($twhunrec>0){

  $pricerec=$pricerec+$twhunrec;  

}

$fivehunArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id where 1=1 $searchingWhere and (b.sell_price between 201 and 500) and a.status=1 ",$debug=-1);

$fivehunrec = $obj->numRows($fivehunArr);
if($fivehunrec>0){

  $pricerec=$pricerec+$fivehunrec;  

}

$morefivehunArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id where 1=1 $searchingWhere and (b.sell_price between 501 and 50000000) and a.status=1  ",$debug=-1);

$morefivehunrec = $obj->numRows($morefivehunArr);
if($morefivehunrec>0){
  $pricerec=$pricerec+$morefivehunrec;  
}
?>  
<?php if($pricerec!=''){ ?> 
  <div class="cateBox">
    <h2 style="margin-top:30px;">Price</h3>
    <ul class="cateItem withoutArw">
      <?php if($twrec>0){ ?>
        <li>
          <input type="checkbox"  value="0-20"  onclick="return doListingSearch()" name="searchprice[]">
          <label for=""><a href="javascript:void(0)">less than rs 20 (<?php echo $twrec; ?>)</a> </label>
        </li>
      <?php } ?>
      <?php if($fiftyrec>0){ ?>
        <li>
          <input type="checkbox" value="21-50" onclick="return doListingSearch()" name="searchprice[]">
          <label for=""><a href="javascript:void(0)"><?php echo $website_currency_symbol ?> 21 to <?php echo $website_currency_symbol ?> 50 (<?php echo $fiftyrec;?>)</a> </label>
        </li>
      <?php } ?>
      <?php if($hunrec>0){ ?>
        <li>
          <input type="checkbox" value="51-100" onclick="return doListingSearch()"  name="searchprice[]">
          <label for=""><a href="javascript:void(0)"><?php echo $website_currency_symbol ?> 51 to <?php echo $website_currency_symbol ?> 100 (<?php echo $hunrec; ?>)</a> </label>
        </li>
      <?php } ?>
      <?php if($twhunrec>0){?>
        <li>
          <input type="checkbox" value="101-200" onclick="return doListingSearch()" name="searchprice[]">
          <label for=""><a href="javascript:void(0)"><?php echo $website_currency_symbol ?> 101 to <?php echo $website_currency_symbol ?> 200 (<?php echo $twhunrec; ?>)</a> </label>
        </li>
      <?php } ?>
      <?php if($fivehunrec>0){?>
        <li>
          <input type="checkbox" value="201-500" onclick="return doListingSearch()" name="searchprice[]">
          <label for=""><a href="javascript:void(0)"><?php echo $website_currency_symbol ?> 201 to <?php echo $website_currency_symbol ?> 500 (<?php echo $fivehunrec; ?>)</a> </label>
        </li>
      <?php } ?>
      <?php if($morefivehunrec>0){?>
        <li>
          <input type="checkbox" value="501-5000000000"  onclick="return doListingSearch()" name="searchprice[]">
          <label for=""><a href="javascript:void(0)"><?php echo $Morethan; ?> <?php echo $website_currency_symbol ?> 500 (<?php echo $morefivehunrec; ?>)</a> </label>
        </li>
      <?php } ?>
    </ul>
  </div>
<?php }?>
    </div>
  </div>

</form>