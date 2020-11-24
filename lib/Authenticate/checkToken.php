<?php 
	
	require 'createToken.php';
	if (empty($_COOKIE['API_TOKEN'])):
		createToken();
	endif;
 ?>