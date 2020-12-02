<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "PETME | HOME";
} ?>
<?php function getMeta() { ?>
	<meta name="title" content="PET ME | SIGN IN">
	<meta name="description" content="We help all homeless and abused pets to find and take care of them, we promote all social and website for adoption, if you want to inlist your program just email us for that matter. you can put any animal here for adoptation so soon we can them a family.">
	<meta name="keywords" content="Pet,Adoption,PetCare,findpet">
	<meta name="robots" content="index, follow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="English">
	<meta name="author" content="PETME">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
	<meta property="og:title" content="Petme">
	<meta property="og:description" content="We help all homeless and abused pets to find and take care of them, we promote all social and website for adoption, if you want to inlist your program just email us for that matter. you can put any animal here for adoptation so soon we can them a family.">
	<meta property="og:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/logo/petlogo.png">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
	<meta property="twitter:title" content="Petme">
	<meta property="twitter:description" content="We help all homeless and abused pets to find and take care of them, we promote all social and website for adoption, if you want to inlist your program just email us for that matter. you can put any animal here for adoptation so soon we can them a family.">
	<meta property="twitter:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/logo/petlogo.png">


<?php } ?>


<?php function getContent() { ?>

	<div class="container py-2">
		<?php 
			$bg = '';
			$image = str_replace("s96-c","s200",$_SESSION['user_picture']);
			if ($_SESSION['user_gender'] == 'male') {
				$bg = "background: url(assets/images/icon/male.svg);";
			} else if ($_SESSION['user_gender'] == 'female') {
				$bg = "background: url(assets/images/icon/female.svg);";
			} else {
				$bg = "background: url(assets/images/icon/unknown.svg);";
			}
		 ?>
		 <?php echo $_SESSION['user_gender'] ?>
		 <div 
		 	class="profile-placeholder" 
		 	style="<?php echo $bg; ?> 
		 		background-size: contain; 
		 		max-width: 200px;
		 		background-repeat: no-repeat;
		 		border:2px solid #e5a62d;
		 		border-radius: 100px;
		 		margin: auto;
		 		height: 200px;">
				<img src="<?php echo $image ?>" class="img-fluid" style="border-radius: 100px;">
		 </div>
		 <div class="text-center py-2">
		 	<h2><?php echo $_SESSION['user_first_name'] ?> <?php echo $_SESSION['user_last_name'] ?></h2>
		 </div>

		 <div class="row">

		 	<div class="col-md-5 px-2">
		 		<div class="card p-3 profile-info shadow-sm mb-3" style="background:url('assets/images/home/image-3.png');">
		 			<h5 class="m-0 py-2"><strong>Information</strong></h5>
		 			<p class="border-top m-0 "><img class="mr-2" src="assets/images/icon/profile_name.svg" style="width: 25px;">  <small>Full Name</small> Joemar Baclea-an</p>
		 			<p class="border-top m-0 "><img class="mr-2" src="assets/images/icon/profile_gender.svg" style="width: 25px;">  <small>Gender</small> Male</p>
		 			<p class="border-top m-0 "><img class="mr-2" src="assets/images/icon/profile_email.svg" style="width: 25px;">  <small>Email</small> Joemar@gmail.com</p>
		 			<p class="border-top m-0 "><img class="mr-2" src="assets/images/icon/profile_member.svg" style="width: 25px;">  
		 				<small>Member Since</small> January 18 , 2019
		 			</p>
		 		</div>

		 		<div class="liked-gallery w-100 card shadow-sm p-3 mb-3" style="background:url('assets/images/home/image-3.png'); object-fit: cover; background-position: top;">
		 			<h5 class="m-0 py-2">
		 				<strong>Pet's You Liked</strong>
		 				<br>
		 				<small class="text-dark">78 Pets Liked</small>
		 				<button class="btn-style-five seeAllUserPet">SEE ALL</button>
		 			</h5>
		 			<div class="row w-100 m-0">
		 				
		 			
	 				 <?php 
	 				 	require 'lib/connection.php';
	 				 	$user_ID = $_SESSION['OAuthID'];
	 				 	$sql = "SELECT * FROM userlikedpet WHERE userID = '$user_ID' LIMIT 9";
	 				 	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	 				 	while ($row = mysqli_fetch_assoc($result)):
	 				 		$petID = $row['petID'];
	 				 		$petInfo = "SELECT * FROM likedpet WHERE petID = '$petID'";
	 				 		$info = mysqli_query($conn,$petInfo) or die(mysqli_error($conn));

	 				 		$pet = mysqli_fetch_assoc($info);
	 				 		$pet_unserialized = unserialize($pet['petObject']);
	 				 		 ?>
	 				 		 <div class="col-4 p-1">
	 				 		 	
	 				 		
	 			 		 		<a href="viewpet.php?petID=save-<?php echo $petID ?>" target="_petFromProfile">
				 		 			<?php if (isset($pet_unserialized->animal->primary_photo_cropped->small)): ?>
				 		 				<img class="w-100" src="<?php echo $pet_unserialized->animal->primary_photo_cropped->small ?>" alt="Card image cap" style="height: 150px; object-fit: cover;">
				 		 			<?php else: ?>
				 		 				<img class="w-100" src="assets/images/icon/dog-placeholder.gif" alt="Card image cap" style="height: 150px; object-fit: contain;">
				 		 			<?php endif ?>
	 			 		 		</a>
	 			 		 	</div>	
		 				 <?php	endwhile; ?>
		 			</div>

		 		</div>
		 	</div>

		 	<div class="col-md-7 px-2">
		 		<div class="card p-3">
		 			<?php 
			 			function date_sort($a, $b) {
			 				$date1 = $a['date'];
			 				$date2 = $b['date'];
			 			    return strtotime($date1) < strtotime($date2);
			 			}
		 				$timeLinehistory = [];
		 				require 'lib/connection.php';
		 				$userID = $_SESSION['OAuthID'];
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

		 			 <?php foreach ($timeLinehistory as $key): ?>
		 			 	<?php if ($key['type'] == 'blogComment'): ?>
		 			 		<p>YOU COMMENT SOMTHING</p>
		 			 	<?php elseif($key['type'] == 'liked'): ?>
		 			 		<p>YOU LIKED SOMTHING</p>
		 			 	<?php elseif($key['type'] == 'petComment'): ?>
		 			 		<p>YOU COMMENT IN PET SOMTHING</p>
	 			 		<?php elseif($key['type'] == 'blog'): ?>
	 			 			<p>YOU CREATED BLOG</p>
		 			 	<?php endif ?>
		 			 <?php endforeach ?>
		 		</div>
		 	</div>
		 </div>


		
		 </div>
	</div>

	<?php require_once 'partials/footer/footer.php' ?>
<?php } ?>

<script type="text/javascript">
    $('.header-menu').find('li').eq(3).addClass('active')
</script>