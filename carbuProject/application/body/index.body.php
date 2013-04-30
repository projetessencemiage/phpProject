<h2>Qui est le moins cher ?</h2>
<div class="row-fluid">
	<div class="span4">
		<h5>Autour de moi ...</h5>
		<a href="CarteGenerale.php" title="Qui est le moins cher ? "> <img
			SRC="./images/carte.png" ALT="Voir carte" TITLE="Voir carte">
		</a>
	</div>
	<div class="span4">
		<h5>Liste des stations</h5>
		<a href="ListeStations.php" title="Liste des stations "> <img
			SRC="./images/stations.png" ALT="Liste des stations"
			TITLE="Liste des stations">
		</a>
	</div>
	<div class="span4">
		<h5>Statistiques</h5>
		<a href="ListeStations.php" title="Liste des stations"> <img
			SRC="./images/stats.png" ALT="Liste des stations"
			TITLE="Liste des stations">
		</a>
	</div>
</div>
<?php 
if (array_key_exists('USER', $_SESSION)) {
	//Gestion de la carte autour de chez moi
	//adresse de l'user
	$adresseUser =  unserialize($_SESSION['USER'])->getAdresse();
	//Champ caché pour le JS
	Fonctions::inputHidden('searchAdresse', $adresseUser);
	Fonctions::inputHidden('actionForm', '');	
	?>
<div class="row-fluid">
	<div class="span6">
		<h5>Autour de chez moi ...</h5>
	 <img onclick="afficheMapsWithHome()" src="./images/homeSearch.png" ALT="Voir carte autour de chez moi" TITLE="Voir carte autour de chez moi">
	</div>
	<div class="span6">
		<h5>Mon profil</h5>
		<a href="UserInfo.php" title="Voir mon profil "> <img
			SRC="./images/profil.png" ALT="Voir mon profil" TITLE="Voir mon profil">
		</a>
		</p>
	</div>
</div>
<?php 
}
?>