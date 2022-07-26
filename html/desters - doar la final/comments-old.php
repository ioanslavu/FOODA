<!DOCTYPE html>

<head>
 <link rel="stylesheet" type="text/css" href="css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
 <script src="scripts/restos.json"></script>

</head>

<body>
 <div id="titlu">FoodA+</div>

 <div id="pozaprodus"></div>    
 <div id="numeprodus"></div>         
 <div id="descprodus"></div>
 <div id="pretprodus"></div>

 <?php
     $url = $_SERVER['REQUEST_URI'];
     $resto = explode("-", explode("=", $url, 2)[1], 3)[0];
     $categ = explode("-", $url, 3)[1];
     $fel = explode("-", $url, 3)[2];
 ?>

<form action="">
 <a onclick="unu()" href="upload.php?id=<?php echo $resto; ?>-<?php echo $categ; ?>-<?php echo $fel; ?>" style="text-decoration: none; color: black;"><input type="radio" id="upload" name="upload" value="upload">Incarca o poza</a><br>
 <a onclick="doi()" href="scriecomm.php?id=<?php echo $resto; ?>-<?php echo $categ; ?>-<?php echo $fel; ?>" style="text-decoration: none; color: black;"><input type="radio" id="scrie" name="comm" value="comm">Scrie un comentariu</a>
</form>

 <?php include 'scripts/commentshow.php'; ?>

 <script src="scripts/rating.js"></script>
 <script src="scripts/caract.js"></script>
 <script src="scripts/sterge.js"></script>
 <script src="scripts/produs.js"></script>
 <script src="scripts/2radio.js"></script> 
</body>
</html>