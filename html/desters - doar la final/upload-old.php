<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>
<div id="menubar">
  <ul>
   <li><a class="active" href="index.php">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>
<div id="numeresto3"></div><br>
 <?php include 'scripts/produs.php'; ?>
<?php include 'scripts/numerest.php'; ?>
 <?php
     $url = $_SERVER['REQUEST_URI'];
     $resto = explode("-", explode("=", $url, 2)[1], 3)[0];
     $categ = explode("-", $url, 3)[1];
     $fel = explode("-", $url, 3)[2];
     $page = "upload1.php?id=$resto-$categ-$fel";
     //echo $page;
 ?>

 <form method="post" action="<?php echo $page; ?>" enctype="multipart/form-data">
  Selecteaza o imagine:<br>
  <input type="file" id="upload" name="upload">
  <input type="submit" id="submite" name="submite">
 </form>

</body>
</html>