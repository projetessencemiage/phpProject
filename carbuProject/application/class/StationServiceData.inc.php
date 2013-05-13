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
	
	static function getStationById($id) {
		$soapClient = new SoapClient(URL_WCF."/ActionAdmin.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$soapClient->GetStationByID(array("id_station" => $id));
		$result = $soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
		$adr = $dom->getElementsByTagName('address')->item(0)->nodeValue;
		$_id_enseigne = $dom->getElementsByTagName('id_enseigne')->item(0)->nodeValue;
		$_enseigne_name = $dom->getElementsByTagName('enseigne_name')->item(0)->nodeValue;
		$_enseigne = new Enseigne($_id_enseigne, $_enseigne_name);
		$_city = $dom->getElementsByTagName('city')->item(0)->nodeValue;
		$_code_postal = $dom->getElementsByTagName('code_postal')->item(0)->nodeValue;
		$_tel = $dom->getElementsByTagName('tel')->item(0)->nodeValue;
		$_ListePrix = new ListePrix();
		$listPrixXML = $dom->getElementsByTagName('price_list')->item(0)->childNodes;
		foreach ($listPrixXML as $price){
			$_carburant = $price->getElementsByTagName('type_nom')->item(0)->nodeValue;
			$_prix = $price->getElementsByTagName('price')->item(0)->nodeValue;
			$datemaj = $price->getElementsByTagName('dateMiseAjour')->item(0)->nodeValue;
			$date_price = DateTime::CreateFromFormat("d/m/Y H:i:s",$datemaj);
			$date_actual = new DateTime();
			$diff = round(round($date_actual->format('U') - $date_price->format('U	')) / (3600*24));
			$_ListePrix->addPrix(new Prix($_carburant, $_prix, $date_price, $diff));
		}
		return new StationService($adr, $id, $_enseigne, $_city, $_code_postal, $_tel, $_ListePrix, '','','','');
	}
};
?>