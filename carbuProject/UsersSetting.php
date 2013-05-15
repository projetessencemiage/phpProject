<?php
session_start();
require_once 'application/inc/declarations.inc.php';
$body = 'usersSetting.body.php';

$script = '<script  type="text/javascript" src="./js/userAdmin.js"></script>';

echo Structure::getHeader($script);
echo Structure::getBody($body);
?>
