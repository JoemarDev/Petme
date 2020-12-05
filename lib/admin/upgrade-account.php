<?php 
	session_start();

	if (empty($_SESSION['access_token'])):
		header("HTTP/1.1 401 Unauthorized");
		exit;
	else:

		if (empty($_SESSION['petme_administrator'])):
			header("HTTP/1.1 401 Unauthorized");
			exit;
		else:
			if ($_SESSION['petme_administrator'] != md5($_SESSION['OAuthID'].$_SESSION['user_email_address'])) {
				header("HTTP/1.1 401 Unauthorized");
				exit;
			}
		endif;

	endif;
 ?>
 
<?php 
	
	$user_id = $_POST['userid'];

	require '../connection.php';
	$sql = "SELECT * FROM users WHERE oauth_uid = '$user_id'";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$count = mysqli_num_rows($result);
	$upgradeCreated =  date("Y-m-d H:i:s");;
	$row = mysqli_fetch_assoc($result);
	$email = $row['email'];
	if ($count > 0) {
		$makeAdmin = "INSERT INTO credentials(Userid,email,created) VALUES('$user_id','$email','$upgradeCreated')";
		mysqli_query($conn,$makeAdmin) or die(mysqli_error($conn));
	}
 ?>