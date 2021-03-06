<?php
/**
 * ------------------------------------------------------------------------
 * @Name : StructureClass.inc.php
 * @Desc : Classe Structure
 * @Author : TGOU
 * @Date : 25/04/2013 : cr�ation
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
class Structure {
	/**
	 * -------------------------------------------------------------------------
	 * Constructeur du header de la page
	 * -------------------------------------------------------------------------
	 **/
	static function getHeader($finEntete='') {
		echo  '
		<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<title>Carbu project</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

		<!-- Le styles -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="css/jq.css" type="text/css" media="print, projection, screen" />
		<link rel="stylesheet" href="css/themes/blue/style.css" type="text/css" media="print, projection, screen" />
				
		<!-- Script -->
		<script  type="text/javascript" src="js/utile.js"></script>
		<script  type="text/javascript" src="js/ajax.js"></script>
		<script  type="text/javascript" src="js/Formulaires.js"></script>
		<script type="text/javascript" src="js/jquery-latest.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="js/chili/chili-1.8b.js"></script>
		<script type="text/javascript" src="js/docs.js"></script>
		
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="bootstrap/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="bootstrap/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="bootstrap/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="bootstrap/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="bootstrap/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="bootstrap/ico/favicon.png">';
		echo $finEntete;
		echo '</head>'.NL;
		flush();
	}
	/**
	 * -------------------------------------------------------------------------
	 * Constructeur du corps de la page
	 * -------------------------------------------------------------------------
	 **/
	static function getBody($body, $bodyParam='', $action='') {
		echo '<body'. $bodyParam . '>
		<form name="formGeneral"';
		echo ' id="formGeneral"';
		echo ' action="'.$action.'"';
		echo ' method="post">';
		echo '<div id="corps" class="container">	
			<div class="masthead">';
		echo '<img src="./images/banniere.jpg"/>';		
		require_once 'nav-menu.inc.php';
			echo '</div>';
		
		echo '
			<div class="row-fluid">
				<div class="span12">';
				require_once $body;
				echo '</div>';
		echo '
			</div>
		<hr>
		<div class="footer">';
		require_once 'pied.inc.php';
			echo '</div>
		</div>
		</form>
		</body>
		</html>';
	}
}
?>
