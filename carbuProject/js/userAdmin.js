
function deleteUser(id) {
	document.getElementById('actionForm').value = 'deleteUser';
	document.getElementById('pseudoUser').value = id;
	document.forms['formGeneral'].submit(); 
}
