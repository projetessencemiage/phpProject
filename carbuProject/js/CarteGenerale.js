function changeCarbu() {
	document.forms['formGeneral'].submit(); 
}

function quitBox(idDiv) {
	document.getElementById(idDiv).style.display = "none";
}

function addFormToAddPrice() {
	if (document.getElementById('addPriceForm').style.display == 'none') {
		document.getElementById('addPriceForm').style.display = "block";
	} else {
		document.getElementById('addPriceForm').style.display = "none";
	}
	
}

function addPrice() {
	var prix = document.getElementById('newPrice').value;
	var stationID = document.getElementById('stationToChange').value;
	var carbuID = document.getElementById('addPriceCarbuType').value;
	
	if (!isNumber(prix) || prix == "") {
		alert("Le champ prix doit être numérique");
	} else {
	
	getXhr();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			var rep = chaine.split('|');
			if (rep[0] == 'OK'){
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