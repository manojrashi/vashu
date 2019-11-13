<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 

if($_REQUEST['order_id']!=''){
  $sql=$obj->query("select * from $tbl_order where id=".$_REQUEST['order_id']);
  $result=$obj->fetchNextObject($sql);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Order Id:<?php echo $result->order_id; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style media="print">
.pagebreak 
{ 
page-break-before: always; 
}
</style>
</head>
<body style="font-faimly:Tahoma, Geneva, Tahoma, Geneva, sans-serif; font-size:29px;" >
<div style=" width:500px;">
  <section>
    <div class="container-fluid pagebreak">
        <div style="padding: 0px 0px 0px; width:100%; margin:auto">
          <table style="min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
              <tr>
                <td valign="middle" style="padding-left:18px;">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td>
                          <div style="  padding: 0px;  border-bottom: none;">
                            <h1 style="margin: 0px 0px 0px 0px;text-transform: uppercase;font-size: 38px; font-faimly:Tahoma, Geneva, Tahoma, Geneva, sans-serif; margin-left:167px;">Grocio</h1>
                            <h5 style="font-size: 19px; margin: 0px 0px 6px 161px;">Online Grocery Store</h5>
                            <p style="padding-bottom:0px; color:#000; font-weight: 500; line-height: 28px; margin:0px 0px 0px 47px;">
                              <?php echo getField('address',$tbl_setting,1) ?><br/>
                              GSTIN: 09AKCPG2643P1ZW<br/>
                              PH No : <?php echo getField('mobile',$tbl_setting,1) ?>
                              <p style="margin: 1px 0px 0px 167px;text-decoration: underline;">GST INVOICE</p>
							  <p style="margin: 1px 0px 0px 130px;">Order Id:<?php echo $result->order_id; ?></p>
                            </p>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div style=" padding: 0px 0px 0px 18px; border-bottom: none; margin-top:-47px;">
                            <!--<p style="text-align: center; font-size: 24px; margin: 0px 0px -8px 0px; font-weight: 400; color: #000; margin-top:-19px; display:none;">GROCIO Order Id :&nbsp;&nbsp; <strong><?php //echo $result->order_id; ?> </p>-->
                            <p style="font-size: 24px; color: #000;  width: 100%; margin-bottom:0px; display: inline-block;font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">Date:<?php echo $result->ship_date; ?>&nbsp;Time:<?php echo getField('time_from',$tbl_bookingslot,$result->ship_timing)." ".getField('time_to',$tbl_bookingslot,$result->ship_timing); ?></p>
                              <p style="font-size: 27px; color: #000;  width: 35%; margin-bottom:10px; display: none;">User Id:</br> <?php echo $_SESSION['sess_admin_id']; ?></p>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div style=" padding: 0px 0px 0px 0px;  border-bottom: none">
                              <h5 style="font-size:16px; margin:0px 0px 10px; text-align:center; display:none;">Customer Info</h5>
                              <p style="color: #000;padding-bottom: 2px; margin:0px; font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif; font-size:27px !important;letter-spacing:1px; text-transform:capitalize;padding-left:24px;">Name :&nbsp; <?php echo $result->ship_name." ".$result->ship_lname; ?><br>Mobile :  <?php echo $result->ship_mobile; ?></p>
                              <p style="color: #000;padding-bottom: 0px; margin:0px; font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif; font-size:27px !important; letter-spacing:1px; text-transform:capitalize; padding-left:24px;">Address :&nbsp; 
                                <?php 
                                    if(!empty($result->ship_flat)){ echo $result->ship_flat.", "; } 
                                    if(!empty($result->ship_flor)){ echo $result->ship_flor.", "; }
                                    if(!empty($result->ship_tower)){ echo "Tower- ".$result->ship_tower." ,"; }
                                    if(!empty($result->ship_block)){ echo $result->ship_block.", "; } 
                                    if(!empty($result->ship_streetno)){ echo $result->ship_streetno." ,"; }
                                    if(!empty($result->ship_society)){ echo getField('society',$tbl_society,$result->ship_society).", "; }
                                    if(!empty($result->ship_landmark)){ echo "Landmark- ".$result->ship_landmark.", "; }
                                    if(!empty($result->ship_area)){ echo getField('area',$tbl_area,$result->ship_area).", "; }
                                    if(!empty($result->ship_city)){ echo $result->ship_city.", "; } 
                                ?> 
                              </p>
                            </div>
                          </td>
                        </tr>
						
						
						 </tbody>
              </table>

            </div>
          
        </div>
      </section>
	  
  <section>
    <div class="container-fluid">
        <div style="padding: 0px 0px 0px; width:100%; margin:auto">
          <table style="min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                        <tr>
                          <td>
                            <div style=" padding: 0px 0px 0px 0px; border-bottom: none">
                              <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td valign="middle" style="padding-left:18px;">
                                      <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-top: 2px solid #373737;border-bottom: 2px solid #373737;">
                                        <tbody style="font-size:21px; font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">
                                          <tr style="font-size: 21px; font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">
                                              <th style="padding:0px 21px; text-align:left;font-weight:300; width:1%;">S.N.</th>
                                            <th style="padding:5px 0px;  width:1%;font-weight:300;letter-spacing:1px;">Description&nbsp;</th>
                                            <th style="text-align:right;font-weight:300;letter-spacing:1px;padding-left:130px;">&nbsp;&nbsp;QTY</th>
                                            <th style="text-align:right; font-weight:300;letter-spacing:1px;">&nbsp;&nbsp;HSN</th>
                                            
                                          </tr>
                                         
                                           <tr>
                                              <th style="font-weight:300;letter-spacing:1px; padding-bottom:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Size&nbsp;</th>
                                            <th style="font-weight:300;letter-spacing:1px; padding-bottom:4px;">&nbsp;&nbsp;GST</th>
                                            <th style="font-weight:300;letter-spacing:1px; padding-bottom:4px;">MRP</th>
                                            <th style="font-weight:300;letter-spacing:1px; padding-bottom:4px; text-align:left;padding-right:15px;">Disc</th>
                                            <th style="text-align:right; font-weight:300;letter-spacing:1px;">Prz</th>
                                          </tr>
                                          <?php
                                          $item=0;
										  $man=1;
                                          $itmesArr=$obj->query("select * from $tbl_order_itmes where order_id='".$result->id."' and price!='0.00'",$debug=-1);
                                          while($resultItem=$obj->fetchNextObject($itmesArr)){
                                            $PSql = $obj->query("select unit_id,mrp_price,discount,gst,size from tbl_productprice where id='".$resultItem->price_id."'");
                                            $PResult = $obj->fetchNextObject($PSql);
                                            $unit = getField('name',$tbl_unit,$PResult->unit_id);
                                            $brand = getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$resultItem->product_id));

                                            $arr_5[] = "";
                                            $arr_12[] = "";
                                            $arr_18[] = "";
                                            $arr_28[] = "";
                                            $arr_33[] = "";
                                            $arr_40[] = "";
                                            $arr_64[] = "";
                                            $arr_0[] = "";

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
                                            ?>
                                            <tr>
                                            <td style="padding:10px 0px; position:absolute;font-weight:500;"><?php echo $man; ?></td>
                                              <td style="padding:10px 23px; position:absolute;  font-weight:500; width:59%"><?php echo $resultItem->product_name."(".$brand.")"; ?></td>
                                              <td style="padding:10px 0px 0px 373px; text-align:right; position:absolute; border-top:2px solid #000; font-weight:600;"><?php echo $resultItem->qty; ?></td>
                                                <td style="padding:10px 0px 0px 406px; text-align:right; position:absolute; border-top:2px solid #000;"></td>
                                               </tr>
                                            <tr>
                                               
                                                  <td style="padding:60px 0px 0px 1px; text-align:right; "><?php echo $PResult->size.$unit; ?></td>
                                              <td style="padding:60px 0px 0px 55px; text-align:right; position:absolute;"><?php echo $PResult->gst; ?>%</td>
                                              <td style="padding:60px 0px 0px 200px; text-align:right; position:absolute;"><?php echo number_format($PResult->mrp_price,0) ?></td>
                                               <td style="padding:60px 0px 0px 305px; text-align:right; position:absolute; border-top:2px solid #000; "><?php echo number_format($PResult->discount,0) ?>%</td>
                                              <td style="padding:60px 0px 0px 366px; text-align:right; position:absolute; border-top:2px solid #000; "><?php echo number_format($resultItem->price*$resultItem->qty,0) ?></td>
                                          
                                              
                                            </tr>
                                            <?php 
                                            $saving+=($PResult->mrp_price*$PResult->discount*$resultItem->qty)/100;
                                            $totmrpprice+=$PResult->mrp_price*$resultItem->qty;
                                            $item++;
											$man++;
                                          }?>

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

            </div>
          
        </div>
      </section>
  <section>
    <div class="container-fluid">
        <div style="padding: 0px 0px 0px; width:100%; margin:auto">
          <table style="min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                        <tr>
                          <td>
                            <div style=" padding: 0px 0px 0px 0px; border-bottom: none;font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">
                              <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                <tbody>
                                  <tr>
                                    <td valign="middle">
                                      <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                        <tbody style="font-size:22px; font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif; float:none;">
                                          
										  <tr style="font-size: 22px; font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">
										  <th style="font-weight:300;letter-spacing:1px;">&nbsp;&nbsp;&nbsp;&nbsp;Product Disc:<strong> <?php echo number_format($saving,0); ?></strong></th>
                                           	                                           
										   <th style="padding:0px 0px;font-weight:300;">Total MRP:<strong> <?php echo number_format( $totmrpprice,0); ?></strong></th>
                                            
                                            </tr>
											<tr>
											<th style=";  font-weight:300;letter-spacing:1px; padding:2px 36px; position:absolute;">Coupon Disc: <strong><?php echo number_format($result->discount,0); ?></strong></th>
											
											<th style="padding:2px 0px;font-weight:300;letter-spacing:1px; text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount:<strong> <?php echo number_format($result->amount,0); ?></strong></th>
											</tr>
											<tr>
                                            <th style="font-weight:300;letter-spacing:1px; padding:2px 36px; position:absolute;">Smart Basket Disc:<strong> <?php echo number_format($result->other_discount,0); ?></strong></th>
                                          
											<th style="font-weight:300;letter-spacing:1px; padding:2px 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delivery Charges: <strong><?php echo number_format($result->shipping_amount,0); ?></strong></th>
											</tr>
											<tr>
                  <th colspan="3" style="text-align:center;  font-weight:300;letter-spacing:1px;padding:4px 0px;">NET PAYABLE:&nbsp;<strong>Rs.<?php echo number_format($result->total_amount,0); ?></strong><br>
				  <span style="">(Total Saved On Order Rs.<strong><?php echo round($saving+$result->discount+$result->other_discount) ?></strong><strong> (<?php echo number_format((round($saving+$result->discount+$result->other_discount)*100)/$totmrpprice,1); ?>%))</strong></span></th>
                  
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
      <section>
    <div class="container-fluid">
        <div style="padding: 0px 35px; width:100%; margin:auto">
          <table style="min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
              <tr>
                <td valign="middle">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                          <tr>
                            <td>
                              <div style="border: 2px solid #373737; border-bottom: none; font-size: 22px; text-align: center; font-weight: 600; height: 50px; padding-top: 11px;">
                                TOTAL SALE PRICE IS INCLUSIVE OF GST
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div style=" padding: 0px 0px 0px 0px; border: 2px solid #373737;">
                                <table cellspacing="0" width="100%" cellpadding="0" border="0">
                                  <tbody>
                                    <tr>
                                      <td valign="middle">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-size:22px;">
                                          <tbody>

                                            <tr>
                                              <td style="font-size:22px; padding:7px 0px 10px; text-align:left; border-right:2px solid #373737; border-bottom:2px solid #373737; width:40%;">GST</td>
                                              <td style="font-size:22px; padding:7px 0px 10px; text-align:left; border-right:2px solid #373737; border-bottom:2px solid #373737; width:15%;">TOTAL</td>
                                              <td style="font-size:22px; padding:7px 0px 10px; text-align:left; border-right:2px solid #373737; border-bottom:2px solid #373737; width:15%;">SUB</td>
                                              <td style="font-size:22px; padding:7px 0px 10px; text-align:left; border-right:2px solid #373737; border-bottom:2px solid #373737; width:15%;">CGST</td>
                                              <td style="font-size:22px; padding:7px 0px 10px; text-align:left; border-right:2px solid #373737; border-bottom:2px solid #373737; width:15%;">SGST</td>
                                            </tr>
											
											<?php
                                                if(!empty($arr_5)){
													if(array_sum($arr_5)>0){?>
                                            <tr>
                                              <td style="font-size:22px; padding:8px 0px 10px; text-align:left; border-right:2px solid #373737">GST 5%</td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php
                                                if(!empty($arr_5)){
                                                  $gst5 = array_sum($arr_5);
                                                  echo number_format($gst5,2);
                                                }
                                                ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php echo number_format($gst5-$gst5*5/100,2); ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php 
                                                $gst5_a = $gst5*5/100;
                                                echo number_format($gst5_a/2,2); 
                                                ?>
                                              </td>
                                              <td style="text-align:center;; font-size:22px;">
                                                <?php 
                                                $gst5 = $gst5*5/100;
                                                echo number_format($gst5/2,2); 
                                                ?>
                                              </td>
                                            </tr>
													<?php } }?>
											

											<?php
                                                if(!empty($arr_12)){
													if(array_sum($arr_12)>0){?>
                                            <tr>

                                              <td style="font-size:22px; padding:8px 0px 10px; text-align:left; border-right:2px solid #373737">GST 12%</td>
                                              <td style="text-align:center; border-right:2px solid #777; font-size:22px;">
                                                <?php
                                                if(!empty($arr_12)){
                                                  $gst12 = array_sum($arr_12);
                                                  echo number_format($gst12,2);
                                                }
                                                ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php echo number_format($gst12-$gst12*12/100,2); ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php 
                                                $gst12_a = $gst12*12/100;
                                                echo number_format($gst12_a/2,2); 
                                                ?>
                                              </td>
                                              <td style="text-align:center; font-size:22px;">
                                                <?php 
                                                $gst12 = $gst12*12/100;
                                                echo number_format($gst12/2,2); 
                                                ?>
                                              </td>
                                            </tr>
													<?php } }?>
											
											<?php
                                                if(!empty($arr_18)){
													if(array_sum($arr_18)>0){?>
                                            <tr>
                                              <td style="font-size:22px; padding:8px 0px 10px; text-align:left; border-right:2px solid #373737">GST 18%</td>
                                              <td style="text-align:center;; border-right:2px solid #373737; font-size:22px;">
                                                <?php
                                                if(!empty($arr_18)){
                                                  $gst18 = array_sum($arr_18);
                                                  echo number_format($gst18,2);
                                                }
                                                ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php echo number_format($gst18-$gst18*18/100,2); ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php 
                                                $gst18_a = $gst18*18/100;
                                                echo number_format($gst18_a/2,2); 
                                                ?>
                                              </td>
                                              <td style="text-align:center; font-size:22px;">
                                                <?php 
                                                $gst18 = $gst18*18/100;
                                                echo number_format($gst18/2,2); 
                                                ?>
                                              </td>
                                            </tr>
													<?php } }?>
											
											<?php
                                            if(!empty($arr_28)){
												if(array_sum($arr_28)>0){?>
                                            <tr>
                                              <td style="font-size:22px; padding:8px 0px 10px; text-align:left; border-right:2px solid #373737">GST 28%</td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php
                                                if(!empty($arr_28)){
                                                  $gst28 = array_sum($arr_28);
                                                  echo number_format($gst28,2);
                                                }
                                                ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php echo number_format($gst28-$gst28*28/100,2); ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php 
                                                $gst28_a = $gst28*28/100;
                                                echo number_format($gst28_a/2,2); 
                                                ?>
                                              </td>
                                              <td style="text-align:center; font-size:22px;">
                                                <?php 
                                                $gst28 = $gst28*28/100;
                                                echo number_format($gst28/2,2); 
                                                ?>
                                              </td>
                                            </tr>
												<?php } }?>
											
											<?php
                                                if(!empty($arr_33)){
													if(array_sum($arr_33)>0){?>
                                           <tr>
                                              <td style="font-size:22px; padding:8px 0px 10px; text-align:left; border-right:2px solid #373737">GST OTH + Free</td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php
                                                if(!empty($arr_33)){
                                                  $gst33 = array_sum($arr_33);
                                                  
                                                }
                                                 if(!empty($arr_40)){
                                                  $gst40 = array_sum($arr_40);
                                                }
                                                 if(!empty($arr_64)){
                                                  $gst64 = array_sum($arr_64);
                                                }
                                                echo number_format($gst33+$gst40+$gst64,2);
                                                ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:20px;">
                                                <?php 
                                                $a33 = $gst33-$gst33*33/100; 
                                                $a40 = $gst40-$gst40*40/100;
                                                $a64 = $gst64-$gst64*64/100;
                                                echo number_format($a33+ $a40 +$a64,2);
                                                ?>
                                              </td>
                                              <td style="text-align:center; border-right:2px solid #373737; font-size:22px;">
                                                <?php 
                                                $gst33_a = $gst33*33/100;
                                                $gst40_a = $gst40*40/100;
                                                $gst64_a = $gst64*64/100;
                                                echo number_format(($gst33_a + $gst40_a + $gst64_a)/2,2);
                                                ?>
                                              </td>
                                              <td style="text-align:center; font-size:22px;">
                                                <?php 
                                                echo number_format(($gst33_a + $gst40_a + $gst64_a)/2,2);
                                                ?>
                                              </td>
                                            </tr>
													<?php } }?>
                                         <!--    <tr>
                                              <td style="font-size:15px; padding:8px 0px 10px; text-align:center; border-right:1px solid #d2d2d2">GST 40%</td>
                                              <td style="text-align:center; border-right:1px solid #d2d2d2; font-size:15px;">
                                                <?php
                                                /*if(!empty($arr_40)){
                                                  $gst40 = array_sum($arr_40);
                                                  echo $gst40;
                                                }*/
                                                ?>
                                              </td>
                                              <td style="text-align:center; border-right:1px solid #d2d2d2; font-size:18px;">
                                                <?php //echo $gst40-$gst40*40/100; ?>
                                              </td>
                                              <td style="text-align:center; border-right:1px solid #d2d2d2; font-size:18px;">
                                                <?php 
                                                //$gst40_a = $gst40*40/100;
                                               // echo $gst40_a/2; 
                                                ?>
                                              </td>
                                              <td style="text-align:center; font-size:18px;">
                                                <?php 
                                                //$gst40 = $gst40*40/100;
                                                //echo $gst40/2; 
                                                ?>
                                              </td>
                                            </tr> -->
                                      <!--       <tr>
                                              <td style="font-size:18px; padding:8px 0px 10px; text-align:center; border-right:1px solid #d2d2d2">GST 64%</td>
                                              <td style="text-align:center; border-right:1px solid #d2d2d2; font-size:18px;">
                                                <?php
                                                /*if(!empty($arr_64)){
                                                  $gst64 = array_sum($arr_64);
                                                  echo $gst64;
                                                }*/
                                                ?>
                                              </td>
                                              <td style="text-align:center; border-right:1px solid #d2d2d2; font-size:18px;">
                                                <?php //echo $gst64-$gst64*64/100; ?>
                                              </td>
                                              <td style="text-align:center; border-right:1px solid #d2d2d2; font-size:18px;">
                                                <?php 
                                                //$gst64_a = $gst64*64/100;
                                                //echo $gst64_a/2; 
                                                ?>
                                              </td>
                                              <td style="text-align:center; font-size:18px;">
                                                <?php 
                                                //$gst64 = $gst64*64/100;
                                                //echo $gst64/2; 
                                                ?>
                                              </td>
                                            </tr> -->
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
	  <?php
	  $itmesArr=$obj->query("select * from $tbl_order_itmes where order_id='".$result->id."' and price='0.00'",$debug=-1);
	  if($obj->numRows($itmesArr)>0){?>
	  <section>
    <div class="container-fluid" style="margin-left:35px;">
        <div style="margin-top: 10px; width:108%;">
         <table style="min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tbody>
                        <tr>
                          <td>
                            <div style=" border-bottom: none">
                              <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                <tbody>
								<div style="border: 2px solid #373737; font-size: 22px; text-align: center; font-weight: 600; height: 45px; padding-top: 20px;">
                                GIFT ITEM
                              </div>
                                  <tr>
                                    <td valign="middle">
                                      <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border: 2px solid #373737;">
                                        <tbody style="font-size:22px;">
                                          <tr style="font-size: 22px;">
                                               <th style="padding:5px 0px; text-align:center; width:45%;">Description</th>
                                            <th style="text-align:center; width:9%; font-weight:600;">Size</th>
                                            <th style="text-align:center; width:9%; font-weight:600;">Qty</th>
                                            <th style="text-align:center; width:9%; font-weight:600;">MRP</th>
                                          </tr>
                                          <?php
                                          $item=0;
                                          
                                          while($resultItem=$obj->fetchNextObject($itmesArr)){
                                            $PSql = $obj->query("select unit_id,mrp_price,discount,gst,size from tbl_productprice where id='".$resultItem->price_id."'");
                                            $PResult = $obj->fetchNextObject($PSql);
                                            $unit = getField('name',$tbl_unit,$PResult->unit_id);
                                            $brand = getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$resultItem->product_id));

                                            ?>
                                            <tr>
                                                    <td style="padding:10px 0px;"><?php echo $resultItem->product_name." (".$brand.")"; ?></td>
                                              <td style="padding:10px 0px; text-align:center"><?php echo $PResult->size." ".$unit; ?></td>
                                              <td style="padding:10px 0px; text-align:center"><?php echo $resultItem->qty; ?></td>
                                              <td style="padding:10px 0px; text-align:center"><?php echo number_format($PResult->mrp_price,0) ?></td>
                                            </tr>
                                            <?php 
										  }?>

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

            </div>
          
        </div>
      </section>
	  <?php }?>
	   <div class="">
      <section>
	 
        <div class="container-fluid pagebreak">
            <div style="padding:0px 30px 2px; width:100%; margin:auto">
              <table style="min-width:100%" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody>
                  <tr>
                    <td>
                      <div style="padding: 40px 10px 0px 10px; border-bottom: 2px dotted #373737; height: 25px; padding-bottom: 0px;"></div>
                    </td>
                  </tr>

                  <tr>
				   <td>
                      <div style="padding: 0px 0px -15px 0px; margin-top: 20px; border: 2px solid #373737; border-bottom: none; margin-bottom:-15px;">
					                     
                        <h4 style="text-align: center; font-size: 22px;  margin: 0px 0px 0px 0px; font-weight: 500; color: #000;font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">Invoice Summary <span style="font-size:27px;float: right;font-weight: 600;"><?php if($result->payment_status==1){ echo "Paid"; }else{ echo "Unpaid"; } ?></span></h4>  
						
                        <p style=" color: #000;  width: 37%; display: inline-block;font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;font-size:22px;">Order Id :- <strong><?php echo $result->order_id; ?></strong></p>
                        <p style="color: #000;  width: 42%; display: inline-block; margin-bottom:10px; font-size:21px; font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">Date & Time :</br><?php echo $result->ship_date; ?><br><?php echo getField('time_from',$tbl_bookingslot,$result->ship_timing)." ".getField('time_to',$tbl_bookingslot,$result->ship_timing); ?></p>
                      
                     
					  </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <div style=" padding: 4px 13px 4px 13px;border: 2px solid #373737; border-bottom: none; display:none;">
                        <table cellspacing="0" width="100%" cellpadding="0" border="0"  style="font-size:11px;">
                          <tbody>
                            <tr>
                              <td valign="middle">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                  <tbody style="font-size:18px;font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">
                                    <tr>
                                      <th style="padding:5px 0px; text-align:center; width:70%">Description</th>
                                      <th style="text-align:center; width:15%">Size</th>
                                      <th style="text-align:center; width:15%">Qty</th>
                                    </tr>
                                    <?php
                                    $i=0;
                                    $itmesArr=$obj->query("select * from $tbl_order_itmes where order_id='".$result->id."'",$debug=-1);
                                    while($resultItem=$obj->fetchNextObject($itmesArr)){
                                      $PSql = $obj->query("select unit_id,size from tbl_productprice where id='".$resultItem->price_id."'");
                                      $PResult = $obj->fetchNextObject($PSql);
                                      $unit = getField('name',$tbl_unit,$PResult->unit_id);
                                      $brand = getField('brand',$tbl_brand,getField('brand_id',$tbl_product,$resultItem->product_id));
                                      ?>
                                      <tr>
                                        <td style="padding:3px 0px;"><?php echo $resultItem->product_name." ".$unit." (".$brand.")"; ?></td>
                                        <td style="padding:3px 0px; text-align:center"><?php echo $PResult->size." ".$unit ?></td>
                                        <td style="padding:3px 0px; text-align:center"><?php echo $resultItem->qty; ?></td>
                                      </tr>
                                      <?php $i++; }?>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <div style=" padding:0px 0px 0px 0px;border: 2px solid #373737; border-bottom: none">
                          <p style="margin-top: 2px; margin-bottom:2px;">
                          <span style="text-align: left; font-size: 22px;  margin: 0px 15px 6px 0px; font-weight: 500; color: #000;">Item Count : <strong>(<?php echo $item ?>)  </strong></span>
                          <span style="text-align: right; font-size: 22px;  margin: 0px 15px 6px 20px; font-weight: 500; color: #000;">Receiving Amount : <strong><?php echo number_format($result->total_amount,0); ?> </strong></span>
                          <span style="text-align: left; font-size: 22px;  margin: 0px 15px 6px 0px; font-weight: 500; color: #000;">
                              <!--Payment Status : --><?php //if($result->payment_status==1){ echo "Paid"; }else{ echo "Unpaid"; } ?>
                           
                              </span>
                          </p>
                        </div>
                      </td>

                    </tr>

                    <tr>
                      <td>
                        <div style=" padding: 0px 10px 7px 13px;border: 2px solid #373737; height:72px; margin-bottom:2px; font-family:Tahoma, Geneva, Tahoma, Geneva, sans-serif;">
                          <h4 style="text-align: center; font-size: 22px;  margin: 0px 15px 0px 0px; font-weight: 500; color: #000;">Receiving </h4>
                          
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </div>
           
          </div>
        </section>
</div>
</div>
      </body>

      </html>

