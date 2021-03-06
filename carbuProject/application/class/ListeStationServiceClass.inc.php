<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ListeStationServiceClass.inc.php
 * @Desc : Classe ListeStationService
 * @Author : Thom
 * @Date : 07/04/2013 : cr�ation
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
//require_once 'StationServiceData.inc.php';
require_once 'StationServiceClass.inc.php';
require_once 'ListePrixClass.inc.php';
require_once 'PrixClass.inc.php';
require_once 'EnseigneClass.inc.php';

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

	public function getStationsByVille($ville, $dpt, $carbuType) {
		$this->soapClient->GetPrixVille(array("ville" => $ville, "departement" => $dpt));
		$result = $this->soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
 		$this->arrayToListOfStations($dom, $carbuType);	
	}
	public function getStationsByDpt($dpt, $carbuType) {
		
		$this->soapClient->GetPrixDepartement(array("departement" => $dpt));
		$result = $this->soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
 		$this->arrayToListOfStations($dom, $carbuType);	
	}
	public function getStationsByCP($cp, $carbuType) {
		
		$this->soapClient->GetPrixCodePostal(array("codePostal" => $cp));
		$result = $this->soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
 		$this->arrayToListOfStations($dom, $carbuType);	
	}
	
	public function getStationsByID($id, $liste) {
		$stationByID;
		$this->listeStations = array();
		foreach ($liste as $key => $value) {
			if ($value->getID() == $id) {
				$this->addStation($value);
				$stationByID = $value;
			}
		}		
		return $stationByID;
	}
	
	public function getStationsByAdresse($adr, $rayon, $carbuType) {
		$array_position = Fonctions::getCoordFromAdresse($adr);
		if (count($array_position) > 1) {
			$latitude = $array_position['lat'];
			$longitude = $array_position['lng'];
			$this->soapClient->GetPrixPosition(array("distance" => $rayon, "longitude" => $longitude, "latitude" => $latitude));
			$result = $this->soapClient->__getLastResponse();
			$dom = new DomDocument();
			$dom->loadXML($result);
			$this->arrayToListOfStationsDistance($dom, $carbuType);
			return $array_position;
		}
	}
	
	public function getStationsArroundMe($rayon,$carbuType) {
		$array_position = Fonctions::getCoordByIp();
		$longitude = $array_position['lng'];
		$latitude =  $array_position['lat'];
		$this->soapClient->GetPrixPosition(array("distance" => $rayon, "longitude" => $longitude, "latitude" => $latitude));
		$result = $this->soapClient->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
		$this->arrayToListOfStationsDistance($dom,$carbuType);
	}
	
	public function getStationsToValid(){
		$soapAdmin = new SoapClient(URL_WCF."/ActionAdmin.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$soapAdmin->ListStationAValider(array());
		$result = $soapAdmin->__getLastResponse();
		$dom = new DomDocument();
		$dom->loadXML($result);
		$this->arrayToListOfStations($dom, '1');
	}
	
	public function arrayToListOfStations($dom, $carbuType){
		
		$this->listeStations = array();
			$array = $dom->getElementsByTagName('Station');
			$station_min= array();
			$prix_min = 1000;
		foreach ($array as $station){
				$address = $station->getElementsByTagName("address")->item(0)->nodeValue;
				$city = $station->getElementsByTagName("city")->item(0)->nodeValue;
				$cp = $station->getElementsByTagName("code_postal")->item(0)->nodeValue;
				$lattitude = $station->getElementsByTagName("lattitude")->item(0)->nodeValue;
				$longitude = $station->getElementsByTagName("longitude")->item(0)->nodeValue;
				$id_station = $station->getElementsByTagName("id_station")->item(0)->nodeValue;
				$tel = $station->getElementsByTagName("tel")->item(0)->nodeValue;
				$dateCreation = $station->getElementsByTagName("dateCreation")->item(0)->nodeValue;
				$enseigneName = $station->getElementsByTagName("enseigne_name")->item(0)->nodeValue;
				$enseigneID = $station->getElementsByTagName("id_enseigne")->item(0)->nodeValue;
				$enseigne = new Enseigne($enseigneID, $enseigneName);
			$price_list = new ListePrix();
			$isBest=false;
			$equal=false;
			$img = "iconeStation_sans_prix.png";
		foreach ($station->getElementsByTagName('Prix') as $price){
				$carburant = $price->childNodes->item(0)->childNodes->item(1)->nodeValue;
				$date_update = $price->childNodes->item(1)->nodeValue;
				$value = $price->childNodes->item(3)->nodeValue;
				$date_price = DateTime::CreateFromFormat("d/m/Y H:i:s",$date_update);
				$date_actual = new DateTime();
				$diff = round(round($date_actual->format('U') - $date_price->format('U')) / (3600*24));
				if ($carburant == $carbuType){
					if ($diff < 3){
						$img = 'iconeStation_verte.png';
					}elseif ($diff < 7){
						$img = 'iconeStation_orange.png';
					}elseif ($diff < 15){
						$img = 'iconeStation_rouge.png';
					}elseif ($diff > 15){
						$img = 'iconeStation.png';
					}
					
					if( $value < $prix_min){
					 $isBest = true;
					$prix_min = $value;
					}elseif ( $value == $prix_min){
						$equal = true;
					}
				}
				$price_list->addPrix(new Prix($carburant, $value, $date_update, $diff));
			}
			if(sizeof($price_list->getListTypetoPrix()) == 0){
			$img = 'iconeStation_sans_prix.png';
			}
			$station = new StationService($address, $id_station, $enseigne, $city, $cp, $tel, $price_list, $lattitude, $longitude, $img,'', $dateCreation);
			if($isBest){
				if(! is_null($station_min)){
					
					foreach ($station_min as $stationTmp){
						$this->addStation($stationTmp);
					}
				}
				$station_min = array();
				$station_min[] = $station;
			}elseif ($equal){
				$station_min[] = $station;
			}else{
			
				$this->addStation($station);
			}
		}
		foreach ($station_min as $station){
			if(! is_null($station)){
				if($station->getIcone() == 'iconeStation_verte.png'){
					$station->setIcone('iconeStation_verte_etoile.png');
				}elseif ($station->getIcone() == 'iconeStation_orange.png'){
					$station->setIcone('iconeStation_orange_etoile.png');
				}elseif ($station->getIcone() == 'iconeStation_rouge.png'){
					$station->setIcone('iconeStation_rouge_etoile.png');
				}
				$this->addStation($station);
			}
		}
		
	}
	
	public function arrayToListOfStationsDistance($dom, $carbuType){
		
		$this->listeStations = array();
		
		$array = $dom->getElementsByTagName('StationAndDistance');
			$station_min= array();
		$prix_min = 1000;
		foreach ($array as $station){
			$distance = $station->childNodes->item(0)->nodeValue;
			
			$address = $station->childNodes->item(1)->getElementsByTagName("address")->item(0)->nodeValue;
			$city = $station->childNodes->item(1)->getElementsByTagName("city")->item(0)->nodeValue;
			$cp = $station->childNodes->item(1)->getElementsByTagName("code_postal")->item(0)->nodeValue;
			$lattitude = $station->childNodes->item(1)->getElementsByTagName("lattitude")->item(0)->nodeValue;
			$longitude = $station->childNodes->item(1)->getElementsByTagName("longitude")->item(0)->nodeValue;
			$id_station = $station->childNodes->item(1)->getElementsByTagName("id_station")->item(0)->nodeValue;
			$tel = $station->childNodes->item(1)->getElementsByTagName("tel")->item(0)->nodeValue;
				
			
			$enseigneName = $station->childNodes->item(1)->getElementsByTagName("enseigne_name")->item(0)->nodeValue;
			$enseigneID = $station->childNodes->item(1)->getElementsByTagName("id_enseigne")->item(0)->nodeValue;
			$enseigne = new Enseigne($enseigneID, $enseigneName);
			$price_list = new ListePrix();
			$isBest=false;
			$equal=false;
			$img = "iconeStation_sans_prix.png";
			foreach ($station->childNodes->item(1)->getElementsByTagName('Prix') as $price){
				$carburant = $price->childNodes->item(0)->childNodes->item(1)->nodeValue;
				$date_update = $price->childNodes->item(1)->nodeValue;
				$value = $price->childNodes->item(3)->nodeValue;
				$date_price = DateTime::CreateFromFormat("d/m/Y H:i:s",$date_update);
					$date_actual = new DateTime();
					$diff = round(round($date_actual->format('U') - $date_price->format('U	')) / (3600*24));
				if ($carburant == $carbuType){
					
					if ($diff < 3){
						$img = 'iconeStation_verte.png';
					}elseif ($diff < 7){
						$img = 'iconeStation_orange.png';
					}elseif ($diff < 15){
						$img = 'iconeStation_rouge.png';
					}elseif ($diff > 15){
						$img = 'iconeStation.png';
					}
					if( $value < $prix_min){
						$isBest = true;
						$prix_min = $value;
					}elseif ( $value == $prix_min){
						$equal = true;
					}
				}
				$price_list->addPrix(new Prix($carburant, $value, $date_update, $diff));
			}
			
			if(sizeof($price_list->getListTypetoPrix()) == 0){
				$img = 'iconeStation_sans_prix.png';
			}
			$station = new StationService($address, $id_station, $enseigne, $city, $cp, $tel, $price_list, $lattitude, $longitude, $img, $distance);
		if($isBest){
				if(! is_null($station_min)){
					foreach ($station_min as $stationTmp){
						$this->addStation($stationTmp);
					}
				}
				$station_min = array();
				$station_min[] = $station;
			}elseif ($equal){
				$station_min[] = $station;
			}else{
				$this->addStation($station);
			}
		}
		
		//var_dump($station_min);
	foreach ($station_min as $station){
			if(! is_null($station)){
				if($station->getIcone() == 'iconeStation_verte.png'){
					$station->setIcone('iconeStation_verte_etoile.png');
				}elseif ($station->getIcone() == 'iconeStation_orange.png'){
					$station->setIcone('iconeStation_orange_etoile.png');
				}elseif ($station->getIcone() == 'iconeStation_rouge.png'){
					$station->setIcone('iconeStation_rouge_etoile.png');
				}
				$this->addStation($station);
			}
		}
		
	}
	
	public function getInformationsStations() {
		$infos = "";
		foreach ($this->listeStations as $key => $value) {
			$infos .= 'Key:Adresse@@@Value:'.$value->getAdresseComplete()."--";
			$infos .= 'Key:Lat@@@Value:'.$value->getlattitude()."--";
			$infos .= 'Key:Lng@@@Value:'.$value->getlongitude()."--";
			$infos .= 'Key:Enseigne@@@Value:'.$value->getEnseigne()."--";
			$infos .= 'Key:Icone@@@Value:'.$value->getIcone()."--";
			$infos .= 'Key:Phone@@@Value:'.$value->getPhone()."--";
			$infos .= 'Key:ID@@@Value:'.$value->getID()."--";
			foreach ($value->getListePrix() as $typeCarbu => $array) {
				$infos .= 'PriceKey:'.$typeCarbu.'@@@Value:'.$array['Prix'].'@@@Maj:'.$array['NbJMaj'].'--';
			}
				
			$infos .= '|';
		}
		return $infos;
	}
	
}
