<?php
 require('login/dbconfig.php');
 date_default_timezone_set("Europe/Bucharest");

 $query = "SELECT data FROM comments WHERE id_resto = 1 and id_categ = 1 and id_fel = 1 ORDER BY data DESC";
 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {

   //$ymd = '2017-02-01 12:35:08'; //$ymd = $row["data"];
   //$timestamp = strtotime($ymd); //$timestamp = strtotime($row["data"]);
   //$dmy = date("d-m-Y H:i:s", $timestamp);
   //$dmy = date("d-m-Y H:i:s", strtotime($row["data"]));
   $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));

   //echo $dmy;
   echo $row["data"];
   echo "<br>";
  }
 }
?>