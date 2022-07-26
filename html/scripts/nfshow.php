<?php
 require('login/dbconfig.php');

 $query = "SELECT id, data, comentariu, id_resto, id_user, nota, 1 as Source FROM comments UNION ALL SELECT id, data, comentariu, id_resto, id_user, nota, 2 as Source FROM recenzii UNION ALL SELECT id, data, poza, id_resto, id_user, nota, 3 as Source FROM poze ORDER BY data DESC LIMIT 10";
 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
     $nr = 1;

     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $querynfnp = "SELECT nume, prenume FROM users WHERE id = $row[id_user]";
        $resultat1 = mysqli_query($dbconfig, $querynfnp);
        $nume = mysqli_fetch_array($resultat1);

        $querynfrest = "SELECT resto FROM restos WHERE id = $row[id_resto]";
        $resultat2 = mysqli_query($dbconfig, $querynfrest);
        $rest = mysqli_fetch_array($resultat2);

        if ($row["nota"] == 9) {
          $row["nota"] = '0';
          $row["comentariu"] = "<img class='nfpoze' src='uploads/" . $row["comentariu"]. "'>";
        }
																							
        if ($row["Source"] == 2) {
          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'><b><a href='profilother.php?id=$row[id_user]'>" . $nume[0]. " " . $nume[1]. "</a></b><br>Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b> <br>" . $row["data"]. " - Rating: <span class='stars'>" . $row["nota"]. "</span><span class='nr'>#" . $nr. "</span><hr>" . $row["comentariu"]. "</div>";
        }
        elseif ($row["Source"] == 1) {
          $queryidfel = "SELECT id_fel FROM comments WHERE id = $row[id]";
          $resultidfel = mysqli_query($dbconfig, $queryidfel);
          $idfel = mysqli_fetch_array($resultidfel);

          $queryfel = "SELECT id, fel, id_categ FROM fel WHERE id = $idfel[0]";
          $resultfel = mysqli_query($dbconfig, $queryfel);
          $fel = mysqli_fetch_array($resultfel);

          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'><b><a href='profilother.php?id=$row[id_user]'>" . $nume[0]. " " . $nume[1]. "</a></b><br>Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b> -> Fel: <b><a class='link' href='comments.php?id=$row[id_resto]-$fel[2]-$fel[0]'>" . $fel[1]. "</a></b> <br> " . $row["data"]. " - Rating: <span class='stars'>" . $row["nota"]. "</span><span class='nr'>#" . $nr. "</span><hr>" . $row["comentariu"]. "</div>";
        }
        else {
          $queryidfel = "SELECT id_fel FROM poze WHERE id = $row[id]";
          $resultidfel = mysqli_query($dbconfig, $queryidfel);
          $idfel = mysqli_fetch_array($resultidfel);

          $queryfel = "SELECT id, fel, id_categ FROM fel WHERE id = $idfel[0]";
          $resultfel = mysqli_query($dbconfig, $queryfel);
          $fel = mysqli_fetch_array($resultfel);

          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'><b><a href='profilother.php?id=$row[id_user]'>" . $nume[0]. " " . $nume[1]. "</a></b><br>Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b> -> Fel: <b><a class='link' href='comments.php?id=$row[id_resto]-$fel[2]-$fel[0]'>" . $fel[1]. "</a></b><br>" . $row["data"]. "<span class='nr'>#" . $nr. "</span><hr>" . $row["comentariu"]. "</div>";
        }

        $nr++;
     }
 }
 else {
     echo "<br>Nu exista stiri recente.";
 }
 
 mysqli_close($dbconfig);
?>