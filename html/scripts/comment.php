<?php
 require('login/dbconfig.php');
 session_start();
 date_default_timezone_set("Europe/Bucharest");

 $login_session = $_SESSION['login_user'];

 $url = $_SERVER['REQUEST_URI'];
 //echo $url;
 //echo "<br>";

 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 //echo $idresto;
 //echo "<br>";

 $idcateg = explode("-", explode("=", $url, 2)[1], 3)[1];
 //echo $idcateg;
 //echo "<br>";

 $idfel = explode("-", explode("=", $url, 2)[1], 3)[2];
 //echo $idfel;
 //echo "<br>";

 $data = date("Y-m-d");
 //echo $data;
 //echo "<br>";

 $time = date('H:i:s');
 //echo $time;

 $queryuser = "SELECT id FROM users WHERE username = '$login_session'";
 $rez1 = mysqli_query($dbconfig, $queryuser);
 $iduser = mysqli_fetch_array($rez1);

 if (isset($_POST['trimite'])) {
   $mesaj = $_POST['mesaj'];
   $nota = $_POST['mynota'];

   $queryupload = "INSERT INTO comments (id, comentariu, id_resto, id_categ, id_fel, id_user, data, nota, likes) VALUES (default, '$mesaj', $idresto, $idcateg, $idfel, $iduser[0], '$data $time', '$nota', 0)";
   $resultat = mysqli_query($dbconfig, $queryupload);
   
   if(!$resultat) {
    echo "Eroare la trimitere comentariului! Incercati din nou!";
   }
   else {
    $page = "/comments.php?id=" . $idresto. "-" . $idcateg. "-" .$idfel;
    header("location: $page");
   }
  }

 unset($_POST);
 mysqli_close($dbconfig);
?>