<?php
//session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();


if($_REQUEST['submitForm']=='yes'){
  $name=$obj->escapestring($_REQUEST['name']);
  $surname=$obj->escapestring($_REQUEST['surname']);
  $email=$obj->escapestring($_REQUEST['email']);
  $mobile=$obj->escapestring($_REQUEST['mobile']);


  if($_REQUEST['id']==''){
$obj->query("insert into $tbl_user set name='$name',surname='$surname',email='$email',mobile='$mobile',register_date=now()",$debug=-1); //die;
$_SESSION['sess_msg']='Customer added successfully';  

}else{ 	  
$obj->query("update $tbl_user set name='$name',surname='$surname',email='$email',mobile='$mobile' where id ='".$_REQUEST['id']."'",$debug=-1); //die;
$_SESSION['sess_msg']='Customer updated successfully';   
}
header("location:user-list.php");
exit();
}      


if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_user where id=".$_REQUEST['id']);
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
        <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> Customer</h1>
        <ol class="breadcrumb">
          <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="user-list.php">View Customer List</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-primary">
          <form name="customerfrm" id="customerfrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
            <input type="hidden" name="submitForm" value="yes" />
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="required form-control" value="<?php echo $result->name; ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Sur Name</label>
                    <input type="text" name="surname" class="required form-control" value="<?php echo $result->surname; ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $result->email; ?>" readonly>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Mobile No.</label>
                    <input type="text" name="mobile" class="required form-control" maxlength="10" value="<?php echo $result->mobile; ?>">
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
      $("#customerfrm").validate();
    })
  </script>
</body>
</html>
