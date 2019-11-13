<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
 validate_admin();
  $category = $obj->escapestring($_POST['category']);
  if($_REQUEST['submitForm']=='yes'){
    if($_REQUEST['id']==''){
      $obj->query("insert into $tbl_faqcat set category='$category',status=1",$debug=-1);
      $_SESSION['sess_msg']='FAQ Category  added successfully';  
    }else{     
      $sql=" update $tbl_faqcat set category='$category'";
      $sql.=" where id='".$_REQUEST['id']."'";
      $obj->query($sql);
      $_SESSION['sess_msg']='FAQ Category updated successfully';   
    }
     header("location:faqcat-list.php");
     exit();
  }      
     
     
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_faqcat where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> FAQ Category</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="faqcat-list.php">View FAQ Category List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
		<form name="frm" id="faqcategoryfrm" method="POST" enctype="multipart/form-data" action="">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Category Name</label>
				        <input type="text" name="category" value="<?php echo stripslashes($result->category); ?>" class="required form-control">
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
    $("#faqcategoryfrm").validate();
})
</script>
</body>
</html>
