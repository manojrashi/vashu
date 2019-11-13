<?php
session_start(); 
include("../include/config.php");
include("../include/functions.php");
validate_admin();

if($_POST['submitForm'] == "yes") {
  $old_password=$obj->escapestring($_POST['old_password']);
  $new_password=$obj->escapestring($_POST['new_password']);
  $confirm_password=$obj->escapestring($_POST['confirm_password']);

  if($new_password==$confirm_password){
    $query=$obj->query("select * from $tbl_admin where id=".$_SESSION['sess_admin_id'],$debug=-1);
    $result=$obj->fetchNextObject($query);

    if($old_password!=$result->password){ 
     $_SESSION['sess_msg']='Old Password is Wrong !';
    }else{
      $obj->query("update $tbl_admin set password='$new_password' where id=".$_SESSION['sess_admin_id']);
      $_SESSION['sess_msg']='Your password has been updated successfully !';
    }
  }else{
    $_SESSION['sess_msg']='Both password are not same!';
  }
}
if($_SESSION['sess_admin_id']){
  $sql=$obj->query("select * from $tbl_admin where id=".$_SESSION['sess_admin_id']);
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
      <h1>Change Password</h1>
      <div class="row">   
      <div class="col-md-12"><p style="text-align:center; color: red;"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
      </div>
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
                <label>Old  Password</label>
				        <input name="old_password" type="password" id="old_password" class="required form-control" value="<?php echo $_POST['old_password']; ?>" />
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>New Password</label>
                <input name="new_password" type="password" id="new_password" class="required form-control" value="<?php echo $_POST['new_password']; ?>" />
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Confirm Password</label>
                <input name="confirm_password" type="password" id="confirm_password" class="required form-control" value="<?php echo $_POST['confirm_password']; ?>" />
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
