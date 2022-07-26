<?php
 require('login/dbconfig.php');

 if (isset($_POST['advanced'])) {
   echo "<script>$('#restos').hide();</script>";
   echo "<script>$('#findlike').show();</script>";

   $query = "SELECT * FROM restos order by likes DESC";
   $result = mysqli_query($dbconfig, $query);

   if (mysqli_num_rows($result) > 0) {
     while($row = mysqli_fetch_assoc($result)) {
       echo "<div class='resto'><a href='resto.php?id=" . $row["id"]. "'>
             <img src='restopics/" . $row["id"]. "/" . $row["restopic"]. "'>
             <div class='numerls'>" .$row["resto"]. "</div></a></div>";
     }
   }
 }
 else {
     echo "0 rezultate gasite. Fii primul care da un like.";
 }
 
 mysqli_close($dbconfig);
?>



