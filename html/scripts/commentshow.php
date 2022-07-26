<?php
 require('login/dbconfig.php');
 date_default_timezone_set("Europe/Bucharest");

 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 $idcateg = explode("-", explode("=", $url, 2)[1], 3)[1];
 $idfel = explode("-", explode("=", $url, 2)[1], 3)[2];
 $data = date("Y-m-d");
 $time = date('H:i:s');

 //$sql = "SELECT data, nota, comentariu, id_user FROM comments WHERE id_resto = $idresto and id_categ = $idcateg and id_fel = $idfel ODER BY data DESC";
 $query = "SELECT data, comentariu, id_user, nota FROM comments WHERE id_resto = $idresto and id_categ = $idcateg and id_fel = $idfel UNION ALL SELECT data, poza, id_user, nota FROM poze WHERE id_resto = $idresto and id_categ = $idcateg and id_fel = $idfel ORDER BY data DESC LIMIT 10;";

 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $querynfnp = "SELECT nume, prenume FROM users WHERE id = $row[id_user]";
        $resultnp = mysqli_query($dbconfig, $querynfnp);
        $nume = mysqli_fetch_array($resultnp);

        if (empty($row["nota"])) {
          $row["nota"] = '0';
        }

        $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));

        if ($row["nota"] == 9) {
          $row["nota"] = '0';
          //echo $row["comentariu"];
          $row["comentariu"] = "<img class='nfpoze' src='uploads/" . $row["comentariu"]. "'>";
          echo "<div class='commentshow'>" . $row["data"]. "<br><b><a href='profilother.php?id=$row[id_user]'>" . $nume[0]. " " . $nume[1]. "</a></b><hr>" . $row["comentariu"]. "</div>";
        }
        else {
          echo "<div class='commentshow'>" . $row["data"]. " - Rating: <span class='stars'>" . $row["nota"]. "</span><br><b><a href='profilother.php?id=$row[id_user]'>" . $nume[0]. " " . $nume[1]. "</a></b><hr>" . $row["comentariu"]. "</div>";
        }
     }
 }
 else {
     echo "Fii primul care scrie un comentariu.";
 }
 
 mysqli_close($dbconfig);
?>