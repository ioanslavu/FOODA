<?php
 require('login/dbconfig.php');
 $login_session = $_SESSION['login_user'];

 $sqluser = "select id from users where username = '$login_session'";
 $res = mysqli_query($dbconfig, $sqluser);
 $res1 = mysqli_fetch_array($res);

 //$sql = "select data, nota, comentariu, id_resto from comments where id_user = '$res1[0]' order by data desc";
 $sql = "select id, data, comentariu, id_resto, nota, 1 as Source from comments union all select id, data, comentariu, id_resto, nota, 2 as Source from recenzii union all select id, data, poza, id_resto, nota, 3 as Source from poze where id_user = '$res1[0]' order by data DESC";
 $result = mysqli_query($dbconfig, $sql);

 if (mysqli_num_rows($result) > 0) {
     $i = 1;

     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $querymy = "select resto from restos where id = $row[id_resto]";
        $resultat = mysqli_query($dbconfig, $querymy);
        $mycomm = mysqli_fetch_array($resultat);

        if ($row["nota"] == 9) {
          $row["nota"] = '-';
          $poza = $row["comentariu"];
          $row["comentariu"] = "<img class='nfpoze' src='uploads/" . $row["comentariu"]. "'>";
        }

        echo "<div class='commentshow'>" . $row["data"]. " - Rating: " . $row["nota"]. "- <b>" . $mycomm[0]. "</b><form method='post' action='testdeletecomm.php'><button type='submit' class='delete' name='delete" . $i. "' value='delete' title='Sterge acest comenari'>Sterge</button></form><hr>" . $row["comentariu"]. "</div>";

        if (isset($_POST["delete$i"])) {
          if ($row["Source"] == 3) {
            $querydlt = "delete from poze where id = $row[id]";
            $dlt = mysqli_query($dbconfig, $querydlt);
            unlink('uploads/' . $poza);
          }
          elseif ($row["Source"] == 2) {
            $querydlt = "delete from recenzii where id = $row[id]";
            $dlt = mysqli_query($dbconfig, $querydlt);
          }
          else {
            $querydlt = "delete from comments where id = $row[id]";
            $dlt = mysqli_query($dbconfig, $querydlt);
          }

          header("Refresh:0");
        }

        $i++;
     }
 }
 else {
     echo "Nu ai scris nici un comentariu.";
 }
?>