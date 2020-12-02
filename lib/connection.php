<?php 
	
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'petme';
	} else {
		$host = 'localhost';
		$user = 'u652559563_petme';
		$pass = 'aA2580!!';
		$db = 'u652559563_petme';
	}
	



	$conn = mysqli_connect($host,$user,$pass,$db);
 ?>
