<?php
require_once('includes/config.inc.php');
require_once(BASE_PATH . '/includes/login.inc.php');
require_once(BASE_PATH . '/includes/util.inc.php');
$userid = filter_input(INPUT_GET, 'userid', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
try {
	$db->beginTransaction();
	$query = $db->prepare("UPDATE users SET tmp_password=NULL, tmp_password_active=0 WHERE user_id=?");
	if (!$query->execute(array($_GET['userid'])))
		# don't throw exception, just log error here
		$logerror = true;
	
	$db->commit();
} catch (Exception $e) {
	$db->rollBack();
	throw $e;
}
header("Location: index.php");
?>