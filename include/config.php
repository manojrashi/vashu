<?php   
ob_start();
@session_start();
error_reporting(0);
//error_reporting(E_ALL);
$hostname = 'localhost';

$username = 'root';
$password ='';
$db_name = 'yourexpresslive';

global $obj;
		
ini_set('date.timezone', 'Asia/Kolkata');
require_once("db.class.php");
require_once("variable.php");
$obj = new DB($hostname, $username, $password, $db_name);
$base_u = $_SERVER["REQUEST_URI"];
@define('SITE_URL',"http://localhost/yourexpresslive/");
@define('SITE_TITLE',"Your Express");
$website_currency_code='<i class="fa fa-inr"></i>';
$website_currency_symbol="&#8377";
date_default_timezone_set('Asia/Kolkata');
?>
