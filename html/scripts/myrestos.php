<?php
 require('login/dbconfig.php');
 $login_session = $_SESSION['login_user'];

 $query = "SELECT id FROM users WHERE username = '$login_session'";
 $result = mysqli_query($dbconfig, $query);
 $user = mysqli_fetch_array($result);

 $query = "SELECT id_resto, data FROM fav WHERE id_user = $user[0]";
 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
   $i = 1;

   while($row = mysqli_fetch_assoc($result)) {
     $queryrest = "SELECT resto, restopic, likes, fav FROM restos WHERE id = $row[id_resto]";
     $resultrest = mysqli_query($dbconfig, $queryrest);
     $rest = mysqli_fetch_array($resultrest);

     $row["data"] = date("d-m-Y", strtotime($row["data"]));
     echo "<div class='commentshow'>Adaugat ca favorit la: $row[data]<form method='post' action=''><button type='submit' class='delete' name='delete" . $i. "' value='delete' title='Sterge favorit'>Sterge favorit</button></form><hr><div id='restofav'><a href='resto.php?id=$row[id_resto]'><img src='restopics/$row[id_resto]/" . $rest[1]. "'></a><a href='resto.php?id=$row[id_resto]'><b>" . $rest[0]. "</b></a><br><br><span>Nr. favorite: " . $rest[3]. "</span><br><span>Nr. likeuri: " . $rest[2]. "</span></div></div>";

     if (isset($_POST["delete$i"])) {
       $querydlt = "DELETE FROM fav WHERE id_resto = $row[id_resto] AND id_user=$user[0]";
       $dlt = mysqli_query($dbconfig, $querydlt);
       header("location:profilme.php");

       $query = "UPDATE restos SET fav = ($rest[3]-1) WHERE id = $row[id_resto]";
       $result = mysqli_query($dbconfig, $query);

       header("location:profilme.php");
     }

     $i++;
   }
 }
 else {
   echo "<br>Nu ai niciun restaurant favorit.";
 }

 mysqli_close($dbconfig);
?>