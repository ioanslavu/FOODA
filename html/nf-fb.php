<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
 <script src="/scripts/restos.json"></script>
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
   <li><a href="index.php">RESTAURANTE</a></li><div class="pipe"></div>
   <li><a class="active" href="javascript:void(0);">NOUTATI</a></li><div class="pipe"></div>
   <li><a href="profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>
 
 <br><br>

<div class="fb-comments" data-href="http://fooda.go.ro#comments; ?>" data-width="320px" data-numposts="10"></div>

 <?php include 'scripts/nfshow.php'; ?>

</body>
</html>