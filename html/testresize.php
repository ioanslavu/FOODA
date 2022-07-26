<?php
 function resize_imagejpg($file, $w, $h) {
   list($width, $height) = getimagesize($file);

   $src = imagecreatefromjpeg($file);
   $dst = imagecreatetruecolor($w, $h);
   imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);

   return $dst;
 }

 function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
 }

 $file = 'restopics/castel.jpg';

 //list($width, $height) = getimagesize('restopics/castel.jpg');
 list($width, $height) = getimagesize($file);

 //echo "imaginea initiala (click <a href='restopics/castel.jpg' target='_blank'>aici</a>):<br>latime: " . $width. " inaltime: " . " ". $height. "<br>";
 echo "imaginea initiala (click <a href='" . $file . "' target='_blank'>aici</a>):<br>latime: " . $width. " inaltime: " . " ". $height. "<br>";

 //echo human_filesize(filesize('restopics/castel.jpg')) . " (" . filesize('restopics/castel.jpg') . " bytes)<br><br>";
 echo human_filesize(filesize($file)) . " (" . filesize($file) . " bytes)<br><br>";

 //$img = resize_imagejpg('restopics/castel.jpg', 150, 150);
 $img = resize_imagejpg($file, 150, 150);

//$imgnew = imagejpeg($img, 'restopics/castelnew.jpg');
//imagejpeg($img, 'restopics/castelnew.jpg');

 $avt = 'restopics/castelnew.jpg';
 imagejpeg($img, $avt);

 list($width, $height) = getimagesize($avt);

 echo "imaginea resize (vezi mai jos):<br>latime: " . $width. " inaltime: " . " ". $height. "<br>";
 echo human_filesize(filesize($avt)) . " (" . filesize($avt) . " bytes)<br><br>";
 echo "<img src=$avt>";
?>