<?php
 require('login/dbconfig.php');

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "SELECT resto FROM restos WHERE id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $rezultat = mysqli_fetch_array($result);

 echo "<script>document.getElementById('numeresto3').innerHTML = 'Restaurant $rezultat[0]';</script>";

 mysqli_close($dbconfig);
?>
