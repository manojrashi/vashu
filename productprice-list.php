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
  <title>Manage Price/Size</title>
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
        <div class="row">
          <div class="col-md-3">
            <div class="col-md-12 listpage"><h4 style="margin-left: -30px;">Manage Price/Size</h4></div>
          </div>
          <div class="col-md-5">
            <p style="text-align:center; color: green; margin-top: 5px; font-size: 15px;"><?php if($_SESSION['sess_msg']){ ?><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong><?php }?></p>
          </div>
          <div class="col-md-2">
            <p style="text-align:right"><input type="button" name="add" value="Product List"  class="btn btn-success" onclick="location.href='manage-product.php'" /></p>  
          </div>
          <div class="col-md-2">
            <p style="text-align:right"><input type="button" name="add" value="Add Price/Size"  class="btn btn-success" onclick="location.href='productprice-addf.php?product_id=<?php echo $_REQUEST['product_id']; ?>'" /></p>  
          </div>
        </div>
<form name="frm" method="post" action="product-del.php" enctype="multipart/form-data">
            <div class="box">
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                <caption style="text-align: center;color: red" id="msg"></caption>
                  <thead>
                    <tr>
                      <th>
                        <div class="squaredFour">
                        <input name="check_all" type="checkbox"  id="check_all" value="check_all" />
                        <label for="check_all"></label>
                        </div>
                      </th>
                      <th>Size</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Total Qty</th>
                      <th>IN Stock</th>
                      <th>Cart Max Qty</th>
                      <th>Display Order</th>
                      <th>Status</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    $sql=$obj->query("select * from $tbl_productprice where 1=1 and product_id='".$_REQUEST['product_id']."'",$debug=-1);
                    while($line=$obj->fetchNextObject($sql)){

                      $unitquery=$obj->query("select * from $tbl_unit where status=1 and id=".$line->unit_id);
                      $res=$obj->fetchNextObject($unitquery);

                      ?>
                      <tr>
                         <td>
                          <div class="squaredFour">
                          <input type="checkbox" class="checkall" id="squaredFour<?php echo $line->id;?>" name="ids[]" value="<?php echo $line->id;?>" />
                          <label for="squaredFour<?php echo $line->id;?>"></label>
                          </div>
                          </td>
                        <td><?php echo stripslashes($line->size)."&nbsp;"; echo stripslashes($res->name_en);?></td>
                        <td>
                          <?php echo '<strong>Actual: </strong>'.$website_currency_symbol." ".stripslashes($line->actual_price); ?><br/>
                          <?php echo '<strong>MRP: </strong>'.$website_currency_symbol." ".stripslashes($line->mrp_price); ?><br/>
                          <?php echo '<strong>Discount: </strong>'.stripslashes($line->discount); ?> %<br/>
                          <?php echo '<strong>Sell: </strong>'.$website_currency_symbol." ".stripslashes($line->sell_price); ?>
                        </td>
                        
                        <td><?php
                          if(is_file("upload_images/product/tiny/".$line->pphoto)){
                            ?>
                            <img src="upload_images/product/tiny/<?php echo $line->pphoto; ?>" />
                            <?php   
                          }
                          ?></td>
                          <td> <?php echo getTotalQty($_REQUEST['product_id'],$line->id); ?></td>
                          <td> <input type="checkbox" name="in_stcock" value="1"  <?php if($line->in_stock==1){ ?>checked<?php } ?> onclick="return changeStock(this.checked,<?php echo $line->id; ?>)"/></td>
                          <td> <?php echo stripslashes($line->cart_max_qty); ?></td>

                          <td  class="padd5" align="center"><select name="display_order"  style="width:80px;" onchange="return ChangeDisplayOrder(<?php echo $line->id;?>,this.value)">
                            <?php for($i=0; $i<=10;$i++){ ?>
                              <option value="<?php echo $i; ?>" <?php if($line->display_order== $i){?>selected<?php } ?>><?php echo $i; ?></option>
                              <?php } ?>
                            </select>
                          </td> 
                          <td align="center">
                          <label class="switch">
                          <input type="checkbox" class="chkstatus" value="<?php echo $line->id;?>" <?php echo ($line->status=="1")?'checked':'' ?>  data-one="<?php echo $tbl_productprice?>">
                          <div class="slider round"></div>
                          </label>

                          </td>
                              <td align="center">
                                <a href="productprice-addf.php?id=<?php echo $line->id;?>&product_id=<?php echo $_REQUEST['product_id']; ?>" class="btn btn-primary" ><i class="fa fa-pencil"></i></a>
                              </td>
                             
                            </tr>
                            <?php $i++; }?>

                          </tbody>

                          <tfoot>
                          </tfoot>

                        </table>
                      </div>



                      <!-- /.box-body -->
                    </div>
                    <div class="row">
                      <div class="col-md-9"></div>
                      <div class="col-md-6">
                        <input type="hidden" name="what" value="what" />
                        <input type="submit" name="Submit" value="Activate" class="btn button btn-success" onclick="return del_prompt(this.form,this.value)" />
                        <input type="submit" name="Submit" value="Deactivate" class="btn button btn-warning" onclick="return del_prompt(this.form,this.value)" />
                         <input type="submit" name="Submit" value="Delete" class="btn button btn-danger" onclick="return del_prompt(this.form,this.value)" />
                      </div></div>
                    </form>
                    <!-- /.box -->
          

        </div>
      </div>
    </section>
    <script>
      function del_prompt(frmobj,comb)
  {
//alert(comb);
if(comb=='Delete'){
  if(confirm ("Are you sure you want to delete record(s)"))
  {
    frmobj.action = "productprice-del.php?product_id=<?php echo $_REQUEST['product_id']; ?>";
    frmobj.what.value="Delete";
    frmobj.submit();

  }
  else{ 
    return false;
  }
}
else if(comb=='Deactivate'){
  frmobj.action = "productprice-del.php?product_id=<?php echo $_REQUEST['product_id']; ?>";
  frmobj.what.value="Deactivate";
  frmobj.submit();
}
else if(comb=='Activate'){
  frmobj.action = "productprice-del.php?product_id=<?php echo $_REQUEST['product_id']; ?>";
  frmobj.what.value="Activate";
  frmobj.submit();
}


}

function ChangeDisplayOrder(id,val){
  $.ajax({
  url:"admin/changeDisplayOrder.php",
  data:{val:val,id:id},
  beforeSend:function(){
  //
  },
  success:function(data){
    $('#msg').html(data).show().fadeOut('slow');
  }
  })
}

function changeStock(check_box_val,row_id){
  $('#msg').show();
  $.ajax({
  url:"admin/changeStock.php",
  data:{box_val:check_box_val,row_id:row_id},
  beforeSend:function(){
  //
  },
  success:function(data){
   $('#msg').html(data).show().fadeOut('slow');
  
  }
  })
}
function checkall(objForm)
  {
    len = objForm.elements.length;
    var i=0;
    for( i=0 ; i<len ; i++){
      if (objForm.elements[i].type=='checkbox') 
        objForm.elements[i].checked=objForm.check_all.checked;
    }
  }






    </script>

    <?php include("footer.inc.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <script src="loginnew_page/slider.js"></script> 
    <script src="js/bootstrap.min.js"></script>  
    <script src="admin/js/jquery.dataTables.min.js"></script>
    <script src="admin/js/dataTables.bootstrap.min.js"></script>
    <script src="admin/js/change-status.js"></script> 
    <script>
      $(document).ready(function() {
        $('#product-list').DataTable();
      } );
    </script> 
    <style type="text/css">
      .dataTables_filter{text-align: right;}
      .dataTables_paginate{text-align: right;}
    </style>
  </body>
  </html>
