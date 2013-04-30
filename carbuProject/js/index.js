function afficheMapsWithHome() {
	document.getElementById('actionForm').value = 'searchHome';
	document.getElementById('formGeneral').action = "CarteGenerale.php";
	document.getElementById('formGeneral').submit();
}