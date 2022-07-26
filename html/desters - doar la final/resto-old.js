$(document).ready(function() {
  var path = window.location.search;
  //alert(path);
  var page = path.split("=").pop();
  var id = page.split("=");
  //alert(id);

  obj = JSON.parse(test);

  document.getElementById("numeresto").innerHTML = obj.restos[id-1].name;
  document.getElementById("resto").innerHTML = "<div class='resto'><img src='" + obj.restos[id-1].pic + "'></div>";
  document.getElementById("coord").innerHTML += obj.restos[id-1].address + "<br>Tel: " +  obj.restos[id-1].tel + "&nbsp;&nbsp;<a href='tel:"+obj.restos[id-1].tel+"'><img id='phone' src='/img/phone.png'></a><br>Orar: <br>" + obj.restos[id-1].orar;
  document.getElementById("button1").innerHTML = "<a href='meniu.html?id=" + id + "'><div id='button'>Meniu</div></a>";
  document.getElementById("button2").innerHTML = "<a href='recenzii.php?id=" + id + "'><div id='button'>Recenzii</div></a>";
  document.getElementById("button3").innerHTML = "<a href='galerie.php?id=" + id + "'><div id='button'>Galerie Foto</div></a>";
  document.getElementById("map").innerHTML = "<input type='button' name='harta' id='harta' value='Show map' onclick='showmap();'>";
});