<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
 <link href='//fonts.googleapis.com/css?family=Quintessential' rel='stylesheet'>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<!--body onload="hidemap();"-->
<body>
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a class="active" href="index.php">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <div id="numeresto"></div>
 <div id="resto"></div>
 <div id="adr"></div>
 <div id="showmap"></div>

 <?php include 'scripts/gps.php'; ?>

 <!--css popup window 1-->
  <div id="popUpDiv">
    <a href="javascript:hidemap()"><img id="close" alt="" title="Close" src="/img/close.jpg" /></a><br>
    <!--img id="imgpop" src="/maps/harta1.png"-->

    <iframe id="mappop" src="map.php?id=<?php echo $idresto; ?>" scrolling="no">
     <div id="map"></div>
     
     <script>
      function initMap() {
        //var uluru = {lat: 44.4810821, lng: 26.1073908};
        var uluru = {lat: <?php echo "44.4810821"; ?>, lng: <?php echo "26.1073908"; ?>};
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
     <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeaMEphjavhx4qUs54NwuhFixE5UbFvdI&callback=initMap"></script>
    </iframe>
  </div>
 <!--css popup window 1 close-->
 
 <div id="button1"></div>
 <div id="button2"></div>
 <div id="button3"></div>

 <?php include 'scripts/resto.php'; ?>
 <script src="/scripts/resto.js"></script>
 <script src="/scripts/showmap.js"></script>


</body>
</html>