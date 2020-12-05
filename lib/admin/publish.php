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
	
	$id = $_POST['id'];
	require '../connection.php';
	$sql = "UPDATE blog SET isAllowed = 1998 WHERE id = '$id'";
	mysqli_query($conn,$sql) or die(mysqli_error($conn));
 ?>