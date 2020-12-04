
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
    <meta property="og:url" content="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
    <meta property="og:title" content="Blogs | PET ME">
    <meta property="og:description" content="Read our daily article all about pets, How,What,When ? All about your pet is here.">
    <meta property="og:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/logo/petlogo.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
    <meta property="twitter:title" content="Blogs | PET ME">
    <meta property="twitter:description" content="Read our daily article all about pets, How,What,When ? All about your pet is here.">
    <meta property="twitter:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/logo/petlogo.png">

<?php } ?>

<?php function getContent() { ?>
    <?php 
        require 'vendor/autoload.php';
        require 'lib/blog-endpoint/cloud-config.php'; ?>
<!--     <section class="page-title" style="background-image:url(assets/images/background/7.jpg)">
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
 -->

 <style>

 </style>

 <div class="blog-wrapper" >  

    <div class="blog-banner">
        <h1 style="">Want to write a article about pets ?</h1>
        <?php if (isset($_SESSION['access_token'])): ?>
            <button class="theme-btn btn-style-five mt-3" onclick="location.href ='write.php'">Write Article</button>
        <?php else: ?>
            <button class="theme-btn btn-style-five mt-3" data-toggle="modal" data-target="#petLoginModal">Write Article</button>
        <?php endif ?>
       
    </div>

    <div class="videoBanner-overlay" style=""></div>
    <video style="" autoplay="" muted="" loop="" playsinline="" >
        <source src="assets/video/blogVids.mp4">
    </video>

 </div>

    <div class="container py-2 shadow sm pet-blog-wrapper p-5" style="background : #fff; background:url('assets/images/home/image-3.png'); z-index: 500; border-top-left-radius: 20px; border-top-right-radius: 20px; position: relative;">
        <div class="w-100 text-center py-5">
            <h2>Read Some Article About Pet's</h2>
        </div> 

        <div class="row mt-4" >
        
            <?php 

                require 'lib/connection.php';
                $page = 0;
                $limit = 9;

                if (isset($_GET['page'])) {

                    if ($_GET['page'] < 1) {
                        $page = 0;
                    }  else {
                        $page = $_GET['page'] - 1;
                    }         
                }

                $skip = $page * $limit;

                $fetch_blog = "SELECT * FROM blog ORDER by id DESC LIMIT  $skip , $limit";

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
                            <div class="image" style="border-radius: 10px;">
                                <?php 
                                    $date = strtotime($row['date']);
                                 ?>
                                <div class="post-date"><?php echo date('d',$date) ?> <span><?php echo date('M',$date) ?></span></div>
                                <a href="blog/<?php echo $row['seoTitle'] ?>"><img class="w-100" style="height: 350px; object-fit: cover; border-radius: 10px;" src="<?php echo $image ?>" alt="Image for <?php echo $row['title'] ?>"></a>
                            </div>
                            <div class="lower-content">
                                <ul class="news-info">
                                    <li>Article By <a href="user/<?php echo $row['writer_id'] ?>"><?php echo $row['writer'] ?></a></li>
                                    <?php 
                                      // $postContent = render($content); 
                                      $word = str_word_count(strip_tags($row['content']));
                                      $m = floor($word / 200);
                                      $s = floor($word % 200 / (200 / 60));
                                      $est = $m . ' minute' . ($m == 1 ? '' : 's') . ', ' . $s . ' second' . ($s == 1 ? '' : 's');
                                    ?>
                                    <li><i class="icofont-read-book"></i> <?php echo $est; ?></li>
                                </ul>
                                <h3 style="width: 100%; overflow: hidden;"><a href="blog/<?php echo $row['seoTitle'] ?>"><?php echo $row['title'] ?></a></h3>
      
                                <small class="mb-4" style="display: block;"><?php echo $row['description']. '...'; ?> </small>
                                <a href="blog/<?php echo $row['seoTitle'] ?>" class="theme-btn btn-style-two">Read More</a>
                            </div>
                        </div>
                    </div>

            <?php endwhile; ?>  
           
            

        </div>

        <div class="w-100 text-center">
        <?php 
            $blogP = "SELECT * FROM blog";
            $blogPage = mysqli_query($conn,$blogP) or die(mysqli_error($conn));
            $total = ceil(mysqli_num_rows($blogPage) / $limit);



            // if ($page + $page_limit ) {
                
            // }

            // if ($total <= $page_limit) {
            //     $page_limit = $total;
            // }

            $page += 1;

            if ($page % 10 != 0) {
                $jump = floor($page / 10);
            } else {
                $jump = floor($page / 10) - 1;
            }

            $start = ($jump * 10) + 1;

            $page_limit = (1 + $jump) * 10;

            $haveNext = false;
            $havePrev = false;

            if ($page_limit < $total) {
                $haveNext = true;
            }

            if ($page > 10) {
                $havePrev = true;
            }
            
         ?>
           <div class="pagination">

            <?php if ($havePrev): ?>
                <a href="blog?page=<?php echo $page_limit - 10 ?>"><</a>
            <?php endif ?>

            <?php if ($haveNext): ?>
                <?php for ($i = $start; $i <=  $page_limit; $i++) : ?>
                    <?php if ($i == $page): ?>
                            <a class="active" href="blog?page=<?php echo $i ?>"><?php echo $i ?></a>  
                        <?php else: ?>  
                            <a  href="blog?page=<?php echo $i ?>"><?php echo $i ?></a>  
                    <?php endif ?>
                    
                <?php endfor; ?>
            <?php else: ?>
                <?php for ($i = $start; $i <=  $total; $i++) : ?>
                         <?php if ($i == $page): ?>
                            <a class="active" href="blog?page=<?php echo $i ?>"><?php echo $i ?></a>  
                        <?php else: ?>  
                            <a  href="blog?page=<?php echo $i ?>"><?php echo $i ?></a>  
                    <?php endif ?>
                <?php endfor; ?>
            <?php endif ?>

       
           <?php if ($haveNext): ?>
                <a href="blog?page=<?php echo $page_limit + 1 ?>">»</a>
           <?php endif ?>

            </div>
        </div>



            <hr>

        <?php require_once 'partials/footer/footer.php' ?>
    </div>


<?php } ?>


<script type="text/javascript">
    $('.header-menu').find('li').eq(2).addClass('active')
</script>

