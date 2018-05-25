<html>
<head>
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <script>
  function initMap(data) {
    var uluru = {lat: 48.3795995, lng: -4.523425399999951};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 4,
      height:300,
      center: uluru

    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });

  }
  </script>
  <title>Map</title>
  <link rel="stylesheet" href="<?php echo asset('css/design.css')?>" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body class="fond">
  <div class="container-fluid">
    <div class="row" id="bandeau">
      <div class="col-md-2">
        <div id="logo">
          <img class="image" src="<?php echo asset('IMG/logo.png')?>" height="175px" width="250px"></img>
        </div>
      </div>
      <div class="col-md-9" >
        <h1 class="titre">Google map</h1>
      </div>
      <div class="col-md-1">
        <a onclick="if(!confirm('Deconnexion ?')) return false;" href="{{ url('/logout') }}"><img src="<?php echo asset('img/logout.png')?>" class="deconnexion" height="50px" width="50px"></img></a>
      </div>
    </div>

    <hr class="hraffiche"/>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div id="map">
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAO-L_7JnbHhfJqxJo5CJSmMzrQ7esl56I&callback=initMap"></script>
      </div>
    </div>
    <div class="col-md-4">
      <table class="center-block" id="table">
        <thead>
          <tr>
            <th>Mobile</th>
            <th>Latitute</th>
            <th>Longitute</th>
            <th>Heure</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>huawei</td>
            <td id="latitude"> 48.4000000</td>
            <td id="longitude">-4.4833300</td>
            <td>11h45</td>
          </tr>
          <tr>
            <td>apple</td>
            <td> 48.853</td>
            <td>2.35</td>
            <td>13h</td>
          </tr>
          <tr>
            <td>sony</td>
            <td>48.26484088119172</td>
            <td>0.6159650192494155</td>
            <td>08h45</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#table tbody tr").click(function(){
  var latitude = $("#latitude").text();
  var longitude = $("#longitude").text();
  var position = {lat: latitude, lng: longitude};
  alert(latitude + "  " +  longitude);
});
</script>
</body>
</html>
