<?php
session_start();
	if(isset($_SESSION['shopdesk-user'])) {
		header('Location: ./');
	}
	$err='';
	if(isset($_POST['hms-btn'])) {
		$em = addslashes($_POST['hms_email']);
		$pwd = strtolower(addslashes($_POST['hms_pwd']));
		if($em == 'm.khizeryounas@gmail.com' && $pwd == '1234') {
			$_SESSION['shopdesk-user'] = 1;
			header('Location: ./');
		}
		else {
			$err = '<small><b style="color: red;">Email / Password is incorrect</b></small>';
		}
	}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Shopdesk</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"> </script>
</head>
<body>
	<div class="login">
		<h1><a href="./">Shopdesk </a></h1>
		<div class="login-bottom">
			<h2>Login</h2>
			<form method="POST">
			<div class="col-md-8">
				<?php echo $err; ?>
				<div class="login-mail">
					<input type="text" placeholder="Email" name="hms_email" required="">
					<i class="fa fa-envelope"></i>
				</div>
				<div class="login-mail">
					<input type="password" placeholder="Password" name="hms_pwd" required="">
					<i class="fa fa-lock"></i>
				</div>			
			</div>
			<div class="col-md-4 login-do">
				<label class="hvr-shutter-in-horizontal login-sub">
					<input type="submit" value="login" name="hms-btn">
				</label>
			</div>
			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<div class="copy-right">
            <p> &copy; <?php echo date('Y'); ?> All Rights Reserved | Powered by <a href="https://shopdesk.co/" target="_blank">Shopdesk</a> </p>	    </div>  
<!---->
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>

