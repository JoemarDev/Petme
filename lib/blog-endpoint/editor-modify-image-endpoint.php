<?php 
	session_start();

	// CHECK IF THE REQUEST IS FROM LOGIN CLIENT
	if (isset($_SESSION['access_token'])):
		//  DELETE IMAGE FROM CLOUDINARY VIA API

		if (isset($_POST['postID'])):

			if ($_POST['postID'] != null) {
				require '../../vendor/autoload.php';
				require "cloud-config.php";

				// Get the image URL
				$data = $_POST['link'];

				// Remove the directory of the image leave only the Foldername of it
				$whatIWant = substr($data, strpos($data, "/Petme") + 1);

				// Find position of last dot which should be the extension in the image url
				$pos = strrpos( $whatIWant , '.');

				// Remove the extension together with the dot 
				$trim_public_id = substr($whatIWant, 0, $pos );

				// Remove the Image using Cloudinary Destory API
				\Cloudinary\Uploader::destroy($trim_public_id);

				require '../connection.php';

				$newContent = mysqli_real_escape_string($conn,$_POST['content']);

				$postID = $_POST['postID'];

				$sql = "UPDATE blog SET content = '$newContent' WHERE id = '$postID'";
				mysqli_query($conn,$sql) or die(mysqli_error($conn));
			}

		endif;
		


	endif;




 ?>