<?php
/**
 * ------------------------------------------------------------------------
 * @Name : StationServiceData.inc.php
 * @Desc : Classe StationServiceData
 * @Autor : Thom
 * @Date : 29/03/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
require_once 'AccesBase.inc.php';


class StationServiceData {
	static function getClasse($id,$annee) {
		$requete='select id, instituteur'
		. ' from classe '
		. ' where id_users="'.$id.'"and annee="'.$annee.'"';
		return AccesBase::openRecordSet($requete);
	}

	static function nombreClasse($id){
		$tableau;
		$requete='select count(*)'
		. ' from classe '
		. ' where id_users="'.$id.'"';
		$tableau = AccesBase::openRecordSet($requete);
		return $tableau[0][0];
	}

	static function getListeClasse($id) {
		//requete de vérification du nom et du mot de passe
		$requete='select id, annee'
		. ' from classe '
		. ' where id_users="'.$id.'"';
		return AccesBase::openRecordSet($requete);
	}

	static function nombreEleveClasse($id,$annee){
		$tableau;
		$requete='select count(*)'
		. ' from classe '
		. ' inner join eleve on (eleve.id_classe=classe.id)'
		. ' where classe.id ="'.$id.'" and annee="'.$annee.'"';
		$tableau = AccesBase::openRecordSet($requete);
		return $tableau[0][0];
	}

	static function getListeAnnee($id){
		$tableau;
		$requete='select DISTINCT annee'
		. ' from classe '
		. ' where id_users="'.$id.'"';

		try {
			$listeAnnee = array();
			$tableau = AccesBase::openRecordSet($requete);
			foreach($tableau as $r) {
				$listeAnnee[$r[0]] = ($r[0]-1).'/'.$r[0];
			}
			return $listeAnnee;
		} catch (MyException $e) {
			throw new MyException($e->getError('ObjectifGainAchatData.getListeFiltre'));
		}

	}
	
	static function getListeEleve($id,$annee){
		$requete = 'select id_eleve, nom, prenom from classe '
		. ' inner join eleve on (eleve.id_classe=classe.id)'
		.' where id_users = "'.$id.'" and annee = "'.$annee.'" order by nom, prenom';
		return AccesBase::openRecordSet($requete);
		
	}
	
	static function supprimerEleve($id_eleve){
		$requete = 'DELETE FROM eleve where id_eleve = '.$id_eleve;
		return AccesBase::execute($requete);
	}

};
?>