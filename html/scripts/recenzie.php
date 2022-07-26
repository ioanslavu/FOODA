<?php
 require('login/dbconfig.php');
 session_start();
 date_default_timezone_set("Europe/Bucharest");

 $login_session = $_SESSION['login_user'];

 $queryuser = "SELECT id FROM users WHERE username = '$login_session'";
 $resultuser = mysqli_query($dbconfig, $queryuser);
 $iduser = mysqli_fetch_array($resultuser);

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 $data = date("Y-m-d");
 $time = date('H:i:s');

 if (isset($_POST['trimite'])) {
  $mesaj = $_POST['mesaj'];
  $nota = $_POST['mynota'];

  $query = "INSERT INTO recenzii (id, comentariu, id_resto, id_user, data, nota, likes) VALUES (default, '$mesaj', $idresto, $iduser[0], '$data $time', '$nota', 0)";
  $result = mysqli_query($dbconfig, $query);

  if(!$result) {
   $fmsg = "Comentariul nu s-a inregistrat! Incercati din nou!";
  }
 }

 unset($_POST);
 mysqli_close($dbconfig);
?>