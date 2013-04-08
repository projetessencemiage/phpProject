<?php
/**
 * ------------------------------------------------------------------------
 * @Name : StationServiceClass.inc.php
 * @Desc : Classe StationService
 * @Author : Thom
 * @Date : 06/04/2013 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
require_once 'StationServiceData.inc.php';

class StationService {
	private $id;
	private $adresse;
	private $ville;
	private $CP;
	private $region;
	private $phone;
	private $enseigne;
	private $ListePrix;

	function __construct($adr, $_id, $_enseigne) {
		$this->adresse  = $adr;
		$this->id = $_id;
		$this->enseigne = $_enseigne;
	}
	
	public function getAdresse(){
		return $this->adresse;
	}
	public function getEnseigne(){
		return $this->enseigne;
	}
	public function getVille(){
		return $this->ville;
	}
	public function getCP(){
		return $this->CP;
	}
	public function getRegion(){
		return $this->region;
	}
	public function getPhone(){
		return $this->phone;
	}
	public function getID(){
		return $this->id;
	}	
}