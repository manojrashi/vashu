<?php
ob_start();
session_start();


require_once 'config.php';

//initalize user class
$user_obj = new Cl_User();

/*** Twitter****/
require_once('twitteroauth/twitteroauth.php');
/*** Twitter****/

/*******Google ******/
require_once 'Google/src/config.php';
require_once 'Google/src/Google_Client.php';

require_once 'Google/src/contrib/Google_PlusService.php';
require_once 'Google/src/contrib/Google_Oauth2Service.php';
/*******Google ******/

/*********Facebook Login **********/
require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/GraphUser.php');
require_once('Facebook/GraphSessionInfo.php');
require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/Entities/SignedRequest.php' );


use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;

FacebookSession::setDefaultApplication(FB_APP_ID, FB_APP_SECRET);
$helper = new FacebookRedirectLoginHelper(FB_REDIRECT_URI);
	
if(isset($_GET['type']) && $_GET['type'] == 'facebook' ){
	
	$fb_url = $helper->getLoginUrl(array('email'));
	header('Location: ' . $fb_url);
}

$session = $helper->getSessionFromRedirect();

if(isset($_SESSION['token'])){
	$session = new FacebookSession($_SESSION['token']);
	try{
		$session->validate(FB_APP_ID, FB_APP_SECRET);
	}catch(FacebookAuthorizationException $e){
		echo $e->getMessage();
	}
}

$data = array();

if(isset($session)){
	$_SESSION['token'] = $session->getToken();
	$request = new FacebookRequest($session, 'GET', '/me');
	$response = $request->execute();
	$graph = $response->getGraphObject(GraphUser::className());

	$data = $graph->asArray();
	$id = $graph->getId();
	$image = "https://graph.facebook.com/".$id."/picture?width=100";
	$data['image'] = $image;
	if($user_obj->fb_login($data)){header('Location: home.php');}
	else{header('Location: index.php');}
}
/*********Facebook Login **********/

/*******Google ******/

$client = new Google_Client();
$client->setScopes(array('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me'));
$client->setApprovalPrompt('auto');
	echo "<pre>";
	print_r($_GET); //die;

if(isset($_GET['type']) && $_GET['type'] == 'google' ){



echo 	$authUrl = $client->createAuthUrl();
	header('Location: ' . $authUrl);
}
$plus       = new Google_PlusService($client);
$oauth2     = new Google_Oauth2Service($client);
//unset($_SESSION['access_token']);

if(isset($_GET['code'])) {
	$client->authenticate(); // Authenticate
	$_SESSION['access_token'] = $client->getAccessToken(); // get the access token here 
	header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if(isset($_SESSION['access_token'])) {
	$client->setAccessToken($_SESSION['access_token']);
}

if ($client->getAccessToken()) {
	$_SESSION['access_token'] = $client->getAccessToken();
	$user = $oauth2->userinfo->get();
	try {
		if($user_obj->google_login( $user ))header('Location: ../personalreg.php');
		else header('Location: ../login.php');
	}catch (Exception $e) {
		$error = $e->getMessage();
	}
}
/*******Google ******/

//echo "bdvfkhdbg";
/*** Twitter****/
if (TWITTER_CONSUMER_KEY === '' || TWITTER_CONSUMER_SECRET === '' || TWITTER_CONSUMER_KEY === 'TWITTER_CONSUMER_KEY_HERE' || TWITTER_CONSUMER_SECRET === 'CONSUMER_SECRET_HERE') {
	echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://dev.twitter.com/apps">dev.twitter.com/apps</a>';
	exit;
}


if(isset($_GET['type']) && $_GET['type'] == 'twitter' ){ 
	$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
	$request_token = $connection->getRequestToken(TWITTER_OAUTH_CALLBACK);
	$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret']; 
	//echo "<pre>";print_r($connection);echo "</pre>";
	//echo "<pre>";print_r($_SESSION);echo "</pre>";exit;
	switch ($connection->http_code) {
		case 200:
			$url = $connection->getAuthorizeURL($token); //echo $url;exit;
			header('Location: ' . $url);
			break;
		default:
			$error = 'Could not connect to Twitter. Refresh the page or try again later.';
	}
}else{
	if(( isset( $_SESSION['oauth_token'] ) ) ){
		$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		$_SESSION['access_token'] = $access_token;
		$content = $connection->get('account/verify_credentials');
		$data = array();
		if( !empty( $content->id )){
			$data['id'] = $content->id;
			$data['name'] = $content->name;
			$data['screen_name'] = $content->screen_name;
			$data['picture'] = $content->profile_image_url;
			try {
				if($user_obj->twitter_login($data))header('Location: index.php');
			}catch (Exception $e) {
				$error = $e->getMessage();
			}
				
		}else{
			session_unset();
			session_destroy();
			header('Location: index.php');
		}
	}
}
/*** Twitter****/