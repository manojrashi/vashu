<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
//validate_admin();

if($_REQUEST['order_id']!=''){
  $sql=$obj->query("select * from $tbl_order where id=".$_REQUEST['order_id']);
  $result=$obj->fetchNextObject($sql);

  $Tsql = $obj->query("select id from $tbl_order where user_id='".$result->user_id."' and order_status=4 ");
  $TNumRows = $obj->numRows($Tsql);

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
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-style-flx">
    <tr>
      <td align="left" valign="middle" class="headingbg bodr text14">
        Admin: order Details
        <span><a href="javascript:void(0);" onclick="myFunction();">Print</a></span>
      </td>
    </tr>

    <tr>
      <td height="100" align="left" valign="top" bgcolor="#f7faf9" class="bodr">
        <form name="frm" method="POST" enctype="multipart/form-data" action="" onSubmit="return validate(this)">
          <input type="hidden" name="submitForm" value="yes" />
          <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
          <table width="100%" cellpadding="0" cellspacing="0">

            <tr>
              <td  class="paddBot11 paddRt14" colspan="2"><h2 style="margin:0px 0px; font-size:19px !important;"><img src="../images/logo.png" style="width:125px";><span style="margin-left: 180px;">Order Details of Events</span></h2></td>

            </tr>
            <tr>
              <td  class="paddBot11 paddRt14" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="8%"><strong>Order Date</strong></td>
                  <td width="5%"><strong>Order ID</strong></td>
                  <td width="7%"><strong>OD No.</strong></td>
                  <td width="6%"><strong>Pay By</strong></td>
                  <td width="7%"><strong>Order By</strong></td>
                </tr>
                <tr style="display:none;">
                  <td width="18%"><strong>User ID:</strong></td>
                  <td width="34%"><?php echo stripslashes($result->user_id);?></td>
                  <td width="14%"><strong>Email:</strong></td>
                  <td width="34%"><?php echo stripslashes($result->ship_email);?></td>
                </tr>
                <tr>
                  <td width="13%"><?php $added_date=explode("-",$result->order_date); if($added_date[0]!='0000'){ echo date("d M Y H:i",strtotime($result->order_date)); }?></td>  
                  <td width="5%"><?php echo stripslashes($result->orderno);?></td> 

                  <td width="4%"><?php echo $TNumRows; ?></td>
                  <td width="5%"><?php echo stripslashes($result->payment_method);?></td>
                  <td width="6%"><?php echo stripslashes($result->order_via);?></td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td  class="paddBot11 paddRt14" colspan="2"><h2 style="margin:1px 1px; font-size:16px !important;">Customer Information <span style="float:right !important; color:#f93333;">Payment Status: <?php if($result->payment_status==1){ echo "Paid"; }else{ echo "Unpaid"; }?></span></h2></td>

          </tr>
          <tr>
            <td  class="paddBot11 paddRt14" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="22%"><strong> Name:</strong></td>
                <td width="20%"><?php echo getField('name',$tbl_user,$result->user_id); ?> <?php echo getField('surname',$tbl_user,$result->user_id) ?></td>
                <td width="10%"><strong> Mobile No.:</strong></td>
                <td width="40%"><?php echo getField('mobile',$tbl_user,$result->user_id);?></td>
              </tr>
              
              <tr>
                <td width="22%"><strong>Address: </strong></td>
                <td width="40%" colspan="3"><?php echo $result->ship_address;?></td>
              </tr>
            </table>
          </td>
        </tr>

        <?php if($result->coupon_code!=''){ ?> 
          <tr>
            <td  class="paddBot11 paddRt14" colspan="2"><h2>Discount Information</h2></td>

          </tr> 
          <tr>
            <td  class="paddBot11 paddRt14" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="18%"><strong>Coupoun Code Used:</strong></td>
                <td width="34%"><?php echo stripslashes($result->coupon_code);?></td>
                <td width="14%">&nbsp;</td>
                <td width="34%">&nbsp;</td>
              </tr>
            </table>
          </td>

        </tr>
      <?php } ?>
      <tr>
        <td  class="paddBot11 paddRt14" colspan="2"><h2 style="margin:1px 1px; font-size:16px !important;">Ordered Products</h2></td>
      </tr>
      <tr><td colspan="2">
        <?php 
        $enq_message.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
        <td width='100%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr style='background:#e7f6f1;' >
        <td width='1%' height='30'><h3>S.No.</h3></td>
        <td width='30%' height='30'><h3>Description</h3></td>
        <td width='11%'><h3>Size</h3></td>
        <td width='2%'><h3>Qty</h3></td>
        <td width='11%'><h3>MRP</h3></td>
        <td width='4%'><h3>Disc.</h3></td>
        <td width='11%'><h3>Net AMT</h3></td>
        </tr>
        <tr>

        </tr>";
        $i=0; $totmrp=0; $totdis=0; $tmrp=0; $tp=0;
        $itmesArr=$obj->query("select * from $tbl_order_itmes where order_id='".$result->id."' and price!='0.00'",$debug=-1);
        $ItemNum = $obj->numRows($itmesArr);

        while($resultItem=$obj->fetchNextObject($itmesArr)){
          $i++;
          $PSql = $obj->query("select unit_id,size,discount,mrp_price from tbl_productprice where id='".$resultItem->price_id."'");
          $PResult = $obj->fetchNextObject($PSql);
          $unit = getField('name_en',$tbl_unit,$PResult->unit_id);
          $brand = getField('brand_en',$tbl_brand,getField('brand_id',$tbl_product,$resultItem->product_id));
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
          <td>".$i."</td>
          <td><strong>".$resultItem->product_name." (".$brand.")</strong></td>
          <td>".$PResult->size." ".$unit."</td>
          <td>".$resultItem->qty."</td>
          <td>".number_format($PResult->mrp_price,2)."</td>
          <td>".number_format($PResult->discount,0)."%</td>
          <td>$website_currency_symbol ".$p."</td>
          </tr>";
        }
        $enq_message.="<tr><tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>".$totqty."</strong></td>
        <td><strong>$website_currency_symbol ".number_format($tmrp,0)."</strong></td>
        <td></td>
        <td ><strong>$website_currency_symbol ".number_format($tp,0)."</strong></td>
        </tr>
        ";
        $enq_message.="
        </table></td>
        </tr>
      </table>"; echo $enq_message;?></td></tr>
      <tr ><td  class="paddBot11 paddRt14" colspan="2"><h2 style="margin:1px 1px; font-size:16px !important;">Discount Information </h2></td></tr>

      <tr>
        <td  class="paddBot11 paddRt14" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="35%" align="right"> Product Discount:</td>
            <td width="15%" align="right"><strong><?php echo $website_currency_symbol; ?> <?php echo number_format($saving,0); ?></strong></td>
            <td width="30%" align="right"><stron>Total MRP:</strong></td>
              <td width="20%" align="right"><strong><?php echo $website_currency_symbol; ?> <?php echo number_format($totmrp,0); ?></strong></td>
            </tr>
            <tr>
              <td width="35%" align="right"> Coupon Discount:</td>
              <td width="15%" align="right"><strong><?php echo $website_currency_symbol; ?> <?php echo number_format($result->discount,2); ?></strong></td>
              <td width="30%" align="right"><stron>Delivery Charges:</strong></td>
                <td width="15%" align="right"><strong><?php echo $website_currency_symbol; ?> <?php echo number_format($result->shipping_amount,2); ?></strong></td>
              </tr>
              <tr>
                
                <td width="30%" colspan="3" align="right"><stron>NET Payable:</strong></td>
                  <td width="15%" align="right"><strong><?php echo $website_currency_symbol; ?> <?php echo number_format($result->total_amount,0); ?></strong></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td  class="paddBot11 paddRt14" colspan="2"><h2 style="margin:1px 1px; font-size:16px !important; text-align:center !important;">Total Save On Order ID Rs.(<?php echo round($saving+$result->discount+$result->other_discount) ?>)(<?php echo number_format(round($saving+$result->discount+$result->other_discount)*100/$tmrp,1); ?>%)</h2></td>

          </tr>

          <?php
          $GItmesArr=$obj->query("select * from $tbl_order_itmes where order_id='".$result->id."' and price='0.00'",$debug=-1);
          if($obj->numRows($GItmesArr)>0){
            ?>

            <tr><td colspan="2" align="center"><h2 style="margin:0px 0px;">Gift Item</h2></td></tr>
            <tr><td colspan="2">
              <?php
              $enq_message1.="<table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr style='background:#e7f6f1;' >
              <td width='1%' height='30'><h3>S.No.</h3></td>
              <td width='48%' height='30'><h3>Product Purchased</h3></td>
              <td width='10%'><h3>Size</h3></td>
              <td width='10%'><h3>Qty</h3></td>
              <td width='13%'><h3>MRP</h3></td>
              <td width='13%'><h3>Amount</h3></td>
              </tr>";
              $ga=1;
              while($resultItem=$obj->fetchNextObject($GItmesArr)){
                $PSql = $obj->query("select unit_id,size,mrp_price,sell_price from tbl_productprice where id='".$resultItem->price_id."'");
                $PResult = $obj->fetchNextObject($PSql);
                $unit = getField('name',$tbl_unit,$PResult->unit_id);
                $brand = getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$resultItem->product_id));

                $enq_message1.="<tr>
                <td>".$ga."</td>
                <td><strong>".$resultItem->product_name." (".$brand.")</strong></td>
                <td>".$PResult->size." ".$unit."</td>
                <td>".$resultItem->qty."</td>
                <td>".number_format($PResult->mrp_price,2)."</td>
                <td>".number_format($PResult->sell_price,2)."</td>
                </tr>";
                $ga++;
              }
              $enq_message1.="
              </table>"; echo $enq_message1;
              ?>
            </td></tr>
          <?php }
          ?>
          <tr>
            <td width="43%" align="right" class="paddRt14 paddBot11">&nbsp;</td>
            <td width="57%" align="left" class="paddBot11">

            </td> 
          </tr>

        </tbody>
      </table>
    </td>
  </tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

</div>

</div>
</section>

</table>
</form>
</td>
</tr>
<tr><td align="center"></td></tr>
</table>
<script>
  function myFunction() {
    window.print();
  }
</script>
</body>
</html>
