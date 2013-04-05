<?php

require_once 'EvaluationsData.inc.php';

//---------------------------------------------------------------------------
// Classe Evaluations
//---------------------------------------------------------------------------
class Evaluations {

	function __construct() {

	}

	public function supprimerNote($idEleve,$idCompetence){
		try {
			EvaluationsData::supprimerNote($idEleve,$idCompetence);
			return true;
		} catch (MyException $e) {
			throw new MyException($e->getError('Evaluations.supprimerNote'));
			return false;
		}
	}

	public function noterEleve($idEleve,$idCompetence,$valeurNote){
		try{
			if(EvaluationsData::noteExiste($idEleve,$idCompetence) != 0){
				EvaluationsData::modiferNote($idEleve,$idCompetence,$valeurNote);
				return true;
			}
			else {
				EvaluationsData::ajouterNote($idEleve,$idCompetence,$valeurNote);
				return true;
			}
		}catch (MyException $e) {
			throw new MyException($e->getError('Evaluations.noterEleve'));
			return false;
		}
	}
	public function getNoteEleve($idEleve,$semestre){
		$listeNotesCompetence = array();
		$listeNotesCD = array();
		$listeNotesDomaine = array();
		$nbNotesDomaine = array();
		$nbNotesCD = array();

		$donnees = EvaluationsData::getNoteEleve($idEleve,$semestre);
		
		foreach ($donnees as $note){

			$listeNotesCompetence[$note[0]] = $note[1];

			if (array_key_exists($note[2], $listeNotesCD)){
				$listeNotesCD[$note[2]] += $note[1];
				$nbNotesCD[$note[2]] ++;
			}
			else{
				$listeNotesCD[$note[2]] = $note[1];
				$nbNotesCD[$note[2]] = 1;
			}

			if (array_key_exists($note[3], $listeNotesDomaine)){
				$listeNotesDomaine[$note[3]] += $note[1];
				$nbNotesDomaine[$note[3]]++;
			}
			else{
				$listeNotesDomaine[$note[3]] = $note[1];
				$nbNotesDomaine[$note[3]] = 1;
			}
		}

		foreach ($listeNotesDomaine as $idDomaine => $somme) $listeNotesDomaine[$idDomaine] = $somme/$nbNotesDomaine[$idDomaine];
		foreach ($listeNotesCD as $idCD => $somme) $listeNotesCD[$idCD] = $somme/$nbNotesCD[$idCD];

		return array($listeNotesCompetence,$listeNotesCD,$listeNotesDomaine);
	}

	public function getMoyenneEleve($idEleve,$semestre,$idCompetence){

		$donnees = EvaluationsData::getMoyenneEleve($idEleve,$semestre,$idCompetence);
		$totalDomaine = 0;
		$totalCd = array();
		$nbCompetenceCD = array();
		$nbCompetence = 0;

		foreach ($donnees as $note){
			$nbCompetence++;
			$totalDomaine += $note[1];
				
			if (array_key_exists($note[2], $totalCd)){
				$totalCd[$note[2]] += $note[1];
				$nbCompetenceCD[$note[2]]++;
			}
			else{
				$totalCd[$note[2]] = $note[1];
				$nbCompetenceCD[$note[2]] = 1;
			}
		}
		foreach ($totalCd as $idCD => $somme) $totalCd[$idCD] = $somme/$nbCompetenceCD[$idCD];
		
		$moyDomaine = ($nbCompetence != 0) ?  ($totalDomaine/$nbCompetence): 0;
		return array($moyDomaine,$totalCd);
	}
	
	public function getNoteparCD($idEleve,$idCD,$semestre){
		$donnees = EvaluationsData::getNoteEleve($idEleve,$semestre);
		$noteParCD = array();
		$total = 0;
		$nbNote = 0;
		foreach ($donnees as $note){
			if($note[2] == $idCD){
				$noteParCD[$note[4]] = $note[1];
				$total += $note[1];
				$nbNote++;
			}
		}
		return array($noteParCD,($total/$nbNote));
	}
};


?>
