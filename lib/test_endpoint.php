<?php 
	require 'connection.php';

	$sql = "SELECT * FROM likedpet JOIN petcomments JOIN userlikedpet";

	mysqli_query($conn,$sql);

 ?>