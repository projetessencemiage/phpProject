<?php
session_start();
require_once 'application/inc/declarations.inc.php';
$body = 'usersSetting.body.php';

$script = '';

echo Structure::getHeader($script);
echo Structure::getBody($body);
?>
