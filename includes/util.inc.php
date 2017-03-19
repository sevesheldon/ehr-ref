<?
//This file holds utility functions for things like validation and utility functions

function GenerateConfirmationEmail($linkInfo, $userURL) {
	$commonPart = "";

	return $commonPart;
}

//standard function for validating email addresses
function validateEmail($fieldvalue) {
	$pattern = "/"                      // start pattern
    	. "^[a-z0-9_-]+"           // valid chars (at least once)
        . "(\.[a-z0-9_-]+)*"       // dot valid chars (0-n times)
        . "@"                      // at
        . "[a-z0-9][a-z0-9-]*"     // valid chars (at least once)
        . "(\.[a-z0-9-]+)*"        // dot valid chars (0-n times)
        . "\.([a-z]{2,6})$"        // dot valid chars
        . "/i";                    // end pattern, case insensitive

	return preg_match($pattern, $fieldvalue);
}

function get_client_ip() {
	$ipaddress = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'])
		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'])
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	elseif(isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED'])
		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	elseif(isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR'])
		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	elseif(isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED'])
		$ipaddress = $_SERVER['HTTP_FORWARDED'];
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'])
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	else
		$ipaddress = 0;
	return $ipaddress;
}

function isNullOrEmptyStr($variable) {
	return (is_null($variable) or trim($variable) === '');
}

function get_surrounding_text($keyword, $content, $padding)	{
	$position = strpos($content, $keyword);
	$snippet = substr($content, $position - $padding, (strlen($keyword) + $padding * 2));
	return '...' . $snippet . '...';
}
?>