<?php
session_start();
require_once 'application/inc/declarations.inc.php';
$body = 'profil.body.inc.php';
$script = '<script  type="text/javascript" src="./js/divCache.js"></script>
		   <script  type="text/javascript" src="./js/UserInfo.js"></script>';
echo Structure::getHeader($script);
echo Structure::getBody($body);
?>
