<?php require_once 'template.php'; ?>



<?php function getTitle(){
    require 'lib/connection.php';
    $title = $_GET['article'];
    $meta = "SELECT * FROM blog WHERE seoTitle = '$title'";
    $metaRes = mysqli_query($conn,$meta) or die(mysqli_error($conn));
    $metaRes = mysqli_fetch_assoc($metaRes);
    echo 'PETME | '.$metaRes['title'];
} ?>


<?php function getMeta() { ?>

    <?php 
        require 'lib/connection.php';
        $title = $_GET['article'];
        $meta = "SELECT * FROM blog WHERE seoTitle = '$title'";
        $metaRes = mysqli_query($conn,$meta) or die(mysqli_error($conn));
        $metaRes = mysqli_fetch_assoc($metaRes);

        $fullLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
     ?>

    <meta name="title" content="PETME | <?php echo $metaRes['title']; ?>">
    <meta name="description" content="<?php echo $metaRes['description']; ?>">
    <meta name="keywords" content="Pet,Adoption,PetCare,findpet">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="PETME">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $fullLink; ?>">
    <meta property="og:title" content="PETME | <?php echo $metaRes['title']; ?>">
    <meta property="og:description" content="<?php echo $metaRes['description']; ?>">
    <?php if ($metaRes['image'] != null): ?>
        <meta property="og:image" content="<?php echo $metaRes['image'] ?>">
    <?php else: ?>
        <meta property="og:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/background/blog-place-holder.jpg">
    <?php endif ?>    

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo $fullLink; ?>">
    <meta property="twitter:title" content="PETME | <?php echo $metaRes['title']; ?>">
    <meta property="twitter:description" content="<?php echo $metaRes['description']; ?>">
    <?php if ($metaRes['image'] != null): ?>
        <meta property="twitter:image" content="<?php echo $metaRes['image'] ?>">
    <?php else: ?>
        <meta property="twitter:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/background/blog-place-holder.jpg">
    <?php endif ?>


<?php } ?>


<?php function getContent() { ?>
    <?php 


        function seoUrl($string) {
            //Lower case everything
            $string = strtolower($string);
            //Make alphanumeric (removes all other characters)
            $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
            //Clean up multiple dashes or whitespaces
            $string = preg_replace("/[\s-]+/", " ", $string);
            //Convert whitespaces and underscore to dash
            $string = preg_replace("/[\s_]/", "-", $string);
            return $string;
        }

        require 'vendor/autoload.php';
        require 'lib/blog-endpoint/cloud-config.php';
    ?>
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
               $title = $_GET['article'];
               $sql = "SELECT * FROM blog WHERE seoTitle = '$title'";
               $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
               $result = mysqli_fetch_assoc($result);
            ?>
            <?php if (isset($result)): ?>
              
            <div class="col-xl-9 col-md-12 blog-read mb-3">
                

                 <?php if ($result['image'] != null): ?>
                     <img src="<?php echo $result['image'] ?>" class="w-100 mb-5" style ="max-height: 400px; object-fit: cover;">
                 <?php endif ?>
                
                 <div class="title-box">
                    <?php if (isset($_SESSION['access_token'])): ?>
                       
                        <?php if ($_SESSION['OAuthID'] == $result['writer_id']): ?>
     
                            <div class="float-right" >
                                <div class="dropdown" style="z-index: 50;">
                                  <button style="background: none; border:none;" class="btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="modify.php?id=<?php echo $result['id']; ?>"><strong> Modify </strong> </a>
                                    <a class="dropdown-item" href="lib/blog-endpoint/destroy-blog.php?articleID=<?php echo $result['id']; ?>"><strong> Remove </strong></a>
                                  </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                    <?php 
                        $date = strtotime($result['date']);
                     ?>
                    <div class="date-box"><?php echo date('d',$date) ?> <span><?php echo date('M',$date) ?></span></div>
                    <h3><?php echo $result['title'] ?></h3>
                    <ul class="post-meta">
                        <li>By <?php echo $result['writer'] ?></li>
                        <li><?php echo $result['commentCount'] ?> Comments</li>
                        <li><span class="icon icofont-heart-alt"></span>  <?php echo $result['likeCount'] ?></li>
                    </ul>
                </div>
                <div class="content fr-view">
                    <?php echo $result['content']; ?>
                </div>
                <div class="post-share-options clearfix">
                    <div class="float-left">
                        <h2 style="position: relative; top: -5px;">Comments</h2>
                    </div>
                    <div class="float-right social-icon-four clearfix">
                        <span class="share">Share</span>
                        <?php 
                            $shareLink = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                         ?>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo $shareLink ?>" target="#_share"><span class="icofont-twitter"></span></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareLink ?>" target="#_share"><span class="icofont-facebook"></span></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $shareLink ?>" target="#_share"><span class="icofont-linkedin"></span></a>
                        <a href="https://plus.google.com/share?url=<?php echo $shareLink ?>" target="#_share"><span class="icofont-google-plus"></span></a>
                    </div>
                </div>

                <!-- COMMENTS -->
                <div class="comments-area">

                    <!--Comment Box-->
                    <div class="comment-list py-2">
                       <small class="ml-3">No comment here yet.</small>
                       <!--  <div class="comment-box">
                            <div class="comment">
                                <div class="author-thumb"><img src="#" alt=""></div>
                                <div class="comment-inner">
                                    <div class="comment-info clearfix"><strong>Cindy Cambell</strong>
                                        <div class="comment-time">march 31, 2019</div>
                                    </div>
                                    <div class="text">And one into considering ahead yet tepid far oriole pointed wildebeest jeepers contrary circa hello rolled alas goldfinch less apt wherever suitably.</div>
                                    <a class="comment-reply" href="#">Reply</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- COMMENT -->
                <?php if (isset($_SESSION['OAuthID'])): ?>
                    <div class="comment-form">
                        <div class="group-title">
                            <h2>Leave Reply</h2>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <textarea name="message" placeholder="Comments" id="blog-comment"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                <button class="theme-btn btn-style-four" id="submit-blog-comment" value="<?php echo $result['id']; ?>">leave a comment</button>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <button class="theme-btn btn-style-five py-2" data-toggle="modal" data-target="#petLoginModal">Leave a comment</button>
                   
                <?php endif ?>
               
            </div>

            <div class="col-xl-3 col-md-12 mb-3">
                
                <div class="card p-2 text-white" style="background:#e7470c;">
                    <label class="m-0"><strong>Other Articles</strong></label>
                </div>
                <div class="row w-100 m-0 mt-2 popular-posts">
                    <?php 

                        $recentList = "SELECT * FROM blog WHERE seoTitle != '$title' ORDER BY RAND() DESC LIMIT 4";
                        $resList = mysqli_query($conn,$recentList) or die(mysqli_error($conn));

                        while ($blog_object = mysqli_fetch_assoc($resList)): ?>

                            <?php $blog_date = strtotime($blog_object['date']); ?>


                            <div class="col-12 p-1">
                               <article class="post">
                                    <figure class="post-thumb">
                                        <a href="blog/<?php echo $blog_object['seoTitle'] ?>">
                                            <?php if ($blog_object['image'] != null): ?>
                                                <img src="<?php echo $blog_object['image'] ?>" alt="Image for <?php echo $blog_object['title'] ?>">
                                            <?php else: ?>
                                                <img src="assets/images/background/blog-place-holder.jpg" alt="Image for <?php echo $blog_object['title'] ?>">
                                            <?php endif ?>
                                            
                                        </a>
                                    </figure>
                                    <div class="text"><a href="blog/<?php echo $blog_object['seoTitle'] ?>"><?php echo $blog_object['title'] ?></a></div>
                                    <div class="post-info"><?php echo date('M',$blog_date) ?> <?php echo date('d',$blog_date) ?>  <?php echo date('Y',$blog_date) ?></div>
                                  
                                </article>
                            </div>
                            
                        <?php endwhile; ?>
                    
                </div>

                <div class="card p-2 text-white " style="background:#630abb;">
                    <label class="m-0"><strong>For Adoptions</strong></label>
                </div>
                <div class="row w-100 m-0 mt-2 liked-gallery">
                    <?php 

                        $listPet = "SELECT * FROM likedpet ORDER BY RAND() LIMIT 6";
                        $list = mysqli_query($conn,$listPet) or die(mysqli_error($conn));

                        while ($pet_object = mysqli_fetch_assoc($list)): ?>
                            <?php 
                                $pet_unserialized = unserialize($pet_object['petObject']);
                             ?>

                            <div class="col-md-4 col-sm-6 col-6 col-xl-6 p-1">
                                <a target="_blank" href="pets/<?php echo seoUrl($pet_unserialized->animal->name) ?>/save-<?php echo $pet_object['petID'] ?>">
                                    <?php if (isset($pet_unserialized->animal->primary_photo_cropped->full)): ?>
                                        <img class="w-100" src="<?php echo $pet_unserialized->animal->primary_photo_cropped->full ?>" alt="Card image cap" style="height: 120px; object-fit: cover;">
                                    <?php else: ?>
                                        <img class="w-100" src="assets/images/icon/dog-placeholder.gif" alt="Card image cap" style="height: 120px; object-fit: contain;">
                                    <?php endif ?>
                                </a>
                            </div>
                            
                        <?php endwhile; ?>
                    

                   
            </div> 
            <img src="https://st3.depositphotos.com/8992804/32494/v/950/depositphotos_324940358-stock-illustration-postcard-with-dogs-of-different.jpg" class="w-100 mt-2">

        </div>
            <?php else: ?>
               
               <div class="w-100 py-5 text-center">
                    <img src="assets/images/icon/dog.svg" alt="" class="img-fluid" style="object-fit: contain;">
                    <h2>Sorry we can't find what you looking for :(</h2>
               </div>
        <?php endif ?>


       


        <?php require_once 'partials/footer/footer.php' ?>
    </div>


<?php } ?>

<script type="text/javascript">
    loadBlogComment($('#submit-blog-comment').val())
    $('.header-menu').find('li').eq(2).addClass('active');
</script>

