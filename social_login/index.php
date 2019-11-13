<?php 
ob_start();
session_start();


print_r($_REQUEST); 
require_once 'config.php'; 
//initalize user classsss
$user_obj = new Cl_User();


	if( !empty( $_POST )){
		try {
			
			$data = $user_obj->login( $_POST );

			if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){

				header('Location: dashboard.php');
			}
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
	}
	//print_r($_SESSION);
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
		header('Location: dashboard.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Login Page</title>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
	<div class="container">
		<?php require_once 'templates/ads.php';?>
		<div class="login-form">
			<?php require_once 'templates/message.php';?>
			<h1 class="text-center">Smart Tutorials</h1>
			<div class="form-header">
				<i class="fa fa-user"></i>
			</div>
			<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input name="email" id="email" type="email" class="form-control" placeholder="Email address" autofocus> 
				<input name="password" id="password" type="password" class="form-control" placeholder="Password"> 
				<button class="btn btn-block bt-login" type="submit">Sign in</button>
				
				<h4 class="text-center login-txt-center">Alternatively, you can log in using:</h4>
				
				<a class="btn btn-default facebook" href="login.php?type=facebook"> <i class="fa fa-facebook modal-icons"></i> Signin with Google </a>  
				<a class="btn btn-default google" href="login.php?type=google"> <i class="fa fa-google-plus modal-icons"></i> Signin with Google </a>  
				<a class="btn btn-default twitter" href="login.php?type=twitter"> <i class="fa fa-twitter modal-icons"></i> Signin with Twitter </a>
			</form>
			<div class="form-footer">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<i class="fa fa-lock"></i>
						<a href="forget_password.php"> Forgot password? </a>
					
					</div>
					
					<div class="col-xs-6 col-sm-6 col-md-6">
						<i class="fa fa-check"></i>
						<a href="register.php"> Sign Up </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/login.js"></script>
  </body>
</html>
<?php ob_end_flush(); ?>
