<section class="news-section" style="background-image: url(assets/images/background/5.jpg);">
		<div class="container">
			<div class="sec-title text-center">
	            <div class="separator">
	                <span class="icon"><i class="icofont-paw"></i></span>
	            </div>
	            <div class="title">Read Some Intersting Article About Pet's</div>
	            <h2>Read Our Blog</h2>

	            <div class="row mt-5">
	            	<?php 

                        require 'lib/connection.php';
                        $fetch_blog = "SELECT * FROM blog  ORDER BY RAND() DESC LIMIT 3";
                        $blogs = mysqli_query($conn,$fetch_blog) or die(mysqli_error($conn));

                        while ($row = mysqli_fetch_assoc($blogs)): ?>
                            <?php 
                                // Check if the post is have main image
                                if ($row['image'] == null) {
                                    $image = 'assets/images/background/blog-place-holder.jpg';
                                } else {
                                    $image = $row['image'];
                                }
                             ?>
                            <div class="news-block col-md-4 col-sm-6 col-xs-12">
                                <div class="inner-box " >
                                    <div class="image">
                                        <?php 
                                            $date = strtotime($row['date']);
                                         ?>
                                        <div class="post-date"><?php echo date('d',$date) ?> <span><?php echo date('M',$date) ?></span></div>
                                        <a href="read.php?article=<?php echo seoUrl($row['title']) ?>"><img class="w-100" style="height: 350px; object-fit: cover;" src="<?php echo $image ?>" alt="Image for <?php echo $row['title'] ?>"></a>
                                    </div>
                                    <div class="lower-content" onclick="location.href='read.php?article=<?php echo seoUrl($row['title']) ?>'">
                                        <ul class="news-info">
                                            <li>Article By <?php echo $row['writer'] ?></li>
                                            <li><?php echo $row['commentCount'] ?> Comment</li>
                                            <li><?php echo $row['likeCount'] ?> Liked</li>
                                        </ul>
                                        <h3><a href="#"><?php echo $row['title'] ?></a></h3>
                    
                                        <small class="mb-4" style="display: block;"><?php echo $row['description']. '...'; ?> </small>
                                        <a href="read.php?article=<?php echo seoUrl($row['title']) ?>" class="read-more">Read More</a>
                                    </div>
                                </div>
                            </div>

                    <?php endwhile; ?>
                    
	            </div>
	        </div>


		</div>
	</section>
