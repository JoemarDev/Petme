<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#petLoginModal" style="display: none;">
Launch demo modal
</button>
<!-- Modal -->
<div class="modal fade" id="petLoginModal" tabindex="-1" role="dialog" aria-labelledby="petLoginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content py-3">
            <div class="modal-body p-0" style="position: relative;">
                <button 
                    style="position: absolute;
                    top: -5px; 
                    right: 10px; 
                    z-index: 50; 
                    font-size: 25px; 
                    border:none; 
                    background: transparent;"
                    data-dismiss="modal">
                    <i class="icofont-close"></i>
                </button>

                <div class="card py-5" 
                    style="max-width: 100%; 
                    border:none;">

                    <div class="header text-center mb-3">
                        <img src="assets/images/logo/logo.png" alt="" title="">
                    </div>

                    <div class="text-input px-4">
                        <small class="ml-1" style="color: #e5a62d; ">Email</small>
                        <input 
                            type="email" 
                            name="" class="w-100 p-2" 
                            style="border:none; border-bottom: 1px solid #ccc; font-weight: 600;" 
                            placeholder="">

                        <small class="ml-1" style="color: #e5a62d; ">Password</small>

                        <input 
                            type="password" 
                            name="" 
                            class="w-100 p-2" 
                            style="border:none; border-bottom: 1px solid #ccc; font-weight: 600; " 
                            placeholder="">

                        <button type="submit" class="theme-btn btn-style-four w-100 py-1 mt-3">SIGN IN</button>

                        <div class="text-center py-3">
                            <small>OR</small>
                        </div>
                        <?php if (!isset($_SESSION['access_token'])) {require_once 'lib/generateLoginUrl.php';} ?>
                        <button  onclick="window.location.href='<?php echo $loginUrl ?>'" class="btn-style-five w-100 py-1 mb-3"><img src="assets/images/icon/google-logo.png" style="width: 20px; position: relative; top: -2px;"> LOGIN WITH GOOGLE</button>
                        <button type="submit" class="btn-style-three w-100 py-1 mb-3"><img src="assets/images/icon/facebook-logo.png" style="width: 20px; position: relative; top: -2px;"> LOGIN WITH FACEBOOK</button>
                        <div class="text-center">
                            <small>Don't Have Account Yet ? 
                            <a href="register.php" class="text-dark">
                            <strong>Sign Up</strong>
                            </a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>