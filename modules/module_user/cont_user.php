<?php
include_once 'modele_user.php';
include_once 'vue_user.php';

class ContUser {
  private $vue;
  private $mod;
  public function __construct(){
      $this->vue = new VueUser();
      $this->mod = new ModeleUser();

      if (isset($_GET['action'])) {
          $action = $_GET['action'];
      } else {
          $action = 'ajouter';
      }
        $this->trie($action);

  }
  function trie($action) {
    switch ($action) {
        case "ajouter":
          $this->ajoutUserform();
          break;
        case "ajout":
          $this->ajoutUser();
          break;
        case "rechercher":
          $this->rechercheUserform();
          break;
        case "recherche":
          $this->rechercheUser();
          break;
        default:
          $this->error();
      }    
  }
  public function error(){
    echo "Page introuvable";
    http_response_code(404);
    die;
  }
  public function rechercheUserform(){
    $this->vue->rechercheUser_form();
  }
  public function rechercheUser(){
    $var = $this->mod->rechercheUser();
    var_dump($var);
    foreach ($var as &$value) {
      $this->vue->affiche_user($value);
    }
    
  }
  public function ajoutUserform(){
    $this->vue->user_form();
  }
  public function ajoutUser(){
    $this->mod->ajoutUser();
  }

}
?>