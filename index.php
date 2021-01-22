<!DOCTYPE html>
<html>
<head>
   <title>Mumble Bee - Accueil</title>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ovo" />
   <link href="tailwind/tailwind.css" rel="stylesheet">
</head>
<body>
<div class="flex flex-col h-screen w-screen">
<header class="bg-noir-800 justify-center content-center flex-auto flex-shrink-0">
   <?php include "templates/header/nav.php";?>
</header>
<main class="bg-jaune-300 hover:bg-jaune-700 transition-all duration-300 flex-8">
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
    }
   $nomModule = "Mod".$module;
   new $nomModule(); 
   }
?>
</main>
<?php include 'templates/footer.php'; ?>
</div>
</body>
</html>