<?php
 require('login/dbconfig.php');
 //session_start();

 function likes($x) {
   if ($x >= 1000 && $x < 1000000) {
     $x = (intdiv($x, 100) / 10) . "K";
   }
   else if ($x >= 1000000) {
     $x = (intdiv($x, 100000) / 10) . "M";
   }
   else {
     $x = $x;
   }

   echo $x;
 }

 $idresto = 1;

 $query = "SELECT likes FROM restos WHERE id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $nrl = mysqli_fetch_array($result);

likes($nrl[0]);


?>