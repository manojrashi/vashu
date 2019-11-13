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
          <div class="col-md-3"><h4>Manage All Order List</h4></div>
          <div class="col-md-7"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
      </div>
    </section>


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
                      <th width="20px">&nbsp;</th>
                      <th width="150px;">Order Date/Time</th>
                      <th>Order  ID</th>
                      <th>Amount</th>
                      <th>Method of payment</th>
                      <th>Name/Mobile</th>
                      <th>Ship Address</th>
                      <th width="90px;">Action</th>
                    </tr>
                  </thead>
                </table>
              </div>

            </div>
            <div class="row">
              <!-- <div class="col-md-9"></div> -->
              <div class="col-md-12">
                <input type="hidden" name="what" value="what" />
                <?php if($_SESSION['user_type']=='superadmin'){?>
                  <input type="submit" name="Submit" value="Delete" class="button btn-danger" onclick="return del_prompt(this.form,this.value)" />
                <?php }?>
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

<!-- Get Data from Database through ajax -->

<script type="text/javascript" language="javascript" >
  $(document).ready(function() {
    var dataTable = $('#product-grid').DataTable( {
      "processing": true,
      "serverSide": true,
      "stateSave": true,

      "ajax":{
url :"order-all-list-ajax.php", // json datasource
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

<script>
  function del_prompt(frmobj,comb)
  {
//alert(comb);
if(comb=='Delete'){
  if(confirm ("Are you sure you want to delete record(s)"))
  {
    frmobj.action = "order-del.php";
    frmobj.what.value="Delete";
    frmobj.submit();

  }
  else{ 
    return false;
  }
}

}

</script>
</body>

</html>
