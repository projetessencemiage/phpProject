String.prototype.startsWith = function(str) 
{
	return (this.match("^"+str)==str)
}


function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function quitBox(idDiv) {
	document.getElementById(idDiv).style.display = "none";
}

function connexionUser() {
	var login = document.getElementById("connexionLogin").value;
	var pwd = document.getElementById("connexionPwd").value;
	
	getXhr();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			var rep = chaine.split('|');
			if (rep[0] == 'OK'){
				var code = rep[1];
				var message = rep[2];
				if(code == 0) {
					document.forms['formGeneral'].submit();
				} else {
					afficherMsgMenuNav(3, message);
				}
			}
			else alert('ERREUR' + xhr.responseText);
		}
	}
	xhr.open("POST", 'ctrlAuth.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send("login=" + login + "&pwd=" + pwd);
	return false;
}

function afficherMsgMenuNav(code, msg) {
	document.getElementById('msgMenuNav').style.display = 'block';
	document.getElementById('msgMenuNavMessage').innerHTML = msg;
	document.getElementById('msgMenuNav').className = codeErreur(code);
	document.getElementById('msgMenuNavLib').innerHTML = libelleErreur(code);
}

function codeErreur(code) {
	if (code == 1) return "alert alert-success";
	if (code == 2) return "alert alert-info";
	if (code == 3) return "alert alert-error";
	if (code == 4) return "alert alert-block";
}

function libelleErreur(code) {
	if (code == 1) return "Well done ! - ";
	if (code == 2) return "Info - ";
	if (code == 3) return "Erreur - ";
	if (code == 4) return "Warning ! - ";
}

function deconnexionUser() {
	document.forms['formGeneral'].action = "logout.php";
	document.forms['formGeneral'].submit();
}

function newUser(){
	document.forms['formGeneral'].action = "Inscription.php";
	document.forms['formGeneral'].submit();
}
