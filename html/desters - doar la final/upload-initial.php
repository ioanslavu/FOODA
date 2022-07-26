<?php

 require('login/dbconfig.php');
 session_start();

 $login_session = $_SESSION['login_user'];


 $target_dir = "uploads/";
 $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 $uploadOk = 1;
 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

 // Check if image file is a actual image or fake image
 //if(isset($_POST["submit"])) {
 //    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
 //    if($check !== false) {
 //       echo "File is an image - " . $check["mime"] . ".";
 //       $uploadOk = 1;
 //    }
 //    else {
 //       echo "File is not an image.";
 //       $uploadOk = 0;
 //    }
 //}


 // Check if file already exists
 if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
 }


 // Check file size
 if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
 }


 // Allow certain file formats
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
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
 else {  $uploadOk = 0; // Error occured
  //print($result);
 }
 curl_close ($ch);


 // Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
 }
 // if everything is ok, try to upload file
 else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

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
  echo $poza;

   $queryupload = "INSERT INTO `poze` (id, poza, id_resto, id_categ, id_fel, id_user, data, nota) VALUES (default, '$poza', $resto, $categ, $fel, $iduser[0], '$data $time', 9)";
   $resultat = mysqli_query($dbconfig, $queryupload);
   
   if(!$resultat) {
     //$fmsg = "Eroare la incarcarea pozei! Incercati din nou!";
     echo "Eroare la incarcarea pozei! Incercati din nou!";
   }

  //unset($_POST);
  mysqli_close($dbconfig);
 }
 }
    else {
        echo "Sorry, there was an error uploading your file.";
    }
 }

?>