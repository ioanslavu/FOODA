<?php
 require('dbconfig.php');
 date_default_timezone_set("Europe/Bucharest");
 $data = date("Y-m-d");
 $time = date('H:i:s');

 if (isset($_POST['submit'])) {
  $error = FALSE;

  // Allow certain file formats
  if (!$_FILES["avatar"]["tmp_name"]) {
    $imageFileType = 'jpg';
    $avatar = 'generic';
  }
  else {
    $imageFileType = pathinfo($_FILES["avatar"]["name"],PATHINFO_EXTENSION);
    if (strtoupper($imageFileType) != "JPG" && strtoupper($imageFileType) != "PNG" && strtoupper($imageFileType) != "JPEG" && strtoupper($imageFileType) != "GIF") {
      $errors = "<br><br>Formate acceptate, only JPG, JPEG, PNG & GIF! Incercati din nou!";
      $error = TRUE;
    }
  }

  // Check file size
  //if ($_FILES["avatar"]["size"] > 1000000) {
    //$errors = "<br><br>Fisier prea mare! Incercati din nou!";
    //$error = TRUE;
  //}

  if (!$error) {
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $oras = $_POST['selected_oras'];

    $queryuser = "SELECT id FROM users WHERE username = '$username'";
    $result = mysqli_query($dbconfig, $queryuser);
    $rez1 = mysqli_fetch_array($result);

    $queryemail = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($dbconfig, $queryemail);
    $rez2 = mysqli_fetch_array($result);



    if ($rez1[0]) {
      $fmsg ="Numele de utilizator este deja inregistrat.";
    }
    else {
      if ($rez2[0]) {
        $fmsg ="Adresa de email este deja inregistrata.";
      }
      else {

       if (empty($nume) or empty($prenume) or empty($email) or empty($username) or empty($password) or empty($oras)) {
         $fmsg = "Toate campurile sunt obligatorii!!!";
       }
       else {
        $query = "INSERT INTO users (id, nume, prenume, email, oras, username, password, datareg, lastseen, avatar, ad) VALUES (default, '$nume', '$prenume', '$email', '$oras', '$username', '$password', '$data $time', '$data $time', '$avatar', 0)";
        $result = mysqli_query($dbconfig, $query);

        $querylast = "SELECT MAX(id) FROM users";
        $result = mysqli_query($dbconfig, $querylast);
        $last = mysqli_fetch_array($result);
        //echo "Last: " . $last[0]. "<br>";

        if ($_FILES["avatar"]["tmp_name"]) {
         $avatar = $last[0] . "." . $imageFileType;
         $target_dir = "/var/www/html/avatars/";
         $target_file = $target_dir . $avatar;

         if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
          $errors = "<br><br>Fisier incarcat cu succes!";
         }
        }
        else {
          $avatar = $avatar . "." . $imageFileType;
        }

        $query = "UPDATE users SET avatar = '$avatar' WHERE id = $last[0]";
        $result = mysqli_query($dbconfig, $query);

        if($result) {
          $fmsg = "Utilizator creat cu succes! Va puteti autentifica!";
          header("refresh: 1; url=index2.html");
        }
        else {
          $fmsg ="Eroare la inregistrare utilizator! Incercati din nou!";
        }
       }
      }
    }
    mysqli_close($dbconfig);
  }
 }
?>

<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="css/login.css"/>
  <link href='//fonts.googleapis.com/css?family=Quintessential' rel='stylesheet'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="../scripts/slideup.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>	
  <h1>Inregistreaza-te la FoodA+</h1>

   <?php
    if(isset($fmsg)) {
     echo "<div class='alert' role='alert'>";
     echo $fmsg;
     echo "</div>";
    }
   ?>

   <form id="form" method="POST" action="" enctype="multipart/form-data">
    <input type="text" name="nume" class="loginform" placeholder="Nume" required><br><br>
    <input type="text" name="prenume" class="loginform" placeholder="Prenume" required><br><br>
<select required id="oras" class="loginform" onchange=" document.getElementById('selected_oras').value=this.options[this.selectedIndex].text">
<option value="">Selecteaza un oras</option>
<option value="1">Abrud</option>
<option value="2">Adjud</option>
<option value="3">Agnita</option>
<option value="4">Aiud</option>
<option value="5">AlbaIulia</option>
<option value="6">Alesd</option>
<option value="7">Alexandria</option>
<option value="8">Amara</option>
<option value="9">Anina</option>
<option value="10">Aninoasa</option>
<option value="11">Arad</option>
<option value="12">Ardud</option>
<option value="13">Avrig</option>
<option value="14">Azuga</option>
<option value="15">Babadag</option>
<option value="16">Babeni</option>
<option value="17">Bacau</option>
<option value="18">BaiadeArama</option>
<option value="19">BaiadeAries</option>
<option value="20">BaiaMare</option>
<option value="21">BaiaSprie</option>
<option value="22">Baicoi</option>
<option value="23">BaileGovora</option>
<option value="24">BaileHerculane</option>
<option value="25">BaileOlanesti</option>
<option value="26">BaileTusnad</option>
<option value="27">Bailesti</option>
<option value="28">Balan</option>
<option value="29">Balcesti</option>
<option value="30">Bals</option>
<option value="31">Baneasa</option>
<option value="32">Baraolt</option>
<option value="33">Barlad</option>
<option value="34">Bechet</option>
<option value="35">Beclean</option>
<option value="36">Beius</option>
<option value="37">Berbesti</option>
<option value="38">Beresti</option>
<option value="39">Bicaz</option>
<option value="40">Bistrita</option>
<option value="41">Blaj</option>
<option value="42">Bocsa</option>
<option value="43">Boldesti-Scaeni</option>
<option value="44">Bolintin-Vale</option>
<option value="45">Borsa</option>
<option value="46">Borsec</option>
<option value="47">Botosani</option>
<option value="48">Brad</option>
<option value="49">Bragadiru</option>
<option value="50">Braila</option>
<option value="51">Brasov</option>
<option value="52">Breaza</option>
<option value="53">Brezoi</option>
<option value="54">Brosteni</option>
<option value="55">Bucecea</option>
<option value="56">Bucuresti</option>
<option value="57">Budesti</option>
<option value="58">Buftea</option>
<option value="59">Buhusi</option>
<option value="60">Bumbesti-Jiu</option>
<option value="61">Busteni</option>
<option value="62">Buzau</option>
<option value="63">Buzias</option>
<option value="64">Cajvana</option>
<option value="65">Calafat</option>
<option value="66">Calan</option>
<option value="67">Calarasi</option>
<option value="68">Calimanesti</option>
<option value="69">Campeni</option>
<option value="70">CampiaTurzii</option>
<option value="71">Campina</option>
<option value="72">CampulungMoldovenesc</option>
<option value="73">Campulung</option>
<option value="74">Caracal</option>
<option value="75">Caransebes</option>
<option value="76">Carei</option>
<option value="77">Cavnic</option>
<option value="78">Cazanesti</option>
<option value="79">CehuSilvaniei</option>
<option value="80">Cernavoda</option>
<option value="81">Chissineu-Cris</option>
<option value="82">Chitila</option>
<option value="83">Ciacova</option>
<option value="84">Cisnadie</option>
<option value="85">Cluj-Napoca</option>
<option value="86">Codlea</option>
<option value="87">Comanesti</option>
<option value="88">Comarnic</option>
<option value="89">Constanta</option>
<option value="90">CopsaMica</option>
<option value="91">Corabia</option>
<option value="92">Costesti</option>
<option value="93">Covasna</option>
<option value="94">Craiova</option>
<option value="95">CristuruSecuiesc</option>
<option value="96">Cugir</option>
<option value="97">CurteadeArges</option>
<option value="98">Curtici</option>
<option value="99">Dabuleni</option>
<option value="100">Darabani</option>
<option value="101">Darmanesti</option>
<option value="102">Dej</option>
<option value="103">Deta</option>
<option value="104">Deva</option>
<option value="105">Dolhasca</option>
<option value="106">Dorohoi</option>
<option value="107">Draganesti-Olt</option>
<option value="108">Dragasani</option>
<option value="109">Dragomiresti</option>
<option value="110">Drobeta-TurnuSeverin</option>
<option value="111">Dumbraveni</option>
<option value="112">Eforie</option>
<option value="113">Fagaras</option>
<option value="114">Faget</option>
<option value="115">Falticeni</option>
<option value="116">Faurei</option>
<option value="117">Fetesti</option>
<option value="118">Fieni</option>
<option value="119">Fierbinti-Targ</option>
<option value="120">Filiasi</option>
<option value="121">Flamanzi</option>
<option value="122">Focsani</option>
<option value="123">Frasin</option>
<option value="124">Fundulea</option>
<option value="125">Gaesti</option>
<option value="126">Galati</option>
<option value="127">Gataia</option>
<option value="128">Geoagiu</option>
<option value="129">Gheorgheni</option>
<option value="130">Gherla</option>
<option value="131">Ghimbav</option>
<option value="132">Giurgiu</option>
<option value="133">GuraHumorului</option>
<option value="134">Harlau</option>
<option value="135">Harsova</option>
<option value="136">Hateg</option>
<option value="137">Horezu</option>
<option value="138">Huedin</option>
<option value="139">Hunedoara</option>
<option value="140">Husi</option>
<option value="141">Ianca</option>
<option value="142">Iasi</option>
<option value="143">Iernut</option>
<option value="144">Ineu</option>
<option value="145">Insuratei</option>
<option value="146">IntorsuraBuzaului</option>
<option value="147">Isaccea</option>
<option value="148">Jibou</option>
<option value="149">Jimbolia</option>
<option value="150">LehliuGara</option>
<option value="151">Lipova</option>
<option value="152">Liteni</option>
<option value="153">Livada</option>
<option value="154">Ludus</option>
<option value="155">Lugoj</option>
<option value="156">Lupeni</option>
<option value="157">Macin</option>
<option value="158">Magurele</option>
<option value="159">Mangalia</option>
<option value="160">Marasesti</option>
<option value="161">Marghita</option>
<option value="162">Medgidia</option>
<option value="163">Medias</option>
<option value="164">MiercureaCiuc</option>
<option value="165">MiercureaNirajului</option>
<option value="166">MiercureaSibiului</option>
<option value="167">Mihailesti</option>
<option value="168">Milisauti</option>
<option value="169">Mioveni</option>
<option value="170">Mizil</option>
<option value="171">Moinesti</option>
<option value="172">MoldovaNoua</option>
<option value="173">Moreni</option>
<option value="174">Motru</option>
<option value="175">Murfatlar</option>
<option value="176">Murgeni</option>
<option value="177">Nadlac</option>
<option value="178">Nasaud</option>
<option value="179">Navodari</option>
<option value="180">Negresti</option>
<option value="181">Negresti-Oas</option>
<option value="182">NegruVoda</option>
<option value="183">Nehoiu</option>
<option value="184">Novaci</option>
<option value="185">Nucet</option>
<option value="186">OcnaMures</option>
<option value="187">OcnaSibiului</option>
<option value="188">OcneleMari</option>
<option value="189">Odobesti</option>
<option value="190">OdorheiuSecuiesc</option>
<option value="191">Oltenita</option>
<option value="192">Onesti</option>
<option value="193">Oradea</option>
<option value="194">Orastie</option>
<option value="195">Oravita</option>
<option value="196">Orsova</option>
<option value="197">OteluRosu</option>
<option value="198">Otopeni</option>
<option value="199">Ovidiu</option>
<option value="200">Panciu</option>
<option value="201">Pancota</option>
<option value="202">Pantelimon</option>
<option value="203">Pascani</option>
<option value="204">Patarlagele</option>
<option value="205">Pecica</option>
<option value="206">Petrila</option>
<option value="207">Petrosani</option>
<option value="208">PiatraNeamt</option>
<option value="209">Piatra-Olt</option>
<option value="210">Pitesti</option>
<option value="211">Ploiesti</option>
<option value="212">Plopeni</option>
<option value="213">PoduIloaiei</option>
<option value="214">Pogoanele</option>
<option value="215">Popesti-Leordeni</option>
<option value="216">Potcoava</option>
<option value="217">Predeal</option>
<option value="218">Pucioasa</option>
<option value="219">Racari</option>
<option value="220">Radauti</option>
<option value="221">RamnicuSarat</option>
<option value="222">RamnicuValcea</option>
<option value="223">Rasnov</option>
<option value="224">Recas</option>
<option value="225">Reghin</option>
<option value="226">Resita</option>
<option value="227">Roman</option>
<option value="228">RosioriideVede</option>
<option value="229">Rovinari</option>
<option value="230">Roznov</option>
<option value="231">Rupea</option>
<option value="232">Sacele</option>
<option value="233">Sacueni</option>
<option value="234">Salcea</option>
<option value="235">Saliste</option>
<option value="236">SalisteadeSus</option>
<option value="237">Salonta</option>
<option value="238">SangeorgiudePadure</option>
<option value="239">Sangeorz-Bai</option>
<option value="240">SannicolauMare</option>
<option value="241">Santana</option>
<option value="242">Sarmasu</option>
<option value="243">SatuMare</option>
<option value="244">Saveni</option>
<option value="245">Scornicesti</option>
<option value="246">Sebes</option>
<option value="247">Sebis</option>
<option value="248">Segarcea</option>
<option value="249">Seini</option>
<option value="250">SfantuGheorghe</option>
<option value="251">Sibiu</option>
<option value="252">SighetuMarmatiei</option>
<option value="253">Sighisoara</option>
<option value="254">Simeria</option>
<option value="255">SimleuSilvaniei</option>
<option value="256">Sinaia</option>
<option value="257">Siret</option>
<option value="258">Slanic</option>
<option value="259">Slanic-Moldova</option>
<option value="260">Slatina</option>
<option value="261">Slobozia</option>
<option value="262">Solca</option>
<option value="263">SomcutaMare</option>
<option value="264">Sovata</option>
<option value="265">Stefanesti,Arges</option>
<option value="266">Stefanesti,Botosani</option>
<option value="267">Stei</option>
<option value="268">Strehaia</option>
<option value="269">Suceava</option>
<option value="270">Sulina</option>
<option value="271">Talmaciu</option>
<option value="272">Tandarei</option>
<option value="273">Targoviste</option>
<option value="274">TarguBujor</option>
<option value="275">TarguCarbunesti</option>
<option value="276">TarguFrumos</option>
<option value="277">TarguJiu</option>
<option value="278">TarguLapus</option>
<option value="279">TarguMures</option>
<option value="280">TarguNeamt</option>
<option value="281">TarguOcna</option>
<option value="282">TarguSecuiesc</option>
<option value="283">Tarnaveni</option>
<option value="284">Tasnad</option>
<option value="285">Tautii-Magheraus</option>
<option value="286">Techirghiol</option>
<option value="287">Tecuci</option>
<option value="288">Teius</option>
<option value="289">Ticleni</option>
<option value="290">Timisoara</option>
<option value="291">Tismana</option>
<option value="292">Titu</option>
<option value="293">Toplita</option>
<option value="294">Topoloveni</option>
<option value="295">Tulcea</option>
<option value="296">Turceni</option>
<option value="297">Turda</option>
<option value="298">TurnuMagurele</option>
<option value="299">Ulmeni</option>
<option value="300">Ungheni</option>
<option value="301">Uricani</option>
<option value="302">Urlati</option>
<option value="303">Urziceni</option>
<option value="304">ValealuiMihai</option>
<option value="305">ValeniideMunte</option>
<option value="306">VanjuMare</option>
<option value="307">Vascau</option>
<option value="308">Vaslui</option>
<option value="309">VatraDornei</option>
<option value="310">VicovudeSus</option>
<option value="311">Victoria</option>
<option value="312">Videle</option>
<option value="313">ViseudeSus</option>
<option value="314">Vlahita</option>
<option value="315">Voluntari</option>
<option value="316">Vulcan</option>
<option value="317">Zalau</option>
<option value="318">Zarnesti</option>
<option value="319">Zimnicea</option>
<option value="320">Zlatna</option>
</select>
    <input type="hidden" name="selected_oras" id="selected_oras" value="" required /><br><br>
    <input type="email" name="email" class="loginform" placeholder="Adresa de email" required><br><br>
    <input type="text" name="username" class="loginform" placeholder="Nume de utilizator" required><br><br>
    <input type="password" name="password" class="loginform" placeholder=Parola required><br><br>
    <div class="loginform">Avatar&nbsp;&nbsp;<input type="file" id="avatar" name="avatar"></div>
    <?php if(isset($errors)) { echo $errors; } ?>

    <p><a href="termco.php">Termeni si conditii</a></p>

    <button type="submit" name="submit" class="submit">Inregistrare</button>
  </form>

</body>
</html>