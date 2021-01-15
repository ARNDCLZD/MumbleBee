<?php
   	session_start();
   	$module = isset($_GET['module']) ? $_GET['module'] : "user";
   	switch ($module){
        case "connexion" :
   			include "modules/module_".$module."/mod_".$module.".php";
   			Connexion::initConnexion();
   			break;
   		default :
      include "modules/module_".$module."/mod_".$module.".php";
   			//die("Interdiction d'accès à ce module.");
   	}
      $nomModule = "Mod".$module;
   	new $nomModule();	
?>
<!DOCTYPE html>
<html>
<head>
   <title>Mumble Bee - Accueil</title>
   <meta charset="utf-8">
</head>
<body>
<header>  
  <?php
  /*
    include 'composant/comp_menu/mod_menu.php';
    $menu = new ModMenu();
    $menu->affiche();
  */  
  ?>
</header>
   <main>
   <?php 
      $t = new VueGenerique();
      echo $t->getAffichage();
    ?>
   </main>
<footer>le footer</footer>
</body>
</html>