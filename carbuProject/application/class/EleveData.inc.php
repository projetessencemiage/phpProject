<?php
/**
 * ------------------------------------------------------------------------
 * @Name : EleveData.inc.php
 * @Desc : Classe EleveData
 * @Autor : Thom
 * @Date : 29/03/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
require_once 'AccesBase.inc.php';

//---------------------------------------------------------------------------
// Classe EleveData
//---------------------------------------------------------------------------
class EleveData {

	static function updateEleve($eleve) {

		//requete de vérification du nom et du mot de passe
		$requete='Update eleve set nom = "'.$eleve->nom.'", prenom = "'.$eleve->prenom.'"'
		. ' where id_eleve="'.$eleve->id_eleve.'"';

		return AccesBase::execute($requete);
	}

	static function createEleve($eleve) {

		//requete de vérification du nom et du mot de passe
		$requete='insert into eleve
			(id_classe, nom,prenom)
			values ('.$eleve->id_classe.',"'.$eleve->nom.'", "'.$eleve->prenom.'")';
		AccesBase::openRecordSet($requete);
	}

	static function getEleve($id){
		$requete = 'select id_eleve, nom, prenom from eleve where id_eleve = '.$id;
		return AccesBase::openRecordSet($requete);
	}
	
	static function isInClasse($id_eleve,$idInstit){
		$requete = 'select count(*) from eleve e '
				. ' INNER JOIN classe c on c.id = e.id_classe '
				. ' where id_eleve = '.$id_eleve.' and id_users = '.$idInstit;
		$rst =  AccesBase::openRecordSet($requete);
		return $rst[0][0];		
	}
};
?>