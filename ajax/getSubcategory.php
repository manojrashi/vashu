<?php 
include('../include/config.php');
include("../include/functions.php");


$action = = $_REQUEST['cat_id'];
$cat_id = $_REQUEST['cat_id'];

$sql = $obj->query("select id,subcategory_en,subcategory_ar from $tbl_subcategory where cat_id='$cat_id' and status=1");
while($result = $obj->fetchNextObject($sql)){?>
	<option value="<?php echo $result->id; ?>"><?php echo $result->subcategory_en; ?></option>
<?php } ?>

		

