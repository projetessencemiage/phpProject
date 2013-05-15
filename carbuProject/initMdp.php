<?php
session_start();
require_once 'application/inc/declarations.inc.php';
$body = 'reInitMdp.body.php';

$script = '
	<script  type="text/javascript" src="./js/initMdp.js"></script>
';

echo Structure::getHeader($script);
echo Structure::getBody($body);
?>