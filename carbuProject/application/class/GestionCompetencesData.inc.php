<?php
require_once 'AccesBase.inc.php';

//---------------------------------------------------------------------------
// Classe GestionCompetencesData
//---------------------------------------------------------------------------
class GestionCompetencesData {

	static function isExisteDomaine( $nom = null) {

		$requete= 'select count(*) from domaine ';
		if($nom != null) $requete .= ' where LOWER(nom_domaine) = \''.strtolower($nom).'\'';

		$rst = AccesBase::openRecordSet($requete);
		return $rst[0][0];
	}

	static function isExisteCompetenceAnnee($annee){
		$requete = 'select count(*) from competence_annee where annee = '.$annee;
		$rst = AccesBase::openRecordSet($requete);
		return $rst[0][0];
	}

	static function isExisteChampsDisciplinaire($nomCD,$idDomaine){
		$requete= 'select count(*) from champs_disciplinaire where LOWER(nom_cd) = \''.strtolower($nomCD).'\' and id_domaine = '.$idDomaine;
		$rst = AccesBase::openRecordSet($requete);
		return $rst[0][0];
	}

	static function ajoutDomaine($nomDomaine){
		$requete = 'INSERT INTO domaine (nom_domaine) VALUES (\''.$nomDomaine.'\')';
		return AccesBase::openRecordSetAndValue($requete,'SELECT LAST_INSERT_ID() FROM domaine');
	}

	static function ajoutChampsDisciplinaire($nomCD,$idDomaine){
		$requete = 'INSERT INTO champs_disciplinaire (nom_cd,id_domaine) VALUES (\''.$nomCD.'\',\''.$idDomaine.'\')';
		return AccesBase::openRecordSetAndValue($requete, 'SELECT LAST_INSERT_ID() FROM domaine');
	}

	static function ajoutCompetence($nomCompetence,$idDomaine,$idCD,$semestre,$annee){
		$requete = 'INSERT INTO competence_annee (annee,semestre,nom_competence,id_domaine,id_cd) '
		. ' VALUES (\''.$annee.'\',\''.$semestre.'\',\''.$nomCompetence.'\',\''.$idDomaine.'\',\''.$idCD.'\')';
		AccesBase::execute($requete);
	}


	static function isNotExistCompetence($nomCompetence,$idDomaine,$idCD,$semestre,$annee){
		$requete = 'select count(*) from competence_annee '
		.' where annee = '.$annee.' and semestre = '.$semestre.' and LOWER(nom_competence) = \''.strtolower($nomCompetence).'\' and '
		.' id_domaine = '.$idDomaine.' and id_cd = '.$idCD.'';
		$rst = AccesBase::openRecordSet($requete);
		return $rst[0][0];
	}

	static function getDomaines(){
		$domaines = array();
		$requete = 'select id_domaine, nom_domaine from domaine';
		$rst = AccesBase::openRecordSet($requete);

		foreach ($rst as $dom){
			$domaines[$dom[0]] = $dom[1];
		}
		return $domaines;
	}

	static function getCDparDomaine($idDom){
		$champsDisc = array();
		$requete = 'select id_cd, nom_cd from champs_disciplinaire where id_domaine = '.$idDom;
		$rst = AccesBase::openRecordSet($requete);

		foreach ($rst as $CD){
			$champsDisc[$CD[0]] = $CD[1];
		}
		return $champsDisc;
	}

	static function getDomainesAnnee($annee,$semestre){
		$requete = 'select DISTINCT d.id_domaine, nom_domaine, ord.ordre IS NULL AS isnull from domaine d'
		.' INNER JOIN competence_annee c on c.id_domaine = d.id_domaine'
		.' LEFT JOIN ordre_domaine ord on (ord.id_domaine = d.id_domaine and ord.annee = c.annee and ord.semestre = c.semestre) '
		.' where c.semestre = '.$semestre
		.' ORDER BY isnull, ord.ordre, nom_domaine ASC';
		//echo $requete;
		return AccesBase::openRecordSet($requete);
	}


	static function getListeCDAnnee($annee,$idDomaine,$semestre){
		$requete = 'select DISTINCT cd.id_cd, nom_cd , ord.ordre IS NULL AS isnull from champs_disciplinaire cd'
		.' INNER JOIN competence_annee c on c.id_cd = cd.id_cd'
		.' LEFT JOIN ordre_cd ord on (ord.id_cd = cd.id_cd and ord.annee = c.annee and ord.semestre = c.semestre) '
		.' where c.id_domaine = '.$idDomaine
		.' and c.semestre = '.$semestre
		.' ORDER BY isnull, ord.ordre, cd.id_cd ASC';
		return AccesBase::openRecordSet($requete);
	}

	static function getListeCompetenceAnnee($annee,$idDomaine,$idCD,$semestre){
		$requete = 'select id_competenceAnnee, nom_competence from competence_annee '
		.' where id_domaine = '.$idDomaine.' and id_cd = '.$idCD
		.' and semestre = '.$semestre
		.' order by id_competenceAnnee ASC';
		return AccesBase::openRecordSet($requete);
	}

	static function getListeCompetenceNotees($idEleve,$semestre,$idCD){
		$requete = 'select id_competence, note, nom_competence  from note n'
		. ' inner join competence_annee ca on ca.id_competenceAnnee = n.id_competence '
		. ' where id_eleve = '.$idEleve.' and id_CD = '.$idCD.' and semestre = '.$semestre
		. ' order by id_competence';
		return AccesBase::openRecordSet($requete);
	}

	static function supprimerCompetence($idCompetence){
		$requete = 'DELETE FROM competence_annee where id_competenceAnnee = '.$idCompetence;
		return AccesBase::execute($requete);
	}

	static function isFigeSemestre($annee,$semestre){
		$requete = 'select count(0) from competences_figees where annee = '.$annee.' and  semestre = '.$semestre;
		$rst = AccesBase::openRecordSet($requete);
		return $rst[0][0];
	}

	static function figeCompetence($annee,$semestre){
		$requete = 'INSERT INTO competences_figees (annee, semestre) VALUES ('.$annee.','.$semestre.')';
		return AccesBase::execute($requete);
	}

	static function getNomCDbyID($idCD){
		$requete = 'select nom_cd from champs_disciplinaire where id_cd = '.$idCD;
		$rst = AccesBase::openRecordSet($requete);
		return $rst[0][0];
	}
	
	static function updateCompetence($idCompetence, $newCompetence){
		$requete = 'UPDATE competence_annee SET nom_competence = \''.$newCompetence.'\' WHERE id_competenceAnnee = '.$idCompetence;
		return AccesBase::execute($requete);
	}


};

?>