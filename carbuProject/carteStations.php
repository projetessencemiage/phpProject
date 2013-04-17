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
	<script  type="text/javascript" src="./js/utile.js"></script>
	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
  </head>
  <body>
  	
  	<?php 
  	require_once 'application/inc/declarations.inc.php';
  	require_once('ListeStationServiceClass.inc.php');
  	
  	if (array_key_exists("newAdresse",$_GET)) {
  		echo '<input type="hidden" id="newAdresse" value="'.$_GET["newAdresse"].'"  />';
  	}
  	if (array_key_exists("infoStations",$_GET)) {
  		echo '<input type="hidden" id="Stations" value="'.$_GET["infoStations"].'"  />'; 
  	}
  	if (array_key_exists("carbuType",$_GET)) {
  		echo '<input type="hidden" id="carbuType" value="'.$_GET["carbuType"].'"  />';
  	}
  	
  ?>
    <div id="map-canvas"/>
  </body>
</html>