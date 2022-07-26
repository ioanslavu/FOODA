$(document).ready(function() {
  $(".loginform").click(function() {
    $("#titlu").slideUp();
  });
});

$(document).ready(function() {
  $("#search").click(function() {
    $("#titlu").slideUp();
    $("#menubar").slideUp();
  });

  $("#back").click(function() {
    $("#titlu").slideDown();
    $("#menubar").slideDown();
    $('#back').hide();
  });

  $('#search').keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13') {
        $(function() {
          $("#titlu").slideDown();
          $("#menubar").slideDown();
        });
      }
  });
});