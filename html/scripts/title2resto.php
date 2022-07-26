<?php
 require('login/dbconfig.php');

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "SELECT resto FROM restos WHERE id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $nume = mysqli_fetch_array($result);

 echo "<div id='numeresto2'>$nume[0]</div><br>";
?>