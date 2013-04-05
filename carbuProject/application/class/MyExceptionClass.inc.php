<?php
/**
 * ------------------------------------------------------------------------
 * @Name : MyExceptionClass.inc.php
 * @Desc : Classe MyException
 * @Author : Atos
 * @Date : 29/03/2012 : cr�ation
 * @Task : commun
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

class MyException extends Exception {
	// Constructeur de la classe.
	// Il faut bien penser � rappeller le constructeur de la classe Exception.
	public function __construct($msg) {
		parent :: __construct($msg);
	}

	// Pour le fun, on ajoute une m�thode qui r�cup�re l'heure de l'erreur.
	public function getTime() {
		return date('Y-m-d H:i:s');
	}

	// M�thode retournant un message d'erreur complet et format�.
	public function getError($titre) {
		// On retourne un message d'erreur complet pour nos besoins.
        $mess  = $this->getMessage() . ' � la ligne ' . $this->getLine() . ' du fichier : ' . $this->getFile() . NL;      
        return $mess;
    }
}
?>