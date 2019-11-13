<?php
/**
@author muni
@copyright http:www.smarttutorials.net
 */

require_once 'messages.php';

//site specific configuration declartion
define( 'BASE_PATH', 'http://localhost/yourExpress');
define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'root');
define( 'DB_PASSWORD', '2015@#xantatech');
define( 'DB_NAME', 'yourexpress');


//Facebook App Details
define('FB_APP_ID', '233143527544487');
define('FB_APP_SECRET', '86971f7873b510609881c27d5174db80');
define('FB_REDIRECT_URI', 'http://localhost/yourExpress/index.php');



//Google App Details
define('GOOGLE_APP_NAME', 'Rextie');
define('GOOGLE_OAUTH_CLIENT_ID', '852403023110-td2a1ag3tspi4ppsg9h1vli1kjno5v1d.apps.googleusercontent.com');
define('GOOGLE_OAUTH_CLIENT_SECRET', '4eEjjs7ssbX5T40HUiY3F6Mi');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://localhost/yourExpress/social_login/login.php');
define("GOOGLE_SITE_NAME", 'yourExpress'); 


//Twitter login
define('TWITTER_CONSUMER_KEY', 'YOUR_CONSUMER_KEY');
define('TWITTER_CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET');
define('TWITTER_OAUTH_CALLBACK', 'YOUR_OAUTH_CALLBACK');



function __autoload($class)
{
	$parts = explode('_', $class);
	$path = implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}
