<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
 validate_admin();

  if($_REQUEST['submitForm']=='yes'){
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

    if($_REQUEST['id']==''){
      $obj->query("insert into $tbl_user set name='$name',surname='$surname',code='$code',mobile='$mobile',contact2='$contact2',city='$city',email='$email',address='$address',gst='$gst',bank_name='$bank_name',account_no='$account_no',ifsccode='$ifsccode',pass='$pass',user_type=2,status=1",$debug=-1); //die;
      $_SESSION['sess_msg']='Vender added successfully';  

    }else{ 
      $obj->query("update $tbl_user set name='$name',surname='$surname',mobile='$mobile',contact2='$contact2',city='$city',email='$email',address='$address',gst='$gst',bank_name='$bank_name',account_no='$account_no',ifsccode='$ifsccode',pass='$pass' where id=".$_REQUEST['id'],$debug=-1); //exit;
      $_SESSION['sess_msg']='Vender updated successfully';   
    }
    
    header("location:vender-list.php");
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
      <h1><?php if($_REQUEST['id']==''){?> ADD <?php }else{?> UPDATE <?php }?> VENDOR</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> HOME</a></li>
        <li><a href="vender-list.php">VIEW VENDOR LIST</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-default">
		<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
    <input type="hidden" name="brand_ids" id="brand_ids" value="<?php echo $result->brand;?>" />
        <div class="box-body">
	      <div class="row">
            
             
              <div class="col-md-3">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" name="name" value="<?php echo stripslashes($result->name); ?>" class="required form-control">
              </div>
              </div>
               <div class="col-md-3">
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="surname" value="<?php echo stripslashes($result->surname); ?>" class="required form-control">
              </div>
              </div>
               <div class="col-md-3">
               <div class="form-group">
               <label>Mobile No.</label>
                <input type="text" name="mobile" maxlength="10" value="<?php echo stripslashes($result->mobile); ?>" class="required form-control">
              </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
               <label>Mobile No. 2</label>
                <input type="text" name="contact2" maxlength="10" value="<?php echo stripslashes($result->contact2); ?>" class="form-control">
              </div>
            </div>
           <div class="col-md-3">
              <div class="form-group">
                <label>City</label>
                <input type="text" name="city" value="<?php echo stripslashes($result->city); ?>" class="required form-control">
              </div>
               
            </div>
          
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo stripslashes($result->email); ?>" class="required email form-control">
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Password</label>
                <input type="text" name="pass" id="pass" value="<?php echo stripslashes($result->pass); ?>" class="required form-control" maxlength="10">
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="text" name="cpass" equalTo="#pass" value="<?php echo stripslashes($result->pass); ?>" class="required form-control" maxlength="10">
              </div>
              </div>
              <div class="col-md-12">
              <div class="form-group">
              <label>Address</label>
              <textarea name="address" class="required form-control"><?php echo stripslashes($result->address); ?></textarea>
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>GST Number</label>
                <input type="text" name="gst" value="<?php echo stripslashes($result->gst); ?>" class="form-control">
              </div>
              </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Bank Name</label>
                <input type="text" name="bank_name" value="<?php echo stripslashes($result->bank_name); ?>" class="form-control">
              </div>
              </div>
               <div class="col-md-3">
               <div class="form-group">
               <label>Account No</label>
                <input type="text" name="account_no" value="<?php echo stripslashes($result->account_no); ?>" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
               <label>IFSC Code</label>
                <input type="text" name="ifsccode" value="<?php echo stripslashes($result->ifsccode); ?>" class="form-control">
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
<script type="text/javascript">
 $(document).ready(function(){
  $("#frm").validate();
$('#category').change(function() {

    <?php
    if($_REQUEST['id']!=''){?>
      var brandAr = $("#brand_ids").val();
    <?php }else{?>
      var brandAr='';
    <?php }?>
     var cat_id=$(this).val(); 
     $.ajax({
      url:"getVendorBrand.php",
      data:{cat_id:cat_id,brandar:brandAr},
      beforeSend:function(){
        $("#brand_id").html('<option value="">Select Brand</option>');
        },
      success:function(data){
        //console.log(data);
        $("#brand_id").append(data);
        }
      
      })
})

 })
</script> 
</body>
</html>
