<?php 
include('../include/config.php');
include("../include/functions.php");
        $city   = $_REQUEST['city_id'];
		$sql=$obj->query("select * from  $tbl_area where city_id='".$city."'",$debug=-1); ?>
	  <option value="">Select Sector</option>
       <?php  while($line=$obj->fetchNextObject($sql)){?>
		<option value="<?php echo $line->id; ?>"><?php echo $line->area; ?></option>
		<?php }?>
		<option value="0">Other</option>
		

