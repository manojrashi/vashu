<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");
v_validate_user();

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

if($_REQUEST['submitForm']=='yes'){
    $gst=$obj->escapestring($_POST['gst']);
    $vender_name=$obj->escapestring($_POST['vender_name']);
    $contact1=$obj->escapestring($_POST['contact1']);
    $contact2=$obj->escapestring($_POST['contact2']);
    $contact3=$obj->escapestring($_POST['contact3']);
    $city=$obj->escapestring($_POST['city']);
    $email=$obj->escapestring($_POST['email']);
    $address=$obj->escapestring($_POST['address']);
    $bank_name=$obj->escapestring($_POST['bank_name']);
    $account_no=$obj->escapestring($_POST['account_no']);
    $ifccode=$obj->escapestring($_POST['ifccode']);
    $pass = $obj->escapestring($_POST['pass']);
    $ccode = rand(1000,9999);
    $code =  strtoupper(substr($vender_name,0,3)).$ccode;

      $obj->query("update $tbl_vender set vender_name='$vender_name',contact1='$contact1',contact2='$contact2',contact3='$contact3',city='$city',email='$email',address='$address',gst='$gst',bank_name='$bank_name',account_no='$account_no',ifccode='$ifccode' where id='".$_SESSION['v_user_id']."'",$debug=-1); //die;
      $_SESSION['sess_msg']='Vender updated successfully'; 
      header("location:vendor-dashboard.php");
      exit;
  }    

if($_SESSION['v_user_id']){
  $sql=$obj->query("select * from $tbl_vender where id=".$_SESSION['v_user_id']);
  $result=$obj->fetchNextObject($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profile</title>
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
            <!--<input type="file" name="file"> -->
            <span onclick="file_explorer();"><i class="fa fa-upload"></i>Change Image </span>
            <input type="file" id="selectfile" style="display: none;">
            </form>
          </div>
        </div>
      </div>
      
      <div class="userliftbaarmain">
       <?php include('vendor-sidebar.php'); ?>
     </div>
   </div>
   <div class="col-xs-12 col-sm-9">
    <div class="right-site">
      <div class="col-xs-12 col-sm-12 background">
        
      <form id="frm"  method="POST" enctype="multipart/form-data" action="">
       
      <input type="hidden" name="submitForm" value="yes" />
     

        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>Vendor Name</label>
            <input class="required o-input valid" type="text" id="vender_name" name="vender_name" allowdefault="false" placeholder="Name *" value="<?php echo $result->vender_name; ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>Contact No. 1</label>
            <input class="required digits o-input valid" type="text" id="contact1" name="contact1" aria-label="Contact No. 1" allowdefault="false" placeholder="Contact No. 1 *" value="<?php echo $result->contact1; ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>Contact No. 2</label>
            <input class="required digits o-input" type="text" id="contact2" name="contact2" aria-label="Contact No. 2" allowdefault="false" placeholder="Contact No. 2 *" value="<?php echo $result->contact2; ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>Contact No. 3</label>
            <input class="required digits o-input" type="text" id="contact3" name="contact3" aria-label="Contact No. 3" allowdefault="false" placeholder="Contact No. 3" value="<?php echo $result->contact3; ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>City</label>
            <input class="required o-input" type="text" id="city" name="city" aria-label="City" allowdefault="false" placeholder="City" value="<?php echo $result->city ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>Email</label>
            <input class="required email o-input" type="text" id="email" name="email" aria-label="Email" allowdefault="false" placeholder="Email" value="<?php echo $result->email; ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 input1">
          <div class="grid__item">
            <label>Address</label>
            <textarea name="address" placeholder="Address"><?php echo $result->address; ?></textarea>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>GST No.</label>
            <input class="o-input" type="text" id="gst" name="gst" aria-label="GST Number" allowdefault="false" placeholder="GST Number" value="<?php echo $result->gst; ?>">
          </div>
        </div>
         <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>Bank Name</label>
            <input class="o-input" type="text" id="bank_name" name="bank_name" placeholder="Bank Name" value="<?php echo $result->bank_name; ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>Account No.</label>
            <input class="o-input" type="text" id="account_no" name="account_no" placeholder="Account No." value="<?php echo $result->account_no; ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 input1">
          <div class="grid__item">
            <label>IFSC Code</label>
            <input class="o-input" type="text" id="ifccode" name="ifccode" placeholder="IFSC Code" value="<?php echo $result->ifccode; ?>">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12">
        <div class="footer-buttons">
            <button type="submit" style="margin-bottom: 15px;">Update</button>
          </div>
        </div>
    </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include("footer.inc.php"); ?>
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
