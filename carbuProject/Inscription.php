<?php
session_start();
require_once 'application/inc/declarations.inc.php';
$body = 'inscription.body.php';

//fonctions jquery.tablesorter pour le tri du tableau
$script = '<script  type="text/javascript" src="./js/newUser.js"></script>';

echo Structure::getHeader($script);
echo Structure::getBody($body);
?>
