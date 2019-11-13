<?php
session_start();
include("include/config.php");
include("include/functions.php");
include("include/simpleimage.php"); 
include("admin/thumb_functions.php");
include("wfcart.php");
validate_user();


$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

/****************** Image crop Function *********************/
ini_set("memory_limit", "99M");
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 600);
define('IMAGE_SMALL_DIR', '../upload_images/product/tiny/');
define('IMAGE_SMALL_SIZE', 70);
define('IMAGE_THUMB_DIR', '../upload_images/product/thumb/');
define('IMAGE_THUMB_SIZE', 150);
define('IMAGE_BIG_DIR', '../upload_images/product/big/');
define('IMAGE_BIG_SIZE', 500);

/************************End***********************************/


if($_REQUEST['submitForm']=='yes'){

  if($_FILES['image_upload_file']['size']>0 && $_FILES['image_upload_file']['error']=='')
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
      /*create directory with 777 permission if not exist - start*/
      createDir(IMAGE_SMALL_DIR);
      createDir(IMAGE_THUMB_DIR);
      createDir(IMAGE_BIG_DIR);
      /*create directory with 777 permission if not exist - end*/
      $path[0] = $_FILES['image_upload_file']['tmp_name'];
      $file = pathinfo($_FILES['image_upload_file']['name']);
      $fileType = $file["extension"];
      $desiredExt='jpg';
      $fileNameNew = rand(333, 999) . time() . ".$desiredExt";
//$path[1] = IMAGE_MEDIUM_DIR . $fileNameNew;
      $path[1] = IMAGE_SMALL_DIR . $fileNameNew;
      $path[2] = IMAGE_THUMB_DIR . $fileNameNew;
      $path[3] = IMAGE_BIG_DIR . $fileNameNew;
//move_uploaded_file($_FILES['image_upload_file']['tmp_name'],"../upload_images/model/".$fileNameNew);

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



  $p_id=ucfirst($obj->escapestring($_POST['p_id']));
  $product_id=ucfirst($obj->escapestring($_POST['product_id']));
  $size=$obj->escapestring($_REQUEST['size']);
  $unit_id=$obj->escapestring($_REQUEST['unit']);
  $actual_price=$obj->escapestring($_REQUEST['actual_price']);
  $mrp_price=$obj->escapestring($_REQUEST['mrp_price']);
  $discount=$obj->escapestring($_REQUEST['discount']);
  $sell_price=$obj->escapestring($_REQUEST['sell_price']);
  $in_stock=$obj->escapestring($_REQUEST['in_stock']);
  $cart_max_qty=$obj->escapestring($_REQUEST['cart_max_qty']);
  $price_id=$obj->escapestring($_REQUEST['price_id']);
  $cart_min_qty=$obj->escapestring($_REQUEST['cart_min_qty']);

  $PSql = "";
  if($p_id!=''){
    $PSql .="product_id='$p_id'";
  }
  if($PrResult->id!=''){
    $PSql .=",price_id='".$PrResult->id."'";
  }
  if($size!=''){
    $PSql .=",size='$size'";
  }
  if($unit_id!=''){
    $PSql .=",unit_id='$unit_id'";
  }
  if($cart_max_qty!=''){
    $PSql .=",cart_max_qty='$cart_max_qty'";
  }
  if($actual_price!=''){
    $PSql .=",actual_price='$actual_price'";
  }
  if($mrp_price!=''){
    $PSql .=",mrp_price='$mrp_price'";
  }

  if($discount!=''){
    $PSql .=",discount='$discount'";
  }
  if($sell_price!=''){
    $PSql .=",sell_price='$sell_price'";
  }
  if($in_stock!=''){
    $PSql .=",in_stock='$in_stock'";
  }else{
    $PSql .=",in_stock='0'";
  }
  if($fileNameNew!=''){
    $PSql .=",pphoto='$fileNameNew'";
  }

  if($cart_min_qty){
    $PSql .=", cart_min_qty='$cart_min_qty'";
  }

  if($_REQUEST['id']==''){
    $sql="insert into $tbl_productprice set $PSql ";
    $obj->query($sql);

    $_SESSION['sess_msg']='Product price added sucessfully';

  }else{ 
    $sql="update $tbl_productprice set $PSql,last_update_date=now() ";

    if($fileNameNew){
      $imageArr=$obj->query("select pphoto from $tbl_productprice where id='".$_REQUEST['id']."' "); 
      $resultImage=$obj->fetchNextObject($imageArr); 
      @unlink("upload_images/product/".$resultImage->pphoto);
      @unlink("upload_images/product/big/".$resultImage->pphoto);
      @unlink("upload_images/product/thumb/".$resultImage->pphoto);
      @unlink("upload_images/product/tiny/".$resultImage->pphoto);
    }
    $sql.=" where id='".$_REQUEST['id']."'";
    //echo $sql; die;  
    $obj->query($sql);


    $_SESSION['sess_msg']='Product price updated sucessfully';   
  }
  header("location: productprice-list.php?product_id=".$_REQUEST['p_id']);
  exit();
}     


if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_productprice where id=".$_REQUEST['id']);
  $result=$obj->fetchNextObject($sql);
} 
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
                <span onclick="file_explorer();"><i class="fa fa-upload"></i>Change Image </span>
                <input type="file" id="selectfile" style="display: none;">
              </form>
            </div>
          </div>
        </div>

        <div class="userliftbaarmain">
          <?php include('sidebar.php'); ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-9">

            <div class="row">
  <div class="col-md-9">
  <div class="col-md-12 listpage"><h4 style="margin-left: -10px;"><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?>Product price/size</h4></div>
  </div>
  <div class="col-md-3">
  <p style="text-align:right"><input type="button" name="add" value="Product price list"  class="btn btn-success" onclick="location.href=' productprice-list.php?product_id=<?php echo $_REQUEST['product_id'] ?>'" /></p>  

  </div>
  </div>
        <div class="right-site">
          <div class="col-xs-12 col-sm-12 background">

             <form name="productPricefrm" id="productPricefrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
            <input type="hidden" name="submitForm" value="yes" />
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
            <input type="hidden" name="p_id" id="p_id" value="<?php echo $_REQUEST['product_id'];?>" />
            <input type="hidden" name="product_id" id="product_id" value="<?php echo getField('product_id',$tbl_product,$_REQUEST['product_id']);?>" />
            <input type="hidden" name="price_id" id="price_id" value="" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">  
                    <label>Size</label>
                   <input type="text" name="size" value="<?php echo $result->size; ?>" class="required form-control">

                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">  
                    <label>Unit</label>

                    <select name="unit" id="unit_id" class="required form-control">
                      <?php 
                      $UnitSql=$obj->query("select * from $tbl_unit where status=1");
                      while($unitResult = $obj->fetchNextObject($UnitSql)){?>
                        <option value="<?php echo $unitResult->id;?>" <?php if($unitResult->id==$result->unit_id){?> selected <?php } ?>><?php echo $unitResult->name;?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">  
                    <label>Max Cart Qty</label>
                    <select name="cart_max_qty" class="required form-control">
                      <option value=""> Select Max Cart Qty</option>
                      <?php for($i=0;$i<=20;$i++){?>
                        <option value="<?php echo $i;?>"<?php if($result->cart_max_qty==$i){echo "Selected"; }?> ><?php echo $i;?></option>
                      <?php }?>
                    </select>

                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">  
                    <label>Min Cart Qty</label>
                    <input type="text" name="cart_min_qty" id="cart_min_qty" value="<?php echo $result->cart_min_qty; ?>" class="form-control">
                  </div>
                </div>

                <div class="col-md-2"> 
                  <div class="form-group">
                    <label>MRP Price (<?php echo $website_currency_code; ?>)</label>
                    <input name="mrp_price" type="text" id="mrp_price" class="required form-control" value="<?php echo stripslashes($result->mrp_price);?>"  onkeyup="return calcPrice()"  />
                  </div>
                </div>



                <div class="col-md-2">
                  <div class="form-group">
                    <label>ActualPrice (<?php echo $website_currency_code; ?>) </label>
                    <input name="actual_price" type="text" id="actual_price" class=" required form-control" value="<?php echo stripslashes($result->actual_price);?>"  />
                  </div>
                </div>

                <div class="col-md-2"> 
                  <div class="form-group">
                    <label>Discount (%)</label>
                    <input name="discount" type="text" id="discount" class="required form-control" value="<?php echo stripslashes($result->discount);?>"  onkeyup="return calcPrice()" />
                  </div>
                </div>



                <div class="col-md-2">
                  <div class="form-group">
                    <label>Sell Price</label>
                    <input name="sell_price" type="text" id="sell_price" class="required form-control" value="<?php echo stripslashes($result->sell_price);?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Or Upload New Image<br/>
                      <span style="font-size:11px;color:red"> (600px X 600px)(<?php echo $Notmorethan500KB;?>)</span>
                    </label>
                    <input name="image_upload_file" type="file"  />
                    <?php if(is_file("upload_images/product/thumb/".$result->pphoto)) {?>
                      <img src="upload_images/product/thumb/<?php echo  $result->pphoto; ?>" />
                    <?php } ?>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label for="in_stock">
                      <input type="checkbox" name="in_stock" id="in_stock" value="1" <?php if($result->in_stock==1 || $_REQUEST['id']==''){ ?>checked<?php } ?> />
                    IN Stock</label>
                  </div>
                </div>

              </div>                    
            </div>

            <div class="col-md-12">
              <div class="box-footer">
               <button type="Submit">Submit</button>
                
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
</body>
</html>
