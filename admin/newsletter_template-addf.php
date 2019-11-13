<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();



  $description=$obj->escapestring($_POST['description']);
  $title=$obj->escapestring($_POST['title']);
  
  if($_REQUEST['submitForm']=='yes'){
  if($_REQUEST['id']==''){
	  $obj->query("insert into $tbl_newsletter_template set title='$title',description='$description',posted_date=now(),status=1 ");
	  $_SESSION['sess_msg']='Newsletter Template added sucessfully';  
	  
       }else{ 
	  $sql="update $tbl_newsletter_template set title='$title',description='$description',posted_date=now()";
	  $sql.=" where id='".$_REQUEST['id']."'";
	  $obj->query($sql);
	  $_SESSION['sess_msg']='Newsletter Template updated sucessfully';   
    }
   header("location:newsletter_template-list.php");
   exit();
  }     


if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from tbl_newsletter_template where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> Newsletter Template</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="newsletter_template-list.php">View Newsletter Template List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
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
            </div>
            
            
         
          <div class="col-md-12">
             <div class="form-group">
              <label>Template Details</label>
                <textarea name="description"  class="ckeditor form-control" id="description" rows="5"><?php echo stripslashes($result->description); ?></textarea>
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
obj.title.focus();
return false;
}

}
</script>
</body>
</html>
