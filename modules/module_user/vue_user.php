<?php

class VueUser{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_user($value)
  {
    echo "Utilisateur : " . $value['Login'] . "<br>" . "Email : " . $value['Email'] . "<br>" . "Statut : " . $value['Admin'];
  }
  public function showProfile($user){
    readfile(getcwd().'/templates/profilePage.html');
  }
  public function user_form(){
    readfile(getcwd().'/templates/registerForm.html');

  }
  public function rechercheUser_form(){
    echo "<form action=\"index.php?module=user&action=recherche\" method=\"post\">";
    echo "<p>Login : <input type=\"search\" name=\"login\"></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
<<<<<<< Updated upstream
  } 
=======
  }


  public function showProfile($user, $nbPubli, $nbLikesPubli, $nbLikesAuteur){
    if($user['Admin']===1) $status="Administrateur";
    else $status="Utilisateur";

    echo "<div id=\"header\" class=\"grid flex-1 md:grid-cols-12 grid-cols-2 w-screen bg-noir-800 justify-items-center items-center border-t-2 border-jaune-300 md:max-h-24\">";
    echo "<div class=\"grid grid-cols-1 col-span-1 md:col-span-2 items-center justify-items-center\">";
    echo "<div>";
    echo "<h1 class=\"md:text-4xl text-3xl text-jaune-300 font-bold\">".$user['Login']."</h1>";
    echo "</div>";
    echo "<div>";
    echo "<h1 class=\"md:text-3xl text-2xl text-jaune-300\">".$status."</h1>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"grid grid-cols-1 col-span-1 md:col-span-2 items-center justify-items-center\">";
    echo "<div>";
    echo "<h1 class=\"md:text-3xl text-2xl text-jaune-300 font-bold\">Publications</h1>";
    echo "</div>";
    echo "<div>";
    echo "<h1 class=\"md:text-2xl text-xl text-jaune-300\">".$nbPubli['count(*)']."</h1>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"grid grid-cols-1 col-span-1 md:col-span-2 items-center justify-items-center\">";
    echo "<div>";
    echo "<h1 class=\"md:text-3xl text-2xl text-jaune-300 font-bold\">Likes Reçus</h1>";
    echo "</div>";
    echo "<div>";
    echo "<h1 class=\"md:text-2xl text-xl text-jaune-300\">".$nbLikesPubli['count(*)']."</h1>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"grid grid-cols-1 col-span-1 md:col-span-2 items-center justify-items-center\">";
    echo "<div>";
    echo "<h1 class=\"md:text-3xl text-2xl text-jaune-300 font-bold\">Contenus Likés</h1>";
    echo "</div>";
    echo "<div>";
    echo "<h1 class=\"md:text-2xl text-xl text-jaune-300\">".$nbLikesAuteur['count(*)']."</h1>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"col-span-1 md:col-span-2 items-center justify-items-center\">";
    echo "<div class=\"text-jaune-300 hover:text-jaune-400\">";
    echo "<a href=\"index.php?module=publication&action=ajouter\"><h1 class=\"text-xl\">Poster</h1></a>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"col-span-1 md:col-span-2 items-center justify-items-center\">";
    echo "<div class=\"\">";
    echo "<a href=\"index.php?module=connexion&action=deconnexion\" ><svg class=\"fill-current text-jaune-300 hover:text-jaune-400\" xmlns=\"http://www.w3.org/2000/svg\" width=50 height=50 viewBox=\"0 0 20 20\"><path d=\"M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z\"/></svg></a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    readfile(getcwd().'/templates/listeDVPublications.html'); 
  }

  public function showReportsPage($tabPublication, $tabCommentaire){
    if(is_array($tabPublication) || is_object($tabPublication)){
      foreach($tabPublication as $val){
        echo "<a href=\"index.php?module=publication&action=afficher&id=".$val['IdPubli']."\">".$val['Motif']."</a>";
      }
    }
  if(is_array($tabCommentaire) || is_object($tabCommentaire)){
    foreach($tabCommentaire as $val){
      echo "<a href=\"index.php?module=publication&action=afficher&id=".$val['IdPubli']."\">".$val['Motif']."</a>";
    }
  }
}
>>>>>>> Stashed changes
}
?>