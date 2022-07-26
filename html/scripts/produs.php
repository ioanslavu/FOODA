<?php
 require('login/dbconfig.php');
 date_default_timezone_set("Europe/Bucharest");

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 $idcateg = explode("-", explode("=", $url, 2)[1], 3)[1];
 $idfel = explode("-", explode("=", $url, 2)[1], 3)[2];
 $data = date("d-m-Y");
 $time = date('H:i:s');

 $queryprod = "SELECT fel, descr, pret, felpic FROM fel WHERE id = $idfel";
 $resultprod = mysqli_query($dbconfig, $queryprod);
 $prod = mysqli_fetch_array($resultprod);
  
  
 echo "<div id='pozaprodus'><img src='restopics/$prod[3]'></div>";
 echo "<div id='numeprodus'>$prod[0]</div>";
 echo "<div id='descprodus'><h2>Descriere produs: </h2><div id='descrierep'>$prod[1]</div>";
 echo "<div id='pretprodus'><h2>Pret: $prod[2] lei</h2></div>";

 $page1 = "upload.php?id=$idresto-$idcateg-$idfel";
 $page2 = "scriecomm.php?id=$idresto-$idcateg-$idfel";
?>