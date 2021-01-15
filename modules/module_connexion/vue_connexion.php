<?php
include 'vue_generique.php';

class VueConnexion extends VueGenerique{

  public function construct()
  {
    parent::construct();
  }
  public function connexion_form(){
    echo "<form action=\"index.php?module=connexion&action=connexion\" method=\"post\">";
    echo "<p>Login : <input type=\"text\" name=\"username\"></p>";
    echo "<p>Password : <input type=\"password\" name=\"pwd\"></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  } 
  public function deconnexion_form(){
    echo "<form action=\"index.php?module=connexion&action=deconnexion\" method=\"post\">";
    echo "<p><input type=\"submit\" value=\"Deconnexion\"></p>";
    echo "</form>";
  }
}
?>