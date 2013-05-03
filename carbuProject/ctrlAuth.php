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
$message = "";
//Verification FORM
if ($login == "" || $pwd == "") {
	$code = '3';
	$message = "Veuillez renseigner un login ET un password";
} else {
	$code = $user->isExistUser($login, $pwd);
	if ($code == 0) {
		$_SESSION[USER] = serialize($user);
		$_SESSION[USER_ROLE] = $user->getRole();
		$_SESSION['navMessage'] = 'Connexion';
	} else if ($code == 1){
		$message = "Login/Password incorect";
	} else if($code == 2) {
		$message = "Serveur inaccessible";
	}
}

echo 'OK|'.$code.'|'.$message;

?>