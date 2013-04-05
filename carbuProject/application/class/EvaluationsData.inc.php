<?php
require_once 'AccesBase.inc.php';

//---------------------------------------------------------------------------
// Classe EvaluationsData
//---------------------------------------------------------------------------
class EvaluationsData {
	
	static function supprimerNote($idEleve,$idCompetence){
		$requete = 'DELETE FROM note where id_competence = '.$idCompetence.' and id_eleve = '.$idEleve;
		AccesBase::execute($requete);
	}
	
	static function noteExiste($idEleve,$idCompetence){
		$requete = 'select count(*) from note where id_competence = '.$idCompetence.' and id_eleve = '.$idEleve;
		$rst = AccesBase::openRecordSet($requete);
		return $rst[0][0];
	}
	
	static function modiferNote($idEleve,$idCompetence,$valeurNote){
		$requete = 'UPDATE note SET note ='.$valeurNote 
		. ' where id_competence = '.$idCompetence.' and id_eleve = '.$idEleve;
		
		AccesBase::execute($requete);
	}
	
	static function ajouterNote($idEleve,$idCompetence,$valeurNote){
		$requete = 'INSERT INTO note (id_eleve,id_competence,note) '
		. 'VALUES ('.$idEleve.','.$idCompetence.','.$valeurNote.')';
		AccesBase::execute($requete);
	}
	
	static function getNoteEleve($idEleve,$semestre){
		$requete = 'select id_competence, note, id_cd, id_domaine, nom_competence  from note n'
		. ' inner join competence_annee ca on ca.id_competenceAnnee = n.id_competence '
		. ' where id_eleve = '.$idEleve.' and semestre = '.$semestre
		.'  order by id_competence';
		return AccesBase::openRecordSet($requete);
	}
	
	static function getMoyenneEleve($idEleve,$semestre,$idCompetence){
		$requete = 'select id_competence, note, id_cd, id_domaine from note n'
		. ' inner join competence_annee ca on ca.id_competenceAnnee = n.id_competence '
		. ' where id_eleve ='.$idEleve. ' and  semestre = '.$semestre.' and id_domaine = '
		. ' (select id_domaine from competence_annee where id_competenceAnnee = '.$idCompetence 
		. ' );';
		
		return AccesBase::openRecordSet($requete);
	}
};


?>