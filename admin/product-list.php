<?php
session_start(); 
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();

unset($_SESSION['pcatname']);
unset($_SESSION['pname']);
unset($_SESSION['pbrand']);
unset($_SESSION['pstatus']);


if (!empty($_POST)) {

	if(!empty($_POST['pcatname'])){
		$_SESSION['pcatname']=$_POST['pcatname'];
	}else{
		unset($_SESSION['pcatname']);
	}

	if(!empty($_POST['psubcatname'])){
		$_SESSION['psubcatname']=$_POST['psubcatname'];
	}else{
		unset($_SESSION['psubcatname']);
	}

	if(!empty($_POST['pname'])){
		$_SESSION['pname']=$_POST['pname'];
	}else{
		unset($_SESSION['pname']);
	}

	if(!empty($_POST['pbrand'])){
		$_SESSION['pbrand']=$_POST['pbrand'];
	}else{
		unset($_SESSION['pbrand']);
	}

	if(!empty($_POST['pstatus'])){
		$_SESSION['pstatus']=$_POST['pstatus'];
	}else{
		unset($_SESSION['pstatus']);
	}

	if(!empty($_POST['pstock'])){
		$_SESSION['pstock']=$_POST['pstock'];
	}else{
		unset($_SESSION['pstock']);
	}


}

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
					<div class="col-md-12"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="col-md-12 listpage"><h4>Manage Product</h4></div>
					</div>

					<div class="col-md-6">

						<div class="row">

							<div class="col-md-3">
								<form name="searchactiveorderfrm" id="searchactiveorderfrm" method="post" action="csv.php?table_name=tbl_product&p=product-list">
									<input type="submit" name="ProductList" class="btn btn-primary" value="Download Product "/>
								</form>
							</div>


							<div class="col-md-3">
								<form name="searchactiveorderfrm" id="searchactiveorderfrm" method="post" action="csv.php?table_name=tbl_productprice&p=product-price-list">
									<input type="submit" name="ProductPriceList" class="btn btn-primary" value="Download Product Price"/>
								</form>
							</div>

							<div class="col-sm-3 col-sm-offset-3">
								<p style="text-align:right"><input type="button" name="add" value="Add Product"  class="btn btn-success" onClick="location.href='product-addf.php'" /></p>	

							</div>

						</div>                    

					</div>

				</div>
			</section>

			<!-- Search Section Start -->
			<div class="box box-primary" style="padding:5px 5px 15px 5px ;margin:10px 15px 0px 15px;width:auto">
				<section class="content-header">
					<form name="searchactiveorderfrm" id="searchactiveorderfrm" method="post" action="product-list.php"> 
						<div class="row">
							<div class="col-md-8"><label>Category</label>
								<select name="pcatname" id="category" class="required form-control select2" >
									<option value="">Select Category</option>
									<?php
									$abc = array();
									$sql=$obj->query("select * from $tbl_category where 1=1 ",$debug=-1); 
									while($line=$obj->fetchNextObject($sql)){
										?>
										<option value="<?php echo $line->id; ?>" <?php echo ($line->id==$_SESSION['pcatname'])?'selected':'' ?> ><?php echo $line->category; ?>
										</option>
									<?php } ?>
								</select>
							</div>

							<div class="col-md-4"><label>Brand </label>
								<select name="pbrand" id="pbrand" class="form-control select2" >
									<option value="">Select Brand</option>
									<?php
									if($_SESSION['pcatname']!=''){
										$brandArr=$obj->query("select * from $tbl_brand where status=1 and cat_id='".$_SESSION['pcatname']."' order by brand desc",$debug=-1); 
										while($resultBrand=$obj->fetchNextObject($brandArr)){
											?>
											<option value="<?php echo $resultBrand->id; ?>"<?php if($resultBrand->id==$_SESSION['pbrand']){?>selected<?php } ?>><?php echo stripslashes($resultBrand->brand); ?></option>
										<?php } 
									}?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4"><label>Product Name</label>
								<input type="text" name="pname" class="form-control" value="<?php if(!empty($_SESSION['pname'])){ echo $_SESSION['pname']; } ?>">
							</div>
							<div class="col-md-2"><label>Status</label>
								<select name="pstatus" class="form-control">
									<option value="">Select</option>
									<option value="1" <?php if(!empty($_SESSION['pstatus'])){ echo ($_SESSION['pstatus']=="1")?'selected':''; } ?>>Enable</option>
									<option value="2" <?php if(!empty($_SESSION['pstatus'])){ echo ($_SESSION['pstatus']=="2")?'selected':''; } ?>>Disable</option>
								</select>
							</div>
							<div class="col-md-2"><label>Stock</label>
								<select name="pstock" class="form-control">
									<option value="">Select</option>
									<option value="1" <?php if(!empty($_SESSION['pstock'])){ echo ($_SESSION['pstock']=="1")?'selected':''; } ?>>In</option>
									<option value="2" <?php if(!empty($_SESSION['pstock'])){ echo ($_SESSION['pstock']=="2")?'selected':''; } ?>>Out</option>
								</select>
							</div> 
							<div class="col-md-1"><label></label>
								<p style="text-align:center">
									<input type="submit" name="name" class="form-control" value="Search" style="background: #337ab7 none repeat scroll 0 0; border-radius: 3px; color: #fff; text-align: center; width: 70px;">
								</p>
							</div>
						</div>
					</form>
				</section>
			</div>
			<div class="box box-primary msg" style="padding:5px 5px 15px 5px ;margin:10px 15px 0px 15px;width:auto; display: none;"></div>
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<!-- /.box -->
						<form name="frm" method="post" action="product-del.php" enctype="multipart/form-data">
							<div class="box">
								<div class="box-body">
									<table id="product-grid"  cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped dataTable no-footer" width="100%">
										<thead>
											<tr>
												<th width='40px'>
												</th>
												<th>Vendor Name</th>
												<th>Product Name</th>
												<th width="180px">Category</th>
												<th>Image</th>
												<th>Home</th>
												<th>Best Seller</th>
												<th>Status</th>
												<th width='80px'>Action</th>

											</tr>
										</thead>
									</table>
								</div>
								<!-- /.box-body -->
							</div>
							<div class="row">
								<!-- <div class="col-md-9"></div> -->
								<div class="col-md-12">
									<input type="hidden" name="what" value="what" />
									<input type="submit" name="Submit" value="Enable" class="button btn-success" onClick="return del_prompt(this.form,this.value)" />
									<input type="submit" name="Submit" value="Disable" class="button btn-warning" onClick="return del_prompt(this.form,this.value)" />
									
										<input type="submit" name="Submit" value="Delete" class="button btn-danger" onClick="return del_prompt(this.form,this.value)" />
									
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
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
<!-- <script src="js/jquery.dataTables.min.js"></script> -->
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/select2.full.min.js"></script>
<script src="js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<script src="js/change-status.js"></script> 
<!-- page script -->

<script>
	function del_prompt(frmobj,comb)
	{
//alert(comb);
if(comb=='Delete'){
	if(confirm ("Are you sure you want to delete record(s)"))
	{
		frmobj.action = "product-del.php";
		frmobj.what.value="Delete";
		frmobj.submit();

	}
	else{ 
		return false;
	}
}
else if(comb=='Disable'){
	frmobj.action = "product-del.php";
	frmobj.what.value="Disable";
	frmobj.submit();
}
else if(comb=='Enable'){
	frmobj.action = "product-del.php";
	frmobj.what.value="Enable";
	frmobj.submit();
}

}

</script>
<script type="text/javascript">
	$(".select2").select2();
</script>

</body>
</html>
<!-- Get Data from Database through ajax -->
<script type="text/javascript" language="javascript" >
	$(document).ready(function() {
		var dataTable = $('#product-grid').DataTable( {
			"processing": true,
			"serverSide": true,
			"stateSave": true,

			"ajax":{
				url :"product-list-ajax.php",
				type: "post",
				error: function(){ 
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

		$('#category').change(function() {
			var cat_id=$(this).val(); 
			$.ajax({
				url:"getBrand.php",
				data:{cat_id:cat_id},
				beforeSend:function(){
					$("#pbrand").html('<option value="">Select Brand</option>');
				},
				success:function(data){
					console.log(data);
					$("#pbrand").append(data);
				}

			})
		})
	} );

	function showOnhome(id,chk){
		$.ajax({
			url:"showProductHome.php",
			data:{id:id,chk:chk,action:'phome'},
			success:function(data){   
				$(".msg").html("Record updated successfully").show().fadeOut('slow');
			}
		})
	}

	function showBestSeller(id,chk){
		$.ajax({
			url:"showProductHome.php",
			data:{id:id,chk:chk,action:'bseller'},
			success:function(data){   
				$(".msg").html("Record updated successfully").show().fadeOut('slow');
			}
		})
	}
</script>

<!-- <script src="js/change-status.js"></script>  -->