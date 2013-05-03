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
};
?>