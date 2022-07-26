<?php
 require('login/dbconfig.php');

 $sql = "select data, comentariu, id_resto, id_user, nota from comments union all select data, comentariu, id_resto, id_user, nota from recenzii union all select data, poza, id_resto, id_user, nota from poze order by data DESC LIMIT 10";
 $result = mysqli_query($dbconfig, $sql);

 if (mysqli_num_rows($result) > 0) {
 $nr = 1;
     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $querynfnp = "select nume, prenume from users where id = $row[id_user]";
        $resultat1 = mysqli_query($dbconfig, $querynfnp);
        $nume = mysqli_fetch_array($resultat1);

        $querynfrest = "select resto from restos where id = $row[id_resto]";
        $resultat2 = mysqli_query($dbconfig, $querynfrest);
        $rest = mysqli_fetch_array($resultat2);

        if ($row["nota"] == 9) {
          $row["nota"] = '-';
          $row["comentariu"] = "<img class='nfpoze' src='uploads/" . $row["comentariu"]. "'>";
        }

        echo "<div class='commentshow'>" . $row["data"]. " - Rating: " . $row["nota"]. " - Restaurant: <b>" . $rest[0]. "</b><span class='nr'>#" . $nr. "</span><br><b>" . $nume[0]. " " . $nume[1]. "</b> a scris: <hr>" . $row["comentariu"]. "</div>";
 $nr++;
     }
 }
 else {
     echo "<br>Nu exista stiri recente.";
 }
 
 mysqli_close($dbconfig);
?>