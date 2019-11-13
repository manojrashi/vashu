<?php
session_start();
include("../include/config.php");
include("../include/functions.php");
include("../include/simpleimage.php"); 
include("./thumb_functions.php");
validate_admin();

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
  $price_id=$obj->escapestring($_REQUEST['price_id']);


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

  

  if($_REQUEST['id']==''){
    $sql="insert into $tbl_productprice set $PSql ";
    $obj->query($sql);

    $_SESSION['sess_msg']='Product price added sucessfully';

  }else{ 
    $sql="update $tbl_productprice set $PSql,last_updated_by='".$_SESSION['sess_admin_id']."',last_update_date=now() ";

    if($fileNameNew){
      $imageArr=$obj->query("select pphoto from $tbl_productprice where id='".$_REQUEST['id']."' "); 
      $resultImage=$obj->fetchNextObject($imageArr); 
      @unlink("../upload_images/product/".$resultImage->pphoto);
      @unlink("../upload_images/product/big/".$resultImage->pphoto);
      @unlink("../upload_images/product/thumb/".$resultImage->pphoto);
      @unlink("../upload_images/product/tiny/".$resultImage->pphoto);
    }
    $sql.=" where id='".$_REQUEST['id']."'";
    //echo $sql; die;  
    $obj->query($sql);

  //Update Cart Table Also
    $obj->query("update $tbl_cart set price='$sell_price' where size_id='".$_REQUEST['id']."'");

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
<html>
<?php include("head.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <script type="text/javascript" src="../include/ckeditor/ckeditor.js"></script>
    <div class="content-wrapper">
      <section class="content-header">
        <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> Price/Size</h1>
        <ol class="breadcrumb">
          <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="productprice-list.php?product_id=<?php echo $_REQUEST['product_id']; ?>">View Price/Size List</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-primary">
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
                    <label>MRP Price (<?php echo $website_currency_code; ?>)</label>
                    <input name="mrp_price" type="text" id="mrp_price" class="required form-control" value="<?php echo stripslashes($result->mrp_price);?>"  onkeyup="return calcPrice()"  />
                  </div>
                </div>



                <div class="col-md-2">
                  <div class="form-group">
                    <label>Actual Price (<?php echo $website_currency_code; ?>) </label>
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
                    <label>Sell Price <!-- (After Discount) (<?php echo $website_currency_code; ?>) --></label>
                    <input name="sell_price" type="text" id="sell_price" class="required form-control" value="<?php echo stripslashes($result->sell_price);?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Or Upload New Image<br/>
                      <span style="font-size:11px;color:red"> (600px X 600px)(Not more than 500 KB)</span>
                    </label>
                    <input name="image_upload_file" type="file"  />
                    <?php if(is_file("../upload_images/product/thumb/".$result->pphoto)) {?>
                      <img src="../upload_images/product/thumb/<?php echo  $result->pphoto; ?>" />
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
                <input type="submit" name="submit" value="Submit"  class="button" border="0"/>&nbsp;&nbsp;
                <input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
              </div>
            </div>

          </form>
        </div>
      </section>
    </div>
    <?php include("footer.php"); ?>
    <div class="control-sidebar-bg"></div>
  </div>
  <script src="js/jquery-2.2.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/app.min.js"></script>
  <script src="js/demo.js"></script>
  <script src="js/jquery.validate.min.js"></script>
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
      $("#productPricefrm").validate();
      $("#totqty").keyup(function(){
        $("#instockqty").val($("#totqty").val());
      })

    })
  </script>
</body>
</html>
