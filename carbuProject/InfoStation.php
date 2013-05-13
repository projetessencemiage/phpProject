<?php
session_start();
require_once 'application/inc/declarations.inc.php';
require_once 'StationServiceClass.inc.php';
require_once 'ListeEnseigneClass.inc.php';
require_once 'ListeCarburantClass.inc.php';
require_once 'PrixClass.inc.php';
$body = 'infoStation.body.php';

$script = '
	<script  type="text/javascript" src="./js/InfoStation.js"></script>
';

echo Structure::getHeader($script);
echo Structure::getBody($body);
?>