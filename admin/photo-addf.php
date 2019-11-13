<?php
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
 validate_admin();
  $title=$obj->escapestring($_POST['title']);
 
  if($_REQUEST['submitForm']=='yes'){
	$Image=new SimpleImage();
	if($_FILES['photo']['size']>0 && $_FILES['photo']['error']==''){
		$Image= new SimpleImage();
		$img=time().substr($_FILES['photo']['name'],-5);
			move_uploaded_file($_FILES['photo']['tmp_name'],"../upload_images/model/".$img);
			copy("../upload_images/model/".$img,"../upload_images/model/thumb/".$img);
			copy("../upload_images/model/".$img,"../upload_images/model/tiny/".$img);
			$Image->load("../upload_images/model/thumb/".$img);	  
			$Image->resize(274,301);	  
			$Image->save("../upload_images/model/thumb/".$img);	 
			$Image->load("../upload_images/model/tiny/".$img);	  
			$Image->resize(349,252);	  
			$Image->save("../upload_images/model/tiny/".$img);	 

	}
					
					
	if($_REQUEST['id']==''){
		$obj->query("insert into  $tbl_photo set photo='$img',status=1,model_id=".$_REQUEST['model_id']);
		$_SESSION['sess_msg']='Image  added sucessfully';
	} else {
		$sql="update $tbl_photo set status=1 , model_id='".$_REQUEST['model_id']."' ";
		
		if($img){
		$query=$obj->query("select * from $tbl_photo where id=".$_REQUEST['id']);
		$resultImage=$obj->fetchNextObject($query);
		@unlink("../upload_images/model/".$resultImage->photo);
		@unlink("../upload_images/model/thumb/".$resultImage->photo);
		@unlink("../upload_images/model/tiny/".$resultImage->photo);
		$sql.=" ,photo='$img' ";
		}
		$sql.=" where id=".$_REQUEST['id'];
		$obj->query($sql);
		
		$_SESSION['sess_msg']='Image updated sucessfully';
	}
header("location:photo-list.php?model_id=".$_REQUEST['model_id']);
}      
	   
	   
if($_REQUEST['id']!=''){
$sql=$obj->query("select * from $tbl_photo where id=".$_REQUEST['id']);
$result=$obj->fetchNextObject($sql);
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SITE_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript">
function validate(obj)
{

<?php if($_REQUEST['id']==''){ ?>
if(obj.photo.value==''){
alert("Please enter photo");
obj.photo.focus();
return false;
}
<?php } ?>
}
</script>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <?php include("header.php") ?>
  <tr>
    <td align="right" class="paddRtLt70" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle" class="headingbg bodr text14"><em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>Admin: Add Images Of <?php echo ucfirst(getFieldWhere('name','tbl_model','id',$_REQUEST['model_id'])); ?><span  style="float:right; padding-right:10px;">
                  <input type="button" name="add" value="Back to Mode;"  class="button" onclick="location.href='model-list.php'" />
                  &nbsp;&nbsp;
                  <input type="button" name="add" value="View model images"  class="button" onclick="location.href='photo-list.php?model_id=<?php echo $_REQUEST['model_id']; ?>'" />
                  </span></td>
              </tr>
              <form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
                <input type="hidden" name="submitForm" value="yes" />
                <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
                <input type="hidden" name="product_id" value="<?php echo $_REQUEST['product_id'];?>" />
                <tr>
                  <td height="100" align="left" valign="top" bgcolor="#f3f4f6" class="bodr"><table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center" colspan="2" class="paddRt14 paddBot11"><font color="#FF0000"><strong><?php echo $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?></strong></font></td>
                      </tr>
                      <tr>
                        <td width="18%" align="right" class="paddBot11 paddRt14">&nbsp;</td>
                        <td width="82%" align="left" class="paddBot11"></td>
                      </tr>
                      <tr>
                        <td align="right" class="paddBot11 paddRt14"><strong>Image:</strong></td>
                        <td align="left" class="paddBot11"><input type="file" name="photo" />
                          <br/>
                          <?php if(is_file("../upload_images/model/thumb/".$result->photo)){?>
                          <img src="../upload_images/model/thumb/<?php echo $result->photo; ?>" width="100" height="100" border="0" />
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" class="paddRt14 paddBot11">&nbsp;</td>
                        <td align="left" class="paddBot11">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="18%" align="right" class="paddRt14 paddBot11">&nbsp;</td>
                        <td width="82%" align="left" class="paddBot11"><input type="submit" name="submit" value="Submit"  class="submit" border="0"/>
                          &nbsp;&nbsp;
                          <input name="Reset" type="reset" id="Reset" value="Reset" class="submit" border="0" />
                        </td>
                      </tr>
                    </table></td>
                </tr>
              </form>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <?php include('footer.php'); ?>
</table>
</body>
</html>
