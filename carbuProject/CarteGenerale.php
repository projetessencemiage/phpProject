<?php
require_once 'application/inc/declarations.inc.php';
$body = 'cartegenerale.body.php';

$script = '
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCUByYr5--YM9yGNvIZQJbbq9htgLwm9U&sensor=false">
    </script>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <script  type="text/javascript" src="./js/CarteGenerale.js"></script>
    <script  type="text/javascript" src="./js/maps.js"></script>
';

echo Structure::getHeader();
echo Structure::getBody($body,'','',$script);
?>