<?php 
 include("dbconfig.php");
 session_start();

 $login_session = $_SESSION['login_user'];

 if (isset($_POST['submit'])) {
  $passwordold = $_POST['passwordold'];
  $passwordnew = $_POST['passwordnew'];

  $querypass = "SELECT id FROM users WHERE password = '$passwordold'";
  $rez = mysqli_query($dbconfig, $querypass);
  $rezultate = mysqli_fetch_array($rez);

  if (!$rezultate[0]) {
      $fmsg ="Ati introdus o parola curenta incorecta! Incercati din nou!";
  }
  else {
    $querypassnew = "UPDATE users SET password = '$passwordnew' WHERE username = '$login_session'";
    $reznew = mysqli_query($dbconfig, $querypassnew);
    //$rezultate = mysqli_fetch_array($reznew);
     include("logout.php");
    header("location: loginafr.php");
  }
 }

 mysqli_close($dbconfig);
?>

<!DOCTYPE html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href="css/login.css"/>
 <script src="../scripts/back.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>	
 <br>
 <h2>Resetare parola</h2>
 <?php
  if(isset($fmsg)) {
    echo "<div id='alert' role='alert'>";
    echo $fmsg;
    echo "</div>";
  }
 ?>

 <form method="post">
  <input type="text" class="loginform" id="passwordold" name="passwordold" value = "" placeholder="Parola curenta" required><br><br>
<input type="text" class="loginform" id="passwordnew" name="passwordnew" value = "" placeholder="Parola noua" required><br><br>
  <button type="submit" class="submit" id="submit" name="submit">Reseteaza parola</button> 
  <a href="forgot.php"><div class="buttonlogin2">Recupereaza-ti contul</div></a>
 </form>

</body>
</html>