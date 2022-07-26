$(document).ready(function() {
  var path = window.location.search;
  var page = path.split("=").pop();
  var id = page.split("=");

  obj = JSON.parse(test);

  document.getElementById("numeresto2").innerHTML = "Recenzii " + obj.restos[id-1].name;obj.restos[id-1].name;
});