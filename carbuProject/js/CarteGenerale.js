function changeCarbu() {
	var key = document.getElementById('infoStations').value;
	var carbu = document.getElementById('carburantType').value;
	document.getElementById("titleCarbuType").innerHTML = carbu;
	document.all.frame.src="carteStations.php?infoStations=" + key + "&&carbuType=" + carbu;
}

function quitBox(idDiv) {
	document.getElementById(idDiv).style.display = "none";
}