<?php
/**
 * ------------------------------------------------------------------------
* @Name : StationServiceClass.inc.php
* @Desc : Classe StationService
* @Author : Thom
* @Date : 06/04/2013 : cr�ation
* @Version : V1.0;
* ------------------------------------------------------------------------
**/
require_once 'StationServiceData.inc.php';
require_once 'ListePrixClass.inc.php';
require_once 'EnseigneClass.inc.php';

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
	private $distance;
	private $dateCreation;

	function __construct($adr, $_id, $_enseigne, $_city, $_code_postal, $_tel, $_ListePrix, $_lattitude, $_longitude, $_icone, $_distance, $_dateCreation='') {
		$this->adresse  = $adr;
		$this->id = $_id;
		$this->enseigne = $_enseigne;
		$this->ville = $_city;
		$this->CP = $_code_postal;
		$this->phone = $_tel;
		$this->ListePrix = $_ListePrix;
		$this->lattitude = $_lattitude;
		$this->longitude = $_longitude;
		$this->distance = $_distance;
		$this->icone = $_icone;
		$this->dateCreation = $_dateCreation;
	}
	
	public function getAdresse(){
		return $this->adresse;
	}
	
	public function getAdresseComplete() {
		return $this->adresse.' '.$this->CP.' '.$this->ville;	
	}
	
	public function getEnseigne(){
		return $this->enseigne->getenseigne_name();
	}
	
	public function getEnseigneObject(){
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
		return $this->ListePrix->getListTypetoPrix();
	}

	public function getIcone() {
		return $this->icone;
	}
	public function getDistance(){
		return $this->distance;
	}
	public function setIcone($newIcone) {
		$this->icone = $newIcone;
	}
	public function getDateCreation(){
		return $this->dateCreation;
	}
	
	public function setEnseigneName($_enseigne) {
		$this->enseigne->setName($_enseigne);
	}
	
	public function setEnseigneID($_enseigne) {
		$this->enseigne->setID($_enseigne);
	}
	
	public function setAdresse($_adresse) {
		$this->adresse = $_adresse;
	}
	public function setVille($_ville) {
		$this->ville = $_ville;
	}
	public function setCP($_cp) {
		$this->CP = $_cp;
	}
	public function setPhone($_phone) {
		$this->phone = $_phone;
	}
}
?>
