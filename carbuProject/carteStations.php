<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
    </style>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCUByYr5--YM9yGNvIZQJbbq9htgLwm9U&sensor=false">
    </script>
	<script  type="text/javascript" src="./js/maps.js"></script>
	<script  type="text/javascript" src="./js/utile.js"></script>
	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
  </head>
  <body>
  
  		<div class="container">
			<div class="masthead">
				<?php 
				require_once 'application/inc/declarations.inc.php';
				require_once 'nav-menu.inc.php';?>
			<div id="map-canvas"/>
			</div>
			
			
			</div>
			
				
						
								
  	<?php
  		echo '<input type="hidden" id="Stations" value=""  />'; 
  		echo '<input type="hidden" id="carbuType" value="diesel"  />';
  ?>
  
  
    
  </body>
</html>