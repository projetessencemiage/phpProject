<?php 

echo "<h3>Bienvenue sur votre espace personnel</h3>";

$user = unserialize($_SESSION['USER']);

echo $user->getCiv().$user->getPrenom().' '.$user->getNom();echo "</br>";

echo"

<div id=\"content\">

<ul style=\"float : left; width : 280px; list-style-position: inside; list-style-type: square; margin : 0; margin-left : 20px; padding : 0px;\">
<li><a href=\"modifier-mail.php\">Modifier mon adresse de messagerie</a></li>
<li><a href=\"modifier-mdp.php\">Modifier mon mot de passe</a><br><br></li>
</ul>

<ul style=\"float : left; width : 280px; list-style-position: inside; list-style-type: square; margin : 0; padding : 0;\">
<li><a href=\"stations-favoris.php\">Mes stations favorites</a></li>
<li><a href=\"desinscrire.php\">Me désinscrire</a><br><br></li>
</ul>
</div>

";


?>

