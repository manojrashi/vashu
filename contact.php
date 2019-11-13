<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

if(isset($_POST['submit'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];  
  $message=$_POST['message'];

  $obj->query("insert into tbl_enquiry set uname='$name',uemail='$email',contact='$phone',enq_message='$message',status=1",$debug=-1); //die;

 
      $to=getField('email',$tbl_setting,1);

      $subject = "Contact Us";
      $message ='<table width="100%" cellspacing="0" cellpadding="0"  style="max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">
                  <tr>
                    <td> Name </td>
                    <td>'.$name.'</td>
                  </tr>
                  <tr>
                    <td>Phone Number </td>
                    <td>'.$phone.'</td>
                  </tr>
                  <tr>
                    <td>Email Address </td>
                    <td>'.$email.'</td>
                  </tr>                  
                  <tr>
                    <td>Message </td>
                    <td>'.$message.'</td>
                  </tr>
                 
             </table>';
  
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8\r\n";
  $headers .= "From:info@gmail.com23\r\n" ;  
  mail($to,$subject,$message,$headers); 
  $_SESSION['msg'] = "Your request have been send successfully!"; 

}?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title></title>
<!-- Bootstrap -->
<link href="css/style.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link href="css/jquery.bxslider.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/xzoom.css" media="all" /> 
</head>
<body>
 <?php include("header.inc.php"); ?>
 


<section id="contactus">
  <div class="container">
  <div class="col-xs-12 col-sm-5 col-sm-offset-1 contacttext">
     <?php
        $sql2=$obj->query("select * from $tbl_setting where status=1");
        $line1=$obj->fetchNextObject($sql2);
        ?>
    <h2>Address</h2>
    <p><?php echo substr($line1->address,0,12);?><br> <?php echo substr($line1->address,13); ?>  </p>
    <h2>Email Id</h2>
    <p><?php echo $line1->email;?></p>
   <h2>Phone</h2>
    <p><?php echo $line1->mobile;?></p>
   </div>
   <div class="col-xs-12 col-sm-5 contact-form">
    <h3>Quick enquiry</h3>
     <form action="" method="POST">
       <input type="text" name="name" placeholder="Name">
       <input type="text" name="email" placeholder="Email Id">
       <input type="text" name="phone" placeholder="Phone No.">
       <textarea placeholder="Message" name="message"></textarea>
       <button type="submit" name="submit" value="submit">Submit</button>

     </form>

   </div>


  </div>


</section>



<section id="footer">
  <div class="container">
    <div class="col-xs-12 col-sm-12">
      <div class="border1">
        <div class="col-xs-12 col-sm-2">
          <div class="aboutMain">
            <h2>Quick Links</h2>
            <ul>
              <li><a href="#">Policy</a> </li>
              <li><a href="#">TErm & Conditions</a></li>
              <li><a href="#">Shipping</a> </li>
              <li><a href="#">Return</a></li>
              <li><a href="#">FAQs</a></li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3">
          <div class="aboutMain">
            <h2>Company</h2>
            <ul>
              <li><a href="#">About Us</a> </li>
              <li><a href="#">Affilate</a> </li>
              <li><a href="#">Carrer</a> </li>
              <li><a href="#">Contact</a> </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-3">
          <div class="aboutMain">
            <h2>Bussiness</h2>
            <ul>
              <li><a href="#">Our Press</a> </li>
              <li><a href="#">Checkout</a> </li>
              <li><a href="#">My Account</a> </li>
              <li><a href="#">Shop</a> </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-4">
          <div class="searchMain">
            <h2>Newsletter</h2>
            <input type="email" placeholder="Email Address" class="form-control" name="email">
            <button>Subscribe</button>
            <ul>
              <li><img src="images/facebook.jpg"></li>
              <li><img src="images/twe.jpg"></li>
              <li><img src="images/google.jpg"></li>
              <li><img src="images/yout.jpg"></li>
              <li><img src="images/gallery.jpg"></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12">
        <div class="border">
          <div class="col-xs-12 col-sm-6 left"> © 2018 Your Express. All Rights Reserved </div>
          <div class="col-xs-12 col-sm-6 right"><img src="images/visa.jpg" width="335" height="27"></div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
</section>
<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="form">
            <div class="col-xs-12 col-sm-12">
              <form action="" method="get">
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active form">
                    <p>LOGIN</p>
                    <input name="" type="text" placeholder="Username">
                    <input name="" type="text" placeholder="Password">
                    <div class="remembermemain">
                      <div class="pull-left">
                        <input id="mobileApp" class="nda-checkbox" name="category[]" value="mobileApp" type="checkbox">
                        <span>Remember Me</span>
                        <div class="pull-right"><a href="#">Forgot Password ?</a></div>
                      </div>
                    </div>
                    <button>Login</button>
                    <div class="mainTitle">
                      <h1>OR</h1>
                    </div>
                    <img src="images/FACEBOOK-IMG.jpg" width="430" height="64"> <img src="images/GOOGE-IMG.jpg" width="430" height="64"> </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="form">
            <div class="col-xs-12 col-sm-12">
              <form action="" method="get">
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active form">
                    <p>SIGNUP</p>
                    <input name="" type="text" placeholder="Enter Name">
                    <input type="email"  name="email" placeholder="Enter Email ID">
                    <input name="" type="text" placeholder="Enter Password">
                    <select name="country" id="country"  size="0" maxlength="100"  type="text">
                      <option value="">Create Account For</option>
                    </select>
                    <button>SIGNUP</button>
                    <div class="mainTitle">
                      <h1>OR</h1>
                    </div>
                    <img src="images/signup-face.jpg" width="430" height="64"> <img src="images/signup-google.jpg" width="430" height="64"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.js"></script> 
<script type="text/javascript">
       $(document).ready(function(){
   $(".dropdown").hover(            
       function() {
           $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
           $(this).toggleClass('open');        
       },
function() {
           $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
           $(this).toggleClass('open');       
       }
   );
});
</script> 
<script>
$(document).ready(function() {
var owl = $('.owl-carousel');
            owl.owlCarousel({
                margin: 20,
                nav: true,
                navText: ["", ""],
                loop: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items:5
                    },
                    1000: {
                        items:5
                    }
                }
            })
      
    })
</script> 
<script src="js/jquery.bxslider.js"></script> 
<script>
//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>

<script type="text/javascript" src="js/xzoom.min.js"></script>
<script src="js/setup.js"></script>
</body>
</html>