<div class="image_entete">

</div>

<?php
echo '<div class="icones">';
if(isset($_SESSION['Role']))
{
echo '<a href="logout.php" title="Se d�connecter"><img src="./images/logout.png" title="D�connexion"/></a>';
}
echo '</div>';
?>

<h1 style="color: #c7d3e0">
Carburants trackers
</h1>

