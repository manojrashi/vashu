<?php
ob_start();
session_start(); 
include('../include/config.php');
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
   <?PHP  include("menu.php");?>
   <!-- Content Wrapper. Contains page content -->
   <script src="js/jquery-2.2.3.min.js"></script>
   <link rel="stylesheet" href="../colorbox/colorbox.css" />
    <script src="../colorbox/jquery.colorbox.js"></script>
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <?php
                $USql = $obj->query("select id from $tbl_banner where 1=1");
                $UNumRows = $obj->numRows($USql);
                echo $UNumRows;
                ?>
                
              </h3>

              <p>Manage Banner</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="banner-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php
                $USql1 = $obj->query("select id from $tbl_category where 1=1");
                $UNumRows1 = $obj->numRows($USql1);
                echo $UNumRows1;
                ?>
              </h3>

              <p>Total Category</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="category-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                <?php
                $cSql = $obj->query("select id from $tbl_brand where 1=1");
                $cNumRows = $obj->numRows($cSql);
                echo $cNumRows;
                ?>
              </h3>

              <p>Current Brand </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="brand-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_product where 1=1");
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>

              <p>Manage Product</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="product-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
      	 <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-navy">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_user where 1=1 and user_type=1");
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>

              <p>Manage Customer</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="user-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-teal">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_user where 1=1 and user_type=2");
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>
              <p>Manage Vendor</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="vender-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-olive">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_content where 1=1");
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>

              <p>Manage Pages</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="content-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-lime">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_news where 1=1");
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>

              <p>Manage News</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="news-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
      	 <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_order where order_status=1");
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>

              <p>Total New Order</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="order-active-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
         <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-fuchsia">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_order where order_status=4");
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>

              <p>Total Delivered Order</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="order-delivered-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_order where order_status=4",-1);
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>

              <p>Total Cancelled Order</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="order-cancelled-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
         <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3>
                <?php
                $oSql = $obj->query("select id from $tbl_order where 1=1");
                $oNumRows = $obj->numRows($oSql);
                echo $oNumRows;
                ?>
              </h3>

              <p>Total All Order</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="order-all-list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <section class="col-lg-12 connectedSortable ui-sortable">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">New Order</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
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
                            <a href="addcommets.php?order_id=<?php echo $line->id; ?>"  class="btn btn-primary iframeAddc<?php echo $line->id; ?>">
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
           <!-- /.box-body -->

           <div class="box-footer text-center">
            <a href="order-active-list.php" class="uppercase">View All Order</a>
          </div>
          <!-- /.box-footer -->

        </div>
      </section>
   </div>
  </section>
</div>
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
</body>
</html>
