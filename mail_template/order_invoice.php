<?php 
include('../include/config.php');
include("../include/functions.php");
session_start();
$OSql=$obj->query("select * from $tbl_order where id='1340'",$debug=-1);
$OSql=$obj->query("select * from $tbl_order where id='".$_SESSION['OrerID']."'",$debug=-1); //die;
$result=$obj->fetchNextObject($OSql);

$Tsql = $obj->query("select id from $tbl_order where user_id='".$result->user_id."' and order_status=4 ");
$TNumRows = $obj->numRows($Tsql);

?>
<p>Hello <?php echo getField('name',$tbl_user,$result->user_id)." ".getField('surname',$tbl_user,$result->user_id); ?></p>
<p>Thank you for shopping with us. We'd like to let you know that YourExpress has received your order, and is preparing it for delivery. Your delivery date and slot is indicated below. If you would like to view the status of your order or make any changes to it, please visit <a href="<?php echo SITE_URL; ?>my-order.php">My Orders</a> on yourexpress.in</p>
<p>&nbsp;</p>
<table width="90%" border="0" cellspacing="0" cellpadding="0" colspan="2">
  <tr>
    <td height="100" align="left" valign="top"><table width="100%" cellpadding="0" cellspacing="0" >
        <tr>
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><h2 style="margin:0px 0px; font-size:19px !important;"><img src="../images/logo.png" style="width:125px";> <span style="padding-left: 8%;">Order Details of GROCIO</span> <span style="padding-left:8%;">GSTIN:- 09AKCPG2643P1ZW</span></h2></td>
        </tr>
        <td  colspan="2" style="border:1px solid #CCC; padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8%" style="border:1px solid #CCC; padding:5px;"><strong>Order Date</strong></td>
                <td width="5%" style="border:1px solid #CCC; padding:5px;"><strong>Order ID</strong></td>
                <td width="7%" style="border:1px solid #CCC; padding:5px;"><strong>OD No.</strong></td>
                <td width="6%" style="border:1px solid #CCC; padding:5px;"><strong>Pay By</strong></td>
                <td width="7%" style="border:1px solid #CCC; padding:5px;"><strong>Order By</strong></td>
              </tr>
              <tr>
                <td width="13%" style="border:1px solid #CCC; padding:5px;"><?php $added_date=explode("-",$result->order_date); if($added_date[0]!='0000'){ echo date("d M Y H:i",strtotime($result->order_date)); }?></td>
                <td width="5%" style="border:1px solid #CCC; padding:5px;"><?php echo stripslashes($result->order_id);?></td>

                <td width="4%" style="border:1px solid #CCC; padding:5px;"><?php echo $TNumRows; ?></td>
                <td width="5%" style="border:1px solid #CCC; padding:5px;"><?php echo stripslashes($result->payment_method);?></td>
                <td width="6%" style="border:1px solid #CCC; padding:5px;"><?php echo stripslashes($result->order_via);?></td>
              </tr>
            </table></td>
        <tr >
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><h2 style="margin:1px 1px; font-size:16px !important;">Customer Information <span style="float:right !important; color:#f93333;">Payment Status:
              <?php if($result->payment_status==1){ echo "Paid"; }else{ echo "Unpaid"; }?>
              </span></h2></td>
        </tr>
        <tr>
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="22%" style="border:1px solid #CCC; padding:5px;"><strong> Name:</strong></td>
                <td width="20%" style="border:1px solid #CCC; padding:5px;"><?php echo $result->ship_name; ?> <?php echo $result->ship_lname; ?></td>
                <td width="10%" style="border:1px solid #CCC; padding:5px;"><strong> Mobile No.:</strong></td>
                <td width="40%" style="border:1px solid #CCC; padding:5px;"><?php echo stripslashes($result->ship_mobile);?></td>
              </tr>
              <tr>
                <td width="22%" style="border:1px solid #CCC; padding:5px;"><strong> Address:</strong></td>
                <td width="70%" colspan="3" style="border:1px solid #CCC; padding:5px;">&nbsp;adfasdfasdf</td>
                
              </tr>
             

            </table></td>
        </tr>
        <?php if($result->coupon_code!=''){ ?>
        <tr>
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><h2>Discount Information</h2></td>
        </tr>
        <tr>
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="18%" style="border:1px solid #CCC; padding:5px;"><strong>Coupoun Code Used:</strong></td>
                <td width="34%" style="border:1px solid #CCC; padding:5px;"><?php echo stripslashes($result->coupon_code);?></td>
                <td width="14%" style="border:1px solid #CCC; padding:5px;">&nbsp;</td>
                <td width="34%" style="border:1px solid #CCC; padding:5px;">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <?php } ?>
        <?php
        if($result->ship_type=='Normal'){?>
        <?php }?>
        <tr>
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><h2 style="margin:1px 1px; font-size:16px !important;">Ordered Products</h2></td>
        </tr>
        <tr>
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><?php 
                             $enq_message.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr style='background:#e7f6f1; border:1px solid #CCC; padding:5px;' >
      <td width='1%' height='30' style='border:1px solid #CCC; padding:5px;'><h3>S.No.</h3></td>
        <td width='30%' height='30' style='border:1px solid #CCC; padding:5px;'><h3>Description</h3></td>
        <td width='11%' style='border:1px solid #CCC; padding:5px;'><h3>Size</h3></td>
        <td width='2%' style='border:1px solid #CCC; padding:5px;'><h3>Qty</h3></td>
        <td width='11%' style='border:1px solid #CCC; padding:5px;'><h3>MRP</h3></td>
        <td width='4%' style='border:1px solid #CCC; padding:5px;'><h3>Disc.</h3></td>
        <td width='11%' style='border:1px solid #CCC; padding:5px;'><h3>Net AMT</h3></td>
        </tr>
      <tr>
       
        </tr>";
      $i=0; $totmrp=0; $totdis=0; $tmrp=0; $tp=0; $saving=0;
      $itmesArr=$obj->query("select * from $tbl_order_itmes where order_id='".$result->id."' and price!='0.00'",$debug=-1);
      $ItemNum = $obj->numRows($itmesArr);
      
    $arr_5[] = ""; $arr_12[] = ""; $arr_18[] = ""; $arr_28[] = ""; $arr_33[] = "";  $arr_40[] = ""; $arr_64[] = ""; $arr_0[] = "";
      while($resultItem=$obj->fetchNextObject($itmesArr)){
          $i++;
     // echo $resultItem->price_id."=";
      $PSql = $obj->query("select unit_id,size,discount,gst,mrp_price from tbl_productprice where id='".$resultItem->price_id."'");
      $PResult = $obj->fetchNextObject($PSql);
      $unit = getField('name',$tbl_unit,$PResult->unit_id);
      $brand = getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$resultItem->product_id));
      
       if($PResult->gst==5){
            $arr_5[] = $resultItem->price*$resultItem->qty;
        }else if($PResult->gst==12){
            $arr_12[] = $resultItem->price*$resultItem->qty;
        }else if($PResult->gst==18){
            $arr_18[] = $resultItem->price*$resultItem->qty;
        }else if($PResult->gst==28){
            $arr_28[] = $resultItem->price*$resultItem->qty;
        }else if($PResult->gst==33){
            $arr_28[] = $resultItem->price*$resultItem->qty;
        }else if($PResult->gst==40){
            $arr_28[] = $resultItem->price*$resultItem->qty;
        }else if($PResult->gst==64){
            $arr_28[] = $resultItem->price*$resultItem->qty;
        }else if($PResult->gst==0){
            $arr_0[] = $resultItem->price*$resultItem->qty;
        }
        
      $hsn = getField('product_code',$tbl_product,$resultItem->product_id);
      $totmrp = $totmrp + number_format($PResult->mrp_price,2)* $resultItem->qty;
      $totqty = $totqty + $resultItem->qty;
      $totdis = $totdis + number_format($PResult->discount,2);
      $saving+=($PResult->mrp_price* $resultItem->qty*$PResult->discount)/100; 
      
      $p = number_format($resultItem->price*$resultItem->qty,2);
      $tp = $tp+$p;
      
      $mpp = number_format($PResult->mrp_price*$resultItem->qty,2);
      $tmrp = $tmrp+$mpp;
      
      $enq_message.="<tr>
      <td style='border:1px solid #CCC; padding:5px;'>".$i."</td>
        <td style='border:1px solid #CCC; padding:5px;'><strong>".$resultItem->product_name." (".$brand.")</strong></td>
        <td style='border:1px solid #CCC; padding:5px;'>".$PResult->size." ".$unit."</td>
        <td style='border:1px solid #CCC; padding:5px;'>".$resultItem->qty."</td>
        <td style='border:1px solid #CCC; padding:5px;'>".number_format($PResult->mrp_price,2)."</td>
        <td style='border:1px solid #CCC; padding:5px;'>".number_format($PResult->discount,0)."%</td>
        <td style='border:1px solid #CCC; padding:5px;'>Rs ".number_format($resultItem->price*$resultItem->qty,2)."</td>
        </tr>";
      }
     
      $enq_message.="<tr><tr>
      <td style='border:1px solid #CCC; padding:5px;'>&nbsp;</td>
      <td style='border:1px solid #CCC; padding:5px;'></td>
      <td style='border:1px solid #CCC; padding:5px;'>&nbsp;</td>
        <td style='border:1px solid #CCC; padding:5px;'><strong>".$totqty."</strong></td>
        <td style='border:1px solid #CCC; padding:5px;'><strong>Rs ".number_format($tmrp,0)."</strong></td>
        <td style='border:1px solid #CCC; padding:5px;'></td>
        <td style='border:1px solid #CCC; padding:5px;'><strong>Rs ".number_format($tp,0)."</strong></td>
        </tr>
     ";
		
		 $enq_message.="
		
  </table></td>
  </tr>   
</table>"; echo $enq_message;?></td>
        </tr>
        <tr >
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><h2 style="margin:1px 1px; font-size:16px !important;">Discount Information </h2></td>
        </tr>
        <tr>
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="35%" style="border:1px solid #CCC; padding:5px;"><strong>Product Discount:</strong></td>
                <td width="15%" style="border:1px solid #CCC; padding:5px;"><strong>Rs <?php echo number_format($saving,0); ?></strong></td>
              <td width="30%" style="border:1px solid #CCC; padding:5px;"><strong>Total MRP:</strong></td>
                <td width="20%" style="border:1px solid #CCC; padding:5px;"><strong>Rs <?php echo number_format($totmrp,0); ?></strong></td>
              </tr>
              <tr>
                <td width="35%" style="border:1px solid #CCC; padding:5px;"><strong> Coupon Discount:</strong></td>
                <td width="15%" style="border:1px solid #CCC; padding:5px;"><strong>Rs <?php echo number_format($result->discount,2); ?></strong></td>
                <td width="30%" style="border:1px solid #CCC; padding:5px;"><strong>Delivery Charges:</strong></td>
                <td width="15%" style="border:1px solid #CCC; padding:5px;"><strong>Rs <?php echo number_format($result->shipping_amount,2); ?></strong></td>
              </tr>
              <tr>
                <td width="35%" style="border:1px solid #CCC; padding:5px;"><strong> Smart Basket Discount:</strong></td>
                <td width="15%" style="border:1px solid #CCC; padding:5px;"><strong>Rs <?php echo number_format($result->other_discount,2); ?></strong></td>
                <td width="30%" style="border:1px solid #CCC; padding:5px;"><strong>NET Payable:</strong></td>
                <td width="15%" style="border:1px solid #CCC; padding:5px;"><strong>Rs <?php echo number_format($result->total_amount,0); ?></strong></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" style="border:1px solid #CCC; padding:5px;"><h2 style="margin:1px 1px; font-size:16px !important; text-align:center !important;">Total Save On Order ID Rs.(<?php echo round($saving+$result->discount+$result->other_discount) ?>)(<?php echo number_format((round($saving+$result->discount+$result->other_discount)*100)/$tmrp,1); ?>%)</h2></td>
        </tr>
        <?php
	$GItmesArr=$obj->query("select * from $tbl_order_itmes where order_id='".$result->id."' and price='0.00'",$debug=-1);
	if($obj->numRows($GItmesArr)>0){
		?>
        <tr>
          <td colspan="2" align="center" style="border:1px solid #CCC; padding:5px;"><h2 style="margin:0px 0px;">Gift Item</h2></td>
        </tr>
        <tr>
          <td colspan="2"><?php
		$enq_message1.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>
		<tr style='background:#e7f6f1; border:1px solid #CCC; padding:5px;' >
		 <td width='1%' height='30' style='border:1px solid #CCC; padding:5px;'><h3>S.No.</h3></td>
		<td width='48%' height='30' style='border:1px solid #CCC; padding:5px;'><h3>Product Purchased</h3></td>
		<td width='10%' style='border:1px solid #CCC; padding:5px;'><h3>Size</h3></td>
		<td width='10%' style='border:1px solid #CCC; padding:5px;'><h3>Qty</h3></td>
		<td width='13%' style='border:1px solid #CCC; padding:5px;'><h3>MRP</h3></td>
		</tr>
		<tr>
		<td style='border:1px solid #CCC; padding:5px;'><strong>&nbsp;</strong></td>
		<td style='border:1px solid #CCC; padding:5px;'>&nbsp;</td>
		<td style='border:1px solid #CCC; padding:5px;'>&nbsp;</td>
		<td style='border:1px solid #CCC; padding:5px;'>&nbsp;</td><td>&nbsp;</td>
		</tr>";

		while($resultItem=$obj->fetchNextObject($GItmesArr)){
		$PSql = $obj->query("select unit_id,size from tbl_productprice where id='".$resultItem->price_id."'");
		$PResult = $obj->fetchNextObject($PSql);
		$unit = getField('name',$tbl_unit,$PResult->unit_id);
		$brand = getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$resultItem->product_id));

		$enq_message1.="<tr>
		<td style='border:1px solid #CCC; padding:5px;'>".$resultItem->Id."</td>
		<td style='border:1px solid #CCC; padding:5px;'><strong>".$resultItem->product_name." (".$brand.")</strong></td>
		<td style='border:1px solid #CCC; padding:5px;'>".$PResult->size." ".$unit."</td>
		<td style='border:1px solid #CCC; padding:5px;'>".$resultItem->qty."</td>
		<td style='border:1px solid #CCC; padding:5px;'>".number_format($resultItem->price,2)."</td>
		</tr>";
		}
		$enq_message1.="
		</table>"; echo $enq_message1;
		?>
          </td>
        </tr>
        <?php }
?>
      </table></td>
  </tr>

</table>
<p>Remember to <a href="<?php echo SITE_URL; ?>order-issue">Rate us</a></p>
<p>Thanks</p>
<p>Grocio Team</p>