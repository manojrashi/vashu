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
<?php include("head.php"); ?>
</head>
<body>
<?php include("header.inc.php"); ?>
<section id="listing">
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-6">
<?php
$NewsSql = $obj->query("select * from $tbl_news where slug='".$_REQUEST['slug']."'");
$NewsResult = $obj->fetchNextObject($NewsSql);
?>
<img src="upload_images/news/big/<?php echo $NewsResult->photo;  ?>" class="img-responsive"></div>
<div class="col-xs-12 col-sm-6 aboutus">
<h2>
  <?php 
  echo $NewsResult->title; 
  ?></h2>
    <?php 
     echo $NewsResult->content;
    ?>
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