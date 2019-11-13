<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");
validate_user();

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

if($_POST['submitForm'] == "yes") {
   $old_password=$obj->escapestring($_POST['old_password']);
   $new_password=$obj->escapestring($_POST['new_password']);
   $confirm_password=$obj->escapestring($_POST['confirm_password']);

  if($new_password==$confirm_password){
    $query=$obj->query("select * from $tbl_user where id=".$_SESSION['user_id'],$debug=-1);
    $result=$obj->fetchNextObject($query);
    if($old_password!=$result->pass){ 
     $_SESSION['sess_msg']='Old Password is Wrong !';
   }else{
    $obj->query("update $tbl_user set pass='$new_password' where id=".$_SESSION['user_id']);
    $_SESSION['sess_msg']='Your password has been updated successfully !';
  }
}else{
  $_SESSION['sess_msg']='Both password are not same!';
}
}


if($_SESSION['user_id']){
  $sql=$obj->query("select * from $tbl_user where id=".$_SESSION['user_id']);
  $result=$obj->fetchNextObject($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change Password</title>
  <link href="css/user_style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <?php include("head.php"); ?>
</head>
<body>
  <?php include("header.inc.php"); ?>
  <?php
  $itmes=$cart->get_contents();
  ?>
  <section id="desboard">

    <div class="container">
      <div class="col-xs-12 col-sm-3">
        
        <div class="userleft-main">
         <div class="user">
          <div id="set_images">
            <figure>
            <?php if($result->photo){ ?>
              <img src="upload_images/user/tiny/<?php echo $result->photo; ?>"> 
            <?php }else{ ?>
              <img src="images/blank-gallery.png">
            <?php } ?>
          </figure>
          </div>
         
         <div class="userimage">
           <form method="POST" enctype="multipart/form-data" action="change-image.php">
             <span onclick="file_explorer();"><i class="fa fa-upload"></i>Change Image </span>
            <input type="file" id="selectfile" style="display: none;">
            </form>
          </div>
        </div>
      </div>
      
      <div class="userliftbaarmain">
       <?php include('sidebar.php'); ?>
     </div>
   </div>
   <div class="col-xs-12 col-sm-9">
    <div class="right-site">
      <div class="col-xs-12 col-sm-12 background">
        
        <form id="frm"  method="POST" enctype="multipart/form-data" action="">
      <p style="text-align:center; color: red;"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p>

      <input type="hidden" name="submitForm" value="yes" />
      <div class="col-xs-12 col-sm-9 right">

         <div class="col-xs-12 col-sm-12 input1">
          <div class="grid__item">
            <label>Old Password</label>
            <input class="o-input required" type="text" id="old_password" name="old_password" placeholder="<?php echo $OldPassword; ?>">
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 input1">
          <div class="grid__item">
            <label>New Password</label>
            <input class="o-input required" type="text" id="new_password" name="new_password" placeholder="<?php echo $NewPassword;?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 input1">
          <div class="grid__item">
            <label>Confirm Password</label>
            <input class="o-input required" type="text" id="confirm_password" name="confirm_password" placeholder="<?php echo $ConfirmPassword;?>*">
          </div>
        </div>
         <div class="col-xs-12 col-sm-6 input1">
        <div class="grid__item">

          <div class="footer-buttons">
            <button type="submit" style="width: 230px; height: 40px; margin: 8px;">Change Password</button>
          </div>
        </div>
      </div>
      </div>

    </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include("footer.inc.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="loginnew_page/slider.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="admin/js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#frm").validate();
  })
</script>
</body>
</html>
