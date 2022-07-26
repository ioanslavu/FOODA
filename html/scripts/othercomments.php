<?php
 require('login/dbconfig.php');

 $url = $_SERVER['REQUEST_URI'];
 $otheruser = explode("-", explode("=", $url, 2)[1], 3)[0];

 $query = "SELECT id, data, comentariu, id_resto, nota, 1 as Source FROM comments WHERE id_user = $otheruser UNION ALL SELECT id, data, comentariu, id_resto, nota, 2 as Source FROM recenzii WHERE id_user = $otheruser UNION ALL SELECT id, data, poza, id_resto, nota, 3 as Source FROM poze WHERE id_user = $otheruser ORDER BY data DESC";
 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
     $i = 1;

     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $queryrest = "SELECT resto FROM restos WHERE id = $row[id_resto]";
        $resultrest = mysqli_query($dbconfig, $queryrest);
        $rest = mysqli_fetch_array($resultrest);

        if ($row["nota"] == 9) {
          $row["nota"] = '0';
          $poza = $row["comentariu"];
          $row["comentariu"] = "<img class='nfpoze' src='uploads/" . $row["comentariu"]. "'>";
        }


        if ($row["Source"] == 2) {
          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'>" . $row["data"]. " - Rating: <span class='stars'>" . $row["nota"]. "</span><br>Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b><hr>" . $row["comentariu"]. "</div>";
        }
        elseif ($row["Source"] == 1) {
          $queryidfel = "SELECT id_fel FROM comments WHERE id = $row[id]";
          $resultidfel = mysqli_query($dbconfig, $queryidfel);
          $idfel = mysqli_fetch_array($resultidfel);

          $queryfel = "select id, fel, id_categ from fel where id = $idfel[0]";
          $resultfel = mysqli_query($dbconfig, $queryfel);
          $fel = mysqli_fetch_array($resultfel);

          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'>" . $row["data"]. " - Rating: <span class='stars'>" . $row["nota"]. "</span><br>Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b> - Fel: <b><a class='link' href='comments.php?id=$row[id_resto]-$fel[2]-$fel[0]'>" . $fel[1]. "</a></b><hr>" . $row["comentariu"]. "</div>";
        }
        else {
          $queryidfel = "SELECT id_fel FROM poze WHERE id = $row[id]";
          $resultidfel = mysqli_query($dbconfig, $queryidfel);
          $idfel = mysqli_fetch_array($resultidfel);

          $queryfel = "SELECT id, fel, id_categ FROM fel WHERE id = $idfel[0]";
          $resultfel = mysqli_query($dbconfig, $queryfel);
          $fel = mysqli_fetch_array($resultfel);

          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'>" . $row["data"]. " - Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b> - Fel: <b><a class='link' href='comments.php?id=$row[id_resto]-$fel[2]-$fel[0]'>" . $fel[1]. "</a></b><hr>" . $row["comentariu"]. "</div>";
        }

        $i++;
     }
 }
 else {
     echo "<br>Acest utilizator nu a scris nici un comentariu.";
 }

?>