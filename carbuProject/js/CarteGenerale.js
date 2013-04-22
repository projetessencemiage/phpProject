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