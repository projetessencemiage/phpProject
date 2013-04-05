<?php

require_once 'GestionCompetencesData.inc.php';

//---------------------------------------------------------------------------
// Classe Eleve
//---------------------------------------------------------------------------
class GestionCompetences {

	function __construct() {

	}

	public function isExisteDomaine(){
		try {
			$count = GestionCompetencesData::isExisteDomaine();
			return $count;
		} catch (MyException $e) {
			throw new MyException($e->getError('GestionCompetences.isExisteDomaine'));
			return false;
		}
	}

	public function isExisteCompetenceAnnee($annee){
		if(GestionCompetencesData::isExisteCompetenceAnnee($annee)>0) return true;
		return false;
	}

	public function ajoutDomaine($nomDomaine){
		if(GestionCompetencesData::isExisteDomaine($nomDomaine) == 0){
			$idDomaine = GestionCompetencesData::ajoutDomaine($nomDomaine);
			return $idDomaine[1];
		}
		else return 0;
	}

	public function ajoutChampsDisciplinaire($nomCD, $idDomaine){
			
		if(GestionCompetencesData::isExisteChampsDisciplinaire($nomCD,$idDomaine) == 0){
			$idCompetence = GestionCompetencesData::ajoutChampsDisciplinaire($nomCD,$idDomaine);
			return $idCompetence[1];
		}
		else return 0;

	}

	public function ajoutCompetence($nomCompetence,$idDomaine,$idCD,$semestre,$annee){

		if(GestionCompetencesData::isNotExistCompetence($nomCompetence,$idDomaine,$idCD,$semestre,$annee) == 0){
			GestionCompetencesData::ajoutCompetence($nomCompetence,$idDomaine,$idCD,$semestre,$annee);
			return true;
		}
		else return false;

	}

	/**
	 * Domaines pour listes déroulantes
	 */
	public function getListeDomaines(){

		$champs[0] = '(Choisir un domaine)';
		$domaines = GestionCompetencesData::getDomaines();
		$domaines = $champs + $domaines;
		return $domaines;
	}

	/**
	 *
	 * CD pour listes déroulantes en fonction des domaines
	 * @param unknown_type $idDom
	 */
	public function getListeCD($idDom){
		$champs[0] = '(Choisir un champs disciplinaire)';
		if($idDom == 0) return $champs;
		else{
			$CDs = GestionCompetencesData::getCDparDomaine($idDom);
			$CDs = $champs + $CDs;
			return $CDs;
		}
	}

	/**
	 *
	 * CD en fonction des domaines
	 * @param unknown_type $idDom
	 * @throws MyException
	 */
	public function getListeCDparDomaine($idDom){

		try{
			return GestionCompetencesData::getCDparDomaine($idDom);
		}catch (MyException $e) {
			throw new MyException($e->getError('GestionCompetences.getListeCD'));
			return false;
		}
	}

	public function getListeDomaineAnnee($annee,$semestre){
		$tabIdNomDomaine = array();
		$listeDomaines = GestionCompetencesData::getDomainesAnnee($annee,$semestre);
		foreach ($listeDomaines as $dom){
			$tabIdNomDomaine[$dom[0]] = $dom[1];
		}
		return $tabIdNomDomaine;
	}

	public function listeCDAnnee($annee,$idDomaine,$semestre){
		$tabIdCD = array();

		$listeCD = GestionCompetencesData::getListeCDAnnee($annee,$idDomaine,$semestre);
		foreach ($listeCD as $cd){
			$tabIdCD[$cd[0]] = $cd[1];
		}
		return $tabIdCD;
	}

	public function listeCompetenceAnnee($annee,$idDomaine,$idCD,$semestre){
		$tabIdCompetence = array();
		$listeCompetence = GestionCompetencesData::getListeCompetenceAnnee($annee,$idDomaine,$idCD,$semestre);
		foreach ($listeCompetence as $competence){
			$tabIdCompetence[$competence[0]] = $competence[1];
		}
		return $tabIdCompetence;
	}

	static function getListeCompetenceNotees($idEleve,$semestre,$idCD){
		$tabIndexNoteNom = array();
		$i = 0;
		$listeCompetences = GestionCompetencesData::getListeCompetenceNotees($idEleve,$semestre,$idCD);
		foreach ($listeCompetences as $competence){
			$tabIndexNoteNom[$i][0] = $competence[1];
			$tabIndexNoteNom[$i][1] = $competence[2];
			$i++;
		}
		return $tabIndexNoteNom;
	}

	public function supprimerCompetence($idCompetence,$annee,$semestre){
		if(! $this->isFigeSemestre($annee,$semestre))
		GestionCompetencesData::supprimerCompetence($idCompetence);
	}

	public function figeCompetence($annee,$semestre){
		if(GestionCompetencesData::isFigeSemestre($annee,$semestre) == 0)
		GestionCompetencesData::figeCompetence($annee,$semestre);
	}

	public function isFigeSemestre($annee,$semestre){
		if(GestionCompetencesData::isFigeSemestre($annee,$semestre) == 0) return false;
		else return true;
	}

	public function getNomCDbyID($idCD){
		return GestionCompetencesData::getNomCDbyID($idCD);
	}
	
	public function updateCompetence($idCompetence, $newCompetence){
		GestionCompetencesData::updateCompetence($idCompetence, $newCompetence);
	}

};


?>