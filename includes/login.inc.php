<?php
//require_once('db.inc.php');
function validateUser($userid, $email) {
	$_SESSION['valid'] = 1;
	$_SESSION['email'] = $email;
	$_SESSION['userid'] = $userid;
	$_SESSION['activeToken'] = userActiveToken();
}

function isLoggedIn($return = false) {
	return $return;
/*
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
		logout("login.php");
		exit;
	}
*/

	if (
		array_key_exists('valid', $_SESSION)
		&& array_key_exists('activeToken', $_SESSION)
		&& $_SESSION['valid']
		&& $_SESSION['activeToken'] == userActiveToken()
####		&& checkUserActivity()
	) {
###		updateUserActivity($_SESSION['userid']);
		return true;
	}
	
	return false;
}

function logout($redirect = false, $after_login = false) {
/*
	global $db;

	$db->beginTransaction();
	$query = $db->prepare("DELETE FROM user_sessions where user_id = ? AND active_key = ?");
	$query->execute(array($_SESSION['userid'], userActiveToken()));
	$db->commit();
*/	
	$_SESSION = array();
	session_destroy();
	
	if ($after_login) {
		session_start();
		$_SESSION['redirect_to'] = $after_login;
	}
	
	if ($redirect) {
		header("Location: " . $redirect);
	}
}

function userActiveToken() {
	$ip = get_client_ip();
	$agent = $_SERVER['HTTP_USER_AGENT'];
	$sid = session_id();
	
	return hash('sha256', $ip . $agent . $sid);
}

/*
function updateUserActivity($userId) {
	global $db;
	$_SESSION['last_activity'] = time();
	
	$db->beginTransaction();
	$query = $db->prepare("INSERT INTO user_sessions VALUES (?, ?, NULL) ON DUPLICATE KEY UPDATE active_key = ?, timestamp = CURRENT_TIMESTAMP()");
	$query->execute(array($userId, userActiveToken(), userActiveToken()));
	$db->commit();
}


function checkUserActivity() {
	global $db;
	$query = $db->prepare("SELECT active_key, timestamp FROM user_sessions WHERE user_id = ?");
	$query->execute(array($_SESSION['userid']));
	$results = $query->fetch();
	
	return (($_SESSION['activeToken'] == $results->active_key) && (time() - strtotime($results->timestamp) < SESSION_TIMEOUT));
}
*/

function generateHash($plainText) {
	$strong = False;
	while ($strong === False) {
			$salt = bin2hex(openssl_random_pseudo_bytes(16, $strong));
	}
	$salt = '$2y$11$' . substr($salt, 0, 22);

	return crypt($plainText, $salt);
}

function generateId() {
	$strong = False;
	while ($strong === False) {
		$id = bin2hex(openssl_random_pseudo_bytes(16, $strong));
	}
	return substr($id, 0, 16);
}

function verify_user($email, $password) {
	global $db;
	$query = $db->prepare("SELECT user_id, password, tmp_password, tmp_password_active FROM users WHERE email=?");
	$query->execute(array($email));
	$result = $query->fetch();

	if(!$result) { 
		//no such user exists
		return false;
	}

	if (
		(crypt($password, $result->password) == $result->password) 
		|| ((crypt($password, $result->tmp_password) == $result->tmp_password) && ($result->tmp_password_active == 1))
	) {
		if ($result->tmp_password_active == 1) {
			validateUser($result->user_id, $email);
			unset($_SESSION['activeToken']);
			header("Location: resetpassword.php");
			exit;
		}
		
		session_regenerate_id();
####		updateUserActivity($result->id);
		validateUser($result->user_id, $email);
		return true;		
	} else {
		//incorrect password
		return false;
	}
}

function checkUserEmail($email) {
	global $db;
	$query = $db->prepare("SELECT user_id FROM users WHERE email = ?");
	$query->execute(array($email));
	$results = $query->fetch(PDO::FETCH_ASSOC);
	if (empty($results)) {
		return false;
	} else {
		return true;
	}	
}

function fetchMember($email) {
	// this is called after the login credentials are verified, so no need to check user pw here
	global $db;
	
  	$query = $db->prepare("SELECT user_id, email FROM users WHERE email=?");
	$query->execute(array($email));
	$result = $query->fetch();
	
	return $result;
}

/*
function isAdmin() {
	global $db;

	$query = $db->prepare("SELECT is_admin FROM users where user_id = ?");
	$query->execute(array($_SESSION['userid']));
	
	$results = $query->fetch();
	return $results->is_admin;
}
*/