<?php 
//POST infos stations
$idStation =  $_POST['stationToAfficheInfoID'];
$stationD = urldecode($_POST['station'.$idStation]);
$station = unserialize($stationD);

//Liste déroulante Liste Enseignes
$list_enseignes = new ListeEnseigne();
$enseignes = $list_enseignes->getEnseignes();

//Liste déroulante Liste Carburants
$listeCarbu = new ListeCarburant();
$listeCarbuById = $listeCarbu->getListCarburant('id');

//Champs cachés
Fonctions::inputHidden('idStation',$idStation);
?>

<h3>
	Station (n°
	<?php echo $idStation;?>
	)
</h3>

<div id="divInfoStation">
	<?php 
	echo '
	<p><address><strong id="enseigneHtml">'.
	$station->getEnseigne()
	.'</strong><br><span id="adresseHtml">'.
	$station->getAdresseComplete()
	.'</span><br><abbr title="Phone">Tel: </abbr><span id="phoneHtml">'.
	$station->getPhone()
	.'</span></address></p><span>Price:<p>';
	$prices = $station->getListePrix();
	foreach ($prices as $carbu => $infos) {
		echo '<strong>'.$carbu.'</strong> - '.$infos["Prix"].' € <span class="majPrix">'.Fonctions::getNbJourToString($infos["NbJMaj"]).'</span>';
		echo '</p></span>';
	}
	$enseigneID = $station->getEnseigneObject()->getid_enseigne();
	?>
</div>
<a id='btnUpdateInfos' class="btn btn-info" onClick="formUpdateInfo()">Update
	infos</a>
<a id='btnUpdatePrix' class="btn btn-info" onClick="formUpdatePrix()">Update
	prix</a>
<a class="btn btn-danger"
	onClick="supprimerStation('<?php echo $idStation?>')">Delete station</a>

<!-- UPDATE INFOS STATION FORM -->
<div id="formUpdateInfos" style="display: none">
	<fieldset>
		<legend>Update infos</legend>
		<fieldset>
			<?php Fonctions::echoList('enseigneName', $enseignes, $enseigneID); ?>
		</fieldset>
		<fieldset>
			<input type="text" name="newStationAdresse" id="newStationAdresse"	placeholder="Adresse de la nouvelle station" value="<?php echo $station->getAdresse();?>" /> 
			<input type="text"	value="<?php echo $station->getCP();?>" name="newStationCp" id="newStationCp" placeholder="Code postal" />
			<input type="text" value="<?php echo $station->getVille();?>" name="newStationCity" id="newStationCity"	placeholder="Ville" />
		</fieldset>
		<fieldset>
			<input type="text" name="newStationPhone" id="newStationPhone" placeholder="Numéro de téléphone" value="<?php echo $station->getPhone();?>" />
		</fieldset>
	</fieldset>
	<a class="btn btn-success" onClick="validerFormUpdateInfo()">Update</a>
</div>
<div id="formUpdatePrix" style="display: none">
	<fieldset>
		<legend>Update prix</legend>
		<fieldset>
			<?php Fonctions::echoList('addPriceCarbuType', $listeCarbuById); ?>
			<input type="text" name="newPrice" id="newPrice" class="input-mini"
				placeholder="Price" />
		</fieldset>
	</fieldset>
	<a class="btn btn-success">Update</a>
</div>
<div id="divErreur"/>