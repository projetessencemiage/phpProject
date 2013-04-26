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
session_start();
session_unset();
$login = $_POST['login'];
$pwd = $_POST['pwd'];
$user = new User();

//Verification FORM
if ($login == "" || $pwd == "") {
	$code = '3';
	$message = "Veuillez renseigner un login ET un password";
} else {
	if ($user->isExistUser($login, $pwd)) {
		$code = 1;
		$message = "Bienvenue sur l'application";
		$_SESSION['USER'] = serialize($user);
		$_SESSION['navMessage'] = '';
	} else {
		$code = 3;
		$message = "Login/Password incorect";
	}
}


echo 'OK|'.$code.'|'.$message;

?>