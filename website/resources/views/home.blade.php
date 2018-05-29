<html>
<head>
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <script>
  // Définition de la variable map
  var map;
  // fonction qui déssine la map
  function initMap(data) {
    // Création d'un tableau
    var tableauLocation = [];
    // Selection des éléments du tableau
    var elements = document.querySelectorAll("#tablePosition tbody tr");
    // Pour chaque eléments
    for(var i = 0; i < elements.length; i++) {
      // On met la localisation dans le tableau tableauLocation
      tableauLocation.push(elements[i]);
    }
    // On définit le tableau uluru
    var uluru = [];
    // Pour chaque eléments dans le tableau tableauLocation
    for (element of tableauLocation) {
      // Je récupère la latitude
      var latitude = parseFloat(element.querySelector("#latitude").innerHTML)
      // Je récupère la longitude
      var longitude = parseFloat(element.querySelector("#longitude").innerHTML)
      // J'insère la position dans le tableau nommé uluru
      uluru.push(new google.maps.LatLng(longitude, latitude))
    }


    // Je déssine la map
    map = new google.maps.Map(document.getElementById('map'), {

      zoom: 7,
      height:300,
      center: uluru[0]
    });

    for(var i = 0; i < uluru.length; i++) {
      var marker = new google.maps.Marker({
        position: uluru[i],
        map: map
      });
    }

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
      <table class="center-block" id="tablePosition">
        <thead>
          <tr>
            <th>Mobile</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Date</th>
          </tr>
        </thead>
        @foreach ($locations as $location)
        <tbody>
          <tr>
            <td>{{ $location->imei }}</td>
            <td id="latitude"> {{ $location->latitude }}</td>
            <td id="longitude">{{ $location->longitude }}</td>
            <td>{{ $location->created_at }}</td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#tablePosition tbody tr").click(function(e) {
  var latitude = parseFloat(e.target.parentNode.querySelector("#latitude").innerHTML)
  var longitude = parseFloat(e.target.parentNode.querySelector("#longitude").innerHTML)
  map.setCenter(new google.maps.LatLng(longitude, latitude))
});
</script>
</body>
</html>
