<?php
 require('login/dbconfig.php');
 session_start();

 $login_session = $_SESSION['login_user'];

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $queryuser = "SELECT id FROM users WHERE username = '$login_session'";
 $rez1 = mysqli_query($dbconfig, $queryuser);
 $iduser = mysqli_fetch_array($rez1);

 $query = "SELECT id FROM likes WHERE id_user = $iduser[0] AND id_resto = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $idlike = mysqli_fetch_array($result);

 if (!$idlike[0]) {
   $idlike[0] = 0;
 }

 if ($idlike[0] <> 0) {
  echo "<img id='likeimg' src='/img/dislike.png' title='Nu-mi mai place' style='cursor: pointer;' />";
 }
 else {
  echo "<img id='likeimg' src='/img/like.png' title='Imi place' style='cursor: pointer;' />";
 }
?>