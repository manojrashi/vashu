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
  <title>Manage Product</title>
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
            <div class="col-md-12 listpage"><h4 style="margin-left: -30px;">Manage Product</h4></div>
          </div>
          <div class="col-md-6">
            <p style="text-align:center; color: green; margin-top: 5px; font-size: 15px;"><?php if($_SESSION['sess_msg']){ ?><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong><?php }?></p>
          </div>
           <div class="col-md-3 background">
        
           <p style="text-align:right"><input type="button" name="add" value="Add Product" class="btn btn-success" onclick="location.href='product-addf.php'" /></p>  

          </div>
        </div>

        <form name="frm" method="post" action="banner-del.php" enctype="multipart/form-data">
          <div class="row">
            <div class="box">
              <div class="box-body">
                <table id="product-list" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="50px" ><div class="squaredFour">
                        <input name="check_all" type="checkbox"  id="check_all" value="check_all" />
                        <label for="check_all"></label>
                      </div>
                    </th>
                    <th width="200px;">Product Name</th>
                    <th width="200px;">Category</th>
                    <th width="100px;">Qty</th>   
                    <th width="100px;">Image</th> 
                    <th width="110px;">Action</th>                     

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                  $sql=$obj->query("select a.id,a.product_name,a.product_code,a.cat_id,a.subcat_id,a.brand_id,a.home,a.best_seller,a.status,a.display_order,a.display_order1,b.pphoto from $tbl_product as a join $tbl_productprice as b on a.id=b.product_id where a.vendor_id=".$_SESSION['user_id'],$debug=-1); //die;
                  $rows=$obj->numRows($sql);
                  if($rows>0){
                    while($line=$obj->fetchNextObject($sql)){ 
                      $VarArr = '';
                      $Var='';
                      $VarArr = array();
                      $PriceSql = $obj->query("select id,size,unit_id from $tbl_productprice where product_id='".$line->id."'");
                      while($PriceResult = $obj->fetchNextObject($PriceSql)){
                        $totqty = getTotalQty($line->id,$PriceResult->id);
                        $VarArr[] = $PriceResult->size."  ".getField('name',$tbl_unit,$PriceResult->unit_id)." - ".$totqty;
                      }

                      $Var='';
                      $Vr = array();
                      if(!empty($VarArr)){
                        for($j=0; $j < count($VarArr); $j++){
                          $Vr = explode('-',$VarArr[$j]);
                          if($Vr[1] <= getField('minstockqty',$tbl_setting,1)){
                            $Var .= '<span class="minimumstockqty">';
                          }
                          $Var .= $VarArr[$j];
                          $Var .= "</br>";
                          if($Vr[1] <= 20){
                            $Var .= '</span>';
                          }
                        }
                      }else{
                        $Var='';
                      }
                      ?>
                      <tr>
                        <td>
                          <div class="squaredFour">
                            <input type="checkbox" class="checkall" id="squaredFour<?php echo $line->id;?>" name="ids[]" value="<?php echo $line->id;?>" />
                            <label for="squaredFour<?php echo $line->id;?>"></label>
                          </div>
                        </td>
                        <td><?php
                        echo "<strong>Product :</strong> ".$line->product_name."</br><strong>Brand :</strong>".getField('brand',$tbl_brand,$line->brand_id); 
                        ?></td>
                        <td><?php 
                        echo ucfirst(getField('category',$tbl_category,$line->cat_id))." - > ".ucfirst(getField('subcategory',$tbl_subcategory,$line->subcat_id));
                        ?></td>
                        <td><?php echo $Var; ?></td>
                        <td><img class="thumbnail" src="upload_images/product/thumb/<?php echo $line->pphoto ?>" style="height: 76px;width: 100px; margin-bottom: 5px;"></td>
                          <td align="center">
                          <a href="product-addf.php?id=<?php echo base64_encode(base64_encode($line->id)); ?>" class="btn btn-primary" title="edit"> <i class="fa fa-pencil"></i></a>&nbsp;
                          <a href="productprice-list.php?product_id=<?php echo $line->id; ?>" class="btn btn-primary" title="Manage price/size">&nbsp;<i class="fa fa-inr"></i>&nbsp;</a></br>
                          <label class="switch">
                          <input type="checkbox" class="chkstatus" value="<?php echo $line->id;?>" <?php echo ($line->status=="1")?'checked':'' ?> data-one="<?php echo $tbl_product?>">
                          <div class="slider round"></div>
                        </label>
                          
                        </td>

                      </tr>
                      <?php $i++; }?>

                      <?php } ?>

                    </tbody>

                    <tfoot>
                    </tfoot>

                  </table>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
            <div class="row">
              <!-- <div class="col-md-9"></div> -->
              <div class="col-md-12">
                <input type="hidden" name="what" value="what" />
                <input type="submit" name="Submit" value="Enable" class="btn button btn-success" onclick="return del_prompt(this.form,this.value)" />
                <input type="submit" name="Submit" value="Disable" class="btn button btn-warning" onclick="return del_prompt(this.form,this.value)" />
                <input type="submit" name="Submit" value="Delete" class="btn button btn-danger" onclick="return del_prompt(this.form,this.value)" />
              </div>
            </div>
          </form>

        </div>
      </div>
    </section>
    <script>
      function del_prompt(frmobj,comb)
      {

        if(comb=='Delete'){
          if(confirm ("Are you sure you want to delete record(s)"))
          {
            frmobj.action = "product-del.php";
            frmobj.what.value="Delete";
            frmobj.submit();

          }
          else{ 
            return false;
          }
        }
        else if(comb=='Disable'){
          frmobj.action = "product-del.php";
          frmobj.what.value="Disable";
          frmobj.submit();
        }
        else if(comb=='Enable'){
          frmobj.action = "product-del.php";
          frmobj.what.value="Enable";
          frmobj.submit();
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
