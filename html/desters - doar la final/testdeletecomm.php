<?php
 session_start();
?>

<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script> 
</head>

<body>
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a href="index.php">RESTAURANTE</a></li><div class="pipe"></div>
   <li><a href="nf.php">NOUTATI</a></li><div class="pipe"></div>
   <li><a class="active" href="javascript: void(0);">CONTUL MEU</a></li>
  </ul>
 </div>
 <br>

<?php include 'scripts/testmycomments.php'; ?>

</body>
</html>
