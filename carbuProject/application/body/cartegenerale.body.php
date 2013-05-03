<?php 
require_once 'ListeStationServiceClass.inc.php';
//Données des stations envoyées à la MAP
$infoStations = "";
//Station a afficher dans la DIV Station
$stationToAfficheInfoID = "";
//Libellé de la recherche pour l'entete
$critere = "";
//Action pour choix des stations
$actionForm = "";
$listeStation = new ListeStationService();
//Gestion du carburant
if (array_key_exists("carburantType", $_POST)) {
	$carbuType = $_POST["carburantType"];
} else {
	$carbuType = "diesel";
}
//Gestion des stations
$stationToUpdatePrice;
$stationToAfficheInfo;

//Recherche de la liste à afficher sur la map en fonction de l'action
if (array_key_exists('actionForm', $_POST) && $_POST['actionForm'] != '') {
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
		Fonctions::inputHidden('CoordCarte', $coords['lat'].'@'.$coords['lng']);
		$critere = 'Recherche par adresse - '.$adr.' avec un rayon de '.$rayon.' km';
	} else if ($_POST['actionForm'] == "searchArroundMe") {
		Fonctions::inputHidden('rayonAroundMe', $_POST['rayonAroundMe']);
		$rayonArround = $_POST["rayonAroundMe"];
		$listeStation->getStationsArroundMe($rayonArround, $carbuType);
		$critere = 'Recherche autour de ma position actuelle - Rayon: '.$rayonArround.' km';
	} else if ($_POST['actionForm'] == "stationFromList") {
		Fonctions::inputHidden('stationFromList', $_POST['stationFromList']);
		Fonctions::inputHidden('listeStation', $_POST['listeStation']);
		$stationToAfficheInfoID = $_POST["stationFromList"];
		$decodeListe = urldecode($_POST['listeStation']);
		$stations = unserialize($decodeListe);
		$listeStation->getStationsByID($stationToAfficheInfoID, $stations);
	} else if ($_POST['actionForm'] == "searchHome") {
		Fonctions::inputHidden('searchAdresse', $_POST['searchAdresse']);
		$adr = $_POST["searchAdresse"];
		$coords = $listeStation->getStationsByAdresse($adr, '20', $carbuType);
		Fonctions::inputHidden('CoordCarte', $coords['lat'].'@'.$coords['lng']);
		$critere = 'Recherche domicile ('.$adr.') - Rayon de 20 km';
	}
} else {
	$listeStation->getStationsArroundMe('10', $carbuType);
	$critere = 'Recherche autour de ma position actuelle - Rayon 10 km';
}

//Recuperation des infos des Stations pour affichage dans la MAP
$infoStations = $listeStation->getInformationsStations();
$nbStation =  count($listeStation->getStations());

if (array_key_exists('stationToAfficheInfoID', $_POST) && $_POST['stationToAfficheInfoID'] != "") {
$stationToAfficheInfoID = $_POST['stationToAfficheInfoID'];
$stationToAfficheInfo = $listeStation->getStationsByID($stationToAfficheInfoID, $listeStation->getStations());
$styleDivStation = "";
$afficheDivStation = true;
$stationToUpdatePrice = $_POST['stationToAfficheInfoID'];
} else {
	$styleDivStation = 'style="display: none"';
	$afficheDivStation = false;
}

//Gestion Station Update Price
Fonctions::inputHidden('stationToUpdatePrice', $stationToAfficheInfoID);
//Gestion affichage Station par default
Fonctions::inputHidden('stationToAfficheInfoID', $stationToAfficheInfoID);

//Gestion de la liste déroulante
require_once('ListeCarburantClass.inc.php');
require_once('FonctionsClass.inc.php');
$listeCarbu = new ListeCarburant();
$listeC = $listeCarbu->getListCarburant();
$listeCarbuById = $listeCarbu->getListCarburant('id');
$defaultCarbu = 'diesel';
if (array_key_exists('carburantType', $_POST)) {
	$defaultCarbu = $_POST["carburantType"];
}


//Affichage du message d'entete
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
<h3>Qui est le moins cher ?</h3>
<div class="row-fluid">
	<div class="span4">
		<fieldset>
			<label class="select"> Carburant &nbsp; <?php Fonctions::echoList('carburantType', $listeC, $defaultCarbu, true, false, 'changeCarbu()'); ?>
			</label>
		</fieldset>
		<?php
		//Affichage de la DIV de la station
		echo '
		<div id="divStation" '.$styleDivStation.'>
			<div id="divInfoStation">';
		if ($afficheDivStation == true) {
		echo '
			<p><address><strong>'.
			$stationToAfficheInfo->getEnseigne()
			.'</strong><br>'.
			$stationToAfficheInfo->getAdresseComplete()
			.'<br><abbr title="Phone">Tel: </abbr>'.
			$stationToAfficheInfo->getPhone()
			.'</address></p><p>Price:';
			$prices = $stationToAfficheInfo->getListePrix();
			foreach ($prices as $carbu => $infos) {
				if ($carbuType == $carbu) {
					$redClass = "class='redClass'";
				} else { $redClass = "";}
				echo '<br /><strong '.$redClass.'>'.$carbu.'</strong> - '.$infos["Prix"].' € <span class="majPrix">'.Fonctions::getNbJourToString($infos["NbJMaj"]).'</span>';
			}
			echo '</p>';
		}
			?>
			</div>
			<div id="divAddPriceStation">
				<p onclick="addFormToAddPrice()">
					<i class="icon-plus-sign"></i> Update price
				</p>
				<div id="addPriceForm" style="display: none">
					<label class="select"> Type &nbsp; <?php Fonctions::echoList('addPriceCarbuType', $listeCarbuById); ?>
					</label>
					<input type="text" name="newPrice" id="newPrice" class="input-mini" placeholder="Price" />
					<i id="icone" class="icon-edit" onClick="addPrice()"></i> 
				</div>
			</div>
		</div>
	</div>
	<div class="span8">
		<div id="map-canvas" />
	</div>
</div>
<input
	type="hidden" name="infoStations" id="infoStations"
	value="<?php echo $infoStations?>" />
