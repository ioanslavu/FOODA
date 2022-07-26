<?php 
 include("login/dbconfig.php");
 session_start();

 $login_session = $_SESSION['login_user'];

 $queryuser = "select `id` from `users` where username = '$login_session'";
 $rez1 = mysqli_query($dbconfig, $queryuser);
 $rezultate1 = mysqli_fetch_array($rez1);
 echo $rezultate1[0];
?>