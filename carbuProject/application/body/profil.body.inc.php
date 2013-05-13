<?php 

echo "<h3>Bienvenue sur votre espace personnel</h3>";

$user = unserialize($_SESSION['USER']);
$nom = $user->getNom();
$prenom = $user->getPrenom();
$adresse = $user->getAdresseComplete();
$mail = $user->getMail();
$avatar = $user->getAvatar();
$carburant = $user->getCarbu();
$id_station = $user->getStation();

echo "Bonjour ".$user->getCiv().$user->getPrenom().' '.$user->getNom();echo "</br>";

echo"
<div id=\"content\">
<ul style=\"float : left; width : 350px; list-style-position: inside; list-style-type: square; margin : 0; margin-left : 20px; padding : 0px;\">
<li><H5>Mes informations personnelles</h5></li>
Nom: $nom </br>
Prenom: $prenom </br>
Adresse: $adresse </br>
Mail: $mail </br></br>
<div id=\"afficher_cacher\"><a href=\"#\" onclick=\"apparaitre();\">Modifier</a></div>
<div id=\"texte\" style=\"visibility:hidden\">code pour modifier mes informations</div>
</ul>

<ul style=\"float : left; width : 250px; list-style-position: inside; list-style-type: square; margin : 0; padding : 0;\">
<li><H5>Mon Avatar</h5></li>
Avatar: $avatar </br></br></br></br></br>
<div id=\"afficher_cacher\"><a href=\"#\" onclick=\"apparaitre();\">Modifier</a></div>
<div id=\"texte\" style=\"visibility:hidden\">code pour modifier mon avatar</div>
</ul>

<ul style=\"float : left; width : 250px; list-style-position: inside; list-style-type: square; margin : 0; padding : 0;\">
<li><h5>Ma station favorion</h5></li>
Carburant: $carburant </br>
Station: $id_station </br></br></br></br>
<div id=\"afficher_cacher\"><a href=\"#\" onclick=\"apparaitre();\">Modifier</a></div>
<div id=\"texte\" style=\"visibility:hidden\">code pour modifier ma station favorite</div>
</ul>

<ul style=\"float : left; width : 250px; list-style-position: inside; list-style-type: square; margin : 0; padding : 0;\">
<li><h5><a href=\"desinscrire.php\">Me désinscrire</a></h5></li>
</ul>
</div>

";
?>

