function unu() {
  //document.getElementById("unu").style.display = 'block';
  //document.getElementById("doi").style.display = 'none';
  document.getElementById("upload").checked = true;
  document.getElementById("scrie").checked = false;
  //window.location = "upload.php";
};

function doi() {
  //document.getElementById("doi").style.display = 'block';
  //document.getElementById("unu").style.display = 'none';
  document.getElementById("scrie").checked = true;
  document.getElementById("upload").checked = false;
  //window.location = "scriecomm.php";
};


$(function() {
    $("input[name$='value']").change(function() {
        //alert("http://www."+ this.value +".com");
        window.location = this.value;

    });

});


