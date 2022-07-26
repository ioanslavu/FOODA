<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/login.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a href="../index.php">RESTAURANTE</a></li><div class="pipe"></div>
   <li><a href="../nf.php">NOUTATI</a></li><div class="pipe"></div>
   <li><a class="active" href="../profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>
 <br>


 <div id="part2" style="display: none;">
  <p style="text-align: center">Sunteti sigur ca vreti sa stergeti contul?<br>Toate comentariile si datele contului Dvs. vor fi sterse.</p><br>

  <form method="post" action="" style="text-align: center;">
   <button type="submit" class="submit2b" id="delacc" name="delacc">Da</button>
   <button type="submit" class="submit2b" id="cancel" name="cancel">Nu</button>
  </form>
 </div>


 <div id="part1">
  <?php include 'scripts/delacc1.php'; ?>

  <form method="post" action="">
   <input type="password" class="loginform" id="password" name="password" value = "" placeholder="Parola" required><br><br>
   <button type="submit" class="submit" id="submit" name="submit">Verifica</button>
  </form>
 </div>


</body>
</html>