<?php 
require_once('ListeCarburantClass.inc.php');
require_once('FonctionsClass.inc.php');

echo "<h4>Bienvenue sur votre espace personnel</h4></br>";
$user = unserialize($_SESSION['USER']);

if (array_key_exists('actionPage', $_POST)) {
	if ($_POST['actionPage'] == 'actionUpdateInfosUser') {
		$civilite = $_POST['civ'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$add = $_POST['address'];
		$cp = $_POST['cp'];
		$ville = $_POST['city'];
		$email = $_POST['mail'];
		$pseudo = $user->getUserName();
		$url = '';
		$avatar = $user->getAvatar();
		$carbu = $user->getCarbu();
		$id_station = $user->getStation();
		$return = UserData::updateInfosUser($civilite, $nom, $prenom, $pseudo, $email, $add, $cp, $ville, $url, $id_station, $carbu);	
		if ($return[0] == 'true') {
			Fonctions::messageToString(true, 'alert alert-success', 'Succès - ', $return[1]);
			$user->setCiv($civilite);
			$user->setNom($nom);
			$user->setPrenom($prenom);
			$user->setMail($email);
			$user->setAdresse($add);
			$user->setCp($cp);
			$user->setVille($ville);
			$_SESSION['USER'] = serialize($user);
			
		} else {
			Fonctions::messageToString(true, 'alert alert-error', 'Erreur - ', $return[1]);
		}
				
	}
else if ($_POST['actionPage'] == 'actionUpdateInfosMdp') {
		$pseudo = $user->getUserName();
		$oldMdp = $_POST['oldmdp'];
		$newMdp = $_POST['mdpa'];
		$confirmMdp = $_POST['mdpa'];

		$return = UserData::updateInfosMdp($pseudo, $oldMdp, $newMdp);
		if ($return[0] == 'true') {
			Fonctions::messageToString(true, 'alert alert-success', 'Succès - ', $return[1]);				
		} else {
			Fonctions::messageToString(true, 'alert alert-error', 'Erreur - ', $return[1]);
		}
	
	}
	
else if ($_POST['actionPage'] == 'actionDes') {
		$pseudo = $user->getUserName();
		$MdpDes = $_POST['mdpDes'];
	
		$return = UserData::desinscription($pseudo, $MdpDes);
		if ($return[0] == 'true') {
			Fonctions::messageToString(true, 'alert alert-success', 'Succès - ', $return[1]);
		} else {
			Fonctions::messageToString(true, 'alert alert-error', 'Erreur - ', $return[1]);
		}
	
	}
} 


$pseudo = $user->getUserName();
$civilite = $user->getCiv();
$nom = $user->getNom();
$prenom = $user->getPrenom();
$adresse = $user->getAdresseComplete();
$add = $user->getAdresse();
$cp = $user->getCp();
$ville = $user->getVille();
$email = $user->getMail();
$avatar = $user->getAvatar();
$carbu = $user->getCarbu();
$id_station = $user->getStation();


echo "Bonjour ".$civilite.' '.$prenom.' '.$nom;echo "</br></br></br>";

echo"

<div class=\"row-fluid\">
	<div class=\"span4\">
<H5>Mes informations personnelles</h5>
Nom: $nom </br>
Prenom: $prenom </br>
Adresse: $adresse </br>
Mail: $email </br></br>
<div id=\"afficher_cacher\"><a id=\"btnFormInfoUser\" onclick=\"apparaitre();\">Modifier mes informations</a></div>
<div id=\"FormInfoUser\" style=\"visibility:hidden\">

			<fieldset>
			<input type= \"radio\" name=\"civ\" id=\"civ\" value=\"monsieur\" checked=\"checked\"> Monsieur
			<input type= \"radio\" name=\"civ\" id=\"civ\" value=\"madame\"> Madame
			<input type= \"radio\" name=\"civ\" id=\"civ\" value=\"mademoiselle\"> Mademoiselle
			</fieldset>
			<fieldset>
			<input type=\"text\" name=\"nom\" id=\"nom\"
					value=\"$nom\" placeholder=\"nom\"
					onChange=\"deleteInput('nom')\" /> 
			</fieldset>
			<fieldset>
			<input type=\"text\" name=\"prenom\" id=\"prenom\"
					value=\"$prenom\" placeholder=\"Prenom\"
					onChange=\"deleteInput('prenom')\" /> 
			</fieldset>
			<fieldset>
			<input type=\"text\" name=\"mail\" id=\"mail\"
					value=\"$email\" placeholder=\"mail\"
					onChange=\"deleteInput('mail')\" /> 
			</fieldset>
			<fieldset>
			<input type=\"text\" name=\"address\" id=\"address\"
					value=\"$add\" placeholder=\"adresse\" 
					onChange=\"deleteInput('address')\" /> 
			</fieldset>
			<fieldset>
			<input type=\"text\" name=\"cp\" id=\"cp\"
					value=\"$cp\" placeholder=\"code postal\"
					onChange=\"deleteInput('cp')\" /> 
			</fieldset>
			<fieldset>
			<input type=\"text\" name=\"city\" id=\"city\"
					value=\"$ville\" placeholder=\"ville\"
					onChange=\"deleteInput('city')\" /> 
			</fieldset>
			
			<p>
				<input value=\"Save\"  onClick=\"validerFormUpdateInfoUser()\" class=\"btn btn-success\" />
			</p>
			
		</div>
	</div>

<div class=\"span4\">
<h5>Mon mot de passe</h5>
<div><a id=\"btnFormMdp\" onclick=\"afficherFormMdp();\">Modifier mon mot de passe</a></div>
<div id=\"FormMdp\" style=\"visibility:hidden\">

			<fieldset>
			<input type=\"password\" name=\"oldmdp\" id=\"oldmdp\"
					placeholder=\"ancien mot de passe *\"
					onChange=\"deleteInput('oldmdp')\" /> 
			</fieldset>
			<fieldset>
			<input type=\"password\" name=\"mdpa\" id=\"mdpa\"
					placeholder=\"nouveau mot de passe *\"
					onChange=\"deleteInput('mdpa')\" /> 
			</fieldset>
			<fieldset>
			<input type=\"password\" name=\"mdpb\" id=\"mdpb\"
					placeholder=\"confirmer votre mot de passe *\"
					onChange=\"deleteInput('mdpb')\" /> 
			</fieldset>
			<p>
				<input value=\"Save\"  onClick=\"validerFormUpdateInfoMdp()\" class=\"btn btn-success\" />
			</p>
		
</div>
</div>
<div class=\"span4\">
<h5>Désinscription</h5>
<div><a id=\"btnFormDes\" onclick=\"desinscription();\">Me désinscrire</a></div>
<div id=\"FormDes\" style=\"visibility:hidden\">

			<fieldset>
			<input type=\"text\" name=\"pseudo *\" id=\"pseudo\"
					placeholder=\"pseudo (identifiant) *\"
					onChange=\"deleteInput('pseudo')\" /> 
			</fieldset>
			<fieldset>
			<input type=\"password\" name=\"mdpDes\" id=\"mdpDes\"
					placeholder=\"mot de passe *\"
					onChange=\"deleteInput('mdpDes')\" /> 
			</fieldset>
			<p>
				<input value=\"Me désinscrire\"  onClick=\"validerFormDes()\" class=\"btn btn-success\" />
			</p>
		
</div>
</div>
";
Fonctions::inputHidden('actionPage', '');
?>

