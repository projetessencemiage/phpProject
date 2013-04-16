<?php 
require_once 'ListeStationServiceClass.inc.php';
$infoStations = "";
$critere = "";
$listeStation = new ListeStationService();
//Recherche de la liste à afficher sur la map
if (array_key_exists('actionForm', $_POST)) {
	echo "ACTION - ".$_POST['actionForm'].'</br>';
	if ($_POST['actionForm'] == "searchVille") {
		$ville = $_POST["searchVille"];
		$dpt = $_POST["searchVilleDpt"];
		$listeStation->getStationsByVille($ville, $dpt);
		$critere = "Recherche par ";
	} else if ($_POST['actionForm'] == "searchDpt") {
		$dpt = $_POST["searchDpt"];
		$listeStation->getStationsByDpt($dpt);
	} else if ($_POST['actionForm'] == "searchCP") {
		$cp = $_POST["searchCP"];
		$listeStation->getStationsByCP($cp);
	} else if ($_POST['actionForm'] == "searchAdresse") {
		$adr = $_POST["searchAdresse"];
		$rayon = $_POST["rayon"];
		$listeStation->getStationsByAdresse($adr, $rayon);
	} else if ($_POST['actionForm'] == "searchArroundMe") {
		$rayonArround = $_POST["rayonAroundMe"];
		$listeStation->getStationsArroundMe($rayonArround);
	}

} else {
	$listeStation->getStationsArroundMe('10');
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
<strong>'.$alert.' - </strong>'.$nbStation.' stations trouvées avec vos critères de recherches
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
