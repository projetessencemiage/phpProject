<?php
/**
 * ------------------------------------------------------------------------
 * @Name : FonctionsClass.inc.php
 * @Desc : Classe Fonctions
 * @Author : Atos
 * @Date : 29/03/2012 : cr�ation
 * @Task : commun (utilisable partout)
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/

class Fonctions {
	//---------------------------------------------------------------------------
	// Retourne une date format�e suivant le mod�le demand�
	// En entr�e : $datetime de type date ou string
	//             $mod�le
	//---------------------------------------------------------------------------
	static function format($datetime, $modele) {
		$newDateTime = '';
		if (!empty($datetime)) {
			if (strpos($datetime,' ')===false) {
				$date = $datetime;
				$hour = '';
				$min = '';
				$sec = '';
			} else {
				list($date, $time)        = explode(' ', $datetime);
				list($hour, $min, $sec)   = explode(':', $time);
			}
			if (strpos($date,'-')>0) {
				list($year, $month, $day) = explode('-', $date);
			} else {
				list($year, $month, $day) = explode('/', $date);
			}
			// remise en forme si la date est de type yyyymmdd
			if (!checkdate($month, $day, $year)) {
				switch (strlen($datetime)) {
					case 8:             // format yyyymmdd
						$year  = substr($datetime, 0, 4);
						$month = substr($datetime, 4, 2);
						$day   = substr($datetime, 6, 2);
						break;
					case 10:            // format dd/mm/yyyy
						$day   = substr($datetime, 0, 2);
						$month = substr($datetime, 3, 2);
						$year  = substr($datetime, 6, 4);
						break;
					default:
						break;
				}
			}
			// formattage suivant le mod�le pass� en param�tre
			switch ($modele) {
				case 'dd/mm/yyyy � hh' :
					$newDateTime = $day . '/' . $month . '/' . $year . ' � ' . $hour . 'h';
					break;
				case 'dd/mm/yyyy hh:mn' :
					$newDateTime = $day . '/' . $month . '/' . $year . ' � ' . $hour . 'h' . $min;
					break;
				case 'yyyy/dd/mm hh:mn' :
					$newDateTime = $year . '/' . $day . '/' . $month . ' ' . $hour . ':' . $min;
					break;
				case 'dd/mm/yyyy' :
					$newDateTime = $day . '/' . $month . '/' . $year;
					break;
				case 'yyyy-mm-dd' :
					$newDateTime = $year . '-' . $month . '-' . $day;
					break;
				case 'yyyymmdd' :
					$newDateTime = $year . $month . $day;
					break;
				case 'd' :
					$newDateTime = $day;
					break;
				case 'm' :
					$newDateTime = $month;
					break;
				case 'LD' :
					$jourSemaine=date("w", mktime(0, 0, 0, $month, $day, $year));
					$newDateTime = strtoupper(substr(Fonctions::getJourSemaine($jourSemaine),0,1)).' '.$day;
					break;
				case 'hh:mn' :
					$newDateTime = $hour . ':' . $min;
					break;
				case 'hh:mn:ss' :
					$newDateTime = $hour . ':' . $min . ':' . $sec;
					break;
				default :
					$newDateTime = $datetime;
					break;
			}
		}
		return $newDateTime;
	}

	/*
	 * Formate la date de la format "dd/mm/yyyy" ou "dd-mm-yyyy" � la format "yyyy-mm-dd"
	* @param $date: la date � formater
	* @return $newDate: la date format�e
	*/
	static function formaterDateMysql($date){
		$day = substr($date,0,2);
		$month = substr($date,3,2);
		$year = substr($date,6,4);
		$newDate = new DateTime($month.'/'.$day.'/'.$year);
		$newDate = $newDate->format('Y-m-d');
		return $newDate;
	}

	/*
	 * Formate la date de la format "yyyy-mm-dd" � la format "dd/mm/yyyy"
	* @param $date: la date � formater
	* @return $newDate: la date format�e
	*/
	static function formaterDateFromMysql($date){
		$day = substr($date,8,2);
		$month = substr($date,5,2);
		$year = substr($date,0,4);
		$newDate = new DateTime($month.'/'.$day.'/'.$year);
		$newDate = $newDate->format('d/m/Y');
		return $newDate;
	}

	/*
	 * Formate la date de la format "yyyy/mm/dd"
	* @param $date: la date � formater
	* @return $newDate: la date format�e
	*/
	static function formaterDateEnMysql($date){
		$day = substr($date,8 ,2);
		$month = substr($date,5,2);
		$year = substr($date,0,4);
		$newDate = new DateTime($month.'/'.$day.'/'.$year);
		$newDate = $newDate->format('Y-m-d');
		return $newDate;
	}

	//---------------------------------------------------------------------------
	// Calcul du nombre de jours entre 2 dates (A-M-J)
	//---------------------------------------------------------------------------
	function NbJours($debut, $fin) {
		$tDeb = explode("-", $debut);
		$tFin = explode("-", $fin);

		$diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
		mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);
		return(($diff / 86400)+1)-1;
	}


	//---------------------------------------------------------------------------
	// Test si IP du client est une IP interne
	//---------------------------------------------------------------------------
	static function isIpInterne() {
		if ((substr($_SERVER["REMOTE_ADDR"],0,9)=='192.168.1' || $_SERVER["REMOTE_ADDR"]=='127.0.0.1')
				|| (isset($_SESSION['pseudo']) and $_SESSION['pseudo']=='webmaster' and $_SESSION["password"]>'')) {
			if (isset($_SESSION['pseudo']) and $_SESSION['pseudo']=='webmaster') {
				$entete = "From: " . EMAIL_WEBMASTER . NL
				. "MIME-Version: 1.0".NL
				. 'Content-type: text/html; charset= iso-8859-1'.NL;
				$titre  = 'lucilda.fr : connexion s�curis�e';
				$email  = EMAIL_WEBMASTER;
				$message = 'Une connexion s�curis� est en cours sur '.$_SERVER['PHP_SELF'];
				@mail($email,$titre,$message,$entete);
			}
			return true;
		} else {
			return false;
		}
	}

	//---------------------------------------------------------------------------
	// Test si session initialisee correctement pour un joueur
	//---------------------------------------------------------------------------
	static function isSessionOk() {
		if (isset($_SESSION["pseudo"])) {
			if ($_SESSION["pseudo"]>'') {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	//---------------------------------------------------------------------------
	// Renvoi le libell� du jour dont le no est pass� en param�tre
	//---------------------------------------------------------------------------
	static function getJourSemaine($noJour) {
		switch ($noJour) {
			case 0: return 'dimanche';
			case 1: return 'lundi';
			case 2: return 'mardi';
			case 3: return 'mercredi';
			case 4: return 'jeudi';
			case 5: return 'vendredi';
			case 6: return 'samedi';
			case 7: return 'dimanche';
			default: return '';
		}
	}

	//---------------------------------------------------------------------------
	// Renvoi le libell� du mois dont le no est pass� en param�tre
	//---------------------------------------------------------------------------
	static function getMois($noMois) {
		switch ($noMois) {
			case 1: return 'Janvier';
			case 2: return 'F�vrier';
			case 3: return 'Mars';
			case 4: return 'Avril';
			case 5: return 'Mai';
			case 6: return 'Juin';
			case 7: return 'Juillet';
			case 8: return 'Aout';
			case 9: return 'Septembre';
			case 10: return 'Octobre';
			case 11: return 'Novembre';
			case 12: return 'D�cembre';
			default: return '';
		}
	}

	//------------------------------------------------------------------------------
	// r�cup�re les erreurs soulev�es mais non captur�es
	// http://guillaume-affringue.developpez.com/exceptions-et-PHP5/?page=4
	//------------------------------------------------------------------------------

	static function exception_handler($code, $msg, $file, $line) {
		Fonctions::setTraceErr("Exception_handler $code : $msg ($file $line)<br />");
	}

	//------------------------------------------------------------------------------
	// capture les erreurs E_NOTICE / E_WARNING / E_ERROR
	//------------------------------------------------------------------------------
	static function captureErreur($type, $msg, $file, $line, $context) {
		if ($_SESSION['setErrorHandler']) {
			switch ($type) {
				// notices
				case E_NOTICE:
					// do nothing
					break;

					// warnings
				case E_WARNING:
					// report error
					Fonctions::setTraceErr("Non-fatal error on line $line of $file: $msg <br />");
					break;

					// other
				default:
					Fonctions::setTraceErr("Error of type $type on line $line of $file: $msg <br />");
					break;
			}
		} else {
			// gestion d�sactiv�e
		}
	}
	//------------------------------------------------------------------------------
	// afficher une liste html (<select>)
	//------------------------------------------------------------------------------
	static function echoList($name, $data, $default = null, $enabled = true, $multipleParam = false, $onChangeParam = null) {
		$disabled = "";
		$multiple = "";
		$onChange  = "";
		if ($enabled == false) $disabled="disabled=\"true\"";
		if ($multipleParam == true) $multiple="multiple size=\"4\"";
		if ($onChangeParam != null) $onChange="onChange=\"".$onChangeParam."\"";
		echo "<select name=\"$name\" id=\"$name\" $disabled $multiple $onChange>\r\n";
		foreach($data as $id => $val){
			$selected = "";
			if ($default." " == $id." ") $selected = "selected=\"selected\"";
			echo "<option value=\"$id\" $selected>$val</option>\r\n";
		}
		echo "</select>\r\n";
	}

	static function echoListMultiple($name, $data, $defaults = null, $enabled = true, $onChangeParam = null) {
		$disabled = "";
		$onChange  = "";
		$multiple="multiple size=\"4\"";
		$id = substr($name, 0,strlen($name)-2);
		if ($enabled == false) $disabled="disabled=\"true\"";
		if ($onChangeParam != null) $onChange="onChange=\"".$onChangeParam."\"";
		echo "<select name=\"$name\" id=\"$id\" $disabled $multiple $onChange>\r\n";
		foreach($data as $id => $val){
			$selected = "";
			foreach ($defaults as $default) {
				if ($default." " == $val." ") $selected = "selected=\"selected\"";
			}
			echo "<option value=\"$id\" $selected>$val</option>\r\n";
		}
		echo "</select>\r\n";
	}
	//------------------------------------------------------------------------------
	// afficher une liste html (<select>)
	//------------------------------------------------------------------------------
	static function echoListOuiNon($name, $default = null) {
		$data = array("1"=>"Oui","0"=>"Non");
		Fonctions::echoList($name, $data,$default);
	}
	//------------------------------------------------------------------------------
	// afficher un liste html (<select>)
	//------------------------------------------------------------------------------
	static function echoBooleanOuiNon($bool) {
		if ($bool ===true ||
				$bool == 1 ||
				strtolower($bool) === 'oui' ||
				strtolower($bool) === 'yes' ||
				strtolower($bool) === 'y' ||
				strtolower($bool) === 'o' ||
				strtolower($bool) === 'true' ||
				strtolower($bool) === 'vrai'){
			echo 'Oui';
		}else{
			echo 'Non';
		}
	}


	/*
	 * Controle lacces direct � une page
	* @param $role : role minimum necessaire
	* @param $body
	* @param $action
	*/
	public static function controlerAcces($role, $body, $action) {
		$retour = array();
		if (isset ($_SESSION['Role'])) {
			if($_SESSION['Role']<=$role) {
				$retour["body"]   = $body;
				$retour["action"] = $action;
			} else {
				$_SESSION["message"] = 'Vous n\'avez pas le droit d\'acc�s � cette page!';
				$_SESSION["pageRetour"]  = 'ctrlAuth.php';
				$_SESSION["erreurAcces"] = 'true';
				$retour["body"]   = 'erreur.body.php';
				$retour["action"] = '';
			}
		} else {
			$retour["body"]   = 'ctrlAuth.php';
			$retour["action"] = '';
		}
		return $retour;
	}

	/**
	 * Retourne NULL si valeur vide sinon retourne la valeur saisie
	 * @param $value
	 */
	public static function convertToNullIfEmpty($value) {
		if ($value == '') {
			return 'NULL';
		} else {
			return $value;
		}
	}

	public static function getCoordFromAdresse($adresse) {
		$adresse = urlencode($adresse);
		$url = 'http://maps.googleapis.com/maps/api/geocode/xml?address='.$adresse.'&sensor=false';	
		$page = file_get_contents($url);
		// Parse le r�sultat XML
		$xml_result = new SimpleXMLElement($page);
		// V�rifie que la requ�te a r�ussi
		if ($xml_result->status != 'OK') return array();
		// Charge les adresses
		$adresses = array();
		$adresses['lat'] = $xml_result->result->geometry->location->lat; 
		$adresses['lng'] = $xml_result->result->geometry->location->lng;
		return $adresses;
	}
	
	public static function getCoordByIp() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$url = 'http://www.geoplugin.net/php.gp?ip='.$ip;
		$array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
		$adresses = array();
		if ($array['geoplugin_status'] != '404') {
			$adresses['lat'] = $array['geoplugin_latitude'];
			$adresses['lng'] = $array['geoplugin_longitude'];
		} else {
			//Coord de Bdx si rien trouvé
			$adresses['lat'] = '44.854409';
			$adresses['lng'] = '-0.578957';
		}
		return $adresses;
	}
	
	public static function inputHidden($name, $value) {
		echo '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'"/>';
	}
	
	public static function getNbJourToString($j) {
		if ($j == 0) return "MàJ Aujourd'hui";
		if ($j == 1) return "MàJ Hier";
		else return 'MàJ il y a '.$j.'j';
	}
}
?>