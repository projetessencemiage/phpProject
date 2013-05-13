function validerStation(idStation) {
	if (window.confirm('Confirmez vous la validation ?')) {
	getXhr();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			var rep = chaine.split('|');
			if (rep[0] == 'OK'){
				document.forms['formGeneral'].submit();
			}
			else alert('ERREUR' + xhr.responseText);
		}
	}
	xhr.open("POST", 'gestionStationAjax.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send("action=validerStation&idStation=" + idStation);
	}
}

function refuserStation(idStation) {
	if (window.confirm('Confirmez vous l\'annulation ?')) {
	getXhr();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			var rep = chaine.split('|');
			if (rep[0] == 'OK'){
				document.forms['formGeneral'].submit();
			}
			else alert('ERREUR' + xhr.responseText);
		}
	}
	xhr.open("POST", 'gestionStationAjax.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send("action=annulerStation&idStation=" + idStation);
	}
}