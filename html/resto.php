<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
 <link href='//fonts.googleapis.com/css?family=Quintessential' rel='stylesheet'>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a class="active" href="index.php">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilme.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <?php include 'scripts/title2resto.php'; ?>
 <div id="numeresto"></div>
 <div id="resto"></div>
 <div id="adr"></div>

 <div id="like">
  <?php include 'scripts/likeimg.php'; ?>

  <?php
   $query = "SELECT likes FROM restos WHERE id = $idresto";
   $result = mysqli_query($dbconfig, $query);
   $nrl = mysqli_fetch_array($result);
  ?> 
  <span id="likes" title="<?php echo $nrl[0]; ?> likeuri"></span>
  <?php include 'scripts/like.php'; ?>
 </div>

 <div id="fave">
  <?php include 'scripts/faveimg.php'; ?>

  <?php
   $query = "SELECT fav FROM restos WHERE id = $idresto";
   $result = mysqli_query($dbconfig, $query);
   $nrf = mysqli_fetch_array($result);
  ?> 
  <span id="faves" title="<?php echo $nrf[0]; ?> favorite"></span>
  <?php include 'scripts/fave.php'; ?>
 </div>

 <div id="showmap"></div>

 <div id="button1"></div>
 <div id="button2"></div>
 <div id="button3"></div>

 <?php
  $url = $_SERVER['REQUEST_URI'];
  $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 ?>
 <form method="POST" action="resto.php?id=<?php echo $idresto; ?>">
  <input type="submit" id="vote" name="vote" value="" style="display: none;" />
 </form>

 <form method="POST" action="resto.php?id=<?php echo $idresto; ?>">
  <input type="submit" id="fote" name="fote" value="" style="display: none;" />
 </form>

 <?php include 'scripts/resto.php'; ?>
 <script src="/scripts/resto.js"></script>

 <script>
   $("#likeimg").click(function() {
     $("#vote").click();
   });
 </script>

 <script>
   $("#faveimg").click(function() {
     $("#fote").click();
   });
 </script>

</body>
</html>