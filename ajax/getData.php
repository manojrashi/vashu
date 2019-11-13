<?php 
include('../include/config.php');
include("../include/functions.php");


$cat_id = $_REQUEST['cat_id'];
$action = $_REQUEST['action'];


if($action=='getCategory'){
	$sql = $obj->query("select id,subcategory_en,subcategory_ar from $tbl_subcategory where cat_id='$cat_id' and status=1");
	while($result = $obj->fetchNextObject($sql)){?>
		<option value="<?php echo $result->id; ?>"><?php if($_SESSION['lang']=='en'){ echo $result->subcategory_en; }else{ echo $result->subcategory_ar; } ?></option>
	<?php } 
}


if($action=='getBrand'){
	$sql = $obj->query("select id,brand_en,brand_ar from $tbl_brand where subcat_id='$cat_id' and status=1");
	while($result = $obj->fetchNextObject($sql)){?>
		<option value="<?php echo $result->id; ?>"><?php if($_SESSION['lang']=='en'){ echo $result->brand_en; }else{ echo $result->brand_ar; } ?></option>
	<?php } 
}


?>
		

