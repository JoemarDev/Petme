<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "PETME | HOME";
} ?>

<?php function getContent() { ?>


	<div class="container py-5">
		<div class="card m-auto py-5" style="max-width: 30rem;">
			<div class="header text-center mb-3">
				<h1 >SIGN IN</h1>
				<!-- <img src="assets/images/logo/logo.png" alt="" title=""> -->
			</div>
			<div class="text-input px-4">
				<small class="ml-1" style="color: #e5a62d; ">Email</small>
				<input type="email" name="" class="w-100 p-2" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">
				<small class="ml-1" style="color: #e5a62d; ">Password</small>
				<input type="password" name="" class="w-100 p-2" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">

				<button type="submit" class="theme-btn btn-style-four w-100 py-1 mt-3">SIGN IN</button>
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