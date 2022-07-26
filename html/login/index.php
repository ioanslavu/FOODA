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
      $fmsg ="Nume utilizator gresit! Incercati din nou!";
  }
  else {
    if (!$rezultate2[0]) {
      $fmsg ="Parola gresita! Incercati din nou!";
    }
    else {
       $_SESSION['login_user']=$username;
      header("location: ../index.php");
    }
  }
 }

 mysqli_close($dbconfig);
?>
<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/login.css"/>
<script src="../scripts/slideup.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>

<body onload="myFunction()" style="margin:0;">
 <div id="titlu">FoodA+</div>
 <div id="loader"></div>

 <div style="display: none;" id="myDiv" class="animate-bottom">
  <h1>Bine ati venit</h1>
  <br>
  <a href="javascript:void(0);"><div class="buttonlogin" onclick="pagelogin()">Conectare</div></a><br><br><br><br>
  <a href="register.php"><div class="buttonlogin">Inregistrare</div></a>
 
</div>



 <div style="display: none;" id="pagelogin">
<script>
 $(function() {
  if (localStorage.chkbx && localStorage.chkbx != '') {
    $('#remember_me').attr('checked', 'checked');
    $('#username').val(localStorage.usrname);
    $('#password').val(localStorage.password);
    $("#submit" ).trigger("click");
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

 <br>
 <h2>Conecteaza-te la FoodA+</h2>
 <?php
  if(isset($fmsg)) {
    echo "<div id='alert' role='alert'>";
    echo $fmsg;
    echo "</div>";
  }
 ?>
  <form method="post">
  <input type="text" class="loginform" id="username" value ="" name="username" placeholder="Nume de utilizator" required><br><br>
  <input type="password" class="loginform" id="password" value ="" name="password"  placeholder="Parola" required><br><br>
  <label class="checkbox"><input type="checkbox" value="remember-me" id="remember_me">Remember me<br><br>
  <button type="submit" class="submit" id="submit" name="submit">Conectare</button>

  <a href="forgot.php"><div class='buttonlogin2'>Recupereaza-ti contul</div></a>
 </form>
 </div>

 <script>
  var myVar;

  function myFunction() {
    myVar = setTimeout(showPage, 1500);
  }

  function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
  }
function pagelogin() {
    document.getElementById("myDiv").style.display = "none";
 document.getElementById("pagelogin").style.display = "block";
}
 
 </script>

</body>
</html>