<?php 
session_start(); 
include( "../include/config.php"); 
include( "../include/functions.php"); 
include( "../include/simpleimage.php"); 
validate_admin(); 

$mobile=$_REQUEST[ 'mobile']; 
$title=$obj->escapestring($_REQUEST['title']);
$name=$obj->escapestring($_REQUEST['name']);
$surname=$obj->escapestring($_REQUEST['surname']);
$flat=$obj->escapestring($_REQUEST['flat']);
$flor=$obj->escapestring($_REQUEST['flor']);
$house_no=$obj->escapestring($_REQUEST['house_no']);
$street_no=$obj->escapestring($_REQUEST['street_no']);
$block=$obj->escapestring($_REQUEST['block']); 
$sectorno=$obj->escapestring($_REQUEST['sectorno']);
$landmark=$obj->escapestring($_REQUEST['landmark']);
$area=$obj->escapestring($_REQUEST['area']); 
$city=$obj->escapestring($_REQUEST['city']); 
$state=$obj->escapestring($_REQUEST['state']); 
$deliveryTime=$obj->escapestring($_REQUEST['deliveryTime']);
$totalAmt=$_SESSION['totalAmt'];
$off=$_SESSION['off'];
$subTotalAmt=$_SESSION['subTotalAmt'];
$ip=$_SERVER['REMOTE_ADDR'];

$_SESSION['totalAmt']=""; $_SESSION['off']=""; $_SESSION['subTotalAmt']=""; 
if($_REQUEST['submitForm']=='yes'){ 
    //Referral Code generation
    $code="18B";
    $y=strrev($mobile);
    $res=substr($y,0,5);
    $res1=strrev($res);
    $refer_code=$code.$res1;

    $sql= $obj->query("select * from $tbl_user where mobile='".$mobile."'");
    $numRows=$obj->numRows($sql);
    if($numRows>0){        
             $userResult=$obj->fetchNextObject($sql);
             $user_id=$userResult->id;
             $obj->query("update $tbl_user set title='$title',name='$name', surname='$surname' where id='$user_id' ");

               $sqlua= $obj->query("select * from $tbl_useraddress where user_id='".$user_id."'");
               $numRowsua=$obj->numRows($sqlua);
               if($numRowsua>0)
               {
                    $obj->query("update $tbl_useraddress set flat='$flat',flor='$flor',house_no='$house_no',street_no='$street_no',block='$block',sectorno='$sectorno',landmark='$landmark',area='$area',city='$city',state='$state'  where user_id='$user_id' ");
               }
               else{
                    $obj->query("insert into $tbl_useraddress set user_id='$user_id',flat='$flat',flor='$flor',house_no='$house_no',street_no='$street_no',block='$block',sectorno='$sectorno',landmark='$landmark',area='$area',city='$city',state='$state' ");
               }

        }else{

            $sql3=$obj->query("SELECT * from tbl_setting WHERE id='1'",$debug=-1);
            $adminData=$obj->fetchNextObject($sql3);            
            // Get referral Amount
            $referral_amount_wallet_credit=100;
            $referral_amount=$adminData->referralamtuser-$referral_amount_wallet_credit;
            /* *********************************************************************************
                                    ******** User Registration Process ************
            ************************************************************************************/
            $obj->query("insert into $tbl_user set mobile='$mobile',refer_code='$refer_code', title='$title',name='$name', surname='$surname',referral_amount='$referral_amount', ip='$ip',status='1',register_date=now()");
            $user_id=$obj->lastInsertedId();

            $obj->query("insert into $tbl_credit set t_type='Registration',transection_code='$refer_code',user_id='$user_id', credit_amount='$referral_amount_wallet_credit',type='Cr'");
            $obj->query("insert into $tbl_useraddress set user_id='$user_id',flat='$flat',flor='$flor',house_no='$house_no',street_no='$street_no',block='$block',sectorno='$sectorno',landmark='$landmark',area='$area',city='$city',state='$state' ");
            
        }
        /* *********************************************************************************
            ******** Move tmp_cart to cart table & Plase Order ************
        ************************************************************************************/
        $sqlCart=$obj->query("Select * from tbl_tmp_cart where 1=1");
        $cartNum=$obj->numRows($sqlCart);
    
        if($cartNum>0)
        {
            //move tmp_cart to cart 
            while($cartResult=$obj->fetchNextObject($sqlCart))
            {
                $obj->query("insert into $tbl_cart set 
                        user_id='".$user_id."',
                        product_id='".$cartResult->product_id."',
                        size_id='".$cartResult->size_id."',
                        qty='".$cartResult->qty."',
                        price='".$cartResult->price."',
                        cart_type='".$cartResult->cart_type."',
                        off_days='".$cartResult->off_days."',
                        pdate='".$cartResult->pdate."',
                        status='".$cartResult->status."'
                    ");
            }
          
           //Get City Name
            $city_name=getField('city','tbl_city',$city);
            //Generate Ordere Number
            $orderNumber="18BZ".rand('100000',999999);
             //Place order 
            $obj->query("insert into $tbl_order set 
            order_id='$orderNumber',
            user_id='$user_id',
            order_via='Phone',
            amount='$totalAmt',
            discount_via='Phone',
            discount='$off',
            payment_method='COD',
            total_amount='$subTotalAmt',
            coupon_code='$couponCode',
            ship_name='$name',
            ship_lname='$surname',
            ship_email='$email',
            ship_flat='$flat',
            ship_flor='$flor',
            ship_house_no='$house_no',
            ship_streetno='$street_no',
            ship_block='$block',
            ship_sectorno='$sectorno',
            ship_landmark='$landmark',
            ship_city='$city_name',
            ship_area='$area',
            ship_state='$state',
            ship_mobile='$mobile',
            ship_type='Normal',
            ship_timing='$deliveryTime',
            order_status='1',
            payment_status='0',
            ip='$ip', 
            status='1'
            ",$debug=-1);
            $orderId=$obj->lastInsertedId();

        //Insert data in order_itmes
           $sCart=$obj->query("Select * from tbl_tmp_cart where 1=1");
            while($ordResult=$obj->fetchNextObject($sCart))
            {
                 $prduct_nam=getField('product_name','tbl_product',$ordResult->product_id);
                 $product_size=getField('size','tbl_productprice',$ordResult->size_id);
                 $unit_id=getField('unit_id','tbl_productprice',$ordResult->size_id);
                 $product_unit=getField('name','tbl_unit',$unit_id);

                 $product_name=$prduct_nam.",".$product_size." ".$product_unit;

                    $obj->query("insert into $tbl_order_itmes set 
                    order_id='".$orderId."',
                    product_id='".$ordResult->product_id."',
                    price_id='".$ordResult->size_id."',
                    product_name='".$product_name."',
                    price='".$ordResult->price."',
                    qty='".$ordResult->qty."'
                    ");
            }
            $_SESSION['msg']="Order successfully submitted.Order Reference No :$orderNumber";
            header("location:add-order.php"); 
            exit();
        }
        $_SESSION['msg']="Profile Successfully insert/Update";
header("location:add-order.php"); 
exit();
}


?>
<!DOCTYPE html>
<html>
<?php include( "head.php"); ?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.css">
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include( "header.php"); ?>
        <?php include( "menu.php"); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Add Order</h1>
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a>
                    </li>
                    <li><a href="useraddress-list.php?id=<?php echo $user_id;?>">View Order List</a>
                    </li>
                </ol>
                <?php if(!empty($_SESSION['msg'])){?> <p style="color:#3c8dbc;font-size:18px;margin-left:150px;"><?php echo $_SESSION['msg'];?></p> <?php } $_SESSION['msg']='';?>
            </section>
            <section class="content">
                <div class="box box-primary">
                	<!-- <div id="legend">
		      				<legend class="">User Information </legend>
		    		</div> -->
                    <form name="customerfrm" id="customerfrm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
                        <input type="hidden" name="submitForm" value="yes" />
                      <!--   <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" /> -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <input type="text" id="mobile" name="mobile" class="required form-control" value="<?php echo $result->mobile; ?>" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <select name="title" id="title" class="required form-control" value="<?php echo $result->title; ?>">
											<option value="Mr.">Mr.</option>
											<option value="Miss.">Miss.</option>
											<option value="Mrs.">Mrs.</option>
										</select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" id="name" class="required form-control" value="<?php echo $result->house_no; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Surname</label>
                                        <input type="text" name="surname" id="surname" class=" form-control" value="<?php echo $result->street_no; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Plot/Flat/Door/Suite No</label>
                                        <input type="text" name="flat" id="flat" class="required form-control" value="<?php echo $result->flat; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Floor No</label>
                                        <input type="text" name="flor" id="flor" class="required form-control" value="<?php echo $result->flor; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>House Name/Apartment/Society Name</label>
                                        <input type="text" name="house_no" id="house_no" class="required form-control" value="<?php echo $result->house_no; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Street Name/Number</label>
                                        <input type="text" name="street_no" id="street_no" class=" form-control" value="<?php echo $result->street_no; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Block</label>
                                        <input type="text" name="block" id="block" class="required form-control" value="<?php echo $result->block; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Sector No./Name</label>
                                        <input type="text" name="sectorno" id="sectorno" class="required form-control" value="<?php echo $result->sectorno; ?>">
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Land Mark</label>
                                        <input type="text" name="landmark" id="landmark" class="required form-control" value="<?php echo $result->landmark; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Town/City/District</label>
                                        <select name="city" id="City" class=" required form-control" onchange="get_area()">
                                            <option value="">Choose City</option>
                                            <?php $sql=$obj->query("select * from tbl_city",$debug=-1); 
                                            while($line=$obj->fetchNextObject($sql)){ ?>
                                                <option <?php if ($result->city == $line->id) echo 'selected';?> value="<?php echo $line->id;?>">
                                                <?php echo $line->city;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Area:</label>
                                        <select name="area" id="area" class=" required form-control" >
                                            <option value="">Choose Area</option>
                                            <?php $sql=$obj->query("select * from $tbl_area where status=1 and city_id='".$result->city."'",$debug=-1); 
                                            while($line=$obj->fetchNextObject($sql)){ ?>
                                                <option <?php if ($result->area == $line->id) echo 'selected';?> value="<?php echo $line->id;?>">
                                                <?php echo $line->area;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" name="state" id="state" class=" required form-control" value="<?php echo $result->state; ?>">

                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--==============Add product section===========-->
                            <div class="box box-primary">
                            </div>   
						    <div class='row'>
						    	<div class='col-md-7 col-sm-7 col-xs-12'>
                                	<div class="search-area">
                                      <div id="imaginary_container"> 
                                        <div class="input-group stylish-input-group">
                                            <input type="text" class="form-control" id="category-list-flx"  placeholder="Search Products " >
                                            <span class="input-group-addon">
                                                <button type="button" id="search-buttonh" >
                                                    <i class="fa fa-search" aria-hidden="true"></i> </button>
                                                </button>  
                                            </span>
                                        </div>
                                        <div class="search-category-list">
                                            <div class="overflow-list-wrapper">
                                               <div id="search-product-result"></div>                                             
                                            </div>                       
                                            <div class="clr"></div>
                                        </div>
                                    </div>
                                    <div class="clr"></div>
                                </div>						    		
						    	</div>
                                <br>
						    </div>
                            <div class="clr"></div>
                            <div class="box box-primary"></div>
                            <div class="col-md-5 col-sm-5 col-xs-12">
    						    <div class='row' style="margin-top:-25px;">
    							<!-- 	<div class="col-md-6 col-sm-6 col-xs-12"> -->
                                    <div class="existing-table">
                                        <div id="dailyResult">                                                     
                                        </div>
                                    </div>     
                                    <div class="clr"></div> 
                                  <!--   <div class="col-md-6 col-sm-6 col-xs-12"> -->
                                    <div class="existing-table">
                                        <div id="weeklyResult">                                            
                                        </div>
                                    </div>        
                                    <div class="clr"></div>
                                    <!-- </div>	   </div> -->                                   
                                    <!-- <div class="col-md-6 col-sm-6 col-xs-12"> -->
                                    <div class="existing-table">
                                        <div id="monthlyResult">                                                
                                                <div class="clr"></div>
                                        </div><!--   </div> -->                              
                                    </div>
                                </div>
                                <div>
                                </div>

                            </div>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div id="ourCart">
                            </div>                                
					   </div>
                       <div class="col-md-12 col-sm-12 col-xs-12">
                                             <div class="delivery-date" id="deliveryDateTime">
                                                  <h3 class="cart-date-heading"> Delivery Date & Time</h3>

                                                  <?php
                                                    $date_format = 'l j F';
                                                    $date_format_days = 'l';
                                                    $date1 = strtotime('+1 day');
                                                    $date2 = strtotime('+2 day');
                                                    $date3 = strtotime('+3 day');
                                                  ?>
                                                    <div class="panel with-nav-tabs panel-default" id="datetimediv" style="display:none">
                                                        <div class="panel-heading">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a href="#tab1default" data-toggle="tab"><?php echo date($date_format) ?></a></li>
                                                                    <li><a href="#tab2default" data-toggle="tab"><?php echo date($date_format, $date1) ?></a></li>
                                                                    <li><a href="#tab3default" data-toggle="tab"><?php echo date($date_format, $date2) ?></a></li>                                        
                                                                    <li><a href="#tab4default" data-toggle="tab"><?php echo date($date_format, $date3) ?></a></li>                                        
                                                                </ul>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="tab-content">
                                                                <div class="tab-pane fade in active" id="tab1default">
                                                                  <?php $bSql = $obj->query("select * from tbl_bookingslot where find_in_set('".date($date_format_days)."', booking_days)",$debug=-1); 
                                                                  while ($bookingResult = $obj->fetchNextObject($bSql)) {
                                                                   // $var = date('H');
                                                                   // $delv_time=$var+4;
                                                                   // echo $delv_time;
                                                                  // if($var>=09 && $var)
                                                                  ?>
                                                                  <p ><label class="delivery-time-label" for="deliveryTime<?php echo $bookingResult->id ?>"> <input type="radio" name="deliveryTime" value="<?php echo date($date_format).', '.$bookingResult->bookingslot ?>" id="deliveryTime<?php echo $bookingResult->id ?>" checked /> <?php echo $bookingResult->bookingslot ?> </label></p>
                                                                  <?php } ?>
                                                                </div>
                                                                <div class="tab-pane fade" id="tab2default">
                                                                  <?php $bSql = $obj->query("select * from tbl_bookingslot where find_in_set('".date($date_format_days,$date1)."', booking_days)",$debug=-1); 
                                                                  while ($bookingResult = $obj->fetchNextObject($bSql)) {
                                                                  ?>
                                                                  <p><label class="delivery-time-label" for="deliveryTime1<?php echo $bookingResult->id ?>"> <input type="radio" name="deliveryTime" value="<?php echo date($date_format, $date1).', '.$bookingResult->bookingslot ?>" id="deliveryTime1<?php echo $bookingResult->id ?>" /> <?php echo $bookingResult->bookingslot ?> </label></p>
                                                                  <?php } ?>
                                                                </div>
                                                                <div class="tab-pane fade" id="tab3default">
                                                                  <?php $bSql = $obj->query("select * from tbl_bookingslot where find_in_set('".date($date_format_days,$date2)."', booking_days)",$debug=-1); 
                                                                  while ($bookingResult = $obj->fetchNextObject($bSql)) {
                                                                  ?>
                                                                  <p><label  class="delivery-time-label" for="deliveryTime2<?php echo $bookingResult->id ?>"> <input type="radio" name="deliveryTime" value="<?php echo date($date_format, $date2).', '.$bookingResult->bookingslot ?>" id="deliveryTime2<?php echo $bookingResult->id ?>" /> <?php echo $bookingResult->bookingslot ?> </label></p>
                                                                  <?php } ?>
                                                                </div>
                                                                <div class="tab-pane fade" id="tab4default">
                                                                  <?php $bSql = $obj->query("select * from tbl_bookingslot where find_in_set('".date($date_format_days,$date3)."', booking_days)",$debug=-1); 
                                                                  while ($bookingResult = $obj->fetchNextObject($bSql)) {
                                                                  ?>
                                                                  <p><label class="delivery-time-label" for="deliveryTime3<?php echo $bookingResult->id ?>"> <input type="radio" name="deliveryTime" value="<?php echo date($date_format, $date3).', '.$bookingResult->bookingslot ?>" id="deliveryTime3<?php echo $bookingResult->id ?>" /> <?php echo $bookingResult->bookingslot ?> </label></p>
                                                                  <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                      
                                                    <div class="clr"></div>
                                                </div>
                                            </div>
<!--==============================  Cart section ===============================-->
							<div class="container">
							    <div class="row">
							    	<div class='product'>
                                        <!-- Select time to delever-->
                                         
                                        <!-- End Here -->
							    	</div>
							    </div>
							</div>
                            <div class="box-footer">
                                <div class="col-md-4 col-sm-4 col-xs-12 ">&nbsp;</div>
                                <div class="col-md-4 col-sm-4 col-xs-12 ">
                                <input type="submit" name="submit" value="Place Order" class="button btn btn-lg btn-success " style="padding: 10px 30px;font-size: 18px;align: center;"border="0" />
                                 <!--   <input name="Reset" type="reset" id="Reset" value="Reset" class="button" border="0" /> -->
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 ">&nbsp;</div>
                               
                            </div>
                    </form>
                    </div>
            </section>
            </div>
            <?php include( "footer.php"); ?>
            <div class="control-sidebar-bg"></div>
        </div>
        <script src="js/jquery-2.2.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/app.min.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.3/jquery-confirm.min.js"></script>
        <script type="text/javascript" language="javascript">
function get_area() {
var city = $('#City').val();
jQuery.ajax({
    type: "POST",
    url: "get_area.php",
    dataType: 'html',
    data: {'city': city },
    success: function(res) {
        $('#area').html(res);
    }
});
}
function changeDeliveryTime() {
   
  $("#selectDateTime").css("display","none");
  $("#datetimediv").css("display","block");
  $("#deliveryImg").html("");
}
function ajaxcall()
{
    $.ajax({
        type: "POST",
        url: "ajax/byDaily.php",
        dataType: 'html',
        success:function(data){
            $('#dailyResult').html(data);
        }
     }) 
     $.ajax({
        type: "POST",
        url: "ajax/byWeekly.php",
        dataType: 'html',
        success:function(data){
            $('#weeklyResult').html(data);
        }                     
     }) 
     $.ajax({
        type: "POST",
        url: "ajax/byMonthly.php",
        dataType: 'html',
        success:function(data){
            $('#monthlyResult').html(data);
        }  
     })
     $.ajax({
            type:"POST",
            url:"ajax/ourCart.php",
            dataType:"html",
            success:function(data)
            {
                $('#ourCart').html(data);
            }

     })

}
function blankTmpCart(){
   $.ajax({
        type: "POST",
        url: "ajax/ajaxDeleteIncart.php",
        data: {'delAll':'ok',},
        success: function(data){
                //ajaxcall();
            }
        });
}

function addToCart(lineId, itemId)
{
var qty=$("#qty_"+itemId).val();
var cartType=$("#cartTyp_"+itemId).val();
var price=$("#price_"+itemId).val();
$.ajax({
        type:"POST",
        url:"ajax/insertTmpCartByAjax.php",
        dataType:"JSON",
        data:{'product_id':lineId,'size_id':itemId,'qty':qty,'price':price,'cart_type':cartType},
        success:function(data)
        {
            if(data=="1"){   
                $(".search-category-list").css("display","none");
                $("#category-list-flx").css("background","#FFF");
                 $("#category-list-flx").val("");
                ajaxcall();
            }else{
                alert("Failed!!");
            }
        }
})
}
function addBasket(id)
{
   var  cartType=$('#cartTyp_'+id).val();
   $.ajax({
        type: "POST",
        url: "ajax/ajaxDeleteIncart.php",
        data: {'basketId':id,'cartType':cartType},
        success: function(data){
                ajaxcall();
            }
        });
}
function productDelete(id)
{
$.confirm({
    title: 'Confirm!',
    content: 'Are you sure want to delete this item from Cart.',
    buttons: {
        confirm: function () {
            $.ajax({
                type: "POST",
                url: "ajax/ajaxDeleteIncart.php",
                data: {'deleteItemId':id},
                success: function(data){
                    ajaxcall();
                }
            });
        },
        cancel: function () {                        
        }
    }
});
} 

function unsubscribe(id)
{
$.confirm({
    title: 'Confirm!',
    content: 'Are you sure want to Remove this item from Basket.',
    buttons: {
        confirm: function () {
            $.ajax({
                type: "POST",
                url: "ajax/ajaxDeleteIncart.php",
                data: {'unsubscribeId':id},
                success: function(data){
                    ajaxcall();
                }
            });
        },
        cancel: function () {                        
        }
    }
});
} 

function changeQty(id){
    var qty=$('#qtyval_'+id).val();
    if(qty!=0)
    {
    $.ajax({
        type: "POST",
        url: "ajax/ajaxDeleteIncart.php",
        data: {'updateId':id,'qty':qty},
        success: function(data){
                ajaxcall();
            }
        })
    }else
    {
        ajaxcall();
    }
}
$(document).ready(function() {
        blankTmpCart();
        ajaxcall();
        changeDeliveryTime();
       $("#customerfrm").validate();
        $('#mobile').blur(function(){
    		var mobile= $("#mobile").val();
        	$.ajax({
        		type:"POST",
        		url:"ajax/ajaxSearchDataByMobile.php",
        		dataType:"JSON",
        		data:{'mobile':mobile},
                 beforeSend: function(){
                         ajaxindicatorstart('loading data.. please wait..');
                },
        		success:function(data)
        		{
                    ajaxindicatorstop();	
        			$("#title option[value='"+data.title+"']").attr('selected','selected');
        			$('#name').val(data.name);
        			$('#surname').val(data.surname);
        			$('#flat').val(data.flat);
        			$('#flor').val(data.flor);
        			$('#house_no').val(data.house_no);
        			$('#street_no').val(data.street_no);
        			$('#block').val(data.block);
        			$('#sectorno').val(data.sectorno);
        			$('#landmark').val(data.landmark);
        			$('#state').val(data.state);
        			$("#City option[value='"+data.city+"']").attr('selected','selected');
        			 get_area();
                        jQuery.ajax({
                            type: "POST",
                            url: "get_area.php",
                            dataType: 'html',
                            data: {'city': data.city,'area': data.area},
                            success: function(res) {
                                $('#area').html(res);
                            }
                        });
        		}
        	})
   	 });
    })

$(document).ready(function(){
    $("#category-list-flx").keyup(function(){
        var res=$(this).val();
        if(res!='')
        {
        $.ajax({
        type: "POST",
        url: "ajax/searchProductByName.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#category-list-flx").css("background","#FFF url(images/ajax-loader.gif) no-repeat 50px");
        },
        success: function(data){
            if(data!='')
            {
                $(".search-category-list").css("display","block");
                $("#search-product-result").show();
                $("#search-product-result").html(data);
                $("#category-list-flx").css("background","#FFF");
                    /*$('#search-product-result').click(function(e) { //button click class name is myDiv
                      e.stopPropagation();
                     })
                     $(function(){
                      $(document).click(function(){  
                      $('.search-category-list').hide(); //hide the button
                      });
                    });*/
            }
            else
            {
                $(".search-category-list").css("display","none");
                $("#category-list-flx").css("background","#FFF");
            }
        }
        });
    }
    if(res=='')
    {

                $(".search-category-list").css("display","none");
                $("#category-list-flx").css("background","#FFF");
    }
    });
});



function ajaxindicatorstart(text)
  {
    if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
    jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="images/ajax-loader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
    }
    
    jQuery('#resultLoading').css({
      'width':'100%',
      'height':'100%',
      'position':'fixed',
      'z-index':'10000000',
      'top':'0',
      'left':'0',
      'right':'0',
      'bottom':'0',
      'margin':'auto'
    }); 
    
    jQuery('#resultLoading .bg').css({
      'background':'#000000',
      'opacity':'0.7',
      'width':'100%',
      'height':'100%',
      'position':'absolute',
      'top':'0'
    });
    
    jQuery('#resultLoading>div:first').css({
      'width': '250px',
      'height':'75px',
      'text-align': 'center',
      'position': 'fixed',
      'top':'0',
      'left':'0',
      'right':'0',
      'bottom':'0',
      'margin':'auto',
      'font-size':'16px',
      'z-index':'10',
      'color':'#ffffff'
      
    });

      jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeIn(300);
      jQuery('body').css('cursor', 'wait');
  }

  function ajaxindicatorstop()
  {
      jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeOut(300);
      jQuery('body').css('cursor', 'default');
  }
</script>
        <link rel="stylesheet" href="calender/css/jquery-ui.css">
        <script src="calender/js/jquery-ui.js"></script>
        <script>
            $(function() {
                $("#dob").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '<?php echo date('
                    Y ')-80?>:<?php echo date('
                    Y ')-10?>',
                    dateFormat: "yy-mm-dd",
                });
            });
        </script>
</body>

</html>

