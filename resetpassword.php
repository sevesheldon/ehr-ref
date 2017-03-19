<?php
require_once('includes/config.inc.php');
require_once(BASE_PATH . '/includes/util.inc.php');
require_once(BASE_PATH . '/includes/login.inc.php');

if (!isset($_SESSION['valid']) || $_SESSION['valid'] != true) {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Workflow</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/workflow.css" rel="stylesheet">
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php require_once(BASE_PATH . '/includes/header.inc.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
				<?php if (isset($_SESSION['error']) && !isNullOrEmptyStr($_SESSION['error'])) {
					echo $_SESSION['error'];
					unset($_SESSION['error']);
				} ?>
                <h1 class="text-center">Reset Password</h1>
				<form action="register.php" method="post" id="resetpassword">
					<div class="form-group">
						<label for="pwd">Password</label>
						<input type="password" class="form-control" name="pwd" id="pwd" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password">
					</div>
					<button type="submit" class="btn btn-primary" name="resetpassword">Reset</button>
				</form>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#resetpassword").validate({
				rules: {
					pwd: {
						required: true,
						minlength: 12,
						pwcheck: true
					},
					confirm_pwd: {
						required: true,
						equalTo: "#pwd"
					}
				},
				messages: {
					pwd: {
						required: "Please enter your password",
						minlength: "Password must contain at least 12 digits",
						pwcheck: "Password must contain at least 1 number and<br />1 special character: =!-@._*$#%^&+()"
					},
					confirm_pwd: {
						required: "Please confirm your password",
						equalTo: "Passwords must match"
					}
				},
				errorClass: "alert alert-danger",
			});
			
			$.validator.addMethod("pwcheck", function(value) {
				return /^[A-Za-z0-9\d\=!\-@._*$#%^&()+]*$/.test(value) // consists of only these
				&& /[\=!\-@._*$#%^&()+]/.test(value) // has a special character
				&& /\d/.test(value) // has a digit
			});
		});
	</script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
