<?php
	session_start(); 
	include("../include/config.php");
	include("../include/functions.php"); 
	validate_admin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo SITE_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
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
					frmobj.action = "photo-del.php?model_id=<?php echo $_REQUEST['model_id']?>";
					frmobj.what.value="Delete";
					frmobj.submit();
					
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "photo-del.php?model_id=<?php echo $_REQUEST['model_id']?>";
			frmobj.what.value="Deactivate";
			frmobj.submit();
		}
		else if(comb=='Activate'){
			frmobj.action = "photo-del.php?model_id=<?php echo $_REQUEST['model_id']?>";
			frmobj.what.value="Activate";
			frmobj.submit();
		}
		
		
	}
</script>
  <script type="text/javascript">
function makeLatest(id,chk,model_id){
	$.ajax({
		url:"makeMainImage.php",
		data:{id:id,chk:chk,model_id:model_id},
		success:function(data){
			//alert(data);
		}
		
		})
}
</script>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <?php include("header.php") ?>
    <link rel="stylesheet" href="../colorbox/colorbox.css" />
  <script src="../colorbox/jquery.colorbox.js"></script>
  <tr>
    <td align="right" class="paddRtLt70" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="middle" class="headingbg bodr text14"><em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>Admin: View  Images Of <?php echo ucfirst(getFieldWhere('name','tbl_model','id',$_REQUEST['model_id'])); ?><span  style="float:right; padding-right:10px;">
                  <input type="button" name="add" value="Back to Models"  class="button" onclick="location.href='model-list.php'" />
                  &nbsp;&nbsp;
                  <input type="button" name="add" value="Add Model image"  class="button" onclick="location.href='photo-addf.php?model_id=<?php echo $_REQUEST['model_id']; ?>'" />
                  </span> </td>
              </tr>
              <form name="frm" method="post" action="photo-del.php" enctype="multipart/form-data">
                <input type="hidden" name="model_id" value="<?php echo $_REQUEST['model_id'];?>" />
                <tr>
                  <td height="100" align="left" valign="top" bgcolor="#FFFFFF" class="bodr"><table width="100%" cellpadding="0" cellspacing="0">
                      <?php if($_SESSION['sess_msg']){ ?>
                      <tr>
                        <td  align="center"><font color="#FF0000"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></font></td>
                      </tr>
                      <?php }?>
                      <tr>
                        <td align="left">
							<?php 
							$where='';
							if($_REQUEST['model_id']!=''){
							$where.=" and model_id='".$_REQUEST['model_id']."' ";
							}
							$start=0;
							if(isset($_GET['start'])) $start=$_GET['start'];
							$pagesize=15;
							if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
							$order_by='id';
							if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
							$order_by2='desc';
							if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];
							$sql=$obj->Query("select * from $tbl_photo where 1=1 $where order by $order_by $order_by2 limit $start, $pagesize");
							$sql2=$obj->query("select * from $tbl_photo where 1=1 $where order by $order_by $order_by2",$debug=-1);
							$reccnt=$obj->numRows($sql2);
							if($reccnt==0)
							{
							?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td align="center" valign="middle"><font face="Arial, Helvetica, sans-serif"   color="#FF0000" size="+1">No Record</font></td>
                            </tr>
                          </table>
							<?php 
							}
							else
							{
							?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="6%" align="left" class="padd5" bgcolor="#f3f4f6"><strong>S No.</strong></td>
                              <td width="62%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Image</strong></td>
							  <td width="10%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Likes</strong></td>
							  <td width="10%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Main Image</strong></td>
                              <td width="7%" align="center" bgcolor="#f3f4f6" class="padd5"><strong>Status</strong></td>
                              <td width="10%" align="center" class="padd5" bgcolor="#f3f4f6"><strong>Action</strong></td>
                              <td width="10%" align="center" bgcolor="#f3f4f6" class="padd5" ><input name="check_all" type="checkbox"   id="check_all" onclick="checkall(this.form)" value="check_all" /></td>
                            </tr>
							<?php
							$i=0;
							while($line=$obj->fetchNextObject($sql))
							{
							$i++;
							
							
							if($i%2==0)
							{
							$bgcolor = "#f3f4f6";
							}
							else
							{
							$bgcolor = "";
							}
							?>
                            <tr bgcolor="<?php echo $bgcolor;?>">
                              <td class="padd5"><strong><?php echo $i+$start; ?>.</strong></td>
							  <td class="padd5"><?php if(is_file("../upload_images/model/thumb/".$line->photo)){?>
                                <img src="../upload_images/model/thumb/<?php echo $line->photo; ?>"  border="0" width="100" height="100" />
                                <?php } else{ ?>
                                <img src="../images/no_image_thumb.png" width="100" height="100"  />
                                <?php } ?>
                              </td>
								<script>
									$(document).ready(function(){
										$(".iframeenq<?php echo $line->id; ?>").colorbox({iframe:true, width:"300px;", height:"300px;", frameborder:"0",scrolling:true});
									});
								</script>
							   <td class="padd5"><strong><?php echo getPerPhotoLikePoints($_REQUEST['model_id'],$line->id); ?>
								<span style="text-align:right; margin: 1px 1px 1px 26px;">
								<a href="editlikes.php?photo_id=<?php echo $line->id; ?>&model_id=<?php echo $_REQUEST['model_id']; ?>"  class="iframeenq<?php echo $line->id; ?>" >Add Point</a>
								</span>
							   </strong></td>
							  <td class="padd5"><input type="radio" name="latest" value="<?php echo $line->id;?>" <?php if($line->main==1){ ?>checked<?php } ?> onclick="return makeLatest(this.value,this.checked,<?php echo $_REQUEST['model_id']; ?>)" /></td>
                              <td align="center" valign="middle" class="padd5"><?php if($line->status==1){?>
                                <img src="images/enable.gif" title="Activated" />
                                <?php  } else{ ?>
                                <img src="images/disable.gif" title="Deactivated" />
                                <?php }?>
                              </td>
                              <td align="center" valign="middle" class="padd5"><a href="photo-addf.php?id=<?php echo $line->id;?>&model_id=<?php echo $_REQUEST['model_id']; ?>" ><img src="images/edit3.gif" border="0" title="Edit" /></a> </td>
                              <td align="center" valign="middle" class="padd5"><input type="checkbox" name="ids[]" value="<?php echo $line->id;?>" />
                              </td>
                            </tr>
                            <?php
																
																}
																
																?>
                            <tr>
                              <td valign="top" colspan="8"  align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td valign="top" colspan="8"  align="right" class="dark_red"><?php include("../include/paging.inc.php"); ?>
                              </td>
                            </tr>
                            <tr>
                              <td align="right"  style="padding-right:80px;" colspan="8"><input type="hidden" name="what" value="what" />
                                <input type="submit" name="Submit" value="Activate" class="button" onclick="return del_prompt(this.form,this.value)" />
                                <input type="submit" name="Submit" value="Deactivate" class="button" onclick="return del_prompt(this.form,this.value)" />
                                <input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value)" /></td>
                            </tr>
                          </table>
                          <?php }?>
                        </td>
                      </tr>
                    </table></td>
                </tr>
              </form>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="100"></td>
  </tr>
  <?php include('footer.php'); ?>
</table>
</body>
</html>
