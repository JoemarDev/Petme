<?php 
	
	
	session_start();
	require '../connection.php';

	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM useraccount";

	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	while ($row = mysqli_fetch_assoc($result)):
		if ($row['email'] == $email && $password == $row['password']):
			$userID = $row['userID'];
			$getAccess = "SELECT * FROM users WHERE oauth_uid = '$userID'";
			$access_result = mysqli_query($conn,$getAccess) or die(mysqli_error($conn));
			$access_result = mysqli_fetch_assoc($access_result);

			// If the account credentials is save
			$fname = $access_result['first_name'];
			$lname = $access_result['last_name'];
			$email = $access_result['email'];
			$gender = $access_result['gender'];
			$picture = $access_result['picture'];

			GenerateSession($userID,$fname,$lname,$email,$gender,$picture);

			$_SESSION['access_token'] = generateRandomString(50);

			$checkIfAdmin = "SELECT * FROM credentials WHERE Userid = '$userID' AND email = '$email'";

			$admin = mysqli_query($conn,$checkIfAdmin) or die(mysqli_error($conn));
			if (mysqli_num_rows($admin) > 0) {
				$_SESSION['petme_administrator'] = md5($dataID.$email);
			};
			header('location: ../../index.php');
			break;
			

		else:

			header('location: ../../login.php?error=noaccount');
		endif;

	endwhile;

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