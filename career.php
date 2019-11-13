<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

?>
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
</head>
<body>
  <?php include("header.inc.php"); ?>

  <section id="listing">
    <div class="container">
      <div class="row">
          <div class="col-xs-12 col-sm-12 aboutus">
            <h2><?php echo getTitle(16) ?></h2>
            <?php echo getContent(16); ?>
          </div>
        </div>

      </div>


    </section>

    <?php include("footer.inc.php"); ?>
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

    </script>
  </body>
  </html>