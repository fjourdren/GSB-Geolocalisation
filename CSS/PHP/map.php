<?php 
include "connectAD.php";
$username=shell_exec("echo %username%" );
?>

<!DOCTYPE html>
<html>
<head>
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
<title>MAp</title>

<link href="../CSS/design.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body class="fond">
<div id="fond">
<div id="bandeauAffiche">
	<div id="logo">
		<a href="menu.php"><img class="image" src="../IMG/logo.png" height="175px" width="250px"></img></a>
		<a onclick="if(!confirm('Deconnexion ?')) return false;" href="../iindex.php"><img class="logout" src="../IMG/logout.png" height="50px" width="50px"></img></a>
		<h1>Google map</h1>
		<br/>
		<h2><?php echo "Connect&eacute; : " .$username;?></h2>
		<hr class="hraffiche" ></hr>
	</div>
</div>



  <head>
    <style>
       #map {
        height: 800px;
        width: 75%;
       }
    </style>
  </head>
  <body>
    	
    <div id="map"></div>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=INSERT_KEY&callback=initMap">
    </script>
  </body>
</html>