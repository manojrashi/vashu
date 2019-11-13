<?php
session_start(); 
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();
?>
<!DOCTYPE html>
<html>
<?php include("head.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include("header.php"); ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include("menu.php"); ?>
    <script src="js/jquery-2.2.3.min.js"></script>
    <link rel="stylesheet" href="../colorbox/colorbox.css" />
    <script src="../colorbox/jquery.colorbox.js"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="row">
          <div class="col-md-3"><h4>Manage New Order List</h4></div>
          <div class="col-md-7"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <form name="frm" method="post" action="product-del.php" enctype="multipart/form-data">
            <div class="box">
              <div class="box-body">
                <table id="active-order" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>SNo.</th>
                      <th width="150px;">Order Date/Time</th>
                      <th>Order  ID</th>
                      <th>Amount</th>
                      <th>Method of payment</th>
                      <th>Name/Mobile</th>
                      <th>Ship Address</th>
                      <th width="60px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    $sql=$obj->query("select * from $tbl_order where 1=1 and order_status in (1,2) order by id asc",$debug=-1);
                    while($line=$obj->fetchNextObject($sql)){?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                        <?php 
                          echo date('d M Y H:i',strtotime($line->order_date)); ?><br/><?php echo CalculateOrderTime($line->order_date); 
                         ?>
                       
                        </td>
                        <td><?php echo stripslashes($line->orderno); ?></td>
                        <td><?php echo $website_currency_symbol." ".number_format($line->total_amount,0); ?></td>
                        <td align="center">
                            <?php echo stripslashes($line->payment_method);?> /
                            <?php if($line->payment_status==1){ echo "Paid"; }else{ echo "Unpaid"; }?>
                        </td>
                        <script>
                          $(document).ready(function(){
                            $(".iframeOrder<?php echo $line->id; ?>").colorbox({iframe:true, width:"900px;", height:"800px;", frameborder:"0",scrolling:true});
                            $(".iframeAddc<?php echo $line->id; ?>").colorbox({iframe:true, width:"700px;", height:"500px;", frameborder:"0",scrolling:true});
                            $(".iframeViewc<?php echo $line->id; ?>").colorbox({iframe:true, width:"800px;", height:"600px;", frameborder:"0",scrolling:true});
                            
                            $(".iframeViewusercomm<?php echo $line->id; ?>").colorbox({iframe:true, width:"700px;", height:"500px;", frameborder:"0",scrolling:true});
                            
                          });
                        </script>
                        <td><?php echo getField('name',$tbl_user,$line->user_id)." ".getField('surname',$tbl_user,$line->user_id); ?></br>
                        <?php echo getField('mobile',$tbl_user,$line->user_id); ?></br>
                        </td>
                         <td><?php echo stripslashes($line->ship_address); ?></td>
                        <td>
                          <a href="vieworder-detail.php?order_id=<?php echo $line->id; ?>" class="btn btn-primary iframeOrder<?php echo $line->id; ?>" title="View Details">
                            <i class="fa fa-eye"></i></a>
                            <a href="addcommets.php?order_id=<?php echo $line->id; ?>"  class="btn btn-primary iframeAddc<?php echo $line->id; ?>" title="Add Comment">
                                <i class="fa fa-plus"></i></a>
                          </td>
                        </tr>
                        <?php $i++; }?>

                      </tbody>

                      <tfoot>
                      </tfoot>

                    </table>
                  </div>
                  <!-- /.box-body -->
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




      <?php include("footer.php"); ?>

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
<script>
  $(function () {
    $("#active-order").DataTable();
  });
</script>

<link rel="stylesheet" href="calender/css/jquery-ui.css">
<script src="calender/js/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#order_date_from" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+1?>',
      dateFormat: "yy-mm-dd",
    });

    $( "#order_date_to" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+1?>',
      // minDate: 0,
      // MaxDate: 'today',
      dateFormat: "yy-mm-dd",
    });
     $( "#delivery_date_from" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+1?>',
      dateFormat: "yy-mm-dd",
    });

    $( "#delivery_date_to" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange:'<?php echo date('Y')?>:<?php echo date('Y')+1?>',
      // minDate: 0,
      // MaxDate: 'today',
      dateFormat: "yy-mm-dd",
    });


    
  });
</script>
</body>
</html>
