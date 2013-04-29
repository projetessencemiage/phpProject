function changeCarbu() {
	document.getElementById('stationToAfficheInfoID').value = document.getElementById('stationToUpdatePrice').value;
	document.forms['formGeneral'].submit(); 
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
	var stationID = document.getElementById('stationToUpdatePrice').value;
	var carbuID = document.getElementById('addPriceCarbuType').value;
	
	if (!isNumber(prix) || prix == "") {
		alert("Le champ prix doit être numérique");
	} else {
	
	getXhr();
	xhr.onreadystatechange = function() {
		document.getElementById('icone').setAttribute("class","icon-refresh");
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			var rep = chaine.split('|');
			if (rep[0] == 'OK'){
				document.getElementById('stationToAfficheInfoID').value = stationID;
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