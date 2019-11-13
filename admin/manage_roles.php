<?php
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();
if($_REQUEST['roles']!=''){
  $roles=implode(",",$_REQUEST['roles']);  
}

if($_REQUEST['submitForm']=='yes'){
  $obj->query("update $tbl_admin set roles='$roles' where  id='".$_REQUEST['id']."' ");
  $_SESSION['sess_msg']='Roles updated successfully';
  header("location:admin-list.php");
  exit();
}      


if($_REQUEST['id']!=''){
  $sql=$obj->query("select * from $tbl_admin where id=".$_REQUEST['id']);
  $result=$obj->fetchNextObject($sql);
}   $empRolesArr='';
if($result->roles!=''){
  $empRoles=$result->roles; 
  $empRolesArr=explode(",",$empRoles);  
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
        <h1>Manage Roles for <?php echo getField('emp_name',$tbl_admin,$_REQUEST['id'])." ".getField('emp_surname',$tbl_admin,$_REQUEST['id']); ?></h1>
        <ol class="breadcrumb">
          <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="admin-list.php">Back</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="box box-default">
          <form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
            <input type="hidden" name="submitForm" value="yes" />
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Setting</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="1" <?php if($empRolesArr!='' && in_array(1,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Booking Slot</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="2" <?php if($empRolesArr!='' && in_array(2,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage City</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="3"  <?php if($empRolesArr!='' && in_array(3,$empRolesArr)){?>checked<?php } ?>/>
                    <label>Manage Sector</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="4"  <?php if($empRolesArr!='' && in_array(4,$empRolesArr)){?>checked<?php } ?>/>
                    <label>Manage Society</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="5" <?php if($empRolesArr!='' && in_array(5,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Banner</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="6" <?php if($empRolesArr!='' && in_array(6,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Fiesta Banners</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="7"  <?php if($empRolesArr!='' && in_array(7,$empRolesArr)){?>checked<?php } ?>/>
                    <label>Manage Social Links</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="8"  <?php if($empRolesArr!='' && in_array(8,$empRolesArr)){?>checked<?php } ?>/>
                    <label>Manage Unit</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="9"  <?php if($empRolesArr!='' && in_array(9,$empRolesArr)){?>checked<?php } ?>/>
                    <label>Manage Rack</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="10"  <?php if($empRolesArr!='' && in_array(10,$empRolesArr)){?>checked<?php } ?>/>
                    <label>Manage User Group</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="11" <?php if($empRolesArr!='' && in_array(11,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Setting</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="12" <?php if($empRolesArr!='' && in_array(12,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Order Issue</label>
                  </div>
                </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="13" <?php if($empRolesArr!='' && in_array(13,$empRolesArr)){?>checked<?php } ?> />
                    <label>Send Notification</label>
                  </div>
                </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="14" <?php if($empRolesArr!='' && in_array(14,$empRolesArr)){?>checked<?php } ?> />
                    <label>Send Schedule Notification</label>
                  </div>
                </div>
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="15" <?php if($empRolesArr!='' && in_array(15,$empRolesArr)){?>checked<?php } ?> />
                    <label>Feedback Query New</label>
                  </div>
                </div>
                                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="16" <?php if($empRolesArr!='' && in_array(16,$empRolesArr)){?>checked<?php } ?> />
                    <label>Feedback Query Solved</label>
                  </div>
                </div>
                                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="17" <?php if($empRolesArr!='' && in_array(17,$empRolesArr)){?>checked<?php } ?> />
                    <label>Order Feedback Query</label>
                  </div>
                </div>
                
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Offer</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="18" <?php if($empRolesArr!='' && in_array(18,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Coupons</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="19" <?php if($empRolesArr!='' && in_array(19,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Voucher</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="20" <?php if($empRolesArr!='' && in_array(20,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Coupon/Wallet Offer</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Catalogue</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="21" <?php if($empRolesArr!='' && in_array(21,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Catagory</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="22" <?php if($empRolesArr!='' && in_array(22,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Brand</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="23" <?php if($empRolesArr!='' && in_array(23,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Product</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="24" <?php if($empRolesArr!='' && in_array(24,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Product Price</label>
                  </div>
                </div>
              </div>
 
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Customer</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="25" <?php if($empRolesArr!='' && in_array(25,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Customer</label>
                  </div>
                </div>
				<div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="26" <?php if($empRolesArr!='' && in_array(26,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Assign Customer</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="27" <?php if($empRolesArr!='' && in_array(27,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Reassign Customer</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="28" <?php if($empRolesArr!='' && in_array(28,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Referral</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="29" <?php if($empRolesArr!='' && in_array(29,$empRolesArr)){?>checked<?php } ?> />
                    <label>Daily Basket</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="30" <?php if($empRolesArr!='' && in_array(30,$empRolesArr)){?>checked<?php } ?> />
                    <label>Weekly Basket</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="31" <?php if($empRolesArr!='' && in_array(31,$empRolesArr)){?>checked<?php } ?> />
                    <label>Monthly Basket</label>
                  </div>
                </div>
              </div>
			  
			  <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Sales</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="32" <?php if($empRolesArr!='' && in_array(32,$empRolesArr)){?>checked<?php } ?> />
                    <label>New Orders</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="33" <?php if($empRolesArr!='' && in_array(33,$empRolesArr)){?>checked<?php } ?> />
                    <label>Order Delivered</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="34" <?php if($empRolesArr!='' && in_array(34,$empRolesArr)){?>checked<?php } ?> />
                    <label>Order Returned</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="35" <?php if($empRolesArr!='' && in_array(35,$empRolesArr)){?>checked<?php } ?> />
                    <label>Order Cancelled</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="36" <?php if($empRolesArr!='' && in_array(36,$empRolesArr)){?>checked<?php } ?> />
                    <label>All Orders</label>
                  </div>
                </div>
              </div>
              
               <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Cash Management</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="37" <?php if($empRolesArr!='' && in_array(37,$empRolesArr)){?>checked<?php } ?> />
                    <label>Order Add Cash</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="38" <?php if($empRolesArr!='' && in_array(38,$empRolesArr)){?>checked<?php } ?> />
                    <label>Order Receive Cash</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="39" <?php if($empRolesArr!='' && in_array(39,$empRolesArr)){?>checked<?php } ?> />
                    <label>Sourcing Add Cash</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="40" <?php if($empRolesArr!='' && in_array(40,$empRolesArr)){?>checked<?php } ?> />
                    <label>Sourcing Receive Cash</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="41" <?php if($empRolesArr!='' && in_array(41,$empRolesArr)){?>checked<?php } ?> />
                    <label>Online Incoming Transactions</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="42" <?php if($empRolesArr!='' && in_array(42,$empRolesArr)){?>checked<?php } ?> />
                    <label>Online Outgoing Transactions</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="43" <?php if($empRolesArr!='' && in_array(43,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Digital Payment</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="44" <?php if($empRolesArr!='' && in_array(44,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Payment</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="45" <?php if($empRolesArr!='' && in_array(45,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Fixed Capital</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="46" <?php if($empRolesArr!='' && in_array(46,$empRolesArr)){?>checked<?php } ?> />
                    <label>workingcapital-list.php</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Vender</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="47" <?php if($empRolesArr!='' && in_array(47,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Vender</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="48" <?php if($empRolesArr!='' && in_array(48,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Vendor Products</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="49" <?php if($empRolesArr!='' && in_array(49,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Order Products</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Store</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="50" <?php if($empRolesArr!='' && in_array(50,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Store</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="51" <?php if($empRolesArr!='' && in_array(51,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Store Products</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Warehouse</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="52" <?php if($empRolesArr!='' && in_array(52,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Warehouse</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Employee</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="53" <?php if($empRolesArr!='' && in_array(53,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Department</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="54" <?php if($empRolesArr!='' && in_array(54,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Designation</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="55" <?php if($empRolesArr!='' && in_array(55,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Employee</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Vehicle</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="56" <?php if($empRolesArr!='' && in_array(56,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Vehicle</label>
                  </div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Job</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="57" <?php if($empRolesArr!='' && in_array(57,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Category</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="58" <?php if($empRolesArr!='' && in_array(58,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Job</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="59" <?php if($empRolesArr!='' && in_array(59,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Application Form</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Marketing</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="60" <?php if($empRolesArr!='' && in_array(60,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Assign Area</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Telecolor</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="61" <?php if($empRolesArr!='' && in_array(61,$empRolesArr)){?>checked<?php } ?> />
                    <label>Today Call</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="62" <?php if($empRolesArr!='' && in_array(62,$empRolesArr)){?>checked<?php } ?> />
                    <label>New Call</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="63" <?php if($empRolesArr!='' && in_array(63,$empRolesArr)){?>checked<?php } ?> />
                    <label>Pending Call</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="64" <?php if($empRolesArr!='' && in_array(64,$empRolesArr)){?>checked<?php } ?> />
                    <label>Receive Call</label>
                  </div>
                </div>
              </div>
              
                <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage GST</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="65" <?php if($empRolesArr!='' && in_array(65,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage GST</label>
                  </div>
                </div>
              </div>
              
              
                <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Pages</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="66" <?php if($empRolesArr!='' && in_array(66,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Pages</label>
                  </div>
                </div>
              </div>
              
              
              <div class="row">
                <div class="col-md-12">
                  <h4 style="color: #3c8dbc">Manage Report</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="70" <?php if($empRolesArr!='' && in_array(70,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Minimum Stock</label>
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="71" <?php if($empRolesArr!='' && in_array(71,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Maximum Stock</label>
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="72" <?php if($empRolesArr!='' && in_array(72,$empRolesArr)){?>checked<?php } ?> />
                    <label>Product Purchasing List</label>
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="73" <?php if($empRolesArr!='' && in_array(73,$empRolesArr)){?>checked<?php } ?> />
                    <label>Product Sale List</label>
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="74" <?php if($empRolesArr!='' && in_array(74,$empRolesArr)){?>checked<?php } ?> />
                    <label>Product Expiry List (Next Month)</label>
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="75" <?php if($empRolesArr!='' && in_array(75,$empRolesArr)){?>checked<?php } ?> />
                    <label>Product Expiry List</label>
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="76" <?php if($empRolesArr!='' && in_array(76,$empRolesArr)){?>checked<?php } ?> />
                    <label>Customer List with order</label>
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="77" <?php if($empRolesArr!='' && in_array(77,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Referal Report List</label>
                  </div>
                </div>
                
                 <div class="col-md-3">
                  <div class="form-group">
                    <input  type="checkbox" name="roles[]" value="78" <?php if($empRolesArr!='' && in_array(78,$empRolesArr)){?>checked<?php } ?> />
                    <label>Manage Product Report List</label>
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
