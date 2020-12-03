<?php 
	
	$petID = $_POST['petID'];
	require 'connection.php';
	$commentArr = [];
	$comments = "SELECT * FROM petcomments WHERE petid = '$petID'";
	$result = mysqli_query($conn,$comments) or die(mysqli_error($conn));

	while ($row = mysqli_fetch_assoc($result)):
		$userID = $row['userid'];
		$user = "SELECT * FROM users WHERE  oauth_uid = '$userID'";
		$user_res = mysqli_query($conn,$user) or die(mysqli_error($conn));
		$user_res = mysqli_fetch_assoc($user_res);


		$info = [
			'userID' => $user_res['oauth_uid'],
			'picture' => $user_res['picture'],
			'name' => $user_res['first_name'],
			'comment' => $row['comment'],
			'time' => time_elapsed_string($row['created']),
		];

		array_push($commentArr,$info);

	endwhile;

	echo json_encode($commentArr);



	function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'Just now';
	}
 ?>