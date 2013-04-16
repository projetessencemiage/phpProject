<?php 
require_once 'ListeStationServiceClass.inc.php';
$infoStations = "";
$critere = "";
$listeStation = new ListeStationService();
//Recherche de la liste à afficher sur la map
if (array_key_exists('actionForm', $_POST)) {
	if ($_POST['actionForm'] == "searchVille") {
		$ville = $_POST["searchVille"];
		$dpt = $_POST["searchVilleDpt"];
		$listeStation->getStationsByVille($ville, $dpt);
		$critere = 'Recherche par ville - '.$ville. '('.$dpt.')';
	} else if ($_POST['actionForm'] == "searchDpt") {
		$dpt = $_POST["searchDpt"];
		$listeStation->getStationsByDpt($dpt);
		$critere = 'Recherche par département - '.$dpt;
	} else if ($_POST['actionForm'] == "searchCP") {
		$cp = $_POST["searchCP"];
		$listeStation->getStationsByCP($cp);
		$critere = 'Recherche par code postal - '.$cp;
	} else if ($_POST['actionForm'] == "searchAdresse") {
		$adr = $_POST["searchAdresse"];
		$rayon = $_POST["rayon"];
		$listeStation->getStationsByAdresse($adr, $rayon);
		$critere = 'Recherche par adresse - '.$adr.' avec un rayon de '.$rayon.' km';
	} else if ($_POST['actionForm'] == "searchArroundMe") {
		$rayonArround = $_POST["rayonAroundMe"];
		$listeStation->getStationsArroundMe($rayonArround);
		$critere = 'Recherche around me - Rayon: '.$rayonArround.' km';
	}

} else {
	$listeStation->getStationsArroundMe('10');
	$critere = 'Recherche par default around me - Rayon 10 km';
}
$infoStations = $listeStation->getInformationsStations();
//Affichage du message d'entete
$nbStation =  count($listeStation->getStations());
if ($nbStation > 0 ) {
	$class = "alert-success";
	$alert = "Info";
} else {
	$class = "alert-error";
	$alert = "Attention";
}
echo '
<div class="alert '.$class.'">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>'.$alert.' - </strong>'.$nbStation.' stations trouvées avec vos critères de recherches
<br/> '.$critere.'
</div>';

?>
<h2>Qui est le moins cher ?</h2>
<div class="row-fluid">
	<div class="span6">
		<iframe
			src="carteStations.php?infoStations=<?php echo $infoStations?>"
			name="frame" frameborder=yes width="500" height="400"></iframe>
	</div>
	<div class="span6">
		<fieldset>
			<legend> Se situer </legend>
			<input type="text" name="newAdresse" id="newAdresse"
				placeholder="Saisir une nouvelle adresse" />
		</fieldset>

		<fieldset>
			<legend>Paramètres</legend>
			<label for="carburantType">Choix du carburant : </label> <select
				name="carburantType" id="carburantType">
				<option value="1">Diesel</option>
				<option value="2">SP-95</option>
				<option value="3">GPL</option>
			</select>
		</fieldset>

		<p>
			<input type="submit" value="Lancer la recherche"
				onClick="return validerForm()" class="btn" /> <input type="reset"
				value="Annuler" class="btn" />
		</p>
	</div>
</div>
