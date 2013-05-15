<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ListeUsersClass.inc.php
 * @Desc : Classe listeUsersClass
 * @Author : Bimbo
 * @Date : 12/04/2013 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

class listeUsersClass {
	private $listeUsers;

	function __construct() {
		$this->soapClient = new SoapClient(URL_WCF."/ActionAdmin.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$this->listeUsers = array();
	}
	
	public function getListUsers(){
		return $this->getListUsersArray();
	}
	
	public function getListUsersArray() {
		
		try {
		$this->soapClient->ListUtilisateur();
		$result = $this->soapClient->__getLastResponse();
			$dom = new DomDocument();
			$dom->loadXML($result);
			$tab = $dom->getElementsByTagName('User');
			foreach ($tab as $user){
				$adress = $user->childNodes->item(0)->nodeValue;
				$civilite = $user->childNodes->item(2)->nodeValue;
				$cp = $user->childNodes->item(3)->nodeValue;
				$email = $user->childNodes->item(4)->nodeValue;
				$nom = $user->childNodes->item(8)->nodeValue;
				$prenom = $user->childNodes->item(9)->nodeValue;
				$pseudo = $user->childNodes->item(10)->nodeValue;
				$role = $user->childNodes->item(11)->childNodes->item(1)->nodeValue;
				$ville = $user->childNodes->item(12)->nodeValue;
								
				$this->listeUsers[] = new User('', $pseudo, '', $civilite, $nom, $prenom, $adress, $cp, $ville, $email, $role, '', '', '');
			}
			
			return $this->listeUsers;
		}
		catch(Exception $e) {
			echo "Erreur Service";
			return false;
		};
		return $arrayPrice;
	}
	
}
?>