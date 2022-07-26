<?php
 require('dbconfig.php');
 session_start();

 if (isset($_POST['forgot'])) {
  $email = $_POST['email'];

  $query = "SELECT username, password FROM users WHERE email = '$email'";
  $result = mysqli_query($dbconfig, $query);
  $forgot = mysqli_fetch_array($result);

  if (!$forgot[1]) {
    $fmsg = "Aceasta adresa nu exista in baza de date! Incercati din nou!";
  }
  else {
   $destinatar = $_POST['email'];
   $subject = 'Recuperare date FoodA+';
   $body = 'Acest email este un mesaj de confirmare a cererii de recuperare a datelor de utilizator pentru aplicatia FoodA+<br><br>

=========================================================================<br><br>

Datele Dvs. de conectare sunt:<br>
Nume utilizator: ' .$forgot[0]. '<br>
Parola: ' .$forgot[1]. '<br><br>

=========================================================================<br><br>

<p style="font-size:10px; color: #6E6E6E">Acest mesaj a fost trimis de catre aplicatia FoodA+ din sectiunea de recuperare a datelor, la solicitarea unei persoane care a folosit aplicatia FoodA+.
Daca acest mesaj a ajuns din greseala pe adresa Dvs. de email, va rugam frumos sa stergeti acest mesaj.</p>';

   $headers = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

   if (mail($destinatar,$subject,$body,$headers)) {
    $fmsg = "Un email a fost trimis la adresa indicata. Va rugam sa verificati adresa de email, inclusiv folderul Junk sau Spam";
    unset($_POST);
   }
   else {
    $fmsg = "Eroare de comunicatie. Incercati din nou!";
   }
  }
 }

 mysqli_close($dbconfig);
?>

<!DOCTYPE html>

<head>
 <link rel="stylesheet" type="text/css" href="css/login.css"/>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>	
 <br>
<h2>Recupereaza datele</h2>
 <?php
  if(isset($fmsg)) {
    echo "<div id='alert' role='alert'>";
    echo $fmsg;
    echo "</div>";
  }
 ?>

 <form method="POST" id="forgot">
  <input type="email" class="forgotform" id="email" name="email" placeholder="Adresa de email" required><br><br>
  <button type="submit" class="submit" name="forgot" value="forgot" title="Recupereaza datele">Recupereaza datele</button>
 </form>

</body>
</html>