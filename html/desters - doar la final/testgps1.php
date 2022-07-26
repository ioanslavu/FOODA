<!DOCTYPE html>
<html>

<head>
<style>
 #map {width:100%;height:100%;}
</style>

<script type="text/javascript">
 
function initGeolocation() {
 if (navigator && navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            console.log('Geolocation is not supported');
        }
}
 
function errorCallback() {
   alert('fara gps');
   alert("gps nu e pornit");
   console.log('gps oprit');
}
 
function successCallback(position) {
      //var mapUrl = "http://maps.google.com/maps/api/staticmap?center=";
      var mapUrl = "http://maps.google.com/maps.google.com/maps?q=24.197611,120.780512&z=18";
      mapUrl = mapUrl + position.coords.latitude + ',' + position.coords.longitude;
      //mapUrl = mapUrl + '&zoom=15&size=512x512&maptype=roadmap&sensor=false';
      var imgElement = document.getElementById("static-map");
      imgElement.src = mapUrl;
}
</script>
</head>

<body onload="javascript:initGeolocation()">
 <div id="map">
  <img id="static-map" src="placeholder.png" />
 </div>

</body>
</html>


