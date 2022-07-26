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
 
 <include 'scripts/uploadpoza.php';>

 <!--form action="upload.php" method="post" enctype="multipart/form-data"-->
 <form action="comments.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
 </form><hr>

 <form method="POST" id="review">

   <?php
    if(isset($fmsg)) {
     echo "<div class='alert' role='alert'>";
     echo $fmsg;
     echo "</div>";
    }
   ?>

  <?php include 'scripts/comment.php'; ?>
 
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
    $("#review").on("submit", function () {
     var nota = $('#nota').text();
     $(this).append("<input type='hidden' name='mynota' value=' " + nota + " '/>");
    });
   });
  </script>
  <br><br>

  <div id="nota"></div>
  <br>

  <button type="submit" name="trimite" value="trimite" title="Trimite mesajul">Trimite</button>
  <button type="button" name="reset" value="reset" title="Reseteaza" onClick="sterge()">Reset</button>
 </form>

 <hr>

 <?php include 'scripts/commentshow.php'; ?>

 <script src="scripts/rating.js"></script>
 <script src="scripts/caract.js"></script>
 <script src="scripts/sterge.js"></script>
 <script src="scripts/produs.js"></script>


</body>
</html>