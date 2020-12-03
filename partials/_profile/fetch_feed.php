 			<?php 
	 			function date_sort($a, $b) {
	 				$date1 = $a['date'];
	 				$date2 = $b['date'];
	 			    return strtotime($date1) < strtotime($date2);
	 			}
 				$timeLinehistory = [];
 				require 'lib/connection.php';
 				$userID = $user_information['oauth_uid'];
 				$getLiked = "SELECT * FROM userlikedpet WHERE userID = '$userID'";
 				$likedRes = mysqli_query($conn,$getLiked) or die(mysqli_error($conn));

 				while ($row = mysqli_fetch_assoc($likedRes)) :
 					$object = [
 						'date' => $row['created'],
 						'petID' => $row['petID'],
 						'type' => 'liked',
 					];

 					array_push($timeLinehistory,$object);
 				endwhile;

 				$getBlogComments = "SELECT * FROM blogcomments WHERE userID = '$userID'";
 				$blogCommentRes = mysqli_query($conn,$getBlogComments) or die(mysqli_error($conn));

 				while ($row = mysqli_fetch_assoc($blogCommentRes)) :
 					$object = [
 						'date' => $row['created'],
 						'blogID' => $row['blogID'],
 						'comment' => $row['comment'],
 						'type' => 'blogComment',
 					];

 					array_push($timeLinehistory,$object);
 				endwhile;


 				$getPetComments = "SELECT * FROM petcomments WHERE userid = '$userID'";
 				$petCommentRes = mysqli_query($conn,$getPetComments) or die(mysqli_error($conn));

 				while ($row = mysqli_fetch_assoc($petCommentRes)) :
 					$object = [
 						'date' => $row['created'],
 						'petID' => $row['petid'],
 						'comment' => $row['comment'],
 						'type' => 'petComment',
 					];

 					array_push($timeLinehistory,$object);
 				endwhile;



 				$getBlog = "SELECT * FROM blog WHERE writer_id = '$userID'";
 				$blogRes = mysqli_query($conn,$getBlog) or die(mysqli_error($conn));

 				while ($row = mysqli_fetch_assoc($blogRes)) :
 					$object = [
 						'date' => $row['date'],
 						'blogID' => $row['id'],
 						'description' => $row['description'],
 						'image' => $row['image'],
 						'title' => $row['title'],
 						'type' => 'blog',
 					];

 					array_push($timeLinehistory,$object);
 				endwhile;


 				usort($timeLinehistory, "date_sort");

 			 ?>