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
	private $phone;
	private $mail;
	private $role;
	private $avatar;
	private $carbu;
	private $station;

	function __construct() {
		$this->id_user = '';
		$this->userName = '';
		$this->password = '';
		$this->civ = '';
		$this->nom = '';
		$this->prenom = '';
		$this->adresse = '';
		$this->cp = '';
		$this->ville = '';
		$this->phone = '';
		$this->mail = '';
		$this->role = '';
		$this->avatar = '';
		$this->carbu = '';
		$this->station = '';
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
	public function getPhone() {
		return $this->phone;
	}
	public function getMail() {
		return $this->mail;
	}
	
	public function getRole() {
		return $this->role;
	}
	
	public function getAdresseComplete() {
		return $this->adresse.' '.$this->getCp().' '.$this->ville;
	}
	public function getUser($nom) {
		try {
			$tableau = UserData::getUser($nom);
			$this->userName  = $tableau[0][0];
			$this->password  = $tableau[0][1];
			$this->role     = $tableau[0][2];
			$this->id_user     = $tableau[0][3];
		} catch (MyException $e) {
			throw new MyException($e->getError('User.getUser'));
			return false;
		}
	}


	public function getAllUser($nom) {
		try {
			$users = UserData::getAllUsers($nom);
			return $users;
		} catch (MyException $e) {
			throw new MyException($e->getError('User.getAllUsers'));
			return false;
		}
	}
	public function save() {
		try {
	    if (!$this->isExistUser($this->userName)){
		UserData::create($this);
	    }else{
		UserData::update($this);
	    }
	} catch (MyException $e) {
	    throw new MyException($e->getError('User.save'));
	    return false;
        }
    }
};

?>
