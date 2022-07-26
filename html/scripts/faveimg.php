<?php
 require('login/dbconfig.php');
 session_start();

 $login_session = $_SESSION['login_user'];

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $queryuser = "SELECT id FROM users WHERE username = '$login_session'";
 $rez1 = mysqli_query($dbconfig, $queryuser);
 $iduser = mysqli_fetch_array($rez1);

 $query = "SELECT id FROM fav WHERE id_user = $iduser[0] AND id_resto = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $idfav = mysqli_fetch_array($result);

 if (!$idfav[0]) {
   $idfav[0] = 0;
 }

 if ($idfav[0] <> 0) {
  echo "<img id='faveimg' src='/img/favm.png' title='Nu-mi mai place' style='cursor: pointer;' />";
 }
 else {
  echo "<img id='faveimg' src='/img/favp.png' title='Imi place' style='cursor: pointer;' />";
 }
?>