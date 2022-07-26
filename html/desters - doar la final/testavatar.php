<?php
 require('login/dbconfig.php');

 $querylast = "SELECT MAX(id) FROM users";
 $result = mysqli_query($dbconfig, $querylast);
 $last = mysqli_fetch_array($result);
 echo "Last: " . $last[0]. "<br>";

   //$avatar = "Avatar: " . ($last[0]+1). "generic.jpg";
 //$avatar = ($last[0]+1). "generic.jpg";
 $avatar = $last[0]. "generic.jpg";
 echo $avatar;
?>