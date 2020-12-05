<?php 
	
	$emailToRegister = $_POST['email'];

	require '../connection.php';
	$checkEmail = "SELECT * FROM users WHERE email = '$emailToRegister'";
	$result = mysqli_query($conn,$checkEmail) or die(mysqli_error($conn));


	echo mysqli_num_rows($result);
 ?>