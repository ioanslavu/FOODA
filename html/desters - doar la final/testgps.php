<!DOCTYPE html>
<html>
  <head>
    <style>
      #map {
        height: 600px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>

<?php include 'scripts/gps.php'; ?>

    <div id="map"></div>
    <script>
      function initMap() {
        //var uluru = {lat: 44.4810821, lng: 26.1073908};
        var uluru = {lat: <?php echo $coord[0]; ?>, lng: <?php echo $coord[1]; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeaMEphjavhx4qUs54NwuhFixE5UbFvdI&callback=initMap">
    </script>
  </body>
</html>