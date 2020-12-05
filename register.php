<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "PETME | SIGN UP";
} ?>

<?php function getMeta() { ?>
	<meta name="title" content="PET ME | SIGN UP">
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


	<div class="container py-5">
		<div class="card m-auto py-5" style="max-width: 30rem;">
			<div class="header text-center mb-3">
				<h1 >SIGN UP</h1>
				<!-- <img src="assets/images/logo/logo.png" alt="" title=""> -->
			</div>
			<div class="text-input px-4">
				<form action="lib/petme/register.php" method="post" id="registerForm">
					<small class="ml-1" style="color: #e5a62d; ">Email</small>
					<input required type="email"  name="email" class="w-100 p-2 email-input" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">
					<small class="text-danger error-email" style="display: none;">* Email Already Exist</small>
					<small class="ml-1" style="color: #e5a62d; ">Password</small>
					<input required type="password" name="password" class="w-100 p-2 pass" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">
					<small class="ml-1" style="color: #e5a62d; ">Repeat Password</small>
					<input required type="password" name="confirm-password" class="w-100 p-2 pass-c" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">
					<small class="text-danger error-password" style="display: none;">* Password Don't match</small>

					<small class="ml-1" style="color: #e5a62d; ">First Name</small>
					<input required type="text" name="first_name" class="w-100 p-2 first_name" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">
					<small class="text-danger error-fname" style="display: none;">* This is Required</small>
					<small class="ml-1" style="color: #e5a62d; ">Last Name</small>
					<input required type="text" name="last_name" class="w-100 p-2 last_name" style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " placeholder="">
					<small class="text-danger error-lname" style="display: none;">* This is Required</small>

					<small class="ml-1" style="color: #e5a62d; ">Gender</small>

					<select class="w-100 p-2" name="gender" style="border-radius: 100px; border:none;">
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>

					<button type="button" class="theme-btn submit-btn btn-style-four w-100 py-1 mt-3">SIGN UP</button>
				</form>
				
				<div class="text-center py-3">
					<small>OR</small>
				</div>
				<button type="submit" class="btn-style-five w-100 py-1 mb-3"><img src="assets/images/icon/google-logo.png" style="width: 20px; position: relative; top: -2px;"> LOGIN WITH GOOGLE</button>
				<button type="submit" class="btn-style-three w-100 py-1 mb-3"><img src="assets/images/icon/facebook-logo.png" style="width: 20px; position: relative; top: -2px;"> LOGIN WITH FACEBOOK</button>
				<div class="text-center">
					<small>Already Have Account ? 
						<a href="login.php" class="text-dark">
							<strong>Sign In</strong>
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

	$('.submit-btn').click(function(){
		let emailFlag = false;
		let passFlag = false;
		let fname = false;
		let lname = false;

		let email = $('.email-input').val();
		
		if ($('.pass').val().length != 0 && $('.pass-c').val() != 0) {

			if ($('.pass').val() != $('.pass-c').val()) {
				passFlag = false;
				$('.error-password').css({'display' : 'block'});
				$('.error-password').html('Password Not Match')
			} else {
				$('.error-password').hide();

				passFlag = true;
			}
		} else {
			$('.error-password').css({'display' : 'block'});
			$('.error-password').html('*Password required')
		}

		if ($('.last_name').val().length != 0) {
			lname = true;
			$('.error-fname').css({'display' : 'none'});
		} else {
			lname = false;
			$('.error-fname').css({'display' : 'block'});
		}


		if ($('.first_name').val().length != 0) {
			fname = true;
			$('.error-lname').css({'display' : 'none'});
		} else {
			fname = false;
			$('.error-lname').css({'display' : 'block'});
		}



		if (email.length != 0) {

			$.ajax({
				'url' : 'lib/petme/checkEmail.php',
				'method' : 'post',
				'data' : {email : email},
				success:function(data){
					if (data > 0) {
						$('.error-email').css({'display' : 'block'});
						$('.error-email').html('* Email Already Exist')
						emailFlag = false;
					} else {
						$('.error-email').hide();
						emailFlag = true;
						if (emailFlag == true  && passFlag == true && fname == true && lname == true) {
							$('#registerForm').submit();
						}
					}
				} 
			})
		} else{
			emailFlag = false;
			$('.error-email').css({'display' : 'block'});
			$('.error-email').html('* Email Required')
		}



		


	});


    $('.header-menu').find('li').eq(6).addClass('active')
</script>