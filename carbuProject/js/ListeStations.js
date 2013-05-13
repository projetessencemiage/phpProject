function changeCarbu() {
	document.forms['formGeneral'].submit(); 
}

function goToInfoStation(id) {
	document.getElementById('stationToAfficheInfoID').value = id;
	document.forms['formGeneral'].action = 'InfoStation.php';
	document.forms['formGeneral'].submit();
}

function stationToMaps(idStation) {
	document.getElementById('stationToAfficheInfoID').value = idStation;
	document.getElementById('stationFromList').value = idStation;
	document.getElementById('actionForm').value = 'stationFromList';
	document.forms['formGeneral'].action = "CarteGenerale.php";
	document.forms['formGeneral'].submit();
}

function stationsToMaps() {
	document.forms['formGeneral'].action = "CarteGenerale.php";
	document.forms['formGeneral'].submit();
}
