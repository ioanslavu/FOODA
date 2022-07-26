<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
 <script src="../scripts/slideup.js"></script>
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

 <div id="input_search">
  <form method="post">
   <a href="#"><img id="back" src="/img/back.png"></a>
   <input type="text" name="search" id="search" maxlenght="50" value="" placeholder="Cautati...">
  </form>

 <div id="restos">
  <?php include 'scripts/populare.php'; ?>
 </div>

 <script src="/scripts/search.js"></script>
<div id="menuba">
  <ul>
   <li><a href="index.php">RESTAURANTE</a></li>
   <li><a class="active" href="index2.php">Populare</a></li>
   <li><a href="https://fooda.go.ro/nearest.php">In apropiere</a></li>
  </ul>
 </div>
</body>
</html>