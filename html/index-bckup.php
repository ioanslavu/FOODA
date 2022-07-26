<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
 <script src="../scripts/slideup.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>
 <div id="input_search">
  <form method="post">
   <a href="#"><img id="back" src="/img/back.png"></a>
   <input type="text" name="search" id="search" maxlenght="50" value="" placeholder="Cautati...">
<!--   <a href="javascript: void(0)"><img id="advanced" src="/img/advanced.png"></a>-->
  </form>
 </div>

 <div id="adv_search" style="display: none;">
  <a href="findlike.php">Cele mai populare restaurante...</a><br>
  <a href="https://www.bisericasfantulstefan.ro/testgps1.php">Restaurante din apropierea mea...</a>
 </div>

 <div id="restos">
  <?php include 'scripts/search.php'; ?>
 </div>

 <script src="/scripts/search.js"></script>
<div id="menubar">
  <ul>
   <li><a class="active" href="index.php">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilme.php">CONTUL MEU</a></li>
  </ul>
 </div>
</body>
</html>