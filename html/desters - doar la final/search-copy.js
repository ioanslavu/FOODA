$(document).ready(function() {
   $('#input_search #search').addClass('indent1');
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

      });
   }
});