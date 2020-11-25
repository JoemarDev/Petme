<nav class="main-header ">
	<div class="d-none d-lg-block navigation">
		<!-- Header Top -->
		<div class="header-top">
			<div class="container">
				<div class="float-left ">
					<ul class="header-top-contact">
						<li><i class="icofont-google-map"></i> 32 Bell South, Harley St. FL</li>
						<li><i class="icofont-ui-call"></i> +(63) 234 567 8900</li>
						<li><i class="icofont-ui-message"></i> support@petme.com</li>
					</ul>
				</div>
				<div class="float-right text-right">
					<ul class="header-top-contact">
						<li><button class="theme-btn btn-style-one">DONATE</button></li>
						<li class="social-contact"><i class="icofont-twitter"></i></li>
						<li class="social-contact"><i class="icofont-facebook"></i></li>
						<li class="social-contact"><i class="icofont-google-plus"></i></li>
						<li class="social-contact"><i class="icofont-youtube-play"></i></li>
					</ul>

				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- End Of Header Top -->

		<!-- Header Upper -->
		 <div class="header-upper pt-2 pb-4">
		 	<div class="container">
		 		<div class="float-left">
		 			<div class="logo"><a href="index.php"><img src="assets/images/logo/logo.png" alt="" title=""></a></div>
		 		</div>
		 		<div class="float-right">
		 			<ul class="header-menu">
		 				<li onclick="window.location.href='index.php'">HOME</li>
		 				<li onclick="window.location.href='about.php'">ABOUT</li>
		 				<li onclick="window.location.href='pet.php'">PETS</li>
		 				<li>BLOG</li>
		 				<li onclick="window.location.href='contact.php'">CONTACT</li>
		 				<?php if (isset($_SESSION['access_token'])): ?>
		 					<li onclick="window.location.href='profile.php'">ACCOUNT</li>
		 					<li onclick="window.location.href='lib/logout.php'"><i class="icofont-sign-out"></i></li>
	 					<?php else: ?>
	 						<li onclick="window.location.href='login.php'">LOGIN</li>
		 				<?php endif ?>
		 			</ul>
		 		</div>
		 		<div class="clearfix"></div>
		 	</div>
		 </div>
		<!-- End of Header Upper -->
	</div>

	<div class="d-block d-lg-none" style="display: none;">
		<div class="header-top">
			<div class="container">
				<div class="text-center">
					<ul class="header-top-contact justify-content-center">
						<li><button class="theme-btn btn-style-one">DONATE</button></li>
						<li class="social-contact"><i class="icofont-twitter"></i></li>
						<li class="social-contact"><i class="icofont-facebook"></i></li>
						<li class="social-contact"><i class="icofont-google-plus"></i></li>
						<li class="social-contact"><i class="icofont-youtube-play"></i></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="header-upper pt-2 pb-4">
			<div class="container">
				<div class="w-100 text-center" style="position: relative;">
					<button class="nav-mobile-search"> <i class="icofont-search"></i></button>
					<button class="nav-mobile-menu"> <i class="icofont-navigation-menu"></i></button>
					<div class="logo"><a href="index.php"><img src="assets/images/logo/logo.png" alt="" title=""></a></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="sidebar shadow" data-status="off">
			<div class="logo py-4 px-3">
				<a href="index.php"><img src="assets/images/logo/logo.png" alt="" title=""></a>
			</div>
			<div class="w-100 py-3 pl-4 " style="cursor: pointer;"  onclick="window.location.href='index.php'">
				<strong>HOME</strong>
			</div>
			<div class="w-100 py-3 pl-4 " style="cursor: pointer;" onclick="window.location.href='about.php'">
				<strong>ABOUT</strong>
			</div>
			<div class="w-100 py-3 pl-4 " style="cursor: pointer;" onclick="window.location.href='pet.php'" >
				<strong>PETS</strong>
			</div>
			<div class="w-100 py-3 pl-4 " style="cursor: pointer;">
				<strong>BLOG</strong>
			</div>
			<div class="w-100 py-3 pl-4 " style="cursor: pointer;"  onclick="window.location.href='contact.php'">
				<strong>CONTACT</strong>
			</div>
			<div class="w-100 py-3 pl-4 nav-mobile-menu-close" style="cursor: pointer;" onclick="toggleSidebar()">
				<strong>CLOSE</strong>
			</div>
			<hr>
			<div class="w-100 py-2 ">
				<ul class="header-top-contact pl-0">
					<li class="social-contact text-dark"><i class="icofont-twitter"></i></li>
					<li class="social-contact text-dark"><i class="icofont-facebook"></i></li>
					<li class="social-contact text-dark"><i class="icofont-google-plus"></i></li>
					<li class="social-contact text-dark"><i class="icofont-youtube-play"></i></li>
				</ul>
			</div>
			<div class="w-100 py-2 ">
				<ul class="header-top-contact d-block pl-0">
					<li class="text-dark w-100 py-2"><i class="icofont-google-map"></i> 32 Bell South, Harley St. FL</li>
					<li class="text-dark w-100 py-2"><i class="icofont-ui-call"></i> +(63) 234 567 8900</li>
					<li class="text-dark w-100 py-2"><i class="icofont-ui-message"></i> support@petme.com</li>
				</ul>
			</div>
		</div>

	</div>

</nav>
