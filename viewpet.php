<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "PETME | Pet Information";
} ?>

<?php function getMeta() { ?>

    <meta name="keywords" content="Pet,Adoption,PetCare,findpet">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="PETME">
    <?php $fullLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>

    <?php if (isset($_GET['petID'])): ?>
        <?php if (substr($_GET['petID'],0,5) == 'save-'): ?>
            <?php 
                require 'lib/connection.php';
                $trimID = substr($_GET['petID'],5);

                $sql = "SELECT * FROM likedpet WHERE petID = '$trimID'";
                $metaRes = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                $metaRes = mysqli_fetch_assoc($metaRes);

                $petMeta = unserialize($metaRes['petObject']);
             ?>
            <!-- Open Graph / Facebook -->

            <meta name="title" content="PETME | Meet <?php echo $petMeta->animal->name ?>">
            <meta name="description" content="<?php echo $petMeta->animal->description ?>">
            <meta property="og:type" content="website">
            <meta property="og:url" content="//petme.cf">
            <meta property="og:title" content="PETME | Meet <?php echo $petMeta->animal->name ?>">
            <meta property="og:description" content="<?php echo $petMeta->animal->description ?>">
            <meta property="og:image" content="<?php echo $petMeta ->animal->photos[0]->full ?>">

            <!-- Twitter -->
            <meta property="twitter:card" content="summary_large_image">
            <meta property="twitter:url" content="//petme.cf">
            <meta property="twitter:title" content="PETME | Meet <?php echo $petMeta->animal->name; ?>">
            <meta property="twitter:description" content="<?php echo $petMeta->animal->description; ?>">
            <meta property="twitter:image" content="<?php echo $petMeta ->animal->photos[0]->full; ?>">
        <?php else: ?> 
            <meta name="title" content="PETME | PETS">
            <meta name="description" content="<?php echo $petMeta->animal->description ?>">
           <!-- Open Graph / Facebook -->
             <meta property="og:type" content="website">
             <meta property="og:url" content="//petme.cf">
             <meta property="og:title" content="We gather a lot of pet's who need a owner maybe your the parent of one of those pet.">
             <meta property="og:description" content="We gather a lot of pet's who need a owner maybe your the parent of one of those pet.">
             <meta property="og:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/petlist.jpeg">

             <!-- Twitter -->
             <meta property="twitter:card" content="summary_large_image">
             <meta property="twitter:url" content="//petme.cf">
             <meta property="twitter:title" content="PETME | PETS">
             <meta property="twitter:description" content="We gather a lot of pet's who need a owner maybe your the parent of one of those pet.">
             <meta property="twitter:image" content="//<?php echo $_SERVER['HTTP_HOST'] ?>/assets/images/petlist.jpeg">
        <?php endif; ?>
    <?php endif ?>
  


<?php } ?>



<?php function getContent() { ?>

    <?php 

        $animals = null;

        if (isset($_GET['petID'])):
            $petID = $_GET['petID'];

            // Check if the pet ID is exist in the databases
            $isSave = false;
            $trimPetID = '';
            $toBesave = true;

            if (substr($petID,0,5) == 'save-') {
               $isSave = true;
               $trimID = substr($petID,5);
               $toBesave = false;
            }

            function petInfo($id){
                $curl = curl_init();
                $url = 'https://api.petfinder.com/v2/animals/'.$id;
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

            function valueCheck($str) {
                if (strlen($str) > 0 AND $str != null) {
                    return $str;
                } else {
                    return "Not Available";
                }
            }

            function boolAttr($res){
                if ($res) {
                    return "Yes";
                } else {
                    return "No";
                }
            }
 
            if ($isSave) {
                // If the pet info is exist then fetch from the database

                require 'lib/connection.php';
                $sql = "SELECT * FROM likedpet WHERE petID = '$trimID'";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
                $result = mysqli_fetch_assoc($result);

                $pet = unserialize($result['petObject']);
            } else {     


                // Check if TOKEN Exist Create one if none.
                require 'lib/Authenticate/createToken.php';

                // if not exist in the database fetch from the API
                if (empty($_COOKIE['API_TOKEN'])):
                    createToken();
                    header("Refresh:0");
                else:
                    $pet = petInfo($petID);
                endif;
            }
        endif;

      
    ?>

    <section class="page-title" style="background-image:url(assets/images/background/7.jpg)">
        <div class="container">
            <div class="clearfix">
                <div class="float-left">
                    <h1 style="font-weight: 600;">Pet Information</h1>
                </div>
                <div class="float-right bread-parent">
                    <ul class="page-breadcrumb ">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="pet.php">Pets</a></li>
                        <li>Pet Information</li>
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
    

    <?php if (isset($pet->animal)): ?>

        <section class="pet-image" id="petcontainer" data-animal-id='<?php echo $pet->animal->id ?>'>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12" style="position: relative; ">
                        <?php 
                            $photo = $pet->animal->photos;
                            $photoLen = count($photo);
                         ?>

                         <?php if ($photoLen > 0): ?>
                             <div class="owl-carousel-view owl-carousel" style="display: block; border-bottom: 3px solid #e5a62d; ">
                                
                                  <?php for ($i=0; $i < count($photo); $i++) : ?>
                                         <div class="item">
                                            <img src="<?php echo $photo[$i]->full ?>" class="img-fluid" alt="Image of <?php echo $pet->animal->name ?>" style="height: 400px; object-fit: cover;">
                                         </div>
                                 <?php  endfor; ?>
                                
                             </div>

                             <ul id='carousel-custom-dots' class='owl-dots d-flex w-100 mt-3'> 
                                  <?php for ($i=0; $i < count($photo); $i++) : ?>
                                        <li class='owl-dot'> <img src="<?php echo $photo[$i]->small ?>" class="w-100" alt="Image of <?php echo $pet->animal->name ?> navigation"></li> 
                                 <?php  endfor; ?>
                             </ul>

                             <button class="owl-control view-prev"><img src="assets/images/icon/left.png" style="width: 40px;"></button>
                             <button class="owl-control view-next"><img src="assets/images/icon/right.png" style="width: 40px;"></button>

                        <?php else: ?>
                            <h3>Unfortunately <?php echo $pet->animal->name ?> is a camera shy.</h3>
                            <img src="assets/images/background/novideo.jpg" class="w-100" style="opacity: 0.2">
                         <?php endif ?>

                        
                        <?php 
                            $video = $pet->animal->videos;
                            $videoLen = count($video);
                         ?>

                         <?php if ($videoLen > 0): ?>
                            <style type="text/css">
                                .haveVideo iframe {
                                    width: 100%;
                                    height: 500px;
                                }
                            </style>
                            <div class="haveVideo">  
                               <h3 class="mt-5">Some awesome moments with <?php echo $pet->animal->name ?>!</h3>
                               <?php for ($v=0; $v < $videoLen; $v++) : ?>
                                  <?php echo $video[$v]->embed; ?>
                               <?php endfor; ?>
                               <!-- preg_match('/src="([^"]+)"/', $iframe_string, $match);
                               $url = $match[1]; -->
                               <!-- <iframe src='https://www.youtube.com/embed/DnU5ryajwQY?autoplay=1' style="border:none; width: 100%; height: 400px;"></iframe> -->
                            </div>
                         <?php endif ?>

                         <hr style="background: #e5a62d; height: 2px;">

                        <?php require 'partials/comment/comment.php'; ?>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">

                        <div class="pet-block w-100">
                            
                             <div class="inner-box">
                                <div class="lower-content  py-0 pb-3">
                                    <div class="card py-3 px-4 shadow-sm" style="background:url('assets/images/home/image-2.jpg');">
                                        <h3 class="mt-3" style="font-weight: 300;">Hello im <strong><?php echo $pet->animal->name ?></strong></h3>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php if ($pet->animal->description == null): ?>
                                                    <p class="m-0" style="font-size: 14px;">Our friend here is a pet of mystery.</p>
                                                <?php else: ?>
                                                    <p class="m-0" style="font-size: 14px;"><?php echo $pet->animal->description ?></p>
                                                <?php endif ?>
                                              
                                            </div> 
                                            

                                            <div class="col-6 mt-3">
                                                <ul>
                                                    <li> Type : <strong><?php echo valueCheck($pet->animal->type) ?></strong></li>
                                                    <li> Species : <strong ><?php echo valueCheck($pet->animal->species) ?></strong></li>
                                                    <li> Coat : <strong ><?php echo valueCheck($pet->animal->coat) ?></strong></li>    
                                                </ul>
                                            </div> 
                                            <div class="col-6  mt-3">
                                                <ul>
                                                    <li> Age : <strong><?php echo valueCheck($pet->animal->age) ?></strong></li>
                                                    <li> Gender : <strong ><?php echo valueCheck($pet->animal->gender) ?></strong></li>
                                                    <li> Size : <strong ><?php echo valueCheck($pet->animal->size) ?></strong></li>    
                                                </ul>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="card px-4 py-3 mt-2 " style="background:url('assets/images/home/image-2.jpg'); background-size: cover; border-bottom: none; border-left: none; border-right: none;">
                                        <div class="row mt-3" >
                                        

                                            <div class="col-6 py-2">
                                                <label class="text-secondary"><strong>Breeds</strong></label>
                                                <ul>
                                                    <li> <small>Primary</small> <br> <strong> <?php echo $pet->animal->breeds->primary ?></strong></li>
                                                    <li> <small>Secondary </small>  <br> <strong><?php echo valueCheck($pet->animal->breeds->secondary); ?></strong></li>
                                                    <li> <small>Mixed </small>  <br><strong> <?php echo valueCheck($pet->animal->breeds->mixed); ?></strong></li>    
                                                </ul>
                                            </div> 
                                            <div class="col-6 py-2">
                                                <label class="text-secondary"><strong>Colors</strong></label>
                                                <ul>
                                                    <li>  <small>Primary</small>   <br><strong><?php echo valueCheck($pet->animal->colors->primary) ?></strong></li>
                                                    <li>  <small>Secondary</small>   <br><strong><?php echo valueCheck($pet->animal->colors->secondary) ?></strong></li>
                                                    <li>  <small>tertiary</small>  <br><strong><?php echo valueCheck($pet->animal->colors->tertiary) ?></strong></li>
                                                   
                                                </ul>
                                            </div> 

                                            <div class="col-6 py-2">
                                                <label class="text-secondary"><strong>Traits</strong></label>
                                                <ul>
                                                    <?php 
                                                        $traits = $pet->animal->tags;
                                                        $traitsLen = count($traits);
                                                     ?>
                                                     <?php if ($traitsLen > 0): ?>
                                                        <?php for ($t=0; $t < $traitsLen; $t++) : ?>
                                                            <li> <strong><?php echo $traits[$t] ?></strong></li>
                                                        <?php endfor; ?>
                                                    <?php else: ?>
                                                            <li><strong>Not Available</strong></li>
                                                     <?php endif ?>
                                                    
                                                </ul>
                                            </div> 
                                            <div class="col-6 py-2">
                                                <label class="text-secondary"><strong>Attributes</strong></label>
                                                <ul>
                                                    <li>  S-Neutered: <strong><?php echo boolAttr($pet->animal->attributes->spayed_neutered) ?></strong></li>
                                                    <li>  House Trained: <strong><?php echo boolAttr($pet->animal->attributes->house_trained) ?></strong></li>
                                                    <li>  Declawed: <strong ><?php echo boolAttr($pet->animal->attributes->declawed) ?></strong></li>
                                                    <li>  Special Needs: <strong ><?php echo boolAttr($pet->animal->attributes->special_needs) ?></strong></li>
                                                    <li>  Shots Current: <strong ><?php echo boolAttr($pet->animal->attributes->shots_current) ?></strong></li>
                                                </ul>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <div class="card  mt-2">
                                    <div class="card-body">
                                        <div class="text-center my-2">
                                            
                                            <label>Contact <br><strong><?php echo $pet->animal->name ?></strong> </label>
                                           
                                            
                                           
                                        </div>
                                        <style type="text/css">

                                            .adopt-contact tr:nth-child(odd) {
                                                background: #fbf8f3;
                                            }
                                        </style>
                                        <?php if (isset($_SESSION['access_token'])): ?>
                                            <table class="w-100 adopt-contact" style="font-size: 12px;font-weight: 600;">
                                                <tr>
                                                    <td class="py-3 px-3 text-center">Email  </td>
                                                    <td class="py-3 px-3"><?php echo valueCheck($pet->animal->contact->email) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-3 text-center">Contact  </td>
                                                    <td class="py-3 px-3"><?php echo valueCheck($pet->animal->contact->phone) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-3 text-center">Address 1  </td>
                                                    <td class="py-3 px-3"><?php echo valueCheck($pet->animal->contact->address->address1) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-3 text-center">Address 2  </td>
                                                    <td class="py-3 px-3"><?php echo valueCheck($pet->animal->contact->address->address2) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-3 text-center">City  </td>
                                                    <td class="py-3 px-3"><?php echo valueCheck($pet->animal->contact->address->city) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-3 text-center">State  </td>
                                                    <td class="py-3 px-3"><?php echo valueCheck($pet->animal->contact->address->state) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-3 text-center">Post Code  </td>
                                                    <td class="py-3 px-3"><?php echo valueCheck($pet->animal->contact->address->postcode) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-3 text-center">Country  </td>
                                                    <td class="py-3 px-3"><?php echo valueCheck($pet->animal->contact->address->country) ?></td>
                                                </tr>

                                            </table>
                                        <?php else: ?>
                                            <div class="text-center">
                                                <small style="color: #ccc;">You need to be <a style="color: #ccc;" href="/login">Login</a> in order to view the information below.</small>
                                                <button type="submit" class="theme-btn btn-style-four py-0 w-75 mt-2" onclick="location.href='login.php'">Login</button>
                                            </div>
                                        <?php endif ?>
                                       
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        
                      
        </section>

        
        <?php require_once  'partials/news/news.php' ?> 
    <?php else: ?>

        <div class="w-100 py-5 text-center">
             <img src="assets/images/icon/dog.svg" alt="" class="img-fluid" style="object-fit: contain;">
             <h2>Sorry we can't find what you looking for :(</h2>
        </div>

    <?php endif ?>
    <hr>
	<?php require_once 'partials/footer/footer.php' ?>

    <?php if ($toBesave): ?>
        <script type="text/javascript">
            $.ajax({
                'url' : 'lib/pet-endpoint/pet-save.php',
                'method' : 'POST',
                'data' : {'petID' : '<?php echo $petID; ?>' , 'notLiked' : true},
                success:function(data){
                    
                    let URL = window.location.href; 
                    let index = URL.search("petID") + 6;
                    // var result = "foo baz".splice(4, 0, "bar ");
                    var result = URL.slice(0, index) + "save-" + URL.slice(index);

                    window.history.replaceState('View Pet', 'PET ME | Pet Information', result);

                }
            });
        </script>

    <?php endif ?>
    
<?php } ?>



<script type="text/javascript">
    loadPetComment($('#petcontainer').attr('data-animal-id'))
    $('.header-menu').find('li').eq(1).addClass('active')
</script>