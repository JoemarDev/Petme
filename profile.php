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
	<meta property="og:url" content="https://metatags.io/">
	<meta property="og:title" content="Petme">
	<meta property="og:description" content="We help all homeless and abused pets to find and take care of them, we promote all social and website for adoption, if you want to inlist your program just email us for that matter. you can put any animal here for adoptation so soon we can them a family.">
	<meta property="og:image" content="assets/images/logo/petlogo.png">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="https://metatags.io/">
	<meta property="twitter:title" content="Petme">
	<meta property="twitter:description" content="We help all homeless and abused pets to find and take care of them, we promote all social and website for adoption, if you want to inlist your program just email us for that matter. you can put any animal here for adoptation so soon we can them a family.">
	<meta property="twitter:image" content="assets/images/logo/petlogo.png">


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
		 <?php 
		 	require 'lib/connection.php';
		 	$user_ID = $_SESSION['OAuthID'];
		 	$countPet = "SELECT * FROM userlikedpet WHERE userID = '$user_ID'";
		 	$count = mysqli_query($conn,$countPet) or die(mysqli_error($conn));
		  ?>
		 <h3>You loved <?php echo mysqli_num_rows($count) ?> Pet's!</h3>
		 <hr>
		 <div class="row">
		 	
		
			 <?php 
			 	require 'lib/connection.php';
			 	$user_ID = $_SESSION['OAuthID'];
			 	$sql = "SELECT * FROM userlikedpet WHERE userID = '$user_ID'";
			 	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			 	while ($row = mysqli_fetch_assoc($result)):
			 		$petID = $row['petID'];
			 		$petInfo = "SELECT * FROM likedpet WHERE petID = '$petID'";
			 		$info = mysqli_query($conn,$petInfo) or die(mysqli_error($conn));

			 		$pet = mysqli_fetch_assoc($info);
			 		$pet_unserialized = unserialize($pet['petObject']);
			 		 ?>
		 		 	<div class="col-md-3 mt-3 profile-pet-card">
		 		 		<a href="viewpet.php?petID=save-<?php echo $petID ?>" target="_petFromProfile">
			 		 		<div class="card" style="width: 100%;">
			 		 			<?php if (isset($pet_unserialized->animal->primary_photo_cropped->full)): ?>
			 		 				<img class="card-img-top" src="<?php echo $pet_unserialized->animal->primary_photo_cropped->full ?>" alt="Card image cap" style="height: 400px; object-fit: cover;">
			 		 			<?php else: ?>
			 		 				<img class="card-img-top" src="assets/images/icon/dog-placeholder.gif" alt="Card image cap" style="height: 400px; object-fit: contain;">
			 		 			<?php endif ?>
			 		 		  	
			 		 		  	<div class="card-body">
			 		 		    	<p class="card-text text-dark">
			 		 		    		<?php echo $pet['petName'] ?> 
			 		 		    		<small class="float-right mt-1"> <?php echo $pet['petLiked'] ?> <i class="icofont-heart-alt" style="color: #e7470c ;"></i></small>
			 		 		    	</p>
			 		 		  	</div>
			 		 		</div>
		 		 		</a>
		 		 	</div>

			 		
			 <?php	endwhile; ?>
		 </div>
	</div>

	<?php require_once 'partials/footer/footer.php' ?>
<?php } ?>

<script type="text/javascript">
    $('.header-menu').find('li').eq(3).addClass('active')
</script>