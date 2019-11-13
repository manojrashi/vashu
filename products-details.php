<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

$sql=$obj->query("select product_id from $tbl_wishlist where user_id='".$_SESSION['user_id']."'",$debug=-1);
while($rows=$obj->fetchNextObject($sql)){
  $result[]=$rows->product_id;
}

$pSql = $obj->query("select * from $tbl_product where slug='".$_REQUEST['slug']."'");
$pResult = $obj->fetchNextObject($pSql);
$pid=$pResult->id;

$prSql = $obj->query("select id,pphoto,sell_price from $tbl_productprice where product_id='".$pResult->id."' order by id asc limit 0,1",$debu=-1);
$prResult = $obj->fetchNextObject($prSql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include("head.php"); ?>
</head>
<body>
  <?php include("header.inc.php"); ?>

  <section id="products-detailsmain">

    <div class="container item">
      <div class="col-xs-12 col-sm-6">
        <div class="xzoom-container">
          <figure><img class="xzoom img-responsive" id="xzoom-default" src="upload_images/product/big/<?php echo $prResult->pphoto ?>" xoriginal="upload_images/product/big/<?php echo $prResult->pphoto ?>" width="500"/></figure>
          <div class="xzoom-thumbs">
            <a href="upload_images/product/thumb/<?php echo $prResult->pphoto ?>"><img class="xzoom-gallery" width="80" src="upload_images/product/thumb/<?php echo $prResult->pphoto ?>"  xpreview="upload_images/product/thumb/<?php echo $prResult->pphoto ?>"></a>

          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 prodetails">
        <h2><?php 
        echo $pResult->product_name;
        ?></h2>
        <small>$ <?php echo $prResult->sell_price ?></small>
        <p><?php 
        echo $pResult->short_description; 
        ?></p>
        <div class="col-xs-12 col-sm-12 padding-0">
          <div class="center">

            <h2>Quantity</h2>
            <div class="input-group"> <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]"> <span class="glyphicon glyphicon-minus"></span> </button>
            </span>
            <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" id="qty_<?php echo stripslashes($prResult->id); ?>">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]"> <span class="glyphicon glyphicon-plus"></span> </button>
            </span> </div>
          </div>

        </div>
       <span><a href="javascript:void(0)" data-one="<?php echo $pResult->id; ?>" data-two="<?php echo $prResult->id; ?>" class="add-to-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></span> <span>

        <!-- <a href="javascript:void(0)" data-one="<?php echo $pResult->id; ?>" data-two="<?php echo $prResult->id; ?>" class="procart-btn add-to-cart">
                                <img src="images/bag.jpg">
                              </a> -->


          <?php if($_SESSION['user_id']){  ?>
            <a title="Add to Wishlist" onclick="addWishlist(<?php echo $pid; ?>)"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
          <?php } else { ?>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" title="Add to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
          <?php } ?>

        </span> 

        <span><a href="javascript:void(0)" class="procart-btn add-to-cart" onClick="return addToCart(<?php echo $pResult->id; ?>,<?php echo $prResult->id; ?>)">Buy Now</a></span> </div>
        <p id="addedprod<?php echo $pid; ?>" style="color: green; font-size: 14px;"></p>


        <div class="col-xs-12 col-sm-12 margin-top-50">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#description">Description</a></li>
            <!--  <li><a data-toggle="tab" href="#reviews">Reviews (0)</a></li> -->
            <!--  <li><a data-toggle="tab" href="#specifications">Specifications</a></li> -->
          </ul>

          <div class="tab-content">
            <div id="description" class="tab-pane fade in active">
              <h3><?php echo $Description; ?></h3>
              <?php 
              echo $pResult->description; 
              ?>
            </div>
            <!-- <div id="reviews" class="tab-pane fade">
              <h3>Title</h3>
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum'
                will uncover many web sites still in their infancy
                <span>Tara 15-10-2018</span>
              </p>
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum'
                will uncover many web sites still in their infancy
                <span>Tara 15-10-2018</span>
              </p>
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum'
                will uncover many web sites still in their infancy
                <span>Tara 15-10-2018</span>
              </p>
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum'
                will uncover many web sites still in their infancy
                <span>Tara 15-10-2018</span>
              </p>
            </div> -->

          </div>

        </div>

      </div>
    </section>
    <?php include("footer.inc.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/owl.carousel.js"></script> 

    <script src="js/jquery.bxslider.js"></script> 
    <script>
//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
  e.preventDefault();

  fieldName = $(this).attr('data-field');
  type      = $(this).attr('data-type');
  var input = $("input[name='"+fieldName+"']");
  var currentVal = parseInt(input.val());
  if (!isNaN(currentVal)) {
    if(type == 'minus') {

      if(currentVal > input.attr('min')) {
        input.val(currentVal - 1).change();
      } 
      if(parseInt(input.val()) == input.attr('min')) {
        $(this).attr('disabled', true);
      }

    } else if(type == 'plus') {

      if(currentVal < input.attr('max')) {
        input.val(currentVal + 1).change();
      }
      if(parseInt(input.val()) == input.attr('max')) {
        $(this).attr('disabled', true);
      }

    }
  } else {
    input.val(0);
  }
});
$('.input-number').focusin(function(){
  $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

  minValue =  parseInt($(this).attr('min'));
  maxValue =  parseInt($(this).attr('max'));
  valueCurrent = parseInt($(this).val());

  name = $(this).attr('name');
  if(valueCurrent >= minValue) {
    $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
  } else {
    alert('Sorry, the minimum value was reached');
    $(this).val($(this).data('oldValue'));
  }
  if(valueCurrent <= maxValue) {
    $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
  } else {
    alert('Sorry, the maximum value was reached');
    $(this).val($(this).data('oldValue'));
  }


});
$(".input-number").keydown(function (e) {
// Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right
(e.keyCode >= 35 && e.keyCode <= 39)) {
// let it happen, don't do anything
return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
  e.preventDefault();
}
});
</script>

<script type="text/javascript" src="js/xzoom.min.js"></script>
<script src="js/setup.js"></script>
</body>
</html>