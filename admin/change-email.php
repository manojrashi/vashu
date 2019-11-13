<?php
ob_start();
session_start(); 
include("../include/config.php");
include("../include/functions.php");
validate_admin();

if($_POST['submitForm']=="yes"){
	$email=$obj->escapestring($_POST['email']);
	$obj->query("update $tbl_admin set email='$email' where id=".$_SESSION['sess_admin_id']);
	$_SESSION['sess_msg']='Email updated sucessfully';
}
if($_SESSION['sess_admin_id']){
	$sql=$obj->query("select * from $tbl_admin where id=".$_SESSION['sess_admin_id'],$debug=-1);
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
      <h1>Change Admin Email</h1>
	  <div class="box-header">
               <?php if($_SESSION['sess_msg']){ ?><h3 class="box-title"><font color="#FF0000"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></font></h3> <?php }?>
            </div>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-default">
		<form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return valid(this)">
                <input type="hidden" name="submitForm" value="yes" />
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
			  <div class="form-group">
                <label>Admin Email:</label>
                 <input name="email" type="text" id="email" class="form-control"  value="<?php echo stripslashes($result->email);?>"/>
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

<script src="datepicker/bootstrap-datepicker.js"></script>
<script>
	function  valid(obj)
	{
	if(obj.email.value=='')
	{
	alert("Please enter email.");
	return false;
	}
	else if(!obj.email.value.match(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/))
	{
	alert("Please enter valid email.");
	return false;
	}
	else return true;
	}
	

</script>
</body>
</html>
