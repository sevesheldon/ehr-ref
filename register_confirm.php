<?php
require_once('includes/config.inc.php');
require_once(BASE_PATH . '/includes/db.inc.php');
require_once(BASE_PATH . '/includes/login.inc.php');
require_once(BASE_PATH . '/includes/util.inc.php');

$userId = filter_input(INPUT_GET, 'userid', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);

if (
	isset($_GET['registerkey']) 
	&& !isNullOrEmptyStr($_GET['registerkey'])
	&& isset($_GET['userid'])
	&& !isNullOrEmptyStr($_GET['userid'])
	&& $userId !== null
) {
	try {
		$db->beginTransaction();
		$query = $db->prepare("UPDATE users SET confirmed=1, confirm_date=NOW() WHERE user_id=? AND registerkey=?");
		if (!$query->execute(array($userId, $_GET['registerkey'])))
			throw new Exception("Confirm new user failed");
		
		$db->commit();
		
		# possibly login user automatically here
		header("Location: index.php");
	} catch (Exception $e) {
		$db->rollBack();
		throw $e;
	}
} else {
	#header("Location: index.php");
	echo true;
}
?>