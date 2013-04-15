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
			alert('Veuillez renseigner le d�partement');
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
			alert("D�partement doit �tre un champ num�rique de 2 caract�res");
		}
		checkInput = true;
	}
	if (document.getElementById('searchCP').value != '') {
		var cp = document.getElementById('searchCP').value;
		if (isNumber(cp) && cp.length == 5) {
			document.getElementById('actionForm').value = 'searchCP';
		} else {
			isValid = false;
			alert("Code postal doit �tre un champ num�rique de 5 caract�res");
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