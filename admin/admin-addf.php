<?php
session_start();
include("../include/config.php");
include("../include/functions.php");
validate_admin();

if($_REQUEST['submitForm']=='yes'){
  $emp_name=$obj->escapestring($_POST['emp_name']);
  $emp_surname=$obj->escapestring($_POST['emp_surname']);
  $emp_email=$obj->escapestring($_POST['emp_email']);
  $emp_mobile1=$obj->escapestring($_POST['emp_mobile1']);
  $emp_email=$obj->escapestring($_POST['emp_email']);
  $username=$obj->escapestring($_POST['username']);
  $password=$obj->escapestring($_POST['password']);
 

if($_REQUEST['id']==''){
  $userArr=$obj->query("select * from $tbl_admin where  username='$username'");
  if($obj->numRows($userArr)<1){
    $obj->query("insert into $tbl_admin set username='$username',password='$password',emp_email='$emp_email',emp_name='$emp_name',emp_surname='$emp_surname',emp_mobile1='$emp_mobile1',register_date=now(),user_type='admin'",$debug=-1); //die;
    $_SESSION['sess_msg']='admin added sucessfully'; 
    header("location:admin-list.php");
    exit();
  }else{
    $_SESSION['sess_msg']='This admin already regisred,Plese choose another Login Username';    
  }

}else{
  $sql = "update $tbl_admin set emp_email='$emp_email',emp_name='$emp_name',emp_surname='$emp_surname',emp_mobile1='$emp_mobile1' where id='".$_REQUEST['id']."'";
  $obj->query($sql);
  $_SESSION['sess_msg']='admin updated sucessfully';  
}
header("location:admin-list.php");
exit(); 
}

if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_admin where id=".$_REQUEST['id']);
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
        <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> Admin</h1>
        <ol class="breadcrumb">
          <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="admin-list.php">View Admin</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-default">
          <form name="frm" id="adminfrm" method="POST" enctype="multipart/form-data" action="">
            <input type="hidden" name="submitForm" value="yes" />
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>First Name</label>
                    <input name="emp_name" type="text" id="emp_name" class="required form-control" value="<?php echo stripslashes($result->emp_name);?>" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input name="emp_surname" type="text" id="emp_surname" class="required form-control" value="<?php echo stripslashes($result->emp_surname);?>" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Mobile </label>
                    <input name="emp_mobile1" type="text" id="emp_mobile1" maxlength="10" class="required form-control" value="<?php echo stripslashes($result->emp_mobile1);?>" />
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email</label>
                    <input name="emp_email" type="text" id="emp_email" class="form-control" value="<?php echo stripslashes($result->emp_email);?>" />
                  </div>
                </div>
              
                <?php
                if($_REQUEST['id']==''){?>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>User Name</label>
                    <input type="text" name="username" class="required form-control" value="<?php echo stripcslashes($result->username) ?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" class="required form-control" value="<?php echo stripcslashes($result->password) ?>">
                  </div>
                </div>
                <?php }?>

              </div>
           </div>
            <div class="box-footer">
              <input type="submit" name="submit" value="Submit"  class="button" border="0"/>&nbsp;&nbsp;
              <input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
            </div>
          </div>
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
<script src="js/select2.full.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $(".select2").select2();
  $(document).ready(function(){
    $("#adminfrm").validate();

    $("#department").change(function(){
      userid = $(this).val();
      $.ajax({
        url:"ajax_get_role.php",
        type:"POST",
        data:{userid,userid},
        success:function(data)
        {
          $("#designation").html(data);
        }
      })


    })
  })
</script>
</body>
</html>
