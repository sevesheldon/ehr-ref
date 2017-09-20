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
									<div>
										<button type="button" class="add-row btn btn-default alert-success">
											<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
										</button>
										<button type="button" class="remove-row btn btn-default alert-danger">
											<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
										</button>
									</div>
								</div>
							</section>
							
							<section class="clearfix col-sm-12 stableproblems">
								<div class="row">
									<label for="MDMstabprob[]" class="control-label col-sm-4 text-right">Established problem, stable or improving #1</label>
									<div class="form-group col-sm-7">
										<input type="text" value="" class="form-control MDMstabprob" name="MDMstabprob[]">
									</div>
									<div>
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
									<div>
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
									<div>
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
						
						<section id="MDMrisk" class="clearfix">
							<h2 class="text-center">Risk to Patient</h2>
							<div class="col-sm-5 col-sm-offset-4">
								<div id="MDMriskmenu">
									<div class="checkbox">
										<label for="MDMriskrx">
											<input type="checkbox" value="mod" id="MDMriskrx">Stopping, starting, or changing Rx (other than LiCo)
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMriskdrugtherapy">
											<input type="checkbox" value="high" id="MDMriskdrugtherapy">Drug therapy requiring intensive monitoring for toxicity
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMrisk1chronic">
											<input type="checkbox" value="low" id="MDMrisk1chronic">Having only 1 well-controlled chronic illness
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMrisk1worsechronic">
											<input type="checkbox" value="mod" id="MDMrisk1worsechronic">Having 1+ worsening chronic illness
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMrisk2controlledchronic">
											<input type="checkbox" value="mod" id="MDMrisk2controlledchronic">Having 2+ well-controlled chronic illnesses
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMrisknewproblem">
											<input type="checkbox" value="mod" id="MDMrisknewproblem">A new problem with uncertain diagnosis
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMriskexacerbationofchronic">
											<input type="checkbox" value="high" id="MDMriskexacerbationofchronic">Severe exacerbation of chronic illness
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMriskselfthreat">
											<input type="checkbox" value="high" id="MDMriskselfthreat">Acute symptoms with potential threat to self or others
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMriskneurochange">
											<input type="checkbox" value="high" id="MDMriskneurochange">An abrupt change in neurologic status
										</label>
									</div>
									<div class="checkbox">
										<label for="MDMrisk1minor">
											<input type="checkbox" value="min" id="MDMrisk1minor">Having only one minor (self-limiting) problem
										</label>
									</div>
								</div>
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
									<input type="text" class="form-control" id="HPIname" name="HPIname">
								</div>
							</div>
						</section>
						
						<section class="clearfix">
							<div class="form-group col-sm-6">
								<label for="HPIduration" class="col-sm-4 control-label">Duration</label>
								<div class="col-sm-8">
									<input type="text" class="form-control HPIElement" id="HPIduration">
								</div>
								<label for="HPIsymptoms" class="col-sm-5 control-label">Associated signs/symptoms</label>
								<div class="col-sm-7">
									<input type="text" class="form-control HPIElement" id="HPIsymptoms">
								</div>
								<label for="HPItiming" class="col-sm-4 control-label">Timing</label>
								<div class="col-sm-8">
									<input type="text" class="form-control HPIElement" id="HPItiming" placeholder="constant or intermittent">
								</div>
								<label for="HPIseverity" class="col-sm-4 control-label">Severity</label>
								<div class="col-sm-8">
									<input type="text" class="form-control HPIElement" id="HPIseverity" placeholder="mild or severe">
								</div>
							</div>
							<div class="form-group col-sm-6">
								<label for="HPIcontext" class="col-sm-4 control-label">Context</label>
								<div class="col-sm-8">
									<input type="text" class="form-control HPIElement" id="HPIcontext" placeholder="setting in which the problem started or occurs">
								</div>
								<label for="HPIfactors" class="col-sm-4 control-label">Modifying Factors</label>
								<div class="col-sm-8">
									<input type="text" class="form-control HPIElement" id="HPIfactors" placeholder="what changes the symptoms?">
								</div>
								<label for="HPIlocation" class="col-sm-4 control-label">Location in the body</label>
								<div class="col-sm-8">
									<input type="text" class="form-control HPIElement" id="HPIlocation">
								</div>
								<label for="HPIquality" class="col-sm-4 control-label">Quality</label>
								<div class="col-sm-8">
									<input type="text" class="form-control HPIElement" id="HPIquality">
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
									<textarea class="form-control" id="PFSHmedical" rows="5" name="PFSHmedical"></textarea>
								</div>
							</div>
						</section>
						
						<section class="clearfix">
							<div class="form-group col-sm-10 col-sm-offset-1">
								<label for="PFSHfamily" class="col-sm-4 control-label">Pertinent family history from intake questionnaire.</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHfamily" rows="3"></textarea>
								</div>
								<label for="PFSHmother" class="col-sm-4 control-label">Mother</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHmother" rows="3"></textarea>
								</div>
								<label for="PFSHfather" class="col-sm-4 control-label">Father</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHfather" rows="3"></textarea>
								</div>
								<label for="PFSHmgmother" class="col-sm-4 control-label">Maternal grandmother</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHmgmother" rows="3"></textarea>
								</div>
								<label for="PFSHmgfather" class="col-sm-4 control-label">Maternal grandfather</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHmgfather" rows="3"></textarea>
								</div>
								<label for="PFSHpgmother" class="col-sm-4 control-label">Paternal grandmother</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHpgmother" rows="3"></textarea>
								</div>
								<label for="PFSHpgfather" class="col-sm-4 control-label">Paternal grandfather</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHpgfather" rows="3"></textarea>
								</div>
								<label for="PFSHsibling1" class="col-sm-4 control-label">Sibling 1</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHsibling1" rows="3"></textarea>
								</div>
								<label for="PFSHsibling2" class="col-sm-4 control-label">Sibling 2</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHsibling2" rows="3"></textarea>
								</div>
								<label for="PFSHsibling3" class="col-sm-4 control-label">Sibling 3</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHsibling3" rows="3"></textarea>
								</div>
								<label for="PFSHsibling4" class="col-sm-4 control-label">Sibling 4</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHsibling4" rows="3"></textarea>
								</div>
								<label for="PFSHother1" class="col-sm-4 control-label">Other family member</label>
								<div class="col-sm-8">
									<textarea type="text" class="form-control PFSHFamilyElement" id="PFSHother1" rows="3"></textarea>
								</div>
							</div>
						</section>
						
						<section class="clearfix">
							<div class="form-group col-sm-10 col-sm-offset-1">
								<div class="row">
									<label for="PFSHsocial" class="col-sm-4 control-label">Pertinent social issues affecting health.</label>
									<div class="col-sm-8">
										<textarea type="text" class="form-control PFSHSocialElement" id="PFSHsocial" name="PFSHsocial" rows="3"></textarea>
									</div>
								</div>
								<h4 class="text-center">Check boxes for "yes"</h4>
								<div class="row">
									<div class="col-sm-6">
										<div class="checkbox">
											<label for="PFSHjob">
												<input type="checkbox" id="PFSHjob" name="PFSHjob" class="PFSHSocialElement">Has a job?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHcar">
												<input type="checkbox" id="PFSHcar" name="PFSHcar" class="PFSHSocialElement">Has a car?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHcsection">
												<input type="checkbox" id="PFSHcsection" name="PFSHcsection" class="PFSHSocialElement">Birth by C-section?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHgallbladder">
												<input type="checkbox" id="PFSHgallbladder" name="PFSHgallbladder" class="PFSHSocialElement">Has a gallbladder?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHgbs">
												<input type="checkbox" id="PFSHgbs" name="PFSHgbs" class="PFSHSocialElement">Gastric bypass surgery?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHtherapy">
												<input type="checkbox" id="PFSHtherapy" name="PFSHtherapy" class="PFSHSocialElement">Speech or physical therapy?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHeartubes">
												<input type="checkbox" id="PFSHeartubes" name="PFSHeartubes" class="PFSHSocialElement">Ear tubes?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHread">
												<input type="checkbox" id="PFSHread" name="PFSHread" class="PFSHSocialElement">Learned to read at normal age?
												<input type="text" class="form-control" name="PFSHreadElaboration" placeholder="Please Elaborate">
											</label>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="checkbox">
											<label for="PFSHmoved">
												<input type="checkbox" id="PFSHmoved" name="PFSHmoved" class="PFSHSocialElement">Moved around a lot?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHfatherpresent">
												<input type="checkbox" id="PFSHfatherpresent" name="PFSHfatherpresent" class="PFSHSocialElement">Was your father present in your life?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHpmsabuse">
												<input type="checkbox" id="PFSHpmsabuse" name="PFSHpmsabuse" class="PFSHSocialElement">Did you suffer physical, mental, or sexual abuse as a child?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHbullied">
												<input type="checkbox" id="PFSHbullied" name="PFSHbullied" class="PFSHSocialElement">Were you bullied?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHhumiliation">
												<input type="checkbox" id="PFSHhumiliation" name="PFSHhumiliation" class="PFSHSocialElement">Did you suffer any public humiliation?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHothersthink">
												<input type="checkbox" id="PFSHothersthink" name="PFSHothersthink" class="PFSHSocialElement">Do people tell you that you don’t think things through?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHyouthink">
												<input type="checkbox" id="PFSHyouthink" name="PFSHyouthink" class="PFSHSocialElement">Do you think you don’t think things through?
											</label>
										</div>
										<div class="checkbox">
											<label for="PFSHinfection">
												<input type="checkbox" id="PFSHinfection" name="PFSHinfection" class="PFSHSocialElement">Viral or bacterial infection as a child that changed your personality in any way?
											</label>
										</div>
									</div>
								</div>
								<div class="row">&nbsp;</div>
								<div class="row">
									<div class="col-sm-8 col-sm-offset-2">
										<label for="PFSHeducation" class="col-sm-5 control-label">Furthest educational level</label>
										<div class="col-sm-7">
											<input type="text" class="form-control PFSHSocialElement" id="PFSHeducation" name="PFSHEducation">
										</div>
										<label for="PFSHhousing" class="col-sm-5 control-label">Housing</label>
										<div class="col-sm-7">
											<input type="text" class="form-control PFSHSocialElement" id="PFSHhousing" name="PFSHhousing">
										</div>
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
									<label for="ROSsihi">
										<input type="checkbox" value="" id="ROSsihi">SI/HI
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
									<label for="ROSdel">
										<input type="checkbox" value="" id="ROSdel">Delusions
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSobs">
										<input type="checkbox" value="" id="ROSobs">Obsessions
									</label>
								</div>
								<div class="checkbox">
									<label for="ROSrum">
										<input type="checkbox" value="" id="ROSrum">Aggressive/Violent Ruminations
									</label>
								</div>
								<div class="checkbox">
									<div>
										<label for="ROSpsychother1">
											<input type="checkbox" value="" id="ROSpsychother1" class="ROSother">Other
										</label>
									</div>
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
										<input type="checkbox" value="" id="ROSconother1" class="ROSother">Other
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
										<input type="checkbox" value="" id="ROScvother1" class="ROSother">Other
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
										<input type="checkbox" value="" id="ROSskelother1" class="ROSother">Other
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
										<input type="checkbox" value="" id="ROSgiother1" class="ROSother">Other
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
										<input type="checkbox" value="" id="ROSneuroother1" class="ROSother">Other
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
									<label for="ROSeyes" class="h4">Eyes</label>
								</div>
								<div class="form-group col-sm-4 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSeyes">
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<label for="ROSent" class="h4">Ear/Nose/Throat</label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSent">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-2 text-right">
									<label for="ROSresp" class="h4">Respiratory</label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSresp">
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<label for="ROSgu" class="h4">Genitourinary</label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSgu">
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-sm-2 text-right">
									<label for="ROSskin" class="h4">Skin</label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSskin">
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<label for="ROSendo" class="h4">Endocrine</label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROSendo">
									</div>
								</div>
							</div>
						
							<div class="row">
								<div class="col-sm-2 text-right">
									<label for="ROShl" class="h4">Hem/Lymphatic</label>
								</div>
								<div class="form-group col-sm-4">
									<div class="checkbox">
										<input type="checkbox" value="" id="ROShl">
									</div>
								</div>
								<div class="col-sm-2 text-right">
									<label for="ROSai" class="h4">Allergic/Immun</label>
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
										<input type="text" class="form-control PEVSElement" id="PEbp" name="PEbp">
									</div>
									<label for="PEpr" class="col-sm-8 control-label">Pulse Rate and Regularity</label>
									<div class="col-sm-4">
										<input type="text" class="form-control PEVSElement" id="PEpr" name="PEpr">
									</div>
									<label for="PEresp" class="col-sm-8 control-label">Respiration</label>
									<div class="col-sm-4">
										<input type="text" class="form-control PEVSElement" id="PEresp" name="PEresp">
									</div>
									<label for="PEtemp" class="col-sm-8 control-label">Temperature</label>
									<div class="col-sm-4">
										<input type="text" class="form-control PEVSElement" id="PEtemp" name="PEtemp">
									</div>
									<label for="PEheight" class="col-sm-8 control-label">Height</label>
									<div class="col-sm-4">
										<input type="text" class="form-control PEVSElement" id="PEheight" name="PEheight">
									</div>
									<label for="PEweight" class="col-sm-8 control-label">Weight</label>
									<div class="col-sm-4">
										<input type="text" class="form-control PEVSElement" id="PEweight" name="PEweight">
									</div>
								</div>
							</div>
							<div class="form-group col-sm-5">
								<div class="col-sm-6 text-right">
									<h4>Body Habitus</h4>
								</div>
								<div class="col-sm-6">
									<div class="radio">
										<label for="PEbhendo">
											<input type="radio" value="Endomorphic" id="PEbhendo" name="bodyhabitus">Endomorphic
										</label>
									</div>
									<div class="radio">
										<label for="PEbhecto">
											<input type="radio" value="Ectomorphic" id="PEbhecto" name="bodyhabitus">Ectomorphic
										</label>
									</div>
									<div class="radio">
										<label for="PEbhmeso">
											<input type="radio" value="Mesomorphic" id="PEbhmeso" name="bodyhabitus">Mesomorphic
										</label>
									</div>
								</div>
							</div>
						</section>
						
						<section class="clearfix PEsingles">
							<div class="col-sm-3 text-right">
								<h4>General Appearance</h4>
							</div>
							
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-4 text-right">
										<label for="PEgagroom">Appropriately groomed and dressed</label>
									</div>
									<div class="form-group col-sm-8">
										<div class="checkbox">
											<input type="checkbox" value="" id="PEgagroom">
											<input type="text" value="" class="form-control" name="PEgagroomElaboration" placeholder="Inappropriately groomed and/or dressed - Please Elaborate">
										</div>
									</div>
								</div>
							
								<div class="row">
									<div class="col-sm-4 text-right">
										<label for="PEganourish">Well-nourished</label>
									</div>
									<div class="form-group col-sm-8">
										<div class="checkbox">
											<input type="checkbox" value="" id="PEganourish">
											<input type="text" value="" class="form-control" name="PEganourishElaboration" placeholder="Pt. has nutritional deficiencies. - Please Elaborate">
										</div>
									</div>
								</div>
							
								<div class="row">
									<div class="col-sm-4 text-right">
										<label for="PEgadevel">Well-developed</label>
									</div>
									<div class="form-group col-sm-8">
										<div class="checkbox">
											<input type="checkbox" value="" id="PEgadevel">
											<input type="text" value="" class="form-control" name="PEgadevelElaboration" placeholder="Has deformities relevant to mental status - Please Elaborate">
										</div>
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
						</section>
						
						<section class="clearfix text-center">
							<div class="row col-sm-6 col-sm-offset-3 ">
								<label for="PEabspeech" class="h4">Describe any abnormal speech patterns below:</label>
								<textarea id="PEabspeech" class="form-control" rows="3"></textarea>
							</div>
						</section>
						
						<section class="clearfix PEsingles">
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PEji" class="h4">Judgement and insight intact</label>
								</div>
								<div class="form-group col-sm-7">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEji">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-5 text-right">
									<h4>Alert &amp; Oriented:</h4>
								</div>
								<div class="col-sm-7">
									<div class="row">
										<div class="col-sm-2">
											<div class="text-right">
												<label for="PEAOname" class="h4">Name</label>
											</div>
										</div>
										<div class="form-group col-sm-10">
											<div class="checkbox">
												<input type="checkbox" value="" id="PEAOname">
												<input type="text" value="" class="form-control" name="PEAOnameElaboration" placeholder="Please Elaborate">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-2">
											<div class="text-right">
												<label for="PEAOplace" class="h4">Place</label>
											</div>
										</div>
										<div class="form-group col-sm-10">
											<div class="checkbox">
												<input type="checkbox" value="" id="PEAOplace">
												<input type="text" value="" class="form-control" name="PEAOplaceElaboration" placeholder="Please Elaborate">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-2">
											<div class="text-right">
												<label for="PEAOdate" class="h4">Date</label>
											</div>
										</div>
										<div class="form-group col-sm-10">
											<div class="checkbox">
												<input type="checkbox" value="" id="PEAOdate">
												<input type="text" value="" class="form-control" name="PEAOdateElaboration" placeholder="Please Elaborate">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PEmemory" class="h4">Recent and remote memory intact</label>
								</div>
								<div class="form-group col-sm-7 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEmemory">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PEattention" class="h4">Normal attention span and concentration</label>
								</div>
								<div class="form-group col-sm-7">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEattention">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PElanguage" class="h4">Normal Language (naming objects, repeating phrases)</label>
								</div>
								<div class="form-group col-sm-7 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="PElanguage">
										<input type="text" value="" class="form-control" name="PElanguageElaboration" placeholder="Please Elaborate">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PEknowledge" class="h4">Normal Fund of knowledge</label>
								</div>
								<div class="form-group col-sm-7">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEknowledge">
										<input type="text" value="" class="form-control" name="PEknowledgeElaboration" placeholder="Please Elaborate">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-5 text-right">
									<label for="PEgait" class="h4">Normal Gait and station</label>
								</div>
								<div class="form-group col-sm-7 clearfix">
									<div class="checkbox">
										<input type="checkbox" value="" id="PEgait">
										<input type="text" value="" class="form-control" name="PEgaitElaboration" placeholder="Please Elaborate">
									</div>
								</div>
							</div>
							
							<div class="row" id="PEMoodrow">
								<label for="PEmood" class="col-sm-3 control-label text-right h4">Mood is:</label>
								<div class="col-sm-9">
									<input type="text" value="" id="PEmood" class="form-control" name="PEmood">
								</div>
							</div>
						</section>
					</form>
				</div>
            </div>
        </div>
    </section>

	<section id="psychotherapy" class="psychotherapy-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center">Psychotherapy</h1>
					<form id="PsychAddonform">
						<div class="col-sm-6 text-center">
							<h4>How many minutes of psychotherapy were performed during the encounter, not including E/M?</h4>
							<div class="col-sm-6 col-sm-offset-3 text-left">
								<div class="radio">
									<label for="psychunder16">
										<input type="radio" name="pyschminutes" id="psychunder16" value=""> &lt;16 minutes (not billable)
									</label>
								</div>
								<div class="radio">
									<label for="psych1637">
										<input type="radio" name="pyschminutes" id="psych1637" value="At least 16 minutes were spent on psychotherapy today, above and beyond the time spent on the E/M service."> 16-37 minutes
									</label>
								</div>
								<div class="radio">
									<label for="psych3852">
										<input type="radio" name="pyschminutes" id="psych3852" value="At least 38 minutes were spent on psychotherapy today, above and beyond the time spent on the E/M service."> 38-52 minutes
									</label>
								</div>
								<div class="radio">
									<label for="psych5360">
										<input type="radio" name="pyschminutes" id="psych5360" value="At least 53 minutes were spent on psychotherapy today, above and beyond the time spent on the E/M service."> 53-60 minutes
									</label>
								</div>
							</div>
						</div>
						<div class="col-sm-6 text-center">
							<h4 class="text-center">What type of psychotherapy was performed?</h4>
							<div class="col-sm-10 col-sm-offset-1 text-left form-group">
								<div class="checkbox">
									<label for="PsychCBT">
										<input type="checkbox" value="" id="PsychCBT">CBT and review of CBT homework
									</label>
								</div>
								<div class="checkbox">
									<label for="Psychinter">
										<input type="checkbox" value="" id="Psychinter">Interpersonal Therapy
									</label>
								</div>
								<div class="checkbox">
									<label for="Psychtraining">
										<input type="checkbox" value="" id="Psychtraining">Training on automatic thoughts
									</label>
								</div>
								<div class="checkbox">
									<label for="PsychSIeval">
										<input type="checkbox" value="" id="PsychSIeval">Evaluation for SI
									</label>
								</div>
								<div class="checkbox">
									<label for="Psychratings">
										<input type="checkbox" value="" id="Psychratings">Symptom ratings scales
									</label>
								</div>
								<div class="checkbox">
									<label for="Psychother1">
										<input type="checkbox" value="" id="Psychother1" class="PTother">Other
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
					
					
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script src="js/util.js"></script>
	<script id="formValidation"></script>

</body>

</html>