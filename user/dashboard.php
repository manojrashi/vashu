<?php
include("../wfcart.php");
include('../include/config.php');
include("../include/functions.php");

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>login</title>
  <link href="css/user_style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
  <section id="desboard">

    <div class="container">
      <div class="col-xs-12 col-sm-3">
        
        <div class="userleft-main">
         <div class="user">
          <figure>
           
           <img src="images/blank-gallery.png">	
         </figure>
         
         <div class="userimage">
           <form method="POST" enctype="multipart/form-data" action="change-image.php">
            <!--<input type="file" name="file"> -->
            <span><i class="fa fa-upload"></i>Change Image </span>
            <input type="hidden" name="imgupload" value="yes">
            <input type="hidden" name="id" value="">
            <!--				<button type="submit" value="" name=""><i class="fa fa-check" aria-hidden="true"></i> </button>-->			</form>
          </div>
        </div>
      </div>
      
      <div class="userliftbaarmain">
       <?php include('sidebar.php'); ?>
     </div>
   </div>
   <div class="col-xs-12 col-sm-9">
    <div class="right-site">
      <div class="col-xs-12 col-sm-12 background">
        
        <div class="col-xs-12 col-sm-4">
          <div class="add-site">
            <img src="images/blank-gallery.png"> </div>
          </div>
          <div class="col-xs-12 col-sm-8">
            <div class="text-site">
              <h2><?php echo $_SESSION['user_name']; ?></h2>
              <p>Mobile : <?php echo getField('mobile','tbl_user',$_SESSION['user_id']) ?><br>
                Email : <?php echo getField('email','tbl_user',$_SESSION['user_id']) ?><br>
                City : Noida<br>
                Qualification : MCA<br>
              Address : </p>
<!-- <div class="col-xs-12 col-sm-3">
<h3>Complete Courses</h3>
<h4>0</h4>
</div>
<div class="col-xs-12 col-sm-3">
<h3>Runinng Courses</h3>
<h4>1</h4>

</div>
<div class="col-xs-12 col-sm-3">
<h3>Future Start Courses</h3>
<h4>0</h4>

</div>
<div class="col-xs-12 col-sm-3">
<h3>Total Enrolled Courses</h3>
<h4>1</h4>

</div> -->
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="loginnew_page/slider.js"></script> 
<script src="js/bootstrap.min.js"></script> 
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
	jQuery(function() {
		jQuery( "#slider_single" ).flatslider({
			min: 10000, max: 500000,
			step: 1000,
			value: 10000,
			range: "min",
			einheit: '$'
		});
		
		jQuery( "#slider_single1" ).flatslider({
			min:1, max: 12,
			step: 1,
			value: 1,
			range: "min",
			einheit: 'months'
		});
		
		
		
	});
</script>
</body>
</html>