<?php
include("../include/config.php");
include("../include/functions.php"); 
include("../include/simpleimage.php");
validate_admin();

 $cat_id=$obj->escapestring($_REQUEST['cat_id']);
 $brand=$obj->escapestring($_REQUEST['brand']);

if($_REQUEST['cat_id']!=''){
	$Image= new SimpleImage();
  	if($_REQUEST['cat_id']!='')
  	{
		$bArr=$obj->query("select * from $tbl_brand where brand='$brand' and cat_id='$cat_id' ");  
			if($obj->numRows($bArr)==0){
				$img='';
				  if($_FILES['image']['size']>0 && $_FILES['image']['error']==''){
					  $img=time().substr($_FILES['image']['name'],-5);
					  move_uploaded_file($_FILES['image']['tmp_name'],"../upload_images/brand/".$img);
					  copy("../upload_images/brand/".$img,"../upload_images/brand/thumb/".$img);
					  $Image->load("../upload_images/brand/thumb/".$img);	  
					  $Image->resize(100,80);	  
					  $Image->save("../upload_images/brand/thumb/".$img);	 
				  } 	
				 /* echo "insert into $tbl_brand set brand='".ucfirst($brand)."',cat_id='$cat_id',logo='$img',status=1 ";	
				  die;*/	  
		         $res=$obj->query("insert into $tbl_brand set brand='".ucfirst($brand)."',cat_id='$cat_id',logo='$img',status=1 ");
				 $brand_id=mysql_insert_id();
	             generateSlug($brand,$tbl_brand,$brand_id);
			}  
	  }
	  echo $res;

	   
  } 
 

	
?>