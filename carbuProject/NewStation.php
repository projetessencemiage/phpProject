<?php
session_start();
require_once 'application/inc/declarations.inc.php';
$body = 'NewStation.body.php';
$script = '<script  type="text/javascript" src="./js/newStation.js"></script>';
echo Structure::getHeader($script);
echo Structure::getBody($body);
?>