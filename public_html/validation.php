<?php 

function validateItem($itemName) {
	if (strlen($itemName) > 32) //Something is wrong, name shouldn't be this big
		return false;
		
	return true;
}

function validateEmail($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) //Check if valid email
		return false;
	
	return true;
}

function validateAlpha($s) {
	if (preg_match('/^[a-zA-Z\s]+$/i', $s)) //Alphabet + Space only
		return true;
	
	return false;
}

function validateAlphaNumeric($s) {
	if (preg_match('/^[a-z0-9 . ,]+$/i', $s)) //Alphabet + Space only
		return true;
	
	return false;
}

function validatePhone($phone) {
	if (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)
			|| preg_match("/^[0-9]{3}[0-9]{3}[0-9]{4}$/", $phone)
			|| preg_match("/^\([0-9]{3}\)-[0-9]{3}-[0-9]{4}$/", $phone)) //Phone number validation for US numbers
		return true;
	
	return false;
}

?>