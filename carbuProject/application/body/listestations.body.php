<?php
require_once 'ListeStationServiceClass.inc.php';
$infoStations = "";
$critere = "";
$actionForm = "";
$listeStation = new ListeStationService();
//Gestion du carburant
if (array_key_exists("carburantType", $_POST)) {
	$carbuType = $_POST["carburantType"];
} else {
	$carbuType = "diesel";
}

//Recherche de la liste a afficher
if (array_key_exists('actionForm', $_POST)) {
	Fonctions::inputHidden('actionForm', $_POST['actionForm']);
	if ($_POST['actionForm'] == "searchVille") {
		Fonctions::inputHidden('searchVille', $_POST['searchVille']);
		Fonctions::inputHidden('searchVilleDpt', $_POST['searchVilleDpt']);
		$ville = $_POST["searchVille"];
		$dpt = $_POST["searchVilleDpt"];
		$listeStation->getStationsByVille($ville, $dpt, $carbuType);
		$critere = 'Recherche par ville - '.$ville. ' ('.$dpt.')';
	} else if ($_POST['actionForm'] == "searchDpt") {
		Fonctions::inputHidden('searchDpt', $_POST['searchDpt']);
		$dpt = $_POST["searchDpt"];
		$listeStation->getStationsByDpt($dpt, $carbuType);
		$critere = 'Recherche par département - '.$dpt;
	} else if ($_POST['actionForm'] == "searchCP") {
		Fonctions::inputHidden('searchCP', $_POST['searchCP']);
		$cp = $_POST["searchCP"];
		$listeStation->getStationsByCP($cp, $carbuType);
		$critere = 'Recherche par code postal - '.$cp;
	} else if ($_POST['actionForm'] == "searchAdresse") {
		Fonctions::inputHidden('searchAdresse', $_POST['searchAdresse']);
		$adr = $_POST["searchAdresse"];
		$rayon = $_POST["rayon"];
		$coords = $listeStation->getStationsByAdresse($adr, $rayon, $carbuType);
		Fonctions::inputHidden('CoordCarte', $coords['lat'].'-'.$coords['lng']);
		$critere = 'Recherche par adresse - '.$adr.' avec un rayon de '.$rayon.' km';
	} else if ($_POST['actionForm'] == "searchArroundMe") {
		Fonctions::inputHidden('rayonAroundMe', $_POST['rayonAroundMe']);
		$rayonArround = $_POST["rayonAroundMe"];
		$listeStation->getStationsArroundMe($rayonArround, $carbuType);
		$critere = 'Recherche around me - Rayon: '.$rayonArround.' km';
	}
} else {
	$listeStation->getStationsArroundMe('10', $carbuType);
	$critere = 'Recherche par default around me - Rayon 10 km';
}

//Recuperation des infos des Stations pour affichage dans le tableau
$infoStations = $listeStation->getInformationsStations();
//Gestion de la liste deroulante
require_once('ListeCarburantClass.inc.php');
require_once('FonctionsClass.inc.php');
$listeCarbu = new ListeCarburant();
$listeC = $listeCarbu->getListCarburant();
$defaultCarbu = 'diesel';
if (array_key_exists('carburantType', $_POST)) {
	$defaultCarbu = $_POST["carburantType"];
}

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
<div class="alert '.$class.'" id="boxMsg">
<button type="button" class="close" data-dismiss="alert" onclick="quitBox(\'boxMsg\')" >&times;</button>
<strong>'.$alert.' - </strong>'.$nbStation.' stations trouvées avec vos critères de recherches
<br/> '.$critere.'
<br/><strong id="titleCarbuType">'.$carbuType.'</strong>
</div>';

	echo '<input type="hidden" id="Stations" value="'.$infoStations.'"  />';
	echo '<input type="hidden" id="carbuType" value="'.$carbuType.'"  />';

?>
<h3>Liste des stations</h3>

	<div class="row-fluid">
	<div class="span4">
	<fieldset>
				<label class="select"> Carburant &nbsp; <?php Fonctions::echoList('carburantType', $listeC, $defaultCarbu, true, false, 'changeCarbu()'); ?>
				</label>
	</fieldset>
	</div>
	</div>
<?php	
	$stations = $listeStation->getStations();

echo "<table id=\"tablesorter-demo\" class=\"tablesorter\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\">
	<thead>
		<tr>
			<th>Carburant</th>
			<th>Ville</th>
			<th>Station</th>
			<th>Code Postal</th>
			<th>Prix</th>
			<th>Date de mise a jour</th>
			<th>Maps</th>
		</tr>
	</thead>";

echo "<tbody>";
foreach ($stations as $key => $value) {
	$cp = $value->getCP();
	$ville = $value->getVille();
	$enseigne = $value->getEnseigne();
	$id = $value->getID();
	foreach ($value->getListePrix() as $typeCarbu => $array) {
		$carburant = $typeCarbu ;
		$prix = $array['Prix'];
		$dateMaj = $array['DateMaj'];
		
		if ($carburant == $carbuType ) {
			echo "<tr>";
			echo "<td>".$carburant."</td>";
			echo "<td>".$ville."</td>";
			echo "<td>".$enseigne."</td>";
			echo "<td>".$cp."</td>";
			echo "<td>".$prix."</td>";
			echo "<td>".$dateMaj."</td>";
			echo '<td><img src="images/iconeStation_verte.png" alt="Maps" title="Go to maps" onClick="stationToMaps(\''.$id.'\')"/></td>';
		echo "</tr>";
		}
	}
}
echo "</tbody>";
echo "</table>";
Fonctions::inputHidden('stationFromList', '');
Fonctions::inputHidden('actionForm', '');

?>