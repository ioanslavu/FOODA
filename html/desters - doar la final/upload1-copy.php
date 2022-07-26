<?php
 
 require('login/dbconfig.php');
 session_start();
 date_default_timezone_set("Europe/Bucharest");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
 //$error = FALSE;

 $imageFileType = pathinfo($_FILES["upload"]["name"],PATHINFO_EXTENSION);

 // Check file size
 if ($_FILES["upload"]["size"] > 500000000) {
    $errors = "Fisier prea mare.";
    //$error = TRUE;
 }

 // Allow certain file formats
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $errors = "Formate acceptate, only JPG, JPEG, PNG & GIF.";
    //$error = TRUE;
 }


if (!$error) {
 $login_session = $_SESSION['login_user'];

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 $idcateg = explode("-", explode("=", $url, 2)[1], 3)[1];
 $idfel = explode("-", explode("=", $url, 2)[1], 3)[2];

 $queryuser = "SELECT id FROM users WHERE username = '$login_session'";
 $rez1 = mysqli_query($dbconfig, $queryuser);
 $iduser = mysqli_fetch_array($rez1);

 $target_dir = "/var/www/html/uploads/";
 $filenamenew = $idresto. "_" . $idcateg. "_" . $idfel. "_" . $iduser[0]. "_" . date(dmY). "_" . date(His). "." . $imageFileType;
 $target_file = $target_dir . $filenamenew;

    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
     //$errors = "Fisier incarcat cu succes!";
     //$error = TRUE;

       $data = date("Y-m-d");
       $time = date('H:i:s');

       $queryupload = "INSERT INTO poze (id, poza, id_resto, id_categ, id_fel, id_user, data, nota) VALUES (default, '$filenamenew', $idresto, $idcateg, $idfel, $iduser[0], '$data $time', 9)";
       $resultat = mysqli_query($dbconfig, $queryupload);

       if(!$resultat) {
         $errors = "Eroare la salvarea pozei!";
         //$error = TRUE;
       }
       else {
         $errors = "Fisier salvat cu succes!";
         //$error = TRUE;
         mysqli_close($dbconfig);
       }    
    }
    else {
      $errors = "Eroare la incarcare!";
      //$error = TRUE;
    }
 }

 //$page = "/comments.php?id=" . $idresto. "-" . $idcateg. "-" .$idfel;
 //header("location: $page");
}
?>