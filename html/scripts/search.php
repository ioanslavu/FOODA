<?php

 require('login/dbconfig.php');

 $query = "SELECT * FROM restos";
 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
     echo "<div class='resto'><a href='resto.php?id=" . $row["id"]. "'>
           <img src='restopics/" . $row["id"]. "/" . $row["restopic"]. "'>
           <div class='numerls'>" .$row["resto"]. "</div></a></div>";
   }
 }

 if (isset($_POST['advanced'])) {
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
 }


 if (isset($_POST['search'])) {
   $count = 0;
   echo "<script>$('#restos').empty();</script>";

   $queryl = "SELECT * FROM restos WHERE resto LIKE '%" . $_POST["search"]. "%'";
   $resultl = mysqli_query($dbconfig, $queryl);

   if (mysqli_num_rows($resultl) > 0) {
     $count = 1;

     while($rowl = mysqli_fetch_assoc($resultl)) {
       echo "<div class='resto'><a href='resto.php?id=" . $rowl["id"]. "'>
             <img src='restopics/" . $rowl["id"]. "/" . $rowl["restopic"]. "'>
             <div class='numerls'>" .$rowl["resto"]. "</div></a></div>";
     }
   }

   if ($count == 0) {
     //echo "0 results";
     echo "<script>document.getElementById('restos').innerHTML = '0 rezultate';</script>";
   }

   echo "<script>$('#search').val('');$('#search').blur();</script>";
 }

 mysqli_close($dbconfig);
?>

