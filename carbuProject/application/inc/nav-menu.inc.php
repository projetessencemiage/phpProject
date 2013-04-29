<?php
require_once 'application/inc/declarations.inc.php';

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
						 
							<div class="navbar-form pull-right">
    						<input id="connexionLogin" type="text" class="input-small" placeholder="Login">
    						<input id="connexionPwd" type="password" class="input-small" placeholder="Password">
    						<button onClick="return connexionUser()" class="btn-success">Connexion</button>
    					</div>
					</div>
				</div>
			</div>


';

?>