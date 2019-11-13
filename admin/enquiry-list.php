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
					frmobj.action = "enquiry-del.php";
					frmobj.what.value="Delete";
					frmobj.submit();
					
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
			frmobj.action = "enquiry-del.php";
			frmobj.what.value="Deactivate";
			frmobj.submit();
		}
		else if(comb=='Activate'){
			frmobj.action = "enquiry-del.php";
			frmobj.what.value="Activate";
			frmobj.submit();
		}
		
		
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
              <!------------ Search Section ----------------->
              
              <tr>
                <td align="left" valign="middle" class="bodr" style="padding-bottom:20px;"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                    <tr>
                      <td class="headingbg bodr text14" style="padding-left:20px;">Contact Us Enquiry<span  style="float:right; padding-right:10px;"></span></td>
                    </tr>
                    <tr>
                      <td height="10"></td>
                    </tr>
                    <tr>
                      <td><form name="searchForm" method="post" action="enquiry-list.php">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10%" align="right"  ><strong>Name:</strong></td>
                              <td width="15%"><input type="text" name="search_uname" value="<?php echo $_REQUEST['search_uname']; ?>"/></td>
                              <td width="10%" align="right"  ><strong>Email:</strong></td>
                              <td width="15%"><input type="text" name="search_email" value="<?php echo $_REQUEST['search_email']; ?>"/></td>
                              <td width="8%" align="right" ><strong>Contact</strong></td>
                              <td width="19%"><input type="text" name="search_mobile" value="<?php echo $_REQUEST['search_mobile']; ?>"/></td>
                              <td width="7%"><input type="submit" class="button"  name="search" value="Search" /></td>
                              <td width="12%"><a href="enquiry-list.php">View All</a></td>
                            </tr>
                          </table>
                        </form></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              
              <!----- Search End --------->
              <tr>
                <td align="left" valign="middle" class="headingbg bodr text14"><em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>Admin: View Enquiries</td>
              </tr>
              <form name="frm" method="post" action="enquiry-del.php" enctype="multipart/form-data">
                <tr>
                  <td height="100" align="left" valign="top" bgcolor="#FFFFFF" class="bodr"><table width="100%" cellpadding="0" cellspacing="0">
                      <?php if($_SESSION['sess_msg']){ ?>
                      <tr>
                        <td  align="center"><font color="#FF0000"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></font></td>
                      </tr>
                      <?php }?>
                      <tr>
                        <td align="left"><?php 
$where='';
if($_REQUEST['search_uname']!=''){
$name=$_REQUEST['search_uname']	;
$where.=" and ( uname like '$name%' ) ";	
}
if($_REQUEST['search_email']!=''){
$search_email=$_REQUEST['search_email']	;
$where.=" and uemail like '%$search_email%' ";	
}
if($_REQUEST['search_mobile']!=''){
$search_mobile=$_REQUEST['search_mobile']	;
$where.=" and contact = '$search_mobile' ";	
}
$start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=15;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='id';
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='desc';
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];
$sql=$obj->Query("select * from $tbl_enquiry where 1=1 $where order by $order_by $order_by2 limit $start, $pagesize");
$sql2=$obj->query("select * from $tbl_enquiry where 1=1 $where order by $order_by $order_by2",$debug=-1);
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
                              <td valign="top" colspan="11"  align="center" class="dark_red" ><strong><?php echo $reccnt;?> Record found.</strong></td>
                            </tr>
                            <tr>
                              <td width="7%" align="left" class="padd5" bgcolor="#f3f4f6"><strong>S No.</strong></td>
                              <td width="12%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Send Date</strong></td>
                              <td width="9%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Name</strong></td>
                              <td width="12%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Email</strong></td>
                              <td width="11%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Contact</strong></td>
                              <td width="36%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Message</strong></td>
                              <td width="9%" align="left" bgcolor="#f3f4f6" class="padd5"><strong>Details</strong></td>
                              <td width="4%" align="center" bgcolor="#f3f4f6" class="padd5" ><input name="check_all" type="checkbox"   id="check_all" onclick="checkall(this.form)" value="check_all" /></td>
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
                              <td class="padd5"><?php
																			echo date('d M Y H:i',$line->send_date);
																		?></td>
                              <td class="padd5"><?php
																		echo stripslashes($line->uname);
																		?></td>
                              <td class="padd5"><?php
																		echo stripslashes($line->uemail);
																		?></td>
                              <td class="padd5"><?php
																		echo stripslashes($line->contact);
																		?></td>
                              <td class="padd5"><?php echo substr(stripslashes($line->enq_message),0,200); ?></td>
                              <script>

			$(document).ready(function(){
				    $(".iframeenq<?php echo $line->id; ?>").colorbox({iframe:true, width:"800px;", height:"600px;", frameborder:"0",scrolling:true});
				
    			});

		</script>
                              <td class="padd5"><a href="viewenquiry-detail.php?id=<?php echo $line->id; ?>"  class="iframeenq<?php echo $line->id; ?>" >View Detail</a></td>
                              <td align="center" valign="middle" class="padd5"><input type="checkbox" name="ids[]" value="<?php echo $line->id;?>" /></td>
                            </tr>
                            <?php
																
																}
																
																?>
                            <tr>
                              <td valign="top" colspan="11"  align="right">&nbsp;</td>
                            </tr>
                            <tr>
                              <td valign="top" colspan="11"  align="right" class="dark_red" style="padding-right:150px;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td valign="top" colspan="11"  align="right" class="dark_red" style="padding-right:150px;"><?php include("../include/paging.inc.php"); ?></td>
                            </tr>
                            <tr>
                              <td valign="top" colspan="13"  align="right" class="dark_red" style="padding-right:150px;">&nbsp;</td>
                            </tr>
                            <tr>
                              <td align="right"  style="padding-right:80px;" colspan="10"><input type="hidden" name="what" value="what" />
                                <input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value)" /></td>
                            </tr>
                          </table>
                          <?php }?></td>
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