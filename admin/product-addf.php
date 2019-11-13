<?php
include("../include/config.php");
include("../include/functions.php"); 
// Image crop
include("./thumb_functions.php");
define('IMAGE_SMALL_DIR', '../upload_images/product/tiny/');
define('IMAGE_SMALL_SIZE', 70);
define('IMAGE_THUMB_DIR', '../upload_images/product/thumb/');
define('IMAGE_THUMB_SIZE', 154);
define('IMAGE_BIG_DIR', '../upload_images/product/big/');
define('IMAGE_BIG_SIZE', 540);
//end Image Crop
validate_admin();

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
  $new_release=$obj->escapestring($_POST['new_release']);
  $meta_tags=$obj->escapestring($_POST['meta_tags']);
  $short_description=$obj->escapestring($_POST['short_description']);
  $description=$obj->escapestring($_POST['descriptioN']);
  
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
  $totqty = $obj->escapestring($_REQUEST['totqty']);

  if($in_stock==''){
    $in_stock = 0;
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
    $obj->query("insert into $tbl_product set cat_id='$cat_id',subcat_id='$subcat_id',brand_id='$brand_id',vendor_id='$vendor_id',product_name='$product_name',slug='$product_slug',product_code='$product_code',short_description='$short_description',description='$description',meta_tags='$meta_tags',new_release='$new_release',posted_date=now(),posted_by='".$_SESSION['sess_admin_id']."'",$debug=-1); //die;
    $p_id = $obj->lastInsertedId();

    $PrSql = "";
    if($fileNameNew!=''){
      $PrSql =", pphoto='$fileNameNew'";
    }

    $obj->query("insert into $tbl_productprice set product_id='$p_id',size='$size',unit_id='$unit_id',actual_price='$actual_price',mrp_price='$mrp_price',discount='$discount',sell_price='$sell_price',in_stock='$in_stock',barcode_number='$barcode_number' $PrSql ",$debug=-1); //die;

    $pr_id = $obj->lastInsertedId();

    $obj->query("insert into $tbl_stock set product_id='$p_id',price_id='$pr_id',totqty='$totqty',type='Cr'");

    $_SESSION['sess_msg']='Product added sucessfully';    
    header("location:product-list.php");
    exit();

  }else{

    $updatequery=$obj->query("update $tbl_product set cat_id='$cat_id',subcat_id='$subcat_id',brand_id='$brand_id',vendor_id='$vendor_id',product_name='$product_name',slug='$product_slug',product_code='$product_code',short_description='$short_description',description='$description',meta_tags='$meta_tags',new_release='$new_release',posted_date=now(),posted_by='".$_SESSION['sess_admin_id']."' where id=".$_REQUEST['id'],$debug=-1); 
    $obj->query($updatequery);

    $PrSql = "";
    if($fileNameNew!=''){
      $PrSql =", pphoto='$fileNameNew'";
    }
    
    $obj->query("update $tbl_productprice set product_id='".$_REQUEST['id']."',size='$size',unit_id='$unit_id',actual_price='$actual_price',mrp_price='$mrp_price',discount='$discount',sell_price='$sell_price',in_stock='$in_stock',barcode_number='$barcode_number' $PrSql where product_id='".$_REQUEST['id']."'",$debug=-1); //die;

    $_SESSION['sess_msg']='Product Update sucessfully';      

    header("location:product-list.php");
    exit();
  }

}
if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_product where id=".$_REQUEST['id']);
  $result=$obj->fetchNextObject($sql);

  $PrSql = $obj->query("select * from $tbl_productprice where product_id='".$result->id."' order by id asc limit 0,1",$debug=-1);
  $PrResult = $obj->fetchNextObject($PrSql);
}
?>
<!DOCTYPE html>
<html>
<?php include("head.php"); ?>
<link rel="stylesheet" href="../colorbox/colorbox.css" />
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <script type="text/javascript" src="../include/ckeditor/ckeditor.js"></script>
    <div class="content-wrapper">
      <section class="content-header">
        <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> Product</h1>
        <ol class="breadcrumb">
          <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="product-list.php">View Product List</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-primary">
          <form name="productfrm" id="productfrm" method="POST" enctype="multipart/form-data" action="" onSubmit="return validate(this)">
            <input type="hidden" name="submitForm" value="yes" />
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Category</label>
                    <select name="cat_id" id="cat_id" class="required form-control select2" >
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Sub Category</label>
                    <select name="subcat_id" id="subcat_id" class="required form-control select2" >
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Brand</label>
                    <select name="brand_id" id="brand_id" class="required form-control select2">
                        <?php
                      if($_REQUEST['id']!=''){
                        $bsql=$obj->query("select * from $tbl_brand where 1=1 and status=1 and subcat_id='".$result->subcat_id."'",$debug=-1); 
                        while($bline=$obj->fetchNextObject($bsql)){
                          ?>
                          <option value="<?php echo $bline->id; ?>" <?php echo ($bline->id==$result->brand_id)?'selected':'' ?> ><?php echo $bline->brand; ?></option>
                       <?php }
                     }?>
                        
                      </option>
                  </select>
                </div> 
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Product Name</label>
                  <input name="product_name" type="text" id="product_name" class="required form-control" value="<?php echo stripslashes($result->product_name);?>" />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">  
                  <label>Size</label>
                  <input name="size" type="text" id="size" class="required form-control" value="<?php echo stripslashes($PrResult->size);?>" />
                </div>
              </div>           
              <div class="col-md-2">
                <div class="form-group">  
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

            </div>
            <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label>MRP Price (<?php echo $website_currency_code; ?>):</label>
                  <input name="mrp_price" type="text" id="mrp_price" class="required form-control" value="<?php echo stripslashes($PrResult->mrp_price);?>"  onkeyup="return calcPrice()">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Actual Price (<?php echo $website_currency_code; ?>)</label>
                  <input name="actual_price" type="text" id="actual_price" class="required form-control" value="<?php echo stripslashes($PrResult->actual_price);?>" />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Discount (%)</label>
                  <input name="discount" type="text" id="discount" class="required form-control" value="<?php echo stripslashes($PrResult->discount);?>"  onkeyup="return calcPrice()" />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Sell Price (<?php echo $website_currency_code; ?>) </label>
                  <input name="sell_price" type="text" id="sell_price" class="required form-control" value="<?php echo stripslashes($PrResult->sell_price);?>" readonly />
                </div>
              </div>
              <?php
              if($_REQUEST['id']==''){?>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Total Qty </label>
                  <input name="totqty" type="text" id="totqty" class="required digits form-control" value="<?php echo stripslashes($PrResult->totqty);?>" />
                </div>
              </div>
            <?php }?>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Barcode Number</label>
                  <input name="barcode_number" type="text" id="barcode_number" class="form-control" value="<?php echo stripslashes($PrResult->barcode_number);?>" />
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>HSN Code</label>
                  <input name="product_code" type="text" id="product_code" class="required form-control" value="<?php echo stripslashes($result->product_code);?>" />
                </div>

              </div>
              <div class="col-md-3" id="warehousemyid">
                <div class="form-group">
                  <label>Vendor</label>
                  <select name="vendor_id" id="vendor_id" class="form-control select2" >
                    <option value="">Select Vendor</option>
                    <?php
                    $storeArr=$obj->query("select * from $tbl_user where user_type=2 and status=1  ",$debug=-1); 
                    while($resultStore=$obj->fetchNextObject($storeArr)){
                      ?>
                      <option value="<?php echo $resultStore->id; ?>"<?php if($resultStore->id==$result->vendor_id){?>selected<?php } ?>><?php echo stripslashes($resultStore->name)." ".stripslashes($resultStore->surname); ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      <label>Image<br/>
                      (300 X 300px)(Not more than 100 KB)</label>
                      <input name="image_upload_file" type="file"  />
                      <br/>
                      <?php if(is_file("../upload_images/product/thumb/".$PrResult->pphoto)) {?>
                        <img src="../upload_images/product/thumb/<?php echo  $PrResult->pphoto; ?>" />
                      <?php } ?>
                    </div>
                  </div>

                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="in_stock">
                        <input type="checkbox" name="in_stock" id="in_stock" value="1" <?php if($PrResult->in_stock==1 ){ ?>checked<?php } ?>/>&nbsp; IN Stock</label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <label for="new_release">
                        <input type="checkbox" name="new_release" ID="new_release" value="1" <?php if($result->new_release==1 /*|| $_REQUEST['id']==''*/){ ?>checked<?php } ?>/>
                      New Releases</label>
                    </div>
                 </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Short Descriptions</label>
                    <textarea name="short_description"  class="required form-control" id="short_description" rows="5"><?php echo stripslashes($result->short_description); ?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Descriptions</label>
                    <textarea name="description"  class="ckeditor form-control" id="description" rows="5"><?php echo stripslashes($result->description); ?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Meta Tags</label>
                    <textarea name="meta_tags"  class="form-control" id="meta_tags" rows="2"><?php echo stripslashes($result->meta_tags); ?></textarea>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="box-footer">
            <input type="submit" name="submit" value="Submit"  class="button" border="0"/>&nbsp;&nbsp;
            <input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
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
<script src="js/select2.full.min.js"></script>
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
    $("#productfrm").validate();

    $('#cat_id').change(function() {
      var cat_id=$(this).val(); 
      $.ajax({
        url:"getsubcate.php",
        data:{cat_id:cat_id},
        beforeSend:function(){
        $("#subcat_id").html('<option value="">Select Sub Category</option>');
        },
        success:function(data){
        $("#subcat_id").append(data);
        }
      })
     })


    $('#subcat_id').change(function() {
      var cat_id=$(this).val(); 
      $.ajax({
        url:"getBrand.php",
        data:{cat_id:cat_id},
        beforeSend:function(){
        $("#brand_id").html('<option value="">Select Brand</option>');
        },
        success:function(data){
        $("#brand_id").append(data);
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
</div> 
</body>
</html>

