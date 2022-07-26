<?php
 require('login/dbconfig.php');
 $login_session = $_SESSION['login_user'];

 $query = "SELECT id FROM users WHERE username = '$login_session'";
 $result = mysqli_query($dbconfig, $query);
 $user = mysqli_fetch_array($result);

 //$sql = "SELECT data, nota, comentariu, id_resto FROM comments WHERE id_user = '$res1[0]' ORDER BY data DESC";
 $query = "SELECT id, data, comentariu, id_resto, nota, 1 as Source FROM comments WHERE id_user = $user[0] UNION ALL SELECT id, data, comentariu, id_resto, nota, 2 as Source FROM recenzii WHERE id_user = $user[0] UNION ALL SELECT id, data, poza, id_resto, nota, 3 as Source FROM poze WHERE id_user = $user[0] ORDER BY data DESC";
 $result = mysqli_query($dbconfig, $query);

 if (mysqli_num_rows($result) > 0) {
     $i = 1;

     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $queryrest = "SELECT resto FROM restos WHERE id = $row[id_resto]";
        $resultrest = mysqli_query($dbconfig, $queryrest);
        $rest = mysqli_fetch_array($resultrest);

        if (empty($row["nota"])) {
          $row["nota"] = '0';
        }

        if ($row["nota"] == 9) {
          $row["nota"] = '0';
          $poza = $row["comentariu"];
          $row["comentariu"] = "<img class='nfpoze' src='uploads/" . $row["comentariu"]. "'>";
        }

        if ($row["Source"] == 2) {
          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'>" . $row["data"]. " - Rating: <span class='stars'>" . $row["nota"]. "</span><br>Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b><form method='post' action=''><button type='submit' class='delete' name='delete" . $i. "' value='delete' title='Sterge acest comentariu'>Sterge</button></form><hr>" . $row["comentariu"]. "</div>";
        }
        elseif ($row["Source"] == 1) {
          $queryidfel = "SELECT id_fel FROM comments WHERE id = $row[id]";
          $resultidfel = mysqli_query($dbconfig, $queryidfel);
          $idfel = mysqli_fetch_array($resultidfel);

          $queryfel = "select id, fel, id_categ from fel where id = $idfel[0]";
          $resultfel = mysqli_query($dbconfig, $queryfel);
          $fel = mysqli_fetch_array($resultfel);

          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'>" . $row["data"]. " - Rating: <span class='stars'>" . $row["nota"]. "</span><br>Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b> - Fel: <b><a class='link' href='comments.php?id=$row[id_resto]-$fel[2]-$fel[0]'>" . $fel[1]. "</a></b><form method='post' action=''><button type='submit' class='delete' name='delete" . $i. "' value='delete' title='Sterge acest comentariu'>Sterge</button></form><hr>" . $row["comentariu"]. "</div>";
        }
        else {
          $queryidfel = "SELECT id_fel FROM poze WHERE id = $row[id]";
          $resultidfel = mysqli_query($dbconfig, $queryidfel);
          $idfel = mysqli_fetch_array($resultidfel);

          $queryfel = "SELECT id, fel, id_categ FROM fel WHERE id = $idfel[0]";
          $resultfel = mysqli_query($dbconfig, $queryfel);
          $fel = mysqli_fetch_array($resultfel);

          $row["data"] = date("d-m-Y H:i:s", strtotime($row["data"]));
          echo "<div class='commentshow'>" . $row["data"]. "<br>Restaurant: <b><a class='link' href='resto.php?id=$row[id_resto]'>" . $rest[0]. "</a></b> - Fel: <b><a class='link' href='comments.php?id=$row[id_resto]-$fel[2]-$fel[0]'>" . $fel[1]. "</a></b><form method='post' action=''><button type='submit' class='delete' name='delete" . $i. "' value='delete' title='Sterge acest comentariu'>Sterge</button></form><hr>" . $row["comentariu"]. "</div>";
        }

        if (isset($_POST["delete$i"])) {
          if ($row["Source"] == 3) {
            $querydlt = "DELETE FROM poze WHERE id = $row[id]";
            $dlt = mysqli_query($dbconfig, $querydlt);
            unlink('uploads/' . $poza);
            header("location:profilme.php");
          }
          elseif ($row["Source"] == 2) {
            $querydlt = "DELETE FROM recenzii WHERE id = $row[id]";
            $dlt = mysqli_query($dbconfig, $querydlt);
            header("location:profilme.php");
          }
          else {
            $querydlt = "DELETE FROM comments WHERE id = $row[id]";
            $dlt = mysqli_query($dbconfig, $querydlt);
            header("location:profilme.php");
          }
        }

        $i++;
     }
 }
 else {
     echo "<br>Nu ai scris nici un comentariu.";
 }

 mysqli_close($dbconfig);
?>