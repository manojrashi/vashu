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
    <form name="frm" method="post" action="send-newsletter.php" enctype="multipart/form-data">
    <section class="content-header">
       <div class="row">
      	<div class="col-md-3 listpage"><h4>Send Newsletter </h4></div>
      	
      	<div class="col-md-5">
      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
			    <td width="50%" align="right" bgcolor="#f3f4f6"  class="" ><strong>Select Template:</strong></td>
			    <td width="50%"><select name="news_temp" class="form-control" style="width:240px;" required>
			     <option value="">Select Template</option>
			    <?php 
				$tempArr=$obj->query("select * from tbl_newsletter_template where status=1 order by id desc",$debug=-1);
				while($result=$obj->fetchNextObject($tempArr)){
				?>
			    <option value="<?php echo $result->id; ?>"><?php echo stripslashes($result->title); ?></option>
			    <?php } ?>
			    </select></td>
			    </tr>
			</table>
      </div>
      <div class="col-md-4">
      	<?php if($_SESSION['sess_msg']){ ?>
			<font color="#FF0000"><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></font>
			
			<?php }?>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
		
          <div class="box">
            <div class="box-body">
              <table id="faq-grid" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="50px"><div class="squaredFour">
                      <input name="check_all" type="checkbox"  id="check_all" value="check_all" />
                      <label for="check_all"></label>
                    </div>
                  </th>
                  
                  <th>S No.</th>
                  <th>Email</th>
                  <th>Subscribe Date</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$i=1;
				$sql=$obj->query("select * from $tbl_newsletter where 1=1",$debug=-1);
				while($line=$obj->fetchNextObject($sql)){?>
                <tr>
					<td>
						<div class="squaredFour">
			            <input type="checkbox" class="checkall" id="squaredFour<?php echo $line->id;?>" name="ids[]" value="<?php echo $line->id;?>" />
			            <label for="squaredFour<?php echo $line->id;?>"></label>
			          </div>
					</td>
					<td><?php	echo $i ?></td>
					<td><?php echo $line->email; ?></td>
					<td><?php echo date("d-m-Y",strtotime($line->subscribe_date)); ?></td>
								          
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
		      <input type="submit" name="Submit" value="Send Newsletter" class="button" onclick="return del_prompt(this.form,this.value)" />
		      </div>
		      </div>
				
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    </form>
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
<script src="js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#faq-grid").DataTable();
  });
</script>
<script>
	function del_prompt(frmobj,comb)
		{
		//alert(comb);
			if(comb=='Send Newsletter'){
			frmobj.action = "send-newsletter.php";
			frmobj.what.value="Send Newsletter";
			frmobj.submit();
		}
		
	}

</script>
<script src="js/change-status.js"></script> 
</body>
</html>
