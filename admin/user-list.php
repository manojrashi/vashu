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
					<div class="col-md-3">
						<h4>Manage Customer</h4>
					</div>
					<div class="col-md-5">
						<p style="text-align:center">
							<?php if($_SESSION[ 'sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> 
						<?php }?>
					</p>
				</div>

				<!-- <div class="col-md-2">
					<form class="form-horizontal" action="csv.php?table_name=tbl_user" method="post" name="upload_excel"   
					enctype="multipart/form-data">
						<input type="submit" name="UserList" class="btn btn-primary" value="Export Data"/>
					</form>
				</div> -->
			<!-- <div class="col-md-4">
				<p style="text-align:right">
					<span><input type="button" name="add" value="Add Customer"  class="button btn-success" onclick="location.href='user-addf.php'" /></span> 
				</p>
			</div> -->


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
										<th width='40px'>										</th>
										<th>ID</th>
										<th width="100px">Name</th>
										<th width="60px">Email</th>
										<th width="200px">Mobile</th>
										<th width="200px;">Address</th>
										<th width="200px">Status</th>
										<th width="100px">Action</th>

									</tr>
								</thead>
							</table>
						</div>

					</div>
					<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-4" align="right">
							<input type="hidden" name="what" value="what" />
							<input type="submit" name="Submit" value="Blocked" class="button btn-success" onclick="return del_prompt(this.form,this.value)" />
							<input type="submit" name="Submit" value="Enable" class="button btn-success" onclick="return del_prompt(this.form,this.value)" />
							
								<input type="submit" name="Submit" value="Disable" class="button btn-warning" onclick="return del_prompt(this.form,this.value)" />
								<?php if($_SESSION['user_type']=='superadmin'){?>
								<input type="submit" name="Submit" value="Delete" class="button btn-danger" onclick="return del_prompt(this.form,this.value)" />
							<?php }?>

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
<div class="control-sidebar-bg"></div>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<script src="js/fastclick.js"></script>
<script src="js/app.min.js"></script>
<script src="js/demo.js"></script>
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
		} else if (comb == 'Assign') {
			var emp_id = frmobj.emp_id.value;
			var assign_date = frmobj.assign_date.value;
			if(frmobj.emp_id.value==''){
				alert("Please select employee");
				return false;
			}
			if(frmobj.assign_date.value==''){
				alert("Please select assign date");
				return false;
			}
			frmobj.action = "user-del.php?emp_id="+emp_id+"&assign_date="+assign_date;
			frmobj.what.value = "Assign";
			frmobj.submit();
		} 
	}
</script>
<script src="js/change-status.js"></script> 

<!-- Get Data from Database through ajax -->

<script type="text/javascript" language="javascript" >
	$(document).ready(function() {
		var dataTable = $('#product-grid').DataTable( {
			"processing": true,
			"serverSide": true,
			"stateSave": true,

			"ajax":{
url :"user-list-ajax.php", // json datasource
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


</body>

</html>
