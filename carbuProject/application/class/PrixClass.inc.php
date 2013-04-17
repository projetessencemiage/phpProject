<?php 

class Prix{
	private $carburant;
	private $station;
	private $datemaj;
	
	function __construct($_carburant, $_station, $_datemaj){

		$this->carburant = $_carburant;
		$this->station = $_station;
		$this->datemaj = $_datemaj;
	}
	

	public function getcarburant(){
		return $this->carburant;
	}
	public function getstation(){
		return $this->station;
	}
	public function getdatemaj(){
		return $this->datemaj;
	}
}


?>