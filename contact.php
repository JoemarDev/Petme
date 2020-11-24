<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "CONTACT US | PET ME";
} ?>

<?php function getContent() { ?>

	<section class="page-title" style="background-image:url(assets/images/background/7.jpg)">
        <div class="container">
            <div class="clearfix">
                <div class="float-left">
                    <h1>Contact Us</h1>
                </div>
                <div class="float-right bread-parent">
                    <ul class="page-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section">
            <div class="container">
                <div class="sec-title">
                    <h2>Get In Touch</h2>
                    <div class="title">Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. </div>
                </div>
                <div class="row clearfix">
                    <!--Form Column-->
                    <div class="form-column col-md-7 col-sm-12 col-xs-12">
                        <!--Contact Form-->
                        <div class="contact-form">
                            <form method="post" action="sendemail.php" id="contact-form" novalidate="novalidate">
                                <!--Form Group-->
                                <div class="form-group">
                                    <input type="email" name="email" value="" placeholder="Email Address*" required="">
                                </div>
                                <!--Form Group-->
                                <div class="form-group">
                                    <input type="text" name="subject" value="" placeholder="Subject*" required="">
                                </div>
                                <!--Form Group-->
                                <div class="form-group">
                                    <textarea name="message" placeholder="Your Message*"></textarea>
                                </div>
                                <!--Form Group-->
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-style-four">Submit now</button>
                                </div>
                            </form>
                        </div>
                        <!--Contact Form-->
                    </div>
                    <!--Info Column-->
                    <div class="info-column col-md-5 col-sm-12 col-xs-12">
                        <div class="inner-column">
                            <ul>
                                <li><span>Address:</span>52A, Tailstoi Town 5238 <br> La city, IA 85796</li>
                                <li><span>Phone:</span>0000 000 0000</li>
                                <li><span>email:</span>info@petinica.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
   
        <hr>

	<?php require_once 'partials/footer/footer.php' ?>
<?php } ?>


<script type="text/javascript">
    $('.header-menu').find('li').eq(4).addClass('active')
</script>