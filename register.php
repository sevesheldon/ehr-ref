<?php
require_once('includes/config.inc.php');
require_once(BASE_PATH . '/includes/db.inc.php');
require_once(BASE_PATH . '/includes/login.inc.php');
require_once(BASE_PATH . '/includes/util.inc.php');

if (isset($_POST["signup"])) {
	$userEmail = isset($_POST["email"]) ? trim($_POST["email"]) : "";
	$userPass1 = isset($_POST["pwd"]) ? $_POST["pwd"] : "";
	$userPass2 = isset($_POST["confirm_pwd"]) ? $_POST["confirm_pwd"] : "";
	$cellnumber = (isset($_POST["cell1"]) && isset($_POST["cell2"]) && isset($_POST["cell3"]))? $_POST["cell1"].$_POST["cell2"].$_POST["cell3"] : "";
	$fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
	$lname = isset($_POST["lname"]) ? $_POST["lname"] : "";
	$notes = isset($_POST["notes"]) ? $_POST["notes"] : "";
	$error_display = '';

	//Validate inputs
	$validationErrors = array();
	if ($userEmail == "")
		$validationErrors[] = "You must specify an email address.";
	if (!validateEmail($userEmail))
		$validationErrors[] = "Invalid email address.";
	if ($userPass1 == "")
		$validationErrors[] = "You must specify a password";
	elseif ($userPass1 != $userPass2)
		$validationErrors[] = "Passwords do not match.";
	if (strlen($userPass1) < MIN_PASSWORD_LEN)
		$validationErrors[] = "Password must be at least " . MIN_PASSWORD_LEN . " characters long.";
	if (!preg_match('/[\=!\-@._*$#%^&()+]/', $userPass1))
		$validationErrors[] = "Password must contain at least 1 special character: =!-@._*$#%^&()+";
	if (!preg_match('/\d/', $userPass1))
		$validationErrors[] = "Password must contain at least 1 number";
		
	if (empty($validationErrors)) {
		if (checkUserEmail($userEmail))
			$validationErrors[] = "Email address <b>" . htmlspecialchars($userEmail) . "</b> is already registered: please use a different email address.";
	}
	
	if (count($validationErrors) > 0) {
		$errorText = "<strong>Could not register account:</strong>";
			foreach ($validationErrors as $valError)
				$errorText .= "<br>$valError";

		$error_display = "<div class=\"alert alert-danger\" role=\"alert\" style=\"margin: 20px auto; width: 530px;\">
					<span class=\"sr-only\"><strong>Error:</strong></span>
					$errorText
		</div>";
	} else {
		//Register new account
		try {
			$db->beginTransaction();
			$query = $db->prepare("INSERT INTO users (user_id, email, first_name, last_name, cell_number, password, notes, registerkey, signup_date) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NOW())");
				
			$registerKey = generateId();
				
			if (!$query->execute(array($userEmail, $fname, $lname, $cellnumber, generateHash($userPass1), $notes, $registerKey)))
				throw new Exception("New user creation failed");
				
			$userID = $db->lastInsertId();
					
			$db->commit();
		} catch (Exception $e) {
			$db->rollBack();
			throw $e;
		}

		require_once(BASE_PATH . '/mail.php');
					
		$mail->addAddress($userEmail);
		$mail->Subject = 'Thank you for registering. Please confirm your account';
		ob_start();
		get_mail_body('signup');
		$mail->Body = ob_get_clean();
		$mail->AltBody = strip_tags($mail->Body);

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			die();
		} else {
			//Go to the confirmation page
			$_SESSION['register_success'] = true;
			header("Location: dashboard.php");
		}	
	}
} elseif (isset($_POST["forgot"])) {
	if (isNullOrEmptyStr($_POST['email']))
		header("Location: forgotpassword.php");
	
	$tmpPwd = generateId();
	$query = $db->prepare("SELECT user_id, first_name FROM users WHERE email=?");
	if (!$query->execute(array($_POST['email'])))
		# Don't throw exception, just log error here
		$logerror = true;
		
	$results = $query->fetch();
	$userID = $results->user_id;
	$fname = ($results->first_name !== NULL) ? $results->first_name : 'user';
		
	try {
		$db->beginTransaction();
		$query = $db->prepare("UPDATE users SET tmp_password=?, tmp_password_active=1 WHERE email=?");
		if (!$query->execute(array(generateHash($tmpPwd), $_POST['email'])))
			throw new Exception("Set tmp_password in database failed");
		
		require_once(BASE_PATH . '/mail.php');
					
		$mail->addAddress($_POST['email']);
		$mail->Subject = 'Temporary password for your account';
		ob_start();
		get_mail_body('tmppwd');
		$mail->Body = ob_get_clean();
		$mail->AltBody = strip_tags($mail->Body);

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			die();
		} else {
			header("Location: index.php");
		}
		$db->commit();
	} catch (Exception $e) {
		$db->rollBack();
		throw $e;
	}
} elseif (isset($_POST["resetpassword"])) {
	$userPass1 = isset($_POST["pwd"]) ? $_POST["pwd"] : "";
	$userPass2 = isset($_POST["confirm_pwd"]) ? $_POST["confirm_pwd"] : "";
	$validationErrors = array();
	if ($userPass1 == "")
		$validationErrors[] = "You must specify a password";
	elseif ($userPass1 != $userPass2)
		$validationErrors[] = "Passwords do not match.";
	if (strlen($userPass1) < MIN_PASSWORD_LEN)
		$validationErrors[] = "Password must be at least " . MIN_PASSWORD_LEN . " characters long.";

	if (count($validationErrors) > 0) {
		$errorText = "<strong>Could not register account:</strong>";
			foreach ($validationErrors as $valError)
				$errorText .= "<br>$valError";

		$error_display = "<div class=\"alert alert-danger\" role=\"alert\" style=\"margin: 20px auto; width: 530px;\">
					<span class=\"sr-only\"><strong>Error:</strong></span>
					$errorText
		</div>";
		$_SESSION['error'] = $errorText;
		header("Location: resetpassword.php");
		exit;
	} else {
		try {
			$db->beginTransaction();
			$query = $db->prepare("UPDATE users SET password=?, tmp_password=NULL, tmp_password_active=0 WHERE email=?");
			if (!$query->execute(array(generateHash($userPass1), $_SESSION['email'])))
				throw new Exception("Update user password failed");
			
			$db->commit();
			
			validateUser($_SESSION['userid'], $_SESSION['email']);
			header("Location: dashboard.php");
		} catch (Exception $e) {
			$db->rollBack();
			throw $e;
		}
	}
}
?>