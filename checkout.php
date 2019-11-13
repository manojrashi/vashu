<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

if($_SESSION['user_id']!=''){
$usersql = $obj->query("select * from $tbl_user where id='".$_SESSION['user_id']."'");
$userReuslt = $obj->fetchNextObject($usersql);
}else{
//header("location:cart.php");
}

$itmes=$cart->get_contents();
$no_of_itmes=count($itmes);
if($no_of_itmes>0){
foreach($itmes as $item){

$subtotal = $subtotal + $item['subtotal'];
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("head.php"); ?>
</head>
<body>
<?php include("header.inc.php"); ?>

<section id="presscoverage1">
<div class="container">
<div class="col-xs-12 col-sm-8">

<div class="col-xs-12 col-sm-12 left">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
<div class="panel-heading stepOne" role="tab" id="headingOne">
<div class="col-xs-12 col-sm-12 delivery_address">
<h2><span>1</span>Login or Signup</h2>
</div>
<?php if($_SESSION['user_id']==''){?>
<div class="loginStep" id="loginStep">
<div class="row">
<div class="col-sm-6 col-md-6 panel-body">
<p id="errMsg" style="font-size: 15px; color: red;"></p>
<form id="loginForm" name="loginForm" action="" method="post">
   <div class="col-xs-12 col-sm-12">
		<input placeholder="<?php echo $emailaddress; ?>" type="text" id="login_user_id" name="login_user_id" class="form-text" required>
		<span id="emailMsg" style="color: red;"></span>
	</div>
	<div class="col-xs-12 col-sm-12">
		<input placeholder="<?php echo $password; ?>" type="password" id="login_user_password" name="login_user_password" class="form-text" required>
		<span id="passMsg" style="color: red;"></span>
	</div>
	<div class="col-xs-12 col-sm-12">
		<button id="loginFormBtn" name="loginFormBtn">Login</button>
	</div>
</form>	
</div>
<div class="col-sm-6 col-md-6 panel-body">
<h4>New Register Here</h4>
<a onclick="registerFormShowHideDiv()">Click Here</a>
</div>
</div>
</div>
<div class="registrationStep" id="registrationStep" style="display: none;">
<div class="row">
<div class="col-sm-12 col-md-12 panel-body">
<p id="errMsg1" style="font-size: 15px; color: red;"></p>
<form id="registerForm" name="registerForm" action="" method="post">
   <div class="col-xs-12 col-sm-6">
		<input placeholder="First Name" type="text" id="register_fname" name="register_fname" class="form-text" required>
		<span id="fnameMsg" style="color: red;"></span>
	</div>
	<div class="col-xs-12 col-sm-6">
		<input placeholder="Last Name" type="text" id="register_lname" name="register_lname" class="form-text" required>
		<span id="lnameMsg" style="color: red;"></span>
	</div>
	<div class="col-xs-12 col-sm-6">
		<input placeholder="Email" type="text" id="register_email" name="register_email" value="" class="form-text" required>
		<span id="emailMsg1" style="color: red;"></span>
	</div>
	<div class="col-xs-6 col-sm-6">
		<input placeholder="Password" type="password" id="register_password" name="register_password" class="form-text" required>
	    <span id="passMsg1" style="color: red;"></span>
	</div>
	<div class="col-xs-12 col-sm-12">
		<button id="registerFormBtn" name="registerFormBtn">Register</button>
		<span>Have a Account <a class="loginFormShowHideDiv" onclick="loginFormShowHideDiv()">Login Here</a></span>
	</div>
</form>	
</div>
</div>
</div>

<?php } else{ ?>
<div class="col-xs-12 col-sm-12 inputtypetext2 loginUserDetail">
<div class="col-xs-12 col-sm-10">
<div class="left"> 
<h2><i class="fa fa-check" aria-hidden="true"></i> <?php echo $_SESSION['user_name']; ?></h2>
</div>
</div>
<div class="col-xs-12 col-sm-2">
<div class="right"> <a href="logout_checkout.php">Change</a> </div>
</div>
</div>

<?php } ?>	
</div>
</div>
</div>
</div>



<div id="stepTow">
<div class="col-xs-12 col-sm-12 delivery_address">
<h2><span>2</span><?php echo $DeliveryAddress; ?></h2>
</div>
<?php
$userAddSql = $obj->query("select * from $tbl_useraddress where user_id='".$_SESSION['user_id']."'",-1);
if($obj->numRows($userAddSql)>0){

while($userAddResult = $obj->fetchNextObject($userAddSql)){
?>
<div class="col-xs-12 col-sm-12 inputtypetext2">
<div class="col-xs-12 col-sm-10">
<div class="left"> <a>
<input type="radio" name="main" id="main_id" value="<?php echo $userAddResult->id;?>"<?php if($userAddResult->main_id==1){ ?> checked <?php } ?> onclick="return makeMainAddress(this.value,<?php echo $userAddResult->user_id; ?>)"/>

<h2><?php echo $userReuslt->name." ".$userReuslt->surname; ?><span><?php echo $userReuslt->mobile; ?></span></h2>
</a>
<p><?php echo $userAddResult->address;
$address_id=$userAddResult->id;
?></p>
</div>
</div>
</div>
<?php } }else{?>
<div class="col-xs-12 col-sm-12 inputtypetext2">No address available</div>
<?php }?>


<div class="col-xs-12 col-sm-12 left1">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default">
<div class="panel-heading" role="tab" id="headingtwo">
<h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Add New Address</a> </h4>


</div>


<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingtwo">
<div class="panel-body">
<form name="addressForm" id="addressForm" action="" method="post"> 
<div class="col-xs-12 col-sm-12">
<textarea name="address" id="address" class="form-control" cols="20" rows="3" placeholder="Enter your new address"></textarea>
</div>
<div class="shopping">
<ul>
<li><button id="addressFormBtn" name="addressFormBtn">Save and Continue</button></li>
<li><a href="">Cancel</a></li>
</ul>
</div>
</form>	
</div>
</div>
</div>					
</div>
</div>

</div>

<?php
$delivery_charge = getField('delivery_charge',$tbl_setting,1);
if (!empty($_SESSION['couponDiscountAmount']) && $_SESSION['couponstatus']=="1") {

$cartAmountTotal= ($subtotal + $delivery_charge )-$_SESSION['couponDiscountAmount']; 
$discount=$_SESSION['couponDiscountAmount'];
} else {
$cartAmountTotal=$subtotal + $delivery_charge;
$discount=0;
$_SESSION['couponDiscountAmount']='0';
}


?>

<div id="stepThree">
<div class="col-xs-12 col-sm-12 delivery_address">
<h2><span>3</span><?php echo $Payment; ?></h2>
</div>
<div class="col-xs-12 col-sm-12 inputtypetext2">
<form id="placeOrderForm" action="thanks.php" method="post" >
<div class="col-xs-12 col-sm-10">
<div class="left">
<input type="radio" name="payment_method" value="cod" required>
<?php echo $cashondelivery; ?>
</div>
</div>
<div class="col-xs-12 col-sm-10" style="margin-top: 20px;">
<div class="left">
<input type="radio" name="payment_method" value="paypal" required>
<?php echo $Paypal; ?> 
</div>
</div>
<div class="background">
<?php
if($no_of_itmes>0){?>
<input type="hidden" name="address_id" id="address_id" value="<?php echo $address_id ?>">
<input type="hidden" name="cart_total_amount" value="<?php echo $cartAmountTotal ?>">
	<?php if($_SESSION['user_id']!=""){?>
		<button type="submit"><?php echo $placeOrder; ?></button>
	<?php }?>
<?php }?>
</div>
</form>	
</div>
</div>	
</div>
<div class="col-xs-12 col-sm-4 sticky">
<div class="background">     
<div class="CardSummary">
<div class="details">
<h2><?php echo $pricedetails; ?></h2>
</div>
<div class="CardBlock1">
<h4>
<?php echo $subtotalvariable; ?><span><i class="fa fa-rupee"></i> <span><?php echo number_format($subtotal,2); ?></span></span> </div>
<div class="CardBlock1">
<h4>
<?php echo $discountvariable; ?><span><i class="fa fa-rupee"></i> <span><?php echo $discount = number_format($_SESSION['couponDiscountAmount'],0); ?></span></span> </div>
<div class="CardBlock">
<h4><?php echo $shippingvariable; ?><span> <span><i class="fa fa-rupee"></i><?php 
$delivery_charge = getField('delivery_charge',$tbl_setting,1); 
echo number_format($delivery_charge,2);
?></span></span></h4>
<input type="hidden" name="" id="total" value="469">
</div>
<div class="CardBlock1">
<h4><?php echo $amountpayable; ?><span><i class="fa fa-rupee"></i> <span><?php  $grand_total=$subtotal+$delivery_charge-$discount;echo number_format($cartAmountTotal,2); ?></span></span></h4>
</div>
<div class="col-xs-12 col-sm-12 padding-0">
<div class="right-button">
<form class="promo-form" action="" method="post" id="couponCodeForm">
<input type="text" placeholder="<?php echo $PromoCode; ?>" class="input promo-form__input" name="couponCode" id="couponCode">
<input type="hidden" name="cartAmount" value="<?php echo $grand_total ?>">
<button class="" type="submit"><?php echo $Apply; ?></button>
</form>
<span id="couponCodeMsg" class="couponmsg"><?php echo $_SESSION['couponDiscountMsg']; ?></span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<?php include("footer.inc.php"); ?>
<script> 
jQuery(function(){
var j = jQuery; //Just a variable for using jQuery without conflicts
var addInput = '#qty'; //This is the id of the input you are changing
var n = 1; //n is equal to 1

//Set default value to n (n = 1)
j(addInput).val(n);

//On click add 1 to n
j('.plus').on('click', function(){
j(addInput).val(++n);
})

j('.min').on('click', function(){
//If n is bigger or equal to 1 subtract 1 from n
if (n >= 1) {
j(addInput).val(--n);
} else {
//Otherwise do nothing
}
});
});

</script>




<script>



function registerFormShowHideDiv() {
$('#registrationStep').show();
$('#loginStep').hide();
}

function loginFormShowHideDiv() {
$('#registrationStep').hide();
$('#loginStep').show();
}


$(document).ready(function() {


$('#loginFormBtn').on('click', function(e){

e.preventDefault();
var formdata = $("#loginform").serialize();

var email = $("#login_user_id").val();
var pass = $("#login_user_password").val();
$("#emailMsg").show();
$("#passMsg").show();

if(email==''){
$("#emailMsg").html("Please enter email id");
return false;
}else if(!isEmail(email)){
$("#emailMsg").hide();
$("#emailMsg").html("Please enter a valid email address.");
return false;
}else if(pass==''){
$("#emailMsg").hide();
$("#passMsg").html("Please enter password");
return false;
}else{

$.ajax({
type: "POST",
url: "ajax/getLogin.php",
data:{'email':email,'pass':pass},
success: function(data){
location.reload();
}
});
}	   
});



$('#registerFormBtn').on('click', function(e){

e.preventDefault();

var fname = $("#register_fname").val();
var lname = $("#register_lname").val();
var email = $("#register_email").val();
var pass = $("#register_password").val();
$("#fnameMsg").show();
$("#lnameMsg").show();
$("#emailMsg1").show();
$("#passMsg1").show();

if(fname==''){
$("#fnameMsg").html("Please enter first name");
return false;
}else if(lname==''){
$("#lnameMsg").html("Please enter last name");
//$("#fnameMsg").hide();
return false;
}else if(email==''){
$("#emailMsg").html("Please enter email id");
// $("#lnameMsg").hide();
return false;
}else if(!isEmail(email)){
$("#emailMsg1").html("Please enter a valid email address.");
// $("#emailMsg").hide();
return false;
}else if(pass==''){
$("#passMsg1").html("Please enter password");
//$("#emailMsg").hide();
return false;
}else{

$.ajax({
type: "POST",
url: "ajax/registerUser.php",
data:{'email':email,'pass':pass,'fname':fname,'lname':lname},
success: function(data){
location.reload();
}
});
}	   
});	



$('#addressFormBtn').on('click', function(e){
e.preventDefault();

var address = $("#address").val();
$("#addressMsg").show();

if(address==''){
$("#addressMsg").html("Please enter your new address");
return false;
}else{
$.ajax({
type: "POST",
url: "ajax/addAddressUser.php",
data:{'address':address},
success: function(data){
location.reload();
}
});
}	   
});

$(".addressid").click(function(){
var aid = $(this).val();
$("#address_id").val(aid);
})


});


</script>


<script>
$("#couponCodeForm").submit(function(e) {
var url = "ajax/validate-coupon.php";
$.ajax({
type: "POST",
url: url,
data: $("#couponCodeForm").serialize(),
success: function(data)
{  
console.log(data);
//$("#couponCodeMsg").html(data);
location.reload(); 
}
});
e.preventDefault();
})
</script>
<script>
function makeMainAddress(id,user_id)
{
$("#sesMsg").show();
$.ajax({
type: "POST",
url:"MainAddress.php",
data: {id:id,user_id:user_id},
success: function(res){
$("#sesMsg").html("Address update successfully!");
setTimeout(function(){ $("#sesMsg").fadeOut(); }, 2000);
}
});
}
function del_prompt(frmobj,comb)
{
if(comb=='Delete'){

if(confirm ("Are you sure you want to delete record(s)"))
{
frmobj.action = "user-address-del.php";

frmobj.what.value="Delete";

frmobj.address_id.value="<?php echo $id; ?>";

frmobj.submit();
}
else{ 
return false;
}
}
else if(comb=='Disable'){

frmobj.action = "user-address-del.php";

frmobj.what.value="Disable";

frmobj.submit();
}
else if(comb=='Enable'){

frmobj.action = "user-address-del.php";

frmobj.what.value="Enable";

frmobj.submit();
}

}

</script>
</body>
</html>






<style type="text/css">
#presscoverage1 .panel-default>.panel-heading .loginFormShowHideDiv {
display: contents;
padding: 15px 25px;
text-transform: none;
text-decoration: none;
cursor: pointer;
}
#presscoverage1 .background{
margin-top: 40px;
}
#presscoverage1 .left {
padding: 0px;
background: #fff;
margin: 0px;
margin-top: 40px;
}
#presscoverage1 .left1 {
padding: 0px;
}
#loginStep .register-btn{
text-align: center;
}
#loginStep a{
background: #f9631c;
padding: 6px 20px !important;
border-radius: 3px;
margin-top: 20px;
width: 120px;
color: #fff;
}
#presscoverage1 .panel-default .loginStep .loginformDiv {
width: 100%;
margin-bottom: 2px !important;
padding: 6px 10px;
font-size: 15px;
border: 1px solid #ccc;
}
.loginUserDetail .left{
padding: 0px;
background: #fff;
margin: 0px;
margin-top:0px !important;
}
.loginUserDetail h2 {
font-size: 18px;
}
.loginUserDetail h2 i{
color: green;
}
#presscoverage1 #stepTow .inputtypetext2 {
padding: 10px 18px !important;
background: #fff;
}
#presscoverage1 #stepTow .inputtypetext2 .left {
margin-top: 0px !important;
}
#presscoverage1 #stepThree .left {
margin-top: 0px !important;
}


</style>