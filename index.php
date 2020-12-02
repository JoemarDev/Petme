<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "PETME | HOME";
} ?>


<?php function getMeta() { ?>
	<meta name="title" content="PET ME | HOME">
	<meta name="description" content="We help all homeless and abused pets to find and take care of them, we promote all social and website for adoption, if you want to inlist your program just email us for that matter. you can put any animal here for adoptation so soon we can them a family.">
	<meta name="keywords" content="Pet,Adoption,PetCare,findpet">
	<meta name="robots" content="index, follow">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="English">
	<meta name="author" content="PETME">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">
	<meta property="og:title" content="Petme">
	<meta property="og:description" content="We help all homeless and abused pets to find and take care of them, we promote all social and website for adoption, if you want to inlist your program just email us for that matter. you can put any animal here for adoptation so soon we can them a family.">
	<meta property="og:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/logo/petlogo.png">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">
	<meta property="twitter:title" content="Petme">
	<meta property="twitter:description" content="We help all homeless and abused pets to find and take care of them, we promote all social and website for adoption, if you want to inlist your program just email us for that matter. you can put any animal here for adoptation so soon we can them a family.">
	<meta property="twitter:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/logo/petlogo.png">


<?php } ?>

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

		<div class="sec-title text-center mb-4">
            <div class="separator">
                <span class="icon"><i class="icofont-paw"></i></span>
            </div>
            <div class="title">Take A Look Of A Few Pets We Gather For You</div>
            <h2>Find Your Pet</h2>
        </div>

        <div class="row py-3">
        	<?php 
        		require 'lib/connection.php';
        		$sql = "SELECT * FROM likedpet ORDER BY RAND() LIMIT 12";
        		$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        		while ($row = mysqli_fetch_assoc($result)):
        			$pet_unserialized = unserialize($row['petObject']); ?>

	        	<div class="col-md-4 col-lg-3 col-sm-6 col-6 mb-3 pet-card-parent">
	        		<div class="pet-card w-100 shadow" >
	        				<!-- CHECK IF THE USER LIKED THE PET -->
	        				<?php if (isset($_SESSION['access_token'])): ?>
		        				<?php 
		        				    require 'lib/connection.php';
		        				    $petID = $pet_unserialized->animal->id;
		        				    $userID = $_SESSION['OAuthID'];
		        				    $checkIfLiked = "SELECT * FROM userlikedpet WHERE petID = '$petID' AND userID = '$userID'";
		        				    $results = mysqli_query($conn,$checkIfLiked);
		        				    if (mysqli_num_rows($results) > 0): ?>
		        				       
	        				        <div class="unlove-pet love-pet-icon" data-pet-id="<?php echo $pet_unserialized->animal->id ?>">
	        				        	<img src="assets/images/icon/heart-on.svg" >
	        				        </div>

		        				<?php else: ?>

		        					<div class="love-pet love-pet-icon" data-pet-id="<?php echo $pet_unserialized->animal->id ?>">
		        						<img src="assets/images/icon/heart-off.svg" >
		        					</div>

		        				<?php endif;?>

	        			    <?php else: ?>
	        			    	<div class="love-pet-icon" data-toggle="modal" data-target="#petLoginModal">
	        			    		<img src="assets/images/icon/heart-off.svg" >
	        			    	</div>
	        			    <?php endif ?>
	        			
        				<?php if (isset($pet_unserialized->animal->primary_photo_cropped)) : ?>
        			    	<img src="<?php echo $pet_unserialized->animal->primary_photo_cropped->full ?>" alt="">
        				<?php else: ?>
        			    	<img src="assets/images/icon/dog-placeholder.gif" alt="" class="w-100" style="object-fit: contain;">
        				<?php endif; ?>
	        			<div class="overlay ">
	        				<h3><?php echo ucfirst($pet_unserialized->animal->name); ?></h3>
	        				<br>
	        				<ul>
	        					<li class="m-2"><img src="assets/images/icon/dot.svg" class="icon"><?php echo $pet_unserialized->animal->age; ?></li>
	        					<li class="m-2"><img src="assets/images/icon/dot.svg" class="icon"><?php echo $pet_unserialized->animal->gender; ?> </li>
	        					<li class="m-2"><img src="assets/images/icon/dot.svg" class="icon"><?php echo $pet_unserialized->animal->size; ?> </li>
	        				</ul>
	        				<a href="pets/<?php echo $pet_unserialized->animal->name ?>/save-<?php echo $pet_unserialized->animal->id ?>">
	        					<button style="position: relative; top: 30px;" class="theme-btn btn-style-three">View Pet</button>
	        				</a>	
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


