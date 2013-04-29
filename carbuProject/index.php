<?php
session_start();
require_once 'application/inc/declarations.inc.php';

if (!(isset($_SESSION["SessionEnCours"]))) {
	$_SESSION["SessionEnCours"]=true;
}


$body = 'index.body.php';
echo Structure::getHeader();
echo Structure::getBody($body);
?>
