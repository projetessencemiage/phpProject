<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ListeStationServiceClass.inc.php
 * @Desc : Classe ListeStationService
 * @Author : Thom
 * @Date : 07/04/2013 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
//require_once 'StationServiceData.inc.php';
require_once 'StationServiceClass.inc.php';
require_once 'ListePrixClass.inc.php';
require_once 'PrixClass.inc.php';

class ListeStationService {
	private $listeStations;
	private $soapClient;

	function __construct() {
		$this->soapClient =  new SoapClient(URL_WCF."/AffichagePrix.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$this->listeStations = array();
		
	}

	public function getStations(){
		return $this->listeStations;
	}

	public function addStation($station) {
		$this->listeStations[] = $station;
	}

	public function getStationsByVille($ville, $dpt) {
		$this->soapClient->GetPrixVille(array("ville" => $ville, "departement" => $dpt));
		$result = $this->soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
 		$this->arrayToListOfStations($dom);	
	}
	public function getStationsByDpt($dpt) {
		
		$this->soapClient->GetPrixDepartement(array("departement" => $dpt));
		$result = $this->soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
 		$this->arrayToListOfStations($dom);	
	}
	public function getStationsByCP($cp) {
		
		$this->soapClient->GetPrixCodePostal(array("codePostal" => $cp));
		$result = $this->soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
 		$this->arrayToListOfStations($dom);	
	}
	public function getStationsByAdresse($adr, $rayon) {
		$longitude = '';
		$lattitude = '';
		//$listeStationByPosition = $this->enforce_array($this->soapClient->GetPrixPosition(array("distance" => $rayon, "latitude" => $lattitude, "longitude" => $longitude))->GetPrixPositionResult);
// 		/$this->arrayToListOfStations($listeStationByPosition);
	}
	public function arrayToListOfStations($dom){
		
		$this->listeStations = array();

			$array = $dom->getElementsByTagName('Station');
		foreach ($array as $station){
				$address = $station->getElementsByTagName("address")->item(0)->nodeValue;
				$city = $station->getElementsByTagName("city")->item(0)->nodeValue;
				$cp = $station->getElementsByTagName("code_postal")->item(0)->nodeValue;
				$lattitude = $station->getElementsByTagName("lattitude")->item(0)->nodeValue;
				$longitude = $station->getElementsByTagName("longitude")->item(0)->nodeValue;
				$id_station = $station->getElementsByTagName("id_station")->item(0)->nodeValue;
				$tel = $station->getElementsByTagName("tel")->item(0)->nodeValue;
			
			$enseigne = $station->getElementsByTagName("enseigne_name")->item(0)->nodeValue;
			
			$price_list = new ListePrix();
			
 			foreach ($station->getElementsByTagName('prix') as $price){
 				
 					$carburant = $station->item(0)->item(1)->nodeValue;
 					$date_update = $station->item(1)->item(0)->nodeValue;
 					$value = $station->item(1)->item(1)->nodeValue;
 						
				$price_list->addPrix(new Prix($carburant, $value, $date_update));
			}
			
			$station = new StationService($address, $id_station, $enseigne, $city, $cp, $tel, $price_list, $lattitude, $longitude, '');
		$this->addStation($station);
		}
		
	}
	
	public function arrayToListOfStationsDistance($dom){
		
		$this->listeStations = array();
		$racine = $dom->documentElement;
		
		$array = $dom->getElementsByTagName('Station');
		foreach ($array as $station){
			$address = $station->getElementsByTagName("address")->item(0)->nodeValue;
			$city = $station->getElementsByTagName("city")->item(0)->nodeValue;
			$cp = $station->getElementsByTagName("code_postal")->item(0)->nodeValue;
			$lattitude = $station->getElementsByTagName("lattitude")->item(0)->nodeValue;
			$longitude = $station->getElementsByTagName("longitude")->item(0)->nodeValue;
			$id_station = $station->getElementsByTagName("id_station")->item(0)->nodeValue;
			$tel = $station->getElementsByTagName("tel")->item(0)->nodeValue;
				
			$enseigne = $station->getElementsByTagName("enseigne_name")->item(0)->nodeValue;
				
			$price_list = new ListePrix();
				
			foreach ($station->getElementsByTagName('prix') as $price){
					
				$carburant = $station->item(0)->item(1)->nodeValue;
				$date_update = $station->item(1)->item(0)->nodeValue;
				$value = $station->item(1)->item(1)->nodeValue;
					
				$price_list->addPrix(new Prix($carburant, $value, $date_update));
			}
				
			$station = new StationService($address, $id_station, $enseigne, $city, $cp, $tel, $price_list, $lattitude, $longitude, '');
			$this->addStation($station);
		}
		
	}
	
	public function getStationsArroundMe($rayon) {
		$longitude = '';
		$latitude = '';
		$this->soapClient->GetPrixPosition(array("distance" => $rayon, "latitude" => $latitude, "longitude" => $longitude));
		$result = $this->soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
 		$this->arrayToListOfStations($dom);
		
	}
	public function getInformationsStations() {
		$infos = "";
		foreach ($this->listeStations as $key => $value) {
			$infos .= 'Key:Adresse@@@Value:'.$value->getAdresse()." ".$value->getCP()." ".$value->getVille()."--";
			$infos .= 'Key:Lat@@@Value:'.$value->getlattitude()."--";
			$infos .= 'Key:Lng@@@Value:'.$value->getlongitude()."--";
			$infos .= 'Key:Enseigne@@@Value:'.$value->getEnseigne()."--";
			$infos .= 'Key:Icone@@@Value:'.$value->getIcone()."--";
			foreach ($value->getListePrix() as $typeCarbu => $price) {
				$infos .= 'PriceKey:'.$typeCarbu.'@@@Value:'.$price."--";
			}
				
			$infos .= '|';
		}
		return $infos;
	}
// 	function enforce_array($obj) {
// 		$array = (array)$obj;
// 		if(empty($array)) {
// 			$array = '';
// 		}
// 		else {
// 			foreach($array as $key=>$value) {
// 				if(!is_scalar($value)) {
// 					if(is_a($value,'SimpleXMLElement')) {
// 						$tmp = memcache_objects_to_array($value);
// 						if(!is_array($tmp)) {
// 							$tmp = ''.$value;
// 						}
// 						$array[$key] = $tmp;
// 					}
// 					else {
// 						$array[$key] = $this->enforce_array($value);
// 					}
// 				}
// 				else {
// 					$array[$key] = $value;
// 				}
// 			}
// 		}
// 		return $array;
// 	}

}
