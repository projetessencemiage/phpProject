<?php 
require_once('ListeCarburantClass.inc.php');
require_once('FonctionsClass.inc.php');
require_once('/securimage/securimage.php');

$listeCarbu = new ListeCarburant();
$listeC = $listeCarbu->getListCarburant();
if (array_key_exists('actionForm', $_POST) && $_POST['actionForm'] != "") {
	Fonctions::inputHidden('actionForm', $_POST['actionForm']);
	if ($_POST['actionForm'] == "newUser") {
		$securimage = new Securimage();
		if ($securimage->check($_POST['captcha_code']) == false) {
			echo '
			<div class="alert alert-error" id="boxMsg">
			<button type="button" class="close" data-dismiss="alert" onclick="quitBox(\'boxMsg\')" >&times;</button>
			<strong> Erreur - </strong> Captcha erronée
			<br/>
			</div>';
			exit;
		}
			
		
		$civilite = $_POST["civil"];
		$pseudo = $_POST["pseudo"];
		$mdp = hash('sha256',$_POST["mdp"]);
		$mail = $_POST["mail"];
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$address = $_POST["address"];
		$cp = $_POST["cp"];
		$city = $_POST["city"];
		$carbu = $_POST["carburantType"];
		
		var_dump($pseudo);
		var_dump($mdp);
		var_dump($mail);
		var_dump($carbu);
		try{
			$clientSoap = new SoapClient("http://projetm2miage.no-ip.biz:8084/UserService.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
			$clientSoap->InscriptionUser(array("civilite" => $civilite,"nom" => $nom, "prenom" => $prenom, "pseudo" => $pseudo, "email" => $email,"mdp" => $mdp,"adress" => $adresse, "code_postal" => $cp, "ville" => $city, "url_avatar" => null, "string_id_station_favorite" => null, "string_id_carburant_pref" => $carbu));
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
			<legend>Inscription</legend>
		</fieldset>

	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div id="divAroundMe">
			<fieldset>
			<input type="text" name="pseudo" id="pseudo"
					placeholder="Pseudo (identifiant) *"
					onChange="deleteInput('pseudo')" /> 
			</fieldset>
			<fieldset>
			<input type="text" name="mdp" id="mdp"
					placeholder="Mot de passe *"
					onChange="deleteInput('mdp')" /> 
			</fieldset>
			<fieldset>
			<input type="text" name="mail" id="mail"
					placeholder="Mail *"
					onChange="deleteInput('mail')" /> 
			</fieldset>
			<fieldset>
			<input type="text" name="nom" id="nom"
					placeholder="Nom"
					onChange="deleteInput('nom')" /> 
			</fieldset>
			<fieldset>
			<INPUT type= "radio" name="civil" value="monsieur"> Monsieur
			<INPUT type= "radio" name="civil" value="madame"> Madame
			<INPUT type= "radio" name="civil" value="mademoiselle"> Mam'zelle
			</fieldset>
			<fieldset>
			<input type="text" name="prenom" id="prenom"
					placeholder="Prénom"
					onChange="deleteInput('prenom')" /> 
			</fieldset>
			<fieldset>
			<input type="text" name="address" id="address"
					placeholder="Adresse"
					onChange="deleteInput('address')" /> 
			</fieldset>
			
			<fieldset>
			<input type="text" name="cp" id="cp"
					placeholder="Code postal"
					onChange="deleteInput('cp')" /> 
			</fieldset>
			
			<fieldset>
			<input type="text" name="city" id="city"
					placeholder="Ville"
					onChange="deleteInput('city')" /> 
			</fieldset>
			
			<fieldset>
			<legend>Carburant utilisé *</legend>
			<?php Fonctions::echoList('carburantType', $listeC); ?>
			</fieldset>
			
			<fieldset>
				<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
				<input type="text" name="captcha_code" size="10" maxlength="6" />
				<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
			</fieldset>
			<p>
				<input type="submit" value="Around me"
					onClick="return validerFormNewUser('Inscription.php')" class="btn btn-success" />
			</p>
		</div>
	</div>
</div>

<input type="hidden" id="actionForm" name="actionForm" value="" />
