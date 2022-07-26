var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    }
    else {
      //panel.style.display = "block";
      $('.panel').collapse.in;
      $(this).next('div:hidden').slideDown('fast').siblings('div:visible').slideUp('fast');
    }  		
  }    
}