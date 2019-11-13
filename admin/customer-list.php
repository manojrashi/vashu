<?php 
ob_start(); 
session_start(); 
include( '../include/config.php'); 
include( "../include/functions.php"); 
validate_admin(); 
?>
<!DOCTYPE html>
<html>
<?php include( "head.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
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
                    <div class="col-md-3">
                        <h4>Manage Customer</h4>
                    </div>
                    <div class="col-md-9">
                        <p style="text-align:center">
                            <?php if($_SESSION[ 'sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> 
                            <?php }?>
                        </p>
                    </div>
                </div>
            </section>

    <div class="box box-primary" style="padding:5px 5px 15px 5px ;margin:10px 15px 0px 15px;width:auto">
            <section class="content-header">
    <form name="searchactiveorderfrm" id="searchactiveorderfrm" method="post" accept="order-active-list.php"> 
    <div class="row">
    <div class="col-md-3"><label>Customer Name</label>
      <input type="text" name="customer_name" class="form-control" value="<?php if($_POST['customer_name']!=''){ echo $_POST['customer_name']; } ?>">
    </div>
    <div class="col-md-3"><label>Customer ID</label>
      <input type="text" name="customer_id" class="form-control" value="<?php if($_POST['customer_id']!=''){ echo $_POST['customer_id']; } ?>">
    </div>
    <div class="col-md-3"><label>Mobile No.</label>
      <input type="text" name="customer_mobile" class="form-control" value="<?php if($_POST['customer_mobile']!=''){ echo $_POST['customer_mobile']; } ?>">
    </div>
    <div class="col-md-3"><label>Address.</label>
      <input type="text" name="customer_address" class="form-control" value="<?php if($_POST['customer_address']!=''){ echo $_POST['customer_address']; } ?>">
    </div>
    </div>
    
    <div class="row">
    <div class="col-md-3"><label>Delivery Date From</label>
      <input type="text" name="delivery_date_from" id="delivery_date_from" class="form-control" value="<?php if($_POST['delivery_date_from']!=''){ echo $_POST['delivery_date_from']; } ?>">
    </div>
    <div class="col-md-3"><label>To</label>
      <input type="text" name="delivery_date_to" id="delivery_date_to" class="form-control" value="<?php if($_POST['delivery_date_to']!=''){ echo $_POST['delivery_date_to']; } ?>">
    </div>
    <div class="col-md-1"><label>&nbsp;</label></div>
    <div class="col-md-2"><label>&nbsp;</label>
      <input type="submit" name="name" class="form-control" value="Search" style="background: #337ab7 none repeat scroll 0 0; border-radius: 3px; color: #fff; text-align: center;">
    </div>
    <div class="col-md-2"><label>&nbsp;</label>
      <a href="user-list.php" class="form-control" style="background: #337ab7 none repeat scroll 0 0; border-radius: 3px; color: #fff; text-align: center;">Search All</a>
    </div>
    <div class="col-md-1"><label>&nbsp;</label></div>
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
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:50px;">
                                                    <div class="squaredFour">
                                                        <input type="checkbox" class="checkall" id="check_all" name="check_all" value="check_all" />
                                                        <label for="squaredFour<?php echo $line->id;?>"></label>
                                                    </div>
                                                </th>
                                                <th>User Group</th>
                                                <th>Name</th>
                                                <th>Number</th>
                                                <th>Address</th>
                                                <th>Active Order</th>
                                                <th>Last Order</th>
                                                <th style="width: 150px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $i=1; 

                                            $whr = '';
                                            $whr1 ='';

                                            if($_POST['customer_name']!=''){
                                            $customer_name = $_POST['customer_name'];
                                            $whr .= " and name like '%$customer_name%'";
                                            }
                                            if($_POST['customer_id']!=''){
                                            $customer_id = $_POST['customer_id'];
                                            $whr .= " and id ='$customer_id'";
                                            }
                                            if($_POST['customer_mobile']!=''){
                                            $customer_mobile = $_POST['customer_mobile'];
                                            $whr .= " and mobile = '$customer_mobile'";
                                            }
                                            if($_POST['customer_address']!=''){
                                                 $customer_address = $_POST['customer_address'];
                                                $Userid='';
                                                $Cityid='';
                                                $Areaid='';

                                                $AreaSql = $obj->query("select id from $tbl_area where 1=1 and area like '%$customer_address%'",$debug=-1);
                                                while($AreaResult = $obj->fetchNextObject($AreaSql)){
                                                    $Areaid[] = $AreaResult->id;
                                                }

                                                 if(!empty($Areaid)){
                                                    $Areaids = implode(',',$Areaid);
                                                    $whr1 .= " or area in ($Areaids)";
                                                }

                                                $CitySql = $obj->query("select id from $tbl_city where 1=1 and city like '%$customer_address%'",$debug=-1);
                                                while($CityResult = $obj->fetchNextObject($CitySql)){
                                                    $Cityid[] = $CityResult->id;
                                                }

                                                 if(!empty($Cityid)){
                                                    $Cityids = implode(',',$Cityid);
                                                    $whr1 .= " or city in ($Cityids)";
                                                }

                                               
                                                $AddSql = $obj->query("select user_id from $tbl_useraddress where 1=1 and (flat like '%$customer_address%' or flor like '%$customer_address%' or house_no like '%$customer_address%' or block like '%$customer_address%' or sectorno like '%$customer_address%' or  landmark like '%$customer_address%' $whr1 )",$debug=-1);
                                                while($AddResult = $obj->fetchNextObject($AddSql)){
                                                    $Userid[] = $AddResult->user_id;
                                                }

                                                if(!empty($Userid)){
                                                    $Userids = implode(',',$Userid);
                                                    $whr .= " and id in($Userids)";
                                                }
                                            
                                            }
                                            if($_POST['delivery_date_from']!='' && $_POST['delivery_date_to']!=''){
                                                $delivery_date_from = $_POST['delivery_date_from'];
                                                $delivery_date_to = $_POST['delivery_date_to'];
                                                $whr .= " and id in($Userids)";
                                            }

                                            $sql=$obj->query("select * from $tbl_user where 1=1 and status=2 $whr order by id desc",$debug=-1);
                                            while($line=$obj->fetchNextObject($sql)){
                                                //Active Order Query
                                                 $ActiveSql = $obj->query("select ship_timing,order_date from $tbl_order where order_status not in(4,6) and  user_id='".$line->id."' order by id desc limit 0,1");
                                                 $ActiveResult = $obj->fetchNextObject($ActiveSql);
                                                // Last Order Query
                                                $LastSql = $obj->query("select ship_timing,delivered_date from $tbl_order where order_status in(4) and  user_id='".$line->id."' order by id desc limit 0,1");
                                                $LastResult = $obj->fetchNextObject($LastSql);


                                                   if(!is_null($LastResult->delivered_date)){
                                                    
                                                        $Todate = date('d-m-Y'); 
                                                        $orderdate = $LastResult->delivered_date;
                                                        $days = dateDiff($Todate,$orderdate);
                                                        if($days > getField('inactiveuserdays',$tbl_setting,1)){
                                                           $obj->query("update $tbl_user set status=2 where id='".$line->id."'");
                                                        }
                                                    }
                                                    //echo date('d-m-Y',strtotime('01-01-1970'));
                                                /*  End Query */

                                                ?>
                                            <tr>
                                                <td>
                                                    <div class="squaredFour">
                                                        <input type="checkbox" class="checkall" id="squaredFour<?php echo $line->id;?>" name="ids[]" value="<?php echo $line->id;?>" />
                                                        <label for="squaredFour<?php echo $line->id;?>"></label>
                                                    </div>
                                                </td>
                                                <td class="padd5">
                                                    <?php echo getField('groupname',$tbl_usergroup,$line->user_group);?>
                                                        </br>
                                                        <?php
                                                        if($line->status==1){
                                                            echo "( Active )";
                                                        }else if($line->status==2){
                                                            echo "( Inactive )";
                                                        }else if($line->status==3){
                                                            echo "( Blocked )";
                                                        }
                                                        ?>
                                                    </td>
                                                <td class="padd5">
                                                    <?php echo stripslashes($line->title)." ".stripslashes($line->name)." ".stripslashes($line->surname);?></td>
                                                <td class="padd5">
                                                    <?php echo stripslashes($line->mobile);?></td>
                                                <td class="padd5">
                                                <?php
                                                $UserSql = $obj->query("select * from $tbl_useraddress where user_id='".$line->id."'",$debug=-1);
                                                $UserResult = $obj->fetchNextObject($UserSql);
                                                ?>
                                                <?php 
                                                if($UserResult->flat!=''){ echo stripslashes($UserResult->flat); } 
                                                if($UserResult->flor!=''){ echo ", ".stripslashes($UserResult->flor); } 
                                                if($UserResult->house_no!=''){ echo ", ".stripslashes($UserResult->house_no); } 
                                                if($UserResult->street_no!=''){ echo ", ".stripslashes($UserResult->street_no); } 
                                                if($UserResult->block!=''){ echo ", ".stripslashes($UserResult->block); } 
                                                if($UserResult->sectorno!=''){ echo ", ".stripslashes($UserResult->sectorno); } 
                                                if($UserResult->landmark!=''){ echo ", ".stripslashes($UserResult->landmark); } 
                                                if($UserResult->city!=''){ echo ", ".getField('city',$tbl_city,$UserResult->city); } 
                                                if($UserResult->area!=''){ echo ", ".getField('area',$tbl_area,$UserResult->area); } 
                                                if($UserResult->state!=''){ echo ", ".stripslashes($UserResult->state); } 
                                                ?>
                                                </td>
                                                <td align="center" valign="middle" class="padd5">
                                                <?php
                                                if(!is_null($ActiveResult->order_date)){
                                                    echo date('d-m-Y',strtotime($ActiveResult->order_date))."</br>".$ActiveResult->ship_timing;
                                                }
                                                ?>
                                                </td>
                                                <td align="center" valign="middle" class="padd5">
                                                <?php
                                                if(!is_null($LastResult->delivered_date)){
                                                echo date('d-m-Y',strtotime($LastResult->delivered_date))."</br>".$LastResult->ship_timing;
                                                }
                                             
                                                ?>
                                                </td>
                                                <script>
                                                $(document).ready(function(){
                                                $(".iframeStatus<?php echo $line->id; ?>").colorbox({iframe:true, width:"900px;", height:"600px;", frameborder:"0",scrolling:true});
                                                $(".iframeDetail<?php echo $line->id; ?>").colorbox({iframe:true, width:"800px;", height:"600px;", frameborder:"0",scrolling:true});
                                                 });
                                                </script>
                                                <td>
                                                    <!-- <a href="user-addf.php?id=<?php echo $line->id;?>" class="btn btn-primary" title="edit"> <i class="fa fa-pencil"></i>
                                                    </a>&nbsp;
                                                    <a href="useraddress-list.php?id=<?php echo $line->id;?>" class="btn btn-primary" title="Add Address"> <i class="fa fa-envelope"></i>
                                                    </a>
                                                     <a href="changeuser-status.php?id=<?php echo $line->id;?>" class="iframeStatus<?php echo $line->id; ?> btn btn-primary" title="Status Change"> <i class="fa-user-times"></i>
                                                    </a> -->
                                                    <a href="viewuser-detail.php?id=<?php echo $line->id;?>" class="iframeDetail<?php echo $line->id; ?> btn btn-primary" title="View Detail"> <i class="fa fa-eye"></i>
                                                    </a>
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
                            <div class="row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                <input type="hidden" name="what" value="what" />
                                 <input type="submit" name="Submit" value="Blocked" class="button btn-success" onclick="return del_prompt(this.form,this.value)" />
                                <input type="submit" name="Submit" value="Enable" class="button btn-success" onclick="return del_prompt(this.form,this.value)" />
                                <input type="submit" name="Submit" value="Disable" class="button btn-warning" onclick="return del_prompt(this.form,this.value)" />
                                <input type="submit" name="Submit" value="Delete" class="button btn-danger" onclick="return del_prompt(this.form,this.value)" />

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
<script>
 $(document).ready(function() {
    $('#example1').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );
} );


    </script>
    <script>
        function del_prompt(frmobj, comb) {
            if (comb == 'Delete') {

                if (confirm("Are you sure you want to delete record(s)")) {
                    frmobj.action = "user-del.php";

                    frmobj.what.value = "Delete";

                    frmobj.submit();
                } else {
                    return false;
                }
            } else if (comb == 'Disable') {

                frmobj.action = "user-del.php";

                frmobj.what.value = "Disable";

                frmobj.submit();
            } else if (comb == 'Enable') {

                frmobj.action = "user-del.php";

                frmobj.what.value = "Enable";

                frmobj.submit();
            } else if (comb == 'Blocked') {

                frmobj.action = "user-del.php";

                frmobj.what.value = "Blocked";

                frmobj.submit();
            } 
        }
    </script>
<script src="js/change-status.js"></script> 
<link rel="stylesheet" href="calender/css/jquery-ui.css">
  <script src="calender/js/jquery-ui.js"></script>
  <script>
    $(function() {
        $( "#delivery_date_from" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+1?>',
        dateFormat: "yy-mm-dd",
        });

        $( "#delivery_date_to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+1?>',
        // minDate: 0,
        // MaxDate: 'today',
        dateFormat: "yy-mm-dd",
        });
    });
    </script>
</body>

</html>
