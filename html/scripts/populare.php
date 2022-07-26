<?php

 require('login/dbconfig.php');

 $query = "SELECT * FROM restos";
 $result = mysqli_query($dbconfig, $query);

 echo "<script>$('#restos').empty();</script>";

   $queryad = "SELECT * FROM restos ORDER BY likes DESC";
   $resultad = mysqli_query($dbconfig, $queryad);

   if (mysqli_num_rows($resultad) > 0) {
     while($rowad = mysqli_fetch_assoc($resultad)) {
         echo "<div class='resto'><a href='resto.php?id=" . $rowad["id"]. "'>
               <img src='restopics/" . $rowad["id"]. "/" . $rowad["restopic"]. "'>
              <div class='numerls'>" .$rowad["resto"]. "</div></a></div>";
     }
   }
   else {
     echo "<script>document.getElementById('restos').innerHTML = '0 rezultate. Fii primul care da un like';</script>";
   }
 mysqli_close($dbconfig);
?>
