<?php
session_start();
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");


if($_FILES['file']['size']>0 && $_FILES['file']['error']==''){
  $Image=new SimpleImage();
  $img=time().$_FILES['file']['name'];
  move_uploaded_file($_FILES['file']['tmp_name'],"../upload_images/user/".$img);
  copy("../upload_images/user/".$img,"../upload_images/user/thumb/".$img);
  $Image->load("../upload_images/user/thumb/".$img);
  $Image->resize(400,400);
  $Image->save("../upload_images/user/thumb/".$img);

  copy("../upload_images/user/".$img,"../upload_images/user/big/".$img);
  $Image->load("../upload_images/user/big/".$img);
  $Image->resize(1070,650);
  $Image->save("../upload_images/user/big/".$img);

  copy("../upload_images/user/".$img,"../upload_images/user/tiny/".$img);
  $Image->load("../upload_images/user/tiny/".$img);
  $Image->resize(150,150);
  $Image->save("../upload_images/user/tiny/".$img);
}  

$sql="update $tbl_user set photo='$img' where id='".$_SESSION['user_id']."'"; 
$obj->query($sql);
?>

<figure>
  <img src="upload_images/user/tiny/<?php echo getField('photo',$tbl_user,$_SESSION['user_id']) ?>"> 
</figure>
