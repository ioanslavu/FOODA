<?php
require('login/dbconfig.php');

$idresto = 1;

     $query = "SELECT likes FROM restos WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);
     $nrl = mysqli_fetch_array($result);

     $query = "UPDATE restos SET likes = ($nrl[0]-1) WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);

     $query = "SELECT likes FROM restos WHERE id = $idresto";
     $result = mysqli_query($dbconfig, $query);
     $nrl = mysqli_fetch_array($result);

echo $nrl[0];
?>