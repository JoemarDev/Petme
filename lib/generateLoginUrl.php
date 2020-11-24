<?php 
	require 'lib/google-login-api/config.php';
	$loginUrl = '';
	if (!isset($_SESSION['access_token'])) {
		$loginUrl = $google_client->createAuthUrl();
	}
 ?>
