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
	private $userName;
	public $password;
	public $role;
	public $id_user;


	function __construct() {
		$this->userName  = '';
		$this->password  = '';
		$this->role      = '';
		$this->id_user      = '';
	}
	
	public function isExistUser($login, $pwd) {
		if ($login == 'TGOU' && $pwd == 'pass') {
			$this->userName = 'Thomas';
			return true;			
		} return false;	
	}

	public function getUserName() {
		return $this->userName;
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
