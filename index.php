<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "PETME | HOME";
} ?>

<?php function getContent() { ?>

	<!-- HOME BANNER -->
	<div id="home-banner" class="carousel slide" data-ride="carousel">
	  	<div class="carousel-inner">

	    	<div class="carousel-item active">
	    		<div class="banner-content text-white">
	    			<h2>We Help All Homeless And Abused Pets </h2>
	    			<p>we promote all social and website for adoption</p>

	    			<a href="about.php" class="theme-btn btn-style-two">About Us.</a>
	    		</div>
	      		<img class="d-block w-100" src="assets/images/carousel/image-1.jpg" style="max-height: 600px;  object-fit: cover;" alt="First slide">
	    	</div>

	    	<div class="carousel-item">
	    		<div class="banner-content">
	    			<h2 class="text-white">We Find Your <br>Possible Buddy </h2>
	    			<p class="text-white">You can browse a lot of pet who finding a owner!</p>

	    			<a href="pet.php" class="theme-btn btn-style-two">Find pet</a>
	    		</div>
	      		<img class="d-block w-100" src="assets/images/carousel/image-2.jpg" style="max-height: 600px; object-fit: cover;" alt="Second slide">
	    	</div>
	  	</div>
	  	<a class="carousel-control-prev tparrows gyges" href="#home-banner" role="button" data-slide="prev">
	     	<span class="carousel-control-prev-icon " aria-hidden="true"></span>
	     	<span class="sr-only">Previous</span>
	  	</a>
	  	<a class="carousel-control-next tparrows gyges" href="#home-banner" role="button" data-slide="next">
	     	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	     	<span class="sr-only">Next</span>
	  	</a>
	</div>
	<!-- END OF HOME BANNER -->

	<?php require_once 'partials/welcome/welcome.php'; ?>

	<?php require_once 'partials/feature/feature.php'; ?>

	<div class="container mt-5">

				<div class="sec-title text-center">
		            <div class="separator">
		                <span class="icon"><i class="icofont-paw"></i></span>
		            </div>
		            <div class="title">Take A Look Of A Few Pets We Gather For You</div>
		            <h2>Find Your Pet</h2>
		        </div>
		
		 <div class="row py-4">
		 
			 <?php 
			 	require 'lib/connection.php';
			 	$sql = "SELECT * FROM userlikedpet ORDER BY RAND() LIMIT 12";
			 	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

			 	while ($row = mysqli_fetch_assoc($result)):
			 		$petID = $row['petID'];
			 		$petInfo = "SELECT * FROM likedpet WHERE petID = '$petID'";
			 		$info = mysqli_query($conn,$petInfo) or die(mysqli_error($conn));

			 		$pet = mysqli_fetch_assoc($info);
			 		$pet_unserialized = unserialize($pet['petObject']);

			 		 ?>
			 		 <!--Pets Block-->
			 		 <div class="pet-block col-md-4 col-lg-3  col-12 col-xs-12">
			 		     <div class="inner-box">
			 		         <div class="image">
			 		             <?php if ($pet_unserialized->animal->primary_photo_cropped != null) : ?>
			 		                 <img src="<?php echo $pet_unserialized->animal->primary_photo_cropped->full ?>" alt="">
			 		             <?php else: ?>
			 		                 <img src="assets/images/icon/dog-placeholder.gif" alt="" class="w-100" style="object-fit: contain;">
			 		             <?php endif; ?>
			 		             
			 		             <div class="overlay-box">
			 		                 <div class="overlay-inner">
			 		                     <div class="content">
			 		                         <ul>
			 		                             <li><a href="viewpet.php?petID=save-<?php echo $pet_unserialized->animal->id ?>" target="#viewPet">view profile</a></li>
			 		                             <li class="share">
			 		                             	<!-- CHECK IF THE USER LIKED THE PET -->
			 		                                 <?php if (isset($_SESSION['access_token'])): ?>
			 		                                     <?php 
			 		                                         require 'lib/connection.php';
			 		                                         $petID = $pet_unserialized->animal->id;
			 		                                         $userID = $_SESSION['OAuthID'];
			 		                                         $checkIfLiked = "SELECT * FROM userLikedPet WHERE petID = '$petID' AND userID = '$userID'";
			 		                                         $results = mysqli_query($conn,$checkIfLiked);
			 		                                         if (mysqli_num_rows($results) > 0): ?>
			 		                                             <a type="button" class="active unloved-pet" data-pet-id="<?php echo $pet_unserialized->animal->id ?>">
			 		                                                 <span class="icofont-heart-alt"></span>
			 		                                             </a>
			 		                                     <?php else: ?>

			 		                                         <a type="button" class="loved-pet" data-pet-id="<?php echo $pet_unserialized->animal->id ?>">
			 		                                             <span class="icofont-heart-alt"></span>
			 		                                         </a>

			 		                                     <?php endif;?>
			 		                                   
			 		                                 <?php else: ?>
			 		                                     <a  data-toggle="modal" data-target="#petLoginModal">
			 		                                         <span class="icofont-heart-alt"></span>
			 		                                     </a>
			 		                                 <?php endif ?>
			 		                               
			 		                             </li>
			 		                         </ul>
			 		                     </div>
			 		                 </div>
			 		             </div>
			 		         </div>
			 		         <div class="lower-content">
			 		             <h3><a href="#"><?php echo $pet_unserialized->animal->name; ?></a></h3>
			 		             <ul>
			 		                 <li> <?php echo $pet_unserialized->animal->age; ?></li>
			 		                 <li> <?php echo $pet_unserialized->animal->gender; ?></li>
			 		                 <li> <?php echo $pet_unserialized->animal->size; ?></li>
			 		             </ul>
			 		             <a href="#" class="theme-btn btn-style-eight">adopt me</a>
			 		         </div>
			 		     </div>
			 		 </div>

			 		
			 <?php	endwhile; ?>
		 </div>
	</div>

	<?php require_once  'partials/news/news.php' ?>	
	
	<?php require_once 'partials/footer/footer.php' ?>
<?php } ?>

<script type="text/javascript">
    $('.header-menu').find('li').eq(0).addClass('active')
</script>