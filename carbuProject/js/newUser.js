
function validerFormNewUser(goTo) {
	alert("test");
	document.getElementById('formGeneral').action = goTo;
	var checkInput = false;
	var isValid = true;
	if (document.getElementById('pseudo').value != '' || document.getElementById('mdp').value != '' || document.getElementById('mail').value != '' || document.getElementById('address').value != '' || document.getElementById('cp').value != '' || document.getElementById('city').value != ''  || document.getElementById('carburantType').value != ''  ) {

		var pseudo = document.getElementById('pseudo').value;
		var mdp = document.getElementById('mdp').value;
		var mail = document.getElementById('mail').value;
		var adresse = document.getElementById('address').value;
		var cp = document.getElementById('cp').value;
		var city = document.getElementById('city').value;
		var carburant = document.getElementById('carburantType').value;

		alert(carburant);
		if (pseudo == '') {
			alert('Veuillez renseigner vvotre pseudonyme de connexion');
			isValid = false;
		} else if (mdp == '' ) {
			alert('Veuillez renseigner votre mot de passe de connexion');
			isValid = false;
		} else if (mail == '') {
			alert('Veuillez renseigner cotre adresse mail');
			isValid = false;
		} else if (carburant == '') {
			alert('Veuillez renseigner votre carburant utilisé');
			isValid = false;
			
		}else{
			document.getElementById('actionForm').value = 'newUser';
		}
		checkInput = true;
	}
	return isValid;
}
