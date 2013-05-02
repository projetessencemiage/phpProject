<?php 

$listeStation = new ListeStationService();
$listeStation->getStationsToValid();
$stations = $listeStation->getStations();
?>
<h3>Station à valider</h3>
<div class="row-fluid">
	<div class="span8">
	<table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
	<thead>
		<tr>
			<th>Code Postal</th>
			<th>Ville</th>
			<th>Adresse</th>
			<th>Enseigne</th>
			<th>Valider</th>
			<th>Refuser</th>
		</tr>
	</thead>
	<?php 
	foreach ($stations as $key => $station) {
		$cp = $station->getCP();
		$ville = $station->getVille();
		$adresse = $station->getAdresse();
		$enseigne = $station->getEnseigne();
		$id = $station->getID();
				echo "<tr>";
				echo "<td>".$cp."</td>";
				echo "<td>".$ville."</td>";
				echo "<td>".$adresse."</td>";
				echo "<td>".$enseigne."</td>";
				echo '<td> <i onClick="validerStation(\''.$id.'\')" class="icon-ok"></i> </td>';
				echo '<td> <i onClick="refuserStation(\''.$id.'\')" class="icon-remove"></i> </td>';
				echo "</tr>";
		}
	?>
	</table>
	</div>
	<div class="span4">OPTIONS</div>

</div>
