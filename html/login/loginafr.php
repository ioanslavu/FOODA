<?php 
 include("dbconfig.php");
 session_start();

 if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $queryuser = "SELECT id FROM users WHERE username = '$username'";
  $rez1 = mysqli_query($dbconfig, $queryuser);
  $rezultate1 = mysqli_fetch_array($rez1);

  $querypass = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
  $rez2 = mysqli_query($dbconfig, $querypass);
  $rezultate2 = mysqli_fetch_array($rez2);

  if (!$rezultate1[0]) {
      $fmsg = "Nume utilizator gresit! Incercati din nou!";
  }
  else {
    if (!$rezultate2[0]) {
      $fmsg ="Parola gresita! Incercati din nou!";
    }
    else {
       $_SESSION['login_user'] = $username;
      header("location: ../index.php");
    }
  }
 }

 mysqli_close($dbconfig);
?>

<!DOCTYPE html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href="css/login.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../scripts/slideup.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>	
 <br>
<h2>Parola schimbata cu succes, acum va puteti conecta la FoodA+</h2>
 <?php
  if(isset($fmsg)) {
    echo "<div id='alert' role='alert'>";
    echo $fmsg;
    echo "</div>";
  }
 ?>
<script>
 $(function() {
  if (localStorage.chkbx && localStorage.chkbx != '') {
    $('#remember_me').attr('checked', 'checked');
    $('#username').val(localStorage.usrname);
    $('#password').val(localStorage.password);
  }
  else {
    $('#remember_me').removeAttr('checked');
    $('#username').val('');
    $('#password').val('');
  }

  $('#remember_me').click(function() {
   if ($('#remember_me').is(':checked')) {
    // save username and password
    localStorage.usrname = $('#username').val();
    localStorage.password = $('#password').val();
    localStorage.chkbx = $('#remember_me').val();
    localStorage.flag = 1;
   }
   else {
    localStorage.usrname = '';
    localStorage.password = '';
    localStorage.chkbx = '';
    localStorage.flag = 0;
   }
  });
 });
</script>

 <form method="post">
  <input type="text" class="loginform" id="username" name="username" value = "" placeholder="Nume de utilizator" required><br><br>
  <input type="password" class="loginform" id="password" name="password" value = "" placeholder="Parola" required><br><br>
 <label class="checkbox"><input type="checkbox" value="remember-me" id="remember_me">Remember me<br><br>
  <button type="submit" class="submit" id="submit" name="submit">Conectare</button>

  <a href="forgot.php"><div class="buttonlogin2">Recupereaza-ti contul</div></a>
 </form>
</body>
</html>