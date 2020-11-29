<?php 
	
	require_once 'http://' . $_SERVER['HTTP_HOST'] . '/vendor/autoload.php';

	$google_client = new Google_Client();

	$google_client->setClientId("967495130677-ug1f90ijep45jjck0r8qip54v6p8volc.apps.googleusercontent.com");

	$google_client->setClientSecret("Y6oExkcn4S-016-_B0v6u2mW");

	$google_client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/lib/google-login-api/setGoogleLogin.php');

	$google_client->addScope('email');

	$google_client->addScope('profile');


	session_start();

	if (isset($_GET['code'])) {
		$token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

		if (!isset($token['error'])) {
			$google_client->setAccessToken($token['access_token']);

			$_SESSION['access_token'] = $token['access_token'];

			$google_service = new Google_Service_Oauth2($google_client);

			// Account Information Fetch from Gmail OAuth API
			$data = $google_service->userinfo->get();

			require '../connection.php';

			// Check the the account using OUath ID in database if exist

			$dataID = $data['id'];

			$sql = "SELECT * FROM users WHERE oauth_uid = '$dataID'";

			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			$result = mysqli_fetch_assoc($result);



			if (!empty($result)) {
				// If the account credentials is save
				$fname = $result['first_name'];
				$lname = $result['last_name'];
				$email = $result['email'];
				$gender = $result['gender'];
				$picture = $result['picture'];

				GenerateSession($dataID,$fname,$lname,$email,$gender,$picture);

			} else {
				// If the account credentials is not save
				$fistname = $data['given_name'];
				$lastname = $data['family_name'];
				$email = $data['email'];
				$gender = $data['gender'];
				$locale = $data['locale'];
				$picture = $data['picture'];
				$created = date("YYYY-MM-DD HH:MI:SS");
				$modified = date("YYYY-MM-DD HH:MI:SS");

				$user = "INSERT INTO 
					users (
						oauth_provider,
						oauth_uid,
						first_name,
						last_name,
						email,
						gender,
						locale,
						picture,
						created,
						modified )
					VALUES (
						'google',
						'$dataID',
						'$fistname',
						'$lastname',
						'$email',
						'$gender',
						'$locale',
						'$picture',
						'$created',
						'$modified'
						)	
					";
				mysqli_query($conn,$user) or die(mysqli_error($conn));	

				GenerateSession($dataID,$fistname,$lastname,$email,$gender,$picture);
			}

			header('location: ../../index.php');
		}
	}


	function GenerateSession($id,$fname,$lname,$email,$gender,$picture) {
		$_SESSION['OAuthID'] = $id;
		$_SESSION['user_first_name'] = $fname;
		$_SESSION['user_last_name'] = $lname;
		$_SESSION['user_email_address'] = $email;
		$_SESSION['user_gender'] = $gender;
		$_SESSION['user_picture'] = $picture;
	}
 ?>