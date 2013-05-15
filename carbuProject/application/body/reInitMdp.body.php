<?php 
$afficheForm  = true;
if (array_key_exists('actionForm', $_POST)) {
	if ($_POST['actionForm'] == 'validerFormReInitMdp') {
		$cle = $_POST['cle'];
		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp1'];
		$result = UserData::reInitMdp($pseudo, $cle, $mdp);
		if ($result[0] == 'true') {
			Fonctions::messageToString(true, 'alert alert-success', 'OK - ', $result[1]);
			$afficheForm  = false;
		} else {
			Fonctions::messageToString(true, 'alert alert-error', 'Erreur - ', $result[1]);
		}
						
	}
}

if (array_key_exists('pseudo', $_GET) && array_key_exists('cle', $_GET)) {
	Fonctions::inputHidden('pseudo', $_GET['pseudo']);
	Fonctions::inputHidden('cle', $_GET['cle']);
	Fonctions::inputHidden('actionForm', '');
	$pseudo = $_GET['pseudo'];
	
	if($afficheForm) {
?>

<h5>Réinitilisation du mot de passe (<?php echo $pseudo?>)</h5>

Nouveau mot de passe <input type="text" name="mdp1" id="mdp1"/>
<br/>Confirmez votre nouveau mot de passe <input type="text" name="mdp2" id="mdp2"/>
<br/><a class="btn btn-success"  onClick="validerFormReInitMdp()">Réinitialisation</a>

<?php }
}else {
echo '<h1>Erreur 404 - Page indisponible</h1>';
}?>