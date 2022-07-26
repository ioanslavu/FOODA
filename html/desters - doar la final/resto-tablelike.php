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
   <li><a href="profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <div id="numeresto"></div>
 <div id="resto"></div>

 <table id="adr">
  <tr><td rowspan="2"><div id="address"></div></td>
   <td><div id="like"><?php include 'scripts/likeimg.php' ;?><span id="likes"></span><?php include 'scripts/like.php'; ?></div></td>
  </tr>
  <tr>
   <td><div id="showmap"></div></td>
  </tr>
 </table>

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

 <?php include 'scripts/resto.php'; ?>
 <script src="/scripts/resto.js"></script>

 <script>
   $("#likeimg").click(function() {
     $("#vote").click();
   });
 </script>

</body>
</html>