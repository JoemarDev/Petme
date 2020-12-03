<label style="font-weight: 600; width: 100%;" >
	<?php if (isset($_SESSION['access_token'])): ?>
		<?php if ($_SESSION['OAuthID'] == $user_information['oauth_uid']): ?>
			<?php echo $user_information['first_name'] ?>
			<?php else: ?>
			YOU
		<?php endif ?>
	<?php else: ?>
		<?php echo $user_information['first_name'] ?>
	<?php endif ?>
	Created Article
	<small style="float: right;">
		<?php echo time_elapsed_string($key['date']) ?>
	</small>
</label>
<div class="card">
	<div class="card-body p-1 activity-image-card">
	 	<div class="row">


 			<?php if ($key['image'] != null): ?>
 				<div class="col-5 col-lg-6 ">
 					<img src="<?php echo $key['image'] ?>" class="w-100" style="position: relative; height: 100%;">
 				</div>
 			<?php else: ?>
 				<div class="col-5 col-lg-6 align-self-center">
 					<img src="assets/images/background/blog-place-holder.jpg" class="w-100" style="position: relative; height: 150px;">
 				</div>
 			<?php endif ?>
	 			
	 		<div class="col-7 col-lg-6 align-self-center">
	 			
	 			<h4 style="font-weight: 400" class="my-2">
	 				
	 				<?php echo $key['title'] ?>
	 			</h4>
	 			<small><?php echo $key['description'] ?></small>
	 			<button class="theme-btn btn-style-three py-1 my-3" style="display: block;">Read More</button>
	 		</div>
	 	</div>
	
	</div>
</div>

  <hr>
