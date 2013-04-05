<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCUByYr5--YM9yGNvIZQJbbq9htgLwm9U&sensor=false">
    </script>
	<script  type="text/javascript" src="./js/maps.js"></script>
  </head>
  <body>
  	
  	<?php 
  	require_once 'application/inc/declarations.inc.php';
  	require_once('geoplugin.class.php');
  	$geoplugin = new geoPlugin();
  	$ip = "147.210.179.67";//$_SERVER["REMOTE_ADDR"];
  	$geoplugin->locate($ip);
  	echo 'L\'adresse est située à '.$geoplugin->city;
  	echo '<input type="hidden" id="latSite" value="'.$geoplugin->latitude.'"  />'; 
  	echo '<input type="hidden" id="longSite" value="'.$geoplugin->longitude.'"  />';  
  ?>
    <div id="map-canvas"/>
  </body>
</html>