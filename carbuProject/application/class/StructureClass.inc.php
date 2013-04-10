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
		echo  '
		<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<title>Template &middot; Bootstrap</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="bootstrap/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="bootstrap/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="bootstrap/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="bootstrap/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="bootstrap/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="bootstrap/ico/favicon.png">
		</head>'. NL;
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
		
		<div class="container">	
			<div class="masthead">';
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
