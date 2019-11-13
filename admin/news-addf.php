<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();

if($_REQUEST['submitForm']=='yes'){
  $title_en=$obj->escapestring($_POST['title']);
  $slug = generateSlug($title_en);
  $content=$obj->escapestring($_POST['content']);
  $target_url=$obj->escapestring($_POST['target_url']);
  
  if($_FILES['photo']['size']>0 && $_FILES['photo']['error']==''){
    $Image=new SimpleImage();
    $img=time().$_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'],"../upload_images/news/".$img);
    copy("../upload_images/news/".$img,"../upload_images/news/thumb/".$img);
    $Image->load("../upload_images/news/thumb/".$img);
    $Image->resize(350,277);
    $Image->save("../upload_images/news/thumb/".$img);

    copy("../upload_images/news/".$img,"../upload_images/news/big/".$img);
    $Image->load("../upload_images/news/big/".$img);
    $Image->resize(825,440);
    $Image->save("../upload_images/news/big/".$img);
  }  

  if($_REQUEST['id']==''){
      $obj->query("insert into $tbl_news set title='$title',slug='$slug',content='$content',photo='$img'",$debug=-1); //die;
      $_SESSION['sess_msg']='Banner added sucessfully';  
    }else{ 
      $sql="update $tbl_news set title='$title',slug='$slug',content='$content'";
      if($img){
        $imageArr=$obj->query("select photo from $tbl_news where id=".$_REQUEST['id']);
        $resultImage=$obj->fetchNextObject($imageArr);
        @unlink("../upload_images/news/".$resultImage->photo);
        @unlink("../upload_images/news/thumb/".$resultImage->photo);
        $sql.=" , photo='$img' ";
      }
      $sql.=" where id='".$_REQUEST['id']."'";
      //echo $sql; die;
      $obj->query($sql);
      $_SESSION['sess_msg']='News updated sucessfully';   
  }
  header("location:news-list.php");
  exit();
}      


if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_news where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> News</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="news-list.php">View News List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
		<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Title</label>
                  <input type="text" name="title" value="<?php echo stripslashes($result->title); ?>" class="required form-control">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Description</label>
                  <textarea name="content" rows="10" cols="80" class="ckeditor form-control" id="content"><?php echo stripslashes($result->content);?></textarea>
              </div>
            </div>
          
  			  <div class="col-md-6">
				  <div class="form-group">
						<label>Image</label>
						<input type="file" name="photo" class='form-control' /><br/>
						<?php if(is_file("../upload_images/news/thumb/".$result->photo)){ ?>
						<img src="../upload_images/news/thumb/<?php echo $result->photo; ?>"  /><?php } ?>
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
<script type="text/javascript" src="../include/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#frm").validate();
  })
</script>
</body>
</html>
