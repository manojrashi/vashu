<?php 
include("wfcart.php");
include("include/config.php");
include("include/functions.php"); 


$sql=$obj->query("select product_id from $tbl_wishlist where user_id='".$_SESSION['user_id']."'",$debug=-1);
while($rows=$obj->fetchNextObject($sql)){
  $result[]=$rows->product_id;
}

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();


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

 ##################### Search By Price #######################
 $pArr='';
 $totalp=count($_REQUEST['searchprice']);
 if(count($_REQUEST['searchprice'])>0){
    $searchingWhere.=" and ( ";
    $i=1;
    foreach($_REQUEST['searchprice'] as $key=>$val){

      $pp=explode("-",$val);

    $searchingWhere.="  b.sell_price between $pp[0] and $pp[1] ";

    if($i!=$totalp){

    $searchingWhere.=" or ";    

    }

   $i++;

   }

   $searchingWhere.=" ) ";

 }


$prodsearchAllArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id  where 1=1 $searchingWhere and a.status=1 group by a.id order by b.id asc",$debug=-1);

$total_pages=$obj->numRows($prodsearchAllArr);
$start=0;
$limit=12;
include("listing-pagination.php");

$prodsearchArr=$obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid,b.pphoto,b.sell_price from $tbl_product as a LEFT JOIN  $tbl_productprice  as b ON a.id=b.product_id LEFT JOIN $tbl_brand as c on c.id=a.brand_id where 1=1 $searchingWhere and a.status=1 group by a.id order by b.id asc limit  $start,$limit",$debug=-1);

$number_of_rec=$obj->numRows($prodsearchArr);

?>

<div>
  <input type="hidden" name="" id="search_rs_qty" value="<?php echo $total_pages; ?>" />
  <?php if($total_pages>0){ ?>
    <div class="list">
      <p>Showing <?php echo $start+1; ?> -
        <?php if($limit>$total_pages){ echo $total_pages;}else{ echo ($start+1)*$limit; }?>
        of <?php echo $total_pages; ?> products</p>
        <?php echo $pagination; ?>

      </div>
    <?php } ?>
    <div class="col-xs-12 col-sm-12">
      <div class="row">
        <?php while($resultProduct=$obj->fetchNextObject($prodsearchArr)){?> 
          <div class="col-xs-12 col-sm-3">
            <div class="item">
              <div class="similiar-product">
                <figure><img src="upload_images/product/thumb/<?php echo $resultProduct->pphoto; ?>" class="img-responsive" style="width: 174px; height: 154"></figure>
                <h3><a href="details/<?php echo $resultProduct->slug; ?>" style="text-decoration: none;">
                    <?php 
                     echo $resultProduct->product_name; 
                    ?>
                  </a></h3>
                <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> 02
                <p><?php echo $website_currency_symbol; ?> <?php echo $resultProduct->sell_price; ?></p>
                <div class="hovermain">
                  <ul>
                    <a href="javascript:void(0)" data-one="<?php echo $resultProduct->pid; ?>" data-two="<?php echo $resultProduct->prid; ?>" class="procart-btn add-to-cart">
                      <img src="images/bag.jpg">
                    </a>
                    <a href="details/<?php echo $resultProduct->slug; ?>">
                      <img src="images/eye.jpg"></a> 
                      <?php if($_SESSION['user_id']){  ?>
                              <a title="Add to Wishlist" onclick="addWishlist(<?php echo $resultProduct->pid; ?>)"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                              <?php } else { ?>
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                              <?php } ?>
                    </ul>
                    <!-- <div class="buynow-center"> <a href="javascript:void(0)" data-one="<?php echo $resultProduct->pid; ?>" data-two="<?php echo $resultProduct->prid; ?>" class="procart-btn add-to-cart">Buy Now</a> </div> -->
                  </div>
                  <p id="addedprod<?php echo $resultProduct->pid; ?>" style="color: green; font-size: 14px;"></p>
                </div>
              </div>

            </div>
          <?php }?>  
          <div class="col-xs-12 col-sm-12" id="click-page">
            <div class="col-xs-12 col-sm-12">
              <?php if($total_pages>0){ ?>
                <div class="list">
                  <p>Showing <?php echo $start+1; ?> -
                    <?php if($limit>$total_pages){ echo $total_pages;}else{ echo ($start+1)*$limit; }?>
                    of <?php echo $total_pages; ?> products</p>
                    <?php echo $pagination; ?>

                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>


  <script type="text/javascript">
              $('.watchlist').click(function(){
                var prop_id=$(this).data('one');
                var dataString={prop_id:prop_id};
                $.ajax({
                  type: "POST",
                  url: "add-watchlist.php",
                  data: dataString,
                  cache: false,
                  success: function(response){
                    if(response=='1'){
                   
                    $('#set_star_'+prop_id+' i').removeClass('fa-heart-o');
                      $('#set_star_'+prop_id+' i').addClass('fa-heart');
                    }else{
                     $('#set_star_'+prop_id+' i').removeClass('fa-heart');
                      $('#set_star_'+prop_id+' i').addClass('fa-heart-o');
                    }
                    $('#set_msg').show();
                    setTimeout(function(){

                      $('#set_msg').addClass('slideOutRight animated');
                      setTimeout(function(){
                        $('#set_msg').removeClass('slideOutRight animated');
                        $('#set_msg').addClass('slideIntRight animated');
                        $('#set_msg').hide();

                      }, 2000);

                    }, 1500);

                  }
                });

              });
            </script>

