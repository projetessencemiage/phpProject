<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ctrlAuth.body.php
 * @Desc : script contrôle authentification
 * @Autor : TGOU
 * @Date : 25/04/2013
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
 if (isset($_POST['nom']) && isset($_POST['pwd'])) {
	$user = new User();
	try {
		$_POST['nom']= htmlspecialchars($_POST['nom']);
		$status = $user->isExistUser($_POST['nom']);		        // v�rification si l'utilisateur existe
		if ($status>0) {
			$user->getUser($_POST['nom']);
			if ($user->password<>$_POST['pwd']) {
				$_SESSION['CodeMessage']=1;			//'Mot de passe incorrect';
			} else {
					$_SESSION['User']=$_POST['nom'];
					$_SESSION['Role']=$user->role;
					$_SESSION['Id_User']=$user->id_user;
				}
		} else {
			$_SESSION['CodeMessage']=3;				//'Nom d\'utilisateur inexistant';
		}

	} catch (MyException $e) {
		throw new MyException($e->getError('User.ctrlAuth'));
		return false;
	}
}
?>