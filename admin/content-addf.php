<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();

if($_REQUEST['submitForm']=='yes'){
	$title=$obj->escapestring($_POST['title']);
	$slug = generateSlug($title);
	$content=$obj->escapestring($_POST['content']);
	$meta_tags = $_POST['meta_tags'];

	if($_REQUEST['id']==''){
		$obj->query("insert into $tbl_content set title='$title',slug='$slug',content='".$content."',status=1,meta_tags='$meta_tags'");
		$_SESSION['sess_msg']='Content added successfully';  
	}else{ 
		$obj->query("update $tbl_content set title='$title',slug='$slug',content='".$content."',status=1,meta_tags='$meta_tags' where id=".$_REQUEST['id'],$debug=-1); //die;
		$_SESSION['sess_msg']='Content updated successfully';   
	}
	header("location:content-list.php");
	exit();
}      

if($_REQUEST['id']!=''){
	$sql=$obj->query("select * from $tbl_content where id=".$_REQUEST['id']);
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
				<h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update<?php } ?> Page</h1>
				<ol class="breadcrumb">
					<li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="content-list.php">View Pages</a></li>
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
										<label>Title</label>
										<input name="title" type="text" id="title" class="form-control" value="<?php echo stripslashes($result->title);?>"/>
									</div>

								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Content</label>
										<textarea name="content" rows="10" cols="80" class="ckeditor form-control" id="content"><?php echo stripslashes($result->content);?></textarea>
									</div>
								</div>
								<div class="col-md-6">

									<div class="form-group">
										<label>Meta Title</label>
										<textarea name="meta_tags" class="form-control" rows="4"><?php echo stripslashes($result->meta_tags); ?></textarea>
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
		<script type="text/javascript">
			$(document).ready(function(){
				$("#frm").validate();
			})
		</script>
		<script type="text/javascript" src="../include/ckeditor/ckeditor.js"></script>
	</body>
	</html>
