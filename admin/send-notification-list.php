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
    <?php include("menu.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="row">
          <div class="col-md-4 listpage"><h4>Manage Send Notification</h4></div>
          <div class="col-md-5"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
          <div class="col-md-3"><p style="text-align:right">
            <span><input type="button" name="add" value="Send Notification"  class="button" onclick="location.href='send-notification-addf.php'" /></span>  
          </p>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <form name="frm" method="post" action="city-del.php" enctype="multipart/form-data">
            <div class="box">
              <div class="box-body">
                <table id="city-grid" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="50px">

                        <div class="squaredFour">
                          <input name="check_all" type="checkbox"  id="check_all" value="check_all" />
                          <label for="check_all"></label>
                        </div>

                      </th>
                      <th width="12%">Schedule Date</th>
                      <th width="58%">Message</th>
                      <th width="15%">User Type</th>
                      <th width="15%">Image</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                $i=1;
                $sql=$obj->query("select * from $tbl_schedule_notification where 1=1 and type=1 order by cdate asc",$debug=-1);
                while($line=$obj->fetchNextObject($sql)){?>
                    <tr>
                      <td>
                      <div class="squaredFour">
                      <input type="checkbox" class="checkall" id="squaredFour<?php echo $line->id;?>" name="ids[]" value="<?php echo $line->id;?>" />
                      <label for="squaredFour<?php echo $line->id;?>"></label>
                      </div>
                      </td>
                      <td><?php echo $line->cdate;?></td>
                      <td><?php echo ucfirst(stripslashes($line->msg)); ?></td>
                      <td><?php if($line->user_type==1){ echo "All"; }else{ echo substr($line->users,0,50); }?></td>
                      <td>
                      <?php if($line->img!=''){?>
                      <img src="../upload_images/notification/<?php echo $line->img;?>" style="height: 70px; width: 100px;"/></td>
                     <?php }?>
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
              <!-- <div class="col-md-9"></div> -->
              <div class="col-md-12">
                <input type="hidden" name="what" value="what" />
<!--       <input type="submit" name="Submit" value="Enable" class="button btn-success" onclick="return del_prompt(this.form,this.value)" />
  <input type="submit" name="Submit" value="Disable" class="button btn-warning" onclick="return del_prompt(this.form,this.value)" /> -->
  <input type="submit" name="Submit" value="Delete" class="button btn-danger" onclick="return del_prompt(this.form,this.value)" />

</div></div>
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
<script src="js/jquery-2.2.3.min.js"></script>
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
<script src="js/demo.js"></script
  <!-- page script -->
  <script>
    $(function () {
      $('#city-grid').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
    });
  </script>
  <script>
  function del_prompt(frmobj,comb)
  {
    //alert(comb);
    if(comb=='Delete'){
      if(confirm ("Are you sure you want to delete record(s)"))
      {
        frmobj.action = "send-notification-del.php";
        frmobj.what.value="Delete";
        frmobj.submit();
      }
      else{ 
       return false;
      }
    }
  }
</script>
<script src="js/change-status.js"></script> 
</body>
</html>