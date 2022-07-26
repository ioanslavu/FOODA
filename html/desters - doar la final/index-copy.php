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
   <li><a class="active" href="javascript:void(0);">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <div id="input_search">
  <form method="post">
   <input type="text" name="search" id="search" maxlenght="50" value="" placeholder="Cautati..."></input>
  </form>
  <img id="lupa" src="img/lupa.png">
  <img id="back" src="img/back.png">
 </div>
 
 <div id="restos">
  <?php include 'scripts/search.php'; ?>
 </div>

 <script src="/scripts/search.js"></script>

</body>
</html>