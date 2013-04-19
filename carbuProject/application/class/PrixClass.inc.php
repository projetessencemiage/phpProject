<?php 

class Prix{
	private $carburant;
	private $prix;
	private $datemaj;
	
	function __construct($_carburant, $_prix, $_datemaj){

		$this->carburant = $_carburant;
		$this->prix = $_prix;
		$this->datemaj = $_datemaj;
	}
	

	public function getcarburant(){
		return $this->carburant;
	}
	public function getPrix(){
		return $this->prix;
	}
	public function getdatemaj(){
		return $this->datemaj;
	}
}


?>