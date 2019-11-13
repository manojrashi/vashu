<?php 
session_start(); 
include( "../include/config.php"); 
include( "../include/functions.php"); 
validate_admin(); 

 $userSal= $obj->query("select status from $tbl_user where id='".$_REQUEST['id']."'");
 $userResult = $obj->fetchNextObject($userSal); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>
        <?php echo SITE_TITLE; ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left" valign="middle" class="headingbg bodr text14">
                <em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>
				Comment of <?php echo getField('name',$tbl_user,$_REQUEST['id'])." ".getField('surname',$tbl_user,$_REQUEST['id']); ?> :
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f7faf9" class="bodr">
                    <?php $commentArr=$obj->query("select * from $tbl_user_comments where user_id='".$_REQUEST['id']."' order by id desc",$debug=-1); 
                    if($obj->numRows($commentArr)>0){?>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="4" cellpadding="4" bgcolor="#f7faf9" class="bodr">
                                <tr>
                                    <td width="21%"><strong>Date</strong>
                                    </td>
                                    <td width="21%"><strong>Posted By</strong>
                                    </td>
                                    <td width="21%"><strong>User Name</strong>
                                    </td>
                                    <td width="21%"><strong>User Status</strong>
                                    </td>
                                    <td width="58%"><strong>Comments</strong>
                                    </td>

                                </tr>
                                <?php while($resultComment=$obj->fetchNextObject($commentArr)){?>

                                <tr>
                                    <td>
                                        <?php echo date( 'd M Y H:i',strtotime($resultComment->posted_date)); ?></td>
                                    <td>
                                        <?php echo getField('emp_name',$tbl_admin,$resultComment->posted_by)." ".getField('emp_surname',$tbl_admin,$resultComment->posted_by); ?></td>
                                    <td>
                                        <?php echo getField('name',$tbl_user,$resultComment->user_id)." ".getField('surname',$tbl_user,$resultComment->user_id);?></td>
                                    <td>
                                        <?php 
                                        if($resultComment->user_group==1){
                                            echo "Active";                                         
                                        }else if($resultComment->user_group==2){
                                            echo "Inactive";
                                        }else if($resultComment->user_group==3){
                                            echo "Blocked";
                                        }
                                        ?></td>
                                    <td>
                                        <?php echo stripslashes($resultComment->comments); ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                        <td align="center"><strong>No Record Found.</strong>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td align="center"></td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</body>
<style type="text/css">
  .error{color: red;}
</style>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#frm").validate();
  })
</script>
</html>
