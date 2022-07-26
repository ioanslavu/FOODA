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
 <?php include 'scripts/title2rec.php'; ?>
 <?php include 'scripts/recenzie.php'; ?>

<div class="fb-comments" data-href="http://fooda.go.ro/recenzii.php?id=<?php echo $idresto; ?>" data-width="320px" data-numposts="10"></div>

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

</body>
</html>