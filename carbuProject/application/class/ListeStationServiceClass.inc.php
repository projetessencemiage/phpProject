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

	public function getStationsByVille($ville, $dpt) {
		echo 'Ville -'.$ville. ' - Dpt - '.$dpt;
		$listeStations = array();
		$this->addStation(new StationService("Rue pierre de Coubertin St Medard en Jalles", "2", "Esso", "iconeStation.png"));
		$this->addStation(new StationService("48 avenue Bougnard 33600 Pessac", "5", "Esso",  "iconeStation.png"));
		$this->addStation(new StationService("49 Rue Robespierre 33400 Talence", "3", "Total",  "iconeStation.png"));
		$this->addStation(new StationService("Intermarché 33400 Talence", "8", "Intermarché",  "iconeStation.png"));
		$this->addStation(new StationService("Leclerc 33400 Talence", "1", "Leclerc", "iconeStation.png"));
		$this->addStation(new StationService("10 allée de l'église 40280 Benquet", "1", "Leclerc", "iconeStation.png"));
		$this->addStation(new StationService("75000 Paris 1er", "1", "Leclerc", "iconeStation.png"));
	}
	public function getStationsByDpt($dpt) {
		echo 'Dpt - '.$dpt;
		$listeStations = array();
		$this->addStation(new StationService("Rue pierre de Coubertin St Medard en Jalles", "2", "Esso", "iconeStation_verte_etoile.png"));
		$this->addStation(new StationService("48 avenue Bougnard 33600 Pessac", "5", "Esso",  "iconeStation_verte.png"));
		$this->addStation(new StationService("49 Rue Robespierre 33400 Talence", "3", "Total",  "iconeStation_verte.png"));
		$this->addStation(new StationService("Intermarché 33400 Talence", "8", "Intermarché",  "iconeStation_verte.png"));
		$this->addStation(new StationService("Leclerc 33400 Talence", "1", "Leclerc", "iconeStation_verte.png"));
	}
	public function getStationsByCP($cp) {
		echo 'cp - '.$cp;
		$listeStations = array();
		$this->addStation(new StationService("Rue pierre de Coubertin St Medard en Jalles", "2", "Esso", "iconeStation_rouge_etoile.png"));
		$this->addStation(new StationService("48 avenue Bougnard 33600 Pessac", "5", "Esso",  "iconeStation_rouge.png"));
		$this->addStation(new StationService("49 Rue Robespierre 33400 Talence", "3", "Total",  "iconeStation_rouge.png"));
		$this->addStation(new StationService("Intermarché 33400 Talence", "8", "Intermarché",  "iconeStation_rouge.png"));
		$this->addStation(new StationService("Leclerc 33400 Talence", "1", "Leclerc", "iconeStation_rouge.png"));
	}
	public function getStationsByAdresse($adr, $rayon) {
		echo 'Adr - '.$adr.' - Rayon - '.$rayon;
		$listeStations = array();
		$this->addStation(new StationService("Rue pierre de Coubertin St Medard en Jalles", "2", "Esso", "iconeStation_orange_etoile.png"));
		$this->addStation(new StationService("48 avenue Bougnard 33600 Pessac", "5", "Esso",  "iconeStation_orange.png"));
		$this->addStation(new StationService("49 Rue Robespierre 33400 Talence", "3", "Total",  "iconeStation_orange.png"));
		$this->addStation(new StationService("Intermarché 33400 Talence", "8", "Intermarché",  "iconeStation_orange.png"));
		$this->addStation(new StationService("Leclerc 33400 Talence", "1", "Leclerc", "iconeStation_orange.png"));
	}
	
	public function getStationsArroundMe($rayon) {
		echo 'ArroundMe - Rayon - '.$rayon;
		$listeStations = array();
		$this->addStation(new StationService("Rue pierre de Coubertin St Medard en Jalles", "2", "Esso", "iconeStation_orange_etoile.png"));
		$this->addStation(new StationService("48 avenue Bougnard 33600 Pessac", "5", "Esso",  "iconeStation_orange.png"));
		$this->addStation(new StationService("49 Rue Robespierre 33400 Talence", "3", "Total",  "iconeStation_orange.png"));
		$this->addStation(new StationService("Intermarché 33400 Talence", "8", "Intermarché",  "iconeStation_orange.png"));
		$this->addStation(new StationService("Leclerc 33400 Talence", "1", "Leclerc", "iconeStation_orange.png"));
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