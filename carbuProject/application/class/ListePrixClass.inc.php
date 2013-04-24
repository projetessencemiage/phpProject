<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ListePrixClass.inc.php
 * @Desc : Classe StationService
 * @Author : CGI
 * @Date : 12/04/2013 : cr�ation
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

class ListePrix {
	private $listPrix;

	function __construct() {
		$this->listPrix = array();
	}
	
	public function getPrix(){
		return $this->listPrix;
	}
	
	public function addPrix($prix) {
		$this->listPrix[] = $prix;
	}
	
	public function getListTypetoPrix() {
		$arrayPrice = array();
		foreach ($this->listPrix as $key => $prix) {
			$array = array();
			$array['Prix'] = $prix->getPrix();
			$array['DateMaj'] = $prix->getdatemaj();
			$array['NbJMaj'] = $prix->getnbjoursmaj();
			$arrayPrice[$prix->getcarburant()] = $array;
		}
		return $arrayPrice;
	}
	
}
?>