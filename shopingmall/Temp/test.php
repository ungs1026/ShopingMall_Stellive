<?php
include("includes/dbconfig.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name)
{
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}
?>

<html>

<head>
	<title>Welcome to free music streaming service!</title>

	<link rel="stylesheet" type="text/css" href="css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script defer src="js/register.js"></script>
</head>

<body>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<!--Check Box-->
					<h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
					<input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
					<label for="reg-log"></label>

					<div class="card-3d-wrap mx-auto">
						<div class="card-3d-wrapper">
							<div class="card-front">
								<div class="center-wrap">
									<div class="section text-center">
										<h4 class="">Log In</h4>
										<div class="form-group">
											<input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
											<i class="input-icon uil uil-at"></i>
										</div>
										<div class="form-group mt-2">
											<input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
											<i class="input-icon uil uil-lock-alt"></i>
										</div>
										<a href="#" class="btn mt-4">submit</a>
										<p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your password?</a></p>
									</div>
								</div>
							</div>
							<div class="card-back">
								<div class="center-wrap">
									<div class="section text-center">
										<h4 class="mb-4 pb-3">Sign Up</h4>
										<div class="form-group">
											<input type="text" name="logname" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off">
											<i class="input-icon uil uil-user"></i>
										</div>
										<div class="form-group mt-2">
											<input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
											<i class="input-icon uil uil-at"></i>
										</div>
										<div class="form-group mt-2">
											<input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
											<i class="input-icon uil uil-lock-alt"></i>
										</div>
										<a href="#" class="btn mt-4">submit</a>
									</div>
								</div>
							</div>
						</div>
					</div>

			</div>

		</div>
	</div>

</body>

</html>