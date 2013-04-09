<?php
require_once 'application/inc/declarations.inc.php';

/*Ce lien ne s'affichera uniquement si un membre du groupe administrateur est connecté */
//if(isset($_REQUEST['Role']))
//{
//if(isset($_SESSION['Role']))
{
	$role = $_SESSION['Role'];

	echo '<p id="titre"><a href="index.php" title="Accueil"><img src="./images/home.png" title="accueil"/></a></p>';

	echo '<ul class="menu_general">';
	
	echo '<li class="titre_menu">Sous Menu 1';
	echo '<ul class="sous_menu">';
	echo '	<li class="sous_partie"><a href="CarteGenerale.php" title="Qui est le moins cher ? ">Qui est le moins cher ? </a></li>';
	echo '	<li class="sous_partie"><a href="ListeStations.php" title="Page 2 ">Liste des stations </a></li>';
	echo '	<li class="sous_partie"><a href="AdminUsers.php" title="Page 3 ">Page 3 </a></li>';
	echo '</ul></li>';

	echo '<li class="titre_menu">Sous Menu 2';
	echo '<ul class="sous_menu">';
	echo '	<li class="sous_partie"><a href="AdminUsers.php" title="Page 1 ">Page 1 </a></li>';
	echo '	<li class="sous_partie"><a href="AdminUsers.php" title="Page 2 ">Page 2 </a></li>';
	echo '	<li class="sous_partie"><a href="AdminUsers.php" title="Page 3 ">Page 3 </a></li>';
	echo '</ul></li>';

	echo '</ul>';

}
//}
?>