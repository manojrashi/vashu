<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");
validate_user();
$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();

if($_SESSION['user_id']){
  $sql=$obj->query("select * from $tbl_user where id=".$_SESSION['user_id']);
  $result=$obj->fetchNextObject($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard</title>
  <link href="css/user_style.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <?php include("head.php"); ?>
</head>
<body>
  <?php include("header.inc.php"); ?>
  <?php
  $itmes=$cart->get_contents();
  ?>
  <section id="desboard">

    <div class="container">
      <div class="col-xs-12 col-sm-3">
        
        <div class="userleft-main">
         <div class="user">
          <div id="set_images">
            <figure>
            <?php if($result->photo){ ?>
              <img src="upload_images/user/tiny/<?php echo $result->photo; ?>"> 
            <?php }else{ ?>
              <img src="images/blank-gallery.png">
          <?php } ?>
          </figure>
          </div>
         
         <div class="userimage">
           <form method="POST" enctype="multipart/form-data" action="change-image.php">
            <span onclick="file_explorer();"><i class="fa fa-upload"></i>Change Image </span>
            <input type="file" id="selectfile" style="display: none;">
           	</form>
          </div>
        </div>
      </div>
      
      <div class="userliftbaarmain">
       <?php include('sidebar.php'); ?>
     </div>
   </div>
   <div class="col-xs-12 col-sm-9">
    <div class="right-site">
       <p style="text-align:center; color: red;"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p>
      <div class="col-xs-12 col-sm-12 background">
       
        <div class="col-xs-12 col-sm-4">
          <div class="add-site">
            <?php if($result->photo){ ?>
              <img src="upload_images/user/tiny/<?php echo $result->photo; ?>"> 
            <?php }else{ ?>
              <img src="images/blank-gallery.png">
          <?php } ?> </div>
          </div>
          <div class="col-xs-12 col-sm-8">
            <div class="text-site">
              <h2>
                <?php echo $result->name." ".$result->surname; ?></h2>
              <p><strong>Mobile :</strong> <?php echo $result->mobile; ?><br>
                <strong>Email :</strong> <?php echo $result->email; ?>
                <?php
                if($_SESSION['user_type']==2){?>
                  </br>
                  <strong>Address :</strong> <?php echo $result->address; ?>
                <?php }
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include("footer.inc.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="loginnew_page/slider.js"></script> 
<script src="js/bootstrap.min.js"></script> 
</body>
</html>
