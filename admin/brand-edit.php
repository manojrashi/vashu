<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();
$brand_en=$obj->escapestring($_POST['brand_en']);
$brand_ar=$obj->escapestring($_POST['brand_ar']);
$cat_id=$obj->escapestring($_REQUEST['cat_id']);

if($_REQUEST['submitForm']=='yes'){
  $Image= new SimpleImage();
  if($_FILES['photo']['size']>0 && $_FILES['photo']['error']==''){
    $img=time().substr($_FILES['photo']['name'],-5);
    move_uploaded_file($_FILES['photo']['tmp_name'],"../upload_images/brand/".$img);
    copy("../upload_images/brand/".$img,"../upload_images/brand/thumb/".$img);
    $Image->load("../upload_images/brand/thumb/".$img);	  
    $Image->resize(100,80);	  
    $Image->save("../upload_images/brand/thumb/".$img);	 
  }
  if($_REQUEST['id']==''){
    $obj->query("insert into $tbl_brand set brand_en='".ucfirst($brand_en)."',brand_ar='".ucfirst($brand_ar)."',cat_id='$cat_id',logo='$img',status=1 ");
    $_SESSION['sess_msg']='Brand added sucessfully';  

  }else{ 
    $sql="update $tbl_brand set brand_en='".ucfirst($brand_en)."',brand_ar='".ucfirst($brand_ar)."',cat_id='$cat_id' ";
    if($img){
      $imageArr=$obj->query("select logo from $tbl_brand where id='".$_REQUEST['id']."' "); 
      $resultImage=$obj->fetchNextObject($imageArr);
      @unlink("../upload_images/brand/".$resultImage->logo); 
      @unlink("../upload_images/brand/thumb/".$resultImage->logo);
      $sql.=" ,logo='$img' ";
    }
    $sql.=" where id=".$_REQUEST['id']; 
//echo $sql; die;
    $obj->query( $sql);
    $_SESSION['sess_msg']='Brand updated sucessfully';   
  }
  header("location:brand-list.php");
  exit();
}      


if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_brand where id=".$_REQUEST['id']);
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
        <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> Brand</h1>
        <ol class="breadcrumb">
          <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="brand-list.php">View Brand List</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-default">
          <form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
            <input type="hidden" name="submitForm" value="yes" />
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Category</label>
                    <select name="cat_id" id="category" class="required form-control select2" >
                      <option value="">Select Category</option>
                      <?php
                      $abc = array();
                      $sql=$obj->query("select * from $tbl_maincategory where 1=1",$debug=-1); 
                      while($line=$obj->fetchNextObject($sql)){
                        ?>
                        <option value="<?php echo $line->id; ?>" <?php echo ($line->id==$result->cat_id)?'selected':'' ?> >
                          <?php if($line->parent_id==0){
                            echo $line->maincategory_en; 
                          }else{ 
                            echo getCategoryTree($line->id,$current_tree=array());
                          } ?>
                        </option>
                      <?php } ?>
                    </select>

                  </div>
                  <div class="form-group">
                    <label>Brand [English]:</label>
                    <input name="brand_en" type="text" id="brand" class="form-control" value="<?php echo stripslashes($result->brand_en);?>" />
                  </div>
                  <div class="form-group">
                    <label>Brand [Arabic]:</label>
                    <input name="brand_ar" type="text" id="brand" class="form-control" value="<?php echo stripslashes($result->brand_ar);?>" />
                  </div>
                  <div class="form-group">
                    <label>Logo:</label>
                    <input type="file" name="photo" class="form-control" /><br/>
                    <?php if(is_file("../upload_images/brand/".$result->logo)) {?>
                      <img src="../upload_images/brand/<?php echo  $result->logo; ?>" style="max-width:250px"  />
                    <?php } ?>
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
  $(document).ready(function(){
    $("#frm").validate();
    $(".select2").select2();
  })
</script>


</body>
</html>
