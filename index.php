<?php
require_once('includes/config.inc.php');
require_once(BASE_PATH . '/includes/util.inc.php');
require_once(BASE_PATH . '/includes/login.inc.php');

/* if (isLoggedIn())
	header("Location: encounter.php"); */

if (isset($_SESSION['redirect_to']) && ($_SESSION['redirect_to'] != '')) {
	$redirect = $_SESSION['redirect_to'];
	unset($_SESSION['redirect_to']);
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

    <title>EHR</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="css/" rel="stylesheet"> -->
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
                <h1 class="text-center">EHR Login</h1>
				<form action="encounter.php" method="post" id="login">
					<input type="hidden" name="redirect" value="<?php if (isset($redirect)) echo $redirect; ?>" />
					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="pwd" id="password" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-primary">Login</button>
				</form>
            </div>
        </div>
		
		<div class="row">
			<div class="col-md-3 col-md-offset-3 text-center">
				<h4><a href="#">Signup for a new account</a></h4>
			</div>
			<div class="col-md-3 text-center">
				<h4><a href="#">Forgot Password</a></h4>
			</div>
		</div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
<?php
/*     <script src="js/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#login").validate({
				rules: {
					email: {
						required: true,
						email: true
					},
					pwd: {
						required: true,
					}
				},
				messages: {
					email: "Please enter a valid email address",
					pwd: "Please enter your password",
				}
			});
		});
	</script> */
?>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
