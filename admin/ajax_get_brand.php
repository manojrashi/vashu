<?php
include("../include/config.php");
include("../include/functions.php"); 
 validate_admin();
  $cat_id=$_REQUEST['cat_id'];
?>
<option value="">Select Brand</option>
<?php
$brandArr=$obj->query("select * from $tbl_brand where status=1 and cat_id='".$cat_id."' order by brand ",$debug=-1); 
while($resultBrand=$obj->fetchNextObject($brandArr)){
?>
<option value="<?php echo $resultBrand->id; ?>"<?php if($resultBrand->id==$result->brand_id){?>selected<?php } ?>><?php echo stripslashes($resultBrand->brand); ?></option>
<?php } ?>