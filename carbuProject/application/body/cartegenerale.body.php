<?php 
require_once 'ListeStationServiceClass.inc.php';
$infoStations = "";
$critere = "";
$actionForm = "";
$listeStation = new ListeStationService();
//Recherche de la liste à afficher sur la map
if (array_key_exists('actionForm', $_POST)) {
	Fonctions::inputHidden('actionForm', $_POST['actionForm']);
	if ($_POST['actionForm'] == "searchVille") {
		Fonctions::inputHidden('searchVille', $_POST['searchVille']);
		Fonctions::inputHidden('searchVilleDpt', $_POST['searchVilleDpt']);
		$ville = $_POST["searchVille"];
		$dpt = $_POST["searchVilleDpt"];
		$listeStation->getStationsByVille($ville, $dpt);
		$critere = 'Recherche par ville - '.$ville. ' ('.$dpt.')';
	} else if ($_POST['actionForm'] == "searchDpt") {
		Fonctions::inputHidden('searchDpt', $_POST['searchDpt']);
		$dpt = $_POST["searchDpt"];
		$listeStation->getStationsByDpt($dpt);
		$critere = 'Recherche par departement - '.$dpt;
	} else if ($_POST['actionForm'] == "searchCP") {
		Fonctions::inputHidden('searchCP', $_POST['searchCP']);
		$cp = $_POST["searchCP"];
		$listeStation->getStationsByCP($cp);
		$critere = 'Recherche par code postal - '.$cp;
	} else if ($_POST['actionForm'] == "searchAdresse") {
		Fonctions::inputHidden('searchAdresse', $_POST['searchAdresse']);
		$adr = $_POST["searchAdresse"];
		$rayon = $_POST["rayon"];
		$listeStation->getStationsByAdresse($adr, $rayon);
		$critere = 'Recherche par adresse - '.$adr.' avec un rayon de '.$rayon.' km';
	} else if ($_POST['actionForm'] == "searchArroundMe") {
		Fonctions::inputHidden('rayonAroundMe', $_POST['rayonAroundMe']);
		$rayonArround = $_POST["rayonAroundMe"];
		$listeStation->getStationsArroundMe($rayonArround);
		$critere = 'Recherche around me - Rayon: '.$rayonArround.' km';
	}
} else {
	$listeStation->getStationsArroundMe('10');
	$critere = 'Recherche par default around me - Rayon 10 km';
}
if (array_key_exists("carburantType", $_POST)) {
	$carbuType = $_POST["carburantType"];
} else {
	$carbuType = "diesel";
}

//Recuperation des infos des Stations pour affichage dans la MAP
$infoStations = $listeStation->getInformationsStations();
//Gestion de la liste déroulante
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
<strong>'.$alert.' - </strong>'.$nbStation.' stations trouvees avec vos criteres de recherches
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
			 <label class="select">
			 Carburant &nbsp;
				<?php Fonctions::echoList('carburantType', $listeC, $defaultCarbu, true, false, 'changeCarbu()'); ?> 
			</label>			
		</fieldset>
	</div>
	<div class="span8">	 
		<div id="map-canvas"/>
	</div>
</div>
<input type="hidden" name="infoStations" id="infoStations" value="<?php echo $infoStations?>"/>


