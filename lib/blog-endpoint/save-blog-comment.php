<?php 
	
	session_start();
	// check if the comment is from the login user
	if (isset($_SESSION['access_token'])):
		// Check if the data is comment
		if (isset($_POST['comment'])):
			$commentID = $_POST['commentID'];
			$comment = $_POST['comment'];
			$userID = $_SESSION['OAuthID'];
			$created = date("Y-m-d H:i:s");


			require '../connection.php';
			  $sql = "INSERT INTO blogcomments
			  	(
			  		userID,
			  		comment,
			  		created,
			  		blogID
			  	)
			  	VALUES(
			  		'$userID',
			  		'$comment',
			  		'$created',
			  		'$commentID'
			  	)";

			  mysqli_query($conn,$sql) or die(mysqli_error($conn));
			

		endif;
	endif;

 ?>