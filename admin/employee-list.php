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
<script src="js/jquery-2.2.3.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
           <div class="row">
      	<div class="col-md-3 listpage"><h4>Manage Employee</h4></div>
      	<div class="col-md-6"><p style="text-align:center"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p></div>
      	<div class="col-md-3"><p style="text-align:right">
      		<span><input type="button" name="add" value="Add Employee"  class="button" onclick="location.href='employee-addf.php'" /></span>	
      		</p>
      	</div>
      </div>
    </section>
    <div class="box box-primary" style="padding:5px 5px 15px 5px ;margin:10px 15px 0px 15px;width:auto">
    <section class="content-header">
      <form name="searchemployeefrm" id="searchemployeefrm" method="post" accept="employee-list.php"> 
        <div class="row">
          <div class="col-md-3"><label>Employee Name</label>
            <input type="text" name="search_emp_name" class="form-control" value="<?php if($_POST['search_emp_name']!=''){ echo $_POST['search_emp_name']; } ?>">
          </div>
         
          <div class="col-md-2"><label>Mobile No.</label>
            <input type="text" name="search_emp_mobile1" class="form-control" value="<?php if($_POST['search_emp_mobile1']!=''){ echo $_POST['search_emp_mobile1']; } ?>">
          </div>
           <div class="col-md-3"><label>User Type</label>
            <select name="search_user_type" id="search_user_type" class="required form-control">
                  <option value="">Select Type</option>
                 <?php
                  $RoleSql = $obj->query("select * from $tbl_rolecategory where status=1");
                  while($RoleResult = $obj->fetchNextObject($RoleSql)){?>
                  <option value="<?php echo $RoleResult->id; ?>" <?php if($_POST['search_user_type']==$RoleResult->id){?> selected <?php } ?>><?php echo $RoleResult->role; ?></option>
                  <?php } ?>
                </select>
          </div>
          <div class="col-md-2"><label>&nbsp;</label>
            <input type="submit" name="name" class="form-control" value="Search" style="background: #337ab7 none repeat scroll 0 0; border-radius: 3px; color: #fff; text-align: center;">
          </div>
           <div class="col-md-2"><label>&nbsp;</label>
            <a href="employee-list.php" class="form-control" style="background: #337ab7 none repeat scroll 0 0; border-radius: 3px; color: #fff; text-align: center;">Search All</a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-1"><label>&nbsp;</label></div>
          
         
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
		<form name="frm" method="post" action="employee-del.php" enctype="multipart/form-data">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width='5%'>
                  	<div class="squaredFour">
                      <input name="check_all" type="checkbox"  id="check_all" value="check_all" />
                      <label for="check_all"></label>
                    </div>
                  </th>
                  <th width="15%">Full Name</th>
                  <th width="10%">Username</th>
                  <th width="10%">Email</th>
                  <th width="15%">Mobile</th>
                  <th width="20%">Type</th>
                  <th width="5%">Status</th>
				          <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$whr='';
				if($_POST['search_emp_name']!=''){
				$search_emp_name = $_POST['search_emp_name'];
				$whr .= " and (emp_name like '%$search_emp_name%' or emp_surname like '%$search_emp_name%')";
				}
				if($_POST['search_emp_mobile1']!=''){
				$search_emp_mobile1 = $_POST['search_emp_mobile1'];
				$whr .= " and emp_mobile1 ='$search_emp_mobile1'";
				}
				if($_POST['search_user_type']!=''){
				$search_user_type = $_POST['search_user_type'];
				$whr .= " and department = '$search_user_type'";
				}
				$i=1;
				$sql=$obj->query("select * from $tbl_admin where 1=1 and user_type='emp' $whr order by id desc",$debug=-1);
				while($line=$obj->fetchNextObject($sql)){?>
                <tr>
					<td><div class="squaredFour">
                  <input type="checkbox" class="checkall" id="squaredFour<?php echo $line->id;?>" name="ids[]" value="<?php echo $line->id;?>" />
                  <label for="squaredFour<?php echo $line->id;?>"></label>
                </div></td>
					<td><?php echo stripslashes($line->emp_name)." ".stripslashes($line->emp_surname);?></td>
					<td><?php echo stripslashes($line->username);?></td>
					<td><!-- <?php echo stripslashes($line->id);?><br/> --><?php echo stripslashes($line->emp_offical_email);?></td>
					<td><?php echo stripslashes($line->emp_mobile1);?></td>
					<td><?php 
          if($line->department!=0 || $line->department!=''){
          echo getField('role',$tbl_rolecategory,$line->department) ;
          echo " >> ";
          $i=0;
          $RoleArr = explode(',',$line->designation);
          foreach ($RoleArr as $val) {
            $count = count($RoleArr);
            $i++;
            echo getField('role',$tbl_rolesubcategory,$val);
            if($count>$i){
              echo " , ";
            }
            
          }
          }?> 
        </td>
          <script>
          $(document).ready(function(){
          $(".iframeDetail<?php echo $line->id; ?>").colorbox({iframe:true, width:"900px;", height:"670px;", frameborder:"0",scrolling:true});
           });
          </script>

          <td align="center"><?php if($line->status==1){?>
          <a href="javascript:void(0)" class="btn btn-primary" title="Activated"> <i class="fa fa-check"></i></a>
          <?php } else{ ?>
          <a href="javascript:void(0)" class="btn btn-danger" title="Deactivated"> <i class="fa fa-close"></i></a>
          <?php }?></td>
          <td>
            <a href="employee-addf.php?id=<?php echo $line->id;?>" class="btn btn-primary" title="Edit Employee"> <i class="fa fa-pencil"></i></a>
            <a href="viewemployee-detail.php?id=<?php echo $line->id;?>" class="iframeDetail<?php echo $line->id; ?> btn btn-primary" title="View Employee"> <i class="fa fa-eye"></i></a></br></br>
            <a href="manage_roles.php?id=<?php echo $line->id;?>" class="btn btn-primary" title="Manage Role"> <i class="fa fa-users"></i></a>
            <a href="resetpass.php?id=<?php echo $line->id;?>" class="btn btn-primary" title="Password Reset"> <i class="fa fa-key"></i></a>
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
          <!-- <div class="col-md-9"></div> -->
          <div class="col-md-12">
          <input type="hidden" name="what" value="what" />
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

<link rel="stylesheet" href="../colorbox/colorbox.css" />
<script src="../colorbox/jquery.colorbox.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>

<script type="text/javascript">

		$("#check_all").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
<script>
	function del_prompt(frmobj,comb)
		{
		//alert(comb);
			if(comb=='Delete'){
				if(confirm ("Are you sure you want to delete record(s)"))
				{
					frmobj.action = "employee-del.php";
					frmobj.what.value="Delete";
					frmobj.submit();
					
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Disable'){
			frmobj.action = "employee-del.php";
			frmobj.what.value="Disable";
			frmobj.submit();
		}
		else if(comb=='Enable'){
			frmobj.action = "employee-del.php";
			frmobj.what.value="Enable";
			frmobj.submit();
		}
	}

</script>
</body>
</html>
