	<div class="card-body p-1">

  		<?php 
			$blogCommID = $key['blogID'];
  			$fetch_blog_comment = "SELECT * FROM blog WHERE id = '$blogCommID'";
  			$resBlogComment = mysqli_query($conn,$fetch_blog_comment) or die(mysqli_error($conn));
  			$resBlogComment = mysqli_fetch_assoc($resBlogComment);
  		 ?>
    	<?php// echo $key['comment'] ?>

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
    		Comment on this article
    		<small style="float: right;">
    			<?php echo time_elapsed_string($key['date']) ?>
    		</small>
    	</label>
    	<div class="card">
    		<div class="card-body p-1 activity-image-card">
    		 	<div class="row">
		 		
		 			<?php if ($resBlogComment['image'] != null): ?>
		 				<div class="col-5 col-lg-6">
		 					<img src="<?php echo $resBlogComment['image'] ?>" class="w-100" style="position: relative; height: 100%;">
		 				</div>
		 			<?php else: ?>
		 				<div class="col-5 col-lg-6  align-self-center">
		 					<img src="assets/images/background/blog-place-holder.jpg" class="w-100" style="position: relative; height: 150px;">
		 				</div>
		 			<?php endif ?>
    		 			
    		 		
    		 		<div class="col-7 col-lg-6 align-self-center">
    		 			
    		 			<h4 style="font-weight: 400; width: 90%;" class="my-2">
    		 				
    		 				<?php echo $resBlogComment['title'] ?>
    		 			</h4>

    		 			<label class="my-4" style="max-width: 90%; padding: 10px; background: #630abb;color :#fff; font-weight : 600; border-radius: 5px; position: relative;">
    		 				  <?php echo $key['comment'] ?>
    		 				<div style="height: 20px; width: 20px; position: absolute; left: 15px; background: #630abb; transform: rotate(226deg); z-index: 0px;"></div>
    		 			</label>
    		 		</div>
    		 	</div>
    		
    		</div>
    	</div>

  	</div>

  	<hr>
