$('#search').click(function() {
  $('#back').show();
});


$('#search').keypress(function(event) {
   var keycode = (event.keyCode ? event.keyCode : event.which);
   if(keycode == '13') {
      $( function() {
         $('#back').hide();
      });
   }
});