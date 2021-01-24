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
    include_once 'templates/registerForm.php';

  }
  public function rechercheUser_form(){
    echo "<form action=\"index.php?module=user&action=recherche\" method=\"post\">";
    echo "<p>Login : <input type=\"search\" name=\"login\"></p>";
    echo "<p><input type=\"submit\" value=\"OK\"></p>";
    echo "</form>";
  } 

  public function afficherUsers($tab){
    foreach ($tab as $key => $val) {
      $login = $val['Login'];
      $email = $val['Email'];
      $id = $val['IdUtil'];
      echo "<br>";
      echo "Login: " . $login;
      echo "<br>";
      echo "Email: " . $email;
      echo "<br>";
      if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 1){
      echo "<form action=\"index.php?module=user&action=supprimerUser\" method=\"post\">";
      echo "<p><input type=\"submit\" value=\"OK\"></p>";
      echo "<input name=\"Login\" style=\"display:none\" type=\"text\" value=\"".$login."\">"; 
      echo "<input name=\"Email\" style=\"display:none\" type=\"text\" value=\"".$email."\">"; 
      echo "<input name=\"IdUtil\" style=\"display:none\" type=\"text\" value=\"".$id."\">"; 
      echo "</form>";
      }

    }
  }
}
?>