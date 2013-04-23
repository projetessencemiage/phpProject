<?php 

class Prix{
	private $carburant;
	private $prix;
	private $datemaj;
	private $nbjoursmaj;
	
	function __construct($_carburant, $_prix, $_datemaj, $_nbjoursmaj){

		$this->carburant = $_carburant;
		$this->prix = $_prix;
		$this->datemaj = $_datemaj;
		$this->nbjoursmaj = $_nbjoursmaj;
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
	public function getnbjoursmaj(){
		return $this->nbjoursmaj;
	}
}


?>