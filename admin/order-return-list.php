<?php 
ob_start(); 
session_start(); 
include( '../include/config.php'); 
include( "../include/functions.php"); 
validate_admin(); 

$_SESSION['whr']='';
$whr = '';
if($_POST['order_id']!=''){
  $order_id = $_POST['order_id'];
  $whr .= " and b.order_id ='$order_id'";
}

if($_POST['product_name']!=''){
  $product_name = $_POST['product_name'];
  $PSql = $obj->query("select id from $tbl_product where product_name like '%".$product_name."%'");
  while($PResult = $obj->fetchNextObject($PSql)){
	$proId[] = $PResult->id;
  }
  if(!empty($proId)){
	$proId = implode('',$proId);
	$whr .= " and a.product_id in($proId)";
  }
  
}
if($_POST['order_date_from']!='' && $_POST['order_date_to']!=''){
  $order_date_from = $_POST['order_date_from'];
  $order_date_to = $_POST['order_date_to'];
  $whr .= " and b.order_date between '$order_date_from' and '$order_date_to'";
}
if($_POST['order_status']!=''){
  $order_status = $_POST['order_status'];
  $whr .= " and b.order_status = '$order_status'";
}

if($whr!=''){
$_SESSION['whr'] = $whr;
}

?>
<!DOCTYPE html>
<html>
<?php include( "head.php"); ?>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
<?php include( "header.php"); ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include( "menu.php"); ?>

<script src="js/jquery-2.2.3.min.js"></script>
<link rel="stylesheet" href="../colorbox/colorbox.css" />
<script src="../colorbox/jquery.colorbox.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
            <div class="row">
        <div class="col-md-3"><h4>Manage Return Orders</h4></div>
        <div class="col-md-6"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
        <div class="col-md-3" align="right">
          <form class="form-horizontal" action="csv.php?table_name=tbl_order" method="post" name="upload_excel"   
          enctype="multipart/form-data">
          <input type="submit" name="OrderReturnList" class="btn btn-primary" value="Export Data"/>
          </form>
    </div>
      </div>
    </section>

<div class="box box-primary" style="padding:5px 5px 15px 5px ;margin:10px 15px 0px 15px;width:auto">
<section class="content-header">
      <form name="searchactiveorderfrm" id="searchactiveorderfrm" method="post" accept="order-active-list.php"> 
        <div class="row">
          <div class="col-md-2"><label>Order ID</label>
            <input type="text" name="order_id" class="form-control" value="<?php if($_POST['order_id']!=''){ echo $_POST['order_id']; } ?>">
          </div>
          <div class="col-md-3"><label>Product Name.</label>
            <input type="text" name="product_name" class="form-control" value="<?php if($_POST['product_name']!=''){ echo $_POST['product_name']; } ?>">
          </div>
		   <div class="col-md-2"><label>Order Date From</label>
            <input type="text" name="order_date_from" id="order_date_from" class="form-control" value="<?php if($_POST['order_date_from']!=''){ echo $_POST['order_date_from']; } ?>">
          </div>
          <div class="col-md-2"><label>Order Date To</label>
            <input type="text" name="order_date_to" id="order_date_to" class="form-control" value="<?php if($_POST['order_date_to']!=''){ echo $_POST['order_date_to']; } ?>">
          </div>
		    <div class="col-md-1"><label>&nbsp;</label>
            <input type="submit" name="name" class="form-control" value="Search" style="background: #337ab7 none repeat scroll 0 0; border-radius: 3px; color: #fff; text-align: center; width: 80px;">
          </div>
          <div class="col-md-2"><label>&nbsp;</label>
            <a href="order-return-list.php" class="form-control" style="background: #337ab7 none repeat scroll 0 0; border-radius: 3px; color: #fff; text-align: center; width: 90px; margin-left: 10px;">Search All</a>
          </div>
          </div>

      </form>
    </section>
</div>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-xs-12">
<!-- /.box -->
<form name="frm" method="post" action="user-del.php" enctype="multipart/form-data">
<div class="box">
<div class="box-body">
<table id="product-grid"  cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped dataTable no-footer" width="100%">
<thead>
<tr>
	<th width="10px;">SNo.</th>
	<th>Customer</th>
	<th width="170px;">Order Date/Time</th>
	<th>Order ID</th>
	<th>Order Status</th>
	<th width="150px">Product Name</th>
	<th>Size</th>
	<th>Qty*Price</th>
	<th>Total Price</th>
	<th>Payment Method</th>
	<td>Action</td>
</tr>
</thead>
</table>
</div>

</div>

</form>
<!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include( "footer.php"); ?>
<!-- Control Sidebar -->
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<!-- page script -->
<script src="js/change-status.js"></script> 
<link rel="stylesheet" href="calender/css/jquery-ui.css">
<script src="calender/js/jquery-ui.js"></script>
<script>
$(function() {
$( "#order_date_from" ).datepicker({
changeMonth: true,
changeYear: true,
yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+1?>',
dateFormat: "yy-mm-dd",
});
$( "#order_date_to" ).datepicker({
changeMonth: true,
changeYear: true,
yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+1?>',
// minDate: 0,
// MaxDate: 'today',
dateFormat: "yy-mm-dd",
});
});
</script>
<!-- Get Data from Database through ajax -->
<script type="text/javascript" language="javascript" >
	$(document).ready(function() {
	var dataTable = $('#product-grid').DataTable( {
		"processing": true,
		"serverSide": true,
		"stateSave": true,
		"ajax":{
			url :"order-return-list-ajax.php", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".product-grid-error").html("");
				$("#product-grid").append('<tbody class="product-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#product-grid_processing").css("display","none");
			}

		}
	} )
	$('#check_all').on('click', function(e){
		e.preventDefault();
		$('.checkall').each(function(){
			$(this).prop('checked', true);
		})
	});
} );
</script>
<link rel="stylesheet" href="calender/css/jquery-ui.css">
<script src="calender/js/jquery-ui.js"></script>
</body>
</html>
