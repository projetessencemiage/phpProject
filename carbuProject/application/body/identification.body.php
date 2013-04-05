<?php
/**
 * ------------------------------------------------------------------------
 * @Name : identification.body.php
 * @Desc : Ecran identification de l'utilisateur
 * @Autor : Atos
 * @Date : 29/03/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
?>
<h1>Merci de saisir vos identifiants</h1>
<br />
<center>
<table border="0" width="580px">
	<tr>
		<td>Nom :</td>
		<td><input type="text" name="nom" /></td>
	</tr>
	<tr>
		<td>Mot de passe :</td>
		<td><input type="password" name="pwd" /></td>
	</tr>
</table>

<?php
$Message = '';
if (isset($_SESSION["CodeMessage"])) {
	if($_SESSION['CodeMessage']==1){
		$Message = 'Mot de passe incorrect';
	}
	else{
		if ($_SESSION['CodeMessage']==2){
			$Message = 'Compte désactivé';
		}
		else{
			if($_SESSION['CodeMessage']==3){
				$Message = 'Nom d\'utilisateur inexistant';
			}
			else{
				if($_SESSION['CodeMessage']==4){
					$Message = 'Nom d\'utilisateur invalide';
				}
			}

		}
	}
	echo "<font color='#FF0000'>";
	echo '<p align="center">'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$Message.'</p>';
	unset($_SESSION['CodeMessage']);
}
?> <br />
<input type="submit" value="Valider" /></center>
