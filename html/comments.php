<!DOCTYPE html>

<head>
 <link rel="stylesheet" type="text/css" href="css/restos.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
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
 <div id="numeresto3"></div><br>

 <?php include 'scripts/produs.php'; ?>

 <a href="<?php echo $page1; ?>" style="text-decoration: none; color: black;">
  <input type="radio" id="upload" name="value" value="<?php echo $page1; ?>">Incarca o poza</a><br>
 <a href="<?php echo $page2; ?>" style="text-decoration: none; color: black;">
  <input type="radio" id="scrie" name="value" value="<?php echo $page2; ?>">Scrie un comentariu</a><br><br>

 <?php include 'scripts/commentshow.php'; ?>
 <script src="scripts/2radio.js"></script> 

 <?php include 'scripts/numerest.php'; ?>

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