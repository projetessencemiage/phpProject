<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ListePrixClass.inc.php
 * @Desc : Classe StationService
 * @Author : CGI
 * @Date : 12/04/2013 : création
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
		print_r($this->listPrix);
		//foreach ($this->listPrix as $key => $prix) {
			//echo $prix->getcarburant();
		//}
	}
	
}
?>