<?php 
require_once('FonctionsClass.inc.php');
require_once('ListeEnseigneClass.inc.php');

$list_enseignes = new ListeEnseigne();
$enseignes = $list_enseignes->getEnseignes();

if (array_key_exists('actionForm', $_POST) && $_POST['actionForm'] != "") {
	Fonctions::inputHidden('actionForm', $_POST['actionForm']);
	if ($_POST['actionForm'] == "newStation") {
		$ville = $_POST["newStationCity"];
		$cp = $_POST["newStationCp"];
		$adresse = $_POST["newStationAd"];
		$enseigneName = $_POST["enseigneName"];
		$tel = $_POST["newStationNb"];
		
		try{
		if (Fonctions::getRole($_SESSION) == ROLE_ADMIN) {
			$clientSoap = new SoapClient(URL_WCF."/ActionAdmin.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
			$clientSoap->AjouterStationAdmin(array("address" => $adresse, "code_postal" => $cp, "city" => $ville, "tel" => $tel, "id_enseigne" => $enseigneName, "price_list" => array()));
		} else {
			$clientSoap = new SoapClient(URL_WCF."/ActionCommunaute.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
			$clientSoap->PushStationWithAddress(array("address" => $adresse, "code_postal" => $cp, "city" => $ville, "tel" => $tel, "id_enseigne" => $enseigneName, "price_list" => array()));
		}
		var_dump($clientSoap->__getLastResponse());
		}catch (Exception $e){
			echo '
			<div class="alert alert-error" id="boxMsg">
			<button type="button" class="close" data-dismiss="alert" onclick="quitBox(\'boxMsg\')" >&times;</button>
			<strong> Erreur - </strong> Impossible de joindre le service
			<br/>
			</div>';
		}
	}
}
?>

<div class="row-fluid">
	<div class="span12">
		
			<fieldset>
				<legend>Enseigne</legend>
				<?php 
				Fonctions::echoList('enseigneName', $enseignes); 
				?>
			</fieldset>
			
		<fieldset>
			<legend>Nouvelle station</legend>
		</fieldset>
		
		<div id="divNewStation">
			<fieldset>
				<input type="text" name="newStationAd" id="inputNewStationAd"
					placeholder="Adresse de la nouvelle station"
					onChange="deleteInput('newStation')" /> 
			</fieldset>
			<fieldset>
				<input type="text" name="newStationCp" id="inputNewStationCp"
					placeholder="Code postal"
					onChange="deleteInput('newStationCp')" /> 
			</fieldset>
			<fieldset>
				<input type="text" name="newStationCity" id="inputNewStationCity"
					placeholder="Ville"
					onChange="deleteInput('newStationCity')" /> 
			</fieldset>
			<fieldset>
				<input type="text" name="newStationNb" id="inputNewStationNb"
					placeholder="Numéro de téléphone"
					onChange="deleteInput('newStationNb')" /> 
			</fieldset>
			<p>
				<input type="submit" value="Ajouter" onclick="return validerFormNewStation('NewStation.php')" class="btn btn-info" />
				<input type="reset" value="Annuler" class="btn" />
			</p>
		</div>
	</div>
</div>


<input type="hidden" id="actionForm" name="actionForm" value="" />

<input type="hidden" id="navMessage" name="navMessage" value="erreurService" />
