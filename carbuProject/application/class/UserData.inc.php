<?php
/**
 * ------------------------------------------------------------------------
 * @Name : UserData.inc.php
 * @Desc : Classe UserData
 * @Autor : Thom
 * @Date : 29/03/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
require_once 'AccesBase.inc.php';

//---------------------------------------------------------------------------
// Classe UserData
//---------------------------------------------------------------------------
class UserData {
	static function getUser($nom) {
		$tableau;
		//requete de vérification du nom et du mot de passe
		$requete='select login, pwd, role,id_user '
		. ' from users '
		. ' where login="'.$nom.'"';
		$tableau = AccesBase::openRecordSet($requete);
		return $tableau;
	}


	static function isExistUser($nom) {
		#requete de vérification du nom et du mot de passe
		$requete='select count(0)'
		. ' from users'
		. ' where login="'.$nom.'"';
		return AccesBase::openRecordSet($requete);
	}

	static function getAllUsers() {
		#requete de récupération de tous les utilisateurs
		$requete='select login, pwd, role from users '
		. ' order by login ASC';
		return AccesBase::openRecordSet($requete);
	}

	static function update($user) {
		#requete de récupération de tous les utilisateurs
		$requete="update users set password = '".$user->password."',
			nomGroupe = '".$user->nomGroupe."',
			actif = '".$user->actif."',
			dateUpdateGroup = '".$user->dateUpdateGroup."'
			where userName='".$user->userName."'";
		AccesBase::openRecordSet($requete);
	}
	static function create($user) {
		#requete de récupération de tous les utilisateurs
		$requete="insert into users
			(userName, password,nomGroupe,actif,dateUpdateGroup)
			values ('".$user->userName."','".$user->password."', '".$user->nomGroupe."', '".$user->actif."', '".$user->dateUpdateGroup."')";
		AccesBase::openRecordSet($requete);
	}
	
};
?>