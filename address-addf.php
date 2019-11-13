<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");
validate_user();

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();
echo $id=$_SESSION['user_id'];

if($_POST['submitForm'] == "yes") {
  $address=$obj->escapestring($_POST['address']);

  if($_REQUEST['id']==''){
         
  $obj->query("insert $tbl_useraddress set user_id='$id',address='$address'",-1); 

  //die;
   $_SESSION['sess_msg']=' User Address added successfully';
}else{
  $obj->query("update $tbl_useraddress set address='$address' where id=".$_REQUEST['id'],-1); //die;

  $_SESSION['sess_msg']='User address updated sucessfully'; 
}
 
  header("location:address.php");   
}


if($_REQUEST['id']){
  $sql=$obj->query("select * from $tbl_useraddress where id=".$_REQUEST['id']);
  $result=$obj->fetchNextObject($sql);
  //print_r($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Address</title>
  <link href="css/user_style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <?php include("head.php"); ?>
</head>
<body>
  <?php include("header.inc.php"); ?>
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
                <span onclick="file_explorer();"><i class="fa fa-upload"></i>Change Image</span>
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
            <input type="hidden" name="submitForm" value="yes" />
             <div class="col-xs-12 col-sm-4 input1">
                <div class="grid__item">
                  <label>Address</label>
                  <input type="text" name="address" value="<?php echo stripslashes($result->address); ?>" class="required form-control">
                </div>
              </div>                                                  
            
              <div class="col-xs-12 col-sm-12 input1">
                <div class="grid__item">
                  <div class="footer-buttons">
                    <button type="submit" style="margin-bottom: 15px;" style="height: 40px; width: 50%">Add</button>
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
  <link rel="stylesheet" href="admin/calender/css/jquery-ui.css">
  <script src="admin/calender/js/jquery-ui.js"></script>
  <script>
    $(function() {
      $( "#dob" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-80?>:<?php echo date('Y')-10?>',
        dateFormat: "yy-mm-dd",
      });

    });
  </script>
</body>
</html>
