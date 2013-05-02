<?php
require_once 'application/inc/declarations.inc.php';
require_once 'UserClass.inc.php';

if (array_key_exists('USER', $_SESSION)) {
	$user = unserialize($_SESSION['USER']);
}

echo '
<h3 class="muted">Carbu Project</h3>
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="active"><a href="index.php">Home</a></li>
							<li><a href="CarteGenerale.php" title="Qui est le moins cher ? ">Qui est le moins cher ?</a></li>
							<li><a href="ListeStations.php" title="Liste des stations ">Liste des stations</a></li>
							<li><a href="Formulaires.php" title="Formulaire">Trouver une station</a></li>
							<li><a href="NewStation.php" title="NewStation">Ajouter une station</a></li>
						</ul>
						 
						<div class="navbar-form pull-right">';
    						if (!array_key_exists('USER', $_SESSION)) {
    							echo '
    							<input id="connexionLogin" type="text" class="input-small" placeholder="Login">
    							<input id="connexionPwd" type="password" class="input-small" placeholder="Password">
    							<button onClick="return connexionUser()" class="btn-success">Connexion</button>
    							';
    						} else {
    							echo '<button onClick="return deconnexionUser()" class="btn btn-danger">Déconnexion</button>';
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
