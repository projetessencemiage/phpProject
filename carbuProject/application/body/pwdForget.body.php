<?php 
require_once('ListeCarburantClass.inc.php');
require_once('FonctionsClass.inc.php');
require_once('/securimage/securimage.php');

if (array_key_exists('actionForm', $_POST) && $_POST['actionForm'] != "") {
	Fonctions::inputHidden('actionForm', $_POST['actionForm']);
	if ($_POST['actionForm'] == "pwdForget") {
		$securimage = new Securimage();
		$result = $securimage->check($_POST['captcha_code']); 
		if ($result == false) {
			echo '
			<div class="alert alert-error" id="boxMsg">
			<button type="button" class="close" data-dismiss="alert" onclick="quitBox(\'boxMsg\')" >&times;</button>
			<strong> Erreur - </strong> Captcha incorrect
			<br/>
			</div>';
			exit;
		}
		$pseudo = $_POST["pseudo"];
		try{
			$clientSoap = new SoapClient(URL_WCF."/UserService.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
			$clientSoap->MotDePasseOublie(array("identifiant" => $pseudo));
			$result = $clientSoap->__getLastResponse();
			$dom = new DomDocument();
			$dom->loadXML($result);
			echo "
			<div class=\"alert alert-success\" id=\"boxMsg\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" onclick=\"quitBox('boxMsg')\" >&times;</button>
			<strong> OK - </strong>".$dom->getElementsByTagName('message')->item(0)->nodeValue."
			<br/>
			</div>";
			exit;
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
			<legend>Mot de passe oublié</legend>
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
				<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
				<input type="text" name="captcha_code" size="10" maxlength="6" />
				<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
			</fieldset>
			<p>
				<input type="submit" value="Envoyer demande"
					onClick="return validerFormPwdForget('pwdForget.php')" class="btn btn-success" />
			</p>
		</div>
	</div>
</div>

<input type="hidden" id="actionForm" name="actionForm" value="" />
