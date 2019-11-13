<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
if($_REQUEST['submitForm']=='yes'){

  $mobile=$obj->escapestring($_POST['mobile']);
  $email=$obj->escapestring($_POST['email']);
  $address=$obj->escapestring($_POST['address']);
  $landline=$obj->escapestring($_POST['landline']);
  $minimum_purchase=$obj->escapestring($_POST['minimum_purchase']);
  $delivery_charge=$obj->escapestring($_POST['delivery_charge']);
  
$obj->query("update $tbl_setting set mobile='$mobile',email='$email',landline='$landline',address='$address',minimum_purchase='$minimum_purchase',delivery_charge='$delivery_charge' where id=1",$debug=-1); //die;
$_SESSION['sess_msg']='Setting updated successfully';
}      

$sql=$obj->query("select * from $tbl_setting where id=1");
$result=$obj->fetchNextObject($sql);
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
        <div class="row">
          <div class="col-md-3">
            <h4>Manage Setting</h4>
          </div>
          <div class="col-md-9">
            <p style="text-align:left; margin-left: 200px;">
              <?php if($_SESSION[ 'sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> 
            <?php }?>
          </p>
        </div>

      </div>
    </section>
    <section class="content">
      <div class="box box-default">
        <form name="frm" method="POST" enctype="multipart/form-data" action="" onSubmit="return validate(this)">
          <input type="hidden" name="submitForm" value="yes" />
          <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
          <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Mobile</label>
                  <input name="mobile" type="text" id="mobile" class='form-control' maxlength="10" size="36" value="<?php echo stripslashes($result->mobile);?>" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Phone</label>
                  <input name="landline" type="text" id="landline" class='form-control' size="36" value="<?php echo stripslashes($result->landline);?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" type="text" id="email" class='form-control' size="36" value="<?php echo stripslashes($result->email);?>" />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Minimum Purchase Amount (<?php echo $website_currency_code; ?>)</label>
                  <input name="minimum_purchase" type="text" id="minimum_purchase" class='form-control' size="36" value="<?php echo stripslashes($result->minimum_purchase);?>" />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Delivery Charges (<?php echo $website_currency_code; ?>)</label>
                  <input name="delivery_charge" type="number" id="delivery_charge" class='form-control' size="36" value="<?php echo stripslashes($result->delivery_charge);?>" />
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Address</label>
                  <textarea name="address" id="address" rows="5" cols="30" class='form-control'><?php echo stripslashes($result->address);?></textarea>
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
</body>
</html>
