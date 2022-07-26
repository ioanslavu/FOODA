<?php include 'scripts/gps.php'; ?>

<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
</head>

<body>
<div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a class="active" href="index.php">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilme.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <div id="numeresto3"></div>
<?php include 'scripts/numerest.php'; ?><br>
 

<a href="resto.php?id=<?php echo $idresto; ?>"><img id="close" alt="" title="Close" src="/img/close.jpg" /></a>
 <div id="map"></div>
 <script>
  function initMap() {
    var coord = {lat: <?php echo $coord[0]; ?> , lng: <?php echo $coord[1]; ?>};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 16,
      center: coord
    });

    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
  }
 </script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeaMEphjavhx4qUs54NwuhFixE5UbFvdI&callback=initMap"></script>
 
</body>
</html>