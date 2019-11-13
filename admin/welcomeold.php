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

    <script src="js/jquery-2.2.3.min.js"></script>
    <link rel="stylesheet" href="../colorbox/colorbox.css" />
    <script src="../colorbox/jquery.colorbox.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
      $('#category').change(function() {
      var cat_id=$(this).val(); 
      $.ajax({
        url:"dash/getProduct.php",
        data:{cat_id:cat_id},
        beforeSend:function(){
        
        },
        success:function(data){
         $("#product-list-category").html(data);
        }

        })
      })
    })
  </script>

    <style type="text/css">
      .box-header{color: #3c8dbc;}
    </style>
    <!-- Content Wrapper. Contains page content -->
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
        <div class="row">
          <div class="col-md-6">

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Employee Details</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                      <table id="social-list" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>P/A</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=1;
                          $sql=$obj->query("select * from $tbl_admin where 1=1 and user_type='emp' and status=1",$debug=-1);
                          while($line=$obj->fetchNextObject($sql)){?>
                          <tr>
                            <td><?php echo ucfirst(stripslashes($line->emp_name))." ".ucfirst(stripslashes($line->emp_surname)); ?></td>
                            <td><?php echo getField('role',$tbl_rolesubcategory,$line->designation); ?></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>

                            <script>
                              $(document).ready(function(){
                                $(".iframeDetail<?php echo $line->id; ?>").colorbox({iframe:true, width:"700px;", height:"570px;", frameborder:"0",scrolling:true});
                              });
                            </script>

                            <td><a href="viewemployee-detail.php?id=<?php echo $line->id; ?>" class="iframeDetail77 btn btn-primary cboxElement" title="View Employee"> <i class="fa fa-eye"></i></a></td>
                          </tr>
                          <?php $i++; }?>

                        </tbody>

                        <tfoot>
                        </tfoot>

                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
           <div class="col-md-6">

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Processing Team</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                      <table id="social-list" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Today</th>
                            <th>Week</th>
                            <th>Month</th>
                            <th>Year</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=1;
                          $currdate = date('Y-m-d');

                          $sql=$obj->query("select * from $tbl_admin where 1=1 and user_type='emp' and designation=40 and status=1",$debug=-1);
                          while($line=$obj->fetchNextObject($sql)){
                            
                            $TodaySql=$obj->query("select count(id) as totA from $tbl_order where process_user_id='".$line->id."' and Date(ship_date)=Curdate()",$debug=-1);
                            $TodayResult=$obj->fetchNextObject($TodaySql);


                            $WeekSql=$obj->query("select count(id) as totB from $tbl_order where process_user_id='".$line->id."' and ship_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)",$debug=-1);
                            $WeekResult=$obj->fetchNextObject($WeekSql);

                            $MonthSql=$obj->query("select count(id) as totC from $tbl_order where process_user_id='".$line->id."' and ship_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)",$debug=-1);
                            $MonthResult=$obj->fetchNextObject($MonthSql);

                            $YearSql=$obj->query("select count(id) as totD from $tbl_order where process_user_id='".$line->id."' and ship_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)",$debug=-1);
                            $YearResult=$obj->fetchNextObject($YearSql);

                            ?>
                            <tr>
                              <td><?php echo ucfirst(stripslashes($line->emp_name))." ".ucfirst(stripslashes($line->emp_surname)); ?></td>
                              <td><?php echo $TodayResult->totA; ?></td>
                              <td><?php echo $WeekResult->totB; ?></td>
                              <td><?php echo $MonthResult->totC; ?></td>
                              <td><?php echo $YearResult->totD; ?></td>
                            </tr>
                            <?php $i++; }?>

                          </tbody>

                          <tfoot>
                          </tfoot>

                        </table>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>
         

        </div>


        <div class="row">
           <div class="col-md-6">

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Customer Support</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                      <table id="social-list" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Attend</th>
                            <th>Complaint</th>
                            <th>Solution</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=1;
                          $sql=$obj->query("select * from $tbl_admin where 1=1 and user_type='emp' and designation=38 and status=1",$debug=-1);
                          while($line=$obj->fetchNextObject($sql)){?>
                          <tr>
                            <td><?php echo ucfirst(stripslashes($line->emp_name)); ?></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                          </tr>
                          <?php $i++; }?>

                        </tbody>

                        <tfoot>
                        </tfoot>

                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
            <div class="col-md-6">

              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Delivery Team</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Today</th>
                              <th>Week</th>
                              <th>Month</th>
                              <th>Year</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $currdate = date('Y-m-d');
                           //delivered_date

                            $i=1;
                            $sql=$obj->query("select * from $tbl_admin where 1=1 and user_type='emp' and designation=37 and status=1",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){

                            $TodaySql=$obj->query("select count(id) as totA from $tbl_order where delivered_user_id='".$line->id."' and order_status in (1,2) and Date(ship_date)=Curdate()",$debug=-1);
                            $TodayResult=$obj->fetchNextObject($TodaySql);


                            $WeekSql=$obj->query("select count(id) as totB from $tbl_order where delivered_user_id='".$line->id."' and order_status=4 and delivered_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)",$debug=-1);
                            $WeekResult=$obj->fetchNextObject($WeekSql);

                            $MonthSql=$obj->query("select count(id) as totC from $tbl_order where delivered_user_id='".$line->id."' and order_status=4 and delivered_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)",$debug=-1);
                            $MonthResult=$obj->fetchNextObject($MonthSql);

                            $YearSql=$obj->query("select count(id) as totD from $tbl_order where delivered_user_id='".$line->id."' and order_status=4 and delivered_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)",$debug=-1);
                            $YearResult=$obj->fetchNextObject($YearSql);


                              ?>
                            <tr>
                              <td><?php echo ucfirst(stripslashes($line->emp_name))." ".ucfirst(stripslashes($line->emp_surname)); ?></td>
                              <td><?php echo $TodayResult->totA; ?></td>
                              <td><?php echo $WeekResult->totB; ?></td>
                              <td><?php echo $MonthResult->totC; ?></td>
                              <td><?php echo $YearResult->totD; ?></td>
                            </tr>
                            <?php $i++; }?>

                          </tbody>

                          <tfoot>
                          </tfoot>

                        </table>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Product Purchansing List</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Name</th>
                              <th>Brand</th>
                              <th width="300px;">Category</th>
                              <th>Total</th>
                              <th>Day</th>
                              <th>Week</th>
                              <th>Month <?PHP echo date('M'); ?></th>
                              <th>Year <?PHP echo date('Y'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $tDate = date('Y-m-d');
                            $i=1;
                            $sql=$obj->query("select sum(qty) as tot,product_id,price_id,size,unit_id,brand_id from $tbl_order_prodcut  where 1=1 group by price_id order by tot desc limit 0,100",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){

                              $DSql=$obj->query("select sum(qty) as mtot from $tbl_order_prodcut where price_id='".$line->price_id."' and DATE(cdate) = CURDATE()",$debug=-1);
                              $DResult = $obj->fetchNextObject($DSql);

                              $WSql=$obj->query("select sum(qty) as mtot from $tbl_order_prodcut where price_id='".$line->price_id."' and cdate >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)",$debug=-1);
                              $WResult = $obj->fetchNextObject($WSql);

                              $MSql=$obj->query("select sum(qty) as mtot from $tbl_order_prodcut where price_id='".$line->price_id."' and cdate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)",$debug=-1);
                              $MResult = $obj->fetchNextObject($MSql);

                              $YSql=$obj->query("select sum(qty) as mtot from $tbl_order_prodcut where price_id='".$line->price_id."' and cdate >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)",$debug=-1);
                              $YResult = $obj->fetchNextObject($YSql);

                             
                              ?>
                            <tr>
                              <td><?php echo getField('id',$tbl_vendor_product,$line->product_id); ?></td>
                              <td><?php echo getField('product_name',$tbl_vendor_product,$line->product_id)." </br> ".$line->size." ".$line->unit_id; ?></td>
                              <td><?php echo getField('brand',$tbl_brand,$line->brand_id); ?></td>
                              <td><?php echo getCategoryTree(getField('cat_id',$tbl_product,$line->product_id),$array=array()); ?></td>
                              <td><?php echo $line->tot; ?></td>
                              <td><?php if($DResult->mtot!=''){ echo $DResult->mtot; }else{ echo "0";} ?></td>
                              <td><?php if($WResult->mtot!=''){ echo $WResult->mtot; }else{ echo "0";} ?></td>
                              <td><?php if($MResult->mtot!=''){ echo $MResult->mtot; }else{ echo "0";} ?></td>
                              <td><?php if($YResult->mtot!=''){ echo $YResult->mtot; }else{ echo "0";} ?></td>
                            </tr>
                            <?php $i++; }?>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Product Sale List</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Name</th>
                              <th>Brand</th>
                              <th width="300px;">Category</th>
                              <th>Total</th>
                              <th>Day</th>
                              <th>Week</th>
                              <th>Month</th>
                              <th>Year</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $sql=$obj->query("select sum(a.qty) as tot,a.product_id,b.size,b.unit_id,a.price_id from $tbl_order_itmes as a INNER JOIN $tbl_productprice as b on a.price_id=b.id where 1=1 group by a.price_id order by tot desc limit 0,100",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){

                              $DSql=$obj->query("select sum(qty) as mtot from $tbl_order_itmes where price_id='".$line->price_id."' and DATE(cdate) = CURDATE()",$debug=-1);
                              $DResult = $obj->fetchNextObject($DSql);

                              $WSql=$obj->query("select sum(qty) as mtot from $tbl_order_itmes where price_id='".$line->price_id."' cdate >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)",$debug=-1);
                              $WResult = $obj->fetchNextObject($WSql);

                              $MSql=$obj->query("select sum(qty) as mtot from $tbl_order_itmes where price_id='".$line->price_id."' cdate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)",$debug=-1);
                              $MResult = $obj->fetchNextObject($MSql);

                              $YSql=$obj->query("select sum(qty) as mtot from $tbl_order_itmes where price_id='".$line->price_id."' and cdate >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)",$debug=-1);
                              $YResult = $obj->fetchNextObject($YSql);

                              ?>
                            <tr>
                              <td><?php echo getField('product_id',$tbl_product,$line->product_id); ?></td>
                              <td><?php echo getField('product_name',$tbl_product,$line->product_id)." </br> ".$line->size." ".getField('name',$tbl_unit,$line->unit_id); ?></td>
                              <td><?php echo getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$line->product_id)); ?></td>
                              <td><?php echo getCategoryTree(getField('cat_id',$tbl_product,$line->product_id),$array=array()); ?></td>
                              <td><?php echo $line->tot; ?></td>
                              <td><?php if($DResult->mtot!=''){ echo $DResult->mtot; }else{ echo "0";} ?></td>
                              <td><?php if($WResult->mtot!=''){ echo $WResult->mtot; }else{ echo "0";} ?></td>
                              <td><?php if($MResult->mtot!=''){ echo $MResult->mtot; }else{ echo "0";} ?></td>
                              <td><?php if($YResult->mtot!=''){ echo $YResult->mtot; }else{ echo "0";} ?></td>
                            </tr>
                            <?php $i++; }?>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>  


          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Product Expiry List (Next Month)</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                         <thead>
                            <tr>
                              <th>Id</th>
                              <th>Name</th>
                              <th>Brand</th>
                              <th width="300px;">Category</th>
                              <th>Date</th>
                              <th>Total Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $sql=$obj->query("select * from $tbl_order_prodcut where `expiry_date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) order by expiry_date ASC limit 0,100",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){?>
                            <tr>
                              <td><?php echo $line->id; ?></td>
                              <td><?php echo getField('product_name',$tbl_product,$line->product_id); ?></td>
                              <td><?php echo getField('brand',$tbl_brand,$line->brand_id); ?></td>
                              <td><?php echo getCategoryTree($line->cat_id,$array=array()); ?></td>
                              <td><?php echo $line->expiry_date; ?></td>
                              <td><?php echo getFieldWhere('actual_price',$tbl_productprice,'price_id',$line->price_id)*$line->qty; ?></td>
                            </tr>
                            <?php $i++; }?>
                          </tbody>

                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Product Expiry List</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th>Name</th>
                              <th>Brand</th>
                              <th width="300px;">Category</th>
                              <th>Date</th>
                              <th>Total Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $currdate = date('Y-m-d');
                            $sql=$obj->query("select * from $tbl_order_prodcut where DATE(expiry_date) <= CURDATE()  order by expiry_date ASC limit 0,100",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){?>
                            <tr>
                              <td><?php echo $line->id; ?></td>
                              <td><?php echo getField('product_name',$tbl_product,$line->product_id); ?></td>
                              <td><?php echo getField('brand',$tbl_brand,$line->brand_id); ?></td>
                              <td><?php echo getCategoryTree($line->cat_id,$array=array()); ?></td>
                              <td><?php echo $line->expiry_date; ?></td>
                              <td><?php echo getFieldWhere('actual_price',$tbl_productprice,'price_id',$line->price_id)*$line->qty; ?></td>
                            </tr>
                            <?php $i++; }?>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>  

          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Order Delivered</h3>
                </div>

                   <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <iframe src="order-delevered-bar.php" width="500" height="250"  frameborder="0"></iframe>
                  </div>
                </div>
  
              </div>
            </div>
               <!--  <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Today</th>
                              <th>Week</th>
                              <th>Month</th>
                              <th>Year</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $currdate = date('Y-m-d');
                            $week_date = date('Y-m-d',strtotime("-1 week", strtotime($currdate)));
                            $month_date = date('Y-m-d',strtotime("-1 month", strtotime($currdate)));
                            $year_date = date('Y-m-d',strtotime("-1 year", strtotime($currdate)));


                            $TodaySql=$obj->query("select count(id) as totA from $tbl_order where order_status=4 and order_date='$currdate'",$debug=-1);
                            $TodayResult=$obj->fetchNextObject($TodaySql);


                            $WeekSql=$obj->query("select count(id) as totB from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= '$week_date'",$debug=-1);
                            $WeekResult=$obj->fetchNextObject($WeekSql);

                            $MonthSql=$obj->query("select count(id) as totC from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= '$month_date'",$debug=-1);
                            $MonthResult=$obj->fetchNextObject($MonthSql);


                            $YearSql=$obj->query("select count(id) as totD from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= '$year_date'",$debug=-1);
                            $YearResult=$obj->fetchNextObject($YearSql);


                            ?>
                            <tr>
                              <td><?php echo $TodayResult->totA; ?></td>
                              <td><?php echo $WeekResult->totB; ?></td>
                              <td><?php echo $MonthResult->totC; ?></td>
                              <td><?php echo $YearResult->totD; ?></td>
                            </tr>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Order Canceled</h3>
                </div>
                <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <iframe src="order-canceled-bar.php" width="500" height="250"  frameborder="0"></iframe>
                  </div>
                </div>
  
              </div>
            </div>
               <!--  <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Today</th>
                              <th>Week</th>
                              <th>Month</th>
                              <th>Year</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $currdate = date('Y-m-d');
                            $week_date = date('Y-m-d',strtotime("-1 week", strtotime($currdate)));
                            $month_date = date('Y-m-d',strtotime("-1 month", strtotime($currdate)));
                            $year_date = date('Y-m-d',strtotime("-1 year", strtotime($currdate)));


                            $TodaySql=$obj->query("select count(id) as totA from $tbl_order where order_status=6 and order_date='$currdate'",$debug=-1);
                            $TodayResult=$obj->fetchNextObject($TodaySql);


                            $WeekSql=$obj->query("select count(id) as totB from $tbl_order where order_status=6 and order_date <='$currdate' and order_date >= '$week_date'",$debug=-1);
                            $WeekResult=$obj->fetchNextObject($WeekSql);

                            $MonthSql=$obj->query("select count(id) as totC from $tbl_order where order_status=6 and order_date <='$currdate' and order_date >= '$month_date'",$debug=-1);
                            $MonthResult=$obj->fetchNextObject($MonthSql);


                            $YearSql=$obj->query("select count(id) as totD from $tbl_order where order_status=6 and order_date <='$currdate' and order_date >= '$year_date'",$debug=-1);
                            $YearResult=$obj->fetchNextObject($YearSql);


                            ?>
                            <tr>
                              <td><?php echo $TodayResult->totA; ?></td>
                              <td><?php echo $WeekResult->totB; ?></td>
                              <td><?php echo $MonthResult->totC; ?></td>
                              <td><?php echo $YearResult->totD; ?></td>
                            </tr>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>  


          <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Minimum Stock List</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">

                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Id</th>
                              <th width="400px;">Category</th>
                              <th>Brand</th>
                              <th>Name</th>
                              <th>Mini. Qty</th>
                              <th>Tot.Sale</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $TotArr = array();
                            $PSql = $obj->query("select id,cart_min_qty,product_id,price_id from $tbl_productprice where status=1");
                            while($PResult = $obj->fetchNextObject($PSql)){
                              $product_id = getField('product_id',$tbl_product,$PResult->product_id);
                              $getTotalQty = getTotalQty($product_id,$PResult->price_id);
                              if($PResult->cart_min_qty!=NULL && $PResult->cart_min_qty!="" && $PResult->cart_min_qty!=0 && $PResult->cart_min_qty <= $getTotalQty){
                                $TotArr[] = $PResult->id;
                              }
                            } 
                            ?>

                            <?php
                            //print_r($TotArr);
                            $i=1;
                            $TotArrId = implode(',',$TotArr);


                            $sql=$obj->query("select * from $tbl_productprice where id IN ($TotArrId)  order by cart_min_qty desc limit 0,500",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){
                              $product_id = getField('product_id',$tbl_product,$line->product_id);
                              $SlSql = $obj->query("select count(totqty) as totqty from $tbl_stock where product_id='$product_id' and price_id='".$line->price_id."' and type='Dr' and status=1");
                              $SlResult = $obj->fetchNextObject($SlSql);
                              ?>
                              <tr>
                                <td><?php echo $line->product_id; ?></td>
                                <td><?php echo getCategoryTree(getField('cat_id',$tbl_product,$line->product_id),$array=array()); ?></td>
                                 <td><?php echo getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$line->product_id)); ?></td>
                                <td><?php echo getField('product_name',$tbl_product,$line->product_id)." </br> ".$line->size." ".getField('name',$tbl_unit,$line->unit_id); ?></td>
                                <td><?php echo $line->cart_min_qty; ?></td>
                                <td><?php echo $SlResult->totqty; ?></td>
                              </tr>
                              <?php $i++; }?>
                            </tbody>
                            <tfoot>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-12">
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Customer List with order</h3>
                  </div>
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                          <table id="social-list" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th width="300px;">Address</th>
                                <th>Total Order / Amount</th>
                                <th>Last Order Date</th>
                                <th>Last Order Amount</th>
                                <th>Avg</th>
                                <th>Wallet/Gift Box</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $i=1;
                              $sql=$obj->query("select A.id,A.title,A.name,A.surname,A.mobile,count(B.id) as tot,sum(B.amount) as totamt from $tbl_user as A JOIN $tbl_order as B on A.id=B.user_id where A.status=1 GROUP BY B.user_id order by tot desc limit 0,100",$debug=-1);
                              while($line=$obj->fetchNextObject($sql)){
                                $UserSql = $obj->query("select * from $tbl_useraddress where user_id='".$line->id."'",$debug=-1);
                                $UserResult = $obj->fetchNextObject($UserSql);
                                $address = "";
                                if($UserResult->flat!=''){ $address .=  stripslashes($UserResult->flat); } 
                                if($UserResult->flor!=''){ $address .= ", ".stripslashes($UserResult->flor); }
                                if($UserResult->tower!=''){ $address .= ", ".stripslashes($UserResult->tower); } 
                                if($UserResult->house_no!=''){ $address .= ", ".stripslashes($UserResult->house_no); } 
                                if($UserResult->street_no!=''){ $address .= ", ".stripslashes($UserResult->street_no); } 
                                if($UserResult->block!=''){ $address .= ", ".stripslashes($UserResult->block); } 
                                if($UserResult->sectorno!=''){ $address .= ", ".stripslashes($UserResult->sectorno); } 
                                if($UserResult->landmark!=''){ $address .= ", ".stripslashes($UserResult->landmark); } 
                                if($UserResult->city!=''){ $address .= ", ".getField('city',$tbl_city,$UserResult->city); } 
                                if($UserResult->area!=''){ $address .= ", ".getField('area',$tbl_area,$UserResult->area); } 
                                if($UserResult->state!=''){ $address .= ", ".stripslashes($UserResult->state); }

                                $LastSql = $obj->query("select order_date,amount from $tbl_order where user_id='".$line->id."' order by id desc limit 0,1");
                                $LastResult = $obj->fetchNextObject($LastSql);

                                ?>
                                <tr>
                                  <td><?php echo $line->title." ".$line->name." ".$line->surname; ?></td>
                                  <td><?php echo $line->mobile; ?></td>
                                  <td><?php echo $address; ?></td>
                                  <td><?php echo $line->tot; ?></br><?php echo "Rs. ".$line->totamt; ?></td>
                                  <td><?php echo $LastResult->order_date; ?></td>
                                  <td><?php echo $LastResult->amount; ?></td>
                                  <td><?php echo round($line->totamt/$line->tot); ?></td>
                                  <td>
                                  <?php
                                  echo "Wallet - Rs.".getTotalWallet($line->id);
                                  ?></br>
                                  <?php
                                  echo "Gift Box - Rs.".getTotalGiftWallet($row->id);
                                  ?>
                                    
                                  </td>
                                </tr>
                                <?php $i++; }?>
                              </tbody>
                              <tfoot>
                              </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Referal List</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>SNo.</th>
                              <th>Referal No.</th>
                             <!--  <th>Total Login</th> -->
                              <th>Total Earn</th>
                              <th>Tot. Ref. User</th>
                              <th>Name/Mobile</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $sql=$obj->query("select referral_code,u_id from $tbl_referral_code where u_type=1 and status=1 group by referral_code ",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){
                              if(getTotalGiftWallet($line->u_id)!=0){
                                $totUserArr[$line->u_id] = getTotalGiftWallet($line->u_id);
                              }
                            }
                            
                            arsort($totUserArr);
                             foreach($totUserArr as $key => $value){
                              $totUserArrr[] = $key; 
                            }
                            //print_r($totUserArrr);
                           foreach($totUserArrr as $val){
                            $referral_by = getFieldWhere('referral_code',$tbl_referral_code,'u_id',$val);
                              $RefSql = $obj->query("select count(id) as totreferaluser from $tbl_user where referral_by='$referral_by'",$debug=-1);
                              $RefResult = $obj->fetchNextObject($RefSql);

                            ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                              <td><?php echo $referral_by; ?></td>
                            <!--   <td><?php //echo ""; ?></td> -->
                              <td><?php echo getTotalGiftWallet($val); ?></td>
                              <td><?php echo $RefResult->totreferaluser; ?></td>
                              <td>
                              <?php echo getField('name',$tbl_user,$val)." ".getField('surname',$tbl_user,$val); ?></br>
                              <?php echo getField('mobile',$tbl_user,$val); ?>
                              </td>
                            </tr>
                           <?php $i++;  } ?>
                            
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Same Day Order User List</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>User Id</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Referal Code</th>
                              <th>Order Date</th>
                              <th>Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $sql=$obj->query("select a.order_date,a.amount,b.id,b.name,b.surname,b.mobile from $tbl_order as a inner join $tbl_user as b on date(a.order_date)=date(b.register_date) and a.user_id=b.id where b.status=1 ",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){?>
                            <tr>
                              <td><?php echo $line->id; ?></td>
                              <td><?php echo $line->name." ".$line->surname; ?></td>
                              <td><?php echo $line->mobile; ?></td>
                              <td><?php echo getFieldWhere('referral_code',$tbl_referral_code,'u_id',$line->id); ?></td>
                              <td><?php echo $line->order_date; ?></td>
                              <td><?php echo $line->amount; ?></td>
                            </tr>
                            <?php $i++; }?>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Product List </h3>
                    <!-- <label>Category</label> -->
                     <select name="cat_id" id="category" class="required form-control select2" >
                      
                      <?php if($_REQUEST['id']!=''){?>
                      <option value="<?php echo $result->cat_id; ?>">
                        <?php echo getCategoryTree($result->cat_id,$current_tree=array()); ?>
                      </option>
                      <?php }else{?>
                      <option value="">Select Category</option>
                      <option value="10005">All</option>
                      <?php
                      $sql=$obj->query("select * from $tbl_maincategory where 1=1",$debug=-1); 
                      while($line=$obj->fetchNextObject($sql)){
                      ?>
                      <option value="<?php echo $line->id; ?>" <?php echo ($line->id==$result->cat_id)?'selected':'' ?> ><?php if($line->parent_id==0){echo $line->maincategory; }else{ echo getCategoryTree($line->id,$current_tree=array());} ?></option>
                      <?php }?>
                      <?php }?>
                      </select>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>

                              <th>SNo.</th>
                              <th>Category</th>
                              <th>Brand</th>
                              <th>Live</th>
                              <th>Hide</th>
                              <th>Profit</th>
                              <th>Loss</th>
                            </tr>
                          </thead>
                          <tbody id="product-list-category">
                            <?php
                            $i=1;
                            $sql=$obj->query("select cat_id,brand_id,count(id) as totlive from $tbl_product where status=1 group by cat_id order by totlive desc",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){

                              $HideSql = $obj->query("select count(id) as tothide from $tbl_product where cat_id='".$line->cat_id."' and status=0");
                              $HideResult = $obj->fetchNextObject($HideSql);

                               $PSql = $obj->query("select id from $tbl_product where cat_id='".$line->cat_id."'",$debug=-1); //die;
                               while($PResult = $obj->fetchNextObject($PSql)){
                                $ProfitSql = $obj->query("select price,qty,price_id from $tbl_order_itmes where product_id='".$PResult->id."'");
                                $ProfitArr = array();
                                if($obj->numRows($ProfitSql)>0){

                                  while($ProfitResult = $obj->fetchNextObject($ProfitSql)){
                                    
                                    $totprice = $ProfitResult->price;
                                    $actprice = getField('actual_price',$tbl_productprice,$ProfitResult->price_id);
                                    
                                    if($totprice!=''){
                                      $ProfitPrice = $totprice-$actprice;
                                      $ProfitArr[] = $ProfitPrice*$ProfitResult->qty;
                                    }

                                  }
                                }
                              }
                               //217,181,183,185,5035,220,221,219,223,5164,213,214,216
                              ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo getCategoryTree($line->cat_id,$array=array()); ?></td>
                              <td><?php echo getField('brand',$tbl_brand,$line->brand_id); ?></td>
                              <td><?php echo $line->totlive; ?></td>
                              <td><?php echo $HideResult->tothide; ?></td>
                              <td><?php echo array_sum($ProfitArr); ?></td>
                              <td><?php echo $loss; ?></td>
                            </tr>
                            <?php $i++; }?>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Order Delivered List</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Type</th>
                              <th>Week</th>
                              <th>Month <?php echo date('M'); ?></th>
                              <th>Year- <?php echo date('Y'); ?></th>
                              <th>Avg Order</th>
                              <th>Avg Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                           <?php
                            //Express
                            $WeekSql1=$obj->query("select count(id) as totB from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) and ship_type='Express'",$debug=-1);
                            $WeekResult1=$obj->fetchNextObject($WeekSql1);

                            $MonthSql1=$obj->query("select count(id) as totC from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and ship_type='Express'",$debug=-1);
                            $MonthResult1=$obj->fetchNextObject($MonthSql1);

                            $YearSql1=$obj->query("select count(id) as totD,sum(amount) as totamt from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) and ship_type='Express'",$debug=-1);
                            $YearResult1=$obj->fetchNextObject($YearSql1);
                            ?>
                            <tr>
                              <td>Express</td>
                              <td><?php echo $WeekResult1->totB; ?></td>
                              <td><?php echo $MonthResult1->totC; ?></td>
                              <td><?php echo $YearResult1->totD; ?></td>
                              <td><?php echo number_format(($YearResult1->totD/365)*100,2); ?>%</td>
                              <td><?php echo number_format(($YearResult1->totamt/$YearResult1->totD)*100,2); ?>%</td>
                            </tr>
                            

                            <?php
                            //02:00 PM - 04:00 PM
                            $WeekSql2=$obj->query("select count(id) as totB from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) and ship_type='Normal' and ship_timing='07:00 AM - 09:00 AM'",$debug=-1);
                            $WeekResult2=$obj->fetchNextObject($WeekSql2);

                            $MonthSql2=$obj->query("select count(id) as totC from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and ship_type='Normal' and ship_timing='07:00 AM - 09:00 AM'",$debug=-1);
                            $MonthResult2=$obj->fetchNextObject($MonthSql2);


                            $YearSql2=$obj->query("select count(id) as totD,sum(amount) as totamt from $tbl_order where order_status=4 and order_date <='$currdate' and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) and ship_type='Normal' and ship_timing='07:00 AM - 09:00 AM'",$debug=-1);
                            $YearResult2=$obj->fetchNextObject($YearSql2);
                            ?>
                             <tr>
                              <td>Standard (07:00 AM - 09:00 AM)</td>
                              <td><?php echo $WeekResult2->totB; ?></td>
                              <td><?php echo $MonthResult2->totC; ?></td>
                              <td><?php echo $YearResult2->totD; ?></td>
                              <td><?php echo number_format(($YearResult2->totD/365)*100,2); ?>%</td>
                              <td><?php echo number_format(($YearResult2->totamt/$YearResult2->totD)*100,2); ?>%</td>
                            </tr>

                            <?php
                            $WeekSql3=$obj->query("select count(id) as totB from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) and ship_type='Normal' and ship_timing='02:00 PM - 04:00 PM'",$debug=-1);
                            $WeekResult3=$obj->fetchNextObject($WeekSql3);

                            $MonthSql3=$obj->query("select count(id) as totC from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and ship_type='Normal' and ship_timing='02:00 PM - 04:00 PM'",$debug=-1);
                            $MonthResult3=$obj->fetchNextObject($MonthSql3);


                            $YearSql3=$obj->query("select count(id) as totD,sum(amount) as totamt from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) and ship_type='Normal' and ship_timing='02:00 PM - 04:00 PM'",$debug=-1);
                            $YearResult3=$obj->fetchNextObject($YearSql3);
                            ?>
                            <tr>
                              <td>Standard (02:00 PM - 04:00 PM)</td>
                              <td><?php echo $WeekResult3->totB; ?></td>
                              <td><?php echo $MonthResult3->totC; ?></td>
                              <td><?php echo $YearResult3->totD; ?></td>
                              <td><?php echo number_format(($YearResult3->totD/365)*100,2); ?>%</td>
                              <td><?php echo number_format(($YearResult3->totamt/$YearResult3->totD)*100,2); ?>%</td>
                            </tr>

                            <?php
                            $WeekSql4=$obj->query("select count(id) as totB from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) and ship_type='Normal' and ship_timing='06:00 PM - 09:00 PM'",$debug=-1);
                            $WeekResult4=$obj->fetchNextObject($WeekSql4);

                            $MonthSql4=$obj->query("select count(id) as totC from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and ship_type='Normal' and ship_timing='06:00 PM - 09:00 PM'",$debug=-1);
                            $MonthResult4=$obj->fetchNextObject($MonthSql4);


                            $YearSql4=$obj->query("select count(id) as totD,sum(amount) as totamt from $tbl_order where order_status=4 and order_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) and ship_type='Normal' and ship_timing='06:00 PM - 09:00 PM'",$debug=-1);
                            $YearResult4=$obj->fetchNextObject($YearSql4);
                            ?>
                            <tr>
                              <td>Standard (06:00 PM - 09:00 PM)</td>
                              <td><?php echo $WeekResult4->totB; ?></td>
                              <td><?php echo $MonthResult4->totC; ?></td>
                              <td><?php echo $YearResult4->totD; ?></td>
                              <td><?php echo number_format(($YearResult4->totD/365)*100,2); ?>%</td>
                              <td><?php echo number_format(($YearResult4->totamt/$YearResult4->totD)*100,2); ?>%</td>
                            </tr>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Customer Suport</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">

                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Employee Name</th>
                              <th>Today Call</th>
                              <th>New Call</th>
                              <th>Pending Call</th>
                              <th>Convert Call (Same Day Order)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $sql=$obj->query("select id,emp_name,emp_surname,emp_mobile1 from $tbl_admin where status=1 and department=12 and designation=38",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){
                              
                              $TSql=$obj->query("select count(id) as tot from $tbl_user_assign where emp_id='".$line->id."' and status=1 and Date(call_date)=Curdate() group by emp_id ",$debug=-1);
                              $TResult=$obj->fetchNextObject($TSql);

                              $NSql=$obj->query("select count(id) as tot from $tbl_user_assign where emp_id='".$line->id."' and call_date is null and  DATE(assign_date) = Curdate() group by emp_id ",$debug=-1);
                              $NResult=$obj->fetchNextObject($NSql);

                              $PSql=$obj->query("select count(id) as tot from $tbl_user_assign where emp_id='".$line->id."' and status=1 and Date(assign_date)< Curdate() and call_date is null group by emp_id ",$debug=-1);
                              $PResult=$obj->fetchNextObject($PSql);

                              $RSql=$obj->query("select count(id) as tot from $tbl_user_assign where emp_id='".$line->id."' and status=2 and call_date is not null group by emp_id ",$debug=-1);
                              $RResult=$obj->fetchNextObject($RSql);
                              ?>
                              <tr>
                                <td><?php echo $line->emp_name." ".$line->emp_surname; ?></td>
                                <td><?php echo $TResult->tot; ?></td>
                                <td><?php echo $NResult->tot; ?></td>
                                <td><?php echo $PResult->tot; ?></td>
                                <td><?php echo $RResult->tot; ?></td>
                              </tr>
                              <?php $i++; }?>
                            </tbody>
                            <tfoot>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>


              <div class="row">

             <!--  <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Manage Fixed Capital</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-responsive" style="overflow: scroll; max-height: 260px;">
                        <table id="social-list" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>SNo.</th>
                              <th>Category</th>
                              <th>Month-<?php echo date('M'); ?></th>
                              <th>Year-<?php echo date('Y'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i=1;
                            $sql=$obj->query("select id,categoryname from $tbl_cashcategory where status=1",$debug=-1);
                            while($line=$obj->fetchNextObject($sql)){
                            
                            //Month
                            $MFSql = $obj->query("select sum(amount) as tot_dcredit from $tbl_fixedcapital where type='Dr' and cat_id='".$line->id."' and rdate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) group by cat_id",$debug=-1);
                            $MFResult=$obj->fetchNextObject($MFSql);

                            $MRSql = $obj->query("select sum(amount) as tot_credit from $tbl_fixedcapital where type='Cr' and cat_id='".$line->id."' and rdate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) group by cat_id",$debug=-1);
                            $MRResult=$obj->fetchNextObject($MRSql);

                            $MonthAmount = number_format($MRResult->tot_credit-$MFResult->tot_dcredit,2);

                            //Year
                            $YFSql = $obj->query("select sum(amount) as tot_dcredit from $tbl_fixedcapital where type='Dr' and cat_id='".$line->id."' and rdate >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) group by cat_id",$debug=-1);
                            $YFResult=$obj->fetchNextObject($YFSql);

                            $YRSql = $obj->query("select sum(amount) as tot_credit from $tbl_fixedcapital where type='Cr' and cat_id='".$line->id."' and rdate >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) group by cat_id",$debug=-1);
                            $YRResult=$obj->fetchNextObject($YRSql);

                            $YearAmount = number_format($YRResult->tot_credit-$YFResult->tot_dcredit,2);


                            ?>
                            <tr>
                              <td><?php echo $line->id; ?></td>
                              <td><?php echo $line->categoryname; ?></td>
                              <td><?php echo $MonthAmount; ?></td>
                              <td><?php echo $YearAmount; ?></td>
                            </tr>
                            <?php $i++; }?>
                          </tbody>
                          <tfoot>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->


            <div class="col-md-6">
              <div class="box box-default">

                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <script>
window.onload = function() {

var chart1 = new CanvasJS.Chart("chartContainer1", {
  animationEnabled: true,
  title: {
    text: "Manage Fixed Capital Monthly -2018"
  },
  data: [{
    type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00\"", 
    indexLabel: "{label} {y}",
    dataPoints: [
    <?php
    $sql=$obj->query("select id,categoryname from $tbl_cashcategory where status=1",$debug=-1);
    while($line=$obj->fetchNextObject($sql)){
      $MFSql = $obj->query("select sum(amount) as tot_dcredit from $tbl_fixedcapital where type='Dr' and cat_id='".$line->id."' and rdate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) group by cat_id",$debug=-1);
      $MFResult=$obj->fetchNextObject($MFSql);

      $MRSql = $obj->query("select sum(amount) as tot_credit from $tbl_fixedcapital where type='Cr' and cat_id='".$line->id."' and rdate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) group by cat_id",$debug=-1);
      $MRResult=$obj->fetchNextObject($MRSql);

      $MonthAmount = round($MRResult->tot_credit-$MFResult->tot_dcredit);
      ?>
      {y: <?php echo $MonthAmount; ?>, label: "<?php echo $line->categoryname; ?>" },
      <?php }?>
    ]
  }]
});
chart1.render();



var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: "Manage Fixed Capital Year -2018"
  },
  data: [{
    type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00\"%\"",
    indexLabel: "{label} {y}",
    dataPoints: [
    <?php
    $sql=$obj->query("select id,categoryname from $tbl_cashcategory where status=1",$debug=-1);
    while($line=$obj->fetchNextObject($sql)){
      $YFSql = $obj->query("select sum(amount) as tot_dcredit from $tbl_fixedcapital where type='Dr' and cat_id='".$line->id."' and rdate >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) group by cat_id",$debug=-1);
      $YFResult=$obj->fetchNextObject($YFSql);

      $YRSql = $obj->query("select sum(amount) as tot_credit from $tbl_fixedcapital where type='Cr' and cat_id='".$line->id."' and rdate >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) group by cat_id",$debug=-1);
      $YRResult=$obj->fetchNextObject($YRSql);

      $YearAmount = round($YRResult->tot_credit-$YFResult->tot_dcredit);
      ?>
      {y: <?php echo $YearAmount; ?>, label: "<?php echo $line->categoryname; ?>" },
      <?php }?>
    ]
  }]
});
chart.render();
}
</script>
<div id="chartContainer1" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="box box-default">

                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                  <div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
    </section>
    </div>
    <?php include("footer.php"); ?>
    <div class="control-sidebar-bg"></div>
  </div>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <script src="js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="js/app.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="js/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="js/demo.js"></script>
<!-- <script src="js/jquery-2.2.3.min.js"></script> -->
<script src="js/select2.full.min.js"></script>
<script type="text/javascript">
   $(".select2").select2();
</script>
</body>
</html>
