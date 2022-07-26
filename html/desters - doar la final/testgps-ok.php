<!DOCTYPE html>

<body onload="getLocation()">
 <script>
  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    }
    else { 
      alert('Geolocation is not supported by this browser.');
    }
  }

  function showPosition(position) {
    alert('Latitude: ' + position.coords.latitude + '\nLongitude: ' + position.coords.longitude);
  }
 </script>

KR: Lat: 44.4809717; Long: 26.1075266<br>
Bu: Lat: 44.4504259, Long: 26.1142871<br>
H: Lat: , Long: <br>
3: Lat: , Long: <br>
</body>
</html>