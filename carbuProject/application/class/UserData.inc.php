<?php
/**
 * ------------------------------------------------------------------------
 * @Name : UserData.inc.php
 * @Desc : Classe UserData
 * @Autor : Thom
 * @Date : 02/04/2013
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
//---------------------------------------------------------------------------
// Classe UserData
//---------------------------------------------------------------------------
class UserData {
	
	static function isExistUser($login, $mdp) {
		$mdp = hash('SHA256', $mdp);
		#requete de v�rification du nom et du mot de passe
		$soapClient = new SoapClient(URL_WCF."/UserService.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$soapClient->Identification(array("identifiant" => $login, "mdp" => $mdp));
		$result = $soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
		$code = $dom->getElementsByTagName('code')->item(0)->nodeValue;
		$userXML = $dom->getElementsByTagName('user')->item(0);
		$reponse[] = $code;
		$reponse[] = $userXML;  		
		return $reponse;
	}
	static function reInitMdp($identifiant, $cle, $mdp) {
		$nouveauMDP = hash('SHA256', $mdp);
		$soapClient = new SoapClient(URL_WCF."/UserService.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$soapClient->ReinitialisationMDP(array("identifiant" => $identifiant, "cle" => $cle, "nouveauMDP" => $nouveauMDP));
		$result = $soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
		$code = $dom->getElementsByTagName('reponse')->item(0)->nodeValue;
		$msg = $dom->getElementsByTagName('message')->item(0)->nodeValue;
		$reponse[] = $code;
		$reponse[] = $msg;
		return $reponse;
	}
	static function updateInfosUser($civilite, $nom, $prenom, $pseudo, $email, $adresse, $cp, $ville, $url, $id_station, $carbu) {
		$clientSoap = new SoapClient(URL_WCF."/UserService.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		//$clientSoap->MiseAJourProfilUser(array("civilite" => $civilite,"nom" => $nom, "prenom" => $prenom, "pseudo" => $pseudo, "email" => $email, "adress" => $adresse, "code_postal" => $cp, "ville" => $ville, "url_avatar" => $url, "string_id_station_favorite" => $id_station, "string_id_carburant_pref" => $carbu));
	}
	static function removeUser($pseudo){
		$clientSoap = new SoapClient(URL_WCF."/ActionAdmin.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$clientSoap->SuppressionCompteByAdmin(array("identifiant" => $pseudo));
	}
};
?>
