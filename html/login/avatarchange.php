<?php
 include("dbconfig.php");
 session_start();
 $login_session = $_SESSION['login_user'];

 if(!$_SESSION['login_user']) {
   header("location:index.php");
 }

 if (isset($_POST['stergeavt'])) {
   $queryuser = "SELECT id, avatar FROM users WHERE username = '$login_session'";
   $result = mysqli_query($dbconfig, $queryuser);
   $rez = mysqli_fetch_array($result);

   $query = "UPDATE users SET avatar = 'generic.jpg' WHERE id = $rez[0]";
   $result = mysqli_query($dbconfig, $query);

   unlink('/avatars/' . $rez[1]);
   //rename($rez[1],'generic.jpg');

   header("refresh: 1; url=../profilme.php");

   mysqli_close($dbconfig);
 }
 else {
  if (isset($_POST['submit'])) {
    $error = FALSE;

    $imageFileType = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
 
    // Allow certain file formats
    if (!$_FILES["avatar"]["tmp_name"]) {
      $imageFileType = 'jpg';
      $avatar = 'generic';
    }
    else {
      $imageFileType = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
      if (strtoupper($imageFileType) != "JPG" && strtoupper($imageFileType) != "PNG" && strtoupper($imageFileType) != "JPEG" && strtoupper($imageFileType) != "GIF") {
        $errors = "<br><br>Formate acceptate, only JPG, JPEG, PNG & GIF! Incercati din nou!";
        $error = TRUE;
      }
    }

    // Check file size
    //if ($_FILES["avatar"]["size"] > 1000000) {
      //$errors = "<br><br>Fisier prea mare! Incercati din nou!";
      //$error = TRUE;
    //}


    if (!$error) {
      $queryuser = "SELECT id, avatar FROM users WHERE username = '$login_session'";
      $result = mysqli_query($dbconfig, $queryuser);
      $rez = mysqli_fetch_array($result);

      if ($rez[1] != 'generic.jpg') {
        unlink('/avatars/' . $rez[1]);
      }

      $avatar = $rez[0] . "." . $imageFileType;
      $target_dir = "/var/www/html/avatars/";
      $target_file = $target_dir . $avatar;

      if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
        $errors = "<br><br>Fisier incarcat cu succes!";

        $query = "UPDATE users SET avatar = '$avatar' WHERE id = $rez[0]";
        $result = mysqli_query($dbconfig, $query);

        if($result) {
          $fmsg = "Avatar schimbat cu succes!";
          header("refresh: 1; url=../profilme.php");
        }
        else {
          $fmsg ="Eroare la schimbarea avatarului! Incercati din nou!";
        }
      }
      else {
        $errors = "<br><br>Eroare la incarcare! Incercati din nou!";
      }

      mysqli_close($dbconfig);
   }
  }
 }
?>

<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/login.css"/>
  <link href='//fonts.googleapis.com/css?family=Quintessential' rel='stylesheet'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../scripts/slideup.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>	
  <h2>Schimba avatar</h2>

  <form method="POST" action="" enctype="multipart/form-data">
   <?php
    if(isset($fmsg)) {
     echo "<div class='alert' role='alert'>";
     echo $fmsg;
     echo "</div>";
    }
   ?>

<?php include 'scripts/delavatar.php' ?>

   <div id="form">
    <div class="loginform">Avatar&nbsp;&nbsp;<input type="file" id="avatar" name="avatar"></div>
    <?php if(isset($errors)) { echo $errors; } ?><br><br>
    <button type="submit" class="submit" name="submit" id="submit">Schimba avatar</button><br><br>
    <button type="submit" class="buttonlogin2" name="stergeavt">Sterge avatar</button>
   </div>
  </form>

</body>
</html>