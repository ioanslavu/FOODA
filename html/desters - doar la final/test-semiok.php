<?php
 //date_default_timezone_set("Europe/Bucharest");
 require('login/dbconfig.php');
 session_start();

 $login_session = $_SESSION['login_user'];
 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 //$data = date("d-m-Y");
 //$time = date('H:i:s');

 $query = "SELECT id FROM users WHERE username = '$login_session'";
 $result = mysqli_query($dbconfig, $query);
 $iduser = mysqli_fetch_array($result);

 //$query = "SELECT id FROM likes WHERE id_user = (SELECT id FROM users WHERE username = '$login_session')";
 $query = "SELECT id FROM likes WHERE id_user = $iduser[0]";
 $result = mysqli_query($dbconfig, $query);
 $idlike = mysqli_fetch_array($result);

 $query = "SELECT likes FROM restos WHERE id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $nrl = mysqli_fetch_array($result);

 echo "<script>document.getElementById('idlike').innerHTML = '" . $nrl[0]. "';</script>";

 
 if (!$idlike[0]) {
  $idlike[0] = 0;
 }

 if ($idlike[0] == 0) {
  echo "<img id='likeimg' src='/img/like.png' style='cursor: pointer;' />";

  if (isset($_POST['vote'])) {
    $query = "INSERT INTO likes (id, id_user, id_resto, id_fel, id_gr) VALUES (default, $iduser[0], $idresto, 0, 0)";
    $result = mysqli_query($dbconfig, $query);

    $query = "UPDATE restos SET likes = ($nrl[0]+1) WHERE id = $idresto";
    $result = mysqli_query($dbconfig, $query);

    echo "<script>document.getElementById('idlike').innerHTML = '" . ($nrl[0] + 1). "';</script>";
  }
 }
 else {
  echo "<img id='likeimg' src='/img/dislike.png' style='cursor: pointer;' />";

  if (isset($_POST['vote'])) {
    $query = "DELETE FROM likes WHERE id = $idlike[0]";
    $result = mysqli_query($dbconfig, $query);

    $query = "UPDATE restos SET likes = ($nrl[0]-1) WHERE id = $idresto";
    $result = mysqli_query($dbconfig, $query);

    echo "<script>document.getElementById('idlike').innerHTML = '" . ($nrl[0] - 1). "';</script>";
  }
 }
 //header("location: resto-test.php?id=" . $idresto);
?>