<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 

 validate_admin();
  $city_id = $obj->escapestring($_POST['city_id']);
  $area_id = $obj->escapestring($_POST['area_id']);
  $society = $obj->escapestring($_POST['society']);
  if($_REQUEST['submitForm']=='yes'){
    
  if($_REQUEST['id']==''){
    $obj->query("insert into $tbl_society set city_id='$city_id',area_id='$area_id',society='$society',status=1 ");
    $_SESSION['sess_msg']='Society  added successfully';  
    
       }else{     
     $sql=" update $tbl_society set city_id='$city_id',area_id='$area_id',society='$society',status=1 ";
     $sql.=" where id='".$_REQUEST['id']."'";
     $obj->query($sql);
     $_SESSION['sess_msg']='Society updated successfully';   
        }
   header("location:society-list.php");
   exit();
  }      
     
     
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_society where id=".$_REQUEST['id']);
$result=$obj->fetchNextObject($sql);
}


?>
<!DOCTYPE html>
<html>
<?php include("head.php"); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include("header.php"); ?>
   <?php include("menu.php"); ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1><?php if($_REQUEST['id']!=''){?>Update <?php }else{?> Add <?php }?> Society</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="society-list.php">View Society</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
		<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>City:</label>
                 <select name="city_id" id="city_id" class="form-control required">
                    <option value="">Select City</option>
                   <?php $cityArr=$obj->query("select * from $tbl_city where status=1 ",$debug=-1);
                     while($resultCity=$obj->fetchNextObject($cityArr)){?>
                    <option value="<?php echo stripslashes($resultCity->id);?>" <?php if($result->city_id==$resultCity->id){?>selected<?php } ?>><?php echo stripslashes($resultCity->city);?></option>
                    <?php } ?>
                  </select>
              </div>
			  <div class="form-group">
                <label>Sector:</label>
                 <select name="area_id" id="area_id" class="form-control required">
                     <option value="">Select Sector</option>
                   <?php 
                   if($_REQUEST['id']!=''){
                       $areaArr=$obj->query("select * from $tbl_area where status=1 ",$debug=-1);
                       while($resultArea=$obj->fetchNextObject($areaArr)){?>
                        <option value="<?php echo stripslashes($resultArea->id);?>" <?php if($result->area_id==$resultArea->id){?>selected<?php } ?>><?php echo stripslashes($resultArea->area);?></option>
                       <?php } 
                   }?>
                  </select>
              </div>
              <div class="form-group">
                <label>Society:</label>
                <input name="society" type="text" id="society"  value="<?php echo stripslashes($result->society);?>" class="form-control required" />
              </div>
            </div>
          </div>
       </div>
		<div class="box-footer">
		<input type="submit" name="submit" value="Submit"  class="button" border="0"/>&nbsp;&nbsp;
		<input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" />
		</div>
		</form>
      </div>
    </section>
  </div>
  <?php include("footer.php"); ?>
  <div class="control-sidebar-bg"></div>
</div>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.min.js"></script>
<script src="js/demo.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
  $("#frm").validate();
  
  $("#city_id").change(function(){
    var city_id=$(this).val(); 
	$.ajax({
		url:"get_area.php",
		data:{city_id:city_id},
		beforeSend:function(){
		$("#area_id").html('<option value="">Select Sector</option>');
		},
		success:function(data){
		$("#area_id").append(data);
		}
	})
 
  })
})
</script>
</body>
</html>
