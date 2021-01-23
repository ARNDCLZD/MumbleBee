<?php
   session_start();
   if(isset($_GET['module'])){
    $module = $_GET['module'];
    switch ($module){
         case "connexion" :
        include "modules/module_".$module."/mod_".$module.".php";
        Connexion::initConnexion();
        break;
      default :
      include "modules/module_".$module."/mod_".$module.".php";
        //die("Interdiction d'accès à ce module.");
        break;
    }
   $nomModule = "Mod".$module;
   new $nomModule(); 

   }
?>