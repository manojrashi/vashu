<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();

if($_REQUEST['submitForm']=='yes'){

    $comments=$obj->escapestring($_REQUEST['comments']);
    $order_status=$obj->escapestring($_REQUEST['order_status']);
    $order_id=$obj->escapestring($_REQUEST['order_id']);
    $payment_status=$obj->escapestring($_REQUEST['payment_status']);


    $CSql = "";
    $OSql ="";

    if($order_status!=''){
        $CSql .="order_status='$order_status'";
    }
    if($comments!=''){
        $CSql .=", comments='$comments'";
    }
    if($payment_status!=''){
        $OSql .=",payment_status='$payment_status'";
    }

    if($order_id!=''){
        $CSql .=", order_id='$order_id'";
    }

$obj->query("insert into $tbl_order_comments set $CSql ,posted_date=now(),posted_by='".$_SESSION['sess_admin_id']."'",$debug=-1); //die;

//Manage Stock Start
$obj->query("update $tbl_order set order_status='$order_status',delivered_user_id='".$_SESSION['sess_admin_id']."' $OSql, delivered_date=now() where id='$order_id'",$debug=-1); //die;

if($payment_status==1 && $order_status==3){
    $ItemSql = $obj->query("select * from $tbl_order_itmes where order_id='$order_id'");
    while($ItemResult = $obj->fetchNextObject($ItemSql)){
        $pid = $ItemResult->product_id;
        $prid = $ItemResult->price_id;
        $in_stock = getField('in_stock',$tbl_productprice,$ItemResult->price_id);
        $totqty = getTotalQty($pid,$prid);
        if($in_stock==1 && $totqty!=0){
            $Sql = $obj->query("insert into $tbl_stock set price_id='".$prid."',product_id='".$pid."',totqty='".$ItemResult->qty."',type='Dr'");
            $totqty = getTotalQty($pid,$prid);
            if($totqty==0 || $totqty < 1){
                $PSql = $obj->query("update $tbl_productprice set in_stock=0 where price_id='$prid'");
            }
        }else{
            $PSql = $obj->query("update tbl_productprice set in_stock=0 where price_id='$prid'");
        }
    }
//Manage Stock End


}



$_SESSION['sess_msg']="Comment posted successfully.!";

}

if($_REQUEST['order_id']!=''){
    $OSql = $obj->query("select * from $tbl_order where id ='".$_REQUEST['order_id']."'");
    $OResult = $obj->fetchNextObject($OSql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo SITE_TITLE; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/admin.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>

            <td align="left" valign="middle" class="headingbg bodr text14">

                <em><img src="images/arrow2.gif" width="21" height="21" hspace="10" align="absmiddle" /></em>Admin: Add Comment

                On Order ID : <?php echo $_REQUEST['order_id']; ?></td>

            </tr>



            <tr>

                <td height="100" align="left" valign="top" bgcolor="#f7faf9" class="bodr">

                    <form name="frm" id="frm" method="POST" enctype="multipart/form-data" action="" onSubmit="return validate(this)">

                        <input type="hidden" name="submitForm" value="yes" />

                        <input type="hidden" name="order_id" value="<?php echo $_REQUEST['order_id'];?>" />

                        <table width="100%" cellpadding="0" cellspacing="0">

                            <tr><td align="center" colspan="2" style="color:#C00;"><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']=''; ?></td></tr>
                            <tr>
                                <td width="33%" align="right" class="paddBot11 paddRt14"><strong>Current Status</strong></td>
                                <td width="67%" align="left" class="paddBot11"><select name="order_status" class="form-control" id="order_status">
                                    <option value="">Select  Status</option>
                                    <?php $statusArr=$obj->query("select * from $tbl_order_status where status=1 ");

                                    $current_status=getField('order_status',$tbl_order,$_REQUEST['order_id']);

                                    while($resultStatus=$obj->fetchNextObject($statusArr)){ ?>

                                        <option value="<?php echo $resultStatus->id; ?>" <?php if($resultStatus->id==$current_status){ ?>selected<?php } ?>><?php echo stripslashes($resultStatus->order_status); ?></option>

                                    <?php } ?>

                                </select></td>

                            </tr>
                            <tr id="other_detials">

                                <td width="33%" align="right" class="paddBot11 paddRt14"><strong>Payment Status</strong></td>

                                <td width="67%" align="left" class="paddBot11"><select name="payment_status" style="width:240px;"  onchange="return showFields(this.value)">

                                    <?php   $current_status=getField('payment_status',$tbl_order,$_REQUEST['order_id']);?>

                                    <option value="">Select</option>

                                    <option value="1" <?php if($current_status==1){ ?>selected<?php } ?>>Successfull</option>

                                    <option value="0" <?php if($current_status==0){ ?>selected<?php } ?>>Unsuccessfull</option>

                                </select></td>

                            </tr>


                        </div>
                        <tr>
                            <td width="33%" align="right" class="paddBot11 paddRt14"><strong>Comment</strong></td>
                            <td width="67%" align="left" class="paddBot11"><textarea name="comments" rows="5" cols="40"></textarea></td>
                        </tr>







                        <tr>

                            <td align="right" class="paddRt14 paddBot11">&nbsp;</td>

                            <td align="left" class="paddBot11">&nbsp;</td>

                        </tr>

                        <tr>

                            <td width="33%" align="right" class="paddRt14 paddBot11">&nbsp;</td>

                            <td width="67%" align="left" class="paddBot11">

                                <input type="submit" id="btnsubmit" name="submit" value="Submit"  class="submit" border="0" />&nbsp;&nbsp;&nbsp;&nbsp;</td>

                            </tr>

                        </table>

                    </form>

                </td>

            </tr>

            <tr><td align="center"> 	    </td></tr>



            <?php $commentArr=$obj->query("select * from $tbl_order_comments where order_id='".$_REQUEST['order_id']."'  order by id desc ");

            if($obj->numRows($commentArr)>0){?>

                <tr><td><table width="100%" border="0" cellspacing="4" cellpadding="4" bgcolor="#f7faf9" class="bodr">
              <tr>
                <td width="21%"><strong>Date</strong></td>
                <td width="21%"><strong>Posted By</strong></td>
                <td width="21%"><strong>Order Status</strong></td>
                <td width="58%"><strong>Comment</strong></td>
              </tr>
              <?php while($resultComment=$obj->fetchNextObject($commentArr)){?>
                <tr>
                  <td><?php echo date('d M Y H:i',strtotime($resultComment->posted_date)); ?></td>
                  <td><?php echo getField('emp_name',$tbl_admin,$resultComment->posted_by)." ".getField('emp_surname',$tbl_admin,$resultComment->posted_by); ?></td>
                  <td><?php echo getField('order_status',$tbl_order_status,$resultComment->order_status); ?></td>
                  <td><?php echo stripslashes($resultComment->comments); ?></td>
                </tr>
              <?php } ?>
            </table>

        </td></tr>

    <?php } ?>           



</table>

</td></tr>



</table>

</body>

</html>

