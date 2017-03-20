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

    <title>E/M Encounter</title>

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
                <div class="col-sm-10 col-sm-offset-1 form-horizontal">
					<div class="form-group form-group-lg">
						<label for="chiefcomplaint" class="col-sm-4 control-label">Chief Complaint</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="chiefcomplaint">
						</div>
					</div>
                </div>
            </div>
        </div>
    </section>

    <section id="history" class="history-section">
        <div class="container">
            <div class="row" id="HPI">
                <div class="col-sm-12">
                    <h1 class="text-center">History</h1>
					<h2 class="text-center">HPI</h2>
					<form id="HPIform">
						<div class="form-group col-sm-12">
							<label for="HPIname" class="col-sm-2 control-label">Name of Illness</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="HPIname">
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label for="HPIduration" class="col-sm-4 control-label">Duration</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="HPIduration">
							</div>
							<label for="HPIsymptoms" class="col-sm-5 control-label">Associated signs/symptoms</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="HPIsymptoms">
							</div>
							<label for="HPItiming" class="col-sm-4 control-label">Timing</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="HPItiming" placeholder="constant or intermittent">
							</div>
							<label for="HPIseverity" class="col-sm-4 control-label">Severity</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="HPIseverity" placeholder="mild or severe">
							</div>
						</div>
						<div class="form-group col-sm-6">
							<label for="HPIcontext" class="col-sm-4 control-label">Context</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="HPIcontext" placeholder="setting in which the problem started or occurs">
							</div>
							<label for="HPIfactors" class="col-sm-4 control-label">Modifying Factors</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="HPIfactors" placeholder="what changes the symptoms?">
							</div>
							<label for="HPIlocation" class="col-sm-4 control-label">Location in the body</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="HPIlocation">
							</div>
							<label for="HPIquality" class="col-sm-4 control-label">Quality</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="HPIquality">
							</div>
						</div>
					</form>
                </div>
            </div>
			
			<div class="row" id="PFSH">
                <div class="col-sm-12">
					<h2 class="text-center">PFSH - Past medical, family, and social history</h2>
					<p class="text-center">Write complete sentences below.</p>
					<form id="PFSHform">
						<section>
							<div class="form-group col-sm-12">
								<label for="PFSHmedical" class="col-sm-4 control-label">Pertinent medical info from intake questionnaire, and/or pt's current list of medications and allergies.</label>
								<div class="col-sm-8">
									<textarea class="form-control" id="PFSHmedical" rows="5"></textarea>
								</div>
							</div>
						</section>
						
						<section>
							<div class="form-group col-sm-10 col-sm-offset-1">
								<label for="PFSHfamily" class="col-sm-4 control-label">Pertinent family history from intake questionnaire.</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHfamily" rows="3"></textarea>
								</div>
								<label for="PFSHmother" class="col-sm-4 control-label">Mother</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHmother" rows="3"></textarea>
								</div>
								<label for="PFSHfather" class="col-sm-4 control-label">Father</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHfather" rows="3"></textarea>
								</div>
								<label for="PFSHmgmother" class="col-sm-4 control-label">Maternal grandmother</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHmgmother" rows="3"></textarea>
								</div>
								<label for="PFSHmgfather" class="col-sm-4 control-label">Maternal grandfather</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHmgfather" rows="3"></textarea>
								</div>
								<label for="PFSHpgmother" class="col-sm-4 control-label">Paternal grandmother</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHpgmother" rows="3"></textarea>
								</div>
								<label for="PFSHpgfather" class="col-sm-4 control-label">Paternal grandfather</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHpgfather" rows="3"></textarea>
								</div>
								<label for="PFSHsibling1" class="col-sm-4 control-label">Sibling 1</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHsibling1" rows="3"></textarea>
								</div>
								<label for="PFSHsibling2" class="col-sm-4 control-label">Sibling 2</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHsibling2" rows="3"></textarea>
								</div>
								<label for="PFSHsibling3" class="col-sm-4 control-label">Sibling 3</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHsibling3" rows="3"></textarea>
								</div>
								<label for="PFSHsibling4" class="col-sm-4 control-label">Sibling 4</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHsibling4" rows="3"></textarea>
								</div>
								<label for="PFSHother1" class="col-sm-4 control-label">Other family member</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHother1" rows="3"></textarea>
								</div>
							</div>
						</section>
						
						<section>
							<div class="form-group col-sm-10 col-sm-offset-1">
								<h4 class="text-center">Check boxes for "yes"</h4>
								<label for="PFSHsocial" class="col-sm-4 control-label">Pertinent social issues affecting health.</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHfamily" rows="3"></textarea>
								</div>
								<div class="col-sm-3 col-sm-offset-3">
									<div class="checkbox">
										<label for="PFSHjob">
											<input type="checkbox" value="" id="PFSHjob">Has a job?
										</label>
									</div>
									<div class="checkbox">
										<label for="PFSHcar">
											<input type="checkbox" value="" id="PFSHcar">Has a car?
										</label>
									</div>
									<div class="checkbox">
										<label for="PFSHcsection">
											<input type="checkbox" value="" id="PFSHcsection">C-section?
										</label>
									</div>
									<div class="checkbox">
										<label for="PFSHgallbladder">
											<input type="checkbox" value="" id="PFSHgallbladder">Has a gallbladder?
										</label>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="checkbox">
										<label for="PFSHgbs">
											<input type="checkbox" value="" id="PFSHgbs">Gastric bypass surgery?
										</label>
									</div>
									<div class="checkbox">
										<label for="PFSHtherapy">
											<input type="checkbox" value="" id="PFSHjob">Speech or physical therapy?
										</label>
									</div>
									<div class="checkbox">
										<label for="PFSHread">
											<input type="checkbox" value="" id="PFSHread">Learned to read at normal age?
										</label>
									</div>
								</div>
								<div class="col-sm-8 col-sm-offset-2">
									<label for="PFSHeducation" class="col-sm-5 control-label">Furthest educational level</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="PFSHeducation">
									</div>
									<label for="PFSHhousing" class="col-sm-5 control-label">Housing</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="PFSHhousing">
									</div>
								</div>
							</div>
						</section>
					</form>
                </div>
            </div>
			
			<div class="row" id="ROS">
                <div class="col-sm-12">
					<h2 class="text-center">ROS - Review of Systems</h2>
					<p class="text-center">Check all that are applicable.<br>Note: you can copy the intake questionnaire<br>Blank = negative for that symptom.</p>
					<form id="ROSform">
					
					</form>
				</div>
			</div>
        </div>
    </section>

    <section id="exam" class="exam-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <h1 class="text-center">Physical Exam</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="mdm" class="mdm-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <h1 class="text-center">Medical Decision Making</h1>
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
