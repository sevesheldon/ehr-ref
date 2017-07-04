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

    <link href="css/bootstrap.min.css" rel="stylesheet">
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
                <div class="col-sm-10 form-horizontal">
					<div class="form-group form-group-lg">
						<label for="chiefcomplaint" class="col-sm-4 control-label">Chief Complaint</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="chiefcomplaint" placeholder="in the patient's own words">
						</div>
					</div>
                </div>
            </div>
        </div>
    </section>
	
	<section id="mdm" class="mdm-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center">Medical Decision Making</h1>
					<h2 class="text-center">Problem(s)</h2>
					<h4 class="text-center">Diagnosis or Probable Diagnosis</h4>
					<p class="text-center text-warning"><strong>The word "new" means new to the physician, not new to the patient</strong></p>
					<form id="MDMform">
						<section id="MDMproblems">
							<section class="clearfix col-sm-12 minorproblems">
								<div class="row">
									<label for="MDMminprob[]" class="control-label col-sm-4 text-right">Self-limited or minor problem #1<br><span class="text-danger">(max of 2)</span></label>
									<div class="form-group col-sm-7">
										<input type="text" value="" class="form-control MDMminprob" name="MDMminprob[]">
									</div>
								</div>
								<div class="row">
									<label for="MDMminprob[]" class="control-label col-sm-4 text-right">Self-limited or minor problem #2<br><span class="text-danger">(max of 2)</span></label>
									<div class="form-group col-sm-7">
										<input type="text" value="" class="form-control MDMminprob" name="MDMminprob[]">
									</div>
								</div>
							</section>
							
							<section class="clearfix col-sm-12 stableproblems">
								<div class="row">
									<label for="MDMstabprob[]" class="control-label col-sm-4 text-right">Established problem, stable or improving #1</label>
									<div class="form-group col-sm-7">
										<input type="text" value="" class="form-control MDMstabprob" name="MDMstabprob[]">
									</div>
									<div clas="col-sm-1">
										<button type="button" class="add-row btn btn-default alert-success">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</button>
										<button type="button" class="remove-row btn btn-default alert-danger">
											<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
										</button>
									</div>
								</div>
							</section>
							
							<section class="clearfix col-sm-12 worseproblems">
								<div class="row">
									<label for="MDMworseprob[]" class="control-label col-sm-4 text-right">Established problem, worsening #1</label>
									<div class="form-group col-sm-7">
										<input type="text" value="" class="form-control MDMworseprob" name="MDMworseprob[]">
									</div>
									<div clas="col-sm-1">
										<button type="button" class="add-row btn btn-default alert-success">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</button>
										<button type="button" class="remove-row btn btn-default alert-danger">
											<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
										</button>
									</div>
								</div>
							</section>
							
							<section class="clearfix col-sm-12 newproblemsnowork">
								<div class="row">
									<label for="MDMnewprobno" class="control-label col-sm-4 text-right">New problem, no additional workup planned<br><span class="text-danger">(max of 1)</span></label>
									<div class="form-group col-sm-7">
										<input type="text" value="" class="form-control MDMnewprobno" name="MDMnewprobno">
									</div>
								</div>
							</section>
							
							<section class="clearfix col-sm-12 newproblemsyeswork">
								<div class="row">
									<label for="MDMnewprobyes[]" class="control-label col-sm-4 text-right">New problem, additional workup planned #1</label>
									<div class="form-group col-sm-7">
										<input type="text" value="" class="form-control MDMnewprobyes" name="MDMnewprobyes[]">
									</div>
									<div clas="col-sm-1">
										<button type="button" class="add-row btn btn-default alert-success">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</button>
										<button type="button" class="remove-row btn btn-default alert-danger">
											<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
										</button>
									</div>
								</div>
							</section>
						</section>
						
						<section id="MDMdata" class="clearfix">
							<h2 class="text-center">Data</h2>
							<p class="text-danger text-center">Check box for 'Yes' as applicable</p>
							<div class="form-group col-sm-4 col-sm-offset-2">
								<div class="checkbox">
									<label for="MDMdatalab">
										<input type="checkbox" value="" id="MDMdatalab">Review or order clinical lab tests
									</label>
								</div>
								<div class="checkbox">
									<label for="MDMdataradio">
										<input type="checkbox" value="" id="MDMdataradio">Review or order radiology tests
									</label>
								</div>
								<div class="checkbox">
									<label for="MDMdatamedicine">
										<input type="checkbox" value="" id="MDMdatamedicine">Review or order medicine test (e.g. EKG)
									</label>
								</div>
							</div>
							<div class="form-group col-sm-4">
								<div class="checkbox">
									<label for="MDMdatadiscuss">
										<input type="checkbox" value="" id="MDMdatadiscuss">Discuss test with performing physician
									</label>
								</div>
								<div class="checkbox">
									<label for="MDMdatarecdec">
										<input type="checkbox" value="" id="MDMdatarecdec">Decision to obtain old records
									</label>
								</div>
								<div class="checkbox">
									<label for="MDMdatarecrev">
										<input type="checkbox" value="" id="MDMdatarecrev">Review <u>and summation</u> of old records
									</label>
								</div>
							</div>
						</section>
						
						<section id="MDMrisk" class="text-center clearfix">
							<h2>Risk to Patient</h2>
							<p class="text-danger">Choose one from the list below. If more than one applies, choose the one that is higher in the list.</p>
							<div class="col-sm-4 col-sm-offset-4">
								<select id="MDMriskmenu" class="form-control">
									<option disabled selected>Select from dropdown list</option>
									<option value="mod">Stopping, starting, or changing Rx (other than LiCo)</option>
									<option value="high">Drug therapy requiring intensive monitoring for toxicity</option>
									<option value="low">Having only 1 well-controlled chronic illness</option>
									<option value="mod">Having 1+ worsening chronic illness</option>
									<option value="mod">Having 2+ well-controlled chronic illnesses</option>
									<option value="mod">A new problem with uncertain diagnosis</option>
									<option value="high">Severe exacerbation of chronic illness</option>
									<option value="high">Acute symptoms with potential threat to self or others</option>
									<option value="high">An abrupt change in neurologic status</option>
									<option value="min">Having only one minor (self-limiting) problem</option>
								</select>
							</div>
						</section>
						
						<section id="MDMresult" class="text-center clearfix col-sm-4 col-sm-offset-4">
							<div class="row"></div>
							<div class="row"><div id="MDM"></div></div>
							<div class="row"><div id="mdm-codes"></div></div>
							<div class="row" id="devinfo" style="margin-top: 25px;"></div>
						</section>
					</form>
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
						<section class="clearfix">
							<div class="form-group col-sm-12">
								<label for="HPIname" class="col-sm-2 control-label">Name of Illness</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="HPIname">
								</div>
							</div>
						</section>
						
						<section class="clearfix">
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
						</section>
					</form>
                </div>
            </div>
			
			<div class="row" id="PFSH">
                <div class="col-sm-12">
					<h2 class="text-center">PFSH - Past medical, family, and social history</h2>
					<p class="text-center text-warning"><strong>Write complete sentences below.</strong></p>
					<form id="PFSHform">
						<section class="clearfix">
							<div class="form-group col-sm-12">
								<label for="PFSHmedical" class="col-sm-4 control-label">Pertinent medical info from intake questionnaire, and/or pt's current list of medications and allergies.</label>
								<div class="col-sm-8">
									<textarea class="form-control" id="PFSHmedical" rows="5"></textarea>
								</div>
							</div>
						</section>
						
						<section class="clearfix">
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
						
						<section class="clearfix">
							<div class="form-group col-sm-10 col-sm-offset-1">
								<h4 class="text-center">Check boxes for "yes"</h4>
								<label for="PFSHsocial" class="col-sm-4 control-label">Pertinent social issues affecting health.</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control" id="PFSHsocial" rows="3"></textarea>
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
											<input type="checkbox" value="" id="PFSHcsection">C-section birth?
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
											<input type="checkbox" value="" id="PFSHtherapy">Speech or physical therapy?
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
					<p class="text-center text-warning"><strong>Check all that are applicable.<br>Note: you can copy the intake questionnaire<br>Unchecked = negative for that symptom.</strong></p>
					<form id="ROSform">
						<section class="clearfix">
							<div class="col-sm-2">
								<h4 class="text-right">Psychiatric</h4>
							</div>
							<div class="form-group col-sm-4">
								<div class="checkbox">
									<label for="ROShallucinate">
										<input type="checkbox" value="" id="ROShallucinate">Hallucinations
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSsi">
										<input type="checkbox" value="" id="ROSsi">SI
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSanxiety">
										<input type="checkbox" value="" id="ROSanxiety">Anxiety
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSinsomnia">
										<input type="checkbox" value="" id="ROSinsomnia">Insomnia
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSdaabuse">
										<input type="checkbox" value="" id="ROSdaabuse">Drug/Alcohol Abuse
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSpsychother1">
										<input type="checkbox" value="" id="ROSpsychother1" class="ROSother"><span class="othertext">Other</span>
									</label>
								</div>
							</div>
							<div class="col-sm-2">
								<h4 class="text-right">Constitutional</h4>
							</div>
							<div class="form-group col-sm-4">
								<div class="checkbox">
									<label for="ROSfatigue">
										<input type="checkbox" value="" id="ROSfatigue">Fatigue
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSeating">
										<input type="checkbox" value="" id="ROSeating">Eating Disorder
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSweight">
										<input type="checkbox" value="" id="ROSweight">Weight Loss
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSfever">
										<input type="checkbox" value="" id="ROSfever">Fever
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSchills">
										<input type="checkbox" value="" id="ROSchills">Chills
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSns">
										<input type="checkbox" value="" id="ROSns">Night Sweats
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSconother1">
										<input type="checkbox" value="" id="ROSconother1" class="ROSother"><span class="othertext">Other</span>
									</label>
								</div>
							</div>
						</section>
						
						<section class="clearfix">
							<div class="col-sm-2">
								<h4 class="text-right">Cardiovascular</h4>
							</div>
							<div class="form-group col-sm-4">
								<div class="checkbox">
									<label for="ROSchest">
										<input type="checkbox" value="" id="ROSchest">Chest pain
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSpalp">
										<input type="checkbox" value="" id="ROSpalp">Palptiations
									</label>
								</div>
								<div class="checkbox">
									<label for="ROScvother1">
										<input type="checkbox" value="" id="ROScvother1" class="ROSother"><span class="othertext">Other</span>
									</label>
								</div>
							</div>
							<div class="col-sm-2">
								<h4 class="text-right">Musculoskeletal</h4>
							</div>
							<div class="form-group col-sm-4">
								<div class="checkbox">
									<label for="ROSmuscle">
										<input type="checkbox" value="" id="ROSmuscle">Muscle Weakness
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSjoint">
										<input type="checkbox" value="" id="ROSjoint">Joint Swelling
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSnsaid">
										<input type="checkbox" value="" id="ROSnsaid">NSAID use
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSskelother1">
										<input type="checkbox" value="" id="ROSskelother1" class="ROSother"><span class="othertext">Other</span>
									</label>
								</div>
							</div>
						</section>
						
						<section class="clearfix">
							<div class="col-sm-2">
								<h4 class="text-right">Gastrointestinal</h4>
							</div>
							<div class="form-group col-sm-4">
								<div class="checkbox">
									<label for="ROSnausea">
										<input type="checkbox" value="" id="ROSnausea">Nausea
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSvomit">
										<input type="checkbox" value="" id="ROSvomit">Vomiting
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSdiarrhea">
										<input type="checkbox" value="" id="ROSdiarrhea">Diarrhea
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSconstipation">
										<input type="checkbox" value="" id="ROSconstipation">Constipation
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSgiother1">
										<input type="checkbox" value="" id="ROSgiother1" class="ROSother"><span class="othertext">Other</span>
									</label>
								</div>
							</div>
							<div class="col-sm-2">
								<h4 class="text-right">Neurological</h4>
							</div>
							<div class="form-group col-sm-4">
								<div class="checkbox">
									<label for="ROSmigraines">
										<input type="checkbox" value="" id="ROSmigraines">Migraines
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSnumbness">
										<input type="checkbox" value="" id="ROSnumbness">Numbness
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSvertigo">
										<input type="checkbox" value="" id="ROSvertigo">Vertigo
									</label>
								</div>
								<div class="checkbox">
									<label for="ROStremors">
										<input type="checkbox" value="" id="ROStremors">Tremors
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSneuroother1">
										<input type="checkbox" value="" id="ROSneuroother1" class="ROSother"><span class="othertext">Other</span>
									</label>
								</div>
							</div>
						</section>
						
						<section class="clearfix ROSsingles">
							<div class="row">
								<div class="text-center">
									<h4>Check boxes <b>ONLY</b> if any of the following systems are <b>NOT</b> normal</h4>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-2 text-right">
									<label for="ROSeyes"><h4>Eyes</h4></label>
								</div>
								<div class="form-group col-sm-4 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSeyes">
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<label for="ROSent"><h4>Ear/Nose/Throat</h4></label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSent">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-2 text-right">
									<label for="ROSresp"><h4>Respiratory</h4></label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSresp">
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<label for="ROSgu"><h4>Genitourinary</h4></label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSgu">
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-sm-2 text-right">
									<label for="ROSskin"><h4>Skin</h4></label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSskin">
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<label for="ROSendo"><h4>Endocrine</h4></label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSendo">
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-sm-2 text-right">
									<label for="ROShl"><h4>Hem/Lymphatic</h4></label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROShl">
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<label for="ROSai"><h4>Allergic/Immun</h4></label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSai">
									</div>
								</div>
							</div>
						</section>
					</form>
				</div>
			</div>
        </div>
    </section>

    <section id="exam" class="exam-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center">Physical Exam</h1>
					<form id="PEform">
						<section class="clearfix">
							<div class="form-group col-sm-7">
								<div class="col-sm-3 text-right">
									<h4>Vital Signs</h4>
								</div>
								<div class="col-sm-9">
									<label for="PEbp" class="col-sm-8 control-label">Sitting or Standing Blood Pressure</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="PEbp">
									</div>
									<label for="PEpr" class="col-sm-8 control-label">Pulse Rate and Regularity</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="PEpr">
									</div>
									<label for="PEresp" class="col-sm-8 control-label">Respiration</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="PEresp">
									</div>
									<label for="PEtemp" class="col-sm-8 control-label">Temperature</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="PEtemp">
									</div>
									<label for="PEheight" class="col-sm-8 control-label">Height</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="PEheight">
									</div>
									<label for="PEweight" class="col-sm-8 control-label">Weight</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="PEweight">
									</div>
								</div>
							</div>
							<div class="form-group col-sm-5">
								<div class="col-sm-6 text-right">
									<h4>Body Habitus</h4>
									<p class="text-warning"><strong>Check one (and only one) of the following</strong></p>
								</div>
								<div class="col-sm-6">
									<div class="checkbox">
										<label for="PEbhendo">
											<input type="checkbox" value="" id="PEbhendo">Endomorphic
										</label>
									</div>
									<div class="checkbox">
										<label for="PEbhecto">
											<input type="checkbox" value="" id="PEbhecto">Ectomorphic
										</label>
									</div>
									<div class="checkbox">
										<label for="PEbhmeso">
											<input type="checkbox" value="" id="PEbhmeso">Mesomorphic
										</label>
									</div>
								</div>
							</div>
						</section>
						
						<section class="clearfix">
							<div class="col-sm-4">
								<div class="row">
									<div class="col-sm-7 text-right">
										<h4>Speech is normal for:</h4>
										<p>(check all that apply)</p>
									</div>
									<div class="form-group col-sm-5">
										<div class="checkbox">
											<label for="PEvocab">
												<input type="checkbox" value="" id="PEvocab">Vocabulary
											</label>
										</div>
										<div class="checkbox">
											<label for="PEvolume">
												<input type="checkbox" value="" id="PEvolume">Volume
											</label>
										</div>
										<div class="checkbox">
											<label for="PEpace">
												<input type="checkbox" value="" id="PEpace">Pace
											</label>
										</div>
										<div class="checkbox">
											<label for="PEdetails">
												<input type="checkbox" value="" id="PEdetails">Details
											</label>
										</div>
										<div class="checkbox">
											<label for="PErt">
												<input type="checkbox" value="" id="PErt">Reaction Time
											</label>
										</div>
										<div class="checkbox">
											<label for="PEpitch">
												<input type="checkbox" value="" id="PEpitch">Pitch
											</label>
										</div>
										<div class="checkbox">
											<label for="PEart">
												<input type="checkbox" value="" id="PEart">Articulation
											</label>
										</div>
										<div class="checkbox">
											<label for="PEspont">
												<input type="checkbox" value="" id="PEspont">Spontaneity
											</label>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="col-sm-7 text-right">
									<h4>Thought Content:</h4>
									<p>(check all that apply)</p>
								</div>
								<div class="form-group col-sm-5">
									<div class="checkbox">
										<label for="PElgd">
											<input type="checkbox" value="" id="PElgd">Linear and<br>goal-directed
										</label>
									</div>
									<div class="checkbox">
										<label for="PEcirc">
											<input type="checkbox" value="" id="PEcirc">Circumstantial
										</label>
									</div>
									<div class="checkbox">
										<label for="PEtang">
											<input type="checkbox" value="" id="PEtang">Tangential
										</label>
									</div>
									<div class="checkbox">
										<label for="PEinc">
											<input type="checkbox" value="" id="PEinc">Incoherent
										</label>
									</div>
									<div class="checkbox">
										<label for="PEevasive">
											<input type="checkbox" value="" id="PEevasive">Evasive
										</label>
									</div>
									<div class="checkbox">
										<label for="PEracing">
											<input type="checkbox" value="" id="PEracing">Racing
										</label>
									</div>
									<div class="checkbox">
										<label for="PEblocking">
											<input type="checkbox" value="" id="PEblocking">Blocking
										</label>
									</div>
									<div class="checkbox">
										<label for="PEpers">
											<input type="checkbox" value="" id="PEpers">Perseveration
										</label>
									</div>
									<div class="checkbox">
										<label for="PEneo">
											<input type="checkbox" value="" id="PEneo">Neologisms
										</label>
									</div>
								</div>
							</div>
							
							<div class="col-sm-4">
								<div class="row">
									<div class="col-sm-7 text-right">
										<label for="PEassoc" class="h4">Associations intact:</label>
									</div>
									<div class="form-group col-sm-5">
										<input type="checkbox" value="" id="PEassoc">
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-7 text-right">
										<h4>Risk factors/<br>psychotic thoughts:</h4>
										<p>(check all that apply)</p>
									</div>
									<div class="form-group col-sm-5">
										<div class="checkbox">
											<label for="PEsihi">
												<input type="checkbox" value="" id="PEsihi">SI/HI
											</label>
										</div>
										<div class="checkbox">
											<label for="PEhall">
												<input type="checkbox" value="" id="PEhall">Hallucinations
											</label>
										</div>
										<div class="checkbox">
											<label for="PEdel">
												<input type="checkbox" value="" id="PEdel">Delusions
											</label>
										</div>
										<div class="checkbox">
											<label for="PEobs">
												<input type="checkbox" value="" id="PEobs">obsessions
											</label>
										</div>
										<div class="checkbox">
											<label for="PErum">
												<input type="checkbox" value="" id="PErum">Aggressive/Violent<br>Ruminations
											</label>
										</div>
									</div>
								</div>
						</section>
						
						<section class="clearfix col-sm-6 col-sm-offset-3 text-center">
							<div class="row">
								<label for="PEabspeech" class="h4">Describe any abnormal speech patterns below:</label>
								<textarea id="PEabspeech" class="form-control" rows="3"></textarea>
							</div>
						</section>
						
						<section class="clearfix PEsingles col-sm-9 col-sm-offset-1">
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PEji">Judgment and insight intact</label>
								</div>
								<div class="form-group col-sm-1 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEji">
									</div>
								</div>
								<div class="col-sm-5 text-right">
									<label for="PEAOx3">Alert &amp; Oriented x3</label>
								</div>
								<div class="form-group col-sm-1">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEAOx3">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PEmemory">Recent and remote memory intact</label>
								</div>
								<div class="form-group col-sm-1 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEmemory">
									</div>
								</div>
								<div class="col-sm-5 text-right">
									<label for="PEattention">Normal attention span and concentration</label>
								</div>
								<div class="form-group col-sm-1">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEattention">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PElanguage">Language (naming objects, repeating phrases)</label>
								</div>
								<div class="form-group col-sm-1 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="PElanguage">
									</div>
								</div>
								<div class="col-sm-5 text-right">
									<label for="PEknowledge">Fund of knowledge</label>
								</div>
								<div class="form-group col-sm-1">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEknowledge">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PEgait">Gait and station</label>
								</div>
								<div class="form-group col-sm-1 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEgait">
									</div>
								</div>
							</div>
							
							<div class="row">
								<label for="PEmood" class="col-sm-3 control-label text-right h4">Mood is:</label>
								<div class="col-sm-9">
									<input type="text" value="" id="PEmood" class="form-control">
								</div>
							</div>
						</section>
					</form>
				</div>
            </div>
        </div>
    </section>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>
    <script src="js/util.js"></script>

</body>

</html>
