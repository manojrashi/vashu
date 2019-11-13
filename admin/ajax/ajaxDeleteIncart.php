 <?php
session_start();
include("../../include/config.php");
include("../../include/functions.php"); 
validate_admin();
 

if(!empty($_POST["delAll"])) {
   	 if($_POST['delAll']=='ok')
	 $obj->query("delete from tbl_tmp_cart where 1=1");
  }

 if(!empty($_POST["deleteItemId"])) {
   	 $id = $_POST["deleteItemId"];
	 $obj->query("delete from tbl_tmp_cart where id='".$id."'");
  }

  if(!empty($_POST["updateId"])){

  	$id=$_POST["updateId"];
  	$qty=$_POST['qty'];
  	$obj->query("update tbl_tmp_cart set qty='".$qty."' where id='".$id."'");
  }

  if(!empty($_POST["basketId"])){

  	$id=$_POST["basketId"];
  	$cart_type=$_POST['cartType'];
  	$obj->query("update tbl_tmp_cart set cart_type='".$cart_type."' where id='".$id."'");
  }
   if(!empty($_POST["unsubscribeId"])){

  	$id=$_POST["unsubscribeId"];
  	$obj->query("update tbl_tmp_cart set cart_type='0' where id='".$id."'");
  }



  ?>