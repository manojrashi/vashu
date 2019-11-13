<?php

include("../include/config.php");

//$sql=$GLOBALS['obj']->query("select * from tbl_city");
//$data= mysqli_num_rows($sql);
 if(isset($_POST["Export"])){
	  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      //($output, array('City', 'Status'));  
      $sql=$GLOBALS['obj']->query("select * from tbl_order");
      $data= mysqli_num_rows($sql);  
      while($row = mysqli_fetch_assoc($sql))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }
?>