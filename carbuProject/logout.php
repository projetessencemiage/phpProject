<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ctrlAuth.php
 * @Desc : script contrôle authentification
 * @Autor : Atos
 * @Date : 29/03/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

session_start();
require_once 'application/inc/declarations.inc.php';
require_once 'UserClass.inc.php';

require_once 'logout.body.inc.php';
header("location:index.php");

//$body = 'ctrlAuth.body.inc.php';
//echo Structure::getHeader();
//echo Structure::getBody($body);
?>