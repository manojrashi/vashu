<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$sql=$obj->query("select product_id from $tbl_wishlist where user_id='".$_SESSION['user_id']."'",$debug=-1);
while($rows=$obj->fetchNextObject($sql)){
  $result[]=$rows->product_id;
}

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("head.php"); ?>
</head>
<body>
  <?php include("header.inc.php"); ?>
  <section id="slider">
    <div class="container">
      <div class="col-xs-12 col-sm-12 sliderbar">
        <div class="col-xs-12 col-sm-3 gifts">
          <ul>
            <?php
            $catSql = $obj->query("select * from $tbl_category where status=1");
            while($catResult = $obj->fetchNextObject($catSql)){?>
              <li>
                <a href="listing.php?pname=&cat_id=<?php echo $catResult->id;?>&subcat_id=&brand_id="><?php echo $catResult->category;  ?></a>
                <i class="fa fa-angle-right" aria-hidden="true"></i></li>
            <?php }?>
          </ul>


          
        </div>
        <div class="col-xs-12 col-sm-9">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <?php 
              $bannerSql = $obj->query("select * from $tbl_banner where status=1",$debug=-1);
              $i=1;
              while($bannerResult=$obj->fetchNextObject($bannerSql)){ 
                if(is_file("upload_images/banner/big/".$bannerResult->photo)){?>
                  <div class="item <?php if($i==1){?> active <?php }?>"> <img src="upload_images/banner/big/<?php echo $bannerResult->photo; ?>">
                    <div class="carousel-caption">
                      <h3></h3>
                      <p></p>
                      <a href="<?php echo $bannerResult->target_url; ?>">Buy Now</a> </div>
                    </div>
                    <?php $i++; } } ?>   
                  </div>

                  <!-- Left and right controls --> 
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#myCarousel" data-slide="next"> <i class="fa fa-angle-right" aria-hidden="true"></i> <span class="sr-only">Next</span> </a> </div>
                </div>
              </div>
            </div>
          </section>
          <section id="customersmain">
            <div class="container">
              <div class="col-xs-12 col-sm-12">
                <h2>Best Seller</h2>
                <div id="demos">
                  <div class="owl-carousel owl-theme">
                    <?php
                    $Psql = $obj->query("select * from $tbl_product where status=1 and best_seller=1");
                    while($PResult = $obj->fetchNextObject($Psql)){
                      $PrSql = $obj->query("select * from $tbl_productprice where product_id='".$PResult->id."' order by id asc limit 0,1");
                      $PrResult = $obj->fetchNextObject($PrSql);
                      $pid=$PrResult->product_id;
                      ?>
                      <div class="item">
                        <div class="similiar-product">
                          <figure><img src="upload_images/product/thumb/<?php echo $PrResult->pphoto; ?>" class="img-responsive" style="width: 174px; height: 154"></figure>
                          <h3><a href="details/<?php echo $PResult->slug; ?>" style="text-decoration: none;">
                            <?php 
                            echo $PResult->product_name; 
                            ?>
                          </a></h3>
                          <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> 02
                          <p><?php echo $website_currency_symbol; ?> <?php echo $PrResult->sell_price; ?></p>
                          <div class="hovermain">
                            <ul>
                            <a href="javascript:void(0)" data-one="<?php echo $PResult->id; ?>" data-two="<?php echo $PrResult->id; ?>" class="procart-btn add-to-cart" title="Add to Cart">
                            <img src="images/bag.jpg">
                            </a>
                            <a href="details/<?php echo $PResult->slug; ?>" title="View Details">
                            <img src="images/eye.jpg"></a> 
                            <?php if($_SESSION['user_id']){  ?>
                            <a title="Add to Wishlist" onclick="addWishlist(<?php echo $PResult->id; ?>)"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            <?php } else { ?>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            <?php } ?>
                            </ul>

                            </div>
                            <p id="addedprod<?php echo $PResult->id; ?>" style="color: green; font-size: 14px;"></p>
                          </div>
                        </div>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section id="customersmain">
              <div class="container">
                <div class="col-xs-12 col-sm-12">
                  <h2>Discount % </h2>
                  <div id="demos">
                    <div class="owl-carousel owl-theme">
                      <?php
                  $Psql = $obj->query("select a.id as pid,a.product_name,a.slug,b.id as prid, b.pphoto,b.sell_price,b.discount from $tbl_product as a inner join $tbl_productprice as b on a.id=b.product_id where a.status=1 and b.discount is not null and b.discount!='0.00' group by a.id order by b.id asc",$debug=-1); //die;
                  while($PResult = $obj->fetchNextObject($Psql)){
                  $pid=$PResult->pid;
                  ?>
                  <div class="item">
                  <div class="similiar-product"> <span><?php echo number_format($PResult->discount,0); ?>%</span>
                  <figure><img src="upload_images/product/thumb/<?php echo $PResult->pphoto; ?>" class="img-responsive" style="width: 174px; height: 154"></figure>
                  <h3><a href="details/<?php echo $PResult->slug; ?>" style="text-decoration: none;">
                  <?php 
                  echo $PResult->product_name;
                  ?>
                  </a></h3>
      <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> 02
      <p><?php echo $website_currency_symbol; ?> <?php echo $PResult->sell_price; ?></p>
      <div class="hovermain">
        <ul>
          <a href="javascript:void(0)" data-one="<?php echo $PResult->pid; ?>" data-two="<?php echo $PResult->prid; ?>" class="procart-btn add-to-cart" title="Add to Cart">
            <img src="images/bag.jpg"> 
          </a>
          <a href="details/<?php echo $PResult->slug; ?>" title="View Deails">
            <img src="images/eye.jpg">
          </a>
          <?php if($_SESSION['user_id']){  ?>
            <a title="Add to Wishlist" onclick="addWishlist(<?php echo $PResult->pid; ?>)"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
          <?php } else { ?>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
          <?php } ?>
        </ul>
      </div>
      <p id="addedprod<?php echo $PResult->pid; ?>" style="color: green; font-size: 14px;"></p>
    </div>
  </div>
<?php }?>

</div>
</div>
</div>
</div>
</section>
<section id="Headphones">
  <div class="container">
    <div class="col-xs-12 col-sm-12"><img src="images/headphone.png" class="img-responsive">
      <div class="col-xs-12 col-sm-4">
        <h2><?php 
        echo getField('title',$tbl_fiesta_banner,1);
        ?>
          
        </h2>
        <p><?php 
        echo getField('short_description',$tbl_fiesta_banner,1);
        ?>
          
        </p>
      </div>
      <div class="col-xs-12 col-sm-4 center">
        <h2>$260.50</h2>
        <a href="<?php echo getField('target_url',$tbl_fiesta_banner,1);?>">View Detail</a> </div>
        <div class="col-xs-12 col-sm-4"></div>
      </div>
    </div>
  </section>
  <section id="customersmain2">
    <div class="container">
      <div class="col-xs-12 col-sm-12">
        <h2>Home Electronics</h2>
        <div id="demos">
          <div class="owl-carousel owl-theme">

            <?php
            $Psql = $obj->query("select * from $tbl_product where status=1 and home=1");
            $PResult="";
            while($PResult = $obj->fetchNextObject($Psql)){
              $PrSql = $obj->query("select * from $tbl_productprice where product_id='".$PResult->id."' order by id asc limit 0,1");
              $PrResult = $obj->fetchNextObject($PrSql);
              $pid=$PrResult->product_id;
              ?>
              <div class="item">
                <div class="similiar-product">
                  <figure><img src="upload_images/product/thumb/<?php echo $PrResult->pphoto; ?>" class="img-responsive" style="width: 174px; height: 154"></figure>
                  <h3><a href="details/<?php echo $PResult->slug; ?>" style="text-decoration: none;">
                    <?php 
                    echo $PResult->product_name; 
                    ?>
                  </a></h3>
                  <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> 02
                  <p><?php echo $website_currency_symbol; ?> <?php echo $PrResult->sell_price; ?></p>
                  <div class="hovermain">
                    <ul>
                      <a href="javascript:void(0)" data-one="<?php echo $PResult->id; ?>" data-two="<?php echo $PrResult->id; ?>" class="procart-btn add-to-cart" title="Add to Cart">
                        <img src="images/bag.jpg">
                      </a>
                      <a href="details/<?php echo $PResult->slug; ?>">
                        <img src="images/eye.jpg" title="View Details"></a> 
                        <?php if($_SESSION['user_id']){  ?>
                          <a title="Add to Wishlist" onclick="addWishlist(<?php echo $PResult->id; ?>)"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        <?php } else { ?>
                          <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        <?php } ?>
                      </ul>
                    </div>
                    <!-- <p id="addedprod<?php echo $PResult->id; ?>" style="color: green; font-size: 14px;"></p> -->
                  </div>
                </div>
              <?php }?>
          </div>
          </div>
        </div>
      </div>
    </section>
    <section id="news">
      <div class="container">
        <div class="col-xs-12 col-sm-12">
          <h2><?php echo $news; ?></h2>
        </div>
        <?php
        $newsSql = $obj->query("select * from $tbl_news where status=1",$debug=-1);
        while($newsResult = $obj->fetchNextObject($newsSql)){?>
          <div class="col-xs-12 col-sm-4">
            <a href="news/<?php echo $newsResult->slug; ?>">
              <img src="upload_images/news/thumb/<?php echo $newsResult->photo;  ?>" class="img-responsive">
            </a>
            
              <p><a href="news/<?php echo $newsResult->slug; ?>" style="text-decoration: none;"><strong><?php echo $newsResult->title; ?></strong></a></p>
              <h3><?php echo substr($newsResult->content,0,200);  ?></h3>
           
          </div>
        <?php }?>
      </div>
    </section>
    <?php include("footer.inc.php"); ?>
    <style type="text/css">
    .error{color: red;}
  </style>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#regfrm").validate();
// $("#loginfrm").validate();

$(".dropdown").hover(            
  function() {
    $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
    $(this).toggleClass('open');        
  },
  function() {
    $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
    $(this).toggleClass('open');       
  }
  );
});
</script> 
<script>
  $(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
      margin: 20,
      nav: true,
      navText: ["", ""],
      loop: true,
      responsive: {
        0: {
          items: 2
        },
        600: {
          items:5
        },
        1000: {
          items:5
        }
      }
    })


    var owl = $('.owl-carousel_one');
    owl.owlCarousel({
      margin: 20,
      nav: true,
      navText: ["", ""],
      loop: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    })

  })
</script> 
<script src="js/jquery.bxslider.js"></script>

</body>
</html>

