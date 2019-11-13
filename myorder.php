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
  <title>My Order</title>
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
      
      <link rel="stylesheet" href="colorbox/colorbox.css" />
      <script src="colorbox/jquery.colorbox.js"></script>
      <div class="col-xs-12 col-sm-9">
        <form name="frm" method="post" action="banner-del.php" enctype="multipart/form-data">
          <p style="text-align:center; color: red;"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p>
          <div class="box">
            <div class="box-body">
              <table id="myorderlist" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th>SNo.</th>
                  <th>Order Date</th>
                  <th>Order Id</th>   
                  <th>Amount</th>
                  <th>Ship Address</th>                     
                  <th>Payment Status</th>
                  <th>Order Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                $sql=$obj->query("select * from $tbl_order where user_id=".$_SESSION['user_id'],$debug=-1);
                $rows=$obj->numRows($sql);
                if($rows>0){
                  while($line=$obj->fetchNextObject($sql)){ ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $line->order_date; ?></td>
                      <td><?php echo $line->orderno; ?></td>
                      <td><?php echo $line->total_amount; ?></td>
                      <td><?php echo $line->ship_address; ?></td>
                      <td>
                      <?php 
                      if($line->payment_status==0){
                        echo "Unpaid";
                      }else{
                        echo "Paid";
                      } 
                      ?></td>
                      <td><?php echo getField('order_status',$tbl_order_status,$line->order_status); ?></td>

                       <script>
                          $(document).ready(function(){
                            $(".iframeOrder<?php echo $line->id; ?>").colorbox({iframe:true, width:"900px;", height:"800px;", frameborder:"0",scrolling:true});                            
                          });
                        </script>

                      <td><a href="admin/vieworder-detail.php?order_id=<?php echo $line->id; ?>" class="btn btn-primary iframeOrder<?php echo $line->id; ?>" title="View Details"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    <?php $i++; }?>
                  <?php } ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <?php include("footer.inc.php"); ?>
  <script src="admin/js/jquery.dataTables.min.js"></script>
  <script src="admin/js/dataTables.bootstrap.min.js"></script>
  <script>
  $(document).ready(function() {
    $('#myorderlist').DataTable();
  } );
</script>
  <style type="text/css">
  .dataTables_filter{text-align: right;}
  .dataTables_paginate{text-align: right;}
</style>
</body>
</html>
