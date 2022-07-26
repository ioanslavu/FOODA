<?php
 require('login/dbconfig.php');

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "select lat,lng from restos where id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $coord = mysqli_fetch_array($result);

 mysqli_close($dbconfig);
?>