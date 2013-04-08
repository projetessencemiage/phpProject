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

//---------------------------------------------------------------------------
// Classe Eleve
//---------------------------------------------------------------------------
class StationService {
	private $adresse;
	private $id;
	private $enseigne;
	

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
	
}