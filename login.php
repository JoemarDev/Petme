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

	<div class="container py-5">
		<div class="card m-auto py-5" style="max-width: 30rem;">
			<div class="header text-center mb-3">
				<h1 >SIGN IN</h1>
				<!-- <img src="assets/images/logo/logo.png" alt="" title=""> -->
			</div>
			<div class="text-input px-4">
				<?php if (isset($_GET['error'])): ?>
					
				<small style="color: red;"> * Account Can't Find.</small>
				<?php endif ?>
				<form action="lib/petme/login.php" method="POST">
					<small class="ml-1" style="color: #e5a62d; ">Email</small>
					<input required type="email" name="email" class="w-100 p-2" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">
					<small class="ml-1" style="color: #e5a62d; ">Password</small>
					<input required type="password" name="password" class="w-100 p-2" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">

					<button type="submit" class="theme-btn btn-style-four w-100 py-1 mt-3">SIGN IN</button>
				</form>
				
				<div class="text-center py-3">
					<small>OR</small>
				</div>

				<?php if (!isset($_SESSION['access_token'])) {require_once 'lib/generateLoginUrl.php';} ?>
				<button  onclick="window.location.href='<?php echo $loginUrl ?>'" class="btn-style-five w-100 py-1 mb-3"><img src="assets/images/icon/google-logo.png" style="width: 20px; position: relative; top: -2px;"> LOGIN WITH GOOGLE</button>
				<button type="submit" class="btn-style-three w-100 py-1 mb-3"><img src="assets/images/icon/facebook-logo.png" style="width: 20px; position: relative; top: -2px;"> LOGIN WITH FACEBOOK</button>
				<div class="text-center">
					<small>Don't Have Account Yet ? 
						<a href="register.php" class="text-dark">
							<strong>Sign Up</strong>
						</a>
					</small>
				</div>
			</div>
		</div>

	</div>
	<div class="container">
		<hr>
	</div>
	<?php require_once 'partials/footer/footer.php' ?>
<?php } ?>

<script type="text/javascript">
    $('.header-menu').find('li').eq(5).addClass('active')
</script>