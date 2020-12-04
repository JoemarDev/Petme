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

	<?php 



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
	<div class="container py-2">
		<?php 

			$userID = null;

			if (isset($_SESSION['access_token'])):
				$userID = $_SESSION['OAuthID'];
			endif;
			
			if (isset($_GET['user'])):
				$userID = $_GET['user'];
			endif;


			$bg = '';

			require 'lib/connection.php';

			$getuser = "SELECT * FROM users WHERE oauth_uid = '$userID'";
			$userData = mysqli_query($conn,$getuser) or die(mysqli_error($conn));
			$user_information = mysqli_fetch_assoc($userData);

			$match = mysqli_num_rows($userData);

			$image = str_replace("s96-c","s200",$user_information['picture']);

			if ($user_information['gender'] == 'male') {
				$bg = "background: url(assets/images/icon/male.svg);";
			} else if ($user_information['gender'] == 'female') {
				$bg = "background: url(assets/images/icon/female.svg);";
			} else {
				$bg = "background: url(assets/images/icon/unknown.svg);";
			}
		 ?>

		 <?php if ($match > 0): ?>
		 	
		 
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
		 	<h2><?php echo $user_information['first_name'] ?> <?php echo $user_information['last_name'] ?></h2>
		 </div>

		 <div class="row">

		 	<div class="col-md-5 px-2" >
		 		<div id="magic-scroll-fixed">
		 			
			 		
			 		<div class="card p-3 profile-info shadow-sm mb-3" style="background:url('assets/images/home/image-3.png');">
			 			<h5 class="m-0 py-2"><strong>Information</strong></h5>
			 			<p class="border-top m-0 "><img class="mr-2" src="assets/images/icon/profile_name.svg" style="width: 25px;">  <small>Full Name</small> <?php echo $user_information['first_name']. ' ' . $user_information['last_name'] ?></p>
			 			<p class="border-top m-0 "><img class="mr-2" src="assets/images/icon/profile_gender.svg" style="width: 25px;">  
			 				<small>Gender</small> 
			 				<?php if ($user_information['gender'] != null): ?>
			 					<?php echo $user_information['gender']; ?>	
			 				<?php else: ?>
			 					Unknown
			 				<?php endif ?>
			 			</p>
			 			<p class="border-top m-0 "><img class="mr-2" src="assets/images/icon/profile_email.svg" style="width: 25px;">  <small>Email</small> <?php echo $user_information['email']; ?>	</p>
			 			<p class="border-top m-0 "><img class="mr-2" src="assets/images/icon/profile_member.svg" style="width: 25px;">  
			 				<?php $createdDate = strtotime($user_information['created']); ?>
			 				

			 				<small>Member Since</small> <?php echo date('F',$createdDate) ?> <?php echo date('d',$createdDate) ?> <?php echo date('Y',$createdDate) ?>
			 			</p>
			 		</div>

			 		<?php 
			 			require 'lib/connection.php';
			 			$sql = "SELECT * FROM userlikedpet WHERE userID = '$userID' LIMIT 9";
			 			$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
			 			$likedCount = mysqli_num_rows($result);
			 		 ?>
			 		<div class="liked-gallery w-100 card shadow-sm p-3 mb-3" style="background:url('assets/images/home/image-3.png'); object-fit: cover; background-position: top;">
			 			<h5 class="m-0 py-2">
			 				<strong>Pet's You Liked</strong>
			 				<br>
			 				<?php if ($likedCount > 1): ?>
			 					<small class="text-dark"><?php echo $likedCount ?> Pets Liked</small>
			 				<?php else: ?>
			 					<small class="text-dark"><?php echo $likedCount  ?> Pet Liked</small>
			 				<?php endif ?>
			 				
			 				<button class="btn-style-five seeAllUserPet">SEE ALL</button>
			 			</h5>
			 			<div class="row w-100 m-0">
			 				
			 			
		 				 <?php 
		 				 

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
		 	</div>

		 	<div class="col-md-7 px-2">
		 		<div class="card p-3 feed-parent">
		 			<h5 style="font-weight: 600;"><?php echo $user_information['first_name'] ?> Activity</h5>
		 			<hr>
		 			<?php require 'partials/_profile/fetch_feed.php'; ?>

		 			<?php if ($feedCount == 0): ?>
		 				<h3>No acivity to show</h3>
		 			<?php endif ?>
		 			
		 			 <?php foreach ($timeLinehistory as $key): ?>
		 			 	<?php if ($key['type'] == 'blogComment'): ?>
		 			 		<?php require 'partials/_profile/fetch_blog_comment.php'; ?>

		 			 	<?php elseif($key['type'] == 'liked'): ?>
		 			 		<?php require 'partials/_profile/fetch_pet_liked.php'; ?>
		 			 		
		 			 	<?php elseif($key['type'] == 'petComment'): ?>
		 			 		<?php require 'partials/_profile/fetch_pet_comment.php'; ?>

	 			 		<?php elseif($key['type'] == 'blog'): ?>
	 			 			<?php require 'partials/_profile/fetch_blog.php'; ?>
		 			 	<?php endif ?>

		 			 <?php endforeach ?>
		 		</div>
		 	</div>
		 </div>
		 <?php else: ?>
		 	<div class="w-100 py-5 text-center shadow-sm">
		 	     <img src="assets/images/icon/dog.svg" alt="" class="img-fluid" style="object-fit: contain;">
		 	     <h2>Sorry we can't find what you looking for :(</h2>
		 	</div>

		 <?php endif ?>


		
		 </div>
	</div>

	<?php require_once 'partials/footer/footer.php' ?>


<?php } ?>

<script type="text/javascript">
    $('.header-menu').find('li').eq(3).addClass('active')
</script>