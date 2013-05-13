<?php
/**
 * ------------------------------------------------------------------------
 * @Name : StationServiceData.inc.php
 * @Desc : Classe StationServiceData
 * @Autor : Thom
 * @Date : 02/04/2013
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

class StationServiceData {
	static function validerStation($id) {
	$soapClient = new SoapClient(URL_WCF."/ActionAdmin.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
	$soapClient->ValiderStation(array("id_station" => $id));
	}
	
	static function annulerStation($id) {
	$soapClient = new SoapClient(URL_WCF."/ActionAdmin.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
	$soapClient->SupprimerStation(array("id_station" => $id));
	}
	
	static function updateStation($idStation, $newIdEnseigne, $newAdresse, $newCP, $newVille, $newPhone) {
		$soapClient = new SoapClient(URL_WCF."/ActionAdmin.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$soapClient->ModififierStation(array("id_station" => $idStation,
				 "address" => $newAdresse, 
				 "code_postal" => $newCP,
				 "city" => $newVille,
				 "tel" => $newPhone, 
				 "string_latitude" => '0',
				 "string_longitude" => '0',
				 "id_enseigne" => $newIdEnseigne
				));
		$result = $soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
		$return = array();
		$return[]  = $dom->getElementsByTagName('reponse')->item(0)->nodeValue;
		$return[] = $dom->getElementsByTagName('message')->item(0)->nodeValue;
		return $return;
	}
};
?>