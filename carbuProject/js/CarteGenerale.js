function validerForm() {
	var newAdresse  = document.getElementById('newAdresse').value;
	document.all.frame.src="carteStations.php?newAdresse=" + newAdresse;
	return false;
}