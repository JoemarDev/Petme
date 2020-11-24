<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "PETME | HOME";
} ?>

<?php function getContent() { ?>

	<!-- HOME BANNER -->
	<div id="home-banner" class="carousel slide" data-ride="carousel">
	  	<div class="carousel-inner">

	    	<div class="carousel-item active">
	    		<div class="banner-content">
	    			<h2>We Give Special Care <br> to Your Loving Pets </h2>
	    			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <br>
	    			tempor incididunt ut labore et dolore magna aliqua.</p>

	    			<a href="/" class="theme-btn btn-style-two">Book Appointment</a>
	    		</div>
	      		<img class="d-block w-100" src="assets/images/carousel/image-1.jpg" alt="First slide">
	    	</div>

	    	<div class="carousel-item">
	    		<div class="banner-content">
	    			<h2 class="text-white">We Give Special Care <br> to Your Loving Pets </h2>
	    			<p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <br>
	    			tempor incididunt ut labore et dolore magna aliqua.</p>

	    			<a href="/" class="theme-btn btn-style-two">Book Appointment</a>
	    		</div>
	      		<img class="d-block w-100" src="assets/images/carousel/image-2.jpg" alt="Second slide">
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


	<?php require_once 'partials/service/service.php'; ?>

	<?php require_once 'partials/contact/appointment.php'; ?>

	<?php require_once 'partials/team/team.php'; ?>

	<?php require_once  'partials/counter/counter.php'; ?>

	<?php require_once  'partials/save-pet/save-pet.php'; ?>

	<?php require_once  'partials/about/about1.php'; ?>

	<?php require_once  'partials/testimonial/testimonial.php' ?>

	<?php require_once  'partials/news/news.php' ?>	
	
	<?php require_once 'partials/footer/footer.php' ?>
<?php } ?>

<script type="text/javascript">
    $('.header-menu').find('li').eq(0).addClass('active')
</script>