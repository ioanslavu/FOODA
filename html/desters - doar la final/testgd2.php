<?php 
if (function_exists('gd_info')) { 
 print '<h1>GD Info for ' . $_SERVER['SERVER_NAME'] . '</h1>'; 
 print '<pre>'; 
 print_r(gd_info()); 
 print '</pre>'; 
}
else { 
 print 'Libraria GD nu este instalata/disponibila !'; 
} 
?>