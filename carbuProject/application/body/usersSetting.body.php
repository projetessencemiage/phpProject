<?php
require_once 'ListeUsersClass.inc.php';


//Recherche de la liste a afficher
if (array_key_exists('actionForm', $_POST) && $_POST['actionForm'] != "") {
	Fonctions::inputHidden('actionForm', $_POST['actionForm']);
	Fonctions::inputHidden('actionForm', $_POST['pseudoUser']);
	if ($_POST['actionForm'] == "deleteUser") {
		$pseudo = $_POST["pseudoUser"];
		UserData::removeUser($pseudo);
	}
}

?>
<h3>Gestion des utilisateurs</h3>


<?php	
	//Tableau des users
	$listUsers = new listeUsersClass();
	$users = $listUsers->getListUsersArray();

echo "<table id=\"tablesorter-demo\" class=\"tablesorter\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\">
	<thead>
		<tr>
			<th>genre</th>
			<th>nom</th>
			<th>prenom</th>
			<th>pseudo</th>
			<th>email</th>
			<th>adresse</th>
			<th>code postal</th>
			<th>ville</th>
			<th>role</th>
			<th>supprimer</th>";
		echo "</tr>
	</thead><tbody>";
		
		foreach ($users as $user){
			echo "<tr>
					<td>".$user->getCiv()."</td>
					<td>".$user->getNom()."</td>
					<td>".$user->getPrenom()."</td>
					<td>".$user->getUserName()."</td>
					<td>".$user->getMail()."</td>
					<td>".$user->getAdresse()."</td>
					<td>".$user->getCp()."</td>
					<td>".$user->getVille()."</td>
					<td>".$user->getRole()."</td>";
			if($user->getRole() == "user"){
					echo "<td>
							<a onclick=\"deleteUser('".$user->getUserName()."')\"> 
					<img src=\"./images/delete.png\" ALT=\"Supprimer la station\" aligne=\"center\">
					</a>
					</td>";
			}	
			
				echo "</tr>";
		}

echo "</tbody></table>";
Fonctions::inputHidden('actionForm', '');
Fonctions::inputHidden('pseudoUser', '');
?>
