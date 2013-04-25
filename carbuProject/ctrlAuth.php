<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ctrlAuth.php
 * @Desc : script contr�le authentification
 * @Autor : TGOU
 * @Date : 25/04/2013
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

require_once 'application/inc/declarations.inc.php';
require_once 'UserClass.inc.php';

$login = $_POST['login'];
$pwd = $_POST['pwd'];
$user = new User();


?>