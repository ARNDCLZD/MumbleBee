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
    echo "j'en peux plus";
  }
  public function user_form(){
    readfile(getcwd().'/templates/registerForm.html');

  }
  public function rechercheUser_form(){
    echo "<form action=\"index.php?module=user&action=recherche\" method=\"post\">";
    echo "<p>Login : <input type=\"search\" name=\"login\"></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  } 
}
?>