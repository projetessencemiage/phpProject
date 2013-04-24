function changeCarbu() {
	document.forms['formGeneral'].submit(); 
}

function stationToMaps(idStation) {
	document.getElementById('stationFromList').value = idStation;
	document.getElementById('actionForm').value = 'stationFromList';
	document.forms['formGeneral'].action = "CarteGenerale.php";
	document.forms['formGeneral'].submit();
}