<?php require_once 'template.php'; ?>

<?php function getTitle(){
	echo "CONTACT US | PET ME";
} ?>

<?php function getContent() { ?>

	<section class="page-title" style="background-image:url(assets/images/background/7.jpg)">
        <div class="container">
            <div class="clearfix">
                <div class="float-left">
                    <h1>About Me</h1>
                </div>
                <div class="float-right bread-parent">
                    <ul class="page-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li>About Me</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <?php require_once 'partials/welcome/welcome.php'; ?>

    <?php require_once 'partials/feature/feature.php'; ?>


    <?php require_once 'partials/service/service.php'; ?>

    <?php require_once 'partials/contact/appointment.php'; ?>

    <?php require_once 'partials/team/team.php'; ?>

    <?php require_once  'partials/counter/counter.php'; ?>

    <?php require_once  'partials/save-pet/save-pet.php'; ?>

    <?php require_once  'partials/about/about1.php'; ?>

    <?php require_once  'partials/testimonial/testimonial.php' ?>

    <?php require_once  'partials/news/news.php' ?> 
    
    <?php require_once 'partials/footer/footer.php' ?>
   
    <hr>

	<?php require_once 'partials/footer/footer.php' ?>
<?php } ?>

<script type="text/javascript">
    $('.header-menu').find('li').eq(1).addClass('active')
</script>