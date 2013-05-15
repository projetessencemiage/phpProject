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
};
?>