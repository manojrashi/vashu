<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");
validate_user();

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

if($_POST['submitForm'] == "yes") {
  $gst=$obj->escapestring($_POST['gst']);
  $name=$obj->escapestring($_POST['name']);
  $surname=$obj->escapestring($_POST['surname']);
  $mobile=$obj->escapestring($_POST['mobile']);
  $contact2=$obj->escapestring($_POST['contact2']);
  $city=$obj->escapestring($_POST['city']);
  $email=$obj->escapestring($_POST['email']);
  $address=$obj->escapestring($_POST['address']);
  $bank_name=$obj->escapestring($_POST['bank_name']);
  $account_no=$obj->escapestring($_POST['account_no']);
  $ifsccode=$obj->escapestring($_POST['ifsccode']);
  $pass = $obj->escapestring($_POST['pass']);
  $ccode = rand(1000,9999);
  $code =  strtoupper(substr($name,0,3)).$ccode;
  $dob=$obj->escapestring($_REQUEST['dob']);
  
  $dtob="";
  if($dob!=''){
    $dtob = ", dob='$dob'";
  }
  $about=$obj->escapestring($_REQUEST['about']);
  
  $obj->query("update $tbl_user set name='$name',surname='$surname',mobile='$mobile',contact2='$contact2',city='$city',email='$email',address='$address',gst='$gst',bank_name='$bank_name',account_no='$account_no',ifsccode='$ifsccode',about='$about' $dtob where id=".$_SESSION['user_id'],$debug=-1); //die;
  $_SESSION['sess_msg']='Customer updated successfully';
  header("location:dashboard.php");   
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
  <title><?php echo $EditProfile;?></title>
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
                <span onclick="file_explorer();"><i class="fa fa-upload"></i><?php echo $ChangeImage;?> </span>
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
                  <label>First Name</label>
                  <input type="text" name="name" value="<?php echo stripslashes($result->name); ?>" class="required form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 input1">
                <div class="grid__item">
                  <label>Last Name</label>
                  <input type="text" name="surname" value="<?php echo stripslashes($result->surname); ?>" class="required form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-4 input1">
                <div class="grid__item">
                  <label>Email</label>
                  <input type="text" name="email" value="<?php echo stripslashes($result->email); ?>" class="required email form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 input1">
                <div class="grid__item">
                  <label>Mobile No.</label>
                  <input type="text" name="mobile" maxlength="10" value="<?php echo stripslashes($result->mobile); ?>" class="required form-control">
                </div>
              </div>
              <?php
              if($_SESSION['user_type']!=2){?>
              <div class="col-xs-12 col-sm-6 input1">
                <div class="grid__item">
                  <label>Dateof Birth</label>
                  <input class="o-input" type="text" id="dob" name="dob" placeholder="Date of Birth" value="<?php echo $result->dob ?>">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 input1">
                <div class="grid__item">
                  <label>About us</label>
                  <textarea name="about" class="required form-control"><?php echo stripslashes($result->about); ?></textarea>
                </div>
              </div>
            <?php }?>

            <?php
             if($_SESSION['user_type']==2){?>
              <div class="col-xs-12 col-sm-6 input1">
                <div class="grid__item">
                  <label>MobileNo2.</label>
                  <input type="text" name="contact2" maxlength="10" value="<?php echo stripslashes($result->contact2); ?>" class="required form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 input1">
                <div class="grid__item">
                  <label>Address.</label>
                  <textarea name="address" class="required form-control"><?php echo stripslashes($result->address); ?></textarea>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 input1">
                <div class="grid__item">
                  <label>City</label>
                  <input type="text" name="city" value="<?php echo stripslashes($result->city); ?>" class="required form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 input1">
                <div class="grid__item">
                  <label>GSTNo.</label>
                  <input type="text" name="gst" value="<?php echo stripslashes($result->gst); ?>" class="form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 input1">
                <div class="grid__item">
                  <label>Bank Name</label>
                  <input type="text" name="bank_name" value="<?php echo stripslashes($result->bank_name); ?>" class="form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 input1">
                <div class="grid__item">
                  <label>Account No.</label>
                  <input type="text" name="account_no" value="<?php echo stripslashes($result->account_no); ?>" class="form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 input1">
                <div class="grid__item">
                  <label>IFSCCode</label>
                  <input type="text" name="ifsccode" value="<?php echo stripslashes($result->ifsccode); ?>" class="form-control">
                </div>
              </div>
            <?php }?>
              <div class="col-xs-12 col-sm-12 input1">
                <div class="grid__item">
                  <div class="footer-buttons">
                    <button type="submit" style="margin-bottom: 15px;" style="height: 40px; width: 50%">Update</button>
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
