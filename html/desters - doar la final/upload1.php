<?php
 require('login/dbconfig.php');
 session_start();
 date_default_timezone_set("Europe/Bucharest");

 $login_session = $_SESSION['login_user'];

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 $idcateg = explode("-", explode("=", $url, 2)[1], 3)[1];
 $idfel = explode("-", explode("=", $url, 2)[1], 3)[2];

 $queryuser = "SELECT id FROM users WHERE username = '$login_session'";
 $rez1 = mysqli_query($dbconfig, $queryuser);
 $iduser = mysqli_fetch_array($rez1);

 $target_dir = "/var/www/html/uploads/";
 //$target_file = $target_dir . basename($_FILES["upload"]["name"]);

 $imageFileType = pathinfo($_FILES["upload"]["name"],PATHINFO_EXTENSION);

 $filenamenew = $idresto. "_" . $idcateg. "_" . $idfel. "_" . $iduser[0]. "_" . date(dmY). "_" . date(His). "." . $imageFileType;
 $target_file = $target_dir . $filenamenew;

 $uploadOk = 1;


 // Check if file already exists
 //if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    //echo "Exista deja un fisier cu acest nume! Incercati din nou!";
    //$fmsg = "Sorry, file already exists.";
    //$uploadOk = 0;
 //}


 // Check file size
 if ($_FILES["upload"]["size"] > 2000000) {
    //echo "Sorry, your file is too large.";
    echo "Fisier prea mare! Incercati din nou!";
    $fmsg = "Sorry, your file is too large.";
    $uploadOk = 0;
 }


 // Allow certain file formats
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    echo "Doar JPG, JPEG, PNG & GIF sunt acceptate! Incercati din nou!";
    $fmsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
 }


 // Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
    echo "Fisierul nu a fost incarcat! Incercati din nou!";
    $fmsg = "Sorry, your file was not uploaded.";
 }


 // if everything is ok, try to upload file
 else {
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {

       //echo "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";
       echo "Fisier incarcat cu succes!";
       //$fmsg = "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";

       $data = date("Y-m-d");
       $time = date('H:i:s');

       if (isset($_POST['submite'])) {
          //$poza = $_FILES["upload"]["name"];

          $queryupload = "INSERT INTO poze (id, poza, id_resto, id_categ, id_fel, id_user, data, nota) VALUES (default, '$filenamenew', $idresto, $idcateg, $idfel, $iduser[0], '$data $time', 9)";
          $resultat = mysqli_query($dbconfig, $queryupload);
   
          if(!$resultat) {
             echo "Eroare la salvarea pozei! Incercati din nou!";
             //$fmsg1 = "Eroare la salvarea pozei! Incercati din nou!";
          }
          else {
             echo "Fisier salvat cu succes!";
             //$fmsg1 = "Poza salvata cu succes!";
             mysqli_close($dbconfig);
          }
       }
    }
    else {
       //echo "Sorry, there was an error uploading your file.";
       echo "Eroare la incarcarea fisierului! Incercati din nou!";
       //$fmsg = "Sorry, there was an error uploading your file.";
    }
 }

 $page = "/comments.php?id=" . $idresto. "-" . $idcateg. "-" .$idfel;
 header("location: $page");
?>