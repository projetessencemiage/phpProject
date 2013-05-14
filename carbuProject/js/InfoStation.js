function supprimerStation(idStation) {
	if (window.confirm('Confirmez vous la supression ?')) {
	getXhr();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			var rep = chaine.split('|');
			if (rep[0] == 'OK'){
				alert('Suppr OK');
				//document.forms['formGeneral'].submit();
			}
			else alert('ERREUR' + xhr.responseText);
		}
	}
	xhr.open("POST", 'gestionStationAjax.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send("action=annulerStation&idStation=" + idStation);
	}
	return false;
}

function formUpdateInfo() {
	document.getElementById('btnUpdatePrix').className = 'btn btn-info';
	document.getElementById('formUpdatePrix').style.display = 'none';
	if (document.getElementById('formUpdateInfos').style.display == 'none') {
		document.getElementById('formUpdateInfos').style.display = 'block';
		document.getElementById('btnUpdateInfos').className = 'btn btn-primary';
	} else {
		document.getElementById('formUpdateInfos').style.display = 'none';
		document.getElementById('btnUpdateInfos').className = 'btn btn-info';
	}
}

function formUpdatePrix() {
	document.getElementById('btnUpdateInfos').className = 'btn btn-info';
	document.getElementById('formUpdateInfos').style.display = 'none';
	if (document.getElementById('formUpdatePrix').style.display == 'none') {
		document.getElementById('formUpdatePrix').style.display = 'block';
		document.getElementById('btnUpdatePrix').className = 'btn btn-primary';
	} else {
		document.getElementById('formUpdatePrix').style.display = 'none';
		document.getElementById('btnUpdatePrix').className = 'btn btn-info';
	}
}

function validerFormUpdateInfo() {
	var stationId = document.getElementById('idStation').value;
	var select = document.getElementById("enseigneName" );
	var newEnseigneId = select.value;
    var newEnseigneName = select.options[select.selectedIndex].text;
	var newAdresse = document.getElementById('newStationAdresse').value;
	var newCP = document.getElementById('newStationCp').value;
	var newVille = document.getElementById('newStationCity').value;
	var newPhone = document.getElementById('newStationPhone').value;	
	getXhr();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			var split = chaine.split('|');
			var code = split[1];
			var msg = split[2];
			if (split[0] == 'OK') {
				if (code == 'true') {
					document.getElementById('actionPage').value = 'actionUpdateInfos';
					document.forms['formGeneral'].submit();
				} else {
					afficherMsgMenuNav('3', msg);
				}
			} else {
				document.getElementById('divErreur').innerHTML  = chaine;
			}
		}
	}
	xhr.open("POST", 'gestionStationAjax.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send("action=updateStation" +
			"&idStation=" + stationId + 
			"&newEnseigneId=" + newEnseigneId + 
			"&newAdresse=" + newAdresse + 
			"&newCP=" + newCP + 
			"&newVille=" + newVille + 
			"&newPhone=" + newPhone);
}

function validerFormUpdatePrix() {
	var prix = document.getElementById('newPrice').value;
	var stationID = document.getElementById('idStation').value;
	var carbuID = document.getElementById('addPriceCarbuType').value;
	
	if (!isNumber(prix) || prix == "") {
		afficherMsgMenuNav('3', "Le champ prix doit être numérique");
	} else {
	
	getXhr();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			var rep = chaine.split('|');
			if (rep[0] == 'OK'){
				document.getElementById('actionPage').value = 'actionUpdatePrix';
				document.forms['formGeneral'].submit();
			}
			else alert(xhr.responseText);
		}
	}
	xhr.open("POST", 'ajoutPrixAjax.inc.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send("prix=" + prix + "&stationID=" + stationID + "&carbuID="+	carbuID);
	}
}