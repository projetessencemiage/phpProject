String.prototype.startsWith = function(str) 
{
	return (this.match("^"+str)==str)
}


function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function connexionUser() {
	var login = document.getElementById("connexionLogin").value;
	var pwd = document.getElementById("connexionPwd").value;
	getXhr();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var chaine = xhr.responseText;
			alert(chaine);
			/*var rep = chaine.split('|');
			if (rep[0] == 'OK'){
				document.getElementById('stationToAfficheInfoID').value = stationID;
				document.forms['formGeneral'].submit();
			}
			else alert(xhr.responseText);
		}*/
		}
	}
	xhr.open("POST", 'ctrlAuth.php', true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send("login=" + login + "&pwd=" + pwd);
	return false;
}