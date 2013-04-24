<?php 
require_once 'application/inc/declarations.inc.php';
require_once 'PrixClass.inc.php';

$prixToUpdate = $_POST['prix'];
$stationID = $_POST['stationID'];
$carbuID = $_POST['carbuID'];

$prix = new Prix('','','');
$prix->ajoutPrix($prixToUpdate, $stationID, $carbuID);
echo 'OK|';

?>