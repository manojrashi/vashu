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
  <title>Wishlist</title>
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
              <img src="<?php echo 'upload_images/user/tiny/',getField('photo',$tbl_user,$_SESSION['user_id']) ?>"> 
            <?php }else{ ?>
          <img src="images/blank-gallery.png">
          <?php } ?>
          </figure>
          </div>
         
         <div class="userimage">
           <form method="POST" enctype="multipart/form-data" action="change-image.php">
            <!--<input type="file" name="file"> -->
            <span onclick="file_explorer();"><i class="fa fa-upload"></i><?php echo $ChangeImage; ?> </span>
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
  <form name="frm" method="post" action="banner-del.php" enctype="multipart/form-data">
                <p style="text-align:center; color: red;"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p>
              <div class="box">
                <div class="box-body">
                  <table id="wish-list" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="50px" ><!-- <div class="squaredFour">
                          <input name="check_all" type="checkbox"  id="check_all" value="check_all" />
                          <label for="check_all"></label>
                        </div> -->
                      </th>

                      <th>Product Name</th>
                      <th class="no-sort">Image</th>   
                      <th>View</th>                     

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    $sql=$obj->query("select *,A.id as id,A.slug,B.id as witch_list_id from $tbl_product as A RIGHT JOIN $tbl_wishlist as B on A.id = B.product_id where B.user_id=".$_SESSION['user_id'],$debug=-1);
                    $rows=$obj->numRows($sql);
                    if($rows>0){
                    while($line=$obj->fetchNextObject($sql)){ ?>
                      <tr>
                        <td>
                          <div class="squaredFour">
                            <input type="checkbox" class="checkall" id="squaredFour<?php echo $line->witch_list_id;?>" name="ids[]" value="<?php echo $line->witch_list_id;?>" />
                            <label for="squaredFour<?php echo $line->witch_list_id;?>"></label>
                          </div>
                        </td>
                        <td>
                          <?php 
                          echo ucfirst(stripslashes($line->product_name));
                          ?></td>
                        <?php  
                        $sql2=$obj->query("select * from $tbl_productprice where product_id=".$line->id,$debug=-1);
                        $val=$obj->fetchNextObject($sql2);?>
                        <td><img class="thumbnail" src="upload_images/product/thumb/<?php echo $val->pphoto ?>" style="height: 100px;width: 100px;"></td>

                        <td>
                          <a href="details/<?php echo $line->slug ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
              <div class="row">
                <!-- <div class="col-md-9"></div> -->
                <div class="col-md-12">
                  <input type="hidden" name="what" value="what" />
                 <!--  <input type="submit" name="Submit" value="Enable" class="btn button btn-success" onclick="return del_prompt(this.form,this.value)" />
                  <input type="submit" name="Submit" value="Disable" class="btn button btn-warning" onclick="return del_prompt(this.form,this.value)" /> -->
                  <input type="submit" name="Submit" value="<?php echo $Delete;?>" class="btn button btn-danger" onclick="return del_prompt(this.form,this.value)" />
                </div>
              </div>
            </form>
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
          frmobj.action = "witch-list-del.php";
          frmobj.what.value="Delete";
          frmobj.submit();
          
        }
        else{ 
        return false;
        }
    }
    else if(comb=='Disable'){
      frmobj.action = "witch-list-del.php";
      frmobj.what.value="Disable";
      frmobj.submit();
    }
    else if(comb=='Enable'){
      frmobj.action = "witch-list-del.php";
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
<script>
  $(document).ready(function() {
    $('#wish-list').DataTable();
  } );
</script> 
<style type="text/css">
  .dataTables_filter{text-align: right;}
  .dataTables_paginate{text-align: right;}
</style>
</body>
</html>
