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
	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
  </head>
  <body>
  	
  	<?php 
  	require_once 'application/inc/declarations.inc.php';
  	require_once('ListeStationServiceClass.inc.php');
  	
  	$listeStations = new ListeStationService();
  	
  	$listeStations->addStation(new StationService("Rue pierre de COubertin St Medard en Jalles", "2", "Esso"));
  	$listeStations->addStation(new StationService("48 avenue Bougnard 33600 Pessac", "5", "Esso"));
  	$listeStations->addStation(new StationService("49 Rue Robespierre 33400 Talence", "3", "Total"));
  	$listeStations->addStation(new StationService("10 allee de l'eglise 40280 Benquet", "1", "Leclerc"));
  	$listeStations->addStation(new StationService("Leclerc 33400 Talence", "1", "Leclerc"));
  	$listeStations->addStation(new StationService("19 Rue Pacaris 33400 Talence", "1", "Leclerc Talence"));
  	
  	echo '<input type="hidden" id="Stations" value="'.$listeStations->getInformationsStations().'"  />';
  ?>
    <div id="map-canvas"/>
  </body>
</html>