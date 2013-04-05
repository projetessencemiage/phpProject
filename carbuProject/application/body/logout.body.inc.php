<?php
/**
 * ------------------------------------------------------------------------
 * @Name : logout.body.php
 * @Desc : script contrôle authentification
 * @Autor : Atos
 * @Date : 29/03/2012 : création
 * @Version : V1.0;
 * ------------------------------------------------------------------------
 **/
unset($_SESSION['User']);
unset($_SESSION['CodeMessage']);
unset($_SESSION['Role']);
unset($_SESSION['Id_User']);
?>