<?php 
require_once 'ListeStationServiceClass.inc.php';
$critere = "";
$listeStation = new ListeStationService();
//Recherche de la liste ? afficher sur la map
if (array_key_exists('actionForm', $_POST)) {
	if ($_POST['actionForm'] == "searchVille") {
		$ville = $_POST["searchVille"];
		$dpt = $_POST["searchVilleDpt"];
		$listeStation->getStationsByVille($ville, $dpt);
		$critere = 'Recherche par ville - '.$ville. ' ('.$dpt.')';
	} else if ($_POST['actionForm'] == "searchDpt") {
		$dpt = $_POST["searchDpt"];
		$listeStation->getStationsByDpt($dpt);
		$critere = 'Recherche par d?partement - '.$dpt;
	} else if ($_POST['actionForm'] == "searchCP") {
		$cp = $_POST["searchCP"];
		$listeStation->getStationsByCP($cp);
		$critere = 'Recherche par code postal - '.$cp;
	} else if ($_POST['actionForm'] == "searchAdresse") {
		$adr = $_POST["searchAdresse"];
		$rayon = $_POST["rayon"];
		$listeStation->getStationsByAdresse($adr, $rayon);
		$critere = 'Recherche par adresse - '.$adr.' avec un rayon de '.$rayon.' km';
	} else if ($_POST['actionForm'] == "searchArroundMe") {
		$rayonArround = $_POST["rayonAroundMe"];
		$listeStation->getStationsArroundMe($rayonArround);
		$critere = 'Recherche around me - Rayon: '.$rayonArround.' km';
	}
	$carbuType = $_POST["carburantType"];
} else {
	$listeStation->getStationsArroundMe('10');
	$critere = 'Recherche par default around me - Rayon 10 km';
	$carbuType = "diesel";
}
//Recuperation des infos des Stations pour affichage dans la MAP
$stations = $listeStation->getStations();

//Affichage du message d'entete
$nbStation =  count($listeStation->getStations());
if ($nbStation > 0 ) {
	$class = "alert-success";
	$alert = "Info";
} else {
	$class = "alert-error";
	$alert = "Attention";
}
echo '
<div class="alert '.$class.'" id="boxMsg">
<button type="button" class="close" data-dismiss="alert" onclick="quitBox(\'boxMsg\')" >&times;</button>
<strong>'.$alert.' - </strong>'.$nbStation.' stations trouv?es avec vos crit?res de recherches
<br/> '.$critere.'
<br/><strong id="titleCarbuType">'.$carbuType.'</strong>
</div>';

$listeStation->getStationsByDpt(33);
$stationsGironde = $listeStation->getStations();
echo 'nombre des stations en Gironde: '.count($stationsGironde).NL.' --- ';

foreach ( $stationsGironde as $value) {
	echo $value->getVille().NL;
	echo $value->getEnseigne().NL;
	echo $value->getCP().NL;
	$priceList = $value->getListePrix();
	echo $priceList[];
		
	
	' /// ';	
	
}
	


?>


<h1>Liste des stations</h1>
	
	<script type="text/javascript">
	$(function() {		
		$("#tablesorter-demo").tablesorter({sortList:[[5,0],[6,1]], widgets: ['zebra']});
		$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
	});	
	</script>

<div style="width: 728px; margin: 10px auto;"> 
<script type="text/javascript" src="http://ad-cdn.technoratimedia.com/00/49/79/uat_17949.js?ad_size=728x90"></script>
</div>


<div><table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1"> 
	<thead> 
		<tr> 
 			<th>Carburant</th>
			<th>Ville</th>
			<th>Station</th>
			<th>Code Postal</th>
			<th>Departement</th>
			<th>Prix</th>
			<th>Date de mise a jour</th>
			<th>Maps</th>
		</tr> 			
	</thead> 
	<tbody> 
		<tr> 
			<td >B</td>
			<td>Pessac</td> 
		    <td>Esso</td> 
		    <td>33600</td> 
		    <td>33</td> 
		    <td>1.30</td>
		    <td>15/04/13</td>
		    <td>"icone"</td> 
		</tr> 
		<tr> 
			<td>B</td>
			<td>Talence</td> 
		    <td>Total</td> 
		    <td>33400</td> 
		    <td>33</td> 
		    <td>1.55</td>
		    <td>17/04/13</td>
		    <td>"icone"</td> 
		</tr> 
		<tr> 
			<td>A</td>
			<td>Talence</td> 
		    <td>Leclerc</td> 
		    <td>33400</td> 
		    <td>33</td> 
		    <td>1.32</td>
		    <td>16/04/13</td>
		    <td>"icone"</td> 
		 </tr> 
		 <tr>
			<td>E</td>
			<td>Pessac</td> 
		    <td>Esso</td> 
		    <td>33600</td> 
		    <td>33</td> 
		    <td>1.37</td>
		    <td>16/04/13</td>
		    <td>"icone"</td> 
		</tr> 
		<tr> 
			<td>F</td>
			<td>Talence</td> 
		    <td>Total</td> 
		    <td>33400</td> 
		    <td>33</td> 
		    <td>1.41</td>
		    <td>17/04/13</td>
		    <td>"icone"</td> 
		</tr> 
		 <tr>
			<td>D</td>
			<td>Talence</td> 
		    <td>Leclerc</td> 
		    <td>33400</td> 
		    <td>33</td> 
		    <td>1.30</td>
		    <td>16/04/13</td>
		    <td>"icone"</td> 
		</tr>  
	</tbody> 
</table></div>

