<?php 
	
	require '../connection.php';
	session_start();
	$fistname = $_POST['first_name'];
	$lastname = $_POST['last_name'];
	$password = md5($_POST['password']);
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$dataID =  generateRandomString(10);
	$created = date("Y-m-d H:i:s");
	$modified = date("Y-m-d H:i:s");

	$picture = 'https://petme.cf/assets/images/background/blog-place-holder.jpg';
	$_SESSION['access_token'] = generateRandomString(50);

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
			'petme',
			'$dataID',
			'$fistname',
			'$lastname',
			'$email',
			'$gender',
			'en',
			'https://petme.cf/assets/images/background/blog-place-holder.jpg',
			'$created',
			'$modified'
			)	
		";
	mysqli_query($conn,$user) or die(mysqli_error($conn));	


	$reg = "INSERT INTO 
		useraccount (
			userID,
			email,
			password)
		VALUES (
			'$dataID',
			'$email',
			'$password'
			)	
		";

	mysqli_query($conn,$reg) or die(mysqli_error($conn));	

	header('location: ../../index.php');

	GenerateSession($dataID,$fistname,$lastname,$email,$gender,$picture);

	function GenerateSession($id,$fname,$lname,$email,$gender,$picture) {
		$_SESSION['OAuthID'] = $id;
		$_SESSION['user_first_name'] = $fname;
		$_SESSION['user_last_name'] = $lname;
		$_SESSION['user_email_address'] = $email;
		$_SESSION['user_gender'] = $gender;
		$_SESSION['user_picture'] = $picture;

	}

	// function for genrate random string
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	};


 ?>