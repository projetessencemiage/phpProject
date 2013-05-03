<?php 
require_once 'application/inc/declarations.inc.php';
require_once 'StationServiceData.inc.php';
$action = $_POST['action'];


if ($action == 'validerStation') {
	$idStation = $_POST['idStation'];
	StationServiceData::validerStation($idStation);
			
} else if ($action == 'annulerStation') {
	$idStation = $_POST['idStation'];
	StationServiceData::annulerStation($idStation);
}

echo 'OK|';
?>