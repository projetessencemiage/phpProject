<?php
session_start();
require_once 'application/inc/declarations.inc.php';
require_once 'ListeStationServiceClass.inc.php';
$role = Fonctions::getRole($_SESSION);
$body = 'validerStation.body.php';

if ($role == ROLE_ADMIN) {
	$script = '
	<script type="text/javascript">
	$(function() {
	$("#tablesorter-demo").tablesorter({sortList:[[0,0],[1,1]], widgets: [\'zebra\']});
	$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
	});
	</script>
	<script  type="text/javascript" src="./js/validerStation.js"></script>
	';
	echo Structure::getHeader($script);
	echo Structure::getBody($body);
}  else {
	$_SESSION['navMessage'] = 'noDroit';
	header("location:index.php");
}


?>