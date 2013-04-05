<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ClasseClass.inc.php
 * @Desc : Classe Classe
 * @Author : Thom
 * @Date : 02/06/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
require_once 'ClasseData.inc.php';

//---------------------------------------------------------------------------
// Classe Eleve
//---------------------------------------------------------------------------
class Classe {
	public $id_user;
	public $nom_instituteur;
	public $annee;

	function __construct() {
		$this->id_user  = '';
		$this->nom_instituteur  = '';
		$this->annee      = '';
	}
	
	public function isExisteClasseAnnee($id,$annee){
		if(ClasseData::getClasse($id, $annee)== null) return false;
		return true;
	}
	
	public function getListeEleves($id,$annee){
		return ClasseData::getListeEleve($id, $annee);
	}
	
	public function supprimerEleve($id_eleve){
		ClasseData::supprimerEleve($id_eleve);
	}
}