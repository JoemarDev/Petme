<?php 
	session_start();

	if (empty($_SESSION['access_token'])):
		header("HTTP/1.1 401 Unauthorized");
		exit;
	else:

		if (empty($_SESSION['petme_administrator'])):
			header("HTTP/1.1 401 Unauthorized");
			exit;
		else:
			if ($_SESSION['petme_administrator'] != md5($_SESSION['OAuthID'].$_SESSION['user_email_address'])) {
				header("HTTP/1.1 401 Unauthorized");
				exit;
			}
		endif;

	endif;
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN PAGE</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/admin-style/admin.css">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">

	<link rel="stylesheet" type="text/css" href="assets/css/default-theme.css">

	<link rel="stylesheet" href="assets/css/icofont/icofont.min.css">

	<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>

	<!-- FAVICON -->
	<link rel="shortcut icon" href="assets/images/favicon/favicon.png" type="image/x-icon">
	<link rel="icon" href="assets/images/favicon/favicon.png" type="image/x-icon">
	<!-- FAVICON -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css" integrity="sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==" crossorigin="anonymous" />
</head>
<body>
	<div class="dashboard">
		<div class="dashboard-left card shadow-sm p-2">
			<h3 style="font-weight: 300;" class="ml-1">Pending Article</h3>
			<?php 
				require 'lib/connection.php';

				$getPending = "SELECT * FROM blog where isAllowed = 0 LIMIT 5";
				$res = mysqli_query($conn,$getPending);
			 ?>
			 <?php while ($row = mysqli_fetch_assoc($res)): ?>
			 	<div class="card p-2 shadow-sm mb-2" style=" background:url('assets/images/home/image-3.png');">
			 		<div class=" py-2">
			 			<div class="row" >
			 				<div class="col-4">
			 					<img style="width: 100%; border-radius: 100px;" src="https://lh3.googleusercontent.com/a-/AOh14GgS152dxAN54aDxciukBZGhZhh4YQriIbCyZKo=s200">
			 				</div>	
			 				<div class="col-8 align-self-top pt-3">
			 					<strong>Joemar B.</strong><br>
			 					<small style="position: absolute;">Created 2 Hours Ago.</small>
			 				</div>	
			 			</div>
			 				
			 		</div>
			 		<h5 style="font-weight: 400;"><?php echo $row['title'] ?></h5>
			 		<div class="card p-2 w-100 text-center">
			 			<label style="font-weight:  400; font-size: 13px; overflow: hidden;"><?php echo $row['description'] ?></label>
			 			<div class="row w-100 m-0">
			 				<div class="col-4 px-1">
			 					<button class="btn btn-success btn-sm w-100 publishArticle"  value="<?php echo $row['id'] ?>">	
			 						<small>Publish</small>
			 					</button>
			 				</div>
			 				<div class="col-4 px-1">
			 					<a href="blog/<?php echo $row['seoTitle'] ?>" target="_blank">
			 						
				 					<button class="btn btn-info btn-sm w-100">
				 						<small>Review</small>
				 					</button>
			 					</a>
			 					
			 				</div>
			 				<div class="col-4 px-1">
			 					<button class="btn btn-danger btn-sm w-100">
			 						<small>Revise</small>
			 					</button>
			 				</div>
			 			</div>
			 		</div>

			 	</div>
			 	
			 <?php endwhile; ?>


		</div>
		<div class="dashboard-center card shadow-sm p-2">
			<div class="row">
				<div class="col-sm-6 mb-3">
					<h3 style="font-weight: 300;" class="ml-1">Latest Activity</h3>
				</div>
				<div class="col-sm-6 mb-3">
					<h3 style="font-weight: 300;" class="ml-1">Total Visitors</h3>
					<canvas id="views_per_day" class="card p-2 shadow-sm "></canvas>
				</div>
				<div class="col-sm-6 mb-3">
					<h3 style="font-weight: 300;" class="ml-1">Most Articles Read</h3>
					<canvas id="most_articles_read" class="card p-2 shadow-sm "></canvas>
				</div>
				<div class="col-sm-6 mb-3">
					<h3 style="font-weight: 300;" class="ml-1">Comment Today</h3>
					<canvas id="comment_per_day" class="card p-2 shadow-sm"></canvas>
				</div>
				<div class="col-sm-6 mb-3">
					<h3 style="font-weight: 300;" class="ml-1">User List</h3>
					<div class="card p-2">
						<?php 
							require 'lib/connection.php';
							$getUser = "SELECT * FROM users";
							$userList = mysqli_query($conn,$getUser) or die(mysqli_error($conn));
						 ?>
						<table class="table table-hover text-left">
						  <thead>
						    <tr>
						      <th scope="col" style="font-weight: 600;">Email</th>
						      <th scope="col" style="font-weight: 600;">Name</th>
						      <th scope="col" style="font-weight: 600;">Level</th>
						      <th scope="col" style="font-weight: 600;">Option</th>
						    </tr>
						  </thead>

						  <tbody style="font-weight: 300;">
						  	<?php while ($userRow = mysqli_fetch_assoc($userList)): ?>
						  		<tr>
						  		  <td><?php echo $userRow['email'] ?></td>
						  		  <td><?php echo $userRow['first_name'] . ' '.  $userRow['last_name'] ?></td>
						  		  <?php 
						  		  		$Userid = $userRow['oauth_uid'];
						  		  		$email = $userRow['email'];
						  		  		$checkUser = "SELECT * FROM credentials WHERE Userid = '$Userid' AND  email = '$email'";
						  		  		$cRes = mysqli_num_rows(mysqli_query($conn,$checkUser));
						  		   ?>

						  		   <?php if ($cRes > 0): ?>

							  		   	<td style="color: green; font-weight: 600;">Admin</td>
							  		   	<td><button class="btn-danger btn-sm">Revoke</button></td>

						  		   	<?php else: ?>

						  		   	 	<td>Regular</td>
						  		   	 	<td><button class="btn-info btn-sm make-admin" value="<?php echo $Userid ?>" onclick="validateAdmin()">Upgrade</button></td>

						  		   <?php endif ?>
						  		  
						  		</tr>
						  	<?php endwhile; ?>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-right card shadow-sm p-2">
			
		</div>
	</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js" integrity="sha512-hZf9Qhp3rlDJBvAKvmiG+goaaKRZA6LKUO35oK6EsM0/kjPK32Yw7URqrq3Q+Nvbbt8Usss+IekL7CRn83dYmw==" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/admin.js"></script>
<script type="text/javascript">
	$(window).resize(function(){
		$('.dashboard-center').width($(window).width() - 650);
	})
	$('.dashboard-center').width($(window).width() - 650);
</script>
</html>