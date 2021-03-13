<?php

/* @var $this yii\web\View */

$this->title = 'Maps';
?>
<div class="jumbotron">
    <h2>Maps</h2>
    <br>
    <h4>Here is the UTAgs location!!</h4>
    <div class="row center-block">
        <div id="map" class="col col-md-8 col-md-offset-2 map-container">
        </div>
    </div>
</div>
    <script>
        function initMap() {
            let myLatLng = {
                lat: 21.839154,
                lng: -102.354138
            };

            let map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: myLatLng
            });

            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Here is the UTAgs",
            });
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbe51Sqj5VG0-pbMBCLAyW88Zup_E5IqY&callback=initMap&libraries=&v=weekly"
        async
        defer
    ></script>
