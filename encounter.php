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
$return = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Scrolling Nav - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/ehr.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<?php require_once(BASE_PATH . '/includes/header.inc.php'); ?>

    <section id="cc" class="cc-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Chief Complaint Section</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="history" class="history-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>History Section</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="exam" class="exam-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Physical Exam Section</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="mdm" class="mdm-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Medical Decision Making Section</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

</body>

</html>
