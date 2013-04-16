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
require_once 'ListePrixClass.inc.php';

class StationService {
	private $id;
	private $adresse;
	private $ville;
	private $CP;
	private $enseigne;
	private $phone;
	private $ListePrix;
	private $lattitude;
	private $longitude;
	private $icone;

	function __construct($adr, $_id, $_enseigne, $_city, $_code_postal, $_tel, $_ListePrix, $_lattitude, $_longitude, $_icone) {
		$this->adresse  = $adr;
		$this->id = $_id;
		$this->enseigne = $_enseigne;
		$this->ville = $_city;
		$this->CP = $_code_postal;
		$this->phone = $_tel;
		$this->ListePrix = $_ListePrix;
		$this->lattitude = $_lattitude;
		$this->longitude = $_longitude;
		$this->icone = $_icone;
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
	public function getlattitude(){
		return $this->lattitude;
	}
	public function getlongitude(){
		return $this->longitude;
	}
	public function getPhone(){
		return $this->phone;
	}
	public function getID(){
		return $this->id;
	}
	public function getListePrix() {
		$priceList = array();
		$priceList['SP95-E10'] = 1.055;
		$priceList['diesel'] = 2.755;
		$priceList['gpl'] = 1.523;
		return $priceList;
	}

	public function getIcone() {
		return $this->icone;
	}
	public function setIcone($newIcone) {
		$this->icone = $newIcone;
	}

}
?>