<?php require_once 'template.php'; ?>

<?php function getTitle(){
    echo "Blogs | PET ME";
} ?>

<?php function getContent() { ?>
    <?php 
        require 'vendor/autoload.php';
        require 'lib/blog-endpoint/cloud-config.php'; ?>
    <section class="page-title" style="background-image:url(assets/images/background/7.jpg)">
        <div class="container">
            <div class="clearfix">
                <div class="float-left">
                    <h1>Pet Blog</h1>
                </div>
                <div class="float-right bread-parent">
                    <ul class="page-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li>Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        
        <div class="row mt-5">
            <?php 

                require 'lib/connection.php';
                $fetch_blog = "SELECT * FROM blog";
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
                        <div class="inner-box wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="0ms">
                            <div class="image">
                                <div class="post-date">25 <span>Feb</span></div>
                                <a href="#"><img class="w-100" style="height: 350px; object-fit: cover;" src="<?php echo $image ?>" alt="Image for <?php echo $row['title'] ?>"></a>
                            </div>
                            <div class="lower-content">
                                <ul class="news-info">
                                    <li>Article By <?php echo $row['writer'] ?></li>
                                    <li><?php echo $row['commentCount'] ?> Comment</li>
                                    <li><?php echo $row['likeCount'] ?> Liked</li>
                                </ul>
                                <h3><a href="#"><?php echo $row['title'] ?></a></h3>
                                <?php 
                                    // strip the base 64 image from the content to produce short description
                                    $desc = preg_replace("/<img[^>]+\>/i", "", $row['content']);
                                 ?>
                                <small class="mb-4" style="display: block;"><?php echo substr($desc, 0, 200) . '...'; ?> </small>
                                <a href="/" class="theme-btn btn-style-two">Read More</a>
                            </div>
                        </div>
                    </div>

            <?php endwhile; ?>
           


        </div>

            <hr>

        <?php require_once 'partials/footer/footer.php' ?>
    </div>


<?php } ?>


<script type="text/javascript">
    $('.header-menu').find('li').eq(3).addClass('active')
</script>