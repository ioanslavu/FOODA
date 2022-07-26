<?php
 require('login/dbconfig.php');
 $login_session = $_SESSION['login_user'];

 $sqluser = "select id from users where username = '$login_session'";
 $res = mysqli_query($dbconfig, $sqluser);
 $res1 = mysqli_fetch_array($res);
 //echo $res1[0];

 $sql = "select data, nota, comentariu, id_resto from comments where id_user = '$res1[0]' order by data desc";
 $result = mysqli_query($dbconfig, $sql);

 if (mysqli_num_rows($result) > 0) {
     // output data of each row
     while($row = mysqli_fetch_assoc($result)) {
        $querymy = "select resto from restos where id = $row[id_resto]";
        $resultat = mysqli_query($dbconfig, $querymy);
        $mycomm = mysqli_fetch_array($resultat);
        echo "<div class='commentshow'>" . $row["data"]. " - Rating: " . $row["nota"]. "- <b>" . $mycomm[0]. "</b><hr>" . $row["comentariu"]. "<hr></div>";
     }
 }
 else {
     echo "Nu ai scris nici un comentariu.";
 }
 
 mysqli_close($dbconfig);
?>