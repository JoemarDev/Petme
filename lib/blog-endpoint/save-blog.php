<?php 
	
	session_start();
	// Check if the client data is have website token
	if (isset($_SESSION['access_token'])):
	
		require '../../vendor/autoload.php';
		require "cloud-config.php";
		require '../connection.php';


		$blog_title = $_POST['blog-title'];
		$blog_image_title = $_FILES['blog-image']['name'];
		$blog_content = mysqli_real_escape_string($conn,$_POST['blog-content']);
		$blog_writer = $_SESSION['user_first_name'];
		$blog_created = date("Y-m-d H:i:s");
		$blog_link_1 = $_POST['blog-link-1'];
		$blog_link_2 = $_POST['blog-link-2'];

		$linkArr = serialize([$blog_link_1,$blog_link_2]);


		// default main image address
		$blog_image_url = null;


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

		

		echo $blog_image_url;

		$sql = "INSERT INTO blog(title,content,writer,date,likeCount,commentCount,image,link,isAllowed)
			VALUES('$blog_title','$blog_content','$blog_writer','$blog_created',0,0,'$blog_image_url','$linkArr',0)";

		mysqli_query($conn,$sql) or die(mysqli_erro($conn));	
		

	else:
		header("HTTP/1.1 401 Unauthorized");
		exit;
	endif;

	

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