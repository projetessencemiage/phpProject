function deleteInput(inputName) {
	if (inputName != 'searchVille') {
		document.getElementById('searchVille').value = '';
		document.getElementById('searchVilleDpt').value = '';
	}
	if (inputName != 'searchDpt') {
		document.getElementById('searchDpt').value = '';
	}
	if (inputName != 'searchCP') {
		document.getElementById('searchCP').value = '';
	}
	if (inputName != 'searchAdresse') {
		document.getElementById('searchAdresse').value = '';
	}
}

function validerFormArroundMe() {
	document.getElementById('formGeneral').action = "CarteGenerale.php";
	document.getElementById('actionForm').value = 'searchArroundMe';
	return true;
}

function validerFormNewStation() {
	var isValid = false;
	if(document.getElementById('inputNewStation').value != '' ){
		isValid = true;
	}else{
		alert("Veuillez renseigner l'adresse de la Station");
	}
	return isValid;
}
function validerFormSearchListStation(goTo) {
	document.getElementById('formGeneral').action = goTo;
	var checkInput = false;
	var isValid = true;
	if (document.getElementById('searchVille').value != '' || document.getElementById('searchVilleDpt').value != '') {
		var dpt = document.getElementById('searchVilleDpt').value;
		if (document.getElementById('searchVille').value == '') {
			alert('Veuillez renseigner la ville');
			isValid = false;
		} else if (dpt == '' || !isNumber(dpt) || dpt.length != 2) {
			alert('Veuillez renseigner le département');
			isValid = false;
		} else {
			document.getElementById('actionForm').value = 'searchVille';
		}
		checkInput = true;
	}
	if (document.getElementById('searchDpt').value != '') {
		var dpt = document.getElementById('searchDpt').value;
		if (isNumber(dpt) && dpt.length == 2) {
			document.getElementById('actionForm').value = 'searchDpt';
		} else {
			isValid = false;
			alert("Département doit être un champ numérique de deux caractères");
		}
		checkInput = true;
	}
	if (document.getElementById('searchCP').value != '') {
		var cp = document.getElementById('searchCP').value;
		if (isNumber(cp) && cp.length == 5) {
			document.getElementById('actionForm').value = 'searchCP';
		} else {
			isValid = false;
			alert("Code postal doit être un champ numérique de 5 caractères");
		}
		checkInput = true;
	}
	if (document.getElementById('searchAdresse').value != '') {
		document.getElementById('actionForm').value = 'searchAdresse';
		checkInput = true;
	}
	if (!checkInput) {
		isValid = false;
		alert("Veuillez renseigner un champ");
	}
	return isValid;
}

function afficherDiv(divName) {
	if (document.getElementById(divName).style.display == 'none') {
		document.getElementById(divName).style.display = 'block';
	} else {
		document.getElementById(divName).style.display = 'none';
	}
	
}