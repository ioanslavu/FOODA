function nrcaractere() { 
 var comment = document.getElementById("mesaj").value;
 var lung = comment.length;
 document.getElementById("ramase").innerHTML = 150-lung + " caractere ramase";
}