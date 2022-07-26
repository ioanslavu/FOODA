<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="/css/restos-test.css"/>
 <link href='//fonts.googleapis.com/css?family=Quintessential' rel='stylesheet'>
 <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
</head>

<body>
 <div id="titlu">FoodA+</div>
 <div id="menubar">
  <ul>
   <li><a class="active" href="index.php">RESTAURANTE</a></li>
   <li><a href="nf.php">NOUTATI</a></li>
   <li><a href="profilumeu.php">CONTUL MEU</a></li>
  </ul>
 </div>

 <div id="numeresto"></div>
 <div id="resto"></div>
 <div id="adr"></div>

 <?php include 'test.php'; ?>

<div id="idlike"><?php echo "avem: " . $idlike[0]; ?></div>

<label for="like">
    <img id="likeimg" src="/img/like.png" style="cursor: pointer;" />
<script>
 var x = document.getElementById("idlike").value;

 if (x > 0) {
  $("#likeimg").attr('src', '/img/dislike.png');
  alert ("x>0");
  //document.getElementById("likeimg").innerHTML = <img scr="/img/dislike.png">;
 }
 else {
  $("#likeimg").attr('src', '/img/like.png');
  alert ("x=0");
  //document.getElementById("likeimg").innerHTML = <img scr="/img/like.png">;
 }
</script>
</label>

<div id="likeimg"></div>
<form method="POST" action="resto-test.php?id=1">
    <input type="submit" id="vote" name="vote" value="" style="display: none;" />
</form>

<script>
$("#likeimg").click(function(){
    $("#vote").click();
});

</script>

<!--script type="text/javascript"
    $("#likeimg").change(function() {
      $("#vote").click();
    });
</script-->




* * *
@Override
public void onBackPressed() {
    moveTaskToBack(true);
}
* * *

 <div id="showmap"></div>

 <div id="button1"></div>
 <div id="button2"></div>
 <div id="button3"></div>

 <?php include 'scripts/resto-test.php'; ?>
 <script src="/scripts/resto.js"></script>

</body>
</html>