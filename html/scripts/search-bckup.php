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
 
 if (isset($_POST['search'])) {
   $count = 0;
   echo "<script>$('#restos').empty();</script>";

   $query = "SELECT * FROM restos WHERE resto LIKE '%" . $_POST["search"]. "%'";
   $result = mysqli_query($dbconfig, $query);

   if (mysqli_num_rows($result) > 0) {
     $count = 1;

     while($row = mysqli_fetch_assoc($result)) {
       echo "<div class='resto'><a href='resto.php?id=" . $row["id"]. "'>
             <img src='restopics/" . $row["id"]. "/" . $row["restopic"]. "'>
             <div class='numerls'>" .$row["resto"]. "</div></a></div>";
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