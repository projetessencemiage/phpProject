
function validerFormPwdForget(goTo) {
	document.getElementById('formGeneral').action = goTo;
	var checkInput = false;
	var isValid = true;
	if (document.getElementById('pseudo').value != '' ) {

		var pseudo = document.getElementById('pseudo').value;
		if (pseudo == '') {
			alert('Veuillez renseigner votre pseudonyme de connexion');
			isValid = false;
		} else{
			document.getElementById('actionForm').value = 'pwdForget';
		}
		checkInput = true;
	}
	return isValid;
}
