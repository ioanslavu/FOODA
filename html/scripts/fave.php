<?php
 require('login/dbconfig.php');
 session_start();

 function faves($y) {
   if ($y >= 1000 && $y < 1000000) {
     $y = (intdiv($y, 100) / 10) . "K";
   }
   else if ($y >= 1000000) {
     $y = (intdiv($y, 100000) / 10) . "M";
   }
   else {
     $y = $y;
   }

   echo $y;
 }

 $data = date("Y-m-d");
 $time = date('H:i:s');

 $login_session = $_SESSION['login_user'];
 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "SELECT id FROM users WHERE username = '$login_session'";
 $result = mysqli_query($dbconfig, $query);
 $iduser = mysqli_fetch_array($result);

 //$query = "SELECT id FROM fav WHERE id_user = (SELECT id FROM users WHERE username = '$login_session')";
 $query = "SELECT id FROM fav WHERE id_user = $iduser[0] AND id_resto = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $idfave = mysqli_fetch_array($result);

 if (!$idfave[0]) {
   $idfave[0] = 0;
 }

 $query = "SELECT fav FROM restos WHERE id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $nrf = mysqli_fetch_array($result);

 echo "<script>document.getElementById('faves').innerHTML = '"; faves($nrf[0]); echo "';</script>";

 if (isset($_POST['fote'])) {
   if ($idfave[0] == 0) {
     echo "<script>$('#faveimg').attr('src','/img/favm.png');</script>";

     $query = "INSERT INTO fav (id, id_user, id_resto, data) VALUES (default, $iduser[0], $idresto, '$data $time')";
     $result = mysqli_query($dbconfig, $query);

     $query = "UPDATE restos SET fav = ($nrf[0]+1) WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);

     $query = "SELECT fav FROM restos WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);
     $nrf = mysqli_fetch_array($result);
 
     //echo "<script>document.getElementById('faves').innerHTML = '"; faves($nrf[0]+1); echo "';</script>";
     echo "<script>document.getElementById('faves').innerHTML = '"; faves($nrf[0]); echo "'; $('#fave').find('span').attr('title', '$nrf[0] favorite');</script>";
   }
   else {
     echo "<script>$('#faveimg').attr('src','img/favp.png');</script>";

     $query = "DELETE FROM fav WHERE id = $idfave[0]";
     $result = mysqli_query($dbconfig, $query);

     $query = "UPDATE restos SET fav = ($nrf[0]-1) WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);

     $query = "SELECT fav FROM restos WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);
     $nrf = mysqli_fetch_array($result);

     echo "<script>document.getElementById('faves').innerHTML = '"; faves($nrf[0]); echo "'; $('#fave').find('span').attr('title', '$nrf[0] favorite');</script>";
   }
 }

 mysqli_close($dbconfig);
?>