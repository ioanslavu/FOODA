<?php
 require('login/dbconfig.php');
 session_start();
?>



<?php
 //require('login/dbconfig.php');
 //session_start();

 //$login_session = $_SESSION['login_user'];

 $target_dir = "uploads/";
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 // Check if file already exists
 if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $fmsg = "Sorry, file already exists.";
    $uploadOk = 0;
 }


 // Check file size
 if ($_FILES["fileToUpload"]["size"] > 500000000) {
    //echo "Sorry, your file is too large.";
    $fmsg = "Sorry, your file is too large.";
    $uploadOk = 0;
 }


 // Allow certain file formats
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $fmsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
 }

 $file_name_with_full_path = realpath($target_file);
 $api_key = getenv('VT_API_KEY') ? getenv('VT_API_KEY') :'02cd230c282bf2b25db5e58f1d2647a39f51c96b36f56329baa44cd19b996224';
 $cfile = curl_file_create($file_name_with_full_path);
 
 $post = array('apikey' => $api_key,'file'=> $cfile);
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/scan');
 curl_setopt($ch, CURLOPT_POST, True);
 curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging
 curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
 curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER ,True);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
 
 $result=curl_exec ($ch);
 $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 //print("status = $status_code\n");
 if ($status_code == 200) { // OK
  $js = json_decode($result, true);
  //print_r($js);
 }
 else {  // Error occured
  //print($result);
 }
 curl_close ($ch);

 $post = array('apikey' => '02cd230c282bf2b25db5e58f1d2647a39f51c96b36f56329baa44cd19b996224','resource'=>'99017f6eebbac24f351415dd410d522d');
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://www.virustotal.com/vtapi/v2/file/report');
 curl_setopt($ch, CURLOPT_POST,1);
 curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); // please compress data
 curl_setopt($ch, CURLOPT_USERAGENT, "gzip, My php curl client");
 curl_setopt($ch, CURLOPT_VERBOSE, 1); // remove this if your not debugging
 curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
 
 $result = curl_exec ($ch);
 $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 print("status = $status_code\n");

 if ($status_code == 200) { // OK
  $js = json_decode($result, true);
  //print_r($js);
 }
 else {
  $uploadOk = 0; // Error occured
  //print($result);
 }
 curl_close ($ch);


 // Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
    $fmsg = "Sorry, your file was not uploaded.";
 }
 // if everything is ok, try to upload file
 else {
   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
     //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
     $fmsg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

     $queryuser = "select `id` from `users` where username = '$login_session'";
     $rez1 = mysqli_query($dbconfig, $queryuser);
     $iduser = mysqli_fetch_array($rez1);

     $url = $_SERVER['REQUEST_URI'];
     $resto = explode("-", explode("=", $url, 2)[1], 3)[0];
     $categ = explode("-", $url, 3)[1];
     $fel = explode("-", $url, 3)[2];
     $data = date("d-m-Y");
     $time = date('H:i:s', time() + date('Z'));
     //$poza = basename($_FILES["fileToUpload"]["name"]);
     //echo $poza;

     if (isset($_POST['submit'])) {
       $poza = $_FILES["fileToUpload"]["name"];
       //echo $poza;

       $queryupload = "INSERT INTO `poze` (id, poza, id_resto, id_categ, id_fel, id_user, data, nota) VALUES (default, '$poza', $resto, $categ, $fel, $iduser[0], '$data $time', 9)";
       $resultat = mysqli_query($dbconfig, $queryupload);
   
       if(!$resultat) {
         //echo "Eroare la incarcarea pozei! Incercati din nou!";
         $fmsg = "Eroare la incarcarea pozei! Incercati din nou!";
       }

       mysqli_close($dbconfig);
     }
   }
   else {
     $fmsg = "Sorry, there was an error uploading your file.";
   }
 }

?>



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

 <a onclick="unu()" href="testupload.php" style="text-decoration: none; color: black;"><input type="radio" id="upload" name="upload" value="upload">Incarca o poza</a><br>
 <a onclick="doi()" href="testscriecomm.php" style="text-decoration: none; color: black;"><input type="radio" id="scrie" name="comm" value="comm">Scrie un comentariu</a>
 
<div id="unu" style="display: none;">
 <?php include 'scripts/uploadpoza.php'; ?>

 <form method="post" action="comments.php" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">

  <br>
  <?php if(isset($fmsg)) { print $fmsg; } ?>

 </form><hr>

</div>


<div id="doi" style="display: none;">
 <form method="POST" id="review">

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

</div>

 <?php include 'scripts/commentshow.php'; ?>

 <script src="scripts/rating.js"></script>
 <script src="scripts/caract.js"></script>
 <script src="scripts/sterge.js"></script>
 <script src="scripts/produs.js"></script>
 <script src="scripts/2radio.js"></script>
 
</body>
</html>