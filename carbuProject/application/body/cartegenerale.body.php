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
		$critere = 'Recherche par ville - '.$ville. ' ('.$dpt.')';
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
	$carbuType = $_POST["carburantType"];
} else {
	$listeStation->getStationsArroundMe('10');
	$critere = 'Recherche par default around me - Rayon 10 km';
	$carbuType = "diesel";
}
//Recuperation des infos des Stations pour affichage dans la MAP
$infoStations = urldecode($listeStation->getInformationsStations());

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
<strong>'.$alert.' - </strong>'.$nbStation.' stations trouvées avec vos critères de recherches
<br/> '.$critere.'
<br/><strong id="titleCarbuType">'.$carbuType.'</strong>
</div>';

?>
<h2>Qui est le moins cher ?</h2>
<div class="row-fluid">
	<div class="span6">
		<iframe
			src="carteStations.php?infoStations=<?php echo $infoStations?>&&carbuType=<?php echo $carbuType?>"
			name="frame" frameborder=yes width="500" height="400"></iframe>
	</div>
	<div class="span6">
		<fieldset>
			 <label class="select">
			 Carburant &nbsp;
				<?php Fonctions::echoList('carburantType', $listeC, $defaultCarbu, true, false, 'changeCarbu()'); ?> 
			</label>			
		</fieldset>
	</div>
</div>
<input type="hidden" name="infoStations" id="infoStations" value="<?php echo $infoStations?>"/>
