<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ListePrixClass.inc.php
 * @Desc : Classe StationService
 * @Author : Bimbo
 * @Date : 26/04/2013 : creation
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

require_once('EnseigneClass.inc.php');

class ListeEnseigne {
	private $listeEnseigne;

	function __construct() {
		$this->listeEnseigne = array();
	}
	
	public function addEnseigne($enseigne) {
		$this->listeEnseigne[] = $enseigne;
	}
	public function getEnseignes() {
		
		try{
			$this->listeEnseigne = array();
			$clientSoap = new SoapClient(URL_WCF."/RecuperationOutilsDonnees.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
			$clientSoap->getIdAndNomEnseigne();
			$result = $clientSoap->__getLastResponse();
			$dom = new DomDocument();
			$dom->loadXML($result);
			$tab = $dom->getElementsByTagName('KeyValueOfintstring');
			
			foreach ($tab as $enseigne){
				$key = $enseigne->childNodes->item(0)->nodeValue;
				$value = $enseigne->childNodes->item(1)->nodeValue;
				$this->listeEnseigne[$key] = $value;
			}
			
			return $this->listeEnseigne;
		}
		catch(Exception $e) {
			echo "Erreur Service";
			return false;
		};
	}
	
}
?>