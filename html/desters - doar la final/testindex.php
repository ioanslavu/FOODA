<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
 <script type="text/javascript" src="/scripts/jquery-latest.js"></script>
 <script type="text/javascript" src="/scripts/jquery.tablesorter.js"></script>
 <link rel="stylesheet" type="text/css" href="/css/style.css"/>
 <script src="/scripts/slideup.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a class="active" href="javascript:void(0);">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <div id="input_search">
  <form method="post">
   <a href="#"><img id="back" src="/img/back.png"></a>
   <input type="text" name="search" id="search" maxlenght="50" value="" placeholder="Cautati...">
  </form>
 </div>



 <div id="restos>
  <?php
   require('login/dbconfig.php');

   if (isset($_POST['search'])) {
     $count = 0;
     $radius = $_POST['selected_text'];

     //echo "<script>$('#restos').empty();</script>";

     echo "<table id='myTable' class='tablesorter'>
      <thead><tr>
       <th>Nume resto</th>
       <th>Dist (km)</th>
       <th>Likes</th>
      </tr></thead>
      <tbody>";

 $query = "SELECT resto,
       lat, lng, distance
   FROM (
   SELECT z.resto,
       z.lat,
       z.lng, 
         p.radius, 
         p.distance_unit 
                  * DEGREES(ACOS(COS(RADIANS(p.latpoint)) 
                  * COS(RADIANS(z.lat)) 
                  * COS(RADIANS(p.longpoint - z.lng)) 
                  + SIN(RADIANS(p.latpoint)) 
                  * SIN(RADIANS(z.lat)))) AS distance 
      FROM restos AS z 
      JOIN (   /* these are the query parameters */ 
      SELECT  44.45  AS latpoint,  26.08 AS longpoint, 
              $radius AS radius,      111.045 AS distance_unit 
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
      LIMIT 15";

 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        //echo "<div class='commentshow'>" . $row["resto"]. " - " . $row["lat"]. " - " . $row["lng"]. "</div>";
        echo "<tr><td>" . $row["resto"]. "</td><td>" . $row["distance"]. "</td><td>" . $row["likes"]. "</td></tr>";
     }
 echo "</tbody></table>";
 } 


     if ($count == 0) {
       echo "0 results";
       //echo "<script>document.getElementById('restos').innerHTML = '0 results';</script>";
     }

     //echo "<script>$('#search').val('');$('#search').blur();</script>";
   }

   mysqli_close($dbconfig);
  ?>
 </div>





 <div id="input_dist"><br>
  <form method="POST">
  <label for="distanta">Distanta: </label>
   <select id="dist" name="dist" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
    <option value="0">Selecteaza distanta</option>
    <option value="1">0-500 m</option>
    <option value="2">1 km</option>
    <option value="3">2 km</option>
    <option value="3">5 km</option>
    <option value="4">10 km</option>
   </select>
  <input name="selected_text" id="selected_text" value="" />
  <input type="submit" name="search" value="Search"/>
  </form>
 </div><br>

 
<!--$makerValue = $_POST['dist'];
$maker = mysql_real_escape_string($_POST['selected_text']);
echo $maker;-->



 <script>
  $(document).ready(function() {
   $("#myTable").tablesorter();
  });
 </script>

</body>
</html>