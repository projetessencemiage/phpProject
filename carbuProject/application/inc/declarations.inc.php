<?php
//---------------------------------------------------------------------------
// Definition des constantes globales
//---------------------------------------------------------------------------

set_include_path('.'
. PATH_SEPARATOR . './application/inc'
. PATH_SEPARATOR . './application/class'
. PATH_SEPARATOR . './application/body'
. PATH_SEPARATOR . './controller'
. PATH_SEPARATOR . './application/outils'
. PATH_SEPARATOR . './application/outils/pChart2.1.3'
. PATH_SEPARATOR . './application/outils/pChart2.1.3/class'
. PATH_SEPARATOR . './application/outils/geoplugin.class'
. PATH_SEPARATOR . get_include_path());

require_once 'StructureClass.inc.php';
require_once 'MyExceptionClass.inc.php';
require_once 'FonctionsClass.inc.php';


$fic='./application/inc/param_serveur.txt';


date_default_timezone_set('Europe/London');

define ('COULEUR_FOND','#99CCCC');

define ('NL',"\r\n");

define ('ROLE_SUPADM',0); //Role super-administrateur
define ('ROLE_ADM', 1); //Role administrateur
define ('ROLE_PROF', 2); //Role controleur de gestion
define ('URL_WCF', "http://projetm2miage.no-ip.biz:8084");//URL webService WCF

define ('GMAP_KEY', "AIzaSyCCUByYr5--YM9yGNvIZQJbbq9htgLwm9U");