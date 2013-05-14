<?php
/**
 * ------------------------------------------------------------------------
 * @Name : UserClass.inc.php
 * @Desc : Classe User
 * @Author : TGOU
 * @Date : 25/04/2013
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
require_once 'UserData.inc.php';

//---------------------------------------------------------------------------
// Classe User
//---------------------------------------------------------------------------
class User {
	private $id_user;
	private $userName;
	private $password;
	private $civ;
	private $nom;
	private $prenom;
	private $adresse;
	private $cp;
	private $ville;
	private $mail;
	private $role;
	private $avatar;
	private $carbu;
	private $station;

	function __construct($id="",$username="", $password="", $civ="", $nom="", $prenom="", $adresse="", $cp="", $ville="", $mail="", $role="", $avatar="", $carbu="", $station="") {
		$this->id_user = $id;
		$this->userName = $username;
		$this->password = $password;
		$this->civ = $civ;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->adresse = $adresse;
		$this->cp = $cp;
		$this->ville = $ville;
		$this->mail = $mail;
		$this->role = $role;
		$this->avatar = $avatar;
		$this->carbu = $carbu;
		$this->station = $station;
	}
	
	public function isExistUser($login, $pwd) {
		$result = UserData::isExistUser($login, $pwd); 
		$code = $result[0];
		$userXML  = $result[1];
		if ($code == 0) {
			$this->userName = $userXML->getElementsByTagName('pseudo')->item(0)->nodeValue;
			$this->civ = $userXML->getElementsByTagName('civilite')->item(0)->nodeValue;
			$this->nom = $userXML->getElementsByTagName('nom')->item(0)->nodeValue;
			$this->prenom = $userXML->getElementsByTagName('prenom')->item(0)->nodeValue;
			$this->adresse = $userXML->getElementsByTagName('adresse')->item(0)->nodeValue;
			$this->cp = $userXML->getElementsByTagName('code_postal')->item(0)->nodeValue;
			$this->ville = $userXML->getElementsByTagName('ville')->item(0)->nodeValue;
			$this->mail = $userXML->getElementsByTagName('email')->item(0)->nodeValue;
			$this->role = $userXML->getElementsByTagName('idRole')->item(0)->nodeValue;
			$this->avatar = $userXML->getElementsByTagName('avatar')->item(0)->nodeValue;
			$this->carbu = $userXML->getElementsByTagName('id_carburant_pref')->item(0)->nodeValue;
			$this->station = $userXML->getElementsByTagName('id_station_favorite')->item(0)->nodeValue;
		} 
		return $code;
	}
	
	public function getId_user() {
		return $this->id_user;
	}
	public function getUserName() {
		return $this->userName;
	}
	public function getCiv() {
		return $this->civ;
	}
	public function getNom() {
		return $this->nom;
	}
	public function getPrenom() {
		return $this->prenom;
	}
	public function getAdresse() {
		return $this->adresse;
	}
	public function getCp() {
		return $this->cp;
	}
	public function getVille() {
		return $this->ville;
	}
	public function getMail() {
		return $this->mail;
	}
	public function getRole() {
		return $this->role;
	}
	public function getAvatar() {
		return $this->avatar;
	}
	public function getCarbu() {
		return $this->carbu;
	}
	public function getStation() {
		return $this->station;
	}
	
	public function getAdresseComplete() {
		return $this->adresse.' '.$this->getCp().' '.$this->ville;
	}
};

?>
