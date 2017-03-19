<?php
require_once('includes/config.inc.php');
require_once(BASE_PATH . '/includes/db.inc.php');
require_once(BASE_PATH . '/includes/login.inc.php');
require_once(BASE_PATH . '/includes/util.inc.php');

if (!array_key_exists('email', $_POST) || !array_key_exists('pwd', $_POST)) {
	$_SESSION['error'] = "Invalid email or password";
	header("Location: /test.php");
}

$email = $_POST['email'];
$password = $_POST['pwd'];
$redirect = (isset($_POST['redirect']) && trim($_POST['redirect']) != '') ? $_POST['redirect'] : '';

if(!verify_user($email, $password)) {
  $_SESSION['error'] = "Invalid email or password";
  $_SESSION['email'] = $email;
  $_SESSION['redirect_to'] = $redirect;
  header("Location: /index.php");
  return;
}

if(!isNullOrEmptyStr($redirect))
  header("Location: $redirect");
#elseif(isAdmin())
#  header("Location: admin.php");
else
  header("Location: encounter.php");
?>
