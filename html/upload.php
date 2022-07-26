<?php
 
 require('login/dbconfig.php');
 session_start();
 date_default_timezone_set("Europe/Bucharest");

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 //if (isset($_POST['submite'])) {
   $error = FALSE;

   $imageFileType = pathinfo($_FILES["upload"]["name"],PATHINFO_EXTENSION);

   // Check if file already exists
   //if (file_exists($target_file)) {
     //echo "Sorry, file already exists.";
     //$uploadOk = 0;
     //$errors = "<br><br>Exista deja un fisier cu acest nume! Incercati din nou!";
     //$error = TRUE;
   //}
 
   // Allow certain file formats
   if (strtoupper($imageFileType) != "JPG" && strtoupper($imageFileType) != "PNG" && strtoupper($imageFileType) != "JPEG" && strtoupper($imageFileType) != "GIF") {
     $errors = "<br><br>Formate acceptate, only JPG, JPEG, PNG & GIF! Incercati din nou!";
     $error = TRUE;
   }

   // Check file size
   if ($_FILES["upload"]["size"] > 5000000) {
     $errors = "<br><br>Fisier prea mare! Incercati din nou!";
     $error = TRUE;
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
       $errors = "<br><br>Fisier incarcat cu succes!";
       //$error = TRUE;

       $data = date("Y-m-d");
       $time = date('H:i:s');

       $queryupload = "INSERT INTO poze (id, poza, id_resto, id_categ, id_fel, id_user, data, nota) VALUES (default, '$filenamenew', $idresto, $idcateg, $idfel, $iduser[0], '$data $time', 9)";
       $resultat = mysqli_query($dbconfig, $queryupload);

       if(!$resultat) {
         $errors = "<br><br>Eroare la salvarea pozei! Incercati din nou!";
         //$error = TRUE;
       }
       else {
         $errors = "<br><br>Fisier salvat cu succes!";
         //$error = TRUE;
         mysqli_close($dbconfig);
         $page = "/comments.php?id=" . $idresto. "-" . $idcateg. "-" .$idfel;
         header("refresh: 1; url=$page");
       }    
     }
     else {
       $errors = "<br><br>Eroare la incarcare! Incercati din nou!";
       //$error = TRUE;
     }
   }
 }
?>

<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>

 <div id="pozaprodus"></div>    
 <div id="numeprodus"></div>         
 <div id="descprodus"></div>
 <div id="pretprodus"></div>
 <br>

 <form method="POST" action="" enctype="multipart/form-data">
  Selecteaza o imagine:<br><br>
  <input type="file" id="upload" name="upload">
  <input type="submit" id="submite" name="submite">
  <?php if(isset($errors)) { echo $errors; } ?>
 </form>
  
</body>
</html>