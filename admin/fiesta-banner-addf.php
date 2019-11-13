<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();

if($_REQUEST['submitForm']=='yes'){
  $title_en = $obj->escapestring($_POST['title_en']);
  $title_ar = $obj->escapestring($_POST['title_ar']);
  $short_description_en = $obj->escapestring($_POST['short_description_en']);
  $short_description_ar = $obj->escapestring($_POST['short_description_ar']);
  $target_url=$obj->escapestring($_POST['target_url']);
  $price=$obj->escapestring($_POST['price']);
  if($price==''){
    $price=0;
  }
  
  if($_FILES['photo']['size']>0 && $_FILES['photo']['error']==''){
    $Image=new SimpleImage();
    $img=time().$_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'],"../upload_images/banner/".$img);
  }  

  if($_REQUEST['id']==''){
      $obj->query("insert into $tbl_fiesta_banner set title_en='$title_en',title_ar='$title_ar',short_description_en='$short_description_en',short_description_ar='$short_description_ar',target_url='$target_url',photo='$img',price='$price',status=1 ");
      $_SESSION['sess_msg']='Banner added sucessfully';  
    }else{ 
      $sql="update $tbl_fiesta_banner set  title_en='$title_en',title_ar='$title_ar',short_description_en='$short_description_en',short_description_ar='$short_description_ar',target_url='$target_url',price='$price',status=1 ";
      if($img){
        $imageArr=$obj->query("select photo from $tbl_fiesta_banner where id=".$_REQUEST['id']);
        $resultImage=$obj->fetchNextObject($imageArr);
        @unlink("../upload_images/banner/".$resultImage->photo);
        @unlink("../upload_images/banner/thumb/".$resultImage->photo);
        $sql.=" , photo='$img' ";
      }
      $sql.=" where id='".$_REQUEST['id']."'";
      //echo $sql; die;
      $obj->query($sql);
      $_SESSION['sess_msg']='Fiesta Banner updated sucessfully';   
  }
  header("location:fiesta-banner-list.php");
  exit();
}      


if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_fiesta_banner where id=".$_REQUEST['id']);
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
  <div class="content-wrapper">
    <section class="content-header">
      <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> Fiesta Banner</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="fiesta-banner-list.php">View Fiesta Banner List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
		<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">

        <div class="col-md-4">
             <div class="form-group">
              <label>Title [English]</label>
                <input type="text" name="title_en" value="<?php echo stripslashes($result->title_en); ?>" class="required form-control">
              </div>
          </div> 
          <div class="col-md-4">
             <div class="form-group">
              <label>Title [Arabic]</label>
                <input type="text" name="title_ar" value="<?php echo stripslashes($result->title_ar); ?>" class="form-control">
              </div>
          </div> 
          <div class="col-md-4">
             <div class="form-group">
              <label>Price</label>
                <input type="text" name="price" value="<?php echo stripslashes($result->price); ?>" class="required form-control">
              </div>
          </div>  
          <div class="col-md-6">
             <div class="form-group">
              <label>Short Description [English]</label>
                <textarea name="short_description_en" class="required form-control"><?php echo stripcslashes($result->short_description_en) ?></textarea>
              </div>
          </div>  
          <div class="col-md-6">
             <div class="form-group">
              <label>Short Description [Arabic]</label>
                <textarea name="short_description_ar" class="form-control"><?php echo stripcslashes($result->short_description_ar) ?></textarea>
              </div>
          </div>  
			  <div class="col-md-6">
				  <div class="form-group">
						<label>Banner Image</label>
						<input type="file" name="photo" class='form-control' /><br/>
						<?php if(is_file("../upload_images/banner/thumb/".$result->photo)){ ?>
						<img src="../upload_images/banner/thumb/<?php echo $result->photo; ?>" style="height: 200px; width: 300px;"  /><?php } ?>
				  </div>
			  </div>
        <div class="col-md-4">
             <div class="form-group">
              <label>Target URL</label>
                <input type="text" name="target_url" value="<?php echo stripslashes($result->target_url); ?>" class="required form-control">
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
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
  $("#frm").validate();
})
</script>
</body>
</html>
