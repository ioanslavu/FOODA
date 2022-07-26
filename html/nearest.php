
<!DOCTYPE html>
<head>
 <!--script src="https://code.jquery.com/jquery-2.1.3.js"</script-->
 <script src="https://code.jquery.com/jquery-3.1.1.js"></script>

 <script type="text/javascript" src="/scripts/jquery-latest.js"></script>
 <script type="text/javascript" src="/scripts/jquery.tablesorter.js"></script>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
 <link rel="stylesheet" type="text/css" href="/css/style.css"/>
</head>

<body onload="getLocation()">
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a href="index.php">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a class="active" href="profilme.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <div id="input_search">
  <form method="post">
   <a href="#"><img id="back" src="/img/back.png"></a>
   <input type="text" name="search" id="search" maxlenght="50" value="" placeholder="Cautati...">
  </form>
 </div>


 <form method="POST">
  <label for="distanta">Distanta: </label>
   <select id="dist" name="dist" onchange="document.getElementById('selected_dist').value=this.options[this.selectedIndex].value">
    <option value="0">Selecteaza distanta</option>
    <option value="0.5">0-500 m</option>
    <option value="1.0">1 km</option>
    <option value="2.0">2 km</option>
    <option value="5.0">5 km</option>
    <option value="20.0">10 km</option>
   </select>
  <input type="hidden" name="selected_dist" id="selected_dist" value="" />
  <input type="hidden" name="lat" id="lat" value="" />
  <input type="hidden" name="lng" id="lng" value="" />
  <button type="submit" name="nearest" id="nearest">Cauta</button>
 </form>

<?php
 require('login/dbconfig.php');
 $radius='';

 if (isset($_POST['nearest'])) {
 $radius = $_POST['selected_dist'];
 $lat = $_POST['lat'];
 $lng = $_POST['lng'];

 echo "<table id='myTable' class='tablesorter'>
        <thead>
         <tr>
          <th>Restaurant</th>
          <th>Dist (km)</th>
          <th>Likes</th>
         </tr>
        </thead>
        <tbody>";

 $query = "SELECT id, resto,
       lat, lng, likes, distance
   FROM (
   SELECT z.id,
       z.resto,
       z.lat,
       z.lng,
       z.likes,  
         p.radius, 
         p.distance_unit 
                  * DEGREES(ACOS(COS(RADIANS(p.latpoint)) 
                  * COS(RADIANS(z.lat)) 
                  * COS(RADIANS(p.longpoint - z.lng)) 
                  + SIN(RADIANS(p.latpoint)) 
                  * SIN(RADIANS(z.lat)))) AS distance 
      FROM restos AS z 
      JOIN (   /* these are the query parameters */ 
      SELECT " . $lat. " AS latpoint, " . $lng. " AS longpoint, "
               . $radius. " AS radius,      111.045 AS distance_unit 
      ) AS p ON 1=1 
      WHERE z.lat 
         BETWEEN p.latpoint  - (p.radius / p.distance_unit) 
            AND p.latpoint  + (p.radius / p.distance_unit) 
            AND z.lng 
         BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint)))) 
            AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint)))) 
      ) AS d 
      WHERE distance <= radius
      ORDER BY distance
      LIMIT 20";

 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        //echo "<div class='commentshow'>" . $row["resto"]. " - lat: " . $row["lat"]. " - long: " . $row["lng"]. " - distance: " . round($row["distance"],2). " km - likes: " . $row["likes"]. "</div>";
        echo "<tr><td><a href='resto.php?id=" . $row["id"]. "'>" . $row["resto"]. "</a></td><td>" . round($row["distance"],2). "</td><td>" . $row["likes"]. "</td></tr>";
     }
 }
 echo "</tbody></table>";
 mysqli_close($dbconfig);

 echo "<script>
  $(document).ready(function() {
  $('#myTable').tablesorter(); });</script>";
 }
?>

 <script>
  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    }
    else { 
      alert('Geolocation is not supported by this browser.');
    }
  }

  function showPosition(position) {
    var x = document.getElementById("lat");
    x.value = position.coords.latitude;
    var y = document.getElementById('lng');
    y.value = position.coords.longitude;
    //alert('Latitude: ' + position.coords.latitude + '\nLongitude: ' + position.coords.longitude);
  }
 </script>
<div id="menuba">
  <ul>
   <li><a  href="index.php">RESTAURANTE</a></li>
   <li><a  href="index2.php">Populare</a></li>
   <li><a class="active" href="nearest.php">In apropiere</a></li>
  </ul>
 </div>

</body>
</html>
