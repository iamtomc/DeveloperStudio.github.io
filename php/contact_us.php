<?php

header('Content-Type: application/json');

$success = true;
$error = '';

if(!empty($_POST)) {
	if(formParamsPass()) {
		//$_POST['message'] = nl2br($_POST['message']);

		if(mailSent()) $success = true;
		else $success = false;

	} else {
		$success = false;
	}
} else {
	$success = false;
	$error = 'Post field empty';
}

/* Message */
if(!$success) echo json_encode(array('success' => false, 'error' => $error));
else echo json_encode(array('success' => true));

function formParamsPass() {
	$params = array('name', 'email', 'message');

	foreach ($params as $param) {
		$_POST[$param] = urldecode($_POST[$param]);
		if(!isset($_POST[$param]) || empty($_POST[$param])) {
			echo 'could not find'.$param;
			$error = 'Could not find param '.$param;
			return false;
		}
	}

	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error = 'Invalid email: '.$_POST['email'];
		return false;
	}
	
	return true;
}

function mailSent() {
	$to = 'james.staud@gmail.com';

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
	$headers .= "From: contact@dev-stud.io" . "\r\n";
	$headers .= "Reply-To: ".$_POST['email']."\r\n";
	$headers .= "X-MSMail-Priority: High"."\r\n";

	$message = "Message From: ".$_POST['name']."\n".$_POST['message']."\n";
	$subject = 'New Dev-Stud.io Response';

	if(!mail($to, $subject, $message, $headers)) return false;

	return true;
}