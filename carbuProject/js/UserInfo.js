function validerFormUpdateInfoUser() {
	
	document.getElementById('actionPage').value = 'actionUpdateInfosUser';
	document.forms['formGeneral'].submit(); 
	
}

function validerFormUpdateInfoMdp() {
	var mdp0  = document.getElementById('oldmdp').value;
	var mdp1  = document.getElementById('mdpa').value;
	var mdp2  = document.getElementById('mdpb').value;
	
	if (mdp0=='' || mdp1=='' || mdp2=='') {
		afficherMsgMenuNav(3, 'Veuillez remplir tous les champs')
	} 
	else if (mdp1 != mdp2){
		afficherMsgMenuNav(3, 'Veuillez saisir le meme mot de passe pour le confirmer')
	}
	else {
	document.getElementById('actionPage').value = 'actionUpdateInfosMdp';
	document.forms['formGeneral'].submit();
	}
	
}

function validerFormDes() {
	var pseudo  = document.getElementById('pseudo').value;
	var mdp  = document.getElementById('mdpDes').value;
	
	if (pseudo=='' || mdp=='') {
		afficherMsgMenuNav(3, 'Veuillez remplir tous les champs')
	} 
	else {
	document.getElementById('actionPage').value = 'actionDes';
	document.forms['formGeneral'].submit();
	}
	
}