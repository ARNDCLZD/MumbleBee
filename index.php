<?php
   
   	 if(isset($_GET['module'])){
    $module = $_GET['module'];
    switch ($module){
         case "connexion" :
        include "modules/mod_".$module."/mod_".$module.".php";
        Connexion::initConnexion();
        break;
      default :
      include "modules/module_".$module."/mod_".$module.".php";
        //die("Interdiction d'accès à ce module.");
    }
      $nomModule = "Mod".$module;
    new $nomModule(); 
   }
?>

  <?php
  /*
    include 'composant/comp_menu/mod_menu.php';
    $menu = new ModMenu();
    $menu->affiche();
  */  
  ?>

  
   <?php 
      if(empty(ob_get_contents())){
        $t = new VueGenerique();
       echo $t->getAffichage();
    }
      include_once 'vueIndex.php';
    ?>
  
