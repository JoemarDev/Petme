<?php require_once 'template.php'; ?>

<?php function getTitle(){
    echo "Blogs | PET ME";
} ?>

<?php function getContent() { ?>
    <?php 
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
           
            <div class="col-md-8 blog-read">
                <?php 
                    require 'lib/connection.php';
                    $title = $_GET['article'];
                    $sql = "SELECT * FROM blog WHERE seoTitle = '$title'";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                    $result = mysqli_fetch_assoc($result);
                 ?>

                 <img src="<?php echo $result['image'] ?>" class="w-100" style ="max-height: 400px; object-fit: cover;">
                 <div class="title-box">
                    <div class="float-right" >
                        <div class="dropdown" style="z-index: 50;">
                          <button style="background: none; border:none;" class="btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="modify.php?id=<?php echo $result['id']; ?>"><strong> Modify </strong> </a>
                            <a class="dropdown-item" href="#"><strong> Remove </strong></a>
                          </div>
                        </div>
                    </div>
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
            </div>
            <div class="col-md-4">
                
            </div> 

        </div>

        <hr>

        <?php require_once 'partials/footer/footer.php' ?>
    </div>


<?php } ?>


<script type="text/javascript">
    $('.header-menu').find('li').eq(3).addClass('active')
</script>