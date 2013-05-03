function deleteInput(inputName) {
	if (inputName != 'searchVille') {
		document.getElementById('searchVille').value = '';
		document.getElementById('searchVilleDpt').value = '';
	}
}


function validerFormNewStation(goTo) {
	document.getElementById('formGeneral').action = goTo;
	var checkInput = false;
	var isValid = true;
	if (document.getElementById('inputNewStationAd').value != '' || document.getElementById('inputNewStationCp').value != '' || document.getElementById('inputNewStationCity').value != '') {

		var adresse = document.getElementById('inputNewStationAd').value;
		var tel = document.getElementById('inputNewStationNb').value;
		var cp = document.getElementById('inputNewStationCp').value;
		var city = document.getElementById('inputNewStationCity').value;

		
		if (cp == '') {
			alert('Veuillez renseigner le code postal');
			isValid = false;
		} else if (adresse == '' ) {
			alert('Veuillez renseigner l\'adresse');
			isValid = false;
		} else if (city == '') {
			alert('Veuillez renseigner la ville');
			isValid = false;
			
		}else{
			document.getElementById('actionForm').value = 'newStation';
		}
		checkInput = true;
	}
	return isValid;
}
