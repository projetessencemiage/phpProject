<?php
/**
 * ------------------------------------------------------------------------
 * @Name : identification.php
 * @Desc : identification de l'utilisateur
 * @Autor : Atos
 * @Date : 29/03/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

session_start();
require_once 'application/inc/declarations.inc.php';

$body = 'identification.body.php';
$action='ctrlAuth.php';
echo Structure::getHeader();
echo Structure::getBody($body,'',$action);
?>