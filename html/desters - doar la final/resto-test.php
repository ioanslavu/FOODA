<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos-test.css"/>
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
 <div id="adr"></div>

 <div id="like">
  <img id="likeimg" src="/img/like.png" style="cursor: pointer;" />
  <span id="likes"></span>
  <?php include 'scripts/like.php'; ?>
 </div>

 <div id="showmap"></div>

 <div id="button1"></div>
 <div id="button2"></div>
 <div id="button3"></div>

 <form method="POST" action="resto-test.php?id=1">
  <input type="submit" id="vote" name="vote" value="" style="display: none;" />
 </form>

 <?php include 'scripts/resto-test.php'; ?>
 <script src="/scripts/resto.js"></script>

 <script>
   $("#likeimg").click(function() {
     $("#vote").click();
   });
 </script>

</body>
</html>