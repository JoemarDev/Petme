
<?php require_once 'template.php'; ?>

<?php function getTitle(){
    echo "Blogs | PET ME";
} ?>

<?php function getMeta() { ?>
    <meta name="title" content="Blogs | PET ME">
    <meta name="description" content="Read our daily article all about pets, How,What,When ? All about your pet is here.">
    <meta name="keywords" content="Pet,Adoption,PetCare,findpet">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="PETME">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="//petme.cf">
    <meta property="og:title" content="Blogs | PET ME">
    <meta property="og:description" content="Read our daily article all about pets, How,What,When ? All about your pet is here.">
    <meta property="og:image" content="assets/images/logo/petlogo.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="//petme.cf">
    <meta property="twitter:title" content="Blogs | PET ME">
    <meta property="twitter:description" content="Read our daily article all about pets, How,What,When ? All about your pet is here.">
    <meta property="twitter:image" content="assets/images/logo/petlogo.png">

<?php } ?>

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
                $fetch_blog = "SELECT * FROM blog ORDER by id DESC";
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
                                <a href="read.php?article=<?php echo $row['seoTitle'] ?>"><img class="w-100" style="height: 350px; object-fit: cover;" src="<?php echo $image ?>" alt="Image for <?php echo $row['title'] ?>"></a>
                            </div>
                            <div class="lower-content">
                                <ul class="news-info">
                                    <li>Article By <?php echo $row['writer'] ?></li>
                                    <li><?php echo $row['commentCount'] ?> Comment</li>
                                    <li><?php echo $row['likeCount'] ?> Liked</li>
                                </ul>
                                <h3><a href="read.php?article=<?php echo $row['seoTitle'] ?>"><?php echo $row['title'] ?></a></h3>
      
                                <small class="mb-4" style="display: block;"><?php echo $row['description']. '...'; ?> </small>
                                <a href="read.php?article=<?php echo $row['seoTitle'] ?>" class="theme-btn btn-style-two">Read More</a>
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
    $('.header-menu').find('li').eq(2).addClass('active')
</script>

