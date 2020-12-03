<?php 
	$petID = $key['petID'];
	$getPetInfo = "SELECT * FROM likedpet WHERE petID = '$petID'";
	$petRes = mysqli_query($conn,$getPetInfo);
	$petRes = mysqli_fetch_assoc($petRes);

	$pet_uns = unserialize($petRes['petObject']);
 ?>

<div class=" p-2">
 	
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
			Comment on pet
			 
		<small style="float: right;">
			<?php echo time_elapsed_string($key['date']) ?>
		</small>
	</label>
	<div class="card my-2 shadow-sm" style="background: url(assets/images/home/image-3.png);">

	  	<div class="card-body activity-image-card row p-1">
	  		<div class="col-sm-3 col-5 align-self-center">
	  			
		  		<?php if (isset($pet_uns->animal->photos[0])): ?>
		  			<img src="<?php echo $pet_uns->animal->photos[0]->medium ?>">
		  		<?php else: ?>
		  			<img src="assets/images/icon/dog-placeholder.gif">
		  		<?php endif ?>
	  		</div>

	  		<div class="col-sm-9 col-7 align-self-center">
	  			<h3><?php echo $pet_uns->animal->name ?></h3>
	  			<label style="max-width: 90%; padding: 10px; background: #630abb;color :#fff; font-weight : 600; border-radius: 5px; position: relative;">
	  				<?php echo $key['comment'] ?>
	  					<div style="height: 20px; width: 20px; position: absolute; left: 15px; background: #630abb; transform: rotate(226deg); z-index: 0px;"></div>
	  				</label>
	  		</div>
	    	
	  	</div>
	</div>

</div>
<hr>