<?php
session_start();
require_once 'application/inc/declarations.inc.php';
require_once 'StationServiceClass.inc.php';
require_once 'ListePrixClass.inc.php';
$body = 'infoStation.body.php';

$script = '
';

echo Structure::getHeader($script);
echo Structure::getBody($body);
?>