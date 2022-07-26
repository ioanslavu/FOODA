var path = window.location.search;
var page = path.split("=").pop();
var id = page.split("/").pop();
var resto = id[0];
var categ = id[2];
var fel = id[4];

obj = JSON.parse(test);
  
document.getElementById("numeprodus").innerHTML =obj.restos[resto-1].meniu[categ-1].feluri[fel-1].nume;
document.getElementById("pozaprodus").innerHTML ="<img src='" + obj.restos[resto-1].meniu[categ-1].poza + "'alt='' />";
document.getElementById("descprodus").innerHTML ="<h2>Descriere produs: </h2><div id='descrierep'>"+obj.restos[resto-1].meniu[categ-1].feluri[fel-1].descriere+"</div>";
document.getElementById("pretprodus").innerHTML ="<h2>Pret: "+obj.restos[resto-1].meniu[categ-1].feluri[fel-1].pret+"</h2>";