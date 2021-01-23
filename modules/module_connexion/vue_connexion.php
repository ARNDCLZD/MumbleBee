<?php

class VueConnexion{

  public function construct()
  {
    parent::construct();
  }
  public function connexion_form(){
    include 'templates/loginForm.php';
  } 
  public function deconnexion_form(){
    echo "<form action=\"index.php?module=connexion&action=deconnexion\" method=\"post\">";
    echo "<p><input type=\"submit\" value=\"Deconnexion\"></p>";
    echo "</form>";
  }
}
?>