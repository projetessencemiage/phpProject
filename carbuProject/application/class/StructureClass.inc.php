<?php
/**
 * ------------------------------------------------------------------------
 * @Name : StructureClass.inc.php
 * @Desc : Classe Structure
 * @Author : Atos
 * @Date : 29/03/2012 : création
 * @Task : commun
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
class Structure {
	/**
	 * -------------------------------------------------------------------------
	 * Constructeur du header de la page
	 * -------------------------------------------------------------------------
	 **/
	static function getHeader($finEntete=true) {
		$description = '';
		$keywords = '';
		$robots = 'no';
		switch ($_SERVER['PHP_SELF']) {
			/*
			 // -------------------------------------------------------------------------
			 case '/ma page.php' :
			 // -------------------------------------------------------------------------
				$titre = "titre";
				break;
				*/
			// -------------------------------------------------------------------------
			default :
				// -------------------------------------------------------------------------
				$titre = "Miage project";
				break;
		}
		//<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
		echo  '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title>' . $titre . '</title>
			<meta name="description" content="' . $description . '" />
			<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
			<meta http-equiv="Content-Script-Type" content="text/javascript" />
			<meta http-equiv="Content-Style-Type" content="text/css" />
			<meta http-equiv="Content-Language" content="fr" />';
		echo  '
			<meta name="subject" content="' . $description . '" />
			<meta http-equiv="Content-Language" content="fr" />
			<meta name="location" content="France, FRANCE" />
			<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
			<meta name="rating" content="general" />';
		
		echo '<link rel="stylesheet" type="text/css" href="css/Style.css" media="screen" />'.NL;
		echo '<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />'.NL;


		// recuperation du javascript specifique a la page si existe
		$pageName=substr($_SERVER['PHP_SELF'],1,strlen($_SERVER['PHP_SELF'])-5);
		$pos=strpos($pageName,'/');
		if ($pos<>false) $pageName=substr($pageName,$pos+1);
	
		if (file_exists('js/'.$pageName.'.js')) {
			echo '<script language="JavaScript" type="text/javascript" src="js/'.$pageName.'.js" ></script>'.NL;
		}
		if ($finEntete) {
			echo "<script src=\"js/utile.js\" type=\"text/javascript\"></script>";
			echo '</head>' . NL;
		}
		flush();
	}
	/**
	 * -------------------------------------------------------------------------
	 * Constructeur du corps de la page
	 * -------------------------------------------------------------------------
	 **/
	static function getBody($body, $bodyParam='', $action='', $formParam='') {
		echo '<body'. $bodyParam . '>
				<form name="forme"';
		//if ($action>'') echo ' action="'.$action.'"';
		echo ' action="'.$action.'"';
		echo ' enctype="'.$formParam.'"';
		echo ' method="post">
					<div id="conteneur">
						<div id="entete" class="noscreen">';
		require_once 'entete.inc.php';
		echo '
						</div>
						<div id="gauche" class="noscreen">';
		//switch ($_SERVER['PHP_SELF']) {
			// -------------------------------------------------------------------------
			//case '/chambre-admin.php' :
			//case '/chambre-calendrier.php' :
			//	require_once 'menu-gauche-admin.inc.php';
			//	break;
			// -------------------------------------------------------------------------
				
			//case '/identification.php' :
				//break;
				// -------------------------------------------------------------------------
		//	default :
				require_once 'menu-gauche.inc.php';
			//	break;
		//}
		echo '
							
						</div>';
		echo '		
						<div id="centre">';
		require_once $body;
		echo '
						</div>
						<div id="pied">';
		echo '
						</div>
					</div>
				</form>
			</body>
			</html>';
	}
}
?>
