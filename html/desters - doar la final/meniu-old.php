<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
 <link href='//fonts.googleapis.com/css?family=Quintessential' rel='stylesheet'>
 <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script src="/scripts/bootstrap.js"></script>
 <script src="/scripts/bootstrap.min.js"></script>
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

 <div id="numeresto2"></div><br>

 <div id="meniu">
  <?php include 'scripts/meniu.php'; ?>
 </div>

 <script src="scripts/meniu-old.js"></script>

</body>
</html>