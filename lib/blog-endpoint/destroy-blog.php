<?php 
	
	session_start();
	// Check if the request is from a login user
	if (isset($_SESSION['access_token'])):
		// Check if The request have a Blog id parameter
		if (isset($_GET['articleID'])) {

			require '../connection.php';
			$userID = $_SESSION['OAuthID'];
			$articleID = $_GET['articleID'];
			// Check If the USER id of blog is from the user who sent the request
			$sql = "SELECT * from blog WHERE writer_id = '$userID' AND id = '$articleID'";
			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			

			// If have match delete comments blog and remove the image from cloudinary
			if (mysqli_num_rows($result) > 0) {
				$deleteComments = "DELETE FROM blogcomments WHERE blogID = '$articleID'";
				mysqli_query($conn,$deleteComments) or die(mysqli_error($conn));

				$deleteArticle = "DELETE FROM blog WHERE id = '$articleID'";
				mysqli_query($conn,$deleteArticle) or die(mysqli_error($conn));

				if (mysqli_fetch_assoc($result)['image'] != null) {
					//  DELETE IMAGE FROM CLOUDINARY VIA API
					require '../../vendor/autoload.php';
					require "cloud-config.php";

					// Get the image column value in blog table
					$data = mysqli_fetch_assoc($result)['image'];

					// Remove the directory of the image leave only the Foldername of it
					$whatIWant = substr($data, strpos($data, "/Petme") + 1);

					// Find position of last dot which should be the extension in the image url
					$pos = strrpos( $whatIWant , '.');

					// Remove the extension together with the dot 
					$trim_public_id = substr($whatIWant, 0, $pos );

					// Remove the Image using Cloudinary Destory API
					\Cloudinary\Uploader::destroy($trim_public_id);
				}
				



				header('location : ../../blog.php');
			} else {
				// Sent Unauthorized request if not match
				header("HTTP/1.1 401 Unauthorized");
				exit;	
			}

		};
	else:
		// Sent Unauthorized request if not login
		header("HTTP/1.1 401 Unauthorized");
		exit;	
	endif;
 ?>