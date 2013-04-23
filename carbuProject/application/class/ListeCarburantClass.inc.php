<?php
/**
 * ------------------------------------------------------------------------
 * @Name : ListeCarburantClass.inc.php
 * @Desc : Classe ListeCarburantService
 * @Author : Thom
 * @Date : 16/04/2013 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

class ListeCarburant {
	private $listeCarburant;

	function __construct() {
		$listeCarburant = array();
	}

	function getListCarburant($type = '') {
		$clientSoap = new SoapClient("http://projetm2miage.no-ip.biz:8084/RecuperationOutilsDonnees.svc?wsdl", array('encoding'=>'UTF-8','trace'=>1));
		$this->listeCarburant = array();
		try {
			$return = $clientSoap->getIdAndTypeEssence(array());
			$array = (array)$return;
			while (!array_key_exists("Key", $array) && !array_key_exists("Value", $array)) {
				foreach ($array as $key => $value) {
					$array  = (array)$value;
					if (array_key_exists("Key", $array) && array_key_exists("Value", $array)) {
						if ($type == '') {
							$this->listeCarburant[$array['Value']] = $array['Value'];
						} else if ($type == 'id') {
							$this->listeCarburant[$array['Key']] = $array['Value'];
						}
						
					}
				}
			}
			return $this->listeCarburant;
		}
		catch(Exception $e) {
			echo "Erreur Service";
			return false;
		};
	}

}