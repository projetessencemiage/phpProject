function validerFormReInitMdp() {
	var mdp1 = document.getElementById('mdp1').value;
	var mdp2 = document.getElementById('mdp2').value;
	
	if (mdp1 != mdp2 || mdp1 == '') {
		alert('Les deux mots de passe ne sont pas identiques')
	} else {
		document.getElementById('actionForm').value = 'validerFormReInitMdp';
		document.forms['formGeneral'].submit();
	}
	
}