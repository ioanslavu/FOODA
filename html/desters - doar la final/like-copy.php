<?php
 require('login/dbconfig.php');
 session_start();

 function likes($x) {
   if ($x >= 1000 && $x < 1000000) {
     $x = (intdiv($x, 100) / 10) . "K";
   }
   else if ($x >= 1000000) {
     $x = (intdiv($x, 100000) / 10) . "M";
   }
   else {
     $x = $x;
   }

   echo $x;
 }

 $login_session = $_SESSION['login_user'];
 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "SELECT id FROM users WHERE username = '$login_session'";
 $result = mysqli_query($dbconfig, $query);
 $iduser = mysqli_fetch_array($result);

 //$query = "SELECT id FROM likes WHERE id_user = (SELECT id FROM users WHERE username = '$login_session')";
 $query = "SELECT id FROM likes WHERE id_user = $iduser[0] AND id_resto = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $idlike = mysqli_fetch_array($result);

 if (!$idlike[0]) {
   $idlike[0] = 0;
 }

 $query = "SELECT likes FROM restos WHERE id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $nrl = mysqli_fetch_array($result);

 echo "<script>document.getElementById('likes').innerHTML = '"; likes($nrl[0]); echo "';</script>";

 if (isset($_POST['vote'])) {
   if ($idlike[0] == 0) {
     echo "<script>$('#likeimg').attr('src','/img/dislike.png');</script>";

     $query = "INSERT INTO likes (id, id_user, id_resto, id_fel, id_gr) VALUES (default, $iduser[0], $idresto, 0, 0)";
     $result = mysqli_query($dbconfig, $query);

     $query = "UPDATE restos SET likes = ($nrl[0]+1) WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);

     $query = "SELECT likes FROM restos WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);
     $nrl = mysqli_fetch_array($result);
 
     //echo "<script>document.getElementById('likes').innerHTML = '"; likes($nrl[0]+1); echo "';</script>";
     echo "<script>document.getElementById('likes').innerHTML = '"; likes($nrl[0]); echo "'; $('#like').find('span').attr('title', '$nrl[0] likeuri');</script>";
   }
   else {
     echo "<script>$('#likeimg').attr('src','img/like.png');</script>";

     $query = "DELETE FROM likes WHERE id = $idlike[0]";
     $result = mysqli_query($dbconfig, $query);

     $query = "UPDATE restos SET likes = ($nrl[0]-1) WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);

     $query = "SELECT likes FROM restos WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);
     $nrl = mysqli_fetch_array($result);

     echo "<script>document.getElementById('likes').innerHTML = '"; likes($nrl[0]); echo "'; $('#like').find('span').attr('title', '$nrl[0] likeuri');</script>";
   }
 }
?>