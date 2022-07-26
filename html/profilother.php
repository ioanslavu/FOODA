<?php 
 include("login/dbconfig.php");
 session_start();

 if(!$_SESSION['login_user']) {
   header("location:login/index.php");
 }
?>

<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script> 
</head>

<body>
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a href="index.php">RESTAURANTE</a></li><div class="pipe"></div>
   <li><a href="nf.php">NOUTATI</a></li><div class="pipe"></div>
   <li><a href="profilme.php">CONTUL MEU</a></li>
  </ul>
 </div>
 <br>

 <?php include 'scripts/numeother.php'; ?>

 <div class="navprof">
   <a href="javascript: void(0);" id="mycomm" onclick="MyComments();">Comentariile utilizatorului</a><br><br>
   <a href="javascript: void(0);" id="myresto" onclick="MyRestos();">Restaurantele favorite ale utilizatorului</a><br><br>
 </div>

 <div id="mycomments" style="display: none;">
  <?php include 'scripts/othercomments.php'; ?>
 </div>

 <div id="myrestos" style="display: none;">
  <?php include 'scripts/otherrestos.php'; ?>
 </div>

 <script src="scripts/mycomms.js"></script>

 <script>
  $.fn.stars = function() {
    return $(this).each(function() {
      // Get the value
      var val = parseFloat($(this).html());
    
      // Make sure that the value is in 0 - 5 range, multiply to get width
      var size = val * 16;

      // Create stars holder
      var $span = $('<span />').width(size);

      // Replace the numerical value with stars
      $(this).html($span);
    });
  }
	
  $(function() {
    $('span.stars').stars();
  });
 </script>

</body>
</html>