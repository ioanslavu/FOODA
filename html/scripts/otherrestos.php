<?php
 require('login/dbconfig.php');

 $url = $_SERVER['REQUEST_URI'];
 $otheruser = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "SELECT id_resto, data FROM fav WHERE id_user = $otheruser";
 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
     $queryrest = "SELECT resto, restopic, likes, fav FROM restos WHERE id = $row[id_resto]";
     $resultrest = mysqli_query($dbconfig, $queryrest);
     $rest = mysqli_fetch_array($resultrest);

     $row["data"] = date("d-m-Y", strtotime($row["data"]));
     echo "<div class='commentshow'>Adaugat ca favorit la: $row[data]<hr><div id='restofav'><a href='resto.php?id=$row[id_resto]'><img src='restopics/$row[id_resto]/" . $rest[1]. "'></a><a href='resto.php?id=$row[id_resto]'><b>" . $rest[0]. "</b></a><br><br><span>Nr. favorite: " . $rest[3]. "</span><br><span>Nr. likeuri: " . $rest[2]. "</span></div></div>";
   }
 }
 else {
   echo "<br>Acest utilizator nu are niciun restaurant favorit.";
 }

 mysqli_close($dbconfig);
?>