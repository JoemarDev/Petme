<?php 
	function date_sort($a, $b) {
		$date1 = $a['date'];
		$date2 = $b['date'];
	    return strtotime($date1) < strtotime($date2);
	}
	$timeLinehistory = [];


	require 'lib/connection.php';

	$userID = $user_information['oauth_uid'];

	$getHistory = "SELECT * FROM history WHERE userID = '$userID' ORDER BY id DESC LIMIT 20";

	$historyRes = mysqli_query($conn,$getHistory) or die(mysqli_error($conn));
	$feedCount = mysqli_num_rows($historyRes);

	while ($row = mysqli_fetch_assoc($historyRes)):
		if ($row['type'] == 'makeblogcomment'):

			$contentID = $row['contentID'];
			$getBlogComments = "SELECT * FROM blogcomments WHERE id = '$contentID'";
			$blogCommentRes = mysqli_query($conn,$getBlogComments) or die(mysqli_error($conn));
			$row = mysqli_fetch_assoc($blogCommentRes);

			$object = [
				'date' => $row['created'],
				'blogID' => $row['blogID'],
				'comment' => $row['comment'],
				'type' => 'blogComment',
			];
			array_push($timeLinehistory,$object);

		elseif($row['type'] == 'makeblog'):

			$contentID = $row['contentID'];
			$getBlog = "SELECT * FROM blog WHERE id = '$contentID'";
			$blogRes = mysqli_query($conn,$getBlog) or die(mysqli_error($conn));
			$row = mysqli_fetch_assoc($blogRes);
			$object = [
				'date' => $row['date'],
				'blogID' => $row['id'],
				'description' => $row['description'],
				'image' => $row['image'],
				'title' => $row['title'],
				'type' => 'blog',
			];

			array_push($timeLinehistory,$object);
	


		elseif($row['type'] == 'petcomment'):

			$contentID = $row['contentID'];
			$getPetComments = "SELECT * FROM petcomments WHERE id = '$contentID'";
			$petCommentRes = mysqli_query($conn,$getPetComments) or die(mysqli_error($conn));

			$row = mysqli_fetch_assoc($petCommentRes);
			$object = [
					'date' => $row['created'],
					'petID' => $row['petid'],
					'comment' => $row['comment'],
					'type' => 'petComment',
				];

			array_push($timeLinehistory,$object);

		elseif($row['type'] == 'petliked'):

			$contentID = $row['contentID'];
			$getLiked = "SELECT * FROM userlikedpet WHERE id = '$contentID'";
			$likedRes = mysqli_query($conn,$getLiked) or die(mysqli_error($conn));
			$row = mysqli_fetch_assoc($likedRes);
			$object = [
				'date' => $row['created'],
				'petID' => $row['petID'],
				'type' => 'liked',
			];

			array_push($timeLinehistory,$object);

		endif;
	endwhile;


	usort($timeLinehistory, "date_sort");

?>