<?php
require_once('includes/config.inc.php');
require_once(BASE_PATH . '/includes/db.inc.php');
require_once(BASE_PATH . '/includes/login.inc.php');
require_once(BASE_PATH . '/includes/util.inc.php');

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
                <h1 class="text-center">Forgot Password</h1>
				<form action="register.php" method="post" id="forgotpassword">
					<div class="form-group">
						<label for="email">Email address</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Email">
					</div>
					<h5 class="text-info">A one-time use temporary password will be sent to you to be used to login and reset your password</h5>
					<button type="submit" class="btn btn-primary center-block" name="forgot">Forgot Password</button>
				</form>
            </div>
		</div>
    </div>

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>