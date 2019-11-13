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
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="row">
					<div class="col-md-3"><h4>Manage Price/Size</h4></div>
					<div class="col-md-6"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
					<div class="col-md-3"><p style="text-align:right">
						<span><input type="button" name="productlist" value="Product List"  class="button " style="margin-right:5px;" onclick="location.href='product-list.php'" /><input type="button" name="add" value="Add Price/Size"  class="button" onclick="location.href='productprice-addf.php?product_id=<?php echo $_REQUEST['product_id']; ?>'" /></span>	
					</p>
				</div>
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
	<table id="example1" class="table table-bordered table-striped">
	<caption style="text-align: center;color: green" id="msg"></caption>
									<thead>
										<tr>
											<th>Size</th>
											<th>Price</th>
											<th>Image</th>
											<th>Total Qty</th>
											<th>IN Stock</th>
											<th>Display Order</th>
											<th>Status</th>
											<th>Action</th>
											<th>
												<div class="squaredFour">
												<input name="check_all" type="checkbox"  id="check_all" value="check_all" />
												<label for="check_all"></label>
												</div>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										$sql=$obj->query("select * from $tbl_productprice where 1=1 and product_id='".$_REQUEST['product_id']."'",$debug=-1);
										while($line=$obj->fetchNextObject($sql)){

											$unitquery=$obj->query("select * from $tbl_unit where status=1 and id=".$line->unit_id);
											$res=$obj->fetchNextObject($unitquery);

											?>
											<tr>

												<td><?php echo stripslashes($line->size)."&nbsp;"; echo stripslashes($res->name_en);?></td>
												<td>
													<?php echo '<strong>Actual: </strong>'.$website_currency_symbol." ".stripslashes($line->actual_price); ?><br/>
													<?php echo '<strong>MRP: </strong>'.$website_currency_symbol." ".stripslashes($line->mrp_price); ?><br/>
													<?php echo '<strong>Discount: </strong>'.stripslashes($line->discount); ?> %<br/>
													<?php echo '<strong>Sell: </strong>'.$website_currency_symbol." ".stripslashes($line->sell_price); ?>
												</td>
												
												<td><?php
													if(is_file("../upload_images/product/tiny/".$line->pphoto)){
														?>
														<img src="../upload_images/product/tiny/<?php echo $line->pphoto; ?>" />
														<?php 	
													}
													?></td>
													<td> <?php echo getTotalQty($_REQUEST['product_id'],$line->id); ?></td>
													<td> <input type="checkbox" name="in_stcock" value="1"  <?php if($line->in_stock==1){ ?>checked<?php } ?> onclick="return changeStock(this.checked,<?php echo $line->id; ?>)"/></td>
													

 <td  class="padd5" align="center"><select name="display_order"  style="width:80px;" onchange="return ChangeDisplayOrder(<?php echo $line->id;?>,this.value)">
							<?php for($i=0; $i<=10;$i++){ ?>
															


	<option value="<?php echo $i; ?>" <?php if($line->display_order== $i){?>selected<?php } ?>><?php echo $i; ?></option>
															<?php } ?>
													</select>
													</td> 
													<td align="center">
													<label class="switch">
													<input type="checkbox" class="chkstatus" value="<?php echo $line->id;?>" <?php echo ($line->status=="1")?'checked':'' ?>  data-one="<?php echo $tbl_productprice?>">
													<div class="slider round"></div>
													</label>

													</td>
															<td align="center">
																<a href="productprice-addf.php?id=<?php echo $line->id;?>&product_id=<?php echo $_REQUEST['product_id']; ?>" class="btn btn-primary" ><i class="fa fa-pencil"></i></a>
															</td>
															<td>
													<div class="squaredFour">
													<input type="checkbox" class="checkall" id="squaredFour<?php echo $line->id;?>" name="ids[]" value="<?php echo $line->id;?>" />
													<label for="squaredFour<?php echo $line->id;?>"></label>
													</div>
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
											<div class="col-md-9"></div>
											<div class="col-md-3">
												<input type="hidden" name="what" value="what" />
												<input type="submit" name="Submit" value="Activate" class="button btn-success" onclick="return del_prompt(this.form,this.value)" />
												<input type="submit" name="Submit" value="Deactivate" class="button btn-warning" onclick="return del_prompt(this.form,this.value)" />
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
		$("#example1").DataTable();
	});
</script>
<script>

	function checkall(objForm)
	{
		len = objForm.elements.length;
		var i=0;
		for( i=0 ; i<len ; i++){
			if (objForm.elements[i].type=='checkbox') 
				objForm.elements[i].checked=objForm.check_all.checked;
		}
	}
	function del_prompt(frmobj,comb)
	{
//alert(comb);
if(comb=='Delete'){
	if(confirm ("Are you sure you want to delete record(s)"))
	{
		frmobj.action = "productprice-del.php?product_id=<?php echo $_REQUEST['product_id']; ?>";
		frmobj.what.value="Delete";
		frmobj.submit();

	}
	else{ 
		return false;
	}
}
else if(comb=='Deactivate'){
	frmobj.action = "productprice-del.php?product_id=<?php echo $_REQUEST['product_id']; ?>";
	frmobj.what.value="Deactivate";
	frmobj.submit();
}
else if(comb=='Activate'){
	frmobj.action = "productprice-del.php?product_id=<?php echo $_REQUEST['product_id']; ?>";
	frmobj.what.value="Activate";
	frmobj.submit();
}


}


function ChangeDisplayOrder(id,val){
	$.ajax({
	url:"changeDisplayOrder.php",
	data:{val:val,id:id},
	beforeSend:function(){
	//
	},
	success:function(data){
	console.log(data);
	 $('#msg').html(data).show().fadeOut('slow');
	}
	})
}

function changeStock(check_box_val,row_id){

  $.ajax({
  url:"changeStock.php",
  data:{box_val:check_box_val,row_id:row_id},
  beforeSend:function(){
  //
  },
  success:function(data){
  console.log(data);
  $('#msg').html(data).show().fadeOut('slow');
  }
  })
}



</script>
<script src="js/change-status.js"></script> 
</body>
</html>
