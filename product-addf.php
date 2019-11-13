<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");
validate_user();

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

// Image crop
include("admin/thumb_functions.php");
define('IMAGE_SMALL_DIR', '../upload_images/product/tiny/');
define('IMAGE_SMALL_SIZE', 70);
define('IMAGE_THUMB_DIR', '../upload_images/product/thumb/');
define('IMAGE_THUMB_SIZE', 154);
define('IMAGE_BIG_DIR', '../upload_images/product/big/');
define('IMAGE_BIG_SIZE', 540);


if($_REQUEST['submitForm']=='yes')
{

  $cat_id=$obj->escapestring($_POST['cat_id']);
  $subcat_id=$obj->escapestring($_POST['subcat_id']);
  $brand_id=$obj->escapestring($_POST['brand_id']);
  $product_name = $obj->escapestring($_POST['product_name']);
  $product_slug = generateSlug($product_name);
  $product_code=$obj->escapestring($_POST['product_code']);
  $vendor_id=$obj->escapestring($_POST['vendor_id']);
  $monthly_special=$obj->escapestring($_POST['monthly_special']);
  $ex_offer_zone=$obj->escapestring($_POST['ex_offer_zone']);
  $new_release=$obj->escapestring($_POST['new_release']);
  $cart_max_qty=$obj->escapestring($_POST['cart_max_qty']);
  $express_delivery=$obj->escapestring($_POST['express_delivery']);
  $meta_tags=$obj->escapestring($_POST['meta_tags']);
  $short_description_en=$obj->escapestring($_POST['short_description_en']);
  $short_description_ar=$obj->escapestring($_POST['short_description_ar']);
  $description_en=$obj->escapestring($_POST['description_en']);
  $description_ar=$obj->escapestring($_POST['description_ar']);

#################################################### Product Price ######################################

  $price_id=ucfirst($obj->escapestring($_POST['price_id']));
  $size=$obj->escapestring($_REQUEST['size']);
  $unit_id=$obj->escapestring($_REQUEST['unit']);
  $actual_price=$obj->escapestring($_REQUEST['actual_price']);
  $mrp_price=$obj->escapestring($_REQUEST['mrp_price']);
  $discount=$obj->escapestring($_REQUEST['discount']);
  $sell_price=$obj->escapestring($_REQUEST['sell_price']);
  $in_stock=$obj->escapestring($_REQUEST['in_stock']);
  $barcode_number=$obj->escapestring($_REQUEST['barcode_number']);
  $totqty=$obj->escapestring($_REQUEST['totqty']);
  $instockqty=$obj->escapestring($_REQUEST['instockqty']);
  $cart_max_qty = $obj->escapestring($_REQUEST['cart_max_qty']);
  $cart_min_qty = $obj->escapestring($_REQUEST['cart_min_qty']);
  $totqty = $obj->escapestring($_REQUEST['totqty']);

  if($in_stock==''){
    $in_stock = 0;
  }
  if($express_delivery==''){
    $express_delivery = 0;
  }
  if($ex_offer_zone==''){
    $ex_offer_zone = 0;
  }
  if($express_delivery==''){
    $express_delivery = 0;
  }
  if($new_release==''){
    $new_release = 0;
  }

  if($totqty==''){
    $totqty = 0;
  }
#################################################### Product Price End ######################################

  if($_FILES['image_upload_file']['size']>0 && $_FILES['photo']['error']=='')
  {
    $output['status']=FALSE;
    set_time_limit(0);
    $allowedImageType = array("image/gif",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
    if ($_FILES['image_upload_file']["error"] > 0) {
      $output['error']= "Error in File";
    }
    elseif (!in_array($_FILES['image_upload_file']["type"], $allowedImageType)) {
      $output['error']= "You can only upload JPG, PNG and GIF file";
    }
    elseif (round($_FILES['image_upload_file']["size"] / 1024) > 4096) {
      $output['error']= "You can upload file size up to 4 MB";
    } else {
      createDir(IMAGE_SMALL_DIR);
      createDir(IMAGE_THUMB_DIR);
      createDir(IMAGE_BIG_DIR);

      $path[0] = $_FILES['image_upload_file']['tmp_name'];
      $file = pathinfo($_FILES['image_upload_file']['name']);
      $fileType = $file["extension"];
      $desiredExt='jpg';
      $fileNameNew = rand(333, 999) . time() . ".$desiredExt";
//$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
      $path[1] = IMAGE_SMALL_DIR . $fileNameNew;
      $path[2] = IMAGE_THUMB_DIR . $fileNameNew;
      $path[3] = IMAGE_BIG_DIR . $fileNameNew;       
      if (createThumb($path[0], $path[1],"$desiredExt", IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE)) {
        if (createThumb($path[0], $path[2],"$desiredExt", IMAGE_THUMB_SIZE, IMAGE_THUMB_SIZE,IMAGE_THUMB_SIZE)) {
          if (createThumb($path[0], $path[3],"$desiredExt", IMAGE_BIG_SIZE, IMAGE_BIG_SIZE,IMAGE_BIG_SIZE)) {
            $output['status']=TRUE;
            $output['image_small']= $path[1];
            $output['image_thumb']= $path[2];
            $output['image_big']= $path[3];
          }   
        }
      }
      move_uploaded_file($_FILES['image_upload_file']['tmp_name'],"../upload_images/product/".$fileNameNew);
    }   
  }


  if($_REQUEST['id']=='')
  {  
$obj->query("insert into $tbl_product set cat_id='$cat_id',subcat_id='$subcat_id',brand_id='$brand_id',vendor_id='".$_SESSION['v_user_id']."',product_name='$product_name',slug='$product_slug',product_code='$product_code',short_description_en='$short_description_en',short_description_ar='$short_description_ar',description_en='$description_en',description_ar='$description_ar',meta_tags='$meta_tags',ex_offer_zone='$ex_offer_zone',new_release='$new_release',express_delivery='$express_delivery', posted_date=now(),posted_by='".$_SESSION['sess_admin_id']."'",$debug=-1); //die;
$p_id = $obj->lastInsertedId();

$PrSql = "";
if($fileNameNew!=''){
  $PrSql =", pphoto='$fileNameNew'";
}

$obj->query("insert into $tbl_productprice set product_id='$p_id',size='$size',unit_id='$unit_id',actual_price='$actual_price',mrp_price='$mrp_price',discount='$discount',sell_price='$sell_price',in_stock='$in_stock',cart_max_qty='$cart_max_qty',cart_min_qty='$cart_min_qty',barcode_number='$barcode_number' $PrSql ",$debug=-1); //die;

$pr_id = $obj->lastInsertedId();

$obj->query("insert into $tbl_stock set product_id='$p_id',price_id='$pr_id',totqty='$totqty',type='Cr'");

$_SESSION['sess_msg']='Product added sucessfully';    
header("location:manage-product.php");
exit();

}else{

$updatequery=$obj->query("update $tbl_product set cat_id='$cat_id',subcat_id='$subcat_id',brand_id='$brand_id',product_name_en='$product_name_en',slug='$product_slug',product_code='$product_code',short_description_en='$short_description_en',short_description_ar='$short_description_ar',description_en='$description_en',description_ar='$description_ar',meta_tags='$meta_tags',ex_offer_zone='$ex_offer_zone',new_release='$new_release',express_delivery='$express_delivery', posted_date=now(),posted_by='".$_SESSION['sess_admin_id']."' where id=".$_REQUEST['id'],$debug=-1); //die; 
$obj->query($updatequery);

$obj->query("update $tbl_productprice set product_id='".$_REQUEST['id']."',size='$size',unit_id='$unit_id',actual_price='$actual_price',mrp_price='$mrp_price',discount='$discount',sell_price='$sell_price',in_stock='$in_stock',cart_max_qty='$cart_max_qty',cart_min_qty='$cart_min_qty',barcode_number='$barcode_number' $PrSql where product_id='".$_REQUEST['id']."'",$debug=-1); //die;

$_SESSION['sess_msg']='Product Update sucessfully';      

header("location:manage-product.php");
exit();
}

}
if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_product where id=".base64_decode(base64_decode($_REQUEST['id'])));
  $result=$obj->fetchNextObject($sql);
  print_r($result);// die'

  $PrSql = $obj->query("select * from $tbl_productprice where product_id='".$result->id."' order by id asc limit 0,1",$debug=-1);
  $PrResult = $obj->fetchNextObject($PrSql);
}
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profile</title>
  <link href="css/user_style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <?php include("head.php"); ?>
  <link rel="stylesheet" href="admin/css/select2.min.css">
  <style type="text/css">
    .grid__item input{height: 35px;}
  </style>
</head>
<body>
  <?php include("header.inc.php"); ?>
  <section id="desboard">
    <div class="container">
      <div class="col-xs-12 col-sm-3">

        <div class="userleft-main">
          <div class="user">
            <div id="set_images">
              <figure>
                <?php if($result->photo){ ?>
                  <img src="upload_images/user/tiny/<?php echo $result->photo; ?>"> 
                <?php }else{ ?>
                  <img src="images/blank-gallery.png">
                <?php } ?>
              </figure>
            </div>

            <div class="userimage">
              <form method="POST" enctype="multipart/form-data" action="change-image.php">
                <!--<input type="file" name="file"> -->
                <span onclick="file_explorer();"><i class="fa fa-upload"></i>Change Image </span>
                <input type="file" id="selectfile" style="display: none;">
              </form>
            </div>
          </div>
        </div>

        <div class="userliftbaarmain">
          <?php include('vendor-sidebar.php'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-9">

            <div class="row">
  <div class="col-md-9">
  <div class="col-md-12 listpage"><h4 style="margin-left: -10px;"><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> Product</h4></div>
  </div>
  <div class="col-md-3">
  <p style="text-align:right"><input type="button" name="add" value="Product List"  class="btn btn-success" onclick="location.href='manage-product.php'" /></p>  

  </div>
  </div>
        <div class="right-site">
          <div class="col-xs-12 col-sm-12 background">

            <form name="productfrm" id="productfrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
              <input type="hidden" name="submitForm" value="yes" />
              <input type="hidden" name="id" value="<?php echo base64_decode(base64_decode($_REQUEST['id']));?>" />

              <input type="hidden" name="submitForm" value="yes" />


              <div class="col-xs-12 col-sm-4 input1">
                <div class="grid__item">
                  <label>Category</label>
                  <select name="cat_id" id="v_cat_id" class="required form-control select2" >
                    <option value="">Select Category</option>
                    <?php
                    $catSql = $obj->query("select * from $tbl_category where status=1");
                    while($catResult = $obj->fetchNextObject($catSql)){?>
                      <option value="<?php echo $catResult->id; ?>" <?php if($result->cat_id==$catResult->id){?> selected <?php } ?>><?php echo $catResult->category; ?></option>
                    <?php }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 input1">
                <div class="grid__item">
                  <label>Sub Category</label>
                  <select name="subcat_id" id="v_subcat_id" class="required form-control select2" >
                    <?php
                    if($_REQUEST['id']!=''){
                      $subcatSql = $obj->query("select * from $tbl_subcategory where status=1 and cat_id='".$result->cat_id."'");
                      while($catResult = $obj->fetchNextObject($subcatSql)){?>
                        <option value="<?php echo $catResult->id; ?>" <?php if($result->subcat_id==$catResult->id){?> selected <?php } ?>><?php echo $catResult->subcategory; ?></option>
                      <?php }
                    }?>

                  </select>
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 input1">
                <div class="grid__item">
                  <label>Brand</label>
                  <select name="brand_id" id="v_brand_id" class="required form-control select2">
                    <?php
                    if($_REQUEST['id']!=''){
                  echo     $bsql=$obj->query("select * from $tbl_brand where 1=1 and status=1 and id='".$result->subcat_id."'",$debug=1); die; 
                      while($bline=$obj->fetchNextObject($bsql)){
                        ?>
                        <option value="<?php echo $bline->id; ?>" <?php echo ($bline->id==$result->brand_id)?'selected':'' ?> ><?php echo $bline->brand; ?></option>
                      <?php }
                    }?>

                  </option>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 input1">
              <div class="grid__item">
                <label>Product Name </label>
                <input name="product_name_en" type="text" id="product_name_en" class="required form-control" value="<?php echo stripslashes($result->product_name_en);?>" />
              </div>
            </div>
            <div class="col-xs-12 col-sm-2 input1">
              <div class="grid__item">
                <label>Size</label>
                <input name="size" type="text" id="size" class="required form-control" value="<?php echo stripslashes($PrResult->size);?>" />
              </div>
            </div>
            <div class="col-xs-12 col-sm-3 input1">
              <div class="grid__item">
                <label>Unit</label>
                <?php 
                $unitquery=$obj->query("select * from $tbl_unit where status=1");?>
                <select name="unit" class="required form-control">
                  <option value=""> Select unit</option>
                  <?php while($ures=$obj->fetchNextObject($unitquery)){?>
                    <option value="<?php echo $ures->id;?>" <?php if($ures->id==$PrResult->unit_id){ echo "selected";} ?>><?php echo $ures->name;?></option>
                  <?php }?>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-3 input1">
              <div class="grid__item">
                <label>MRP Price (<?php echo $website_currency_code; ?>):</label>
                <input name="mrp_price" type="text" id="mrp_price" class="required form-control" value="<?php echo stripslashes($PrResult->mrp_price);?>"  onkeyup="return calcPrice()">
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 input1">
              <div class="grid__item">
                <label>Actual Price (<?php echo $website_currency_code; ?>)</label>
                <input name="actual_price" type="text" id="actual_price" class="required form-control" value="<?php echo stripslashes($PrResult->actual_price);?>" />
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 input1">
              <div class="grid__item">
                <label>Discount (%)</label>
                <input name="discount" type="text" id="discount" class="required form-control" value="<?php echo stripslashes($PrResult->discount);?>"  onkeyup="return calcPrice()" />
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 input1">
              <div class="grid__item">
                <label>Sell Price (<?php echo $website_currency_code; ?>) </label>
                <input name="sell_price" type="text" id="sell_price" class="required form-control" value="<?php echo stripslashes($PrResult->sell_price);?>" readonly />
              </div>
            </div>

            <?php
              if($_REQUEST['id']==''){?>
            <div class="col-xs-12 col-sm-4 input1">
              <div class="grid__item">
                <label>Total Qty </label>
                <input name="totqty" type="text" id="totqty" class="required digits form-control" value="<?php echo stripslashes($PrResult->totqty);?>" />
              </div>
            </div>
            <?php }?>
            <div class="col-xs-12 col-sm-4 input1">
              <div class="grid__item">
                <label>Barcode Number</label>
                <input name="barcode_number" type="text" id="barcode_number" class="form-control" value="<?php echo stripslashes($PrResult->barcode_number);?>" />
              </div>
            </div>

            <div class="col-xs-12 col-sm-4 input1">
              <div class="grid__item">
                <label>HSN Code</label>
                <input name="product_code" maxlength="8" type="text" id="product_code"  value="<?php echo stripslashes($result->product_code);?>" />
              </div>
            </div>
            <div class="col-xs-12 col-sm-2 input1">
              <div class="grid__item">
                <label>Max Cart Qty</label>
                <select name="cart_max_qty" class="required form-control">
                  <option value=""> Select</option>
                  <?php for($i=1;$i<=20;$i++){?>
                    <option value="<?php echo $i;?>" <?php if($i==$PrResult->cart_max_qty){ echo "selected";} ?>><?php echo $i;?></option>
                  <?php }?>
                </select>
              </div>
            </div>

            <div class="col-xs-12 col-sm-2 input1">
              <div class="grid__item">
                <label>Min Cart Qty</label>
                <input type="text" name="cart_min_qty" id="cart_min_qty" value="<?php echo $PrResult->cart_min_qty; ?>" class="required form-control">
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 input1">
              <div class="grid__item">
                <label>Image<br/>
                (300 X 300px)(Not more than 100 KB)</label>
                <input name="image_upload_file" type="file"  />
                <br/>
                <?php if(is_file("../upload_images/product/thumb/".$PrResult->pphoto)) {?>
                  <img src="../upload_images/product/thumb/<?php echo  $PrResult->pphoto; ?>" />
                <?php } ?>
              </div>
            </div>

            
            <div class="col-xs-12 col-sm-12 input1">
              <div class="grid__item">
                <label>Short Descriptions</label>
                <textarea name="short_description_en"  class="required form-control" id="short_description" rows="5"><?php echo stripslashes($result->short_description); ?></textarea>
              </div>
            </div>

            <div class="col-xs-12 col-sm-12 input1">
              <div class="grid__item">
                <label>Descriptionlabel>
                <textarea name="description_en"  class="ckeditor form-control" id="description" rows="5"><?php echo stripslashes($result->description); ?></textarea>
              </div>
            </div>


            <div class="col-xs-12 col-sm-12">
              <div class="footer-buttons">
                <button type="submit" style="margin-bottom: 15px;">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include("footer.inc.php"); ?>
<script type="text/javascript" src="include/ckeditor/ckeditor.js"></script>
<script src="loginnew_page/slider.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="admin/js/jquery.validate.min.js"></script>
<script src="admin/js/select2.full.min.js"></script>
<script type="text/javascript">
  function calcPrice(){
    var mrp_price=document.getElementById('mrp_price').value; 
    var dis=document.getElementById('discount').value;
    if(mrp_price!='' && dis!='' ){
      document.getElementById('sell_price').value=mrp_price-(mrp_price*dis/100);
    }
  }
</script>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> 
<script type="text/javascript">
  $(document).ready(function(){
    $("#productfrm").validate();

    $('#v_cat_id').change(function() {
      var cat_id=$(this).val(); 
      $.ajax({
        url:"admin/getsubcate.php",
        data:{cat_id:cat_id},
        beforeSend:function(){
          $("#v_subcat_id").html('<option value="">Select Sub Category</option>');
        },
        success:function(data){
          $("#v_subcat_id").append(data);
        }
      })
    })


    $('#v_subcat_id').change(function() {
      var cat_id=$(this).val(); 
      $.ajax({
        url:"admin/getBrand.php",
        data:{cat_id:cat_id},
        beforeSend:function(){
          $("#v_brand_id").html('<option value="">Select Brand</option>');
        },
        success:function(data){
          $("#v_brand_id").append(data);
        }
      })
    })

    $(function() {
      $( "#expiry_date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+5?>',
        dateFormat: "yy-mm-dd",
      });


    });

  })
  $(".select2").select2();
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function validateform()    
        {  

var product_code=document.forms['productfrm']['product_code'].value;
               product_code=product_code.trim();
                if(product_code==''){
                    alert('please enter code');
                    return false;
                }
                if(product_code.length<6) {
                    alert('HSN code take minimum eight digit');
                    return false;
                }
              }
                </script>
</body>
</html>
