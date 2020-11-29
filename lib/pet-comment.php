<?php 

	require 'connection.php';
	session_start();

	$comment = mysqli_real_escape_string($conn,$_POST['comment']);
	$petID = $_POST['petID'];
	$created = date("Y-m-d H:i:s");
	$userID = $_SESSION['OAuthID'];

	$sql = "INSERT INTO petcomments
		(
			userid,
			comment,
			created,
			petid
		)
		VALUES(
			'$userID',
			'$comment',
			'$created',
			'$petID'
		)";

	mysqli_query($conn,$sql) or die(mysqli_query($conn));

 ?>