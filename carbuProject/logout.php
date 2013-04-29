<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ctrlAuth.php
 * @Desc : script contr�le authentification
 * @Autor : TGOU
 * @Date : 26/04/2013
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

session_start();
require_once 'application/inc/declarations.inc.php';
require_once 'logout.body.inc.php';
header("location:index.php");

?>