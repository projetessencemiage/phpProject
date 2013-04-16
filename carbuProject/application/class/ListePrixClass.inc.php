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
		$listPrix = array();
	}
	
	public function getPrix(){
		return $this->listPrix;
	}
	
	public function addPrix($prix) {
		$this->listPrix[] = $prix;
	}
	
}
?>