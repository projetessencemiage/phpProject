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

class ListePrix {
	private $id_station;
	private $address;
	private $city;
	private $code_postal;
	private $id_enseigne;
	private $tel;
	private $prix;
	private $lattitude;
	private $longitude;
	

	function __construct($_id_station, $_address, $_city, $_code_postal, $_id_enseigne, $_tel, $_prix, $_lattitude, $_longitude) {
		$this->id_station = $_id_station;
		$this->address = $_address;
		$this->city = $_city;
		$this->code_postal = $_code_postal;
		$this->id_enseigne = $_id_enseigne;
		$this->tel = $_tel;
		$this->prix = $_prix;
		$this->lattitude = $_lattitude;
		$this->longitude = $_longitude;
	}
	
	public function getid_station(){
		return $this->id_station;
	}
	public function getaddress(){
		return $this->address;
	}
	public function getcity(){
		return $this->city;
	}
	public function getcode_postal(){
		return $this->code_postal;
	}
	public function getid_enseigne(){
		return $this->id_enseigne;
	}
	public function gettel(){
		return $this->tel;
	}
	public function getprix(){
		return $this->prix;
	}
	public function getlattitude(){
		return $this->lattitude;
	}
	public function getlongitude(){
		return $this->longitude;
	}
	
}