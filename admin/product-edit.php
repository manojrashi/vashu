<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();

if($_REQUEST['submitForm']=='yes'){
  $title=$obj->escapestring($_POST['title']);
  $target_url=$obj->escapestring($_POST['target_url']);
  $description=$obj->escapestring($_POST['description']);
  $show_on_home=$obj->escapestring($_POST['show_on_home']);
  
  if($_FILES['photo']['size']>0 && $_FILES['photo']['error']==''){
    $Image=new SimpleImage();
    $img=time().$_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'],"../upload_images/banner/".$img);
    copy("../upload_images/banner/".$img,"../upload_images/banner/thumb/".$img);
    $Image->load("../upload_images/banner/thumb/".$img);
    $Image->resize(160,50);
    $Image->save("../upload_images/banner/thumb/".$img);
  }  

  if($_REQUEST['id']==''){
      $obj->query("insert into $tbl_banner set title='$title',target_url='$target_url',show_on_home='$show_on_home',description='$description',photo='$img',status=1 ");
      $_SESSION['sess_msg']='Banner added sucessfully';  
    }else{ 
      $sql="update $tbl_banner set  title='$title',show_on_home='$show_on_home',target_url='$target_url',description='$description',status=1 ";
      if($img){
        $imageArr=$obj->query("select photo from $tbl_banner where id=".$_REQUEST['id']);
        $resultImage=$obj->fetchNextObject($imageArr);
        @unlink("../upload_images/banner/".$resultImage->photo);
        @unlink("../upload_images/banner/thumb/".$resultImage->photo);
        $sql.=" , photo='$img' ";
      }
      $sql.=" where id='".$_REQUEST['id']."'";

      $obj->query($sql);
      $_SESSION['sess_msg']='Banner updated sucessfully';   
  }
  header("location:banner-list.php");
  exit();
}      


if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_banner where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> City</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="banner-list.php">View banner List</a></li>
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
                <label>Title</label>
                  <input type="text" name="title" value="<?php echo stripslashes($result->title); ?>" class="form-control">
              </div>
              <div class="form-group">
                <label>Description</label>
                  <input type="text" name="description" value="<?php echo stripslashes($result->description); ?>" class="form-control">
              </div>
			  </div>
			  <div class="col-md-6">
				  <div class="form-group">
						<label>Banner Image</label>
						<input type="file" name="photo" class='form-control' /><br/>
						<?php if(is_file("../upload_images/banner/thumb/".$result->photo)){ ?>
						<img src="../upload_images/banner/thumb/<?php echo $result->photo; ?>"  /><?php } ?>
				  </div>
				  <div class="form-group">
					<label>Target URL</label>
					  <input type="text" name="target_url" value="<?php echo stripslashes($result->target_url); ?>" class="form-control">
				  </div>
			  </div>
			  <div class="col-md-6">
              <div class="form-group">
                <label>Show on Home</label>
                 <input type="checkbox" name="show_on_home"  value="1" <?php if($result->show_on_home==1){?>checked<?php } ?>>
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
<script type="text/javascript" language="javascript">
function validate(obj)
{
if(obj.title.value==''){
alert("Please enter title");
obj.city.focus();
return false;
}
}
</script>
</body>
</html>
