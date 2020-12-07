<?php 
	
	require '../connection.php';

	$sql = "SELECT * FROM blog ORDER BY date";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	


	$data = [];

	while ($row = mysqli_fetch_assoc($result)) {
		$toPush = [
			'title' => $row['title'],
			'views' => $row['views'],
			'link' => 'blob/'.$row['seoTitle'],
			'date' => $row['date'],
		];

		array_push($data, $toPush);
	}

	echo json_encode($data);


 ?>