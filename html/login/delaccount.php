<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/login.css"/>
 <script src="http://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a href="../index.php">RESTAURANTE</a></li><div class="pipe"></div>
   <li><a href="../nf.php">NOUTATI</a></li><div class="pipe"></div>
   <li><a class="active" href="../profilme.php">CONTUL MEU</a></li>
  </ul>
 </div>
 <br>

 <div id="part2" style="display: none;">
  <p style="text-align: center">Sunteti sigur ca vreti sa stergeti contul?<br>Toate comentariile si datele contului Dvs. vor fi sterse.</p><br>

  <?php 
   require('dbconfig.php');
   session_start();

   $login_session = $_SESSION['login_user'];

   if (isset($_POST['cancel'])) {
     header("Location: ../profilme.php");
   }

   if (isset($_POST['delacc'])) {
     $querypass = "SELECT id FROM users WHERE username = '$login_session'";
     $result = mysqli_query($dbconfig, $querypass);
     $rez = mysqli_fetch_array($result);

     $querydlt = "DELETE FROM poze WHERE id_user = $rez[0]";
     $dlt = mysqli_query($dbconfig, $querydlt);

     $querydlt = "DELETE FROM recenzii WHERE id_user = $rez[0]";
     $dlt = mysqli_query($dbconfig, $querydlt);

     $querydlt = "DELETE FROM comments WHERE id_user = $rez[0]";
     $dlt = mysqli_query($dbconfig, $querydlt);

     $querydlt = "DELETE FROM users WHERE id = $rez[0]";
     $dlt = mysqli_query($dbconfig, $querydlt);

     mysqli_close($dbconfig);
     echo "<script>localStorage.usrname = '';localStorage.password = '';localStorage.chkbx = '';localStorage.flag = 0;window.location = 'index.php';</script>";
   }
  ?>

  <form method="post" action="" style="text-align: center;">
   <button type="submit" class="submit2b" id="delacc" name="delacc">Da</button>
   <button type="submit" class="submit2b" id="cancel" name="cancel">Nu</button>
  </form>
 </div>

 <div id="part1">
  <?php 
   require('dbconfig.php');
   session_start();

   $login_session = $_SESSION['login_user'];

   if (isset($_POST['submit'])) {
     $password = $_POST['password'];

     $querypass = "SELECT id FROM users WHERE username = '$login_session' AND password = '$password'";
     $result = mysqli_query($dbconfig, $querypass);
     $rez = mysqli_fetch_array($result);

     if (!$rez[0]) {
       echo "<div id='alert' role='alert'>Parola gresita! Incercati din nou!</div>";
     }
     else {
       echo "<script text='text/javascript'>$('#part2').show(); $('#part1').css('display','none');</script>";
     }

     mysqli_close($dbconfig);
   }
  ?>

  <form method="post" action="">
   <input type="password" class="loginform" id="password" name="password" value = "" placeholder="Parola" required><br><br>
   <button type="submit" class="submit" id="submit" name="submit">Verifica</button>
  </form>
 </div>

</body>
</html>