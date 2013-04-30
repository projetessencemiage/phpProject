<?php
/**
 * ------------------------------------------------------------------------
 * @Name : StationServiceClass.inc.php
 * @Desc : Classe StationService
 * @Author : CGI
 * @Date : 12/04/2013 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

class Enseigne {
	private $id_enseigne;
	private $enseigne_name;	

	function __construct($_id_enseigne, $_enseigne_name) {
		$this->id_enseigne = $_id_enseigne;
		$this->enseigne_name = $_enseigne_name;
	}
	
	public function getid_enseigne(){
		return $this->id_enseigne;
	}
	public function getenseigne_name(){
		return $this->enseigne_name;
	}
	
}