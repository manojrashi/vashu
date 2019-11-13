<?php
session_start();
include("wfcart.php");
include('include/config.php');
include("include/functions.php");

if($_REQUEST['lang']=='en'){
  $_SESSION['lang'] = 'en';
  include("lang/english.php");
}else if($_REQUEST['lang']=='ar'){
  $_SESSION['lang'] = 'ar';
  include("lang/arbic.php");
}else{
  $_SESSION['lang'] = 'en';
  include("lang/english.php");
}
header("location: ".$_SERVER['HTTP_REFERER']);
exit();
?>