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
    <div class="container mt-3" style="height: 600px;">
        <div id="map"class="w-100" style="height: 100%;"></div>
    </div>

   
    <hr>

	<?php require_once 'partials/footer/footer.php' ?>
<?php } ?>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIwzALxUPNbatRBj3Xi1Uhp0fFzwWNBkE&callback=initMap&libraries=&v=weekly"
  defer
></script>s


<script type="text/javascript">
    let map;

    //const haversine = require('haversine')

    var locations = [];

    locations.push({ name: 'Shop 1', latlon: [ -40.362184, 170.606704 ] });
    locations.push({ name: 'Shop 2', latlon: [ -40.355506, 176.607944 ] });
    locations.push({ name: 'Shop 3', latlon: [ -40.361974, 175.622306 ] });

    const customer_latlon = [ -40.357678, 10.610529 ];



    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            $('#geolocation').text("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        $('#geolocation').text(position.coords.latitude + ", " + position.coords.longitude);
      
      $('#map').attr('src', 'https://maps.google.com/maps?q='+position.coords.latitude+','+position.coords.longitude+'&z=9&output=embed')
      
      customer_latlon[0] = position.coords.latitude;
      customer_latlon[1] = position.coords.longitude;
      
    }


    function findClosest() {
    var distances = [];

    locations.forEach(function(location){
      console.log(location)
        distances.push({ location: location, distance: haversine(customer_latlon, location.latlon, {unit: 'km', format: '[lat,lon]'}) });
    });

    distances.sort(function(a, b) {
        return a.distance - b.distance;
    });

    //console.log(distances);
      
      $('#closest').text("Closest location is "+distances[0].location.name+" at a distance of "+distances[0].distance+" km");

    }

    $('#btnGeolocate').click(getLocation);
    getLocation();

    $('#btnClosest').click(findClosest);a

    setTimeout(function(){
      findClosest();
    }, 3000);
s

    $('.header-menu').find('li').eq(4).addClass('active')
</script>