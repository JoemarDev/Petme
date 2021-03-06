<?php require_once 'template.php'; ?>

<?php function getTitle(){
    echo "PET | Adopt A Pet";
} ?>

<?php function getMeta() { ?>
    <meta name="title" content="PETME | PETS">
    <meta name="description" content="We gather a lot of pet's who need a owner maybe your the parent of one of those pet.">
    <meta name="keywords" content="Pet,Adoption,PetCare,findpet">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="PETME">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">
    <meta property="og:title" content="PETME | PETS">
    <meta property="og:description" content="We gather a lot of pet's who need a owner maybe your the parent of one of those pet.">
    <meta property="og:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/petlist.jpeg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="//<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>">
    <meta property="twitter:title" content="PETME | PETS">
    <meta property="twitter:description" content="We gather a lot of pet's who need a owner maybe your the parent of one of those pet.">
    <meta property="twitter:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/petlist.jpeg">

<?php } ?>



<?php function getContent() { ?>

    <section class="page-title" style="background-image:url(assets/images/background/7.jpg)">
        <div class="container">
            <div class="clearfix">
                <div class="float-left">
                    <h1>Adopt a Pet</h1>
                </div>
                <div class="float-right bread-parent">
                    <ul class="page-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li>Adopt a Pet</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <section class="pets-box">
        <div class="container">
            <div class="inner-container" style="background-image:url(assets/images/background/11.png)">
                <h2><i class="icofont-paw text-dark" style="font-size: 30px;"></i> Find Your Pet</h2>
                <!-- Pets Form -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 px-3 mb-3">
                        <?php if (isset($_GET['type'])): ?>
                            <input type="text" class="w-100 type-input px-4" name="" value="<?php echo strtoupper($_GET['type']) ?>" readonly="">
                        <?php else: ?>
                            <input type="text" class="w-100 type-input px-4" name="" value="ALL" readonly="">
                        <?php endif ?>
                       
                        <div style="position: relative; width: 100%;">
                            <ul class="pet-type" style="display: none;">
                                <li class="border-top border-left border-right bg-white" data-animal="all">ALL</li>
                                <li class="border-top border-left border-right bg-white" data-animal="dog">DOG</li>
                                <li class="border-top border-left border-right bg-white" data-animal="cat">CAT</li>
                                <li class="border-top border-left border-right bg-white" data-animal="rabbit">RABBIT</li>
                                <li class="border-top border-left border-right bg-white" data-animal="bird">BIRDS</li>
                                <li class="border-top border-left border-right bg-white" data-animal="horse">HORSES</li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <form action="pet.php">
                            <input type="text" hidden="" name="type" value="ALL" class="type-input-form">
                            <button class="theme-btn btn-style-two w-100" type="submit" >Search Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pets-container mt-2">
        <div class="container">
            

            <?php 

                $animals = null;

                $page = 1;

                if (isset($_GET['page'])) {
                   $page = $_GET['page'];
                } 
                
                function initAnimals($page){
                    $curl = curl_init();

                    if ($page < 1) {
                        $page = 1;
                    }

                    if (isset($_GET['type'])) {
                        if ($_GET['type'] != 'all') {
                            $url = 'https://api.petfinder.com/v2/animals?page='.$page.'&type='.$_GET['type'];
                        } else {
                            $url = 'https://api.petfinder.com/v2/animals?page='.$page;
                        }
                    } else {
                        $url = 'https://api.petfinder.com/v2/animals?page='.$page;
                    }

                   
                    $token = $_COOKIE['API_TOKEN'];
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HTTPHEADER,[
                        'Authorization : Bearer '.$token,
                    ]);
                    $result = curl_exec($curl);
                    curl_close($curl);
                    $animals = json_decode($result);
                    return $animals;
                }

                // Check if TOKEN Exist Create one if none.
                require 'lib/Authenticate/createToken.php';

                if (empty($_COOKIE['API_TOKEN'])):
                    createToken();
                    echo ` <script>$('body').css('opacity' , 0);</script>`;
                    header("Refresh:0");
                else:
                    $animals = initAnimals($page);
                endif;
              

            ?>
            <?php 
                if (isset($animals->animals)) {
                    echo "<h2>We ‘ve These Great Pets for You, Ready to Adopt ...</h2>";
               }
             ?>

            <div class="row clearfix py-4">
                <?php if ($animals != null): ?>
                    <?php 

                        $length = 0;
                        if (isset($animals->animals)) {
                            $length = count($animals->animals);
                        }

                        ?>
                    <?php if ($length > 0) : ?>
                        <?php foreach ($animals->animals as $key): ?>
                            <!--Pets Block-->
                            <div class="col-md-4 col-lg-3 col-sm-6 col-6 mb-3 pet-card-parent">
                                <div class="pet-card w-100 shadow" >
                                        <!-- CHECK IF THE USER LIKED THE PET -->
                                        <?php if (isset($_SESSION['access_token'])): ?>
                                            <?php 
                                                require 'lib/connection.php';
                                                $petID = $key->id;
                                                $userID = $_SESSION['OAuthID'];
                                                $checkIfLiked = "SELECT * FROM userlikedpet WHERE petID = '$petID' AND userID = '$userID'";
                                                $results = mysqli_query($conn,$checkIfLiked);
                                                if (mysqli_num_rows($results) > 0): ?>
                                                   
                                                <div class="unlove-pet love-pet-icon" data-pet-id="<?php echo $key->id ?>">
                                                    <img src="assets/images/icon/heart-on.svg" >
                                                </div>

                                            <?php else: ?>

                                                <div class="love-pet love-pet-icon" data-pet-id="<?php echo $key->id ?>">
                                                    <img src="assets/images/icon/heart-off.svg" >
                                                </div>

                                            <?php endif;?>

                                        <?php else: ?>
                                            <div class="love-pet-icon" data-toggle="modal" data-target="#petLoginModal">
                                                <img src="assets/images/icon/heart-off.svg" >
                                            </div>
                                        <?php endif ?>
                                    
                                    <?php if (isset($key->primary_photo_cropped)) : ?>
                                        <img src="<?php echo $key->primary_photo_cropped->small ?>" alt="">
                                    <?php else: ?>
                                        <img src="assets/images/icon/dog-placeholder.gif" alt="" class="w-100" style="object-fit: contain;">
                                    <?php endif; ?>
                                    <div class="overlay ">
                                        <h3><?php echo ucfirst($key->name); ?></h3>
                                        <br>
                                        <ul>
                                            <li class="m-2"><img src="assets/images/icon/dot.svg" class="icon"><?php echo $key->age; ?></li>
                                            <li class="m-2"><img src="assets/images/icon/dot.svg" class="icon"><?php echo $key->gender; ?> </li>
                                            <li class="m-2"><img src="assets/images/icon/dot.svg" class="icon"><?php echo $key->size; ?> </li>
                                        </ul>
                                        <a href="viewpet.php?petID=<?php echo $key->id ?>">
                                            <button style="position: relative; top: 30px;" class="theme-btn btn-style-three">View Pet</button>
                                        </a>    
                                    </div>
                                </div>
                            </div> 
                        <?php endforeach ?>
                    <?php else: ?>

                        <div class="w-100 py-5 text-center">
                             <img src="assets/images/icon/dog.svg" alt="" class="img-fluid" style="object-fit: contain;">
                             <h2>Sorry we can't find what you looking for :(</h2>
                        </div>

                    <?php endif; ?>

                   
            <?php endif; ?>
        </div>

       
        </div>
    </section>


    <?php if (isset($animals->animals)): ?>
        <div class="container text-center w-100 d-md-block d-sm-none d-none">
                
            <div class="pagination">
                <?php 
                    if ($page % 10 != 0) {
                        $jump = floor($page / 10);
                    } else {
                        $jump = floor($page / 10) - 1;
                    }
                    $start = ($jump * 10) + 1;
                    $limit = (1 + $jump) * 10;

                    $type = '';

                    if (isset($_GET['type'])) {
                        $type = '&type='.$_GET['type'];
                    }
                 ?>
              <?php if ($jump > 0): ?>
                  <a href="pets/<?php echo $start - 10; ?><?php echo $type; ?>">&laquo;</a>
              <?php endif ?>
              
               <?php for ($i = $start; $i <=  $limit; $i++) : ?>
                    <?php if ($page == $i): ?>
                        <a class="active" href="pets/<?php echo $i ?><?php echo $type; ?>"><?php echo $i ?></a>
                    <?php else: ?>
                        <a href="pets/<?php echo $i ?><?php echo $type; ?>"><?php echo $i ?></a>    
                    <?php endif ?>
               <?php endfor; ?>

              <a href="pets/<?php echo $limit + 1; ?><?php echo $type; ?>">&raquo;</a>
            </div>
        </div>


        <div class="container text-center w-100 d-block d-md-none d-sm-block">
                
            <div class="pagination">
                <?php 
                    if ($page % 5 != 0) {
                        $jump = floor($page / 5);
                    } else {
                        $jump = floor($page / 5) - 1;
                    }
                    $start = ($jump * 5) + 1;
                    $limit = (1 + $jump) * 5;

                    $type = '';

                    if (isset($_GET['type'])) {
                        $type = '&type='.$_GET['type'];
                    }
                 ?>
              <?php if ($jump > 0): ?>
                  <a href="pets/<?php echo $start - 5; ?><?php echo $type; ?>">&laquo;</a>
              <?php endif ?>
              
               <?php for ($i = $start; $i <=  $limit; $i++) : ?>
                    <?php if ($page == $i): ?>
                        <a class="active" href="pets/<?php echo $i ?><?php echo $type; ?>"><?php echo $i ?></a>
                    <?php else: ?>
                        <a href="pets/<?php echo $i ?><?php echo $type; ?>"><?php echo $i ?></a>    
                    <?php endif ?>
               <?php endfor; ?>

              <a href="pets/<?php echo $limit + 1; ?><?php echo $type; ?>">&raquo;</a>
            </div>
        </div>

     <?php endif;?>


    
    <?php require_once 'partials/footer/footer.php' ?>
<?php } ?>


<script type="text/javascript">
    $('.header-menu').find('li').eq(1).addClass('active')
</script>
<!-- 
<div class="row py-3">
    
    
    <div class="col-md-4 col-lg-3 col-sm-6 col-6">
        <div class="pet-card w-100 shadow-sm" >
            <div class="love-pet">
                <img src="assets/images/icon/heart-off.svg" >
            </div>
            <img src="https://dl5zpyw5k3jeb.cloudfront.net/photos/pets/49886147/1/?bust=1606284860">
            <div class="overlay">
                <h3>Puta </h3>
                <br>
                <ul>
                    <li class="m-2"><img src="assets/images/icon/dot.svg" class="icon">Baby</li>
                    <li class="m-2"><img src="assets/images/icon/dot.svg" class="icon">Female</li>
                    <li class="m-2"><img src="assets/images/icon/dot.svg" class="icon">Big</li>
                </ul>
                <button style="position: relative; top: 30px;" class="theme-btn btn-style-three">View Pet</button>
            </div>
        </div>
    </div>
</div> -->