<?php
//session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
 validate_admin();
  

  if($_REQUEST['submitForm']=='yes'){
    $category=$obj->escapestring($_REQUEST['category']);
    $order_date=$_REQUEST['order_date'];
    $order_id =$obj->escapestring($_REQUEST['order_id']);
    $name=$obj->escapestring($_REQUEST['name']);
    $mobile=$obj->escapestring($_REQUEST['mobile']);
    $order_amount=$obj->escapestring($_REQUEST['order_amount']);
    $updated_amount=$obj->escapestring($_REQUEST['updated_amount']);
    $received_amount=$obj->escapestring($_REQUEST['received_amount']);
    $transection_no=$obj->escapestring($_REQUEST['transection_no']);
    $recharhe_mode=$obj->escapestring($_REQUEST['recharhe_mode']);
    $order_status=$obj->escapestring($_REQUEST['order_status']);
    $pos_name=$obj->escapestring($_REQUEST['pos_name']);
    $pos_no=$obj->escapestring($_REQUEST['pos_no']);
    $remarks=$obj->escapestring($_REQUEST['remarks']);
    $type = 1;

    $CSql = "";
    
    if($category!=''){
      $CSql .="category='$category'";
    }
    if($type!=''){
      $CSql .=", type='1'";
    }
    if($order_date!=''){
     $CSql .=", order_date='$order_date'";
    }
    if($order_id!=''){
      $CSql .=", order_id='$order_id'";
    }
    if($name!=''){
      $CSql .=", name='$name'";
    }
    if($mobile!=''){
     $CSql .=", mobile='$mobile'";
    }
    if($order_amount!=''){
     $CSql .=", order_amount='$order_amount'";
    }
    if($updated_amount!=''){
     $CSql .=", updated_amount='$updated_amount'";
    }
    if($received_amount!=''){
     $CSql .=", received_amount='$received_amount'";
    }
    if($transection_no!=''){
     $CSql .=", transection_no='$transection_no'";
    }
    if($recharhe_mode!=''){
     $CSql .=", recharhe_mode='$recharhe_mode'";
    }
    if($order_status!=''){
     $CSql .=", order_status='$order_status'";
    }
    if($pos_name!=''){
     $CSql .=", pos_name='$pos_name'";
    }
    if($pos_no!=''){
     $CSql .=", pos_no='$pos_no'";
    }
    if($remarks!=''){
     $CSql .=", remarks='$remarks'";
    }

  if($_REQUEST['id']==''){
    $obj->query("insert into $tbl_onlinecash set $CSql ,posted_by='".$_SESSION['sess_admin_id']."'",$debug=-1); //exit;

    $_SESSION['sess_msg']='Customer added successfully';  

    }else{ 	  
    $sql=" update $tbl_onlinecash set $CSql ,posted_by='".$_SESSION['sess_admin_id']."'";

    $sql.=" where id='".$_REQUEST['id']."'";
    $obj->query($sql);
    $_SESSION['sess_msg']='Online Cash updated successfully';   
    }
    header("location:onlineicash-list.php");
    exit();
  }      
	   
	   
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_onlinecash where id=".$_REQUEST['id']);
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
      <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> Incoming Payment</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="onlineicash-list.php">View Online Incoming Payment List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
		<form name="customerfrm" id="customerfrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Type </label><br/>
                <select name="category" id="category" class="required form-control">
                  <option value="">Select</option>
                  <option value="1" <?php if($result->category=='1'){?> selected <?php } ?>>Credit/Debit</option>
                  <option value="2" <?php if($result->category=='2'){?> selected <?php } ?>>E-wallet Recharge</option>
                  <option value="3" <?php if($result->category=='3'){?> selected <?php } ?>>Order Payments (COD)</option>
                  <option value="4" <?php if($result->category=='4'){?> selected <?php } ?>>E-wallet Payment</option>
                  
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Date</label>
               <input type="text" name="order_date" id="order_date" class="required form-control" value="<?php echo $result->order_date; ?>">
              </div>
            </div>
            <div class="col-md-3 orderid">
              <div class="form-group">
                <label>Order Id</label>
                <input type="text" name="order_id" class="form-control" value="<?php echo $result->order_id; ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Name</label>
				        <input type="text" name="name" class="required form-control" value="<?php echo $result->name; ?>">
              </div>
            </div>
             <div class="col-md-3">
              <div class="form-group">
                <label>Mobile</label>
				        <input type="text" name="mobile" class="required form-control" value="<?php echo $result->mobile; ?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label id="amt">Order Amount</label>
                <input type="text" name="order_amount" id="order_amount" class="required form-control" value="<?php echo $result->order_amount; ?>">
              </div>
            </div>
            <div class="col-md-3 updatedamt">
              <div class="form-group">
                <label>Updated Amount</label>
                <input type="text" name="updated_amount" id="updated_amount" class="form-control" value="<?php echo $result->updated_amount; ?>">
              </div>
            </div>
            <div class="col-md-3 receivedamt">
              <div class="form-group">
                <label class="recamt">Received Amount</label>
                <input type="text" name="received_amount" id="received_amount" class="form-control" value="<?php echo $result->received_amount; ?>">
              </div>
            </div>
             <div class="col-md-3">
              <div class="form-group">
                <label>Transaction Number</label>
                <input type="text" name="transection_no" id="transection_no" class="required form-control" value="<?php echo $result->transection_no; ?>">
              </div>
            </div>
              <div class="col-md-3 rechargemode" style="display: none;">
              <div class="form-group">
                <label>Recharge Mode</label>
                <select name="recharhe_mode" id="recharhe_mode" class="form-control">
                  <option value="">Select</option>
                  <option value="Online" <?php if($result->vehicle_type=='Online'){?> selected <?php } ?>>Online</option>
                  <option value="Back-end" <?php if($result->vehicle_type=='Back-end'){?> selected <?php } ?>>Back-end</option>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Order Status</label>
                <select name="order_status" id="order_status" class="required form-control">
                  <option value="">Select</option>
                  <option value="Failed" <?php if($result->recharhe_mode=='Failed'){?> selected <?php } ?>>Failed</option>
                  <option value="Successful" <?php if($result->recharhe_mode=='Successful'){?> selected <?php } ?>>Successful</option>
                </select>
              </div>
            </div>
           
            <div class="col-md-3 pospayment">
              <div class="form-group">
                <label>POS Name</label>
                <input type="text" name="pos_name" id="pos_name" class="form-control" value="<?php echo $result->pos_name; ?>">
              </div>
            </div>
            <div class="col-md-3 pospayment">
              <div class="form-group">
                <label>POS Number</label>
                <input type="text" name="pos_no" id="pos_no" class="form-control" value="<?php echo $result->pos_no; ?>">
              </div>
            </div>
             </div>
            <div class="row">
                <div class="col-md-12">
              <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" id="remarks" class="form-control"><?php echo $result->remarks; ?></textarea>
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
  $(".ewalletrecharge").hide();
  $("#customerfrm").validate();

  $("#Cashchequeneftdebitcredit").hide();
  $(".classcheque").hide();
  $(".classneft").hide();
  $(".classdebitcredit").hide();

  $("#category").change(function(){
     val = $(this).val();
     if(val==1){
      $(".pospayment").show();
      $(".rechargemode").hide();
      $(".receivedamt").show();
      $("#amt").html('Order Amount');
      $(".orderid").show();
      $(".updatedamt").show();
      $(".recamt").html('Received Amount');
     }else if(val==2){
      $(".pospayment").hide();
      $(".rechargemode").show();
      $("#amt").html('Recharge Amount');
      $(".receivedamt").hide();
      $(".orderid").hide();
      $(".updatedamt").show();
     }else if(val==3 || val==4){
      $(".pospayment").hide();
      $(".rechargemode").hide();
      $(".receivedamt").show();
      $("#amt").html('Order Amount');
      $(".orderid").show();
      $(".updatedamt").hide();
      $(".recamt").html('Paid Amount');
     }
  });


})
</script>
<link rel="stylesheet" href="calender/css/jquery-ui.css">
  <script src="calender/js/jquery-ui.js"></script>
  <script>
    $(function() {
        $( "#order_date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+20?>',
        dateFormat: "yy-mm-dd",
        });
        $( "#cheque_date" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+20?>',
        dateFormat: "yy-mm-dd",
        });
       
    });
    </script>
</body>
</html>
