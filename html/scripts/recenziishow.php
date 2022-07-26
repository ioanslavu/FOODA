<?php
 require('login/dbconfig.php');
 date_default_timezone_set("Europe/Bucharest");

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 $data = date("Y-m-d");
 $time = date('H:i:s');

 $query = "SELECT data, nota, comentariu, id_user FROM recenzii WHERE id_resto = $idresto ORDER BY data DESC";
 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $querynp = "SELECT nume, prenume FROM users WHERE id = $row[id_user]";
        $resultat = mysqli_query($dbconfig, $querynp);
        $nume = mysqli_fetch_array($resultat);

        $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
        echo "<div class='commentshow'>" . $row["data"]. " - Rating: <span class='stars'>" . $row["nota"]. "</span><br><b><a href='profilother.php?id=$row[id_user]'>" . $nume[0]. " " . $nume[1]. "</a></b><hr>" . $row["comentariu"]. "</div>";
     }
 }
 else {
     echo "Fii primul care scrie un comentariu.";
 }
 
 mysqli_close($dbconfig);
?>