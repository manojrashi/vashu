<?php
include("../include/config.php");
include("../include/functions.php"); 
 validate_admin();
 
$cat_id=$_REQUEST['cat_id'];
$areaArr=$obj->query("select * from $tbl_subcategory where cat_id='".$cat_id."' and status=1 ",$debug=-1);
if($obj->numRows($areaArr)){ 
while($resultArea=$obj->fetchNextObject($areaArr)){?>
	<option value="<?php echo $resultArea->id ;?>" ><?php echo $resultArea->subcategory;?></option>
<?php } } else { ?>
	<option value="-1">No Record</option>
<?php } ?>


