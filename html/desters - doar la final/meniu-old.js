var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function(){
    $('.panel').collapse.in;
    $(this).next('div:hidden').slideDown('fast').siblings('div:visible').slideUp('fast');		
  }
}