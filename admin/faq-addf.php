<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
 validate_admin();

  $faq_cat=$obj->escapestring($_REQUEST['faq_cat']);
	$question=$obj->escapestring($_REQUEST['question']);
	$answer=$obj->escapestring($_REQUEST['answer']);
	
  
  if($_REQUEST['submitForm']=='yes'){
	   
  if($_REQUEST['id']==''){

	  $obj->query("insert into $tbl_faq set faq_cat='$faq_cat',question='$question',answer='$answer',status=1 ",-1);
	  $_SESSION['sess_msg']='FAQ added successfully';  
	  
       }else{ 	  
	   $sql=" update $tbl_faq set faq_cat='$faq_cat',question='$question',answer='$answer' ";
	  
	   $sql.=" where id='".$_REQUEST['id']."'";
	   $obj->query($sql);
	  $_SESSION['sess_msg']='FAQ updated successfully';   
        }
   header("location:faq-list.php");
   exit();
  }      
	   
	   
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_faq where id=".$_REQUEST['id']);
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
   <script type="text/javascript" src="../include/ckeditor/ckeditor.js"></script>

  <div class="content-wrapper">
    <section class="content-header">
      <h1><?php if($_REQUEST['id']==''){?> Add <?php }else{?> Update <?php }?> FAQ</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="faq-list.php">View FAQ List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="box box-primary">
		<form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="">
		<input type="hidden" name="submitForm" value="yes" />
		<input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
        <div class="box-body">
	      <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Related To:</label>
				<select name="faq_cat"  class="form-control">
                  <option value="">-Select-</option>
                     <?php $catArr=$obj->query("select * from $tbl_faqcat where status=1 order by id ",$debug=-1); 
				     while($resultCat=$obj->fetchNextObject($catArr)){
				     ?>
                  <option value="<?php echo $resultCat->id; ?>"<?php if($resultCat->id==$result->faq_cat){?> selected <?php } ?>><?php echo stripslashes($resultCat->category); ?></option>
                  <?php } ?>                                    
                  
                 </select>
              </div>
              <div class="form-group">
                <label>Question:</label>
				<textarea name="question"  rows="3" cols="30" id="question" class="required form-control"><?php echo stripslashes($result->question);?></textarea>
              </div>
              
            </div>
          </div>
		  
		  <div class="row">
            <div class="col-md-12">
			<div class="form-group">
                <label>Answer:</label>
				<textarea name="answer"  rows="3" cols="30" id="answer" class=" ckeditor form-control"  ><?php echo stripslashes($result->answer);?></textarea>
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
})
</script>
</body>
</html>
