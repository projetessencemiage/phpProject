<?php
/**
 * ------------------------------------------------------------------------
 * @Name : EleveClass.inc.php
 * @Desc : Classe Eleve
 * @Author : Thom
 * @Date : 02/06/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
require_once 'EleveData.inc.php';
require_once 'EvaluationsClass.inc.php';
require_once 'GestionCompetencesClass.inc.php';
require_once 'GrapheClass.inc.php';

//---------------------------------------------------------------------------
// Classe Eleve
//---------------------------------------------------------------------------
class Eleve {
	public $id_eleve;
	public $id_classe;
	public $nom;
	public $prenom;
	public $id_sous_classe;


	function __construct() {
		$this->id_eleve  = '';
		$this->id_classe  = '';
		$this->nom  = '';
		$this->prenom      = '';
		$this->id_sous_classe      = '';
	}


	public function getEleve($id) {
		try {
			$tableau = EleveData::getEleve($id);
			$this->id_eleve  = $id;
			$this->nom  = $tableau[0][1];
			$this->prenom     = $tableau[0][2];
			return $this;
		} catch (MyException $e) {
			throw new MyException($e->getError('User.getUser'));
			return false;
		}
	}

	public function isExistUser($nom) {
		try {
			$tableau = UserData::isExistUser($nom);
			return $tableau[0][0];
		} catch (MyException $e) {
			throw new MyException($e->getError('User.isExistUser'));
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

	public function isInClasse($idInstit){
		if (EleveData::isInClasse($this->id_eleve,$idInstit) == 0) return false;
		return true;
	}

	public function createGraphe($semestre){
		$graphe = new Graphe();
		$gestionCompetence = new GestionCompetences();
		$gestionEvaluation = new Evaluations();
		$titres = array();
		$valeurs = array();
		 
		$listeNotes = $gestionEvaluation->getNoteEleve($this->id_eleve, $semestre);
		$moyCD = $listeNotes[1];
		 
		foreach ($moyCD as $idCd => $moyenne){
			$valeurs[] = $moyenne;
			$titres[] = $gestionCompetence->getNomCDbyID($idCd);
		}
		//$graphe->CreateGrapheBarre($valeurs, $titres, 'grapheEleve'.$this->id_eleve, 'Evaluations '.constant('SEMESTRE_'.$semestre).'- '.$this->prenom. ' '.$this->nom);
	}

	public function createGrapheByCD($idCD, $semestre){
		$graphe = new Graphe();
		$gestionCompetence = new GestionCompetences();
		$gestionEvaluation = new Evaluations();
		$legence = array();
		$valeurs = array();
		
		$rst = $gestionEvaluation->getNoteparCD($this->id_eleve, $idCD, $semestre);
		$noteParCD = $rst[0];
		$moyCD = number_format($rst[1],2);
		$nomCD = $gestionCompetence->getNomCDbyID($idCD);
		
		 
		foreach ($noteParCD as $nomCompetence => $note){
			$valeurs[] = $note;
			$legende[] = $nomCompetence;
		}
		
		$titreImage = $this->prenom.' '.$this->nom.' - Evaluations '.constant('SEMESTRE_'.$semestre);
		$sousTitre = $nomCD;
		
		$graphe->CreateGrapheBarre($valeurs, $legende, 'grapheEleve', $titreImage,$sousTitre);
	}
};

?>
