<?php 
 include("login/dbconfig.php");

 $url = $_SERVER['REQUEST_URI'];
 $iduser = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "SELECT id, nume, prenume, oras, datareg, lastseen, avatar FROM users WHERE id = $iduser";
 $result = mysqli_query($dbconfig, $query);
 $rez = mysqli_fetch_array($result);


 //pentru nr si LAST LIKE
 $querylike = "SELECT count(id), max(data) FROM likes WHERE id_user = $rez[0]";
 $result = mysqli_query($dbconfig, $querylike);
 $like = mysqli_fetch_array($result);
 $datalike = date("d-m-Y H:i:s", strtotime($like[1]));
 if (!$result) {
   $like[0] = 0;
 }
 else {
   $querylike = "SELECT id, resto FROM restos WHERE id = (SELECT id_resto FROM likes WHERE id_user = $rez[0] AND data = '$like[1]')";
   $result = mysqli_query($dbconfig, $querylike);
   $likeres = mysqli_fetch_array($result);
 }


 //pentru nr si LAST FAV
 $queryfav = "SELECT count(id), max(data) FROM fav WHERE id_user = $rez[0]";
 $result = mysqli_query($dbconfig, $queryfav);
 $fav = mysqli_fetch_array($result);
 $datafav = date("d-m-Y H:i:s", strtotime($fav[1]));
 if (!$result) {
   $fav[0] = 0;
 }
 else {
   $queryfav = "SELECT id, resto FROM restos WHERE id = (SELECT id_resto FROM fav WHERE id_user = $rez[0] AND data = '$fav[1]')";
   $result = mysqli_query($dbconfig, $queryfav);
   $favres = mysqli_fetch_array($result);
 }


 echo "<table id='profilother'>
  <tr>
   <td rowspan='4'><img src='/avatars/" . $rez[6]. "'></td>
   <td>Utilizator:</td>
   <td>" . $rez[1]. " " . $rez[2]. "</td>
  </tr>
  <tr>
   <td>Oras:</td>
   <td>" . $rez[3]. "
  </tr>
  <tr>
   <td>ID membru:</td>
   <td>" . $rez[0]. "
  </tr>
  <tr>
   <td>Data inregistrarii:</td>
   <td>" . $rez[4]. "
  </tr>
 </table>";

 echo "<br>";
 //pentru nr si LAST POST
 $querycomm = "SELECT SUM(id.count), max(id.data) FROM (SELECT COUNT(id) AS count, max(data) AS data FROM comments WHERE id_user=$rez[0] UNION ALL SELECT COUNT(id) AS count, max(data) AS data FROM recenzii WHERE id_user=$rez[0] UNION ALL SELECT COUNT(id) AS count, max(data) AS data FROM poze WHERE id_user=$rez[0]) id";
 $result = mysqli_query($dbconfig, $querycomm);
 $comm = mysqli_fetch_array($result);
 $datacomm = date("d-m-Y H:i:s", strtotime($comm[1]));

 if (!$result) {
   $comm[0] = 0;
 }
 echo "Nr. postari: " . $comm[0]. "<br>";
 if ($comm[0] > 0) {
   echo "Ultima postare: " . $datacomm. "<br>";

   $querycomm = "SELECT id_resto, id_categ, id_fel FROM comments WHERE id_user = $rez[0] AND data = '$comm[1]'";
   $result = mysqli_query($dbconfig, $querycomm);
   $txtcom = mysqli_fetch_array($result);

   if ($txtcom[0] > 0) {
     $query = "SELECT resto FROM restos WHERE id = $txtcom[0]";
     $result = mysqli_query($dbconfig, $query);
     $rest = mysqli_fetch_array($result);

     $query = "SELECT fel FROM fel WHERE id = $txtcom[2]";
     $result = mysqli_query($dbconfig, $query);
     $fel = mysqli_fetch_array($result);

     echo "In restaurant: <a href='resto.php?id=" . $txtcom[0]. "'>" . $rest[0]. "</a> -> Fel: <a href='comments.php?id=" . $txtcom[0]. "-" . $txtcom[1]. "-" . $txtcom[2]. "'>" . $fel[0]. "</a><br>";
   }
   else {
     $querycomm = "SELECT id_resto, id_categ, id_fel FROM poze WHERE id_user = $rez[0] AND data = '$comm[1]'";
     $result = mysqli_query($dbconfig, $querycomm);
     $txtpoz = mysqli_fetch_array($result);
     //echo "fara comments";

     if ($txtpoz[0] > 0) {
       //echo $txtpoz[1];
       $query = "SELECT resto FROM restos WHERE id = $txtpoz[0]";
       $result = mysqli_query($dbconfig, $query);
       $rest = mysqli_fetch_array($result);

       $query = "SELECT fel FROM fel WHERE id = $txtpoz[2]";
       $result = mysqli_query($dbconfig, $query);
       $fel = mysqli_fetch_array($result);

       echo "In restaurant: <a href='resto.php?id=" . $txtpoz[0]. "'>" . $rest[0]. "</a> -> Fel: <a href='comments.php?id=" . $txtpoz[0]. "-" . $txtpoz[1]. "-" . $txtpoz[2]. "'>" . $fel[0]. "</a><br>";
     }
     else {
       $querycomm = "SELECT id_resto FROM recenzii WHERE id_user = $rez[0] AND data = '$comm[1]'";
       $result = mysqli_query($dbconfig, $querycomm);
       $txtrec = mysqli_fetch_array($result);
       //echo "fara poze";
 
       if ($txtrec[0] > 0) {
         $query = "SELECT resto FROM restos WHERE id = $txtrec[0]";
         $result = mysqli_query($dbconfig, $query);
         $rest = mysqli_fetch_array($result);

         echo "In restaurant: <a href='resto.php?id=" . $txtrec[0]. "'>" . $rest[0]. "</a><br>";
       }
     }
   }
 }

 echo "<br>
 Nr. likeuri: " . $like[0]. "<br>";
 if ($like[0] > 0) {
   echo "Ultimul like: " . $datalike. "<br>
   Restaurant: <a href='resto.php?id=" . $likeres[0]. "'>" . $likeres[1]. "</a><br>";
 }
 echo "<br>

 Nr. favorite: " . $fav[0]. "<br>";
 if ($fav[0] > 0) {
   echo "Ultimul favorit: " . $datafav. "<br>
   Restaurant: <a href='resto.php?id=" . $favres[0]. "'>" . $favres[1]. "</a><br>";
 }
 echo "<br>";

 mysqli_close($dbconfig);
?>