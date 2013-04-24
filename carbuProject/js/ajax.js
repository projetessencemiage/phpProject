/**
 * ------------------------------------------------------------------------
 * @Name : ajax.js
 * @Desc : Fonctions javascript (AJAX) echanges de donn�es dynamique entre client et serveur
 * @Author : Thom
 * @Date : 11/06/2012 : cr�ation
 * @Version : V1.0
 * ------------------------------------------------------------------------
 **/
var xhr = null;
// Fonction de creation de l'objet XMLHttpRequest qui resservira pour chaques
// fonctions AJAX
function getXhr() {
	if (window.XMLHttpRequest)
		xhr = new XMLHttpRequest();
	else if (window.ActiveXObject) {
		try {
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	} else {
		alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest, veuillez le mettre � jour");
		xhr = false;
	}
}


