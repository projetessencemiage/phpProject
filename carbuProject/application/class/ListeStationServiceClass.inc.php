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

class ListeStationService {
	private $listeStations; 
	
	function __construct() {
		$listeStations = array();
	}
	
	public function getStations(){
		return $this->listeStations;
	}
	
	public function addStation($station) {
		$this->listeStations[] = $station;
	}
	
	public function getInformationsStations() {
		$infos = "";
		foreach ($this->listeStations as $key => $value) {				
			$infos .= 'Key:Adresse@@@Value:'.$value->getAdresse()."--";
			$infos .= 'Key:Enseigne@@@Value:'.$value->getEnseigne()."--";
			$infos .= 'Key:Icone@@@Value:'.$value->getIcone()."--";
			foreach ($value->getListePrix() as $typeCarbu => $price) {	
				$infos .= 'PriceKey:'.$typeCarbu.'@@@Value:'.$price."--";
			}
			
			$infos .= '|';
		}
		return $infos;
	}
	
}