<?php
session_start();
//date_default_timezone_set('America/Phoenix');

if (isset($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] == 'dev') {
	$app_env = 'dev';
	define("BASE_PATH", $_SERVER['DOCUMENT_ROOT'] . "/");
	ini_set('display_errors', 1);
} else {
	$app_env = 'prod';
	ini_set('display_errors', 0);
	error_reporting(E_ALL);
	function myErrorHandler($errno, $errstr, $errfile, $errline) {
		error_log(
			date(DATE_RSS, time()) . "\n\t{$errstr} \nOccurred in {$errfile}:{$errline}\n" . "\n", 3, BASE_PATH . '/error.log'
		);
	}
	define("BASE_PATH", $_SERVER['DOCUMENT_ROOT'] . "/dev/wf/");
	set_error_handler("myErrorHandler");
	set_exception_handler("myErrorHandler");
}


class error {
	public $code;
	public $message;
	public $friendly_message;
	public function __construct() {
		$this->code = bin2hex(openssl_random_pseudo_bytes(4));
	}
	public function log() {
		$e = new Exception;
		$e_str = "Error Code: {$this->code}\n\tError Message: {$this->message}\n\tStack Trace:\n";
		$e_str .= $e->getTraceAsString();
		trigger_error($e_str);
	}
}
require_once('app_vars.inc.php');
?>
