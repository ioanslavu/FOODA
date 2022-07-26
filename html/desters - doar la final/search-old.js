$(document).ready(function() {
   $('#input_search #search').addClass('indent1');

   obj = JSON.parse(test);

   for (i = 0; i < obj.restos.length; i++) {
      document.getElementById("restos").innerHTML += "<div class='resto'><a href='resto.html?id=" + (i+1) + "'><img src='" + obj.restos[i].pic + "'><div class='numerls'>" + obj.restos[i].name + "</div></a></div>";
   }
});


$('#search').click(function() {
  $('#input_search #search').removeClass('indent1');
  $('#input_search #search').addClass('indent2');
  $('#back').show();
});


$('#search').keypress(function(event) {
   var keycode = (event.keyCode ? event.keyCode : event.which);
   if(keycode == '13') {
      $( function() {
         $('#back').hide();
         $('#search').removeClass('indent2');
         $('#input_search #search').addClass('indent1');

         obj = JSON.parse(test);
         var x = document.getElementById('search').value;
	 var count = 0;

	 $("#restos").empty();
	  
         for (i = 0; i < obj.restos.length; i++) {
	    if (obj.restos[i].name.toUpperCase().indexOf(x.toUpperCase()) > -1) {
	       document.getElementById("restos").innerHTML += "<div class='resto'><a href='resto.html?id=" + (i+1) + "'><img src='" + obj.restos[i].pic + "'><div class='numerls'>" + obj.restos[i].name + "</div></a></div>";
	       count = 1;
            }
	 }

	 if (count == 0) {
	    document.getElementById("restos").innerHTML = "0 results";
	 }
		 
	$("#search").val('');
	$("#search").blur();
    });
  }
});