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
 <?php include 'scripts/title2rec.php'; ?>

 <?php include 'scripts/recenzie.php'; ?>

 <form id="recenzie" method="post" action="recenzii.php?id=<?php echo $idresto; ?>">
  <label for="mesaj">Mesaj:&nbsp;</label>
  <textarea cols="20" rows="5" wrap="virtual" id="mesaj" name="mesaj" maxlength="150" onkeyup="nrcaractere()" required></textarea><br>
  <div id="ramase">150 caractere ramase</div><br>
  <script type="text/javascript">window.ready = nrcaractere();</script>

  <div class="rating">
   Acorda o nota:<br>
   <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
   <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
   <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
   <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
   <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
  </div>

  <script>
   $(document).ready(function() {
    $("#recenzie").on("submit", function () {
     var nota = $('#nota').text();

     if (nota == '') {
       nota = '0';
     }

     $(this).append("<input type='hidden' id='mynota' name='mynota' value=' " + nota + " '/>");
    });
   });
  </script>
  <br><br>

  <div id="nota"></div>
  <br>

  <button type="submit" name="trimite" value="trimite" title="Trimite mesajul" required>Trimite</button>
  <button type="button" name="reset" value="reset" title="Reseteaza" onClick="sterge()">Reset</button>
 </form>

 <?php include 'scripts/recenziishow.php'; ?>

 <script src="scripts/rating.js"></script>
 <script src="scripts/caract.js"></script>
 <script src="scripts/sterge.js"></script>

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