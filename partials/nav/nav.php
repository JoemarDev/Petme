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
		 			<div class="logo"><a href="home"><img src="assets/images/logo/logo.png" alt="" title=""></a></div>
		 		</div>
		 		<div class="float-right">
		 			<ul class="header-menu">
		 				<li onclick="window.location.href='home'"><a href="home">HOME</a></li>
		 				<li onclick="window.location.href='pets'"><a href="pets">PETS</a></li>
		 				<li onclick="window.location.href='blog'"><a href="blog">BLOG</a></li>
		 				<?php if (isset($_SESSION['access_token'])): ?>
		 					<li onclick="window.location.href='user/<?php echo $_SESSION['OAuthID'] ?>'"><a href="user/<?php echo $_SESSION['OAuthID'] ?>">ACCOUNT</a></li>
		 					<li onclick="window.location.href='lib/logout.php'"><a href="lib/logout.php"><i class="icofont-sign-out"></i></a></li>
	 					<?php else: ?>
	 						<li onclick="window.location.href='login.php'"><a href="login">LOGIN</a></li>
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
					<div class="logo"><a href="home"><img src="assets/images/logo/logo.png" alt="" title=""></a></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="sidebar shadow" data-status="off">
			<div class="logo py-4 px-3">
				<a href="home"><img src="assets/images/logo/logo.png" alt="" title=""></a>
			</div>
			<div class="w-100 py-3 pl-4 " style="cursor: pointer;"  onclick="window.location.href='home'">
				<strong>HOME</strong>
			</div>
			<div class="w-100 py-3 pl-4 " style="cursor: pointer;" onclick="window.location.href='pets'" >
				<strong>PETS</strong>
			</div>
			<div class="w-100 py-3 pl-4 " style="cursor: pointer;" onclick="window.location.href='blog'">
				<strong>BLOG</strong>
			</div>

			<?php if (isset($_SESSION['access_token'])): ?>
				<div class="w-100 py-3 pl-4 " style="cursor: pointer;"  onclick="window.location.href='profile.php'">
					<strong>ACCOUNT</strong>
				</div>
				<div class="w-100 py-3 pl-4 " style="cursor: pointer;"  onclick="window.location.href='lib/logout.php'">
					<strong>LGGOUT</strong>
				</div>
			<?php else: ?>
				<div class="w-100 py-3 pl-4 " style="cursor: pointer;"  onclick="window.location.href='login.php'">
					<strong>LOGIN</strong>
				</div>
			<?php endif ?>

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
