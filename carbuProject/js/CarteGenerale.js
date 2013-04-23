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
	}

}