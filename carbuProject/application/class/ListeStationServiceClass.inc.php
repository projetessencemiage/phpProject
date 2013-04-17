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
;require_once 'ListePrixClass.inc.php';
;require_once 'PrixClass.inc.php';

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
		$listeStationByVille = $this->enforce_array($this->soapClient->GetPrixVille(array("ville" => $ville, "departement" => $dpt))->GetPrixVilleResult);
		$this->arrayToListOfStations($listeStationByVille);
	}
	public function getStationsByDpt($dpt) {
		
		$listeStationByDpt = $this->enforce_array($this->soapClient->GetPrixDepartement(array("departement" => $dpt))->GetPrixDepartementResult);
		$this->arrayToListOfStations($listeStationByDpt);
	}
	public function getStationsByCP($cp) {
		$listeStationByCP = $this->enforce_array($this->soapClient->GetPrixCodePostal(array("codePostal" => $cp))->GetPrixCodePostalResult);
		$this->arrayToListOfStations($listeStationByCP);	
	}
	public function getStationsByAdresse($adr, $rayon) {
		$longitude = '';
		$lattitude = '';
		$listeStationByPosition = $this->enforce_array($this->soapClient->GetPrixPosition(array("distance" => $rayon, "latitude" => $lattitude, "longitude" => $longitude))->GetPrixPositionResult);
		$this->arrayToListOfStations($listeStationByPosition);
	}
	public function arrayToListOfStations($array){
		
		$this->listeStations = array();
		var_dump($array );
		var_dump("   ///////////////////   ");
		foreach ($array["Station"] as $station){
		var_dump($station['enseigne']);
			$address = $station['address'];
			$city = $station['city'];
			$cp = $station['code_postal'];
			$enseigne = $station['enseigne']['enseigne_name'];
			$lattitude = $station['lattitude'];
			$longitude = $station['longitude'];
			$id_station = $station["id_station"];
			$tel = $station['tel'];
			
			$price_list = new ListePrix();
			
			foreach ($station['price_list']["Prix"] as $price){
					
				$carburant = $price["carburant_type"]["type_nom"];
				$date_update = $price["dateMiseAjour"];
				$value = $price["price"];
				
				$price_list->addPrix(new Prix($carburant, $value, $date_update));
			}
			
			$station = new StationService($address, $id_station, $enseigne, $city, $cp, $tel, $price_list, $lattitude, $longitude, '');
		$this->addStation($station);
		}
		
		var_dump($this->getInformationsStations());
	}
	
	public function arrayToListOfStationsDistance($array){
	
		$this->listeStations = array();
		var_dump($array);
	
		foreach ($array["StationAndDistance"][0] as $station){
	
			$address = $station['address'];
			$city = $station['city'];
			$cp = $station['code_postal'];
			$enseigne = $station['enseigne']['enseigne_name'];
			$lattitude = $station['lattitude'];
			$longitude = $station['longitude'];
			$id_station = $station["id_station"];
			$tel = $station['tel'];
				
			$price_list = new ListePrix();
				
			foreach ($station['price_list']["Prix"] as $price){
					
				$carburant = $price["carburant_type"]["type_nom"];
				$date_update = $price["dateMiseAjour"];
				$value = $price["price"];
	
				$price_list->addPrix(new Prix($carburant, $value, $date_update));
			}
				
			$station = new StationService($address, $id_station, $enseigne, $city, $cp, $tel, $price_list, $lattitude, $longitude, '');
			$this->addStation($station);
		}
	}
	
	public function getStationsArroundMe($rayon) {
		$longitude = '';
		$latitude = '';
		$listeStationByMyPosition = $this->enforce_array($this->soapClient->GetPrixPosition(array("distance" => $rayon, "latitude" => $latitude, "longitude" => $longitude))->GetPrixPositionResult);
		$this->arrayToListOfStations($listeStationByMyPosition);
		return $listeStationByMyPosition;
		
	}
	public function getInformationsStations() {
		$infos = "";
		foreach ($this->listeStations as $key => $value) {
			$infos .= 'Key:Adresse@@@Value:'.$value->getAdresse()." ".$value->getCP()." ".$value->getVille()."--";
			$infos .= 'Key:Enseigne@@@Value:'.$value->getEnseigne()."--";
			$infos .= 'Key:Icone@@@Value:'.$value->getIcone()."--";
			foreach ($value->getListePrix() as $typeCarbu => $price) {
				$infos .= 'PriceKey:'.$typeCarbu.'@@@Value:'.$price."--";
			}
				
			$infos .= '|';
		}
		return $infos;
	}
	function enforce_array($obj) {
		$array = (array)$obj;
		if(empty($array)) {
			$array = '';
		}
		else {
			foreach($array as $key=>$value) {
				if(!is_scalar($value)) {
					if(is_a($value,'SimpleXMLElement')) {
						$tmp = memcache_objects_to_array($value);
						if(!is_array($tmp)) {
							$tmp = ''.$value;
						}
						$array[$key] = $tmp;
					}
					else {
						$array[$key] = $this->enforce_array($value);
					}
				}
				else {
					$array[$key] = $value;
				}
			}
		}
		return $array;
	}

}
