<?php 
	
	session_start();
	if (isset($_SESSION['access_token'])) :
		
		require '../../vendor/autoload.php';
		require "cloud-config.php";

		if ($_FILES['file']['name']) {
		  if (!$_FILES['file']['error']) {

		    $blog_image_tmp = $_FILES["file"]["tmp_name"];
		    $blog_image_name =  generateRandomString(70);

		    $response = \Cloudinary\Uploader::upload($blog_image_tmp, array(
		    	"folder" => 'Petme/Summernote/',
		    	"public_id" => $blog_image_name));
		    $blog_image_url = $response['url'];

		    $image = ['link' => $blog_image_url];
		    echo json_encode($image); 
		  } else {
		    echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
		  }
		}


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