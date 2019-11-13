<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
//Image Crop
include("./thumb_functions.php");
define('IMAGE_SMALL_DIR', '../upload_images/category/thumb/');
define('IMAGE_SMALL_SIZE', 150);
/*******************End ********************************/

validate_admin();



if($_REQUEST['submitForm']=='yes')	
{	
	$cat_id = $obj->escapestring($_POST['cat_id']);
	$subcategory=$obj->escapestring($_POST['subcategory']);
	$slug = generateSlug($subcategory);
	$meta_tags=$obj->escapestring($_POST['meta_tags']);

	if($_FILES['image_upload_file']['tmp_name'])
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
			$path[0] = $_FILES['image_upload_file']['tmp_name'];
			$file = pathinfo($_FILES['image_upload_file']['name']);
			$fileType = $file["extension"];
			$desiredExt='jpg';
			$fileNameNew = rand(333, 999) . time() . ".$desiredExt";
			$path[1] = IMAGE_SMALL_DIR . $fileNameNew;
			if (createThumb($path[0], $path[1], $fileType, IMAGE_SMALL_SIZE, IMAGE_SMALL_SIZE,IMAGE_SMALL_SIZE)) {
				$output['status']=TRUE;
				$output['image_small']= $path[1];
			}
			move_uploaded_file($_FILES['image_upload_file']['tmp_name'],"../upload_images/category/".$fileNameNew);
		}			  	
	}

	if($_REQUEST['id']=='')
	{

		$obj->query("insert into $tbl_subcategory set cat_id='$cat_id',subcategory='$subcategory',meta_tags='$meta_tags',cimage='$fileNameNew',status=1",$debug=-1); //die;
		$_SESSION['sess_msg']='Sub Category added sucessfully';  
	}
	else
	{ 

		$sql="Select cimage from $tbl_subcategory where id=".$_REQUEST['id'];
		$imgquery=$obj->fetchNextObject($obj->query($sql));
		if($fileNameNew!='')
		{
			$fileNameNew=$fileNameNew;
			if(!empty($imgquery->cimage) || $imgquery->cimage!='')
			{
			unlink("../upload_images/category/".$imgquery->cimage);
			unlink("../upload_images/category/thumb/".$imgquery->cimage);
		}
		}else{
			$fileNameNew=$_REQUEST['imagename'];
		}
	
		$obj->query("update $tbl_subcategory set cat_id='$cat_id',subcategory='$subcategory',cimage='$fileNameNew',slug='$slug',meta_tags='$meta_tags' where id=".$_REQUEST['id']);
		$_SESSION['sess_msg']='Sub Category updated sucessfully';   
	}
	header("location:subcategory-list.php");
	exit();
}      	      
if($_REQUEST['id']!='')
{
	$sql=$obj->query("select * from $tbl_subcategory where id=".$_REQUEST['id'],$debug=-1);
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
			<h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> Sub Category</h1>
			<ol class="breadcrumb">
				<li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="subcategory-list.php">View Sub Category List</a></li>
			</ol>
		</section>
		<section class="content">
			<div class="box box-default">
				<form name="frm" method="POST" enctype="multipart/form-data" action="" onSubmit="return validate(this)">
					<input type="hidden" name="submitForm" value="yes" />
					<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Category:</label>
									<select name="cat_id" id="cat_id" class="form-control">
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
							<div class="col-md-6">
								<div class="form-group">
									<label>Sub Category:</label>
									<input name="subcategory" type="text" id="subcategory" class="form-control" value="<?php echo stripslashes($result->subcategory);?>" />
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label>Category Image :</label>
									<input type="hidden" name="imagename" value="<?php echo $result->cimage  ?>">
									<input type="file" name="image_upload_file" class='form-control' /><br/>
									<?php if(is_file("../upload_images/category/thumb/".$result->cimage)){ ?>
										<img src="../upload_images/category/thumb/<?php echo $result->cimage; ?>"  /><?php } ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Meta Tags:</label>
										<textarea name="meta_tags" rows="6" class="form-control"><?php echo stripslashes($result->meta_tags); ?></textarea>
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

</body>
</html>
