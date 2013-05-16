function apparaitre(){

	var valeur_visibility = document.getElementById("FormInfoUser").style.visibility;
	if (valeur_visibility == "hidden") {
		document.getElementById("FormInfoUser").style.visibility = "";
		document.getElementById("btnFormInfoUser").innerHTML = 'Retour';
	} else {
		document.getElementById("FormInfoUser").style.visibility = "hidden";
		document.getElementById("btnFormInfoUser").innerHTML = 'Modifier mes informations';
	}
}

function afficherFormMdp(){

	var valeur_visibility = document.getElementById("FormMdp").style.visibility;
	if (valeur_visibility == "hidden") {
		document.getElementById("FormMdp").style.visibility = "";
		document.getElementById("btnFormMdp").innerHTML = 'Retour';
	}
	else {
		document.getElementById("FormMdp").style.visibility = "hidden";
		document.getElementById("btnFormMdp").innerHTML = 'Modifier mon mot de passe';
	}
}

function desinscription(){

	var valeur_visibility = document.getElementById("FormDes").style.visibility;
	if (valeur_visibility == "hidden") {
		document.getElementById("FormDes").style.visibility = "";
		document.getElementById("btnFormDes").innerHTML = 'Retour';
	}
	else {
		document.getElementById("FormDes").style.visibility = "hidden";
		document.getElementById("btnFormDes").innerHTML = 'Me désinscrire';
	}
}