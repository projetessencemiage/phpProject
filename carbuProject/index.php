<?php
session_start();
require_once 'application/inc/declarations.inc.php';

if (!(isset($_SESSION["SessionEnCours"]))) {
	$_SESSION["SessionEnCours"]=true;
}

$script = '
<script  type="text/javascript" src="./js/index.js"></script>
';

$body = 'index.body.php';
echo Structure::getHeader($script);
echo Structure::getBody($body);
?>
