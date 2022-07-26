<?php
 require('login/dbconfig.php');

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "select resto from restos where id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $rezultat = mysqli_fetch_array($result);

 echo "<script>document.getElementById('numeresto2').innerHTML = 'Meniu $rezultat[0]';</script>";

 $querycat = "select * from categ where id in (select distinct id_categ from fel where id_resto = $idresto)";
 $resultcat = mysqli_query($dbconfig, $querycat);

 while($row = mysqli_fetch_assoc($resultcat)) {
   echo "<button class='accordion'>" . $row["categ"]. "</button><div class='panel'>";

   $queryfel = "select * from fel where id_resto = $idresto and id_categ = $row[id]";
   $resultfel = mysqli_query($dbconfig, $queryfel);

   while($rowfel = mysqli_fetch_assoc($resultfel)) {
     echo "<a href='comments.php?id=$idresto-" . $row["id"]. "-" . $rowfel["id"]. "'><div id='box'>" . $rowfel["fel"]. "<div id='pret'>" . $rowfel["pret"]. " lei</div></div></a>";
   }
  echo "</div>";
 }

 mysqli_close($dbconfig);
?>