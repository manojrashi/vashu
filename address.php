<?php
include("wfcart.php");
include('include/config.php');
include("include/functions.php");
//validate_user();
$cart =& $_SESSION['cart'];
if(!is_object($cart)) $cart = new wfCart();
if($_SESSION['user_id']){
 /* $sql=$obj->query("select * from $tbl_useraddress where user_id=".$_SESSION['user_id'],-1);
  $result=$obj->fetchNextObject($sql);
 // print_r($result); die;*/
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Address</title>
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
    <ul class="nav navbar-right panel_toolbox">
    <li><a href="address-addf.php" class="btn btn-primary"><?php echo $AddAddress; ?></a>
    </li>                    </ul> 
   <div class="col-xs-12 col-sm-9">



  <form name="frm" method="post" action="address-del.php" enctype="multipart/form-data">
                <p style="text-align:center; color: red;"><?php if($_SESSION['sess_msg']){ ?><span class="box-title" style="font-size:12px;color:#a94442"><strong><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></strong></span> <?php }?></p>
               

            
              <div class="box">
                  <p id="sesMsg" align="center" style="color: green; font-size: 14px;">

                <div class="box-body">

                  <table id="wish-list" class="table table-bordered table-striped">
                    <thead>
                      <tr>                        
                      <th>Address</th>     
                      <th>Main</th>                  
                       <th>Status</th> 
                       <th>Action</th>                    

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i=1;
                    $sql=$obj->query("select * from $tbl_useraddress where user_id=".$_SESSION['user_id'],-1);
                  
                  while($line=$obj->fetchNextObject($sql)){ ?>
                      <tr>
                        
                        <td>  <?php echo $line->address;?> </td>
                       <td class="padd5">
                  
                      <div class="radio">
                        <label>
                         <input type="radio" name="main" id="main_id" value="<?php echo $line->id;?>"<?php if($line->main_id==1){ ?> checked <?php } ?> onclick="return MainAddress(this.value,<?php echo $id; ?>)"/>
                       </label>
                     </div>
                     
                   </div></div> </td>

                  <td align="center">
                  <label class="switch">
                  <input type="checkbox" class="chkstatus" value="<?php echo $line->id;?>" <?php echo ($line->status=="1")?'checked':'' ?> data-one="<?php echo $tbl_useraddress?>">
                  <div class="slider round"></div>
                </label>

                </td>
                <td><a href="address-addf.php?id=<?php echo $line->id;?>" class="btn btn-primary" title="edit"> <i class="fa fa-pencil"></i></a>
                </td>


                      </tr>
                     

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
                   <input type="submit" name="Submit" value="Enable" class="btn button btn-success" onclick="return del_prompt(this.form,this.value)" />
                  <input type="submit" name="Submit" value="Disabled" class="btn button btn-warning" onclick="return del_prompt(this.form,this.value)" /> 
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
    //alert(comb);
      if(comb=='Delete'){
        if(confirm ("Are you sure you want to delete record(s)"))
        {
          frmobj.action = "address-del.php";
          frmobj.what.value="Delete";
          frmobj.submit();
          
        }
        else{ 
        return false;
        }
    }
    else if(comb=='Disable'){
      frmobj.action = "address-del.php";
      frmobj.what.value="Disable";
      frmobj.submit();
    }
    else if(comb=='Enable'){
      frmobj.action = "address-del.php";
      frmobj.what.value="Enable";
      frmobj.submit();
    }
    
  }

</script>
<script>
  function MainAddress(id,user_id)
  {
  $("#sesMsg").show();
  $.ajax({
   type: "POST",
   url:"MainAddress.php",
   data: {id:id,user_id:user_id},
   success: function(res){
     $("#sesMsg").html("Address update successfully!");
     setTimeout(function(){ $("#sesMsg").fadeOut(); }, 2000);
   }
 });
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


  
<script type="text/javascript">
    $(document).ready(function(){
      $('.chkstatus').click(function(){
        var id=$(this).val();
//alert(id);
$.post("Enable-data.php",{propertyid:id},
  function(res){

  })
})
    })
</script>


<script type="text/javascript">
    $(".checkAll").click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
    });

  </script>
  
</body>
</html>
