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

date_default_timezone_set('Europe/London');

define ('NL',"\r\n");

define ('ROLE_VISITEUR', 0); //Role visiteur
define ('ROLE_USER', 1); //Role user
define ('ROLE_ADMIN', 2); //Role admin

define ('URL_WCF', "http://projetm2miage.no-ip.biz:8084");//URL webService WCF
define ('GMAP_KEY', "AIzaSyCCUByYr5--YM9yGNvIZQJbbq9htgLwm9U");

define('USER', 'USER');
define('USER_ROLE', 'USER_ROLE');
?>