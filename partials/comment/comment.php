 <div class="container">
     <div class="row my-3">
         <h3>People Say About <?php echo $pet->animal->name ?></h3>
     </div>
 </div>
 <div class="container mt-1 d-flex justify-content-left" id="comment">

     <div class="card">
         <ul class="list-unstyled comment-container">
            <!-- COMMENT STRUCTURE -->
<!--              <li class="media mb-3 pb-3"> <span class="round"> <img src="https://img.icons8.com/bubbles/100/000000/lock-female-user.png" class="align-self-start mr-3"> </span>
                 <div class="media-body">
                     <div class="row d-flex">
                         <h6 class="user">Craig Carder</h6>
                         <div class="ml-auto">
                             <p class="text">9m</p>
                         </div>
                     </div>
                     <p class="text">This pet is very cute i like him!</p>
                 </div>
            </li>
              -->
           
         </ul>
         <ul class="list-unstyled">
            

             <?php if (isset($_SESSION['access_token'])): ?>
                <!--FIRST LIST ITEM-->
                <li class="media mb-3 pb-3 " style="border:none;"> <span class="round pt-2"><img src="<?php echo $_SESSION['user_picture'] ?>" class="align-self-start mr-3"></span>
                    <div class="media-body">
                        <div class="row d-flex">
                            <h6 class="user pt-2"><?php echo $_SESSION['user_first_name'] ?> <?php echo $_SESSION['user_last_name'] ?></h6>
                            <div class="ml-auto w-100 px-3">
                                <input type="text" id="comment-input" data-animal-id="<?php echo $pet->animal->id ?>" class="p-2" style="width: 100%; border:none; border-bottom: 1px solid #ccc; font-weight: 600; font-size: 12px;" placeholder="Tell something about <?php echo $pet->animal->name ?>">
                            </div>
                        </div>
                    </div>
                </li>
                <!--SECOND LIST ITEM-->

                <?php else: ?>
                
                <li><a href="login.php" class="text-dark">You need to be login to comment.</a></li>
             
             <?php endif ?>
         </ul>

     </div>

 </div>