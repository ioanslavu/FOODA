<?php
 require('login/dbconfig.php');

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "SELECT * FROM restos WHERE id = $idresto";
 $result = mysqli_query($dbconfig, $query);
 $rezultat = mysqli_fetch_array($result);

 echo "<script>document.getElementById('numeresto').innerHTML = '$rezultat[1]';
 document.getElementById('resto').innerHTML = '<div class=\'resto\'><img src=\'restopics/$rezultat[0]/$rezultat[10]\'>';
 document.getElementById('adr').innerHTML = '$rezultat[3]<br>Tel: $rezultat[5]&nbsp;&nbsp;<a href=\'tel:$rezultat[5]\'><img id=\'phone\' src=\'/img/phone.png\'></a><br>$rezultat[4]';
 document.getElementById('button1').innerHTML = '<a href=\'meniu.php?id=$rezultat[0]\'><div id=\'button\'>Meniu</div></a>';
 document.getElementById('button2').innerHTML = '<a href=\'recenzii.php?id=$rezultat[0]\'><div id=\'button\'>Recenzii</div></a>';
 document.getElementById('button3').innerHTML = '<a href=\'galerie.php?id=$rezultat[0]\'><div id=\'button\'>Galerie Foto</div></a>';
 document.getElementById('showmap').innerHTML = '<input type=\'button\' name=\'show_map\' id=\'show_map\' value=\'Show map\' onclick=\"location.href=\'map.php?id=$idresto\';\" />';</script>";

 mysqli_close($dbconfig);
?>