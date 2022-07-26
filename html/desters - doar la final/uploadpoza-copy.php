<?php 
 require('login/dbconfig.php');
 session_start();

 $login_session = $_SESSION['login_user'];

 $queryuser = "select `id` from `users` where username = '$login_session'";
 $rez1 = mysqli_query($dbconfig, $queryuser);
 $iduser = mysqli_fetch_array($rez1);

 $url = $_SERVER['REQUEST_URI'];
 $resto = explode("-", explode("=", $url, 2)[1], 3)[0];
 $categ = explode("-", $url, 3)[1];
 $fel = explode("-", $url, 3)[2];
 $data = date("d-m-Y");
 $time = date('H:i:s', time() + date('Z'));
 $poza = basename($_FILES["fileToUpload"]["name"]);
 echo $poza;

 if (isset($_POST['submit'])) {
  $poza = $_FILES["fileToUpload"]["name"];

  if (!isset($fmsg)) {

   $queryupload = "INSERT INTO `poze` (id, poza, id_resto, id_categ, id_fel, id_user, data, nota) VALUES (default, '$poza', $resto, $categ, $fel, $iduser[0], '$data $time', 9)";
   $resultat = mysqli_query($dbconfig, $queryupload);
   
   if(!$resultat) {
    $fmsg = "Eroare la incarcarea pozei! Incercati din nou!";
   }
  }
 }

 unset($_POST);
 mysqli_close($dbconfig);
?>