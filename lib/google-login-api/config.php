<?php 
	
	$directory = [
		'localhost' => 'http://'.$_SERVER['HTTP_HOST'].'/petme/',
		'petme.cf' => 'https://'.$_SERVER['HTTP_HOST'].'/',
		'192.168.254.122' => 'http://localhost/petme/',
	];


	require_once 'vendor/autoload.php';

	$google_client = new Google_Client();
	
	$google_client->setClientId("967495130677-ug1f90ijep45jjck0r8qip54v6p8volc.apps.googleusercontent.com");

	$google_client->setClientSecret("Y6oExkcn4S-016-_B0v6u2mW");

	$google_client->setRedirectUri($directory[$_SERVER['HTTP_HOST']] .'lib/google-login-api/setGoogleLogin.php');

	$google_client->addScope('email');

	$google_client->addScope('profile');

 ?>