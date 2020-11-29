<?php 
	session_start();

	// CHECK IF THE REQUEST IS FROM LOGIN CLIENT
	if (isset($_SESSION['access_token'])):
		//  DELETE IMAGE FROM CLOUDINARY VIA API
		require '../../vendor/autoload.php';
		require "cloud-config.php";


		// Get the array of the deleted image in the text editor
		if (isset($_POST['editorImage'])) {
			$removeImage = $_POST['editorImage'];

			
			foreach ($removeImage as $data) {
				// Remove the directory of the image leave only the Foldername of it
				$whatIWant = substr($data, strpos($data, "/Petme") + 1);

				// Find position of last dot which should be the extension in the image url
				$pos = strrpos( $whatIWant , '.');

				// Remove the extension together with the dot 
				$trim_public_id = substr($whatIWant, 0, $pos );

				// Remove the Image using Cloudinary Destory API
				\Cloudinary\Uploader::destroy($trim_public_id);
			}
			
		}


		// default main image address
		$blog_image_url = $_POST['oldMainImage'];

		// Check if have a main image uploaded
		if ($_FILES['blog-image']['size'] > 0):
			
			$file_type = $_FILES['blog-image']['type']; //returns the mimetype
			$allowed = array("image/jpeg", "image/gif", "image/png");

			// Check the file if the client upload malicious file
			if(!in_array($file_type, $allowed)) {
			  
			  $error_message = 'Only jpg, gif, and png files are allowed.';
			  exit();

			} else {

				$blog_image_tmp = $_FILES['blog-image']['tmp_name'];
				$blog_image_name =  generateRandomString(70);

				$response = \Cloudinary\Uploader::upload($blog_image_tmp, array(
					"folder" => 'Petme/',
					"public_id" => $blog_image_name));
				$blog_image_url = $response['url'];
			}

		endif;


		require '../connection.php';

		$newContent = mysqli_real_escape_string($conn,$_POST['blog-content']);

		$postID = $_POST['postID'];

		$blog_title = $_POST['blog-title'];
		$blog_image_title = $_FILES['blog-image']['name'];
		$blog_description = mysqli_real_escape_string($conn,$_POST['blog-description']);
		$blog_content = mysqli_real_escape_string($conn,$_POST['blog-content']);
		$blog_link_1 = $_POST['blog-link-1'];
		$blog_link_2 = $_POST['blog-link-2'];
		$blog_seo_title = seoUrl($_POST['blog-title']);

		$linkArr = serialize([$blog_link_1,$blog_link_2]);

		$sql = "UPDATE blog 
			SET title = '$blog_title',
			content = '$newContent',
			description = '$blog_description',
			seoTitle = '$blog_seo_title',
			image = '$blog_image_url'
			WHERE id = '$postID'";

		mysqli_query($conn,$sql) or die(mysqli_error($conn));

		
		header('location: ../../read.php?article='.$blog_seo_title);

	else:
		header("HTTP/1.1 401 Unauthorized");
		sexit;
	endif;


	function seoUrl($string) {
	    //Lower case everything
	    $string = strtolower($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
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