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
if (array_key_exists('actionForm', $_POST) && $_POST['actionForm'] != "") {
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
		Fonctions::inputHidden('rayon', $_POST['rayon']);
		$adr = $_POST["searchAdresse"];
		$rayon = $_POST["rayon"];
		$coords = $listeStation->getStationsByAdresse($adr, $rayon, $carbuType);
		Fonctions::inputHidden('CoordCarte', $coords['lat'].'-'.$coords['lng']);
		$critere = 'Recherche par adresse - '.$adr.' avec un rayon de '.$rayon.' km';
	} else if ($_POST['actionForm'] == "searchArroundMe") {
		Fonctions::inputHidden('rayonAroundMe', $_POST['rayonAroundMe']);
		$rayonArround = $_POST["rayonAroundMe"];
		$listeStation->getStationsArroundMe($rayonArround, $carbuType);
		$critere = 'Recherche autour de ma position actuelle - Rayon: '.$rayonArround.' km';
	}
} else {
	$listeStation->getStationsArroundMe('10', $carbuType);
	$critere = 'Recherche autour de ma position actuelle - Rayon 10 km';
	Fonctions::inputHidden('actionForm', '');
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

	<fieldset>
				<label class="select"> Carburant &nbsp; <?php Fonctions::echoList('carburantType', $listeC, $defaultCarbu, true, false, 'changeCarbu()'); ?>
				</label>
	</fieldset>

<?php	
	//Tableau des stations
	$stations = $listeStation->getStations();

echo "<table id=\"tablesorter-demo\" class=\"tablesorter\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\">
	<thead>
		<tr>
			<th>Infos</th>
			<th>Carburant</th>
			<th>Ville</th>
			<th>Code Postal</th>
			<th>Station</th>
			<th>Prix</th>
			<th>Mise à jour</th>
			<th>Maps</th>";
			if (Fonctions::getRole($_SESSION) == ROLE_ADMIN) {
				echo "<th>Update</th>";
			}
		echo "</tr>
	</thead>";

echo "<tbody>";
foreach ($stations as $key => $value) {
	$cp = $value->getCP();
	$ville = $value->getVille();
	$enseigne = $value->getEnseigne();
	$id = $value->getID();
	$adresse = $value->getAdresse();
	$tel = $value->getPhone();
	foreach ($value->getListePrix() as $typeCarbu => $array) {
		$carburant = $typeCarbu ;
		$prix = $array['Prix'];
		$dateMaj = Fonctions::getNbJourToString($array['NbJMaj']);
		
		if ($carburant == $carbuType ) { 
			echo "<tr>";
			echo '<td> <a onClick="window.open(\'application/body/popStation.body.php?adresse='.$adresse.' &cp='.$cp.' &ville='.$ville.' &enseigne='.$enseigne.' &tel='.$tel.'\',\'InfoStation\',\'toolbar=0, location=0, directories=0, status=0, scrollbars=0, resizable=1, copyhistory=0, menuBar=1, width=300, height=180\')"><img src="images/icone_infos_station.png" alt="Infos" title="infos station"></a></td>';
			echo "<td>".$carburant."</td>";
			echo "<td>".$ville."</td>";
			echo "<td>".$cp."</td>";
			echo "<td>".$enseigne."</td>";
			echo "<td>".$prix."</td>";
			echo "<td>".$dateMaj."</td>";
			echo '<td><img src="images/icone_france_mini.png" alt="Maps" title="Go to maps" onClick="stationToMaps(\''.$id.'\')"/></td>';
			if (Fonctions::getRole($_SESSION) == ROLE_ADMIN) {
				echo '<td>';
				echo '<a  onClick="goToInfoStation(\''.$id.'\')" title="Informations sur la station ">';
				echo '<i class="icon-pencil"></i>';
				echo '</a>';
				echo '</td>';
				$sStation = serialize($value);
				$eStation = urlencode($sStation);
				Fonctions::inputHidden('station'.$id, $eStation);
			}
			echo "</tr>";
		}
	}
}
echo "</tbody>";
echo "</table>";
Fonctions::inputHidden('stationFromList', '');
$serializeStation = serialize($stations);
$stationEncode = urlencode($serializeStation);
Fonctions::inputHidden('listeStation', $stationEncode);
Fonctions::inputHidden('stationToAfficheInfoID', '');
?>
<h3>Carte</h3>
<P style="text-align:center"><img src="images/carte.png" alt="Go to maps" title="Afficher les stations sur une carte" onClick="stationsToMaps()"/></P>
