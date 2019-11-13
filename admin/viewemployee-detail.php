<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
validate_admin();

if($_REQUEST['id']!=''){
	$sql=$obj->query("select * from $tbl_admin where id=".$_REQUEST['id']);
	$result=$obj->fetchNextObject($sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo SITE_TITLE; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/admin.css" rel="stylesheet" type="text/css" />
    
<style>
.personal-profile{
	width:200px;
	float:right;
	margin-left:5px;
}

.drive-addhar-image{
	width: 30% !important;
	float: left !important;
	margin-right: 15px !important;
	}
	
.border-top{
	border-top:1px solid #656565;
	}    
	
.admin-driving-images{
	width: 45%;
    display: inline-block;
    margin-right: 15px;
	}	
	
.admin-driving-images img{
	width:100%
	}	
	
</style>	
</head>
<body>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="left" valign="middle" class="headingbg bodr text14">
				<em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>Admin: Employee Details
			</td>
		</tr>

		<tr>
			<td height="100" align="left" valign="top"  bgcolor="#f7faf9" class="bodr">
				<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td width="23%" align="right" class="paddBot11 paddRt14">&nbsp;</td>
						<td width="10%" align="center" class="paddBot11 paddRt14">&nbsp;</td>
						<td width="33%" align="left" class="paddBot11"> &nbsp </td>
					</tr>
					
					<tr>
						<td colspan="3" align="center"><h2>Personal Details</h2></td>
                        <td align="left" rowspan="6">
                        <?php
                        if(is_file("../upload_images/employee/".$result->img)){?>
                        <img class="personal-profile" src="../upload_images/employee/<?php echo $result->img; ?>" class="img-responsive">
                        <?php }else {?>
                        	<img class="personal-profile" src="images/profile.png" class="img-responsive">
                        <?php }?>
                        </td>
					</tr>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong> Name</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->emp_name)." ".stripslashes($result->emp_surname); ?></td>
						
                    </tr>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Personal Email</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->emp_email);?></td>
					</tr>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Contact No.</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->emp_mobile1)." / ".stripslashes($result->emp_mobile2);?></td>
					</tr>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Local Address</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->emp_laddress);?></td>
					</tr>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Permanent Address</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->emp_paddress);?></td>
					</tr>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Emergency Contact</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->emp_relation1);?>: <?php echo stripslashes($result->emp_emergencycontact1);?>
								&nbsp;
								<?php echo stripslashes($result->emp_relation2);?>: <?php echo stripslashes($result->emp_emergencycontact2);?>
						</td>
					</tr>
						

					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Blood Group</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->bloodgroup);?></td>
					</tr>

					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Bank Name</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->bank_name);?></td>
					</tr>

					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Account Number</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->account_no);?></td>
					</tr>

					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>IFSC Code</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->ifsc);?></td>
					</tr>
					
					
					<?php
					if($result->overtime!='' && $result->overtime!=null){?>	
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Remarks</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->premark);?></td>
					</tr>
					<?php }?>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Aadhar Card / Driving Licence</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>							
						<td align="left" class="paddBot11">	
                        		
                        	<div class="admin-driving-images">     
                            	<?php if(is_file("../upload_images/employee/thumb/".$result->aadharcard)){ ?>
								<img src="../upload_images/employee/thumb/<?php echo $result->aadharcard; ?>"  /><?php }else{?>
								<!-- <img class="drive-addhar-image" src="images/d-image.png"> -->
								<?php }?>
								<?php echo stripcslashes($result->aadharcard_no); ?>
							</div>
                            
							<div class="admin-driving-images">
								<?php if(is_file("../upload_images/employee/thumb/".$result->drivinglicense)){ ?>
								<img src="../upload_images/employee/thumb/<?php echo $result->drivinglicense; ?>"  /><?php }else{?>
								<!-- <img class="drive-addhar-image" src="images/a-images.png"> -->
								<?php }?>
								<?php echo stripcslashes($result->drivinglicense_no); ?>
							</div>
						</td>                            
					</tr>
					  
				<!--	<tr>  
						<td colspan="4"><hr></hr></td>  
					</tr> -->
					
					<tr>
						<td class="border-top" colspan="4" align="center"><h2>Official Details</h2></td>
					</tr>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Email Id</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->emp_offical_email);?></td>
					</tr> 

					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Work Experience (Month)</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->exp);?> Months</td>
					</tr>

					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Weekly Off</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->weeklyoff);?></td>
					</tr>
					
					<?php
					if($result->overtime!='' && $result->overtime!=null){?>
					
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Over Time in Month</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->overtime);?></td>
					</tr>
					<?php }?>
						
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Department</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo getField('role',$tbl_rolecategory,$result->department);?></td>
					</tr>

					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Designation</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11">
								<?php
								$i=0; 
								$designationArr = explode(',',$result->designation);
								if(count($designationArr)>0){

									foreach ($designationArr as $value) {
										$i++;
										echo getField('role',$tbl_rolesubcategory,$value);
										if(count($designationArr)>$i){
											echo " , ";
										}
									}
								}
								?>

						</td>
					</tr>
						
					<?php
					if($result->officeremarks!=''){?>
					<tr>
						<td align="left" class="paddBot11 paddRt14"><strong>Remarks</strong></td>
						<td width="10%" align="center" class="paddBot11 paddRt14">:</td>
						<td align="left" class="paddBot11"><?php echo stripslashes($result->officeremarks);?></td>
					</tr>
					<?php }?>
			
					<tr>
						<td width="23%" align="left" class="paddRt14 paddBot11">&nbsp;</td>
						<td width="10%" align="center" class="paddBot11 paddRt14">&nbsp;</td>
						<td width="67%" align="left" class="paddBot11">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr><td align="center">&nbsp;</td></tr>

		</table>
	</body>
	</html>
