<?php
session_start();
require_once 'application/inc/declarations.inc.php';
$body = 'findStation.body.php';
echo Structure::getHeader();
echo Structure::getBody($body,'', "CarteGenerale.php");
?>