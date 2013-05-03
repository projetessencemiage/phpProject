<?php 
$idStation =  $_POST['stationToAfficheInfoID'];
$stationD = urldecode($_POST['station'.$idStation]);
$station = unserialize($stationD);
?>

<h3>Station (n°<?php echo $idStation;?>)</h3>

<?php 
echo '<div id="divInfoStation">';
echo '
<p><address><strong>'.
$station->getEnseigne()
.'</strong><br>'.
$station->getAdresseComplete()
.'<br><abbr title="Phone">Tel: </abbr>'.
$station->getPhone()
.'</address></p><p>Price:';
$prices = $station->getListePrix();
//foreach ($prices as $carbu => $infos) {
//echo '<br /><strong>'.$carbu.'</strong> - '.$infos["Prix"].' € <span class="majPrix">'.Fonctions::getNbJourToString($infos["NbJMaj"]).'</span>';
echo '</p>';
//}
?>
</div>