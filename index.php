
<?php
   	session_start();
   	$module = isset($_GET['module']) ? $_GET['module'] : "connexion";
   	switch ($module){
         case "connexion" :
   			include "modules/mod_".$module."/mod_".$module.".php";
   			Connexion::initConnexion();
   			break;
   		default :
   			die("Interdiction d'accès à ce module.");
   	}
      $nomModule = "Mod".$module;
   	new $nomModule();	
?>