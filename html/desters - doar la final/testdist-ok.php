<?php
 require('login/dbconfig.php');
 session_start();
 date_default_timezone_set("Europe/Bucharest");

 $login_session = $_SESSION['login_user'];

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
              10.0 AS radius,      111.045 AS distance_unit 
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
        echo "<div class='commentshow'>" . $row["resto"]. " - " . $row["lat"]. " - " . $row["lng"]. " - distance: " . round($row["distance"],2). "</div>";
     }
 } 
 mysqli_close($dbconfig);
?>