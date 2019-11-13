<section id="free-delivery">

<div class="set-popup">
          <a href="javascript:void(0)" id="set_msg" style="display: none;position: fixed;" class="slideInRight animated">
            <i class="fa fa-check-circle  aria-hidden="true" data-one="1"></i>  <span id="response">Add Your Witchlist</span></a>
          </div>
          
      <div class="container">
        <div class="col-sm-3 left-icon">
          <div class="back">
            <ul>
              <li> <img src="images/img1.jpg" class="img-responsive"></li>
            </ul>
            <h1>Free Delivery</h1>
            <p>For all other over $99</p>
          </div>
        </div>
        <div class="col-sm-3 left-icon">
          <div class="back1">
            <ul>
              <li> <img src="images/img2.jpg" class="img-responsive"></li>
            </ul>
            <h1>90 days return</h1>
            <p>if goods have problems</p>
          </div>
        </div>
        <div class="col-sm-3 left-icon">
          <div class="back1">
            <ul>
              <li> <img src="images/img3.jpg" class="img-responsive"></li>
            </ul>
            <h1>Secure Payment</h1>
            <p>100% Secure Payment</p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="back2">
            <ul>
              <li> <img src="images/img4.jpg" class="img-responsive"></li>
            </ul>
            <h1>24/7 support</h1>
            <p>Dedicated Support</p>
          </div>
        </div>
      </div>
    </section>
<section id="footer">
  <div class="container">
    <div class="col-xs-12 col-sm-12">
      <div class="border1">
        <div class="col-xs-12 col-sm-3">
          <div class="aboutMain">
            <h2>Quick Links</h2>
            <ul>
              <li><a href="privacy-policy">Privacy Policy</a> </li>
              <li><a href="temrs-conditions">Terms Conditions</a></li>
              <li><a href="order-return">Order and Return</a> </li>
              <li><a href="delivery-information">Delivery Information</a></li>
              <li><a href="payment-related-services">Payment Related Services</a> </li>
              
            </ul>
          </div>
        </div>
        <div class="col-xs-12 col-sm-2">
          <div class="aboutMain">
            <h2>Company</h2>
            <ul>
              <li><a href="aboutus">About Us</a> </li>
              <li><a href="career">Career</a> </li>
              <li><a href="contact.php">Contact</a> </li>
              <li><a href="faq">Faqs</a></li>
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
            <form name="subscribeFrm" id="subscribeFrm" method="post" action="subscribe.php">
              <input type="hidden" name="submitFrm" value="yes">
              <input type="text" placeholder="<?php echo $emailaddress; ?>" class="required form-control" name="email">
              <input name="subs_email" id="subsemail" type="text" placeholder="Email Address">
              <button type="submit" id="btnsubmit">Subscribe</button>
            </form>
            <ul>
              <?php if(getField('status',$tbl_social,1)==1){?>
                <li><a href="<?php  echo getField('social_url',$tbl_social,1); ?>" target="_blank"><img src="images/facebook.jpg"></a></li>
              <?php }?>
              <!-- <li><img src="images/twe.jpg"></li> -->
              <?php if(getField('status',$tbl_social,5)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,1);?>" target="_blank" ><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <?php }?>
              <?php if(getField('status',$tbl_social,3)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,3); ?>" target="_blank" ><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
            <?php }?>
             <?php if(getField('status',$tbl_social,2)==1){?>
              <li><a href="<?php  echo getField('social_url',$tbl_social,2); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <?php }?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12">
        <div class="border">
          <div class="col-xs-12 col-sm-6 left"> © yourexpress all rights reserved </div>
          <div class="col-xs-12 col-sm-6 right"><img src="images/visa.jpg" width="335" height="27"></div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
</section>
<!-- Login & Sign Up -->
<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog"> 
      
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <div class="form">
            <div class="col-xs-12 col-sm-12">
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active form">
                    <p>Login</p>
                    <p id="errMsg" style="font-size: 15px; color: red;"></p>
                    <form name="loginfrm" id="loginfrm" method="post">
                      <input type="hidden" name="LoginSubmitForm" value="yes" />
                      <div>
                        <input name="email" id="lemail" type="text" placeholder="<?php echo $Username; ?>">
                        <span id="emailMsg" style="color: red;"></span>
                      </div>
                      <div>
                        <input name="pass" id="lpass" type="password" placeholder="<?php echo $password; ?>">
                        <span id="passMsg" style="color: red;"></span>
                      </div>
                      <div class="remembermemain">
                        <div class="pull-left">
                          <input id="mobileApp" class="nda-checkbox" name="category[]" value="mobileApp" type="checkbox">
                          <span>Remember me</span>
                          <div class="pull-right"><a href="forgetpass.php">Forgot Password ?</a></div>
                        </div>
                      </div>
                      <button type="button" id="loginbtn">Login</button>
                  </form>
                    <div class="mainTitle">
                      <h1>OR</h1>
                    </div>
            <img src="images/FACEBOOK-IMG.jpg" width="430" height="64"> 
             <a href="social_login/login.php"> <img src="images/GOOGE-IMG.jpg" width="430" height="64"></a> </div>
                </div>
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
               <div class="tab-content">
                  <div id="home" class="tab-pane fade in active form">
                    <p>Sign Up</p>
                    <form name="regfrm" id="regfrm" method="post" action="register.php" onsubmit=" return validateform()">
                      <input type="hidden" name="RegisterSubmitForm" value="yes" />
                      <div>
                        <input name="fname" type="text" placeholder="Enter First Name"  maxlength="20">
                      </div>
                      <div>
                        <input name="lname" type="text" placeholder="Enter Last Name"  maxlength="20">
                      </div>
                      <div>
                        <input name="email" type="text" placeholder="Enter Email">
                      </div>
                      <div>
                        <input name="pass" id="passw" type="password" placeholder="Enter Password" >
                      </div>
                      <div>
                        <input name="cpass" id="cpass" type="password" equalTo="#passw" placeholder="<?php echo $Enter." ".$ConfirmPassword; ?>">
                      </div>
                      <button type="submit">Sign Up</button>
                    </form>
                    <div class="mainTitle">
                      <h1>Or</h1>
                    </div>
                    <img src="images/signup-face.jpg" width="430" height="64"> <img src="images/signup-google.jpg" width="430" height="64"></div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.js"></script> 
<script type="text/javascript" src="js/cart.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script> 
<script type="text/javascript"> 
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
  $(document).ready(function(){
    $('#btnsubmit').click(function(e) {
      var isValid = true;
       var subsemail = $("#subsemail").val();
     if(subsemail==''){
        isValid = false;
       $("#subsemail").css({
          "border": "1px solid #e84764"
        });

      }else{
        if(!isEmail(subsemail)){
          isValid = false;
          $("#subsemail").css({
          "border": "1px solid #e84764"
          });
        }else{
          $("#subsemail").css({
            "border": "",
          });
        }
      }

      if (isValid == false) 
       e.preventDefault();
      else 
      $("#subscribeFrm").submit();
      });


    $('#cat_id').change(function() {
     var cat_id=$(this).val(); 
     $.ajax({
      url:"ajax/getData.php",
      data:{cat_id:cat_id,action:'getCategory'},
      beforeSend:function(){
        <?php if($_SESSION['lang']=='en'){?>
        $("#subcat_id").html('<option value=""><?php echo $selectSubCategory; ?></option>');
      <?php }else{?>
        $("#subcat_id").html('<option value=""><?php echo $selectSubCategory; ?></option>');
      <?php }?>
        },
      success:function(data){
          $("#subcat_id").append(data);
        }
      
      })
    })


    $('#subcat_id').change(function() {
     var subcat_id= $(this).val(); 
     $.ajax({
      url:"ajax/getData.php",
      data:{cat_id:subcat_id,action:'getBrand'},
      beforeSend:function(){
        <?php if($_SESSION['lang']=='en'){?>
        $("#brand_id").html('<option value=""><?php echo $selectBrand; ?></option>');
      <?php }else{?>
       $("#brand_id").html('<option value=""><?php echo $selectBrand; ?></option>');
      <?php }?>
        
        },
      success:function(data){
          $("#brand_id").append(data);
        }
      
      })
    })


     $("#loginbtn").click(function(){
      var formdata = $("#loginfrm").serialize();
      var email = $("#lemail").val();
      var pass = $("#lpass").val();
      $("#emailMsg").show();
      $("#passMsg").show();

      if(email==''){
        $("#emailMsg").html("This field is required.");
        return false;
      }else if(!isEmail(email)){
        $("#emailMsg").html("Please enter a valid email address.");
        return false;
      }else if(pass==''){
        $("#passMsg").html("This field is required.");
        return false;
      }else{

        $("#emailMsg").hide();
        $("#passMsg").hide();

      $.ajax({
        type: "POST",
        url: "ajax/getLogin.php",
         data:formdata,
        success: function(data){
          var myArray = JSON.parse(data);
          //console.log(myArray.success);
          if(myArray.success==1){
            location.href="dashboard.php";
          }else{
            $("#errMsg").html("Email & Password are wrong!");
            return;
          }
        }
      })
    }
   });

 })
  </script>

<script type="text/javascript">
$('.watchlist').click(function(){
  var prop_id=$(this).data('one');
  var dataString={prop_id:prop_id};
  $.ajax({
    type: "POST",
    url: "add-watchlist.php",
    data: dataString,

    cache: false,
    success: function(response){

      if(response=='1'){
     
      $('#set_star_'+prop_id+ ' i').removeClass('fa-heart-o');
      
      
        $('#set_star_'+prop_id+' i').addClass('fa-heart');
        $('#response').html('Added');
       
      }else{
       $('#set_star_'+prop_id+' i').removeClass('fa-heart');
        $('#set_star_'+prop_id+' i').addClass('fa-heart-o');
         
         $('#response').html('Removed');
      }
      $('#set_msg').show();
      setTimeout(function(){

        $('#set_msg').addClass('slideOutRight animated');
        setTimeout(function(){
           $('#set_msg').removeClass('slideOutRight animated');
          $('#set_msg').addClass('slideIntRight animated');
          $('#set_msg').hide();


        }, 2000);

      }, 1500);


    }
  });

});
</script>
<script type="text/javascript">
    function validateform()
    
        {            

            var fname = document.forms["regfrm"]["fname"].value;
            fname=fname.trim();
            if(fname =='')
            {
                alert("firstname is required");

                return false;}

                       

            var alphaExp = /^[a-zA-Z ]+$/; 
            if(!fname.match(alphaExp)){
                alert("firstname have only alphabets ");
                return false;
            }
            if(fname.length<3){
                alert('first name is not valid');
                
            }
            var lname=document.forms['regfrm']['lname'].value;
            lname=lname.trim();
            if(lname ==''){
                alert('lastname is required');
                return false;
            }

             var alphaExp = /^[a-zA-Z ]+$/; 
            if(!lname.match(alphaExp)){
                alert("lastname have only alphabets");
                return false;}

                 var email=document.forms['regfrm']['email'].value;
            email=email.trim();
            if(email ==''){
                alert('Email is required');
                return false;
            }

            var atpos = email.indexOf("@");
            var dotpos = email.lastIndexOf(".");
            if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
         alert("Not a valid e-mail address");
         return false;}
         
                var pass=document.forms['regfrm']['pass'].value;
               pass=pass.trim();
                if(pass==''){
                    alert('please enter password');
                    return false;
                }
                if(pass.length<6) {
                    alert('password take minimum six digit');
                    return false;
                }

}

</script>