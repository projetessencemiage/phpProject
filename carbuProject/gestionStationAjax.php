<?php 
require_once 'application/inc/declarations.inc.php';
require_once 'StationServiceData.inc.php';
$action = $_POST['action'];
$code = '';
$message = '';

if ($action == 'validerStation') {
	$idStation = $_POST['idStation'];
	StationServiceData::validerStation($idStation);
			
} else if ($action == 'annulerStation') {
	$idStation = $_POST['idStation'];
	StationServiceData::annulerStation($idStation);
} else if ($action == 'updateStation') {
	$idStation = $_POST['idStation'];
	$newIdEnseigne = $_POST['newEnseigneId'];
	$newAdresse = $_POST['newAdresse'];
	$newCP = $_POST['newCP'];
	$newVille = $_POST['newVille'];
	$newPhone = $_POST['newPhone'];
	$retour  = StationServiceData::updateStation($idStation, $newIdEnseigne, $newAdresse, $newCP, $newVille, $newPhone);
	$code = $retour[0];
	$message = $retour[1];
} 

echo 'OK|'.$code.'|'.$message;
?>