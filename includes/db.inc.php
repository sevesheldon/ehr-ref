<?php
	if ($app_env == 'dev') {
		$dsn  = 'mysql:host=192.168.1.100;dbname=';
		$user = '';
		$pass = '';
	} else {
		include(BASE_PATH . '/includes/production.db.inc.php');
	}

	try {
		$db = new PDO($dsn, $user, $pass);
	} catch (PDOException $e) {
		print "There was a problem connecting to the database. Our server administrators have been notified. Please try again later.";
		error_log(date(DATE_RSS, time()) . " -- {$e->getMessage()} \n", 3, BASE_PATH . '/error.log');
		die();
	}

	$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
	$db->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
	$db->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>