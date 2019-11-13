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
                        <h4>Manage Working Capital</h4>
                    </div>
                    <div class="col-md-9">
                        <p style="text-align:center">
                            <?php if($_SESSION[ 'sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> 
                            <?php }?>
                        </p>
                    </div>
<!--                     <div class="col-md-3">
                        <p style="text-align:right">
                            <span><input type="button" name="add" value="Add Fixed Capital"  class="button btn-success" onclick="location.href='fixedcapital-addf.php'" /></span> 
                        </p>
                    </div> -->
                </div>
            </section>
       <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- /.box -->
                        <form name="frm" method="post" action="fixedcapital-del.php" enctype="multipart/form-data">
                            <div class="box">
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                
                                                <th width="30%">Category</th>
                                                <th width="10%">Total Credit</th>
                                                <th width="10%">Total Debit</th>
                                                <th width="13%">Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $i=1; 
                                        $sql=$obj->query("select * from $tbl_fixedcapital where 1=1 and cat_id in (2,3) $whr group by cat_id",$debug=-1);
                                        while($line=$obj->fetchNextObject($sql)){?>
                                            <tr>
                                                
                                                <td class="padd5"><?php echo getField('categoryname',$tbl_cashcategory,$line->cat_id); ?></td>
                                                <td class="padd5">
                                                    <a href="javascript:void(0);" class="btn btn-primary" title="View Credit Details" style="width: 120px;">
                                                    <?php echo getTotalFixedCredit($line->cat_id); ?>
                                                    </a>
                                                </td>
                                                <td class="padd5">
                                                    <a href="javascript:void(0);" class="btn btn-primary" style="width: 120px;">
                                                    <?php if(getTotalFixeddebit($line->cat_id)!=''){ echo getTotalFixeddebit($line->cat_id); }else{ echo "0.00"; } ?>
                                                    </a>
                                                     <?php
                                                     if($line->cat_id==2){ ?>
                                                    <a href="fixedhr-list.php" class="btn btn-primary" title="Add Space & Setup">
                                                    <i class="fa fa-plus"></i>
                                                    <?php }else if($line->cat_id==3){ ?>
                                                     <a href="fixedrentmonthly-list.php" class="btn btn-primary" title="Add Logistics">
                                                     <i class="fa fa-plus"></i>
                                                     <?php } ?>
                                                   
                                                </td>
                                                <td class="padd5"><?php echo number_format(getTotalFixedCredit($line->cat_id)-getTotalFixeddebit($line->cat_id),2);?></td>
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
        $(function() {
            $("#example1").DataTable();
        });
    </script>
    <script>
        function del_prompt(frmobj, comb) {
            if (comb == 'Delete') {

                if (confirm("Are you sure you want to delete record(s)")) {
                    frmobj.action = "fixedcapital-del.php";

                    frmobj.what.value = "Delete";

                    frmobj.submit();
                } else {
                    return false;
                }
            } 
        }
    </script>
<script src="js/change-status.js"></script> 
<link rel="stylesheet" href="calender/css/jquery-ui.css">
  <script src="calender/js/jquery-ui.js"></script>
  <script>
    $(function() {
        $( "#service_date_to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+10?>',
        dateFormat: "yy-mm-dd",
        });

        $( "#service_date_from" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+10?>',
        // minDate: 0,
        // MaxDate: 'today',
        dateFormat: "yy-mm-dd",
        });

        $( "#pollution_date_to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+10?>',
        dateFormat: "yy-mm-dd",
        });

        $( "#pollution_date_from" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+10?>',
        // minDate: 0,
        // MaxDate: 'today',
        dateFormat: "yy-mm-dd",
        });

        $( "#insurance_date_to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+10?>',
        dateFormat: "yy-mm-dd",
        });

        $( "#insurance_date_from" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+10?>',
        // minDate: 0,
        // MaxDate: 'today',
        dateFormat: "yy-mm-dd",
        });

        $( "#permit_date_to" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+10?>',
        dateFormat: "yy-mm-dd",
        });

        $( "#permit_date_from" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'<?php echo date('Y')-10?>:<?php echo date('Y')+10?>',
        // minDate: 0,
        // MaxDate: 'today',
        dateFormat: "yy-mm-dd",
        });

    });
    </script>
</body>

</html>
