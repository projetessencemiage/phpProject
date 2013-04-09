<?php

session_start();
require_once 'application/inc/declarations.inc.php';

// comptabilise les nouvelles connexions
if (!(isset($_SESSION["SessionEnCours"]))) {
	$_SESSION["SessionEnCours"]=true;
}


$body = 'index.body.php';
echo Structure::getHeader();
echo Structure::getBody($body);
//TEST
?>
