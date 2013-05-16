<?php
require_once 'application/inc/declarations.inc.php';
require_once 'UserClass.inc.php';

if (array_key_exists('USER', $_SESSION)) {
	$user = unserialize($_SESSION['USER']);
}
$urlEnCours = $_SERVER['REQUEST_URI'];

echo '
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="'.Fonctions::activeMenu("index.php", $urlEnCours).'"><a href="index.php">Home</a></li>
							<li class="'.Fonctions::activeMenu("CarteGenerale.php", $urlEnCours).'"><a href="CarteGenerale.php" title="Qui est le moins cher ? ">Qui est le moins cher ?</a></li>
							<li class="'.Fonctions::activeMenu("ListeStations.php", $urlEnCours).'"><a href="ListeStations.php" title="Liste des stations ">Liste des stations</a></li>
							<li class="'.Fonctions::activeMenu("Formulaires.php", $urlEnCours).'"><a href="Formulaires.php" title="Formulaire">Trouver une station</a></li>
							<li class="'.Fonctions::activeMenu("NewStation.php", $urlEnCours).'"><a href="NewStation.php" title="NewStation">Ajouter une station</a></li>
						</ul>
						 
						<div class="navbar-form pull-right">';
    						if (!array_key_exists('USER', $_SESSION)) {
    							echo '
    							<input id="connexionLogin" type="text" class="input-small" placeholder="Login">
    							<input id="connexionPwd" type="password" class="input-small" placeholder="Password">
    							<a  class="btn btn-small btn-success" onClick="return connexionUser()">Connexion</a>
    							<a href="inscription.php" class="btn btn-small btn-primary" title="NewUser">Inscription</a>
    							<a href="pwdForget.php" title="J\'ai oublié mon mot de passe">?</a>
    							';
    						} else {
    							echo '
    							<ul class="nav"><li><a href="UserInfo.php" title="Profil">Mon compte</a></li>';
    							echo '<a onClick="return deconnexionUser()" class="btn btn-danger">Déconnexion</a>';
    						}
    					echo '</div>
					</div>
				</div>
			</div>';
    	
    	//Gestion message d'accueil
    	$class = '';
    	$alert = '';
    	$message = '';
    	$affiche = false;
    	if (array_key_exists('navMessage', $_SESSION)) {
    		if ($_SESSION['navMessage'] == 'Connexion') {
    			$class = 'alert alert-success';
    			$alert = 'Well done ! - ';
    			$message = 'Bienvenue '.$user->getUserName();
    		} else if ($_SESSION['navMessage'] == 'noDroit') {
    			$class = 'alert alert-error';
    			$alert = 'Interdit - ';
    			$message = 'Vous n\'avez pas accès à cette page, droits insuffisants';
    		}
    		$affiche = true;
    		unset($_SESSION['navMessage']);
    	}
		Fonctions::messageToString($affiche, $class, $alert, $message);
?>
