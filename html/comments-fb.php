<!DOCTYPE html>

<head>
 <link rel="stylesheet" type="text/css" href="css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>

 <div id="fb-root"></div>
 <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a class="active" href="index.php">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <?php include 'scripts/produs.php'; ?>

<?php
 $url = $_SERVER['REQUEST_URI'];
 $idresto = explode("-", explode("=", $url, 2)[1], 3)[0];
 $idcateg = explode("-", explode("=", $url, 2)[1], 3)[1];
 $idfel = explode("-", explode("=", $url, 2)[1], 3)[2];
?>

<div class="fb-comments" data-href="http://fooda.go.ro/comments.php?id=<?php echo $idresto; ?>-<?php echo $idcateg; ?>-<?php echo $idfel; ?>" data-width="320px" data-numposts="10"></div><br>

 <a href="<?php echo $page1; ?>" style="text-decoration: none; color: black;">
  <input type="radio" id="upload" name="value" value="<?php echo $page1; ?>">Incarca o poza</a><br>
 <a href="<?php echo $page2; ?>" style="text-decoration: none; color: black;">
  <input type="radio" id="scrie" name="value" value="<?php echo $page2; ?>">Scrie un comentariu</a><br><br>

 <?php include 'scripts/commentshow-fb.php'; ?>
 <script src="scripts/2radio.js"></script> 

</body>
</html>

