<?php
 $x = 1108;

 if($x >= 1000 && $x < 1000000) {
  //echo number_format((float)($x/1000), 1, '.', '')."k";
  echo (intdiv($x, 100) / 10) . "K";
 }
 else if ($x >= 1000000) {
  echo (intdiv($x, 100000) / 10) . "M";
 }
 else {
  echo $x;
 }
?>