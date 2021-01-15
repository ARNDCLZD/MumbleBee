<?php
include 'vue_generique.php';

class VueUser extends VueGenerique{

  public function construct()
  {
    parent::construct();
  }

  public function affiche_user($value)
  {
    echo "Utilisateur : " . $value['Login'] . "<br>" . "Email : " . $value['Email'] . "<br>" . "Statut : " . $value['Admin'];
  }
  public function user_form(){
    echo "<form action=\"index.php?action=ajout\" method=\"post\">";
    echo "<p>Login : <input type=\"text\" name=\"login\" /></p>";
    echo "<p>Email : <input type=\"text\" name=\"email\" /></p>";
    echo "<p>MotDePasse : <input type=\"text\" name=\"motDePasse\" /></p>";
    echo "<p>Admin : <input type=\"checkbox\" name=\"admin\" value=\"1\" /></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  }
  public function rechercheUser_form(){
    echo "<form action=\"index.php?action=recherche\" method=\"post\">";
    echo "<p>Login : <input type=\"search\" name=\"login\"></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  } 
}
?>